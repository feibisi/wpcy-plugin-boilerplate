<?php
/**
 * Plugin Name: {{Plugin_Name}}
 * Plugin URI:  https://{{plugin-slug}}.com
 * Description: Brief description of the plugin.
 * Version:     1.0.0
 * Author:      WPCY.COM
 * Author URI:  https://wpcy.com
 * License:     GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: {{plugin-slug}}
 * Domain Path: /languages
 * Requires at least: 6.0
 * Requires PHP: 8.0
 *
 * @package {{Plugin_Name}}
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Plugin constants.
define( '{{PLUGIN_PREFIX}}_VERSION', '1.0.0' );
define( '{{PLUGIN_PREFIX}}_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( '{{PLUGIN_PREFIX}}_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( '{{PLUGIN_PREFIX}}_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );

// Composer autoloader.
if ( is_readable( __DIR__ . '/vendor/autoload.php' ) ) {
	require_once __DIR__ . '/vendor/autoload.php';
}

// Initialize plugin.
add_action( 'plugins_loaded', array( '{{Plugin_Namespace}}\\Core', 'init' ) );

// Activation hook.
register_activation_hook( __FILE__, array( '{{Plugin_Namespace}}\\Core', 'activate' ) );

// Deactivation hook.
register_deactivation_hook( __FILE__, array( '{{Plugin_Namespace}}\\Core', 'deactivate' ) );
