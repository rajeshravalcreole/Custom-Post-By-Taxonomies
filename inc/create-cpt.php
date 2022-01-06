<?php

defined( 'ABSPATH' ) or die( 'Hey, you can\t access this file, you silly human!' );

if(!class_exists('cpbt_create_cpt')){
    // Class for creating a custom post type 
    class cpbt_create_cpt{
        
        public function __construct(){
            add_action( 'init', array( $this, 'cpbt_custom_post_type' ) );
            add_action( 'init', array( $this, 'cpbt_custom_taxonomy' ) );
        }

        public function cpbt_custom_post_type() {
            $supports = array(
                'title', // post title
                'editor', // post content
                'author', // post author
                'thumbnail', // featured images
                'excerpt', // post excerpt
                'custom-fields', // custom fields
                );
                
            $labels = array(
                'name' => _x('properties', 'plural'),
                'singular_name' => _x('properties', 'singular'),
                'menu_name' => _x('properties', 'admin menu'),
                'name_admin_bar' => _x('properties', 'admin bar'),
                'add_new' => _x('Add New', 'add new'),
                'add_new_item' => __('Add New properties'),
                'new_item' => __('New properties'),
                'edit_item' => __('Edit properties'),
                'view_item' => __('View properties'),
                'all_items' => __('All properties'),
                'search_items' => __('Search properties'),
                'not_found' => __('No properties found.'),
                );
                
            $args = array(
                'supports' => $supports,
                'labels' => $labels,
                'public' => true,
                'query_var' => true,
                'rewrite' => array('slug' => 'properties'),
                'has_archive' => true,
                'taxonomies' => ['country','city'],
                );
                register_post_type('properties', $args);
        }


        public function cpbt_custom_taxonomy(){
            /* Country Custom taxonomy for properties */

            register_taxonomy('country', ['properties'], [
                'label' => __('Country', 'txtdomain'),
                'hierarchical' => true,
                'rewrite' => ['slug' => 'country'],
                'show_admin_column' => true,
                'show_in_rest' => true,
                'labels' => [
                    'singular_name' => __('Country', 'txtdomain'),
                    'all_items' => __('All Country', 'txtdomain'),
                    'edit_item' => __('Edit Country', 'txtdomain'),
                    'view_item' => __('View Country', 'txtdomain'),
                    'update_item' => __('Update Country', 'txtdomain'),
                    'add_new_item' => __('Add New Country', 'txtdomain'),
                    'new_item_name' => __('New Country Name', 'txtdomain'),
                    'search_items' => __('Search Country', 'txtdomain'),
                    'parent_item' => __('Parent Country', 'txtdomain'),
                    'parent_item_colon' => __('Parent Country:', 'txtdomain'),
                    'not_found' => __('No Country found', 'txtdomain'),
                ]
                ]);
            register_taxonomy_for_object_type('country', 'properties');
            /* End Country Custom taxonomy for properties */

            /* City Custom taxonomy for properties */
            register_taxonomy('city', ['properties'], [
                'label' => __('City', 'txtdomain'),
                'hierarchical' => true,
                'rewrite' => ['slug' => 'city'],
                'show_admin_column' => true,
                'labels' => [
                    'singular_name' => __('City', 'txtdomain'),
                    'all_items' => __('All City', 'txtdomain'),
                    'edit_item' => __('Edit City', 'txtdomain'),
                    'view_item' => __('View City', 'txtdomain'),
                    'update_item' => __('Update City', 'txtdomain'),
                    'add_new_item' => __('Add New City', 'txtdomain'),
                    'new_item_name' => __('New City Name', 'txtdomain'),
                    'search_items' => __('Search City', 'txtdomain'),
                    'popular_items' => __('Popular City', 'txtdomain'),
                    'separate_items_with_commas' => __('Separate authors with comma', 'txtdomain'),
                    'choose_from_most_used' => __('Choose from most used City', 'txtdomain'),
                    'not_found' => __('No City found', 'txtdomain'),
                ]
            ]);
            register_taxonomy_for_object_type('city', 'properties');
            /* End City Custom taxonomy for properties */ 
        }
    }
}

// Create a object of class for creating a custom post type 
if ( class_exists( 'cpbt_create_cpt' ) ) {
    $create_cpt = new cpbt_create_cpt();
}