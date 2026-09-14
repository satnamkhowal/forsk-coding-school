#!/usr/bin/env bash
set -euo pipefail

BASE_URL="${BASE_URL:-https://forskcodingschool.com}"
FAILURES=0

pass() { printf 'PASS: %s\n' "$1"; }
fail() { printf 'FAIL: %s\n' "$1" >&2; FAILURES=$((FAILURES + 1)); }

fetch_body() {
  local path="$1"
  curl --fail --silent --show-error --location \
    --max-time 30 \
    --retry 2 \
    --retry-delay 2 \
    --user-agent 'Forsk-Production-SEO-QA/1.0' \
    "${BASE_URL}${path}"
}

assert_contains() {
  local path="$1"
  local needle="$2"
  local label="$3"
  local body
  if ! body="$(fetch_body "$path")"; then
    fail "$label — could not fetch ${path}"
    return
  fi
  if grep -Fq "$needle" <<<"$body"; then
    pass "$label"
  else
    fail "$label — expected marker not found: ${needle}"
  fi
}

assert_not_contains() {
  local path="$1"
  local needle="$2"
  local label="$3"
  local body
  if ! body="$(fetch_body "$path")"; then
    fail "$label — could not fetch ${path}"
    return
  fi
  if grep -Fq "$needle" <<<"$body"; then
    fail "$label — stale/unsupported marker still present: ${needle}"
  else
    pass "$label"
  fi
}

assert_redirect() {
  local path="$1"
  local expected_location="$2"
  local label="$3"
  local headers status location
  if ! headers="$(curl --silent --show-error --max-time 30 --retry 2 --retry-delay 2 --user-agent 'Forsk-Production-SEO-QA/1.0' --head "${BASE_URL}${path}")"; then
    fail "$label — could not fetch headers for ${path}"
    return
  fi
  status="$(awk 'toupper($1) ~ /^HTTP\// {code=$2} END {print code}' <<<"$headers" | tr -d '\r')"
  location="$(awk 'BEGIN{IGNORECASE=1} /^location:/ {sub(/^[^:]+:[[:space:]]*/, ""); print}' <<<"$headers" | tail -n1 | tr -d '\r')"

  if [[ "$status" != "301" && "$status" != "308" ]]; then
    fail "$label — expected permanent redirect, got HTTP ${status:-unknown}"
    return
  fi

  if [[ "$location" == "$expected_location" || "$location" == "${BASE_URL}${expected_location}" ]]; then
    pass "$label"
  else
    fail "$label — redirect target was '${location:-missing}', expected '${expected_location}'"
  fi
}

printf 'Checking production SEO state at %s\n' "$BASE_URL"

# Homepage deployment guard: catch legacy template content and verify canonical NAP.
assert_contains "/" "+91 72319 68183" "Homepage exposes canonical Forsk phone number"
assert_not_contains "/" "Brooklyn Simmons" "Homepage no longer exposes template testimonials"
assert_not_contains "/" "Devoin Lanee" "Homepage no longer exposes template instructor identities"
assert_not_contains "/" "Miami, Florida, USA" "Homepage no longer exposes template event locations"
assert_not_contains "/" "180,000+ learners" "Homepage no longer exposes unsupported learner count"

# Maintained first-party surfaces.
assert_contains "/about.php" "Information we intentionally verify" "About page is on maintained factual version"
assert_not_contains "/about.php" "2,540 Google reviews" "About page no longer exposes template review count"
assert_contains "/courses.php" "Job-Oriented IT & Coding Courses in Jaipur" "Course catalogue is on maintained discovery experience"
assert_not_contains "/courses.php" "180K learners" "Course catalogue no longer exposes template learner count"

# Permanent consolidation guards for retired/legacy URLs.
assert_redirect "/instructor.php" "/mentors/" "Legacy instructor directory permanently redirects to mentor hub"
assert_redirect "/courses/python-programming-course-jaipur/" "/python-programming-course-jaipur.php" "Legacy Python course URL consolidates to canonical page"
assert_redirect "/courses/data-analytics-course-with-python-sql-excel-power-bi/" "/data-analytics-course-jaipur.php" "Legacy Data Analytics LMS URL consolidates to canonical page"
assert_redirect "/courses/java-full-stack-course-jaipur/" "/java-full-stack-course-jaipur.php" "Legacy Java Full Stack LMS URL consolidates to canonical page"
assert_redirect "/courses/dotnet-full-stack-course-jaipur/" "/dotnet-full-stack-course-jaipur.php" "Legacy .NET Full Stack LMS URL consolidates to canonical page"

if (( FAILURES > 0 )); then
  printf '\nProduction SEO QA failed with %d issue(s).\n' "$FAILURES" >&2
  exit 1
fi

printf '\nProduction SEO QA passed.\n'
