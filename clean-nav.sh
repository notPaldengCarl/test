#!/usr/bin/env bash
# ==========================================================================
# VØID ROASTERS — Clean Navigation Script
#
# Deletes default WordPress content, creates pages with template assignments,
# and builds a clean navigation menu.
#
# Usage:
#   chmod +x clean-nav.sh
#   ./clean-nav.sh
#
# Requirements: WordPress 6.0+, WP-CLI (wp) in PATH
#
# @package VØID_ROASTERS
# @since   3.0.0
# ==========================================================================

set -euo pipefail

WP_PATH="${WP_PATH:-.}"

RED='\033[0;31m'
GREEN='\033[0;32m'
CYAN='\033[0;36m'
NC='\033[0m'

log_info()    { echo -e "${CYAN}[INFO]${NC} $1"; }
log_success() { echo -e "${GREEN}[OK]${NC} $1"; }
log_error()   { echo -e "${RED}[ERROR]${NC} $1"; }

echo ""
echo -e "${GREEN}============================================${NC}"
echo -e "${GREEN}  VØID ROASTERS — Clean Navigation${NC}"
echo -e "${GREEN}============================================${NC}"
echo ""

if ! command -v wp &> /dev/null; then
    log_error "WP-CLI (wp) is not installed."
    exit 1
fi

if ! wp core is-installed --path="$WP_PATH" --quiet 2>/dev/null; then
    log_error "WordPress is not installed at: $WP_PATH"
    exit 1
fi

log_success "WordPress detected at: $WP_PATH"

# ==========================================================================
# 1. Delete Default Content
# ==========================================================================

log_info "Deleting default Sample Page and Hello World post..."

DEFAULT_POST_IDS=$(wp post list --post_type=post --post_status=any --format=ids --path="$WP_PATH" 2>/dev/null || echo "")
if [ -n "$DEFAULT_POST_IDS" ]; then
    for pid in $DEFAULT_POST_IDS; do
        wp post delete "$pid" --force --path="$WP_PATH" --quiet 2>/dev/null || true
    done
    log_success "Deleted all default posts."
fi

DEFAULT_PAGE_IDS=$(wp post list --post_type=page --post_status=any --format=ids --path="$WP_PATH" 2>/dev/null || echo "")
if [ -n "$DEFAULT_PAGE_IDS" ]; then
    for pid in $DEFAULT_PAGE_IDS; do
        wp post delete "$pid" --force --path="$WP_PATH" --quiet 2>/dev/null || true
    done
    log_success "Deleted all default pages."
fi

# ==========================================================================
# 2. Create Pages with Template Assignments
# ==========================================================================

log_info "Creating pages with template assignments..."

HOME_ID=$(wp post create --path="$WP_PATH" --post_type=page --post_title="Home" --post_status=publish --post_content="" --porcelain)
log_success "Created — Home (ID: $HOME_ID)"

ABOUT_ID=$(wp post create --path="$WP_PATH" --post_type=page --post_title="About" --post_status=publish --post_content="<h2>Origin Matters. Precision Matters. Design Matters.</h2><p>VØID ROASTERS is a small-batch specialty coffee and matcha bar built on minimalist principles. We source single-origin beans directly from farms in Ethiopia, Colombia, Kenya, Sumatra, and Brazil.</p><p>Each lot is roasted in micro-batches to a precise profile developed to highlight the unique terroir of its origin.</p>" --porcelain)
wp post meta update "$ABOUT_ID" _wp_page_template "page-about.php" --path="$WP_PATH" --quiet
log_success "Created — About (ID: $ABOUT_ID, template: page-about.php)"

PRODUCTS_ID=$(wp post create --path="$WP_PATH" --post_type=page --post_title="Products" --post_status=publish --post_content="" --porcelain)
wp post meta update "$PRODUCTS_ID" _wp_page_template "page-products.php" --path="$WP_PATH" --quiet
log_success "Created — Products (ID: $PRODUCTS_ID, template: page-products.php)"

CONTACT_ID=$(wp post create --path="$WP_PATH" --post_type=page --post_title="Contact" --post_status=publish --post_content="" --porcelain)
wp post meta update "$CONTACT_ID" _wp_page_template "page-contact.php" --path="$WP_PATH" --quiet
log_success "Created — Contact (ID: $CONTACT_ID, template: page-contact.php)"

# ==========================================================================
# 3. Configure Static Front Page
# ==========================================================================

log_info "Configuring static front page..."
wp option update show_on_front page --path="$WP_PATH" --quiet
wp option update page_on_front "$HOME_ID" --path="$WP_PATH" --quiet
wp option update blogname 'VØID ROASTERS' --path="$WP_PATH" --quiet
wp option update blogdescription 'Empowering through craft coffee.' --path="$WP_PATH" --quiet
log_success "Static front page set: Home (ID: $HOME_ID)"

# ==========================================================================
# 4. Create Navigation Menu
# ==========================================================================

log_info "Creating Primary Menu..."
MENU_ID=$(wp menu create "Primary Menu" --path="$WP_PATH" --porcelain 2>/dev/null) || true

if [ -n "${MENU_ID:-}" ]; then
    wp menu item add-post "$MENU_ID" "$HOME_ID" --path="$WP_PATH" --title="Home" --quiet 2>/dev/null || true
    wp menu item add-post "$MENU_ID" "$ABOUT_ID" --path="$WP_PATH" --title="About" --quiet 2>/dev/null || true
    wp menu item add-post "$MENU_ID" "$PRODUCTS_ID" --path="$WP_PATH" --title="Products" --quiet 2>/dev/null || true
    wp menu item add-post "$MENU_ID" "$CONTACT_ID" --path="$WP_PATH" --title="Contact" --quiet 2>/dev/null || true
    wp menu location assign "$MENU_ID" primary --path="$WP_PATH" --quiet 2>/dev/null || true
    log_success "Primary Menu created: Home, About, Products, Contact"
fi

# ==========================================================================
# 5. Set Permalinks
# ==========================================================================

log_info "Setting permalink structure to /%postname%/..."
wp rewrite structure '/%postname%/' --path="$WP_PATH" --quiet
wp rewrite flush --path="$WP_PATH" --quiet
log_success "Permalinks configured."

echo ""
echo -e "${GREEN}============================================${NC}"
echo -e "${GREEN}  VØID ROASTERS — Cleanup Complete!${NC}"
echo -e "${GREEN}============================================${NC}"
echo ""
echo -e "  ${CYAN}Front Page:${NC}  Home (ID: $HOME_ID)"
echo -e "  ${CYAN}Pages:${NC}       Home, About (page-about.php), Products (page-products.php), Contact (page-contact.php)"
echo -e "  ${CYAN}Menu:${NC}        Primary Menu → Home, About, Products, Contact"
echo -e "  ${CYAN}Permalinks:${NC}  /%postname%/"
echo ""