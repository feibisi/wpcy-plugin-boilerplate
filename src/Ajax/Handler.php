<?php
/**
 * AJAX request handler.
 *
 * Demonstrates the standard AJAX security pattern:
 * nonce verification -> capability check -> input sanitization -> process -> respond.
 *
 * @package {{Plugin_Name}}
 * @since   1.0.0
 */

namespace {{Plugin_Namespace}}\Ajax;

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * AJAX handler class.
 *
 * @since 1.0.0
 */
class Handler {

	/**
	 * Handle AJAX request.
	 *
	 * @since 1.0.0
	 */
	public function handle(): void {
		// 1. Verify nonce.
		check_ajax_referer( '{{plugin_prefix}}_ajax_nonce', 'nonce' );

		// 2. Check permissions.
		if ( ! current_user_can( 'manage_options' ) ) {
			wp_send_json_error(
				array( 'message' => __( 'Permission denied.', '{{plugin-slug}}' ) )
			);
		}

		// 3. Sanitize input.
		$data = isset( $_POST['data'] )
			? sanitize_text_field( wp_unslash( $_POST['data'] ) )
			: '';

		if ( empty( $data ) ) {
			wp_send_json_error(
				array( 'message' => __( 'Data cannot be empty.', '{{plugin-slug}}' ) )
			);
		}

		// 4. Process business logic.
		// Replace with actual logic.

		// 5. Return success response.
		wp_send_json_success(
			array( 'message' => __( 'Saved successfully.', '{{plugin-slug}}' ) )
		);
	}
}
