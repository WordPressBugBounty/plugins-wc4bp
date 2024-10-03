<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * @package        WordPress
 * @subpackage     BuddyPress, WooCommerce
 * @author         GFireM
 * @copyright      2017, Themekraft
 * @link           http://themekraft.com/store/woocommerce-buddypress-integration-wordpress-plugin/
 * @license        http://www.opensource.org/licenses/gpl-2.0.php GPL License
 */

class wc4bp_Manage_Admin {

	public function __construct() {
		try {
			add_action( 'admin_enqueue_scripts', array( $this, 'wc4bp_admin_js' ), 10 );
			if ( is_admin() && wc4bp_Manager::is_woocommerce_active() ) {
				// API License Key Registration Form
				require_once WC4BP_ABSPATH . 'admin/admin.php';
				new wc4bp_admin();
			}
		} catch ( Exception $exception ) {
			WC4BP_Loader::get_exception_handler()->save_exception( $exception->getTrace() );
		}
	}

	/**
	 * Enqueue admin JS and CSS
	 *
	 * @author  Sven Lehnert
	 * @package WC4BP
	 * @since   1.0
	 *
	 * @param $hook
	 */
	public function wc4bp_admin_js( $hook ) {
		try {
			add_thickbox();
			wp_enqueue_script( 'jquery' );
			wp_enqueue_script( 'jquery-ui-core' );
			wp_enqueue_script( 'jquery-ui-widget' );
			wp_enqueue_script( 'jquery-ui-tabs' );
			wp_enqueue_script( 'jquery-effects-core' );
			wp_enqueue_script( 'jquery-ui-sortable' );
			wp_register_script( 'freemius-checkout', 'https://checkout.freemius.com/checkout.min.js', array(), false );
    		wp_enqueue_script( 'freemius-checkout' );
			wp_register_style( 'gopro-screen', wc4bp_Manager::assets_path( 'gopro-screen', 'css' ), array(), false );
    		wp_enqueue_style( 'gopro-screen' );
			wp_register_script( 'gopro-screen-js', wc4bp_Manager::assets_path( 'gopro-screen-script' ), array( 'jquery' ), WC4BP_Loader::VERSION );
    		wp_enqueue_script( 'gopro-screen-js' );
			$admin_script = wc4bp_Manager::assets_path( 'admin' );
			wp_enqueue_script(
				'wc4bp_admin_js',
				$admin_script,
				array(
					'jquery',
					'jquery-ui-core',
					'jquery-ui-widget',
					'jquery-ui-tabs',
					'jquery-ui-sortable',
				),
				WC4BP_Loader::VERSION
			);
			wp_localize_script(
				'wc4bp_admin_js',
				'wc4bp_admin_js',
				array(
					'nonce'   => wp_create_nonce( 'wc4bp_admin_sync_nonce' ),
				)
			);
			wp_enqueue_style( 'wc4bp_admin_spinner_css', wc4bp_Manager::assets_path( 'loading-spiner', 'css' ) );
			wp_enqueue_style( 'dashicons' );
			$admin_style = wc4bp_Manager::assets_path( 'admin', 'css' );
			wp_enqueue_style( 'wc4bp_admin_css', $admin_style );
			if ( 'users_page_bp-profile-setup' === $hook ) {
				$fields = wc4bp_Sync::wc4bp_get_xprofield_fields_ids();
				if ( ! empty( $fields ) ) {
					if ( ! empty( $fields['shipping']['first_name'] ) && ! empty( $fields['billing']['first_name'] ) ) {
						$shipping_field = BP_XProfile_Field::get_instance( $fields['shipping']['first_name'], null, false );
						$billing_field  = BP_XProfile_Field::get_instance( $fields['billing']['first_name'], null, false );
						if ( ! empty( $shipping_field ) && ! empty( $billing_field ) ) {
							wp_enqueue_script( 'wc4bp_admin_xprofield', wc4bp_Manager::assets_path( 'wc4bp-xprofield' ), array( 'jquery' ), WC4BP_Loader::VERSION );
							wp_localize_script(
								'wc4bp_admin_xprofield',
								'wc4bp_admin_xprofield',
								array(
									'billing'            => $billing_field->group_id,
									'shipping'           => $shipping_field->group_id,
									/** This action is documented in /wc4bp-premium/admin/wc4bp-activate.php:195 */
									'shipping_text_identification' => apply_filters( 'wc4bp_shipping_group_id', 'shipping' ),
									/** This action is documented in /wc4bp-premium/admin/wc4bp-activate.php:68 */
									'billing_text_identification' => apply_filters( 'wc4bp_billing_group_id', 'billing' ),
									'autogenerated_text' => __( 'WC4BP auto-generated', 'wc4bp' ),
								)
							);
						}
					}
				}
			}
		} catch ( Exception $exception ) {
			WC4BP_Loader::get_exception_handler()->save_exception( $exception->getTrace() );
		}
	}
}
