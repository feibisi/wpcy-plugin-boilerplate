<?php
/**
 * REST API route registration.
 *
 * Demonstrates the standard REST API pattern with permission_callback.
 *
 * @package {{Plugin_Name}}
 * @since   1.0.0
 */

namespace {{Plugin_Namespace}}\Rest;

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * REST routes class.
 *
 * @since 1.0.0
 */
class Routes {

	/**
	 * REST API namespace.
	 *
	 * @var string
	 */
	private const API_NAMESPACE = '{{plugin-slug}}/v1';

	/**
	 * Register REST API routes.
	 *
	 * @since 1.0.0
	 */
	public function register_routes(): void {
		register_rest_route(
			self::API_NAMESPACE,
			'/settings',
			array(
				array(
					'methods'             => \WP_REST_Server::READABLE,
					'callback'            => array( $this, 'get_settings' ),
					'permission_callback' => array( $this, 'check_admin_permission' ),
				),
				array(
					'methods'             => \WP_REST_Server::EDITABLE,
					'callback'            => array( $this, 'update_settings' ),
					'permission_callback' => array( $this, 'check_admin_permission' ),
				),
			)
		);
	}

	/**
	 * Check if current user has admin permission.
	 *
	 * @since 1.0.0
	 * @return bool
	 */
	public function check_admin_permission(): bool {
		return current_user_can( 'manage_options' );
	}

	/**
	 * Get plugin settings.
	 *
	 * @since 1.0.0
	 * @param \WP_REST_Request $request REST request object.
	 * @return \WP_REST_Response
	 */
	public function get_settings( \WP_REST_Request $request ): \WP_REST_Response {
		$settings = get_option( '{{plugin_prefix}}_settings', array() );

		return new \WP_REST_Response(
			array( 'data' => $settings ),
			200
		);
	}

	/**
	 * Update plugin settings.
	 *
	 * @since 1.0.0
	 * @param \WP_REST_Request $request REST request object.
	 * @return \WP_REST_Response
	 */
	public function update_settings( \WP_REST_Request $request ): \WP_REST_Response {
		$params   = $request->get_json_params();
		$settings = array();

		// Sanitize each field explicitly.
		if ( isset( $params['example_field'] ) ) {
			$settings['example_field'] = sanitize_text_field( $params['example_field'] );
		}

		update_option( '{{plugin_prefix}}_settings', $settings );

		return new \WP_REST_Response(
			array(
				'data'    => $settings,
				'message' => __( 'Settings updated.', '{{plugin-slug}}' ),
			),
			200
		);
	}
}
