# {{Plugin_Name}} - AI Context

> This file helps AI assistants (Claude, GPT, etc.) understand the plugin architecture.
> Update this file as the plugin evolves.

## Plugin Identity

- **Plugin Name:** {{Plugin_Name}}
- **Text Domain:** {{plugin-slug}}
- **Author:** WPCY.COM
- **Minimum WP:** 6.0
- **Minimum PHP:** 8.0

## Architecture

This plugin uses **Vanilla WordPress API + PSR-4 autoloading**.
No third-party framework. All hooks registered explicitly in `src/Core.php`.

### Directory Structure

```
src/
├── Core.php         # Hook registration center (entry point)
├── Admin/           # Admin-only classes (loaded when is_admin())
├── Frontend/        # Frontend-only classes
├── Ajax/            # AJAX request handlers
├── Rest/            # REST API endpoints
├── CLI/             # WP-CLI commands
├── Models/          # Data models (CPT, Taxonomy, custom tables)
├── Services/        # Business logic (pure PHP, testable)
├── Helpers/         # Utility functions
└── Blocks/          # Gutenberg block PHP classes
```

### Key Patterns

- **Namespace:** `{{Plugin_Namespace}}`
- **Constants:** `{{PLUGIN_PREFIX}}_VERSION`, `{{PLUGIN_PREFIX}}_PLUGIN_DIR`, `{{PLUGIN_PREFIX}}_PLUGIN_URL`
- **Singleton:** Core class uses singleton pattern via `Core::init()`
- **Context loading:** Admin classes only instantiated inside `is_admin()` check
- **Hook registration:** ALL hooks registered in `Core::register_hooks()` for visibility

## Coding Standards

- **Style:** WordPress PHP Coding Standards (snake_case, tabs, spaces in parentheses)
- **Comments:** English only. DocBlocks with `@since` tags required.
- **Security:** Nonce verification, capability checks, input sanitization, output escaping.
- **PHPCS:** `phpcs.xml` (WordPress-Extra + WordPress-Docs)
- **PHPStan:** `phpstan.neon` (level 6)

## Data Storage

- **Options:** `{{plugin_prefix}}_settings` (serialized array)
- **Custom Tables:** (none yet)
- **Transients:** (none yet)
- **User Meta:** (none yet)

## Dependencies

- No external PHP dependencies (Composer used only for autoloading + dev tools)
- No JavaScript framework (vanilla JS, or @wordpress/scripts if blocks needed)
