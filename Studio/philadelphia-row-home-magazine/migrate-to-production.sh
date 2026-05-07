#!/bin/bash
# =============================================================================
# Philadelphia RowHome Magazine — Production Migration Script
# =============================================================================
# Run this on the production server after WordPress is installed.
# Prerequisites: SSH access, WP-CLI installed, MySQL database configured.
#
# Usage: bash migrate-to-production.sh <production-url>
# Example: bash migrate-to-production.sh https://rowhomemag.com
# =============================================================================

set -euo pipefail

PROD_URL="${1:?Usage: bash migrate-to-production.sh <production-url>}"
SCRIPT_DIR="$(cd "$(dirname "$0")" && pwd)"
THEME_DIR="$SCRIPT_DIR/wp-content/themes/rowhome-magazine"
EXPORT_FILE=$(ls -t "$SCRIPT_DIR"/philadelphiarowhomemagazine.wordpress.*.xml 2>/dev/null | head -1)

echo "============================================="
echo "RowHome Magazine — Production Migration"
echo "============================================="
echo "Target URL: $PROD_URL"
echo "Theme dir:  $THEME_DIR"
echo "Export:     ${EXPORT_FILE:-NOT FOUND}"
echo "============================================="

# --- Step 1: Verify WordPress is installed ---
echo ""
echo "[1/7] Verifying WordPress installation..."
wp core is-installed || { echo "ERROR: WordPress is not installed. Install WordPress first."; exit 1; }
wp core version

# --- Step 2: Install and activate theme ---
echo ""
echo "[2/7] Installing rowhome-magazine theme..."
PROD_THEMES_DIR=$(wp eval 'echo get_theme_root();')
if [ -d "$PROD_THEMES_DIR/rowhome-magazine" ]; then
    echo "Theme directory exists — updating files..."
    rsync -av --delete "$THEME_DIR/" "$PROD_THEMES_DIR/rowhome-magazine/"
else
    echo "Copying theme..."
    cp -r "$THEME_DIR" "$PROD_THEMES_DIR/rowhome-magazine"
fi
wp theme activate rowhome-magazine
echo "Theme activated."

# --- Step 3: Install recommended plugins ---
echo ""
echo "[3/7] Installing recommended plugins..."
wp plugin install wordpress-seo --activate 2>/dev/null || echo "Yoast SEO already installed"
# Hostinger uses LiteSpeed — prefer LiteSpeed Cache over WP Super Cache
wp plugin install litespeed-cache --activate 2>/dev/null || echo "LiteSpeed Cache already installed"
wp plugin install wordfence --activate 2>/dev/null || echo "Wordfence already installed"

# --- Step 4: Import content ---
echo ""
echo "[4/7] Importing content..."
if [ -n "$EXPORT_FILE" ]; then
    wp plugin install wordpress-importer --activate 2>/dev/null || true
    wp import "$EXPORT_FILE" --authors=create
    echo "Content imported from $EXPORT_FILE"
else
    echo "No export file found. Running demo content script instead..."
    if [ -f "$SCRIPT_DIR/create-demo-content.sh" ]; then
        bash "$SCRIPT_DIR/create-demo-content.sh"
    else
        echo "WARNING: No export file or demo content script found."
    fi
fi

# --- Step 5: Configure site URLs and permalinks ---
echo ""
echo "[5/7] Configuring site settings..."
wp option update siteurl "$PROD_URL"
wp option update home "$PROD_URL"
wp rewrite structure '/%postname%/' --hard
wp rewrite flush --hard
echo "URLs set to $PROD_URL, permalinks configured."

# --- Step 6: Sync uploads directory and regenerate thumbnails ---
echo ""
echo "[6/7] Syncing uploads and regenerating thumbnails..."
PROD_UPLOADS_DIR=$(wp eval 'echo wp_upload_dir()["basedir"];')
LOCAL_UPLOADS_DIR="$SCRIPT_DIR/wp-content/uploads"
if [ -d "$LOCAL_UPLOADS_DIR" ]; then
    echo "Syncing uploads from $LOCAL_UPLOADS_DIR to $PROD_UPLOADS_DIR ..."
    rsync -av --ignore-existing "$LOCAL_UPLOADS_DIR/" "$PROD_UPLOADS_DIR/"
    echo "Uploads synced."
else
    echo "No local uploads directory found — skipping upload sync."
fi
wp media regenerate --yes 2>/dev/null || echo "No media to regenerate"

# --- Step 7: Smoke test ---
echo ""
echo "[7/7] Running smoke tests..."
ERRORS=0

# Check homepage
HTTP_CODE=$(curl -s -o /dev/null -w "%{http_code}" "$PROD_URL")
if [ "$HTTP_CODE" = "200" ]; then
    echo "  ✓ Homepage returns 200"
else
    echo "  ✗ Homepage returns $HTTP_CODE"
    ERRORS=$((ERRORS + 1))
fi

# Check admin
ADMIN_CODE=$(curl -s -o /dev/null -w "%{http_code}" "$PROD_URL/wp-admin/")
if [ "$ADMIN_CODE" = "200" ] || [ "$ADMIN_CODE" = "302" ]; then
    echo "  ✓ Admin accessible (HTTP $ADMIN_CODE)"
else
    echo "  ✗ Admin returns $ADMIN_CODE"
    ERRORS=$((ERRORS + 1))
fi

# Check theme is active
ACTIVE_THEME=$(wp theme list --status=active --field=name)
if [ "$ACTIVE_THEME" = "rowhome-magazine" ]; then
    echo "  ✓ rowhome-magazine theme is active"
else
    echo "  ✗ Active theme is '$ACTIVE_THEME', expected 'rowhome-magazine'"
    ERRORS=$((ERRORS + 1))
fi

# Check post count
POST_COUNT=$(wp post list --post_type=post --post_status=publish --format=count)
echo "  ℹ Published posts: $POST_COUNT"

PAGE_COUNT=$(wp post list --post_type=page --post_status=publish --format=count)
echo "  ℹ Published pages: $PAGE_COUNT"

echo ""
echo "============================================="
if [ "$ERRORS" -eq 0 ]; then
    echo "Migration complete! Site is live at $PROD_URL"
else
    echo "Migration complete with $ERRORS warning(s). Review above."
fi
echo "============================================="
