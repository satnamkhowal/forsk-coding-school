<?php
/**
 * Central course pricing catalog for Forsk Coding School.
 *
 * Keep public fee changes in this file so homepage/course UI does not need
 * hard-coded prices. A null fee intentionally renders as "Fees on Request".
 */
$FORSK_COURSE_PRICING = [
    ['id' => 'c-programming', 'name' => 'C Programming', 'fee' => 4000, 'category' => 'Programming', 'href' => 'c-programming-course-jaipur.php', 'aliases' => ['c programming']],
    ['id' => 'cpp-programming', 'name' => 'C++ Programming', 'fee' => 4000, 'category' => 'Programming', 'href' => 'cpp-programming-course-jaipur.php', 'aliases' => ['c++', 'cpp']],
    ['id' => 'dsa-cpp', 'name' => 'DSA with C++', 'fee' => 10000, 'category' => 'DSA', 'href' => 'contact.php?course=dsa-cpp', 'aliases' => ['dsa with c++', 'data structures c++']],
    ['id' => 'dsa-java', 'name' => 'DSA with Java', 'fee' => 10000, 'category' => 'DSA', 'href' => 'contact.php?course=dsa-java', 'aliases' => ['dsa with java', 'data structures java']],
    ['id' => 'dsa-python', 'name' => 'DSA with Python', 'fee' => 10000, 'category' => 'DSA', 'href' => 'contact.php?course=dsa-python', 'aliases' => ['dsa with python', 'data structures python']],
    ['id' => 'dsa-javascript', 'name' => 'DSA with JavaScript', 'fee' => 10000, 'category' => 'DSA', 'href' => 'contact.php?course=dsa-javascript', 'aliases' => ['dsa with javascript', 'data structures javascript']],

    ['id' => 'core-java', 'name' => 'Core Java Programming', 'fee' => 6500, 'category' => 'Java', 'href' => 'java-programming-course-jaipur.php', 'aliases' => ['core java', 'java programming']],
    ['id' => 'csharp-dotnet', 'name' => 'C# / .NET Programming', 'fee' => 7500, 'category' => '.NET', 'href' => 'dot-net-course-jaipur.php', 'aliases' => ['c#', 'c sharp', '.net', 'dot net']],
    ['id' => 'advanced-java', 'name' => 'Advanced Java', 'fee' => 8000, 'category' => 'Java', 'href' => 'advanced-java-course-jaipur.php', 'aliases' => ['advanced java']],
    ['id' => 'spring-boot-hibernate', 'name' => 'Java Spring Boot + Hibernate', 'fee' => 8000, 'category' => 'Java', 'href' => 'spring-boot-course-jaipur.php', 'aliases' => ['spring boot', 'springboot', 'spring boot hibernate']],
    ['id' => 'spring-framework', 'name' => 'Spring Framework', 'fee' => 5500, 'category' => 'Java', 'href' => 'spring-framework-course-jaipur.php', 'aliases' => ['spring framework']],
    ['id' => 'hibernate', 'name' => 'Hibernate', 'fee' => 2500, 'category' => 'Java', 'href' => 'hibernate-course-jaipur.php', 'aliases' => ['hibernate']],
    ['id' => 'java-full-stack', 'name' => 'Java Full Stack', 'fee' => 22500, 'category' => 'Full Stack', 'href' => 'java-full-stack-development-course-jaipur.php', 'aliases' => ['java full stack', 'full stack java']],

    ['id' => 'advanced-javascript', 'name' => 'Advanced JavaScript Basics', 'fee' => 4000, 'category' => 'JavaScript', 'href' => 'javascript-course-jaipur.php', 'aliases' => ['advanced javascript', 'javascript basics', 'javascript']],
    ['id' => 'react-js', 'name' => 'React.js', 'fee' => 8500, 'category' => 'JavaScript', 'href' => 'react-js-course-jaipur.php', 'aliases' => ['react.js', 'react js', 'react']],
    ['id' => 'node-js', 'name' => 'Node.js', 'fee' => 8500, 'category' => 'JavaScript', 'href' => 'node-js-course-jaipur.php', 'aliases' => ['node.js', 'node js', 'node']],
    ['id' => 'frontend-react', 'name' => 'Front-end Development with React.js', 'fee' => 20000, 'category' => 'Full Stack', 'href' => 'front-end-development-course-jaipur.php', 'aliases' => ['front end react', 'frontend react', 'front-end development']],
    ['id' => 'full-stack-javascript', 'name' => 'Full Stack JavaScript (React + Node)', 'fee' => 28500, 'category' => 'Full Stack', 'href' => 'full-stack-development-course-jaipur.php', 'aliases' => ['full stack javascript', 'mern', 'mean stack', 'full stack development']],
    ['id' => 'web-designing', 'name' => 'Web Designing', 'fee' => 7500, 'category' => 'Web', 'href' => 'web-designing-course-jaipur.php', 'aliases' => ['web designing', 'web design']],

    ['id' => 'sql', 'name' => 'SQL & Relational Databases', 'fee' => 7000, 'category' => 'Databases', 'href' => 'sql-course-jaipur.php', 'aliases' => ['sql', 'mysql', 'postgresql', 'oracle', 'mariadb'], 'includes' => 'MySQL, PostgreSQL, Oracle, MariaDB'],
    ['id' => 'nosql', 'name' => 'NoSQL Databases', 'fee' => null, 'category' => 'Databases', 'href' => 'contact.php?course=nosql', 'aliases' => ['nosql', 'mongodb', 'elasticsearch', 'druid', 'cassandra', 'dynamodb'], 'includes' => 'MongoDB, Elasticsearch, Apache Druid, Cassandra, DynamoDB'],

    ['id' => 'core-python', 'name' => 'Core Python', 'fee' => 7500, 'category' => 'Python', 'href' => 'python-programming-course-jaipur.php', 'aliases' => ['core python', 'python programming'], 'includes' => 'Python, NumPy, Pandas, Matplotlib'],
    ['id' => 'python-data-science', 'name' => 'Python with Data Science', 'fee' => 15000, 'category' => 'Data Science', 'href' => 'data-science-course-jaipur.php', 'aliases' => ['python data science', 'data science'], 'includes' => 'Python data-science stack, TensorFlow, PyTorch, OpenAI libraries/APIs'],
    ['id' => 'machine-learning-ai', 'name' => 'Machine Learning + AI', 'fee' => 25000, 'category' => 'AI / ML', 'href' => 'machine-learning-course-jaipur.php', 'aliases' => ['machine learning', 'artificial intelligence', 'machine learning ai'], 'includes' => 'Python, data-science libraries, ML concepts and AI concepts'],
    ['id' => 'system-design', 'name' => 'System Design', 'fee' => 7500, 'category' => 'Computer Science', 'href' => 'system-design-course-jaipur.php', 'aliases' => ['system design']],
    ['id' => 'operating-system', 'name' => 'Operating Systems', 'fee' => 10000, 'category' => 'Computer Science', 'href' => 'operating-system-course-jaipur.php', 'aliases' => ['operating system', 'operating systems', 'os course']],

    ['id' => 'digital-marketing', 'name' => 'Complete Digital Marketing', 'fee' => 30000, 'category' => 'Digital Marketing', 'href' => 'digital-marketing-course-jaipur.php', 'aliases' => ['complete digital marketing', 'digital marketing']],
    ['id' => 'seo-wordpress', 'name' => 'On-page SEO + WordPress Website', 'fee' => 10000, 'category' => 'Digital Marketing', 'href' => 'seo-course-jaipur.php', 'aliases' => ['seo', 'on page seo', 'seo wordpress']],
    ['id' => 'smo-paid-social', 'name' => 'SMO + Paid Social Advertising', 'fee' => 10000, 'category' => 'Digital Marketing', 'href' => 'social-media-marketing-course-jaipur.php', 'aliases' => ['smo', 'social media optimization', 'social media marketing']],
    ['id' => 'creative-content', 'name' => 'Canva + Video Editing + Content Writing', 'fee' => 10000, 'category' => 'Digital Marketing', 'href' => 'contact.php?course=creative-content', 'aliases' => ['canva', 'video editing', 'content writing']],
    ['id' => 'google-ads', 'name' => 'Google Ads', 'fee' => 5000, 'category' => 'Digital Marketing', 'href' => 'google-ads-course-jaipur.php', 'aliases' => ['google ads', 'google ad']],
    ['id' => 'meta-ads', 'name' => 'Meta Ads', 'fee' => 5000, 'category' => 'Digital Marketing', 'href' => 'meta-ads-course-jaipur.php', 'aliases' => ['meta ads', 'facebook ads', 'instagram ads']],
    ['id' => 'wordpress-development', 'name' => 'WordPress Website Development', 'fee' => 6500, 'category' => 'Web', 'href' => 'wordpress-development-course-jaipur.php', 'aliases' => ['wordpress development', 'wordpress website']],
    ['id' => 'shopify', 'name' => 'Shopify Development', 'fee' => 25000, 'category' => 'Web', 'href' => 'shopify-course-jaipur.php', 'aliases' => ['shopify', 'shopify development']],
    ['id' => 'email-marketing', 'name' => 'Email Marketing', 'fee' => 10000, 'category' => 'Digital Marketing', 'href' => 'email-marketing-course-jaipur.php', 'aliases' => ['email marketing']],
    ['id' => 'whatsapp-marketing', 'name' => 'WhatsApp Marketing', 'fee' => null, 'category' => 'Digital Marketing', 'href' => 'whatsapp-marketing-course-jaipur.php', 'aliases' => ['whatsapp marketing', 'whatsapp business marketing']],
];
