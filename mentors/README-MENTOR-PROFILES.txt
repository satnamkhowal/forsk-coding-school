FORSK CODING SCHOOL - 500 MENTOR PROFILE PACKAGE
=================================================

WHAT IS INCLUDED
----------------
- 500 mentor profile URLs under /mentors/<seo-slug>/
- One shared profile template: /mentors/profile-template.php
- Central mentor data: /mentors/data/mentors.json
- Mentor directory: /mentors/
- 20 generated mentor images in /assets/images/mentors/
- 480 reserved/pending SEO image filenames
- mentor-links.csv and mentor-links.html
- image-manifest.csv
- pending-mentor-images.csv
- mentors-sitemap-draft.xml

IMAGE WORKFLOW
--------------
Each mentor page already points to its final SEO image filename. If that image does not yet exist, the page displays:
  assets/images/mentors/mentor-image-coming-soon.png

Later, generate the mentor portrait and upload it with the EXACT filename shown in:
  mentors/pending-mentor-images.csv

Put the WebP file here:
  assets/images/mentors/<exact-seo-filename>.webp

No profile-page edit is required. The page checks whether the file exists and automatically uses it.

IMPORTANT PUBLISHING / SEO SAFETY
---------------------------------
These 500 profiles were created as hypothetical/demo mentor profiles. They are currently configured as noindex and their Person/ProfilePage schema is disabled.

Before publishing a mentor as factual:
1. Verify the person's identity and consent.
2. Verify current Forsk Coding School affiliation.
3. Verify skills, role, qualifications and any experience claims.
4. Use a consented/approved real photo (or clearly disclose an illustrative AI image).
5. In mentors/data/mentors.json set that mentor's verified field to true.

Once verified=true, the shared template automatically enables index/follow and ProfilePage + Person + BreadcrumbList schema for that mentor.

DO NOT submit mentors/mentors-sitemap-draft.xml to Search Console until the profiles you want indexed are verified.

FILES TO UPLOAD / MERGE
-----------------------
Upload these folders into the website root:
  mentors/
  assets/images/mentors/

The full-site ZIP provided with this package also contains the updated main menu/footer links.
