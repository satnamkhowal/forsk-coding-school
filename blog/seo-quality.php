<?php
/**
 * Forsk Coding School blog SEO quality layer.
 *
 * Purpose:
 * - keep 10,000 generated URLs available without force-indexing thin permutations;
 * - prioritize intent/audience combinations that are meaningfully distinct;
 * - generate cleaner titles/meta descriptions centrally;
 * - add audience-specific and goal-specific learning value;
 * - keep internal links focused on indexable guides.
 */

if (!function_exists('forsk_blog_quality_data')) {
function forsk_blog_quality_data(): array {
    static $data = null;
    if ($data !== null) return $data;
    $file = __DIR__ . '/quality-data.php';
    $data = is_file($file) ? (require $file) : ['indexable'=>[], 'by_subject'=>[], 'hubs'=>[]];
    return is_array($data) ? $data : ['indexable'=>[], 'by_subject'=>[], 'hubs'=>[]];
}}

if (!function_exists('forsk_blog_is_indexable')) {
function forsk_blog_is_indexable(array $blog): bool {
    static $overrides = null;
    if ($overrides === null) {
        $file=__DIR__.'/indexing-overrides.php';
        $overrides=is_file($file) ? (require $file) : [];
        if (!is_array($overrides)) $overrides=[];
    }
    $slug=(string)($blog['slug'] ?? '');
    if ($slug!=='' && array_key_exists($slug,$overrides)) return (bool)$overrides[$slug];
    $goal = (string)($blog['goal'] ?? '');
    $aud = (string)($blog['audience'] ?? '');
    $allow = [
        'roadmap' => ['Beginners'],
        'projects' => ['Beginners'],
        'interview' => ['Freshers'],
        'mistakes' => ['Beginners'],
        'tools' => ['Working Professionals'],
    ];
    return isset($allow[$goal]) && in_array($aud, $allow[$goal], true);
}}

if (!function_exists('forsk_blog_meta_trim')) {
function forsk_blog_meta_trim(string $text, int $max=158): string {
    $text = trim(preg_replace('/\s+/', ' ', $text));
    if (strlen($text) <= $max) return rtrim($text, " ,;:-") . (preg_match('/[.!?]$/u',$text) ? '' : '.');
    $cut = substr($text, 0, $max-1);
    $space = strrpos($cut, ' ');
    if ($space !== false && $space > $max-28) $cut = substr($cut, 0, $space);
    return rtrim($cut, " ,;:-.") . '.';
}}

if (!function_exists('forsk_blog_seo_title')) {
function forsk_blog_seo_title(array $b): string {
    $s = trim((string)$b['subject']);
    $a = trim((string)$b['audience']);
    $g = (string)($b['goal'] ?? '');
    switch ($g) {
        case 'roadmap':
            $title = match ($a) {
                'Beginners' => "$s: Beginner Roadmap from Fundamentals to Projects",
                'Freshers' => "$s: Job-Ready Learning Roadmap for Freshers",
                'Career Switchers' => "$s: Career-Switch Learning Roadmap",
                'Learners in Jaipur' => "$s Roadmap for Learners in Jaipur",
                'Working Professionals in Jaipur' => "$s Upskilling Roadmap for Jaipur Professionals",
                default => "$s Learning Roadmap for $a",
            };
            break;
        case 'projects':
            $title = "$s Project Ideas and Practice Plan for $a";
            break;
        case 'interview':
            $title = "$s Interview Preparation Guide for $a";
            break;
        case 'mistakes':
            $title = "$s: Common Mistakes $a Should Avoid";
            break;
        case 'tools':
            $title = "$s Tools, Workflow and Skills Guide for $a";
            break;
        default:
            $title = "$s Practical Guide for $a";
    }
    // Keep the SERP title compact; H1 can still use the full version if needed.
    if (strlen($title) > 68) {
        $short = match ($g) {
            'roadmap' => "$s Roadmap for $a",
            'projects' => "$s Projects for $a",
            'interview' => "$s Interview Guide for $a",
            'mistakes' => "$s Mistakes to Avoid for $a",
            'tools' => "$s Workflow Guide for $a",
            default => "$s Guide for $a",
        };
        $title = $short;
    }
    return $title;
}}

if (!function_exists('forsk_blog_meta_description')) {
function forsk_blog_meta_description(array $b): string {
    $s = trim((string)$b['subject']);
    $a = strtolower(trim((string)$b['audience']));
    $g = (string)($b['goal'] ?? '');
    $text = match ($g) {
        'roadmap' => "Learn $s with a step-by-step roadmap for $a, including core concepts, practice milestones, project ideas and relevant Forsk courses in Jaipur.",
        'projects' => "Explore practical $s project ideas for $a, with scope, workflow, portfolio tips, common pitfalls and relevant Forsk Coding School courses in Jaipur.",
        'interview' => "Prepare for $s interviews as $a with concept checks, practice questions, project discussion tips and relevant Forsk Coding School learning paths in Jaipur.",
        'mistakes' => "Avoid common $s learning mistakes as $a with practical fixes, debugging habits, project checkpoints and relevant Forsk Coding School courses in Jaipur.",
        'tools' => "Understand the tools and workflow for $s as $a, including practice routines, project evidence, decision points and relevant Forsk courses in Jaipur.",
        default => "Learn $s with practical examples, projects, workflow guidance and relevant Forsk Coding School courses in Jaipur.",
    };
    return forsk_blog_meta_trim($text, 158);
}}

if (!function_exists('forsk_blog_audience_profile')) {
function forsk_blog_audience_profile(string $aud): array {
    $profiles = [
        'Beginners' => ['starting from first principles','avoid skipping foundations','a small guided exercise before an independent variation'],
        'College Students' => ['balancing coursework with portfolio building','connect theory to demonstrable projects','one semester-friendly project with a clear README'],
        'Freshers' => ['building job-ready evidence without overstating experience','turn concepts into interview-ready explanations','one portfolio project plus a troubleshooting story'],
        'Working Professionals' => ['upskilling around an existing work schedule','focus on reusable workflows and measurable outcomes','a work-like project completed in short weekly blocks'],
        'Career Switchers' => ['translating prior-domain strengths into a technical portfolio','learn the minimum foundations before specialization','one project tied to a familiar business problem'],
        'BCA Students' => ['strengthening practical depth alongside the degree','connect classroom concepts with implementation','one Git-based project with test cases'],
        'BTech Students' => ['turning engineering fundamentals into implementation evidence','practice system design and debugging habits','one project that includes performance or reliability checks'],
        'MCA Students' => ['building advanced practical depth and project ownership','move beyond syntax into architecture and decisions','one end-to-end project with documentation'],
        'Non-Technical Learners' => ['building confidence without assuming a technical background','use plain-language models before tools','one guided project with clearly explained steps'],
        'Self-Taught Learners' => ['converting scattered tutorials into a structured path','use checkpoints to expose knowledge gaps','rebuild one project without copying a tutorial'],
        'Internship Seekers' => ['showing readiness for supervised real-world work','demonstrate reliability, Git habits and communication','one compact project that can be reviewed quickly'],
        'Placement Aspirants' => ['preparing for screening rounds and project discussions','pair concept revision with timed practice','one project you can explain end to end'],
        'Startup Builders' => ['learning enough to prototype and make technical trade-offs','prioritize validation, maintainability and speed','one MVP-style build with a documented next-step plan'],
        'Freelancers' => ['delivering repeatable client-facing outcomes','practice scoping, handoff and documentation','one portfolio sample with clear deliverables'],
        'Junior Developers' => ['moving from task execution to stronger engineering judgment','practice debugging, testing and code review habits','one refactoring or integration project'],
        'Technology Professionals' => ['adding adjacent skills without relearning everything','focus on system boundaries and transferable patterns','one cross-functional proof-of-concept'],
        'Final-Year Students' => ['turning final-year effort into placement evidence','align projects with interview stories','one polished project with architecture notes'],
        'Job Seekers' => ['building evidence that supports applications','focus on demonstrable skills and clear explanations','one targeted portfolio project plus interview notes'],
        'Learners in Jaipur' => ['combining self-practice with local mentor access','use live doubt-solving when blockers persist','one project reviewed through a structured mentor session'],
        'Working Professionals in Jaipur' => ['upskilling with flexible local or online support','prioritize efficient practice and mentor feedback','one work-like project reviewed in short iterations'],
    ];
    return $profiles[$aud] ?? ['building practical understanding','learn foundations before advanced tools','one small project with clear documentation'];
}}

if (!function_exists('forsk_blog_quick_answer')) {
function forsk_blog_quick_answer(array $b): string {
    $p = forsk_blog_audience_profile((string)$b['audience']);
    $concepts = array_values($b['concepts'] ?? []);
    $c1 = $concepts[0] ?? $b['subject'];
    $c2 = $concepts[1] ?? 'hands-on practice';
    return "For {$b['audience']}, the fastest reliable way to improve at {$b['subject']} is to start with $c1, connect it to $c2, practise a small variation without copying, and then document one project that proves what you can do. The priority is {$p[1]}, not rushing through more tutorials.";
}}

if (!function_exists('forsk_blog_learning_plan')) {
function forsk_blog_learning_plan(array $b): array {
    $concepts = array_values($b['concepts'] ?? []);
    $projects = array_values($b['projects'] ?? []);
    $p = forsk_blog_audience_profile((string)$b['audience']);
    $c = fn($i,$fallback) => $concepts[$i] ?? $fallback;
    $proj = $projects[0] ?? 'small practical project';
    return [
        ['Foundation', "Understand {$c(0,'the core concept')} and explain it in your own words."],
        ['Guided practice', "Combine {$c(1,'a second concept')} with a small worked example and inspect the output."],
        ['Independent variation', "Change one requirement, debug the result and record what caused the failure."],
        ['Portfolio evidence', "Build a $proj, add a README, test cases or outputs, and explain the decisions you made."],
        ['Review', "Use {$p[2]} and list the next two gaps you need to strengthen."],
    ];
}}

if (!function_exists('forsk_blog_goal_module')) {
function forsk_blog_goal_module(array $b): array {
    $s=$b['subject']; $a=$b['audience']; $projects=array_values($b['projects'] ?? []); $concepts=array_values($b['concepts'] ?? []);
    $g=(string)($b['goal'] ?? '');
    if ($g==='projects') {
        return ['heading'=>'Project blueprint you can actually finish','intro'=>"For $a, choose one $s project with a narrow first version. A finished, explained project is more useful than several half-built demos.",'items'=>[
            'Problem statement: define one user or business problem in two sentences.',
            'First version: use only the minimum features needed to prove the workflow.',
            'Evidence: save outputs, tests, screenshots or logs that show the result.',
            'Iteration: add one requirement that forces you to debug or refactor.',
            'Portfolio note: explain one trade-off and one improvement you would make next.'
        ]];
    }
    if ($g==='interview') {
        $c1=$concepts[0]??$s; $c2=$concepts[1]??'workflow';
        return ['heading'=>'Interview drill: explain, implement, troubleshoot','intro'=>"A strong $s interview answer should connect theory to something you have built or debugged.",'items'=>[
            "Explain $c1 in plain language without jargon.",
            "Write or sketch a small example involving $c2 without notes.",
            'Describe a failure case and how you would isolate the cause.',
            'Connect the concept to one portfolio project and explain your decision.',
            'Finish with a trade-off: when would you choose a different approach?'
        ]];
    }
    if ($g==='mistakes') {
        return ['heading'=>'Mistake-recovery checklist','intro'=>"Use this checklist whenever progress in $s feels fast but your independent problem-solving is not improving.",'items'=>[
            'Stop copying before you can predict what the next step will do.',
            'Reduce errors to the smallest reproducible example before searching for a fix.',
            'Rebuild a concept from memory the next day.',
            'Keep a short error log: symptom, root cause, fix and prevention.',
            'Do not move to the next advanced topic until you can complete one independent variation.'
        ]];
    }
    if ($g==='tools') {
        return ['heading'=>'How to choose tools without tool-hopping','intro'=>"For $s, tools should support the workflow rather than become the learning goal themselves.",'items'=>[
            'Choose the simplest tool that lets you complete and inspect the task.',
            'Prefer tools with official documentation and reproducible setup steps.',
            'Use version control or change history for meaningful project work.',
            'Automate repetitive checks only after you understand the manual workflow.',
            'Evaluate a new tool by the problem it solves, integration cost and maintainability.'
        ]];
    }
    return ['heading'=>'Milestones that show real progress','intro'=>"For $a, a $s roadmap should be measured by independent capability, not only course completion.",'items'=>[
        'You can explain the purpose of the core concepts without reading notes.',
        'You can complete a small exercise from a blank file or workspace.',
        'You can diagnose at least one common failure without immediately copying a solution.',
        'You can build and document one compact project.',
        'You can explain what you would improve in a second version.'
    ]];
}}

if (!function_exists('forsk_blog_official_resources')) {
function forsk_blog_official_resources(array $b): array {
    $cluster = strtolower((string)($b['cluster'] ?? ''));
    $cat = strtolower((string)($b['category'] ?? ''));
    $s = strtolower((string)($b['subject'] ?? ''));
    if (str_contains($cluster,'python')) return [['Python documentation','https://docs.python.org/3/']];
    if (str_contains($cluster,'java') || str_contains($s,'java')) return [['Java documentation','https://docs.oracle.com/en/java/']];
    if (str_contains($s,'javascript') || str_contains($s,'dom') || str_contains($s,'browser')) return [['MDN Web Docs','https://developer.mozilla.org/']];
    if (str_contains($s,'react')) return [['React documentation','https://react.dev/']];
    if (str_contains($s,'node') || str_contains($s,'express')) return [['Node.js documentation','https://nodejs.org/docs/latest/api/']];
    if (str_contains($s,'mongodb')) return [['MongoDB documentation','https://www.mongodb.com/docs/']];
    if (str_contains($s,'sql') || str_contains($s,'database')) return [['PostgreSQL documentation','https://www.postgresql.org/docs/']];
    if (str_contains($s,'excel') || str_contains($s,'power bi') || str_contains($s,'power query') || str_contains($s,'dax')) return [['Microsoft Learn','https://learn.microsoft.com/']];
    if (str_contains($s,'pandas')) return [['pandas documentation','https://pandas.pydata.org/docs/']];
    if (str_contains($s,'machine learning') || str_contains($s,'supervised') || str_contains($s,'unsupervised') || str_contains($s,'feature engineering')) return [['scikit-learn documentation','https://scikit-learn.org/stable/']];
    if (str_contains($s,'cyber') || str_contains($s,'security')) return [['OWASP','https://owasp.org/']];
    if (str_contains($s,'aws')) return [['AWS documentation','https://docs.aws.amazon.com/']];
    if (str_contains($s,'azure')) return [['Microsoft Azure documentation','https://learn.microsoft.com/azure/']];
    if (str_contains($s,'docker')) return [['Docker documentation','https://docs.docker.com/']];
    if (str_contains($s,'kubernetes')) return [['Kubernetes documentation','https://kubernetes.io/docs/']];
    if (str_contains($s,'selenium')) return [['Selenium documentation','https://www.selenium.dev/documentation/']];
    if (str_contains($s,'figma') || str_contains($cat,'design')) return [['Figma Help Center','https://help.figma.com/']];
    if (str_contains($s,'seo') || str_contains($s,'google business') || str_contains($cat,'digital marketing')) return [['Google Search Central','https://developers.google.com/search/docs']];
    if (str_contains($s,'android')) return [['Android Developers','https://developer.android.com/']];
    if (str_contains($s,'flutter')) return [['Flutter documentation','https://docs.flutter.dev/']];
    if (str_contains($s,'react native')) return [['React Native documentation','https://reactnative.dev/docs/getting-started']];
    if (str_contains($cat,'ai') || str_contains($s,'ai ') || str_starts_with($s,'ai ')) return [['NIST AI Risk Management Framework','https://www.nist.gov/itl/ai-risk-management-framework']];
    return [];
}}

if (!function_exists('forsk_blog_related_indexable')) {
function forsk_blog_related_indexable(array $blog, int $limit=5): array {
    $data=forsk_blog_quality_data();
    $indexable=$data['indexable'] ?? [];
    $out=[]; $seen=[];
    foreach (($blog['related'] ?? []) as $r) {
        $slug=$r['slug'] ?? '';
        if ($slug && isset($indexable[$slug]) && $slug !== ($blog['slug'] ?? '')) {
            $r['title']=$indexable[$slug]; $out[]=$r; $seen[$slug]=true;
            if (count($out)>=$limit) return $out;
        }
    }
    $subject=(string)($blog['subject'] ?? '');
    foreach (($data['by_subject'][$subject] ?? []) as $r) {
        $slug=$r['slug'] ?? '';
        if (!$slug || $slug===($blog['slug']??'') || isset($seen[$slug])) continue;
        $out[]=['slug'=>$slug,'title'=>$r['title'] ?? $slug]; $seen[$slug]=true;
        if (count($out)>=$limit) break;
    }
    return $out;
}}

if (!function_exists('forsk_blog_topic_hub')) {
function forsk_blog_topic_hub(array $blog): ?array {
    $data=forsk_blog_quality_data();
    $subject=(string)($blog['subject'] ?? '');
    return $data['hubs'][$subject] ?? null;
}}
?>
