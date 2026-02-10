<?php
/**
 * Plugin core class.
 *
 * Central hook registration and initialization.
 * All WordPress hooks are registered here for full visibility.
 *
 * @package {{Plugin_Name}}
 * @since   1.0.0
 */

namespace {{Plugin_Namespace}};

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Core plugin class.
 *
 * @since 1.0.0
 */
class Core {

	/**
	 * Singleton instance.
	 *
	 * @var Core|null
	 */
	private static ?Core $instance = null;

	/**
	 * Initialize the plugin.
	 *
	 * @since 1.0.0
	 * @return Core
	 */
	public static function init(): Core {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Constructor. Register all hooks.
	 *
	 * @since 1.0.0
	 */
	private function __construct() {
		$this->load_textdomain();
		$this->register_hooks();
	}

	/**
	 * Load translation files.
	 *
	 * @since 1.0.0
	 */
	private function load_textdomain(): void {
		load_plugin_textdomain(
			'{{plugin-slug}}',
			false,
			dirname( plugin_basename( {{PLUGIN_PREFIX}}_PLUGIN_DIR ) ) . '/languages'
		);
	}

	/**
	 * Register all hooks.
	 *
	 * Keep all hook registrations in this method for full visibility.
	 * Context-based loading: admin classes load only in admin, frontend only on front.
	 *
	 * @since 1.0.0
	 */
	private function register_hooks(): void {
		// Admin hooks.
		if ( is_admin() ) {
			$admin = new Admin\Settings();
			add_action( 'admin_menu', array( $admin, 'add_menu_page' ) );
			add_action( 'admin_enqueue_scripts', array( $admin, 'enqueue_assets' ) );
		}

		// Frontend hooks.
		// if ( ! is_admin() ) {
		// 	$frontend = new Frontend\Public_Display();
		// 	add_action( 'wp_enqueue_scripts', array( $frontend, 'enqueue_assets' ) );
		// }

		// AJAX hooks.
		// add_action( 'wp_ajax_{{plugin_prefix}}_action', array( new Ajax\Handler(), 'handle' ) );

		// REST API hooks.
		// add_action( 'rest_api_init', array( new Rest\Routes(), 'register_routes' ) );

		// WP-CLI commands.
		// if ( defined( 'WP_CLI' ) && WP_CLI ) {
		// 	\WP_CLI::add_command( '{{plugin-slug}}', CLI\Command::class );
		// }
	}

	/**
	 * Plugin activation callback.
	 *
	 * @since 1.0.0
	 */
	public static function activate(): void {
		// Set default options.
		if ( false === get_option( '{{plugin_prefix}}_settings' ) ) {
			add_option( '{{plugin_prefix}}_settings', array() );
		}

		// Create custom tables (if needed).
		// self::create_tables();

		// Flush rewrite rules (if registering CPT/taxonomy).
		// flush_rewrite_rules();
	}

	/**
	 * Plugin deactivation callback.
	 *
	 * Do NOT delete data here. Use uninstall.php for cleanup.
	 *
	 * @since 1.0.0
	 */
	public static function deactivate(): void {
		// Clear scheduled tasks.
		// wp_clear_scheduled_hook( '{{plugin_prefix}}_cron_hook' );

		// Flush rewrite rules.
		// flush_rewrite_rules();
	}
}
