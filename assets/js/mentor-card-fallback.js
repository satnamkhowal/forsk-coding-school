(function () {
  'use strict';

  function norm(value) {
    return String(value || '').toLowerCase().replace(/[^a-z0-9+#.]+/g, ' ').replace(/\s+/g, ' ').trim();
  }

  function usefulWords(value) {
    var stop = {course:1, courses:1, jaipur:1, training:1, development:1, programming:1, forsk:1, coding:1, school:1, beginner:1, advanced:1, with:1, and:1, the:1, for:1};
    return norm(value).split(' ').filter(function (word) { return word.length >= 3 && !stop[word]; });
  }

  function mentorText(mentor) {
    var parts = [mentor.name, mentor.role, mentor.domain];
    ['skills', 'courses', 'topics', 'expertise'].forEach(function (key) {
      if (Array.isArray(mentor[key])) parts = parts.concat(mentor[key]);
    });
    return norm(parts.join(' '));
  }

  function findMentor(mentors, title, category) {
    var titleWords = usefulWords(title);
    var categoryWords = usefulWords(category);
    var ranked = mentors.map(function (mentor) {
      var hay = mentorText(mentor);
      var score = 0;
      titleWords.forEach(function (word) { if (hay.indexOf(word) > -1) score += word.length >= 7 ? 7 : 4; });
      categoryWords.forEach(function (word) { if (hay.indexOf(word) > -1) score += 3; });
      return { mentor: mentor, score: score };
    }).sort(function (a, b) { return b.score - a.score; });
    return ranked.length && ranked[0].score > 0 ? ranked[0].mentor : null;
  }

  function imageUrl(mentor) {
    return mentor && mentor.image_filename ? 'mentors/images/' + encodeURIComponent(mentor.image_filename).replace(/%2F/gi, '/') : 'mentors/images/mentor-image-coming-soon.png';
  }

  function profileUrl(mentor) {
    return mentor && mentor.slug ? 'mentors/' + encodeURIComponent(mentor.slug) + '/' : 'mentors/';
  }

  function setAuthor(author, mentor, fallbackQuery) {
    author.textContent = '';
    if (!mentor) {
      author.href = 'mentors/?q=' + encodeURIComponent(fallbackQuery || 'technology');
      author.textContent = 'Explore Forsk Mentors';
      author.title = 'Find a relevant Forsk Coding School mentor';
      return;
    }
    author.href = profileUrl(mentor);
    var image = document.createElement('img');
    image.src = imageUrl(mentor);
    image.alt = mentor.image_alt || (mentor.name + ' mentor profile');
    image.loading = 'lazy';
    author.appendChild(image);
    author.appendChild(document.createTextNode(' ' + mentor.name));
    author.title = mentor.role || 'Forsk Coding School mentor';
  }

  function run() {
    var path = location.pathname.toLowerCase();
    var eligible = path === '/' || /\/(default|index|courses)\.php$/.test(path) || path.endsWith('/courses');
    if (!eligible) return;

    fetch('mentors/data/mentors.json', { credentials: 'same-origin' })
      .then(function (response) { if (!response.ok) throw new Error('mentor-data'); return response.json(); })
      .then(function (data) {
        var mentors = Array.isArray(data) ? data : (Array.isArray(data.mentors) ? data.mentors : []);
        if (!mentors.length) return;

        document.querySelectorAll('.tj-course-item').forEach(function (card) {
          var author = card.querySelector('.author a, .rbt-author-info a, [class*="author"] a');
          if (!author || /^mentors\//.test(author.getAttribute('href') || '')) return;
          var titleNode = card.querySelector('.title, h2, h3');
          var categoryNode = card.querySelector('.tj-cat, .rbt-badge-5, [class*="categor"]');
          var title = titleNode ? titleNode.textContent : '';
          var category = categoryNode ? categoryNode.textContent : '';
          setAuthor(author, findMentor(mentors, title, category), title || category);
        });

        document.querySelectorAll('.forsk-program-card').forEach(function (card) {
          if (card.classList.contains('forsk-mentor-card') || card.querySelector('.forsk-course-mentor-note')) return;
          var titleNode = card.querySelector('h3, h2');
          if (!titleNode) return;
          var mentor = findMentor(mentors, titleNode.textContent, (card.querySelector('.kicker') || {}).textContent || '');
          var body = card.querySelector('.forsk-program-body') || card;
          var note = document.createElement('div');
          note.className = 'forsk-course-mentor-note';
          if (mentor) {
            var image = document.createElement('img'); image.src = imageUrl(mentor); image.alt = ''; image.loading = 'lazy';
            var link = document.createElement('a'); link.href = profileUrl(mentor); link.textContent = 'Mentor: ' + mentor.name;
            note.appendChild(image); note.appendChild(link);
          } else {
            var fallback = document.createElement('a'); fallback.href = 'mentors/?q=' + encodeURIComponent(titleNode.textContent); fallback.textContent = 'Explore relevant mentors →'; note.appendChild(fallback);
          }
          body.appendChild(note);
        });
      })
      .catch(function () {});
  }

  if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', run);
  else run();
})();
