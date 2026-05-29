#!/usr/bin/env bash
# ==========================================================================
# VØID ROASTERS — Demo Content Generator
#
# Programmatically injects test posts with featured imagery and configures
# the static home page settings using WP-CLI.
#
# Usage:
#   chmod +x generate-demo-content.sh
#   ./generate-demo-content.sh
#
# Requirements:
#   - WordPress installed and accessible
#   - WP-CLI (wp) available in PATH
#   - Run from the WordPress root directory or specify WP_PATH below
#
# @package VØID_ROASTERS
# @since   1.1.0
# ==========================================================================

set -euo pipefail

# --- Configuration ---
WP_PATH="${WP_PATH:-.}"    # Path to WordPress install. Defaults to current dir.
THEME_SLUG="void-roasters" # Must match the theme directory name.

# --- Colors for output ---
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
CYAN='\033[0;36m'
NC='\033[0m' # No Color

# --- Helper Functions ---
log_info() {
    echo -e "${CYAN}[INFO]${NC} $1"
}

log_success() {
    echo -e "${GREEN}[OK]${NC} $1"
}

log_warn() {
    echo -e "${YELLOW}[WARN]${NC} $1"
}

log_error() {
    echo -e "${RED}[ERROR]${NC} $1"
}

# --- Preflight Checks ---

log_info "VØID ROASTERS — Demo Content Generator"
echo ""

# Check for WP-CLI
if ! command -v wp &> /dev/null; then
    log_error "WP-CLI (wp) is not installed or not in PATH."
    log_error "Install it from https://wp-cli.org/#installing"
    exit 1
fi

# Check WordPress is accessible
if ! wp core is-installed --path="$WP_PATH" --quiet 2>/dev/null; then
    log_error "WordPress is not installed at: $WP_PATH"
    log_error "Set WP_PATH environment variable or run from the WordPress root."
    exit 1
fi

log_success "WordPress detected at: $WP_PATH"
log_success "WP-CLI available"

# ==========================================================================
# Step 1: Activate VØID ROASTERS Theme
# ==========================================================================

log_info "Activating VØID ROASTERS theme..."
wp theme activate "$THEME_SLUG" --path="$WP_PATH" --quiet 2>/dev/null || {
    log_warn "Could not activate theme '$THEME_SLUG'. Ensure it is installed."
    log_warn "If using a custom path, copy the theme to wp-content/themes/$THEME_SLUG/"
}
log_success "Theme activation attempted."

# ==========================================================================
# Step 2: Create Demo Pages (Home + Blog)
# ==========================================================================

log_info "Creating static front page..."
HOME_PAGE_ID=$(wp post create \
    --path="$WP_PATH" \
    --post_type=page \
    --post_title="Home" \
    --post_status=publish \
    --post_content="Welcome to VØID ROASTERS. This is the static front page." \
    --porcelain)

log_info "Creating blog listing page..."
BLOG_PAGE_ID=$(wp post create \
    --path="$WP_PATH" \
    --post_type=page \
    --post_title="Roasts" \
    --post_status=publish \
    --post_content="" \
    --porcelain)

log_success "Pages created — Home: $HOME_PAGE_ID, Blog: $BLOG_PAGE_ID"

# ==========================================================================
# Step 3: Configure Reading Settings (Static Front Page)
# ==========================================================================

log_info "Configuring static front page settings..."
wp option update show_on_front page --path="$WP_PATH" --quiet
wp option update page_on_front "$HOME_PAGE_ID" --path="$WP_PATH" --quiet
wp option update page_for_posts "$BLOG_PAGE_ID" --path="$WP_PATH" --quiet
log_success "Reading settings configured — Static front page enabled."

# ==========================================================================
# Step 4: Create 3 Single-Origin Roast Posts
# ==========================================================================

log_info "Creating 3 single-origin roast posts..."

# Post 1
POST_1_ID=$(wp post create \
    --path="$WP_PATH" \
    --post_type=post \
    --post_title="Ethiopian Yirgacheffe — Gedeo Zone" \
    --post_status=publish \
    --post_excerpt="Bright citrus acidity meets delicate floral notes in this sun-dried single origin from the birthplace of coffee." \
    --post_content="<p>Sourced from the highland farms of the Gedeo Zone in southern Ethiopia, this Yirgacheffe lot is processed using the traditional natural method. Sun-dried on raised beds for 18–21 days, the cherries develop intense blueberry and jasmine aromatics.</p><p><strong>Tasting Notes:</strong> Bergamot, Meyer Lemon, Jasmine, Dark Honey</p><p><strong>Roast Profile:</strong> Light — developed to preserve origin clarity and floral complexity.</p><p><strong>Altitude:</strong> 1,900–2,200 masl</p>" \
    --porcelain)
log_success "Post 1 created — Ethiopian Yirgacheffe (ID: $POST_1_ID)"

# Post 2
POST_2_ID=$(wp post create \
    --path="$WP_PATH" \
    --post_type=post \
    --post_title="Colombian Huila — San Agustín" \
    --post_status=publish \
    --post_excerpt="A meticulously washed lot from the San Agustín region delivering structured sweetness with a clean, syrupy body." \
    --post_content="<p>From the volcanic soils of Huila's San Agustín municipality, this lot is hand-picked at peak ripeness and processed within 12 hours of harvest. The washed method yields exceptional clarity and a layered sweetness that evolves as the cup cools.</p><p><strong>Tasting Notes:</strong> Panela, Red Grape, Caramel, Walnut</p><p><strong>Roast Profile:</strong> Medium — balanced to highlight structured sweetness and body.</p><p><strong>Altitude:</strong> 1,700–1,900 masl</p>" \
    --porcelain)
log_success "Post 2 created — Colombian Huila (ID: $POST_2_ID)"

# Post 3
POST_3_ID=$(wp post create \
    --path="$WP_PATH" \
    --post_type=post \
    --post_title="Kenyan Nyeri — Othaya AB" \
    --post_status=publish \
    --post_excerpt="Electric blackcurrant acidity meets a savoury tomato-vine complexity — unmistakably Kenyan, unmistakably bold." \
    --post_content="<p>Produced by the Othaya Farmers Cooperative Society in Nyeri County, this AB-graded lot undergoes a meticulous 72-hour fermentation before being channel-washed and dried on raised mesh beds. The SL-28 and SL-34 varietals deliver the signature Kenyan intensity.</p><p><strong>Tasting Notes:</strong> Blackcurrant, Grapefruit, Tomato Vine, Raw Sugar</p><p><strong>Roast Profile:</strong> Light-Medium — tuned to amplify the electric acidity and fruit-forward complexity.</p><p><strong>Altitude:</strong> 1,800–2,000 masl</p>" \
    --porcelain)
log_success "Post 3 created — Kenyan Nyeri (ID: $POST_3_ID)"

# ==========================================================================
# Step 5: Set Featured Images (Placeholder)
# ==========================================================================

log_info "Setting featured images via placeholder..."

# Use placeholder images from placeholder.com (sized for post thumbnails)
PLACEHOLDER_1="https://placehold.co/800x600/0b0b0b/d4ff00?text=Ethiopian+Yirgacheffe"
PLACEHOLDER_2="https://placehold.co/800x600/0b0b0b/d4ff00?text=Colombian+Huila"
PLACEHOLDER_3="https://placehold.co/800x600/0b0b0b/d4ff00?text=Kenyan+Nyeri"

# Attempt to import and set featured images
# Note: This requires allow_url_fopen or curl. If it fails, set manually.
set_featured_image() {
    local post_id=$1
    local image_url=$2
    local post_title=$3

    local attachment_id
    attachment_id=$(wp media import "$image_url" \
        --path="$WP_PATH" \
        --title="$post_title" \
        --post_id="$post_id" \
        --featured_image \
        --porcelain 2>/dev/null) && {
        log_success "Featured image set for: $post_title (attachment: $attachment_id)"
    } || {
        log_warn "Could not import featured image for: $post_title"
        log_warn "Set manually in wp-admin or import images via the Media Library."
    }
}

set_featured_image "$POST_1_ID" "$PLACEHOLDER_1" "Ethiopian Yirgacheffe"
set_featured_image "$POST_2_ID" "$PLACEHOLDER_2" "Colombian Huila"
set_featured_image "$POST_3_ID" "$PLACEHOLDER_3" "Kenyan Nyeri"

# ==========================================================================
# Step 6: Configure Permalinks
# ==========================================================================

log_info "Setting permalink structure to /%postname%/..."
wp rewrite structure '/%postname%/' --path="$WP_PATH" --quiet
wp rewrite flush --path="$WP_PATH" --quiet
log_success "Permalinks configured."

# ==========================================================================
# Step 7: Create Primary Menu
# ==========================================================================

log_info "Creating primary navigation menu..."
MENU_ID=$(wp menu create "Primary Menu" --path="$WP_PATH" --porcelain 2>/dev/null) || true

if [ -n "${MENU_ID:-}" ]; then
    wp menu item add-post "$MENU_ID" "$HOME_PAGE_ID" --path="$WP_PATH" --title="Home" --quiet 2>/dev/null || true
    wp menu item add-post "$MENU_ID" "$BLOG_PAGE_ID" --path="$WP_PATH" --title="Roasts" --quiet 2>/dev/null || true
    wp menu location assign "$MENU_ID" primary --path="$WP_PATH" --quiet 2>/dev/null || true
    log_success "Primary menu created and assigned."
else
    log_warn "Could not create menu. Set up manually in wp-admin > Appearance > Menus."
fi

# ==========================================================================
# Summary
# ==========================================================================

echo ""
echo -e "${GREEN}============================================${NC}"
echo -e "${GREEN}  VØID ROASTERS — Demo Setup Complete!${NC}"
echo -e "${GREEN}============================================${NC}"
echo ""
echo -e "  ${CYAN}Theme:${NC}     $THEME_SLUG"
echo -e "  ${CYAN}Front Page:${NC} Home (ID: $HOME_PAGE_ID)"
echo -e "  ${CYAN}Blog Page:${NC}  Roasts (ID: $BLOG_PAGE_ID)"
echo -e "  ${CYAN}Posts:${NC}      3 single-origin roasts created"
echo -e "  ${CYAN}Permalinks:${NC} /%postname%/"
echo ""
echo -e "  Visit your site to see the VØID ROASTERS theme in action."
echo -e "  ${YELLOW}Note:${NC} If placeholder images failed, set featured images"
echo -e "  manually via ${CYAN}wp-admin > Media > Add New${NC}."
echo ""