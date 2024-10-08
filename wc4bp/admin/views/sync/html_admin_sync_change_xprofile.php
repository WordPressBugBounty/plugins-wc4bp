<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }

// Leaven empty tag to let automation add the path disclosure line
?>
<?php /** @var wc4bp_admin_sync $this */ ?>
<b>
	<p><?php esc_html_e( 'Set the Profile Field Visibility for all existing Users:', 'wc4bp' ); ?></p>
</b>
<p>
	<?php esc_html_e( 'This function will change all field visibility to all existing users. This will only work if the option', 'wc4bp' ); ?>
</p>
<p>
	<?php esc_html_e( '"Allow Custom Visibility Change by User" is set to "Let members change this field\'s visibility".', 'wc4bp' ); ?>
</p>

<?php $this->select_visibility_levels( 'field_visibility_options' ); ?>
<input type="button" id="wc4bp_set_bp_field_visibility" name="wc4bp_options_sync[change_xprofile_visibility]" class="button wc_bp_sync_all_user_data" value="<?php esc_html_e( 'Sync Now', 'wc4bp' ); ?>">
