<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://casabona.org
 * @since      1.0.0
 *
 * @package    Wc_Cpn
 * @subpackage Wc_Cpn/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wc_Cpn
 * @subpackage Wc_Cpn/admin
 * @author     Joe Casabona <jcasabona@gmail.com>
 */
class Wc_Cpn_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	public function add_cart_title_field() {
		
		global $woocommerce, $post;

		echo '<div class="wc_cpn_cart_title_field">';

		woocommerce_wp_text_input( 
			array( 
				'id'          => '_wc_cpn_cart_product_title', 
				'label'       => __( 'Cart Product Title', 'wc-cpn' ), 
				'placeholder' => '',
				'desc_tip'    => 'true',
				'description' => __( 'This will show up only on the cart page.', 'wc-cpn' ) 
			)
		);

		echo '</div>';

		echo '<div class="wc_cpn_thank_you_field">';

		woocommerce_wp_text_input( 
			array( 
				'id'          => '_wc_cpn_thank_you_page', 
				'label'       => __( 'Thank You Page', 'wc-cpn' ), 
				'placeholder' => '',
				'desc_tip'    => 'true',
				'description' => __( 'This is where users will be redirected after they purchase.', 'wc-cpn' ) 
			)
		);

		echo '</div>';

	}

	public function add_cart_title_save( $post_id ){
		
		// Text Field
		$cart_product_title = $_POST[ '_wc_cpn_cart_product_title' ];
		if ( ! empty( $cart_product_title ) ) {
			update_post_meta( $post_id, '_wc_cpn_cart_product_title', esc_attr( $cart_product_title ) );
		}

		$thank_you_page = $_POST[ '_wc_cpn_thank_you_page' ];
		update_post_meta( $post_id, '_wc_cpn_thank_you_page', esc_url( $thank_you_page ) );
	}

}
