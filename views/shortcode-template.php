<?php
defined( 'ABSPATH' ) or die( 'Hey, you can\t access this file, you silly human!' );
// Check same class exist or not 
if(!class_exists('cpbt_shortcode_template')){
    
    // Class for load template and js/css 
    class cpbt_shortcode_template{

        // Constructor for initializing Methods to load template and required things 
        public function __construct(){

            $this->cpbt_hooks(); //Create function to add action
            $this->cpbt_load_shortcode_html(); //Create a function for loading html template
            
        }
        //End Constructor for initializing Methods to load template and required things 

        // Function for call the action to load css/js
        public function cpbt_hooks(){
            add_action( 'wp_enqueue_scripts',  $this->cpbt_enqueue() ); 
        }
        //End Function for call the action to load css/js

        // Function for displaying Template
        public function cpbt_load_shortcode_html() {
            
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
        //End Function for displaying Template

        // Function for enqueue/load the css/js
        public function cpbt_enqueue(){
            wp_enqueue_style( 'bootstrap-css', PLUGIN_URL .'assets/css/bootstrap.min.css','','',false );
            wp_enqueue_script( 'custom-js', PLUGIN_URL . 'assets/js/custom.js',array('jquery'),'',true);
            // localize the script to your domain name, so that you can reference the url to admin-ajax.php file easily
            wp_localize_script( 'custom-js', 'myAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));
        }
        //End Function for enqueue/load the css/js    
    }    
}

// Create a object for loading template and required things
if ( class_exists( 'cpbt_shortcode_template' ) ) {
    $shortcode_obj = new cpbt_shortcode_template();
}