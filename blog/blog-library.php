<?php
/** Deterministic content helpers for the 10,000-blog knowledge base. */
if (!function_exists('forsk_pick')) {
function forsk_pick(array $items, string $key, int $offset=0): string {
    if (!$items) return '';
    $h=hexdec(substr(md5($key.'|'.$offset),0,7));
    return $items[$h % count($items)];
}}
if (!function_exists('forsk_blog_article_sections')) {
function forsk_blog_article_sections(array $b): array {
    $key=$b['slug']; $subject=$b['subject']; $cluster=$b['cluster']; $aud=$b['audience']; $goal=$b['goal'];
    $concepts=$b['concepts']; $projects=$b['projects'];
    $openers=[
      "$subject becomes easier to learn when the topic is connected to a clear practice loop instead of isolated tutorials.",
      "A useful way to approach $subject is to combine concepts, deliberate practice, small experiments and one documented project.",
      "Learning $subject is less about memorising definitions and more about understanding how each idea changes the way you solve a practical task.",
      "For $aud, $subject can feel broad at first, but a structured sequence makes the learning path much more manageable.",
      "The strongest progress in $subject usually comes from learning a concept, applying it immediately and then reviewing what went wrong."
    ];
    $practice=[
      "Keep each practice session small enough to finish, review and improve. Short feedback loops are more useful than collecting unfinished tutorials.",
      "After each concept, write a tiny example from memory. Then compare it with your notes and explain why your version works or fails.",
      "Use Git or another simple version-history habit so your work shows how a solution evolved, not only the final screenshot.",
      "When you get stuck, reduce the problem to the smallest reproducible example. This makes debugging and mentor discussions much more productive.",
      "Treat documentation as part of the project. A clear README, assumptions, test cases and screenshots make learning evidence easier to review."
    ];
    $career=[
      "For interviews and portfolio reviews, be ready to explain trade-offs: what you chose, what you rejected, what broke and how you tested the final result.",
      "A portfolio is stronger when it demonstrates reasoning. Recruiters and mentors can learn more from one well-explained project than from many copied demos.",
      "Career preparation should run alongside technical learning. Keep notes of common questions, project decisions and debugging lessons as you practise.",
      "Do not wait until the end of a course to prepare for interviews. Turn every major concept into one explanation, one example and one troubleshooting question.",
      "The goal is not to claim expertise too early; it is to build evidence that you can understand a requirement, implement a solution and communicate your reasoning."
    ];
    $intro = forsk_pick($openers,$key,1).' '.
      " This guide is designed for ".strtolower($aud)." and focuses on how to ".$b['goal_desc'].". ".
      "The examples connect the topic with the broader $cluster learning path and practical training options in Jaipur.";

    $s1=[
      'heading'=>'What to understand before you go deeper',
      'paragraphs'=>[
        "Start by identifying the role of $subject inside $cluster. Do not try to master every tool at once; first understand what problem the topic solves and what inputs, outputs and decisions are involved.",
        "A sensible foundation for this topic includes ".implode(', ',array_slice($concepts,0,3)).". Once those ideas feel comfortable, add ".implode(' and ',array_slice($concepts,3,2))." so the learning path moves from theory to repeatable workflow."
      ],
      'bullets'=>$concepts
    ];

    if ($goal==='roadmap') {
      $ghead='A practical learning roadmap';
      $gparas=[
        "Phase one should focus on vocabulary and small examples. Phase two should combine two or three concepts in the same exercise. Phase three should introduce a project where the requirements are not fully spelled out.",
        "For $aud, a good milestone is being able to rebuild a small solution without following a video step by step. That is a stronger signal of understanding than simply finishing more lessons."
      ];
    } elseif ($goal==='projects') {
      $ghead='How to turn practice into projects';
      $gparas=[
        "Choose projects that force you to make decisions rather than copy a fixed layout. Useful starting ideas include ".implode(', ',$projects).". Scope the first version tightly, then add one feature that requires debugging or refactoring.",
        "For every project, record the problem statement, assumptions, tools used, important decisions, test approach and what you would improve in a second version."
      ];
    } elseif ($goal==='interview') {
      $ghead='Interview preparation that tests understanding';
      $gparas=[
        "Prepare in three layers: explain the concept in plain language, solve a small task without notes, and discuss how the same idea appeared in one of your projects.",
        "Build a question bank around ".implode(', ',array_slice($concepts,0,4)).". Practise both correct answers and common failure cases so you can reason through unfamiliar interview variations."
      ];
    } elseif ($goal==='mistakes') {
      $ghead='Common mistakes and how to correct them';
      $gparas=[
        "A frequent mistake is moving to advanced material before basic workflows are reliable. Another is copying code or steps without predicting the result first. Both make progress look faster than it really is.",
        "Replace passive watching with checkpoints: make a prediction, implement a small change, inspect the result, explain the failure and only then look up the answer."
      ];
    } else {
      $ghead='Tools and workflow that support real practice';
      $gparas=[
        "Use only the tools needed to complete the learning task. The important part is the workflow: create, test, inspect, debug, document and repeat. Tool names change, but that loop remains valuable.",
        "As your work grows, organise files consistently, keep version history, write meaningful notes and automate repetitive checks where appropriate. This makes projects easier to review and maintain."
      ];
    }
    $s2=['heading'=>$ghead,'paragraphs'=>$gparas,'bullets'=>[]];
    $s3=['heading'=>'A repeatable weekly practice system','paragraphs'=>[
      forsk_pick($practice,$key,3),
      "A practical week can include one concept session, two guided exercises, one independent problem and one project iteration. For $aud, the exact hours matter less than preserving continuity and reviewing mistakes.",
      "Use the project ideas—".implode(', ',$projects)."—as practice contexts. You do not need to build all of them; select one that exposes the concepts you currently need to strengthen."
    ],'bullets'=>['Learn one focused concept','Rebuild a small example from memory','Solve an independent variation','Add one project feature','Document errors and the final fix']];
    $s4=['heading'=>'How to make your work portfolio-ready','paragraphs'=>[
      forsk_pick($career,$key,4),
      "For $subject, include evidence of the process: a short problem statement, screenshots or outputs where useful, clean source files, a README and a note on the decisions you made. If data or third-party services are involved, document assumptions and privacy considerations.",
      "Before calling the work complete, review it as if another learner had to continue the project. Clear naming, small functions or components, reproducible steps and sensible error handling are all part of professional practice."
    ],'bullets'=>[]];
    return [$intro,$s1,$s2,$s3,$s4];
}}
?>