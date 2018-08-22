<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://casabona.org
 * @since             0.5
 * @package           Wc_Cpn
 *
 * @wordpress-plugin
 * Plugin Name:       Woo Product Tools
 * Plugin URI:        https://github.com/jcasabona/woo-product-tools/
 * Description:      This is a simple plugin for WooCommerce that will change the product title in the cart to help prevent cart abandonment.
 * Version:           0.7
 * Author:            Joe Casabona
 * Author URI:        https://casabona.org
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wc-cpn
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'PLUGIN_NAME_VERSION', '0.5' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wc-cpn-activator.php
 */
function activate_wc_cpn() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wc-cpn-activator.php';
	Wc_Cpn_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wc-cpn-deactivator.php
 */
function deactivate_wc_cpn() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wc-cpn-deactivator.php';
	Wc_Cpn_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wc_cpn' );
register_deactivation_hook( __FILE__, 'deactivate_wc_cpn' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wc-cpn.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wc_cpn() {

	$plugin = new Wc_Cpn();
	$plugin->run();

}
run_wc_cpn();
