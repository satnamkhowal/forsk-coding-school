<?php
/** Contextual internal-link module for legacy blog articles. */
$titleText=(string)($page_title ?? '');
$keywordText=(string)($page_keywords ?? '');
$hay=strtolower($titleText.' '.$keywordText.' '.(string)($slug ?? ''));
$groups=[
  ['terms'=>['python','django','flask','pandas','numpy'], 'courses'=>[
    ['python-programming-course-jaipur.php','Python Programming Course in Jaipur'],
    ['python-full-stack-course-jaipur.php','Python Full Stack Course in Jaipur'],
    ['data-science-course-jaipur.php','Data Science Course in Jaipur']]],
  ['terms'=>['java','spring boot','spring framework','jdbc','servlet','hibernate','jpa','kafka'], 'courses'=>[
    ['java-programming-course-jaipur.php','Java Programming Course in Jaipur'],
    ['java-full-stack-course-jaipur.php','Java Full Stack Course in Jaipur'],
    ['spring-boot-course-jaipur.php','Spring Boot Course in Jaipur']]],
  ['terms'=>['javascript','react','node','express','mern','mongodb','next.js','next js','frontend','front-end'], 'courses'=>[
    ['javascript-course-jaipur.php','JavaScript Course in Jaipur'],
    ['mern-stack-course-jaipur.php','MERN Stack Course in Jaipur'],
    ['full-stack-development-course-jaipur.php','Full Stack Development Course in Jaipur']]],
  ['terms'=>['sql','mysql','postgres','database','query','normalization'], 'courses'=>[
    ['sql-course-jaipur.php','SQL Course in Jaipur'],
    ['data-analytics-course-jaipur.php','Data Analytics Course in Jaipur']]],
  ['terms'=>['excel','power bi','power query','dax','dashboard','business intelligence'], 'courses'=>[
    ['advanced-excel-course-jaipur.php','Advanced Excel Course in Jaipur'],
    ['power-bi-course-jaipur.php','Power BI Course in Jaipur'],
    ['data-analytics-course-jaipur.php','Data Analytics Course in Jaipur']]],
  ['terms'=>['data science','machine learning','regression','classification','clustering','feature engineering','statistics','eda'], 'courses'=>[
    ['data-science-course-jaipur.php','Data Science Course in Jaipur'],
    ['machine-learning-course-jaipur.php','Machine Learning Course in Jaipur'],
    ['python-programming-course-jaipur.php','Python Programming Course in Jaipur']]],
  ['terms'=>['artificial intelligence','generative ai','prompt','llm','rag','ai agent','neural network','deep learning','computer vision','nlp'], 'courses'=>[
    ['artificial-intelligence-course-jaipur.php','Artificial Intelligence Course in Jaipur'],
    ['generative-ai-course-jaipur.php','Generative AI Course in Jaipur'],
    ['machine-learning-course-jaipur.php','Machine Learning Course in Jaipur']]],
  ['terms'=>['cyber','security','ethical hacking','penetration','owasp','soc','vulnerability'], 'courses'=>[
    ['cyber-security-course-jaipur.php','Cyber Security Course in Jaipur'],
    ['ethical-hacking-course-jaipur.php','Ethical Hacking Course in Jaipur'],
    ['network-security-course-jaipur.php','Network Security Course in Jaipur']]],
  ['terms'=>['aws','azure','cloud','docker','kubernetes','devops','ci/cd','linux'], 'courses'=>[
    ['cloud-computing-course-jaipur.php','Cloud Computing Course in Jaipur'],
    ['devops-course-jaipur.php','DevOps Course in Jaipur'],
    ['aws-course-jaipur.php','AWS Course in Jaipur']]],
  ['terms'=>['testing','selenium','playwright','test case','api testing','manual testing','automation testing'], 'courses'=>[
    ['software-testing-course-jaipur.php','Software Testing Course in Jaipur'],
    ['automation-testing-course-jaipur.php','Automation Testing Course in Jaipur'],
    ['selenium-course-jaipur.php','Selenium Course in Jaipur']]],
  ['terms'=>['ui ux','ui/ux','figma','wireframe','prototype','design system','user research','graphic design'], 'courses'=>[
    ['ui-ux-design-course-jaipur.php','UI/UX Design Course in Jaipur'],
    ['figma-course-jaipur.php','Figma Course in Jaipur']]],
  ['terms'=>['seo','digital marketing','google ads','content marketing','social media','google business'], 'courses'=>[
    ['digital-marketing-course-jaipur.php','Digital Marketing Course in Jaipur'],
    ['seo-course-jaipur.php','SEO Course in Jaipur'],
    ['google-ads-course-jaipur.php','Google Ads Course in Jaipur']]],
  ['terms'=>['android','flutter','react native','mobile app','kotlin','ios'], 'courses'=>[
    ['mobile-app-development-course-jaipur.php','Mobile App Development Course in Jaipur'],
    ['flutter-course-jaipur.php','Flutter Course in Jaipur'],
    ['android-course-jaipur.php','Android Course in Jaipur']]],
  ['terms'=>['c++','cpp','c programming','data structure','dsa','algorithm'], 'courses'=>[
    ['c-plus-plus-course-jaipur.php','C++ Course in Jaipur'],
    ['c-programming-course-jaipur.php','C Programming Course in Jaipur'],
    ['programming-language-courses-jaipur.php','Programming Language Courses in Jaipur']]],
];
$selected=[];
foreach($groups as $g){
  $match=false; foreach($g['terms'] as $t){ if(str_contains($hay,$t)){ $match=true; break; } }
  if($match){ foreach($g['courses'] as $c){ if(is_file(dirname(__DIR__).'/'.$c[0])) $selected[]=$c; } break; }
}
if(!$selected){
  foreach([['programming-language-courses-jaipur.php','Programming Language Courses in Jaipur'],['full-stack-development-course-jaipur.php','Full Stack Development Course in Jaipur'],['other-it-courses-jaipur.php','Other IT Courses in Jaipur']] as $c){if(is_file(dirname(__DIR__).'/'.$c[0]))$selected[]=$c;}
}
$selected=array_slice($selected,0,3);
?>
<section class="tj-details" style="padding-top:20px;padding-bottom:45px"><div class="container"><div class="row"><div class="col-lg-8">
<h2>Continue with structured learning in Jaipur</h2>
<p>If this topic is relevant to your learning goal, the following Forsk Coding School courses provide a broader syllabus, guided practice and project-focused learning. These links are selected from the subject of this article rather than added randomly.</p>
<ul class="tj_list tj-fade-anim">
<?php foreach($selected as $c): ?><li><i class="tji-arrow-right-2"></i><a href="<?= htmlspecialchars(site_url($c[0]),ENT_QUOTES,'UTF-8') ?>"><?= htmlspecialchars($c[1],ENT_QUOTES,'UTF-8') ?></a></li><?php endforeach; ?>
</ul>
<p>For live doubt-solving, project discussion and interactive practice, see <a href="<?= htmlspecialchars(site_url('live-mentorlab.php'),ENT_QUOTES,'UTF-8') ?>">Forsk Live MentorLab</a>.</p>
</div></div></div></section>
