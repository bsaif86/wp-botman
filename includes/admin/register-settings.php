<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Reister settings
 */
function bm_register_settings() {

	register_setting( 'bm_general_settings', 'bm_general_settings', 'bm_sanitize_general_settings' );

	add_settings_section( 'bm_section_general', null, 'bm_section_general_desc', 'botman&tab=bm_general_settings' );

	$setting_fields = array(
        'header_text' => array(
            'title' 	=> __( 'Header Text', 'wp-botman' ),
            'callback' 	=> 'bm_field_input',
            'page' 		=> 'botman&tab=bm_general_settings',
            'section' 	=> 'bm_section_general',
            'args' => array(
                'option_name' 	=> 'bm_general_settings',
                'setting_id' 	=> 'header_text',
                'label' 		=> __( 'Enter header text.', 'wp-botman' ),
                'placeholder'	=> __( 'Enter header text...', 'wp-botman' )
            )
        ),
        'input_text' => array(
            'title' 	=> __( 'Input Text', 'wp-botman' ),
            'callback' 	=> 'bm_field_input',
            'page' 		=> 'botman&tab=bm_general_settings',
            'section' 	=> 'bm_section_general',
            'args' => array(
                'option_name' 	=> 'bm_general_settings',
                'setting_id' 	=> 'input_text',
                'label' 		=> __( 'Enter input text.', 'wp-botman' ),
                'placeholder'	=> __( 'Enter input text...', 'wp-botman' ),
                //'required'		=> true
            )
        ),
        'change_cue' => array(
            'title' 	=> __( '', 'wp-botman' ),
            'callback' 	=> 'bm_field_label',
            'page' 		=> 'botman&tab=bm_general_settings',
            'section' 	=> 'bm_section_general',
            'args' => array(
                'option_name' 	=> 'bm_general_settings',
                'setting_id' 	=> 'change_cue',
                'label'     =>__( 'Change the url or change the IP and Host.', 'wp-botman' ),
            )
        ),
        'change_url' => array(
            'title' 	=> __( 'Change Url', 'wp-botman' ),
            'callback' 	=> 'bm_field_input',
            'page' 		=> 'botman&tab=bm_general_settings',
            'section' 	=> 'bm_section_general',
            'args' => array(
                'option_name' 	=> 'bm_general_settings',
                'setting_id' 	=> 'change_url',
                'label' 		=> __( 'Enter the url you want to change.', 'wp-botman' ),
                'placeholder'	=> __( 'Enter the url you want to change...', 'wp-botman' ),
                //'required'		=> true
            )
        ),

        'change_ip' => array(
            'title' 	=> __( 'Change IP', 'wp-botman' ),
            'callback' 	=> 'bm_field_input',
            'page' 		=> 'botman&tab=bm_general_settings',
            'section' 	=> 'bm_section_general',
            'args' => array(
                'option_name' 	=> 'bm_general_settings',
                'setting_id' 	=> 'change_ip',
                'label' 		=> __( 'Enter the IP.', 'wp-botman' ),
                'placeholder'	=> __( 'Enter the IP...', 'wp-botman' )
            )
        ),
        'change_host' => array(
            'title' 	=> __( 'Change Host', 'wp-botman' ),
            'callback' 	=> 'bm_field_input',
            'page' 		=> 'botman&tab=bm_general_settings',
            'section' 	=> 'bm_section_general',
            'args' => array(
                'option_name' 	=> 'bm_general_settings',
                'setting_id' 	=> 'change_host',
                'label' 		=> __( 'Enter the Host.', 'wp-botman' ),
                'placeholder'	=> __( 'Enter the Host...', 'wp-botman' )
            )
        ),
	);

	foreach ( $setting_fields as $setting_id => $setting_data ) {
		// $id, $title, $callback, $page, $section, $args
		add_settings_field( $setting_id, $setting_data['title'], $setting_data['callback'], $setting_data['page'], $setting_data['section'], $setting_data['args'] );
	}
}

/**
 * Set default settings if not set
 */
function bm_default_settings() {

	$general_settings = (array) get_option( 'bm_general_settings' );

	$general_settings = array_merge( array(
			'input_text'				  => __( 'Ask something...', 'botman' ),
            'header_text'				  => __( 'Botman', 'botman' ),
            'change_url'                => __( '', 'botman' ),
            'change_ip'                 => __( 'https://192.168.99.100/botman', 'botman' ),
            'change_host'               => __( 'Host: e2bot.localhost.com', 'botman' ),
            'botpic_url'                => __('wp-content/plugins/wp-botman/assets/fonts/logo.png'),
	), $general_settings );

	update_option( 'bm_general_settings', $general_settings );
}

if ( is_admin() && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) ) {
	add_action( 'admin_init', 'bm_default_settings', 10, 0 );
	add_action( 'admin_init', 'bm_register_settings' );

}


