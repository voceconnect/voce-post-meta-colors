<?php

if( defined( 'ABSPATH' ) && function_exists('add_action') ) {
	if( !has_action('admin_init', array( 'Voce_Post_Meta_Colors', 'initialize' ) ) ) {
		add_action( 'admin_init', array( 'Voce_Post_Meta_Colors', 'initialize' ) );
	}
}