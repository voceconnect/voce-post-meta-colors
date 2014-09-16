<?php
/*
  Plugin Name: Voce Meta Colors
  Plugin URI: http://vocecommunications.com
  Description: Extends Voce Post Meta with a color picker field
  Version: 1.2.1
  Author: markparolisi, voceplatforms
  Author URI: http://vocecommunications.com
  License: GPL2
 */

if ( !class_exists( 'Voce_Post_Meta_Colors' ) ) {

class Voce_Post_Meta_Colors {

	/**
	 * Setup plugin
	 */
	public static function initialize() {
		add_action( 'admin_init', array( __CLASS__, 'admin_init' ) );
		add_filter( 'meta_type_mapping', array(__CLASS__, 'meta_type_mapping') );
		add_action( 'admin_enqueue_scripts', array(__CLASS__, 'action_admin_enqueue_scripts') );
	}

	/**
	 * Add action for admin_notices
	 * @method admin_init
	 * @return void
	 */
	static function admin_init(){
		add_action( 'admin_notices', array( __CLASS__, 'check_dependencies' ) );
	}

	/**
	 * Display admin notice message
	 * @method add_admin_notice
	 * @param string $notice
	 * @return void
	 */
	static function add_admin_notice( $notice ){
		echo '<div class="error"><p>' . wp_kses_post( $notice ) . '</p></div>';
	}

	/**
	 * Checks plugin dependencies
	 * @method check_dependencies
	 * @return void
	 */
	static function check_dependencies(){
		$dependencies = array(
			'Voce Post Meta' => array(
				'url' => 'https://github.com/voceconnect/voce-post-meta',
				'class' => 'Voce_Meta_API'
			)
		);

		foreach( $dependencies as $plugin => $plugin_data ){
			if ( !class_exists( $plugin_data['class'] ) ){
				$notice = sprintf( 'The Voce Post Meta Colors Plugin cannot be utilized without the <a href="%s" target="_blank">%s</a> plugin.', esc_url( $plugin_data['url'] ), $plugin );
				self::add_admin_notice( __( $notice, 'voce-post-meta-colors' ) );
			}
		}
	}


	/**
	 * Enqueue admin JavaScripts
	 * @return void
	 */
	public static function action_admin_enqueue_scripts( $hook ) {
		$pages = apply_filters( 'voce_post_meta_colors_scripts', array('post-new.php', 'post.php',) );
		if( !in_array( $hook, $pages ) ) {
			return;
		}
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'voce-post-meta-colors', self::plugins_url( 'voce-post-meta-colors.js', __FILE__ ), array('wp-color-picker') );
	}

	/**
	 * Allow this plugin to live either in the plugins directory or inside
	 * the themes directory.
	 *
	 * @method plugins_url
	 * @param type $relative_path
	 * @param type $plugin_path
	 * @return string
	 */
	public static function plugins_url( $relative_path, $plugin_path ) {
		$template_dir = get_template_directory();

		foreach( array('template_dir', 'plugin_path') as $var ) {
			$$var = str_replace( '\\', '/', $$var ); // sanitize for Win32 installs
			$$var = preg_replace( '|/+|', '/', $$var );
		}
		if( 0 === strpos( $plugin_path, $template_dir ) ) {
			$url = get_template_directory_uri();
			$folder = str_replace( $template_dir, '', dirname( $plugin_path ) );
			if( '.' != $folder ) {
				$url .= '/' . ltrim( $folder, '/' );
			}
			if( !empty( $relative_path ) && is_string( $relative_path ) && strpos( $relative_path, '..' ) === false ) {
				$url .= '/' . ltrim( $relative_path, '/' );
			}
			return $url;
		} else {
			return plugins_url( $relative_path, $plugin_path );
		}
	}

	/**
	 * @method meta_type_mapping
	 * @param type $mapping
	 * @return array
	 */
	public static function meta_type_mapping( $mapping ) {
		$mapping['color'] = array(
			'class' => 'Voce_Meta_Field',
			'args' => array(
				'display_callbacks' => array('voce_color_field_display')
			)
		);
		return $mapping;
	}

}

Voce_Post_Meta_Colors::initialize();

/**
 * Public function for the HTML field callback
 * @param object $field
 * @param string $value
 * @param int $post_id
 */
function voce_color_field_display( $field, $value, $post_id ) {
	$palettes = isset($field->args['palettes']) ? $field->args['palettes'] : true;
	?>
	<p>
		<?php voce_field_label_display( $field ); ?>
		<input data-palettes="<?php echo esc_attr(json_encode($palettes)); ?>" type="text" class="voce-color-picker" id="<?php echo esc_attr( $field->get_input_id( ) ); ?>" name="<?php echo esc_attr( $field->get_name( ) ); ?>" value="<?php echo esc_attr( $value ); ?>" />
	</p>
	<?php
}

}// End Class Check