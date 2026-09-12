<?php
/**
 * Rebuild generated-blog index flags and blog sitemap after manual overrides.
 * CLI usage from project root:
 *   php tools/blog-seo-refresh.php
 */
if (PHP_SAPI !== 'cli') { http_response_code(403); exit("CLI only\n"); }
$root=dirname(__DIR__);
$blogDir=$root.'/blog';
$indexFile=$blogDir.'/blog-index.json';
$hubsFile=$blogDir.'/topic-hubs.json';
$overrideFile=$blogDir.'/indexing-overrides.php';
if (!is_file($indexFile)) exit("Missing blog-index.json\n");
$data=json_decode((string)file_get_contents($indexFile),true);
$hubs=json_decode((string)file_get_contents($hubsFile),true) ?: [];
$overrides=is_file($overrideFile) ? (require $overrideFile) : [];
$legacyMapFile=$blogDir.'/legacy-canonical-map.php';
$legacyMap=is_file($legacyMapFile) ? (require $legacyMapFile) : [];
if(!is_array($legacyMap))$legacyMap=[];
if(!is_array($data)||!is_array($overrides)) exit("Invalid input data\n");
$allow=[
 'Practical Roadmap'=>['Beginners'],
 'Project Ideas and Practice Plan'=>['Beginners'],
 'Interview Preparation Guide'=>['Freshers'],
 'Common Learning Mistakes to Avoid'=>['Beginners'],
 'Tools, Workflow and Skills Guide'=>['Working Professionals'],
];
$indexable=0;$held=0;$legacy=0;
foreach($data as &$e){
 if(($e['source']??'')==='existing'){ $e['indexable']=!isset($legacyMap[(string)($e['slug']??'')]); $legacy++; continue; }
 $slug=(string)($e['slug']??'');
 if(array_key_exists($slug,$overrides)) $ok=(bool)$overrides[$slug];
 else $ok=in_array((string)($e['audience']??''),$allow[(string)($e['intent']??'')]??[],true);
 $e['indexable']=$ok; if($ok)$indexable++;else$held++;
}
unset($e);
file_put_contents($indexFile,json_encode($data,JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE));
$urls=['https://forskcodingschool.com/blog/'];
foreach($data as $e){ if(($e['indexable']??false)===true) $urls[]='https://forskcodingschool.com/blog/'.trim($e['slug'],'/').'/'; }
foreach($hubs as $h){ if(!empty($h['slug']))$urls[]='https://forskcodingschool.com/blog/'.trim($h['slug'],'/').'/'; }
$urls=array_values(array_unique($urls));
$xml=['<?xml version="1.0" encoding="UTF-8"?>','<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'];
foreach($urls as $u){$xml[]='  <url>';$xml[]='    <loc>'.htmlspecialchars($u,ENT_XML1|ENT_QUOTES,'UTF-8').'</loc>';$xml[]='    <lastmod>'.date('Y-m-d').'</lastmod>';$xml[]='  </url>';}
$xml[]='</urlset>';
file_put_contents($blogDir.'/blogs-sitemap.xml',implode("\n",$xml)."\n");
echo "Blog SEO refresh complete\n";
echo "Legacy preserved: $legacy\n";
echo "Generated indexable: $indexable\n";
echo "Generated held noindex: $held\n";
echo "Topic hubs: ".count($hubs)."\n";
echo "Blog sitemap URLs: ".count($urls)."\n";
?>
