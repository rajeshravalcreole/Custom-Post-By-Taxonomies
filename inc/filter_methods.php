<?php 

    if(!class_exists('filter_methods')){

        // Create a class for methods 
        class filter_methods{
            
            // Constructor for load the methods 
            public function __construct(){
                $this->cpbt_load_ajax_methods();
            }
            // Function for loading all ajax methods 
            public function cpbt_load_ajax_methods(){

            // Actions for getting country list 
            add_action("wp_ajax_get_country", "get_country_list");
            add_action("wp_ajax_nopriv_get_country", "get_country_list");
            
            // Method for getting country list 
            function get_country_list(){
                $country = get_terms( array(
                    'taxonomy' => 'country',
                    'hide_empty' => false,
                ) );

                foreach($country as $key => $val) {
                    ?>
                    <option value="<?php echo $country[$key]->term_id;?>"><?php echo $country[$key]->name;?></option>
            <?php }
            }
            // Method for getting country list 

            // Actions for getting city list 
            add_action("wp_ajax_get_city", "get_city_list");
            add_action("wp_ajax_nopriv_get_city", "get_city_list");
            
            // Method for getting city list
            function get_city_list(){
                $country_id = $_POST['country_id']; 
                $args_for_properties = array(
                    'post_type' => 'properties',
                    'posts_per_page'=>-1,
                    'tax_query' => array(
                        array(
                        'taxonomy' => 'country',
                        'field' => 'term_id',
                        'terms' => $country_id
                        )
                    )
                );
            $loop = new WP_Query($args_for_properties);
            if($loop->have_posts()) {
                $i=0;
                while($loop->have_posts()) : $loop->the_post();
                $list_of_city = get_the_terms( get_the_id(), 'city' );  
                foreach($list_of_city as $key => $val) {
                    if (!in_array($list_of_city[$key]->term_id, $city_array['id']))
                    {
                        $city_array['id'][$i] = $list_of_city[$key]->term_id;
                        $city_array['name'][$i] = $list_of_city[$key]->name;
                        $i++;
                    }
                }
                endwhile;       
            $k=0;
            foreach($city_array['id'] as $key => $val) {?>
                <option value="<?php echo $city_array['id'][$k];?>"><?php echo $city_array['name'][$k];?></option>
            <?php $k++;}
            }
        }

        //End Method for getting city list

            // actions for getting property list   
            add_action("wp_ajax_get_properties", "get_property_list");
            add_action("wp_ajax_nopriv_get_properties", "get_property_list");

            // Method for getting property list
            function get_property_list(){
                $selected_country_id = $_POST['country_id'];
                $selected_city_id = $_POST['city_id'];
                if(isset($_POST['paged'])){
                    $paged=$_POST['paged'];
                }else{
                    $paged = 1;
                }
                
                $args = array(
                    'post_type' => 'properties',
                    'posts_per_page'=>get_option( 'posts_per_page' ),
                    'paged'=>$paged,
                    'tax_query' => array(
                        'relation' => 'AND',
                        array(
                            'taxonomy' => 'country',
                            'field'    => 'term_id',
                            'terms'    => $selected_country_id,
                        ),
                        array(
                            'taxonomy' => 'city',
                            'field'    => 'term_id',
                            'terms'    => $selected_city_id,
                        ),
                    ),
                );
    
                $loop = new WP_Query($args);
                if($loop->have_posts()) {
                    while($loop->have_posts()) : $loop->the_post();?>
                    <div class="card" style="width:33%;float:left;">
                        <div class="card-body">
                        <h4 class="card-title"><?php the_title();?></h4>
                        <a href="<?php the_permalink();?>" class="btn btn-primary">See Profile</a>
                        </div>
                    </div>
                    <?php endwhile;
                }
                $pagination_parameters = array(
                    'post_type' => 'properties',
                    'posts_per_page'=>-1,
                    'tax_query' => array(
                        'relation' => 'AND',
                        array(
                            'taxonomy' => 'country',
                            'field'    => 'term_id',
                            'terms'    => $selected_country_id,
                        ),
                        array(
                            'taxonomy' => 'city',
                            'field'    => 'term_id',
                            'terms'    => $selected_city_id,
                        ),
                    ),
                );
                $pagination_loop = new WP_Query($pagination_parameters);

                $total_pages = ceil($pagination_loop->found_posts / get_option( 'posts_per_page' )); 
                
                    if($total_pages > 1){ 
                        $pagLink = "<ul class='pagination'>"; 
                        for ($i=1; $i<=$total_pages; $i++) {
                                    $pagLink .= "<li class='page-item'><a onclick='get_paginate_properties($i)' class='page-link'  href='javascript:void(0);'>".$i."</a></li>";	
                        }
                        echo $pagLink . "</ul>"; 
                    }    
                }
                //End Method for getting property list
            }
        }        
    }
    $shortcode_methods = new filter_methods();
?>