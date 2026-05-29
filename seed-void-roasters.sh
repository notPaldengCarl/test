#!/usr/bin/env bash
# ==========================================================================
# VØID ROASTERS — Database Seeder
#
# Seeds WordPress with demo roasts, pages, and site configuration
# using WP-CLI commands.
#
# Usage:
#   chmod +x seed-void-roasters.sh
#   ./seed-void-roasters.sh
#
# Requirements:
#   - WordPress installed and accessible
#   - WP-CLI (wp) available in PATH
#
# @package VØID_ROASTERS
# @since   1.2.0
# ==========================================================================

set -euo pipefail

# --- Configuration ---
WP_PATH="${WP_PATH:-.}"

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

# --- Preflight ---
log_info "VØID ROASTERS — Database Seeder"
echo ""

if ! command -v wp &> /dev/null; then
    log_error "WP-CLI (wp) is not installed or not in PATH."
    exit 1
fi

if ! wp core is-installed --path="$WP_PATH" --quiet 2>/dev/null; then
    log_error "WordPress is not installed at: $WP_PATH"
    exit 1
fi

log_success "WordPress detected at: $WP_PATH"

# ==========================================================================
# 1. Set Site Name
# ==========================================================================

log_info "Setting blog name to 'VØID ROASTERS'..."
wp option update blogname 'VØID ROASTERS' --path="$WP_PATH" --quiet
wp option update blogdescription 'Brutalist Coffee Roasters' --path="$WP_PATH" --quiet
log_success "Site name updated."

# ==========================================================================
# 2. Create Three Roast Posts
# ==========================================================================

log_info "Creating 3 roast posts..."

POST_1_ID=$(wp post create \
    --path="$WP_PATH" \
    --post_type=post \
    --post_title="ECLIPSE DARK ROAST" \
    --post_status=publish \
    --post_excerpt="A brooding, full-bodied dark roast with notes of bitter chocolate, charred oak, and molasses. Engineered for those who drink their coffee black and their mornings uncompromised." \
    --post_content="<p>ECLIPSE DARK ROAST is sourced from the volcanic highlands of Sumatra and roasted to a deep, mahogany finish. The extended roast time develops a smoky, low-acid profile with a viscous, syrupy body.</p><p><strong>Tasting Notes:</strong> Bitter Chocolate, Charred Oak, Molasses, Black Cherry</p><p><strong>Roast Profile:</strong> Dark — 14 minutes at 450°F</p><p><strong>Origin:</strong> Sumatra, Indonesia</p><p><strong>Altitude:</strong> 1,500–1,700 masl</p>" \
    --porcelain)
log_success "Post created — ECLIPSE DARK ROAST (ID: $POST_1_ID)"

POST_2_ID=$(wp post create \
    --path="$WP_PATH" \
    --post_type=post \
    --post_title="SOLAR FLARE ETHIOPIAN" \
    --post_status=publish \
    --post_excerpt="An explosive light roast bursting with citrus, jasmine, and raw honey. A single-origin from the birthplace of coffee that radiates complexity and clarity." \
    --post_content="<p>SOLAR FLARE is a natural-process Ethiopian from the Yirgacheffe region. Hand-picked at peak ripeness and sun-dried on raised beds for 21 days, this lot delivers an electric acidity and a perfume-like aroma.</p><p><strong>Tasting Notes:</strong> Meyer Lemon, Jasmine, Raw Honey, Blueberry</p><p><strong>Roast Profile:</strong> Light — 9 minutes at 400°F</p><p><strong>Origin:</strong> Yirgacheffe, Ethiopia</p><p><strong>Altitude:</strong> 1,900–2,200 masl</p>" \
    --porcelain)
log_success "Post created — SOLAR FLARE ETHIOPIAN (ID: $POST_2_ID)"

POST_3_ID=$(wp post create \
    --path="$WP_PATH" \
    --post_type=post \
    --post_title="NEBULA BLEND" \
    --post_status=publish \
    --post_excerpt="A cosmic collision of Brazilian nuttiness and Kenyan berry intensity. Medium-roasted for a balanced, approachable cup that's greater than the sum of its origins." \
    --post_content="<p>NEBULA BLEND is a proprietary 60/40 combination of Brazilian Cerrado and Kenyan Nyeri lots. The Brazilian base provides a creamy, nutty foundation while the Kenyan component adds a bright, berry-forward top note.</p><p><strong>Tasting Notes:</strong> Hazelnut, Dark Berry, Brown Sugar, Toffee</p><p><strong>Roast Profile:</strong> Medium — 12 minutes at 425°F</p><p><strong>Origin:</strong> Brazil (Cerrado) + Kenya (Nyeri)</p><p><strong>Altitude:</strong> 1,200–1,800 masl</p>" \
    --porcelain)
log_success "Post created — NEBULA BLEND (ID: $POST_3_ID)"

# ==========================================================================
# 3. Create Static Pages
# ==========================================================================

log_info "Creating static pages..."

ABOUT_ID=$(wp post create \
    --path="$WP_PATH" \
    --post_type=page \
    --post_title="About" \
    --post_status=publish \
    --post_content="<p>VØID ROASTERS is a small-batch coffee roastery built on a simple philosophy: origin matters, roast precision matters, and design matters.</p><p>We source single-origin beans directly from farms in Ethiopia, Colombia, Kenya, Sumatra, and Brazil. Each lot is roasted in micro-batches to a precise profile developed to highlight the unique terroir of its origin.</p><p>No blends by default. No compromises on quality. No frameworks — just coffee.</p>" \
    --porcelain)
log_success "Page created — About (ID: $ABOUT_ID)"

CONTACT_ID=$(wp post create \
    --path="$WP_PATH" \
    --post_type=page \
    --post_title="Contact" \
    --post_status=publish \
    --post_content="<p>For wholesale inquiries, collaboration proposals, or just to say hello:</p><p><strong>Email:</strong> hello@voidroasters.com</p><p><strong>Location:</strong> Roastery visits by appointment only.</p><p><strong>Social:</strong> @voidroasters</p>" \
    --porcelain)
log_success "Page created — Contact (ID: $CONTACT_ID)"

# ==========================================================================
# 4. Set Static Front Page (if not already set)
# ==========================================================================

CURRENT_SHOW_ON_FRONT=$(wp option get show_on_front --path="$WP_PATH" 2>/dev/null || echo "posts")
if [ "$CURRENT_SHOW_ON_FRONT" != "page" ]; then
    log_info "Configuring static front page..."
    # Check if a home page from generate-demo-content.sh already exists
    HOME_PAGE_ID=$(wp post list --post_type=page --name=home --field=ID --path="$WP_PATH" 2>/dev/null || echo "")
    if [ -z "$HOME_PAGE_ID" ]; then
        HOME_PAGE_ID=$(wp post create \
            --path="$WP_PATH" \
            --post_type=page \
            --post_title="Home" \
            --post_status=publish \
            --post_content="" \
            --porcelain)
        log_success "Created Home page (ID: $HOME_PAGE_ID)"
    fi
    wp option update show_on_front page --path="$WP_PATH" --quiet
    wp option update page_on_front "$HOME_PAGE_ID" --path="$WP_PATH" --quiet
    log_success "Static front page configured."
fi

# ==========================================================================
# 5. Configure Permalinks
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
echo -e "  ${CYAN}Site Name:${NC} VØID ROASTERS"
echo -e "  ${CYAN}Posts:${NC}     3 roasts (ECLIPSE, SOLAR FLARE, NEBULA)"
echo -e "  ${CYAN}Pages:${NC}     About (ID: $ABOUT_ID), Contact (ID: $CONTACT_ID)"
echo -e "  ${CYAN}Permalinks:${NC} /%postname%/"
echo ""