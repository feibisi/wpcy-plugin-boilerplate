#!/bin/bash
#
# Bump plugin version number in all required locations.
#
# Usage:
#   ./scripts/bump-version.sh 1.2.3
#
# Updates version in:
#   - Main plugin file (Plugin Header: Version)
#   - Main plugin file (define PREFIX_VERSION)
#   - readme.txt (Stable tag)

set -e

VERSION=$1

if [ -z "$VERSION" ]; then
    echo "Usage: $0 <version>"
    echo "Example: $0 1.2.3"
    exit 1
fi

# Validate semver format.
if ! echo "$VERSION" | grep -qE '^[0-9]+\.[0-9]+\.[0-9]+$'; then
    echo "Error: Version must be in semver format (x.y.z)"
    exit 1
fi

# Find main plugin file (the .php file with Plugin Name header, excluding vendor).
MAIN_FILE=$(grep -rl "Plugin Name:" --include="*.php" . \
    | grep -v vendor \
    | grep -v node_modules \
    | head -1)

if [ -z "$MAIN_FILE" ]; then
    echo "Error: Could not find main plugin file."
    exit 1
fi

echo "Updating version to ${VERSION}..."

# 1. Plugin Header: Version.
sed -i '' "s/^\( \* Version: *\).*/\1${VERSION}/" "$MAIN_FILE"
echo "  Updated: ${MAIN_FILE} (Plugin Header)"

# 2. define PREFIX_VERSION.
sed -i '' "s/\(define( '[A-Z_]*_VERSION', '\)[^']*'/\1${VERSION}'/" "$MAIN_FILE"
echo "  Updated: ${MAIN_FILE} (VERSION constant)"

# 3. readme.txt Stable tag.
if [ -f "readme.txt" ]; then
    sed -i '' "s/^Stable tag: .*/Stable tag: ${VERSION}/" readme.txt
    echo "  Updated: readme.txt (Stable tag)"
fi

echo ""
echo "Version bumped to ${VERSION}."
echo ""
echo "Next steps:"
echo "  git add -A"
echo "  git commit -m \"Release v${VERSION}\""
echo "  git tag v${VERSION}"
echo "  git push && git push --tags"
