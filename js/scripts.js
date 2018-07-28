(function ($, root, undefined) {
	
	$(function () {
		
		'use strict';
		
		$(document).ready(function(){

			//sidebar menu
			
		    $(".menu-side #menu-sidebar-menu > .menu-item-has-children a, .mob-cats-nav #menu-sidebar-menu > .menu-item-has-children a").click(function(){
		    	$(this).parent().siblings().find('.sub-menu').slideUp();
				/*if( $(this).find('.menu-item-has-children').length == 0){
		        	$(this).children('.sub-menu').slideToggle('slow', 'swing').addClass('submenu-open');
					console.log('radi be');
				} else {
					$(this).children('.sub-menu').slideDown('slow', 'swing').addClass('submenu-open');
				}*/
				$(this).next('.sub-menu').slideToggle('slow', 'swing').addClass('submenu-open');
		    });
			
			
			$(".menu-side #menu-sidebar-menu > .menu-item-has-children .menu-item-has-children a, .mob-cats-nav #menu-sidebar-menu > .menu-item-has-children a").click(function(){
		    	//$(this).siblings().find('.sub-menu').slideUp();
		        $(this).children('.sub-menu').slideToggle('slow', 'swing').addClass('submenu-open');
		    });

		    $('.menu-side #menu-sidebar-menu > .menu-item-has-children > a, .mob-cats-nav menu-sidebar-menu > .menu-item-has-children > a, #menu-sidebar-menu .menu-item-has-children .menu-item-has-children > a').click(function(){
		    	$(this).parent().siblings().removeClass('menu-minus');
		    	$(this).parent().toggleClass('menu-minus');
		    });

			$(".menu-side #menu-sidebar-menu li.menu-item-has-children > a, .mob-cats-nav .menu-item-has-children > a ").click(function(e) {
				 e.preventDefault();
		    });	



		    //sticky header
		    $(window).scroll(function () {
				var top = $(window).scrollTop();
				if (top >= 131) { // height of float header
					$('.header').addClass('sticky');
				//	$('.wrapper').css("paddingTop", "131px");
				} else {
					$('.header').removeClass('sticky');
					//$('.wrapper').css("paddingTop", "0px");
				}
			});
		/*	$(window).scroll(function () {
				var top = $(window).scrollTop();
				if (top > 0) { // height of float header
					$('.flex-mobile').addClass('sticky');
				} else {
					$('.flex-mobile').removeClass('sticky');
				}
			});*/

			//bottom to top
			$(window).scroll(function() {
				if ($(this).scrollTop() >= 80) {        
					$('#return-to-top').fadeIn(200);    
				} else {
					$('#return-to-top').fadeOut(200);   
				}
			});
			$('#return-to-top').click(function() {      
				$('body,html').animate({
					scrollTop : 0                      
				}, 500);
			});		



$('.quantity').on('click', '.fa-plus-square', function(e) {
        var $input = $(this).prev('input.qty');
        var val = parseInt($input.val());
        var step = $input.attr('step');
        step = 'undefined' !== typeof(step) ? parseInt(step) : 1;
        $input.val( val + step ).change();
    });
    $('.quantity').on('click', '.fa-minus-square', 
        function(e) {
        var $input = $(this).next('input.qty');
        var val = parseInt($input.val());
        var step = $input.attr('step');
        step = 'undefined' !== typeof(step) ? parseInt(step) : 1;
        if (val > 0) {
            $input.val( val - step ).change();
        } 
    });
$('.quantity').on('click', '.far', function(e) {
	$("input[name='update_cart']").prop("disabled", "false"); 
});

		    //mobile menu
			$('.header .fa-bars').click(function() {      
				$('.header .side-nav').css('width', '250px');
				$('.wrapper').css({ 'padding-left': '23px' });
				//$('body').css('background-color', 'rgba(0,0,0,0.4)');
			});		
			$('.closebtn, .body-content, .footer').click(function() {      
				$('.header .side-nav').css('width', '0');
				$('.wrapper').css({ 'padding-left': '0' });
				//$('body').css('background-color', '#fff');
			});	
			$(".side-nav .menu-item-has-children").click(function(){
				$(this).find('.sub-menu').slideToggle();
				$(this).toggleClass('rotate-icon');
			});
			$("#cat-mob-toggle").click(function(){
				$('.mob-cats-nav .menu').slideToggle();
				$(this).toggleClass('rotate-icon');
			});
			/*$(".mob-cats-nav .menu-item-has-children").click(function(){
				$(this).find('.sub-menu').slideToggle();
				$(this).toggleClass('rotate-icon');
			});*/

	
			
			//smooth scroll on same page	
			$(".single-post-data .comments a").click(function(e) {
				 e.preventDefault();
	   			
		      $('html, body').animate({
		        scrollTop: $("#respond").offset().top - 165
		      }, 2000);
		    });			
			



			

		});
		
	});
	
})(jQuery, this);
