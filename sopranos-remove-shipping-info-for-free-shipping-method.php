<?php 

/**
 * Plugin Name:       Remove Shipping Info If Free Shipping Method
 * Plugin URI:        https://clwebdevelopment.com/
 * Description:       In all WooCommerce email notifications, removes shipping info if shipping method is free. If shipping is not free, normal shipping info will be shown.
 * Version:           1.0.0
 * Requires PHP:      7.2
 * Author:            Charles Loehle for Synergetic Media
 * Author URI:        https://clwebdevelopment.com/ and https://synergeticmedia.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        sopranos-remove-shipping-info-for-free-shipping-method
 * Text Domain:       sopranos-remove-shipping-info-for-free-shipping-method
 * Domain Path:       /languages
 */

 // If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) die();

// remove shipping column from emails
add_filter( 'woocommerce_get_order_item_totals', function( $total_rows, $order, $tax_display ){

  // check if "Free Shipping" method or on the customer’s account pages or when the endpoint page for order received is being displayed,  
  if( ! $order->has_shipping_method('free_shipping') || is_account_page() || is_wc_endpoint_url( 'order-received' ) )
      // show all shipping rows.
      return $total_rows; 

  // Otherwise remove shipping row.
  unset($total_rows['shipping']);

  // then return all remaining rows
  return $total_rows;
}, 11, 3 );