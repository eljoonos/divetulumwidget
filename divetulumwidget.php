<?php
/**
 * Plugin Name: Divetulum Widget
 * Description: Widget y shortcode para mostrar tours de Tourmaster en formato premium con una sola tarjeta.
 * Version: 1.0.0
 * Author: Divetulum
 * Text Domain: divetulumwidget
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'DIVETULUM_WIDGET_VERSION', '1.0.0' );
define( 'DIVETULUM_WIDGET_FILE', __FILE__ );
define( 'DIVETULUM_WIDGET_PATH', plugin_dir_path( __FILE__ ) );
define( 'DIVETULUM_WIDGET_URL', plugin_dir_url( __FILE__ ) );

require_once DIVETULUM_WIDGET_PATH . 'includes/helpers.php';
require_once DIVETULUM_WIDGET_PATH . 'includes/class-shortcode.php';
require_once DIVETULUM_WIDGET_PATH . 'includes/class-widget.php';

add_action( 'plugins_loaded', function () {
	Divetulum_Widget_Shortcode::init();
	Divetulum_Widget::init();
} );

add_action( 'wp_enqueue_scripts', function () {
	wp_register_style(
		'divetulumwidget-style',
		DIVETULUM_WIDGET_URL . 'assets/css/style.css',
		array(),
		DIVETULUM_WIDGET_VERSION
	);

	wp_register_script(
		'divetulumwidget-frontend',
		DIVETULUM_WIDGET_URL . 'assets/js/frontend.js',
		array(),
		DIVETULUM_WIDGET_VERSION,
		true
	);
} );
