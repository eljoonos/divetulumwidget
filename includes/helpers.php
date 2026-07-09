<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function divetulumwidget_has_tourmaster() : bool {
	return class_exists( 'tourmaster_tour_style' ) || function_exists( 'tourmaster_get_option' );
}

function divetulumwidget_get_default_args() : array {
	return array(
		'category'   => '',
		'posts'      => 9,
		'autoplay'   => 'true',
		'interval'   => 5000,
		'nav'        => 'true',
		'dots'       => 'true',
		'style'      => 'grid-with-frame',
		'grid_style' => 'style-3',
	);
}

function divetulumwidget_sanitize_bool( $value ) : string {
	$value = strtolower( (string) $value );
	return in_array( $value, array( '1', 'true', 'yes', 'enable', 'on' ), true ) ? 'true' : 'false';
}

function divetulumwidget_sanitize_int( $value, int $default = 0 ) : int {
	if ( is_numeric( $value ) ) {
		return (int) $value;
	}
	return $default;
}
