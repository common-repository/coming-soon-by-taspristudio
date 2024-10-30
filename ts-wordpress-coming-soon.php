<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://boomdevs.com/product/boomdevs-wordpress-coming-soon-plugin/
 * @since             1.1.1
 * @package           Csts
 *
 * @wordpress-plugin
 * Plugin Name:       Coming Soon by BoomDeves
 * Plugin URI:        https://boomdevs.com/product/boomdevs-wordpress-coming-soon-plugin/
 * Description:       The best WordPress coming soon plugin that offers unlimited customizations, email marketing software integrations, additional pages, with some sexy designs.
 * Version:           1.1.1
 * Author:            BoomDevs
 * Author URI:        https://boomdevs.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       csts
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
include_once( ABSPATH . 'wp-includes/pluggable.php' );

/**
 * Plugin basic information.
 */
define( 'CSTS_DIR', plugin_dir_path( __FILE__ ) );
define('CSTS_DIR_URI', plugin_dir_url(__FILE__));  
define( 'CSTS_NAME', 'csts' );
define( 'CSTS_FULL_NAME', 'Coming Soon by BoomDevs' );
define( 'CSTS_VERSION', '1.1.1' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-csts-activator.php
 */
function activate_csts() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-csts-activator.php';
	Csts_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-csts-deactivator.php
 */
function deactivate_csts() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-csts-deactivator.php';
	Csts_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_csts' );
register_deactivation_hook( __FILE__, 'deactivate_csts' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-csts.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_csts() {

	$plugin = new Csts();
	$plugin->run();

}
run_csts();