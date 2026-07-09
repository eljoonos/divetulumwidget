<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Divetulum_Widget_Shortcode {

	public static function init() : void {
		add_shortcode( 'divetulum_sidebar_slider', array( __CLASS__, 'render' ) );
	}

	public static function render( $atts ) : string {
		if ( ! divetulumwidget_has_tourmaster() ) {
			return '<p>Tourmaster no está activo.</p>';
		}

		$atts = shortcode_atts( divetulumwidget_get_default_args(), $atts, 'divetulum_sidebar_slider' );

		$category   = sanitize_text_field( $atts['category'] );
		$posts      = divetulumwidget_sanitize_int( $atts['posts'], 9 );
		$autoplay   = divetulumwidget_sanitize_bool( $atts['autoplay'] );
		$interval   = divetulumwidget_sanitize_int( $atts['interval'], 5000 );
		$nav        = divetulumwidget_sanitize_bool( $atts['nav'] );
		$dots       = divetulumwidget_sanitize_bool( $atts['dots'] );
		$style      = sanitize_text_field( $atts['style'] );
		$grid_style = sanitize_text_field( $atts['grid_style'] );

		wp_enqueue_style( 'divetulumwidget-style' );
		wp_enqueue_script( 'divetulumwidget-frontend' );

		$config = array(
			'category'   => $category,
			'posts'      => $posts,
			'autoplay'   => $autoplay,
			'interval'   => $interval,
			'nav'        => $nav,
			'dots'       => $dots,
			'style'      => $style,
			'gridStyle'  => $grid_style,
		);

		ob_start();
		?>
		<div class="divetulum-sidebar-slider" data-config="<?php echo esc_attr( wp_json_encode( $config ) ); ?>">
			<p class="divetulum-sidebar-slider__notice">
				Este contenedor se conectará al render de Tourmaster en la siguiente fase.
			</p>
		</div>
		<?php
		return ob_get_clean();
	}
}
