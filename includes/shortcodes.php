<?php


// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;


/**
 * Shortcode to display the chatbot
 *
 */
function bm_chatbot_shortcode( $atts = array(), $content = null, $tag ) {

	extract( shortcode_atts( array( 
			'echo' => false,
			'debug' => false
	), $atts ) );

    $overlay_settings = (array) get_option( 'bm_general_settings' );
	ob_start();
	bm_get_template_part( 'chatbot', 'shortcode', true, array(
			'input_text'				=> $overlay_settings['input_text'],
	) );
	$html = ob_get_contents();
	ob_end_clean();
	
	$html = apply_filters( 'myc_template_html', $html );

	
	return $html;
}
add_shortcode( 'wp-botman', 'bm_chatbot_shortcode' );