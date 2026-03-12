#!/usr/bin/env bash
# Smoke test script: logs in as testadmin and checks a few admin pages.
# Usage: BASE_URL=http://127.0.0.1:8000 ./scripts/admin_smoke_test.sh

set -euo pipefail
BASE_URL=${BASE_URL:-http://127.0.0.1:8000}
COOKIE_JAR=$(mktemp /tmp/admin_cookies.XXXX)
LOGIN_PATHS=("/index.php/login" "/login")
ADMIN_CHECKS=("/index.php/admin" "/index.php/admin/menus" "/index.php/admin/settings")

echo "Base URL: $BASE_URL"
# Try login against the configured paths until one works
LOGIN_OK=0
for p in "${LOGIN_PATHS[@]}"; do
  LOGIN_URL="$BASE_URL${p}"
  echo "Trying login POST -> $LOGIN_URL"
  # First fetch the login page to capture cookies and CSRF token (if present)
  TMPPAGE=$(mktemp /tmp/login_page.XXXX)
  curl -s -S -c "$COOKIE_JAR" -L "$LOGIN_URL" -o "$TMPPAGE" || true
  # Try to extract a CodeIgniter CSRF token from a hidden input named according to default config
  CSRF_NAME="csrf_test_name"
  CSRF_VALUE=""
  if grep -q "name=\"${CSRF_NAME}\"" "$TMPPAGE" 2>/dev/null; then
    CSRF_VALUE=$(sed -n 's/.*name="csrf_test_name" value="\([^"]*\)".*/\1/p' "$TMPPAGE" || true)
  fi
  rm -f "$TMPPAGE"
  # post login form; follow redirects; save cookies. Include CSRF token if found.
  POST_DATA="login=testadmin&password=password"
  if [ -n "$CSRF_VALUE" ]; then
    POST_DATA="$POST_DATA&${CSRF_NAME}=${CSRF_VALUE}"
  fi
  HTTP_CODE=$(curl -s -S -L -c "$COOKIE_JAR" -d "$POST_DATA" -o /dev/null -w "%{http_code}" "$LOGIN_URL") || true
  echo " -> HTTP $HTTP_CODE"
  if [[ "$HTTP_CODE" =~ ^(200|302|301)$ ]]; then
    LOGIN_OK=1
    break
  fi
done

if [[ $LOGIN_OK -ne 1 ]]; then
  echo "Login failed against known endpoints." >&2
  rm -f "$COOKIE_JAR"
  exit 2
fi

# Check admin pages
FAILED=0
for p in "${ADMIN_CHECKS[@]}"; do
  URL="$BASE_URL${p}"
  echo "Checking $URL"
  RESP=$(curl -s -S -b "$COOKIE_JAR" -L "$URL") || true
  HTTP_CODE=$(echo "$RESP" | head -c 1000 >/dev/null; printf "200")
  # Basic content check: look for admin keywords
  if echo "$RESP" | grep -q "Admin Dashboard\|Site Settings\|Menus"; then
    echo " OK (content verified)"
  else
    echo " FAIL: expected admin content not found in $URL"
    FAILED=1
  fi
done

rm -f "$COOKIE_JAR"
if [[ $FAILED -eq 1 ]]; then
  echo "One or more checks failed." >&2
  exit 3
fi

echo "All admin smoke checks passed."
exit 0
