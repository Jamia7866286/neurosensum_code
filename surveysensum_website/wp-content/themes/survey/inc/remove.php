<?php

    // Remove Emoji
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');

    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );


    // Remove WP Version
    remove_action('wp_head', 'wp_generator');

    // Remove gravity forms nag
	function remove_gravity_forms_nag() {
	    update_option( 'rg_gforms_message', '' );
	    remove_action( 'after_plugin_row_gravityforms/gravityforms.php', array( 'GFForms', 'plugin_row' ) );
	}


    //Removed type from script tag

    function clean_style_tag( $input ) {
        preg_match_all( "!<link rel='stylesheet'\s?(id='[^']+')?\s+href='(.*)' type='text/css' media='(.*)' />!", $input, $matches );
        if ( empty( $matches[2] ) ) {
            return $input;
        }
        // Only display media if it is meaningful
        $media = $matches[3][0] !== '' && $matches[3][0] !== 'all' ? ' media="' . $matches[3][0] . '"' : '';
    
        return '<link rel="stylesheet" href="' . $matches[2][0] . '"' . $media . '>' . "\n";
    }
    
    /**
     * Clean up output of <script> tags
     */
    function clean_script_tag( $input ) {
        $input = str_replace( "type='text/javascript' ", '', $input );
    
        return str_replace( "'", '"', $input );
    }

    
    //Remove version from scripts
    function sdt_remove_ver_css_js( $src, $handle ) {
    $handles_with_version = [ 'style' ];

    if ( strpos( $src, 'ver=' ) && ! in_array( $handle, $handles_with_version, true ) )
        $src = remove_query_arg( 'ver', $src );

    return $src;
}