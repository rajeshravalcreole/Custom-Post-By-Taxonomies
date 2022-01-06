jQuery( document ).ready(function(jQuery) {
    get_country_list();
    
    jQuery("#country").change(function() {
        get_city_list();
    });
    jQuery("#city").change(function() {
        get_properties_listing();
    });


});
// start function for country listing 
function get_country_list(){
        jQuery.ajax({
           type : "post",
           url : myAjax.ajaxurl,
           data : {action: "get_country"},
           success: function(response) {
            response = response.substring(0, response.length - 1);
                jQuery('#country').html(response); 
                get_city_list();
           },error:function(){
            jQuery('#country').html('Not Found');
           }
        });
}
// end country listing function 

// start function for city listing 
function get_city_list(){
    var selected_country = jQuery('#country :selected').val();
    jQuery.ajax({
       type : "post",
       url : myAjax.ajaxurl,
       data : {action: "get_city",country_id: selected_country},
       success: function(response) {
        response = response.substring(0, response.length - 1);
        jQuery('#city').html(response);
        get_properties_listing();
       },error:function(){
        jQuery('#city').html('Not Found');
       }
    });
}
// end city listing function 

// start function for property listing 
function get_properties_listing(){
    var selected_country = jQuery('#country :selected').val();
    var selected_city = jQuery('#city :selected').val();   
    
    jQuery.ajax({
        type : "post",
        url : myAjax.ajaxurl,
        data : {action: "get_properties",country_id: selected_country,city_id:selected_city},
        success: function(response) {
            response = response.substring(0, response.length - 1);
            jQuery('#properties_list').html(response);
        },error:function(){
            jQuery('#properties_list').html('Not Found');
        }
     });
}
// end function for property listing 

// start function for property after pagination listing 
function get_paginate_properties(paginate_number){
    var selected_country = jQuery('#country :selected').val();
    var selected_city = jQuery('#city :selected').val();   
    
    jQuery.ajax({
        type : "post",
        url : myAjax.ajaxurl,
        data : {action: "get_properties",country_id: selected_country,city_id:selected_city,paged:paginate_number},
        success: function(response) {
            response = response.substring(0, response.length - 1);
            jQuery('#properties_list').html(response);
        },error:function(){
            jQuery('#properties_list').html('Not Found');
        }
     });
}
// end function for property after pagination listing 