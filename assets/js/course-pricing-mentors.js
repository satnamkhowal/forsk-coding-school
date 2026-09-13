(function () {
  'use strict';

  var catalog = Array.isArray(window.FORSK_COURSE_PRICING) ? window.FORSK_COURSE_PRICING : [];
  if (!catalog.length) return;

  function norm(value) {
    return String(value || '')
      .toLowerCase()
      .replace(/&/g, ' and ')
      .replace(/\+/g, ' plus ')
      .replace(/[^a-z0-9.#]+/g, ' ')
      .replace(/\s+/g, ' ')
      .trim();
  }

  function basename(value) {
    var clean = String(value || '').split('#')[0].split('?')[0];
    return clean.substring(clean.lastIndexOf('/') + 1).toLowerCase();
  }

  function formatFee(fee) {
    if (fee === null || fee === undefined || fee === '') return 'Fees on Request';
    var amount = Number(fee);
    return Number.isFinite(amount) ? '₹' + amount.toLocaleString('en-IN') : 'Fees on Request';
  }

  function findCourse(text, href) {
    var file = basename(href);
    var hay = norm((text || '') + ' ' + file.replace(/[-_]/g, ' '));
    var exact = catalog.find(function (course) { return basename(course.href) === file && file.indexOf('.php') > -1; });
    if (exact) return exact;

    var candidates = [];
    catalog.forEach(function (course) {
      var aliases = Array.isArray(course.aliases) ? course.aliases : [];
      aliases.concat([course.name, course.id]).forEach(function (alias) {
        var needle = norm(alias);
        if (needle && hay.indexOf(needle) > -1) candidates.push({ course: course, weight: needle.length });
      });
    });
    candidates.sort(function (a, b) { return b.weight - a.weight; });
    return candidates.length ? candidates[0].course : null;
  }

  function mentorHaystack(mentor) {
    var fields = [mentor.name, mentor.role, mentor.domain];
    ['skills', 'courses', 'topics', 'expertise'].forEach(function (key) {
      if (Array.isArray(mentor[key])) fields = fields.concat(mentor[key]);
    });
    return norm(fields.join(' '));
  }

  function scoreMentor(mentor, course) {
    if (!mentor || !course) return 0;
    var hay = mentorHaystack(mentor);
    var score = 0;
    var courseFile = basename(course.href);
    if (Array.isArray(mentor.courses)) {
      mentor.courses.forEach(function (item) {
        var n = norm(typeof item === 'string' ? item : (item && (item.slug || item.name || item.url)));
        if (n && (n.indexOf(norm(course.id)) > -1 || n.indexOf(norm(course.name)) > -1 || basename(n) === courseFile)) score += 80;
      });
    }
    var probes = (course.aliases || []).concat([course.name, course.category]);
    probes.forEach(function (probe) {
      var p = norm(probe);
      if (!p) return;
      if (hay.indexOf(p) > -1) score += Math.min(28, 6 + Math.floor(p.length / 2));
      p.split(' ').forEach(function (word) {
        if (word.length >= 4 && hay.indexOf(word) > -1) score += 2;
      });
    });
    return score;
  }

  function bestMentor(mentors, course, usedSlugs) {
    var ranked = mentors.map(function (mentor) {
      return { mentor: mentor, score: scoreMentor(mentor, course) - (usedSlugs && usedSlugs[mentor.slug] ? 7 : 0) };
    }).sort(function (a, b) { return b.score - a.score; });
    if (!ranked.length || ranked[0].score <= 1) return null;
    return ranked[0].mentor;
  }

  function mentorImage(mentor) {
    return mentor && mentor.image_filename ? 'mentors/images/' + encodeURIComponent(mentor.image_filename).replace(/%2F/gi, '/') : 'mentors/images/mentor-image-coming-soon.png';
  }

  function mentorUrl(mentor) {
    return mentor && mentor.slug ? 'mentors/' + encodeURIComponent(mentor.slug) + '/' : 'mentors/';
  }

  function loadMentors() {
    return fetch('mentors/data/mentors.json', { credentials: 'same-origin' })
      .then(function (response) { if (!response.ok) throw new Error('mentor-data'); return response.json(); })
      .then(function (data) { return Array.isArray(data) ? data : (Array.isArray(data.mentors) ? data.mentors : []); })
      .catch(function () { return []; });
  }

  function renderFeePanel() {
    var host = document.querySelector('.tj-course-section .container');
    if (!host || document.getElementById('forsk-course-fee-panel')) return;

    var panel = document.createElement('div');
    panel.id = 'forsk-course-fee-panel';
    panel.className = 'forsk-fee-panel';
    panel.setAttribute('aria-labelledby', 'forsk-fee-heading');

    var head = document.createElement('div');
    head.className = 'forsk-fee-panel__head';
    head.innerHTML = '<div class="forsk-fee-panel__copy"><span class="forsk-fee-panel__eyebrow">Current course fee guide</span><h2 id="forsk-fee-heading">Choose a course and check the fee</h2><p>Use the category selector to compare current course fees. Fees marked “Fees on Request” are intentionally not published until confirmed.</p></div>';

    var control = document.createElement('div');
    control.className = 'forsk-fee-panel__control';
    var label = document.createElement('label');
    label.setAttribute('for', 'forsk-fee-category');
    label.textContent = 'Filter by category';
    var select = document.createElement('select');
    select.id = 'forsk-fee-category';
    var categories = ['All courses'].concat(Array.from(new Set(catalog.map(function (course) { return course.category; }).filter(Boolean))).sort());
    categories.forEach(function (category) {
      var option = document.createElement('option');
      option.value = category === 'All courses' ? '' : category;
      option.textContent = category;
      select.appendChild(option);
    });
    control.appendChild(label); control.appendChild(select); head.appendChild(control); panel.appendChild(head);

    var wrap = document.createElement('div');
    wrap.className = 'forsk-fee-table-wrap';
    var table = document.createElement('table');
    table.className = 'forsk-fee-table';
    table.innerHTML = '<thead><tr><th>Course</th><th>Category</th><th>Current Fee</th><th>What it covers</th></tr></thead>';
    var tbody = document.createElement('tbody');

    catalog.forEach(function (course) {
      var tr = document.createElement('tr');
      tr.setAttribute('data-category', course.category || 'Other');

      var courseCell = document.createElement('td');
      var a = document.createElement('a');
      a.href = course.href || ('contact.php?course=' + encodeURIComponent(course.id));
      a.textContent = course.name;
      courseCell.appendChild(a);

      var categoryCell = document.createElement('td');
      categoryCell.textContent = course.category || 'Other';
      var feeCell = document.createElement('td');
      feeCell.className = 'forsk-fee-price';
      feeCell.textContent = formatFee(course.fee);
      var includesCell = document.createElement('td');
      includesCell.textContent = course.includes || 'Detailed syllabus available on the course page or during counselling.';

      tr.appendChild(courseCell); tr.appendChild(categoryCell); tr.appendChild(feeCell); tr.appendChild(includesCell);
      tbody.appendChild(tr);
    });
    table.appendChild(tbody); wrap.appendChild(table); panel.appendChild(wrap);

    var note = document.createElement('small');
    note.className = 'forsk-fee-note';
    note.textContent = 'Course fee may be updated for future batches. Confirm the current batch, schedule and applicable fee with Forsk Coding School before enrolment.';
    panel.appendChild(note);
    host.insertBefore(panel, host.firstChild);

    select.addEventListener('change', function () {
      Array.prototype.forEach.call(tbody.rows, function (row) {
        row.hidden = !!select.value && row.getAttribute('data-category') !== select.value;
      });
    });
  }

  function updateCourseCards(mentors) {
    document.querySelectorAll('.tj-course-item').forEach(function (card) {
      var titleLink = card.querySelector('.title a, h2 a, h3 a');
      var title = titleLink ? titleLink.textContent : card.textContent;
      var href = titleLink ? titleLink.getAttribute('href') : '';
      var course = findCourse(title, href);
      var price = card.querySelector('.course-price, .current-price, [class*="course-price"]');
      if (price) price.textContent = course ? formatFee(course.fee) : 'Fees on Request';

      if (!mentors.length || !course) return;
      var mentor = bestMentor(mentors, course);
      if (!mentor) return;
      var author = card.querySelector('.author a, .rbt-author-info a, [class*="author"] a');
      if (!author) return;
      author.href = mentorUrl(mentor);
      author.textContent = '';
      var img = document.createElement('img');
      img.src = mentorImage(mentor);
      img.alt = mentor.image_alt || (mentor.name + ' - Forsk Coding School mentor');
      img.loading = 'lazy';
      author.appendChild(img);
      author.appendChild(document.createTextNode(' ' + mentor.name));
      author.title = mentor.role || 'Forsk Coding School mentor';
    });
  }

  function attachMentorsToHomepageCourses(mentors) {
    if (!mentors.length) return;
    document.querySelectorAll('.forsk-program-card').forEach(function (card) {
      if (card.classList.contains('forsk-mentor-card') || card.querySelector('.forsk-course-mentor-note')) return;
      var courseLink = card.querySelector('a.media, h3 a, a[href*="course"]');
      var title = (card.querySelector('h3') || {}).textContent || card.textContent;
      var course = findCourse(title, courseLink ? courseLink.getAttribute('href') : '');
      if (!course) return;
      var mentor = bestMentor(mentors, course);
      if (!mentor) return;
      var body = card.querySelector('.forsk-program-body') || card;
      var note = document.createElement('div');
      note.className = 'forsk-course-mentor-note';
      var img = document.createElement('img');
      img.src = mentorImage(mentor); img.alt = ''; img.loading = 'lazy';
      var a = document.createElement('a');
      a.href = mentorUrl(mentor); a.textContent = 'Mentor: ' + mentor.name;
      note.appendChild(img); note.appendChild(a); body.appendChild(note);
    });
  }

  function renderHomepageMentors(mentors) {
    if (!mentors.length || document.querySelector('.forsk-home-mentors')) return;
    var popular = document.getElementById('popular-programs-title');
    var anchorSection = popular ? popular.closest('section') : null;
    if (!anchorSection || !anchorSection.parentNode) return;

    var preferred = [
      catalog.find(function (c) { return c.id === 'core-python'; }),
      catalog.find(function (c) { return c.id === 'core-java'; }),
      catalog.find(function (c) { return c.id === 'full-stack-javascript'; }),
      catalog.find(function (c) { return c.id === 'python-data-science'; }),
      catalog.find(function (c) { return c.id === 'machine-learning-ai'; }),
      catalog.find(function (c) { return c.id === 'digital-marketing'; })
    ].filter(Boolean);
    var used = {};
    var picks = [];
    preferred.forEach(function (course) {
      var mentor = bestMentor(mentors, course, used);
      if (mentor && !used[mentor.slug]) { used[mentor.slug] = true; picks.push(mentor); }
    });
    if (picks.length < 4) {
      mentors.some(function (mentor) {
        if (mentor && mentor.slug && !used[mentor.slug] && mentor.name && mentor.role) {
          used[mentor.slug] = true; picks.push(mentor);
        }
        return picks.length >= 6;
      });
    }
    picks = picks.slice(0, 6);
    if (!picks.length) return;

    var section = document.createElement('section');
    section.className = 'forsk-section forsk-section-soft forsk-home-mentors';
    section.setAttribute('aria-labelledby', 'home-mentors-title');
    var container = document.createElement('div');
    container.className = 'container';
    container.innerHTML = '<span class="forsk-eyebrow"><i class="tji-subtitle"></i> Learn with existing Forsk mentors</span><h2 class="forsk-section-title" id="home-mentors-title">Meet Mentors Across Popular Technology Domains</h2><p class="forsk-section-copy">Explore mentor profiles already available in the Forsk Coding School mentor directory. Use each profile to understand the mentor’s listed role and skills.</p>';
    var grid = document.createElement('div');
    grid.className = 'forsk-program-grid';

    picks.forEach(function (mentor) {
      var article = document.createElement('article');
      article.className = 'forsk-program-card forsk-mentor-card';
      var media = document.createElement('a');
      media.className = 'media'; media.href = mentorUrl(mentor);
      var image = document.createElement('img');
      image.src = mentorImage(mentor); image.alt = mentor.image_alt || (mentor.name + ' mentor profile'); image.loading = 'lazy';
      media.appendChild(image);
      var body = document.createElement('div'); body.className = 'forsk-program-body';
      var kicker = document.createElement('span'); kicker.className = 'kicker'; kicker.textContent = mentor.domain || 'Technology';
      var h3 = document.createElement('h3'); h3.textContent = mentor.name;
      var p = document.createElement('p'); p.textContent = mentor.role || 'Technology Mentor';
      var link = document.createElement('a'); link.href = mentorUrl(mentor); link.textContent = 'View mentor profile →';
      body.appendChild(kicker); body.appendChild(h3); body.appendChild(p); body.appendChild(link);
      article.appendChild(media); article.appendChild(body); grid.appendChild(article);
    });
    container.appendChild(grid);
    var all = document.createElement('div'); all.className = 'forsk-actions mt-4';
    all.innerHTML = '<a class="tj-btn-primary flip-text-wrap" href="mentors/"><span class="btn-text">Explore All Mentors</span><span class="btn-icon"><i class="tji-arrow-right-2"></i></span></a>';
    container.appendChild(all); section.appendChild(container);
    anchorSection.parentNode.insertBefore(section, anchorSection.nextSibling);
  }

  document.addEventListener('DOMContentLoaded', function () {
    var path = location.pathname.toLowerCase();
    var isCourses = /\/courses\.php$/.test(path) || path.endsWith('/courses');
    var isHome = path === '/' || /\/default\.php$/.test(path) || /\/index\.php$/.test(path);

    if (isCourses) renderFeePanel();
    if (!isCourses && !isHome) return;

    loadMentors().then(function (mentors) {
      if (isCourses) updateCourseCards(mentors);
      if (isHome) {
        attachMentorsToHomepageCourses(mentors);
        renderHomepageMentors(mentors);
      }
    });

    if (isCourses) updateCourseCards([]);
  });
})();
