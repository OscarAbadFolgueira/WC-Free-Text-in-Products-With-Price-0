<?php
/**     
 * Plugin Name: WC Free Text in Products With Price 0
 * Plugin URI: https://www.valhallawp.com/plugins/wc-free-text-in-products-with-price-0/
 * Version: 1.0
 * Description: This plugin lets you show the text "Free!" in products with price 0.
 * Author: oabadfol
 * Tested up to: 4.8.2
 * Author URI: http://www.valhallawp.com
 * Text Domain: valh-wcftipwp0
 * Domain Path: /languages/
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 */

// Go away!
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Check if WooCommerce is installed and active
 **/
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ), true ) ) {

	// Localization
	load_plugin_textdomain( 'woocustomizer', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	
	/**
	 * UP_Woocustomizer
	 */
	 
	if ( ! class_exists( 'VALH_Wcftipwp0' ) ) {

		final class VALH_Wcftipwp0 {

			/**
			 * The constructor!
			 */
			public function __construct() {

				add_filter( 'woocommerce_get_price_html', array( $this, 'valh_wc_free_text_in_products_with_price_0'), 10, 2 );
			}


			public function valh_wc_free_text_in_products_with_price_0( $price, $product ) {
				if ( $product->get_price() == 0 ) {
					if ( $product->is_on_sale() && $product->get_regular_price() ) {
						$regular_price = wc_get_price_to_display( $product, array( 'qty' => 1, 'price' => $product->get_regular_price() ) );

						$price = wc_format_price_range( $regular_price, __( 'Free!', 'valh-wcftipwp0' ) );
					} else {
						$price = '<span class="amount">' . __( 'Free!', 'valh-wcftipwp0' ) . '</span>';
					}
				}

				return $price;
			} // End of main function

		} // End of VALH_Wcftipwp0 class

		$valh_wcftipwp0 = new VALH_Wcftipwp0();

	} // End of checking if class exists

} // End of checking if Woocommerce is installed and active