<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Divetulum_Widget extends WP_Widget {

	public static function init() : void {
		add_action( 'widgets_init', function () {
			register_widget( __CLASS__ );
		} );
	}

	public function __construct() {
		parent::__construct(
			'divetulum_widget',
			__( 'Divetulum Tour Slider', 'divetulumwidget' ),
			array(
				'description' => __( 'Muestra tours de Tourmaster en formato premium.', 'divetulumwidget' ),
			)
		);
	}

	public function form( $instance ) {
		$defaults = divetulumwidget_get_default_args();
		$instance = wp_parse_args( (array) $instance, $defaults );
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'category' ) ); ?>">Categoría</label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'category' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'category' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['category'] ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'posts' ) ); ?>">Número de tours</label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'posts' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'posts' ) ); ?>" type="number" min="1" value="<?php echo esc_attr( $instance['posts'] ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'autoplay' ) ); ?>">Autoplay</label>
			<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'autoplay' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'autoplay' ) ); ?>">
				<option value="true" <?php selected( $instance['autoplay'], 'true' ); ?>>Sí</option>
				<option value="false" <?php selected( $instance['autoplay'], 'false' ); ?>>No</option>
			</select>
		</p>
		<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['category'] = sanitize_text_field( $new_instance['category'] ?? '' );
		$instance['posts']    = absint( $new_instance['posts'] ?? 9 );
		$instance['autoplay']  = divetulumwidget_sanitize_bool( $new_instance['autoplay'] ?? 'true' );
		return $instance;
	}

	public function widget( $args, $instance ) {
		echo $args['before_widget']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

		echo do_shortcode( sprintf(
			'[divetulum_sidebar_slider category="%s" posts="%d" autoplay="%s"]',
			esc_attr( $instance['category'] ?? '' ),
			absint( $instance['posts'] ?? 9 ),
			esc_attr( $instance['autoplay'] ?? 'true' )
		) );

		echo $args['after_widget']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}
