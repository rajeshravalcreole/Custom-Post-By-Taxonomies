<?php
/**
 * Plugin Name: Custom Post By Taxonomies
 * Description:       Filter custom posts using custom taxonomies
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.0
 * Author:            Rajesh Raval
 * Author URI: https://github.com/rajeshravalcreole
 * Text Domain:       cpbt
 * Domain Path:       /languages
 */

defined( 'ABSPATH' ) or die( 'Hey, you can\t access this file, you silly human!' );

define('PLUGIN_URL' , WP_PLUGIN_URL . '/Custom-Post-By-Taxonomies/' ); // this constant uses in enqueue file and style


if ( ! class_exists( 'custom_post_by_tax' ) ) {
    
    // Main class of Pugin
    class custom_post_by_tax{
        
        // Constructor for loading methods and create custom post type
        public function __construct() {
            $this->cpbt_load_methods();
            $this->cpbt_create_custom_post();
            $this->cpbt_chk_display_shortcode();
        }
        // End Constructor for loading methods and create custom post type
        
        // Function for checking shortcode is used or not and render the data 
        public function cpbt_chk_display_shortcode(){
            add_shortcode( 'cpbt_display_posts', array( $this, 'cpbt_display_shortcode' ) );
        }
        // Function for checking shortcode is used or not and render the data 

        // Function For loading shortcode template and requried js and css 
        public function cpbt_display_shortcode() {
            require_once WP_PLUGIN_DIR . '/Custom-Post-By-Taxonomies/views/shortcode-template.php';                        
        }
        //End Function For loading shortcode template and requried js and css

        // Function For loading required methods 
        public function cpbt_load_methods(){
            require_once WP_PLUGIN_DIR . '/Custom-Post-By-Taxonomies/inc/filter_methods.php';
        }
        //End Function For loading required methods
        
        // Function For create custom post type 
        public function cpbt_create_custom_post(){
            require_once WP_PLUGIN_DIR . '/Custom-Post-By-Taxonomies/inc/create-cpt.php';
        }
        //End Function For create custom post type 
    }
}

// Check class exist or not and create a object of class for works a plugin
if ( class_exists( 'custom_post_by_tax' ) ) {
	$obj = new custom_post_by_tax();
}

