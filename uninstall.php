<?php
/**
 * Plugin uninstall cleanup.
 *
 * Fired when the plugin is uninstalled via WordPress admin.
 * Removes all plugin data from the database.
 *
 * @package {{Plugin_Name}}
 * @since   1.0.0
 */

// Abort if not called by WordPress.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

// Delete plugin options.
delete_option( '{{plugin_prefix}}_settings' );

// Drop custom tables (if any).
// global $wpdb;
// $table_name = $wpdb->prefix . '{{plugin_prefix}}_data';
// $wpdb->query( "DROP TABLE IF EXISTS {$table_name}" );

// Clear scheduled tasks (if any).
// wp_clear_scheduled_hook( '{{plugin_prefix}}_cron_hook' );

// Delete user metadata (if any).
// delete_metadata( 'user', 0, '{{plugin_prefix}}_dismissed_notice', '', true );

// Clear transients (if any).
// delete_transient( '{{plugin_prefix}}_cache' );
