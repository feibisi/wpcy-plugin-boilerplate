<?php
/**
 * Admin settings page template.
 *
 * @package {{Plugin_Name}}
 * @since   1.0.0
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="wrap">
	<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>

	<form method="post" action="options.php">
		<?php
		// Output security fields.
		settings_fields( '{{plugin-slug}}-settings' );

		// Output setting sections and fields.
		do_settings_sections( '{{plugin-slug}}' );

		// Output save button.
		submit_button();
		?>
	</form>
</div>
