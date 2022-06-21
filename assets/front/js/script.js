(function($){

$(document).ready(function ($) {


     ////------- Testimonials Carousel
    
    var testimonial = $(".testimonial-wrapper");
    testimonial.owlCarousel({
        pagination: false,
        navigation : true,
        slideSpeed : 1000,
        stopOnHover: true,
        autoPlay: 3000,
        singleItem: true,
        transitionStyle : "backSlide",
        navigationText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>']
    });


    ////------- Testimonials Carousel
    
    var client = $(".client-list");
    client.owlCarousel({
        pagination: false,
        loop:true,
        slideSpeed : 1000,
        stopOnHover: true,
        autoPlay: 3000,
        transitionStyle : "backSlide",
        itemsCustom : [
            [0, 2],
            [576, 3],
            [768, 3],
            [992, 4]
          ],
    });
    
    /*----------------------------------------------------*/
	/*	Nav Menu & Search
	/*----------------------------------------------------*/
	
	// $(".nav > li:has(ul)").addClass("drop");
	// $(".nav > li.drop > ul").addClass("dropdown");
	// $(".nav > li.drop > ul.dropdown ul").addClass("sup-dropdown");

    /*---------------------------------------------------*/
    /* Progress Bar
    /*---------------------------------------------------*/
    $(document).ready(function($) {
	"use strict";

    
    
        $('.skill-shortcode').appear(function() {
            $('.progress').each(function(){ 
                $('.progress-bar').css('width',  function(){ return ($(this).attr('data-percentage')+'%')});
            });
        },{accY: -100});
        
        
    });    
    
    
    /*--------------------------------------------------*/
    /* Counter*/
    /*--------------------------------------------------*/ 
    $('.timer').countTo();

    $('.counter-item').appear(function() {
        $('.timer').countTo();
    },{accY: -100});
    
    
});

}(jQuery));