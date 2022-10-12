<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://wdvillage.com
 * @since             1.0.0
 * @package           Wdv_About_Me_Widget
 *
 * @wordpress-plugin
 * Plugin Name:       WDV About Me Widget
 * Plugin URI:        http://wdvillage.com/product/wdv-about-me-widget/
 * Description:       With this plugin you can add 'WDV About Me Widget' widget to your theme. You can add you data or your firm data. You can add image, description, link, contact information, social links.
 * Version:           1.2.6
 * Author:            wdvillage
 * Author URI:        http://wdvillage.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wdv-about-me-widget
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'WDV_ABOUT_ME_WIDGET_VERSION', '1.2.6' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wdv-about-me-widget-activator.php
 */
function activate_wdv_about_me_widget() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wdv-about-me-widget-activator.php';
	Wdv_About_Me_Widget_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wdv-about-me-widget-deactivator.php
 */
function deactivate_wdv_about_me_widget() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wdv-about-me-widget-deactivator.php';
	Wdv_About_Me_Widget_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wdv_about_me_widget' );
register_deactivation_hook( __FILE__, 'deactivate_wdv_about_me_widget' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wdv-about-me-widget.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wdv_about_me_widget() {

	$plugin = new Wdv_About_Me_Widget();
	$plugin->run();

}
run_wdv_about_me_widget();
