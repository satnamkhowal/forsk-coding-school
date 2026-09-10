<?php
/**
 * IndexNow bulk submitter for Forsk Coding School.
 * Usage: php tools/indexnow-submit.php --dry-run
 *        php tools/indexnow-submit.php
 */
$root = dirname(__DIR__);
$host = 'forskcodingschool.com';
$key = 'a2e6aef22b29005c161acb4bafed90cf';
$keyLocation = 'https://forskcodingschool.com/a2e6aef22b29005c161acb4bafed90cf.txt';
$endpoint = 'https://api.indexnow.org/indexnow';
$dryRun = in_array('--dry-run', $argv ?? [], true);

function readUrlset(string $file): array {
    if (!is_file($file)) return [];
    $xml=(string)file_get_contents($file);
    if ($xml==='') return [];
    $urls=[];
    // Sitemap index: follow child sitemap <loc> entries.
    if (stripos($xml,'<sitemapindex')!==false) {
        if (preg_match_all('~<loc>\\s*(.*?)\\s*</loc>~is',$xml,$m)) {
            foreach ($m[1] as $locRaw) {
                $loc=html_entity_decode(strip_tags($locRaw),ENT_QUOTES|ENT_XML1,'UTF-8');
                $path=parse_url($loc,PHP_URL_PATH) ?: '';
                if ($path==='') continue;
                $child=dirname(__DIR__) . '/' . ltrim($path,'/');
                $urls=array_merge($urls,readUrlset($child));
            }
        }
        return $urls;
    }
    // URL set: capture only direct <url><loc> page URLs; ignore image:loc etc.
    if (preg_match_all('~<url>.*?<loc>\\s*(.*?)\\s*</loc>.*?</url>~is',$xml,$m)) {
        foreach ($m[1] as $locRaw) {
            $loc=html_entity_decode(strip_tags($locRaw),ENT_QUOTES|ENT_XML1,'UTF-8');
            if ($loc!=='') $urls[]=$loc;
        }
    }
    return $urls;
}
$urls=array_values(array_unique(readUrlset($root.'/sitemap.xml')));
$urls=array_values(array_filter($urls, fn($u)=>parse_url($u,PHP_URL_HOST)===$host));
// Do not submit draft/noindex mentor profiles. Only verified profiles are included.
$mentorDataFile=$root.'/mentors/data/mentors.json';
$verifiedMentors=[];
if (is_file($mentorDataFile)) {
    $mentorData=json_decode((string)file_get_contents($mentorDataFile),true) ?: [];
    foreach ($mentorData as $m) {
        if (!empty($m['verified']) && !empty($m['url'])) $verifiedMentors[rtrim((string)$m['url'],'/').'/']=true;
    }
}
$urls=array_values(array_filter($urls,function($u) use ($verifiedMentors) {
    $path=(string)(parse_url($u,PHP_URL_PATH) ?: '/');
    if ($path==='/mentors/' || $path==='/mentors') return true;
    if (str_starts_with($path,'/mentors/')) return isset($verifiedMentors[rtrim($u,'/').'/']);
    return true;
}));
$batches=array_chunk($urls,10000);
echo 'IndexNow URLs: '.count($urls).PHP_EOL;
echo 'Batches: '.count($batches).PHP_EOL;
if ($dryRun) exit(0);
foreach ($batches as $i=>$batch) {
    $payload=json_encode(['host'=>$host,'key'=>$key,'keyLocation'=>$keyLocation,'urlList'=>$batch],JSON_UNESCAPED_SLASHES);
    $ch=curl_init($endpoint);
    curl_setopt_array($ch,[CURLOPT_POST=>true,CURLOPT_POSTFIELDS=>$payload,CURLOPT_HTTPHEADER=>['Content-Type: application/json; charset=utf-8'],CURLOPT_RETURNTRANSFER=>true,CURLOPT_TIMEOUT=>60]);
    $body=curl_exec($ch); $code=(int)curl_getinfo($ch,CURLINFO_HTTP_CODE); $err=curl_error($ch); curl_close($ch);
    echo 'Batch '.($i+1).': HTTP '.$code.($err ? ' - '.$err : '').PHP_EOL;
    if (!in_array($code,[200,202],true)) echo substr((string)$body,0,500).PHP_EOL;
    sleep(1);
}
