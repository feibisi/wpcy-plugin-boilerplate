# Setup Instructions

## Quick Start

1. Click "Use this template" on GitHub to create a new repository
2. Clone your new repository
3. Run the init script: `./scripts/init.sh`
4. Delete the `scripts/` directory
5. Start developing

## Manual Setup (alternative to init.sh)

Replace the following placeholders throughout all files:

| Placeholder | Replace With | Example |
|-------------|-------------|---------|
| `{{Plugin_Name}}` | Plugin name (PascalCase) | `WPExample` |
| `{{Plugin_Namespace}}` | PHP namespace (PascalCase) | `WPExample` |
| `{{PLUGIN_PREFIX}}` | Constant prefix (UPPER_SNAKE) | `WPEXAMPLE` |
| `{{plugin-slug}}` | Plugin slug (lowercase-hyphen) | `wpexample` |
| `{{plugin_prefix}}` | Function/option prefix (snake_case) | `wpexample` |
| `plugin-name.php` | Main file (matches slug) | `wpexample.php` |

Then run `composer install`.

## Quality Checks

```bash
# Run all checks at once.
composer check

# Or run individually:
composer lint      # PHP syntax check (Parallel Lint)
composer phpcs     # Coding standards (PHPCS + WPCS)
composer phpcbf    # Auto-fix formatting
composer phpstan   # Static analysis (PHPStan level 6)
composer test      # Unit tests (PHPUnit)
```

## Version Management

```bash
# Bump version in all required locations.
./scripts/bump-version.sh 1.2.3

# Then commit and tag.
git add -A
git commit -m "Release v1.2.3"
git tag v1.2.3
git push && git push --tags
```

## Release

Pushing a tag (`v*`) triggers the CI release job which:
1. Runs all quality checks
2. Builds a .zip with `wp dist-archive`
3. Creates a GitHub Release with the .zip attached
