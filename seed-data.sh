#!/usr/bin/env bash
# ==========================================================================
# VØID ROASTERS — Database Seed Script
#
# Populates the WordPress database so the theme loops render correctly.
# Deletes defaults, creates pages/posts, configures front page and menu.
#
# Usage:
#   chmod +x seed-data.sh
#   ./seed-data.sh
#
# Requirements: WordPress 6.0+, WP-CLI (wp) in PATH
#
# @package VØID_ROASTERS
# @since   1.4.0
# ==========================================================================

set -euo pipefail

WP_PATH="${WP_PATH:-.}"

# --- Colors ---
RED='\033[0;31m'
GREEN='\033[0;32m'
CYAN='\033[0;36m'
NC='\033[0m'

log_info()    { echo -e "${CYAN}[INFO]${NC} $1"; }
log_success() { echo -e "${GREEN}[OK]${NC} $1"; }
log_error()   { echo -e "${RED}[ERROR]${NC} $1"; }

echo ""
echo -e "${GREEN}============================================${NC}"
echo -e "${GREEN}  VØID ROASTERS — Seed Data${NC}"
echo -e "${GREEN}============================================${NC}"
echo ""

# --- Preflight ---
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
# 1. Delete All Default Posts and Pages
# ==========================================================================

log_info "Deleting default posts and pages..."

# Delete all existing posts
DEFAULT_POST_IDS=$(wp post list --post_type=post --post_status=any --format=ids --path="$WP_PATH" 2>/dev/null || echo "")
if [ -n "$DEFAULT_POST_IDS" ]; then
    for pid in $DEFAULT_POST_IDS; do
        wp post delete "$pid" --force --path="$WP_PATH" --quiet 2>/dev/null || true
    done
    log_success "Deleted default posts."
else
    log_info "No default posts found."
fi

# Delete all existing pages
DEFAULT_PAGE_IDS=$(wp post list --post_type=page --post_status=any --format=ids --path="$WP_PATH" 2>/dev/null || echo "")
if [ -n "$DEFAULT_PAGE_IDS" ]; then
    for pid in $DEFAULT_PAGE_IDS; do
        wp post delete "$pid" --force --path="$WP_PATH" --quiet 2>/dev/null || true
    done
    log_success "Deleted default pages."
else
    log_info "No default pages found."
fi

# ==========================================================================
# 2. Create Three Static Pages
# ==========================================================================

log_info "Creating static pages..."

HOME_ID=$(wp post create \
    --path="$WP_PATH" \
    --post_type=page \
    --post_title="Home" \
    --post_status=publish \
    --post_content="" \
    --porcelain)
log_success "Created — Home (ID: $HOME_ID)"

ABOUT_ID=$(wp post create \
    --path="$WP_PATH" \
    --post_type=page \
    --post_title="About" \
    --post_status=publish \
    --post_content="<h2>Origin Matters. Precision Matters. Design Matters.</h2><p>VØID ROASTERS is a small-batch specialty coffee and matcha bar built on brutalist principles. We source single-origin beans directly from farms in Ethiopia, Colombia, Kenya, Sumatra, and Brazil. Our ceremonial matcha comes from a single estate in Uji, Kyoto.</p><p>Each lot is roasted in micro-batches to a precise profile developed to highlight the unique terroir of its origin. No blends by default. No compromises on quality.</p>" \
    --porcelain)
log_success "Created — About (ID: $ABOUT_ID)"

CONTACT_ID=$(wp post create \
    --path="$WP_PATH" \
    --post_type=page \
    --post_title="Contact" \
    --post_status=publish \
    --post_content="<h2>Get In Touch</h2><p>For wholesale inquiries, collaboration proposals, or just to say hello:</p><p><strong>Email:</strong> hello@voidroasters.com</p><p><strong>Location:</strong> Roastery visits by appointment only.</p><p><strong>Social:</strong> @voidroasters</p>" \
    --porcelain)
log_success "Created — Contact (ID: $CONTACT_ID)"

# ==========================================================================
# 3. Set 'Home' as the Static Front Page
# ==========================================================================

log_info "Configuring static front page..."
wp option update show_on_front page --path="$WP_PATH" --quiet
wp option update page_on_front "$HOME_ID" --path="$WP_PATH" --quiet
wp option update blogname 'VØID ROASTERS' --path="$WP_PATH" --quiet
wp option update blogdescription 'Brutalist Coffee & Matcha Bar' --path="$WP_PATH" --quiet
log_success "Static front page set: Home (ID: $HOME_ID)"

# ==========================================================================
# 4. Create Menu and Assign to Primary Menu Location
# ==========================================================================

log_info "Creating navigation menu..."
MENU_ID=$(wp menu create "Main Menu" --path="$WP_PATH" --porcelain 2>/dev/null) || true

if [ -n "${MENU_ID:-}" ]; then
    wp menu item add-post "$MENU_ID" "$HOME_ID" --path="$WP_PATH" --title="Home" --quiet 2>/dev/null || true
    wp menu item add-post "$MENU_ID" "$ABOUT_ID" --path="$WP_PATH" --title="About" --quiet 2>/dev/null || true
    wp menu item add-post "$MENU_ID" "$CONTACT_ID" --path="$WP_PATH" --title="Contact" --quiet 2>/dev/null || true
    wp menu location assign "$MENU_ID" primary --path="$WP_PATH" --quiet 2>/dev/null || true
    log_success "Menu 'Main Menu' created with Home, About, Contact. Assigned to Primary Menu location."
else
    log_error "Could not create menu."
fi

# ==========================================================================
# 5. Create Three Blog Posts
# ==========================================================================

log_info "Creating blog posts for the loop..."

POST_1_ID=$(wp post create \
    --path="$WP_PATH" \
    --post_type=post \
    --post_title="Ceremonial Mizu Matcha" \
    --post_status=publish \
    --post_excerpt="Stone-ground Uji matcha with an umami-rich body, vivid jade color, and a lingering sweetness. Whisked to order using traditional chasen technique." \
    --post_content="<p>Our CEREMONIAL MIZU MATCHA is sourced from a single estate in Uji, Kyoto — the birthplace of Japanese tea culture. First-harvest leaves are shade-grown for 21 days, hand-picked, de-stemmed, and stone-ground to a 5-micron powder that dissolves instantly into a vivid jade liquor.</p><p>Each serving is whisked to order using a traditional bamboo chasen, producing a thick, creamy foam that carries the tea's natural umami sweetness. The result is a cup that tastes of sweet grass, marine mineral, and fresh cream — a meditation in a bowl.</p>" \
    --porcelain)
log_success "Created — Ceremonial Mizu Matcha (ID: $POST_1_ID)"

POST_2_ID=$(wp post create \
    --path="$WP_PATH" \
    --post_type=post \
    --post_title="Pueblo Dark Roast" \
    --post_status=publish \
    --post_excerpt="A brooding, full-bodied dark roast with notes of bitter chocolate, charred oak, and molasses. Engineered for those who drink their coffee black." \
    --post_content="<p>PUEBLO DARK ROAST is sourced from the volcanic highlands of Sumatra and roasted to a deep, mahogany finish. The extended roast time develops a smoky, low-acid profile with a viscous, syrupy body that coats the palate with every sip.</p><p>Tasting notes of bitter chocolate, charred oak, and molasses dominate the cup, while a subtle undertone of black cherry provides just enough sweetness to keep you reaching for more. This is coffee for those who take it black and their mornings uncompromised.</p>" \
    --porcelain)
log_success "Created — Pueblo Dark Roast (ID: $POST_2_ID)"

POST_3_ID=$(wp post create \
    --path="$WP_PATH" \
    --post_type=post \
    --post_title="Highland Pour-Over" \
    --post_status=publish \
    --post_excerpt="A bright, clean Ethiopian single-origin with citrus acidity, jasmine florals, and a honeyed finish. Brewed low and slow for maximum clarity." \
    --post_content="<p>HIGHLAND POUR-OVER is a natural-process Ethiopian from the Yirgacheffe region, hand-picked at peak ripeness and sun-dried on raised beds for 21 days. The result is an explosive cup bursting with citrus, jasmine, and raw honey — the kind of coffee that reminds you why you fell in love with the ritual.</p><p>Each pour-over is brewed to order at 93°C through a V60 dripper, drawing out the bean's delicate floral aromatics and clean, tea-like body. Best enjoyed black and without distraction.</p>" \
    --porcelain)
log_success "Created — Highland Pour-Over (ID: $POST_3_ID)"

# ==========================================================================
# 6. Set Permalinks
# ==========================================================================

log_info "Setting permalink structure to /%postname%/..."
wp rewrite structure '/%postname%/' --path="$WP_PATH" --quiet
wp rewrite flush --path="$WP_PATH" --quiet
log_success "Permalinks configured."

# ==========================================================================
# Summary
# ==========================================================================

echo ""
echo -e "${GREEN}============================================${NC}"
echo -e "${GREEN}  VØID ROASTERS — Seed Complete!${NC}"
echo -e "${GREEN}============================================${NC}"
echo ""
echo -e "  ${CYAN}Site Name:${NC}    VØID ROASTERS"
echo -e "  ${CYAN}Front Page:${NC}   Home (ID: $HOME_ID)"
echo -e "  ${CYAN}Pages:${NC}        Home, About (ID: $ABOUT_ID), Contact (ID: $CONTACT_ID)"
echo -e "  ${CYAN}Menu:${NC}         Main Menu → Primary Menu location"
echo -e "  ${CYAN}Posts:${NC}        Ceremonial Mizu Matcha, Pueblo Dark Roast, Highland Pour-Over"
echo -e "  ${CYAN}Permalinks:${NC}   /%postname%/"
echo ""