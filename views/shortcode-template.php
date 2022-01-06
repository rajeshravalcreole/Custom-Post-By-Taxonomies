<?php
defined( 'ABSPATH' ) or die( 'Hey, you can\t access this file, you silly human!' );

if(!class_exists('shortcode_template')){
    class shortcode_template{
        public static function instance() {
            if ( is_null( self::$instance ) ) {
                self::$instance = new self();
            }
            return self::$instance;
        }
        public function __construct(){
            $this->hooks();
            $this->load_shortcode_html();
        }
        public function load_shortcode_html() {
            
            echo '<div class="container">
                <div class="row">
                    <div class="form-group col-md-6">
                    <label for="country">Select Country</label>
                    <select class="form-control" id="country">
                        
                    </select>
                    </div>

                    <div class="form-group col-md-6">
                    <label for="city">Select City</label>
                    <select class="form-control" id="city">
                    </select>
                    </div>
                </div>  
                <div class="row">
                <div class="row" id="properties_list">
                
                </div>
            </div>';
        }
        public function hooks(){
            
            add_action( 'wp_enqueue_script', array( $this, 'wpbt_enqueue' ) ); 
        }
        public function wpbt_enqueue(){

            wp_enqueue_style( 'bootstrap-css', plugins_url( 'assets/css/bootstrap.min.css', __FILE__ ) );
            wp_enqueue_script( 'jquery-min-js', plugins_url( 'assets/js/jquery.min.js', __FILE__ ));
            wp_enqueue_script( 'custom-js', plugins_url( 'assets/js/custom.js', __FILE__ ),'','',true);
            // localize the script to your domain name, so that you can reference the url to admin-ajax.php file easily
            wp_localize_script( 'custom-js', 'myAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));

        }
    }
}
$shortcode_obj = new shortcode_template();
?>