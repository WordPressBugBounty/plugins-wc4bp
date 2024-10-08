<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * @package        WordPress
 * @subpackage        BuddyPress, WooCommerce
 * @author            Boris Glumpler
 * @copyright        2011, Themekraft
 * @link            https://github.com/Themekraft/BP-Shop-Integration
 * @license            http://www.opensource.org/licenses/gpl-2.0.php GPL License
 */

/**
 * Get the tracking page id
 *
 * @since     1.0
 */
function wc4bp_get_tracking_page_id() {
	_deprecated_function( __FUNCTION__, 'WC4BP 1.0.5', "woocommerce_get_page_id( 'order_tracking' )" );

	return woocommerce_get_page_id( 'order_tracking' );
}
