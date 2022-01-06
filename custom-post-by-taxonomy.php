<?php
/**
 * Plugin Name: Custom Post By Taxonomies
 * Description:       Filter custom posts using custom taxonomies
 * Version:           1.10.3
 * Requires at least: 5.2
 * Requires PHP:      7.0
 * Author:            Rajesh Raval
 * Text Domain:       cpbt
 * Domain Path:       /languages
 */

defined( 'ABSPATH' ) or die( 'Hey, you can\t access this file, you silly human!' );


if ( ! class_exists( 'cpbt' ) ) {
    
    class cpbt{
        
        function __construct() {
            include_once WP_PLUGIN_DIR . '/custom-post-by-taxonomy/inc/create-cpt.php';
            $create_cpt = new cpbt_create_cpt();
            add_shortcode( 'cpbt_display_posts', array( $this, 'cpbt_display_shortcode' ) );
        }
        function cpbt_display_shortcode() {
            include_once WP_PLUGIN_DIR . '/custom-post-by-taxonomy/views/shortcode-template.php';
            
            include_once WP_PLUGIN_DIR . '/custom-post-by-taxonomy/inc/filter_methods.php';
            $shortcode_methods = new filter_methods();
        }        
    }
}

if ( class_exists( 'cpbt' ) ) {
	$obj = new cpbt();
}

