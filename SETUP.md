# Setup Instructions

## Quick Start

1. Click "Use this template" on GitHub to create a new repository
2. Clone your new repository
3. Run the placeholder replacement (see below)
4. Run `composer install`
5. Start developing

## Placeholder Replacement

Replace the following placeholders throughout all files:

| Placeholder | Replace With | Example |
|-------------|-------------|---------|
| `{{Plugin_Name}}` | Plugin name (PascalCase) | `WPExample` |
| `{{Plugin_Namespace}}` | PHP namespace (PascalCase) | `WPExample` |
| `{{PLUGIN_PREFIX}}` | Constant prefix (UPPER_SNAKE) | `WPEXAMPLE` |
| `{{plugin-slug}}` | Plugin slug (lowercase-hyphen) | `wpexample` |
| `{{plugin_prefix}}` | Function/option prefix (snake_case) | `wpexample` |
| `plugin-name.php` | Main file (matches slug) | `wpexample.php` |
| `plugin-name/` | Directory name (matches slug) | `wpexample/` |

### One-liner replacement (macOS/Linux)

```bash
# Set your plugin details.
SLUG="wpexample"
NAME="WPExample"
PREFIX="WPEXAMPLE"
NAMESPACE="WPExample"
SNAKE="wpexample"

# Replace placeholders in all files.
find . -type f \( -name "*.php" -o -name "*.json" -o -name "*.xml" \
  -o -name "*.neon" -o -name "*.yml" -o -name "*.md" \) \
  -not -path "./vendor/*" -not -path "./.git/*" \
  -exec sed -i '' \
    -e "s/{{Plugin_Name}}/$NAME/g" \
    -e "s/{{Plugin_Namespace}}/$NAMESPACE/g" \
    -e "s/{{PLUGIN_PREFIX}}/$PREFIX/g" \
    -e "s/{{plugin-slug}}/$SLUG/g" \
    -e "s/{{plugin_prefix}}/$SNAKE/g" \
  {} +

# Rename main plugin file.
mv plugin-name.php "${SLUG}.php"

# Update composer.json package name.
sed -i '' "s|wpcy/{{plugin-slug}}|wpcy/${SLUG}|g" composer.json
```

## Quality Checks

```bash
# PHPCS (coding standards).
~/.composer/vendor/bin/phpcs --standard=phpcs.xml .

# Auto-fix formatting.
~/.composer/vendor/bin/phpcbf --standard=phpcs.xml .

# PHPStan (static analysis).
composer phpstan

# Generate translation file.
wp i18n make-pot . languages/${SLUG}.pot
```
