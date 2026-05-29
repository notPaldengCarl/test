#!/usr/bin/env bash
# ==========================================================================
# VØID ROASTERS — Business Setup Script
#
# A single command to instantiate the entire VØID ROASTERS business:
# renames the site, injects specialty posts and pages, configures the
# static front page, and sets permalinks.
#
# Usage:
#   chmod +x setup-business.sh
#   ./setup-business.sh
#
# Requirements:
#   - WordPress 6.0+ installed and running
#   - WP-CLI (wp) available in PATH
#
# @package VØID_ROASTERS
# @since   1.3.0
# ==========================================================================

set -euo pipefail

# --- Configuration ---
WP_PATH="${WP_PATH:-.}"
THEME_SLUG="void-roasters"

# --- Colors ---
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
CYAN='\033[0;36m'
NC='\033[0m'

log_info()    { echo -e "${CYAN}[INFO]${NC} $1"; }
log_success() { echo -e "${GREEN}[OK]${NC} $1"; }
log_warn()    { echo -e "${YELLOW}[WARN]${NC} $1"; }
log_error()   { echo -e "${RED}[ERROR]${NC} $1"; }

# ==========================================================================
# Preflight Checks
# ==========================================================================

echo ""
echo -e "${GREEN}============================================${NC}"
echo -e "${GREEN}  VØID ROASTERS — Business Setup${NC}"
echo -e "${GREEN}============================================${NC}"
echo ""

if ! command -v wp &> /dev/null; then
    log_error "WP-CLI (wp) is not installed or not in PATH."
    log_error "Install from https://wp-cli.org/#installing"
    exit 1
fi

if ! wp core is-installed --path="$WP_PATH" --quiet 2>/dev/null; then
    log_error "WordPress is not installed at: $WP_PATH"
    log_error "Set WP_PATH or run from the WordPress root."
    exit 1
fi

log_success "WordPress detected at: $WP_PATH"

# ==========================================================================
# Step 1: Activate Theme & Set Site Identity
# ==========================================================================

log_info "Activating VØID ROASTERS theme..."
wp theme activate "$THEME_SLUG" --path="$WP_PATH" --quiet 2>/dev/null || {
    log_warn "Could not activate '$THEME_SLUG'. Ensure it is installed in wp-content/themes/."
}

log_info "Setting site name to 'VØID ROASTERS'..."
wp option update blogname 'VØID ROASTERS' --path="$WP_PATH" --quiet
wp option update blogdescription 'Brutalist Coffee & Matcha Bar' --path="$WP_PATH" --quiet
log_success "Site identity configured."

# ==========================================================================
# Step 2: Create Specialty Posts (Roasts & Matcha)
# ==========================================================================

log_info "Creating specialty product posts..."

POST_1_ID=$(wp post create \
    --path="$WP_PATH" \
    --post_type=post \
    --post_title="Eclipse Dark Roast" \
    --post_status=publish \
    --post_excerpt="A brooding, full-bodied dark roast with notes of bitter chocolate, charred oak, and molasses. Engineered for those who drink their coffee black and their mornings uncompromised." \
    --post_content="<p>ECLIPSE DARK ROAST is sourced from the volcanic highlands of Sumatra and roasted to a deep, mahogany finish. The extended roast time develops a smoky, low-acid profile with a viscous, syrupy body.</p><p><strong>Tasting Notes:</strong> Bitter Chocolate, Charred Oak, Molasses, Black Cherry</p><p><strong>Roast Profile:</strong> Dark — 14 minutes at 450°F</p><p><strong>Origin:</strong> Sumatra, Indonesia</p><p><strong>Altitude:</strong> 1,500–1,700 masl</p>" \
    --porcelain)
log_success "Created — Eclipse Dark Roast (ID: $POST_1_ID)"

POST_2_ID=$(wp post create \
    --path="$WP_PATH" \
    --post_type=post \
    --post_title="Ceremonial Grade Matcha" \
    --post_status=publish \
    --post_excerpt="Stone-ground Uji matcha with an umami-rich body, vivid jade color, and a lingering sweetness. Whisked to order using traditional chasen technique." \
    --post_content="<p>Our CEREMONIAL GRADE MATCHA is sourced from a single estate in Uji, Kyoto — the birthplace of Japanese tea culture. First-harvest leaves are shade-grown for 21 days, hand-picked, de-stemmed, and stone-ground to a 5-micron powder.</p><p><strong>Tasting Notes:</strong> Sweet Umami, Fresh Grass, Marine Mineral, Cream</p><p><strong>Grade:</strong> Ceremonial (First Harvest)</p><p><strong>Origin:</strong> Uji, Kyoto, Japan</p><p><strong>Preparation:</strong> 2g whisked at 80°C with chasen</p>" \
    --porcelain)
log_success "Created — Ceremonial Grade Matcha (ID: $POST_2_ID)"

POST_3_ID=$(wp post create \
    --path="$WP_PATH" \
    --post_type=post \
    --post_title="Nebula Blend" \
    --post_status=publish \
    --post_excerpt="A cosmic collision of Brazilian nuttiness and Kenyan berry intensity. Medium-roasted for a balanced, approachable cup that's greater than the sum of its origins." \
    --post_content="<p>NEBULA BLEND is a proprietary 60/40 combination of Brazilian Cerrado and Kenyan Nyeri lots. The Brazilian base provides a creamy, nutty foundation while the Kenyan component adds a bright, berry-forward top note.</p><p><strong>Tasting Notes:</strong> Hazelnut, Dark Berry, Brown Sugar, Toffee</p><p><strong>Roast Profile:</strong> Medium — 12 minutes at 425°F</p><p><strong>Origin:</strong> Brazil (Cerrado) + Kenya (Nyeri)</p><p><strong>Altitude:</strong> 1,200–1,800 masl</p>" \
    --porcelain)
log_success "Created — Nebula Blend (ID: $POST_3_ID)"

# ==========================================================================
# Step 3: Create Static Pages
# ==========================================================================

log_info "Creating static pages..."

ABOUT_ID=$(wp post create \
    --path="$WP_PATH" \
    --post_type=page \
    --post_title="About" \
    --post_status=publish \
    --post_content="<h2>Origin Matters. Precision Matters. Design Matters.</h2><p>VØID ROASTERS is a small-batch specialty coffee and matcha bar built on brutalist principles. We source single-origin beans directly from farms in Ethiopia, Colombia, Kenya, Sumatra, and Brazil. Our ceremonial matcha comes from a single estate in Uji, Kyoto.</p><p>Each lot is roasted in micro-batches to a precise profile developed to highlight the unique terroir of its origin. No blends by default. No compromises on quality.</p><h3>Our Philosophy</h3><ul><li>Zero frameworks — just coffee and craft</li><li>Direct trade relationships with farmers</li><li>Roasted to order, never sitting on shelves</li><li>Brutally honest about what's in the cup</li></ul>" \
    --porcelain)
log_success "Created — About (ID: $ABOUT_ID)"

CONTACT_ID=$(wp post create \
    --path="$WP_PATH" \
    --post_type=page \
    --post_title="Contact" \
    --post_status=publish \
    --post_content="<h2>Get In Touch</h2><p>For wholesale inquiries, collaboration proposals, or just to say hello:</p><p><strong>Email:</strong> hello@voidroasters.com</p><p><strong>Location:</strong> Roastery visits by appointment only.</p><p><strong>Social:</strong> @voidroasters</p><h3>Wholesale</h3><p>We partner with cafés, restaurants, and offices who share our commitment to quality. Minimum order quantities and custom roast profiles available upon request.</p>" \
    --porcelain)
log_success "Created — Contact (ID: $CONTACT_ID)"

HOME_ID=$(wp post create \
    --path="$WP_PATH" \
    --post_type=page \
    --post_title="Home" \
    --post_status=publish \
    --post_content="" \
    --porcelain)
log_success "Created — Home (ID: $HOME_ID)"

# ==========================================================================
# Step 4: Configure Reading Settings (Static Front Page)
# ==========================================================================

log_info "Configuring static front page..."
wp option update show_on_front page --path="$WP_PATH" --quiet
wp option update page_on_front "$HOME_ID" --path="$WP_PATH" --quiet
wp option update page_for_posts "" --path="$WP_PATH" --quiet
log_success "Static front page set: Home (ID: $HOME_ID)"

# ==========================================================================
# Step 5: Set Permalink Structure
# ==========================================================================

log_info "Setting permalink structure to /%postname%/..."
wp rewrite structure '/%postname%/' --path="$WP_PATH" --quiet
wp rewrite flush --path="$WP_PATH" --quiet
log_success "Permalinks configured."

# ==========================================================================
# Step 6: Create Primary Menu
# ==========================================================================

log_info "Creating primary navigation menu..."
MENU_ID=$(wp menu create "Primary Menu" --path="$WP_PATH" --porcelain 2>/dev/null) || true

if [ -n "${MENU_ID:-}" ]; then
    wp menu item add-post "$MENU_ID" "$HOME_ID" --path="$WP_PATH" --title="Home" --quiet 2>/dev/null || true
    wp menu item add-post "$MENU_ID" "$ABOUT_ID" --path="$WP_PATH" --title="About" --quiet 2>/dev/null || true
    wp menu item add-post "$MENU_ID" "$CONTACT_ID" --path="$WP_PATH" --title="Contact" --quiet 2>/dev/null || true
    wp menu location assign "$MENU_ID" primary --path="$WP_PATH" --quiet 2>/dev/null || true
    log_success "Primary menu created with Home, About, Contact links."
else
    log_warn "Could not create menu. Set up manually in wp-admin."
fi

# ==========================================================================
# Summary
# ==========================================================================

echo ""
echo -e "${GREEN}============================================${NC}"
echo -e "${GREEN}  VØID ROASTERS — Setup Complete!${NC}"
echo -e "${GREEN}============================================${NC}"
echo ""
echo -e "  ${CYAN}Theme:${NC}       $THEME_SLUG"
echo -e "  ${CYAN}Site Name:${NC}   VØID ROASTERS"
echo -e "  ${CYAN}Front Page:${NC}  Home (ID: $HOME_ID)"
echo -e "  ${CYAN}Posts:${NC}       3 specialty items (Eclipse, Matcha, Nebula)"
echo -e "  ${CYAN}Pages:${NC}       About (ID: $ABOUT_ID), Contact (ID: $CONTACT_ID)"
echo -e "  ${CYAN}Permalinks:${NC}  /%postname%/"
echo -e "  ${CYAN}Menu:${NC}        Primary — Home, About, Contact"
echo ""
echo -e "  Visit your site to see the VØID ROASTERS business in action."
echo ""