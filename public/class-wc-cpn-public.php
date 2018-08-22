<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://casabona.org
 * @since      1.0.0
 *
 * @package    Wc_Cpn
 * @subpackage Wc_Cpn/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Wc_Cpn
 * @subpackage Wc_Cpn/public
 * @author     Joe Casabona <jcasabona@gmail.com>
 */
class Wc_Cpn_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	public function display_cart_poduct_title( $link_text, $product_data ) {
		$cart_title = get_post_meta( $product_data['product_id'], '_wc_cpn_cart_product_title', true );
		$cart_title = ( ! empty( $cart_title ) ) ? $cart_title : get_the_title( $product_data['product_id'] );
		$product_link = get_the_permalink( $product_data['product_id'] );

		return sprintf( '<a href="%s">%s </a>', 
			esc_url( $product_link ),
			esc_attr( $cart_title )
		);
	}

	public function redirect_thank_you( $order_id ) {
		global $wp;

		$order = wc_get_order( $order_id );

		$items = $order->get_items(); 
		$item = array_pop( $items );

		$thank_you_page = get_post_meta(  $item->get_product_id(), '_wc_cpn_thank_you_page', true );

		if ( is_checkout() && ! empty( $wp->query_vars['order-received'] ) && ! empty( $thank_you_page ) ) {
			wp_redirect( $thank_you_page );
			exit;
		}
	}

}
