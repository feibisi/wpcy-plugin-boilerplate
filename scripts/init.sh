#!/bin/bash
#
# Initialize a new plugin from the boilerplate template.
#
# Usage:
#   ./scripts/init.sh
#
# This script replaces all placeholders, renames files, and runs composer install.
# Run this once after cloning the template. Then delete the scripts/ directory.

set -e

# Colors.
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m'

echo ""
echo "=== WPCY Plugin Boilerplate Initializer ==="
echo ""

# Collect input.
read -p "Plugin Name (PascalCase, e.g. WPExample): " NAME
read -p "Plugin Slug (lowercase-hyphen, e.g. wpexample): " SLUG
read -p "PHP Namespace (PascalCase, e.g. WPExample): " NAMESPACE
read -p "Constant Prefix (UPPER_SNAKE, e.g. WPEXAMPLE): " PREFIX
read -p "Function Prefix (snake_case, e.g. wpexample): " SNAKE

# Validate input.
if [ -z "$NAME" ] || [ -z "$SLUG" ] || [ -z "$NAMESPACE" ] || [ -z "$PREFIX" ] || [ -z "$SNAKE" ]; then
    echo -e "${RED}Error: All fields are required.${NC}"
    exit 1
fi

echo ""
echo "Plugin Name:      $NAME"
echo "Plugin Slug:      $SLUG"
echo "Namespace:        $NAMESPACE"
echo "Constant Prefix:  $PREFIX"
echo "Function Prefix:  $SNAKE"
echo ""
read -p "Confirm? (y/N): " CONFIRM

if [ "$CONFIRM" != "y" ] && [ "$CONFIRM" != "Y" ]; then
    echo "Aborted."
    exit 0
fi

echo ""
echo "Replacing placeholders..."

# Replace placeholders in all text files.
find . -type f \
    \( -name "*.php" -o -name "*.json" -o -name "*.xml" \
       -o -name "*.neon" -o -name "*.yml" -o -name "*.yaml" \
       -o -name "*.md" -o -name "*.txt" -o -name "*.dist" \) \
    -not -path "./vendor/*" \
    -not -path "./.git/*" \
    -not -path "./node_modules/*" \
    -exec sed -i '' \
        -e "s/{{Plugin_Name}}/$NAME/g" \
        -e "s/{{Plugin_Namespace}}/$NAMESPACE/g" \
        -e "s/{{PLUGIN_PREFIX}}/$PREFIX/g" \
        -e "s/{{plugin-slug}}/$SLUG/g" \
        -e "s/{{plugin_prefix}}/$SNAKE/g" \
    {} +

echo -e "${GREEN}Placeholders replaced.${NC}"

# Rename main plugin file.
if [ -f "plugin-name.php" ]; then
    mv "plugin-name.php" "${SLUG}.php"
    echo -e "${GREEN}Renamed plugin-name.php → ${SLUG}.php${NC}"
fi

# Run composer install.
if command -v composer &> /dev/null; then
    echo ""
    echo "Running composer install..."
    composer install --no-interaction --quiet
    echo -e "${GREEN}Composer dependencies installed.${NC}"
else
    echo -e "${YELLOW}Warning: Composer not found. Run 'composer install' manually.${NC}"
fi

# Generate .pot file if WP-CLI is available.
if command -v wp &> /dev/null; then
    echo ""
    echo "Generating translation template..."
    wp i18n make-pot . "languages/${SLUG}.pot" --quiet 2>/dev/null || true
    echo -e "${GREEN}Translation template generated.${NC}"
fi

echo ""
echo -e "${GREEN}=== Plugin initialized: ${NAME} ===${NC}"
echo ""
echo "Next steps:"
echo "  1. Delete the scripts/ directory"
echo "  2. Update readme.txt with your plugin description"
echo "  3. Update CLAUDE.md with your plugin context"
echo "  4. Start developing in src/"
echo "  5. Run quality checks: composer lint && composer phpcs && composer phpstan"
echo ""
