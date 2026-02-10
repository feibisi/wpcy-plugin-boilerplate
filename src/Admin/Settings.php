<?php
/**
 * Admin settings page handler.
 *
 * @package {{Plugin_Name}}
 * @since   1.0.0
 */

namespace {{Plugin_Namespace}}\Admin;

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Settings page class.
 *
 * @since 1.0.0
 */
class Settings {

	/**
	 * Register menu page.
	 *
	 * @since 1.0.0
	 */
	public function add_menu_page(): void {
		add_options_page(
			__( '{{Plugin_Name}} Settings', '{{plugin-slug}}' ),
			__( '{{Plugin_Name}}', '{{plugin-slug}}' ),
			'manage_options',
			'{{plugin-slug}}',
			array( $this, 'render_page' )
		);
	}

	/**
	 * Enqueue admin assets.
	 *
	 * @since 1.0.0
	 * @param string $hook_suffix Current page hook.
	 */
	public function enqueue_assets( string $hook_suffix ): void {
		if ( 'settings_page_{{plugin-slug}}' !== $hook_suffix ) {
			return;
		}

		wp_enqueue_style(
			'{{plugin-slug}}-admin',
			{{PLUGIN_PREFIX}}_PLUGIN_URL . 'assets/css/admin.css',
			array(),
			{{PLUGIN_PREFIX}}_VERSION
		);

		wp_enqueue_script(
			'{{plugin-slug}}-admin',
			{{PLUGIN_PREFIX}}_PLUGIN_URL . 'assets/js/admin.js',
			array(),
			{{PLUGIN_PREFIX}}_VERSION,
			true
		);
	}

	/**
	 * Render settings page.
	 *
	 * @since 1.0.0
	 */
	public function render_page(): void {
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		include {{PLUGIN_PREFIX}}_PLUGIN_DIR . 'templates/admin-settings.php';
	}
}
