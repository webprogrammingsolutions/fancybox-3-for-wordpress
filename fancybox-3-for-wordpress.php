<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://w3dev.com
 * @since             1.0.0
 * @package           Fb3wp
 *
 * @wordpress-plugin
 * Plugin Name:       Fancybox 3 for Wordpress
 * Plugin URI:        https://w3dev.com
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            w3dev
 * Author URI:        https://w3dev.com
 * License:           GPL-3.0
 * License URI:       http://opensource.org/licenses/gpl-3.0.html
 * Text Domain:       fb3wp
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'PLUGIN_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-fb3wp-activator.php
 */
function activate_fb3wp() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-fb3wp-activator.php';
	Fb3wp_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-fb3wp-deactivator.php
 */
function deactivate_fb3wp() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-fb3wp-deactivator.php';
	Fb3wp_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_fb3wp' );
register_deactivation_hook( __FILE__, 'deactivate_fb3wp' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-fb3wp.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_fb3wp() {

	$plugin = new Fb3wp();
	$plugin->run();

}
run_fb3wp();
