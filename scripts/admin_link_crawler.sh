#!/usr/bin/env bash
# Admin link crawler
# Logs in as testadmin, crawls admin pages (internal links only), depth-limited,
# and reports HTTP status for each visited URL.
# Usage: BASE_URL=http://localhost/lucidstar ./scripts/admin_link_crawler.sh

set -euo pipefail
BASE_URL=${BASE_URL:-http://localhost/lucidstar}
COOKIE_JAR=$(mktemp /tmp/admin_cookies.XXXX)
REPORT=$(mktemp /tmp/admin_crawl_report.XXXX)
MAX_DEPTH=${MAX_DEPTH:-3}
MAX_PAGES=${MAX_PAGES:-500}

echo "Starting admin link crawl against $BASE_URL"

auth_paths=("/index.php/login" "/login")
LOGIN_OK=0
for p in "${auth_paths[@]}"; do
  LOGIN_URL="$BASE_URL${p}"
  echo "Attempting login POST -> $LOGIN_URL"
  # send credentials, save cookies, follow redirects
  HTTP_CODE=$(curl -s -S -L -c "$COOKIE_JAR" -d "login=testadmin&password=password" -o /dev/null -w "%{http_code}" "$LOGIN_URL") || true
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

# BFS crawl (avoid associative arrays for macOS bash compatibility)
VISITED_FILE=$(mktemp /tmp/visited.XXXX)
DEPTH_FILE=$(mktemp /tmp/depth.XXXX)
queue=()
start_path="/index.php/admin"
queue+=("$start_path")
# mark start visited with depth 0
echo "$start_path" >> "$VISITED_FILE"
echo "$start_path|0" >> "$DEPTH_FILE"
pages=0

echo "url,status_code,reason" > "$REPORT"

while [[ ${#queue[@]} -gt 0 ]]; do
  url_path="${queue[0]}"
  queue=("${queue[@]:1}")
  # look up depth for this path from DEPTH_FILE
  d=$(awk -F'|' -v p="$url_path" '$1==p{print $2; exit}' "$DEPTH_FILE" || true)
  if [[ -z "$d" ]]; then d=0; fi
  full_url="$BASE_URL${url_path}"
  echo "Crawling (depth=$d): $full_url"

  # fetch page, save body
  TMPBODY=$(mktemp /tmp/admin_body.XXXX)
  HTTP_CODE=$(curl -s -S -b "$COOKIE_JAR" -L -w "%{http_code}" -o "$TMPBODY" "$full_url") || true

  # detect reason (simple heuristic)
  if [[ "$HTTP_CODE" -ge 500 ]]; then
    reason="server_error"
  elif [[ "$HTTP_CODE" -ge 400 ]]; then
    reason="client_error"
  else
    reason="ok"
  fi
  echo "$full_url,$HTTP_CODE,$reason" >> "$REPORT"

  pages=$((pages+1))
  if [[ $pages -ge $MAX_PAGES ]]; then
    echo "Reached max pages limit ($MAX_PAGES)" >&2
    break
  fi

  # only parse links when response is OK
  if [[ "$HTTP_CODE" -ge 200 && "$HTTP_CODE" -lt 400 ]]; then
    # extract hrefs using perl and iterate (process substitution to avoid subshell)
    while read -r link; do
      # skip anchors/javscript/mailto/tel
      if [[ "$link" =~ ^# ]] || [[ "$link" =~ ^javascript: ]] || [[ "$link" =~ ^mailto: ]] || [[ "$link" =~ ^tel: ]]; then
        continue
      fi
      # convert to path under BASE_URL
      if [[ "$link" =~ ^https?:// ]]; then
        # if absolute URL, only include if same host
        if [[ "$link" != $BASE_URL* ]]; then
          continue
        fi
        # strip base
        path=${link#${BASE_URL}}
        if [[ -z "$path" ]]; then path="/"; fi
      else
        # relative paths
        if [[ "$link" =~ ^/ ]]; then
          path="$link"
        else
          # resolve relative to current path
          base_dir="${url_path%/*}"
          if [[ "$base_dir" == "$url_path" ]]; then base_dir="${url_path}"; fi
          path="$base_dir/$link"
          # collapse //
          path=$(echo "$path" | sed 's#/\./#/#g; s#//+#/#g')
        fi
      fi
      # Only crawl admin area
      if [[ "$path" =~ /index.php/admin ]] || [[ "$path" =~ ^/admin ]]; then
        # skip destructive or state-changing endpoints in read-only mode
        if echo "$path" | grep -qiE '/remove_|/remove/|/delete|/restore|/logout|remove_|delete|restore|drop|truncate'; then
          skip_full="$BASE_URL$path"
          echo "$skip_full,SKIPPED,skipped_destructive" >> "$REPORT"
          continue
        fi
        if [[ "$path" != /* ]]; then path="/$path"; fi
        next_depth=$((d+1))
        if [[ $next_depth -le $MAX_DEPTH ]]; then
          if ! grep -qxF "$path" "$VISITED_FILE" 2>/dev/null; then
            echo "$path" >> "$VISITED_FILE"
            echo "$path|$next_depth" >> "$DEPTH_FILE"
            queue+=("$path")
          fi
        fi
      fi
    done < <(perl -nle "while(/href=['\"]([^'\"]+)['\"]/gi){print \$1}" "$TMPBODY")
  fi
  rm -f "$TMPBODY"

done

# Print report summary
echo
echo "Crawl complete. Report saved to: $REPORT"
echo "Summary (non-200 responses):"
grep -v ",200," "$REPORT" || true

echo
echo "Full CSV report:" 
cat "$REPORT"

# move report to repo for persistence
mv "$REPORT" ./scripts/admin_crawl_report.csv || true
rm -f "$COOKIE_JAR"

echo "Report copied to ./scripts/admin_crawl_report.csv"
exit 0
