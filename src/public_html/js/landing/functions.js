$(document).ready(function() {
	$(function() {
                $('a:not(#registration-options a)').bind('click',function(event){
                    var $anchor = $(this);
                    
                    $('html, body').stop().animate({
                        scrollTop: $($anchor.attr('href')).offset().top
                    }, 3000,'easeOutExpo');
					event.preventDefault();
                });
            });


	tiles = $(".fade").fadeTo(0,0);
	tiles2 = $(".tooltip").fadeTo(0,0);

	$(window).scroll(function(d,h) {
    		tiles.each(function(i) {
			        a = $(this).offset().top + $(this).height();
        			b = $(window).scrollTop() + $(window).height();
		        if (a < b) $(this).fadeTo(500,1);
		    });
	
			tiles2.each(function(i) {
			        c = $(this).offset().top + $(this).height();
        			d = $(window).scrollTop() + $(window).height();
		        if (c < d) $(this).delay(500).fadeTo(500,1);
		    });
	});
	$("#connect-to-tabs li").click(function(){
	$("#connect-to-tabs li").removeClass("active"); 
	$(this).addClass("active"); 
	var activeTab = $(this).find("a").attr("href"); 
	$(activeTab).fadeIn(600);		
	return false;
});
	
});
$('.q-1').scrollingParallax( {staticSpeed : .4,
staticScrollLimit: false,});
$('.q-2').scrollingParallax({staticSpeed : .4,
staticScrollLimit: false,});
$('.q-3').scrollingParallax({staticSpeed : .4,
staticScrollLimit: false,});
$('.q-4').scrollingParallax({staticSpeed : .4,
staticScrollLimit: false,});
$('.q-5').scrollingParallax({staticSpeed : .4,
staticScrollLimit: false,});
$('.q-6').scrollingParallax({staticSpeed : .5,
staticScrollLimit: false,});
$('.q-7').scrollingParallax({staticSpeed : .6,
staticScrollLimit: false,});
$('.q-8').scrollingParallax({staticSpeed : .6,
staticScrollLimit: false,});