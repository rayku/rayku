$('#register-block').hide();

$(document).ready(function() {

	$(function() {

                $('a').bind('click',function(event){

                    var $anchor = $(this);

                    

                    $('html, body').stop().animate({

                        scrollTop: $($anchor.attr('href')).offset().top

                    }, 3000,'easeOutSine');

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

	$("#login-form").hide();

	$("#registration-form").hide();

	$("#connect-to-tabs li").removeClass("active"); 

	$(this).addClass("active"); 

	var activeTab = $(this).find("a").attr("href"); 

	$(activeTab).fadeIn(600);		

	return false;

});



//store object in var for efficiency

var mainQuestion = $('.main-question input');

var initialValue = 'Type your math question here';



mainQuestion.focus(function(){

    //blank out field on focus

    if(mainQuestion.val() == initialValue){

        mainQuestion.val('');

    }

});



mainQuestion.keyup(function(){

    //animate opening here

    $('#media-logos').hide();
    $('#video-button').hide();

    $('#register-form').stop().animate({top:"-130px"},1000);

    $('#register-block').slideDown();

});



mainQuestion.blur(function(){

    //check to see if user has typed anything in

    if((mainQuestion.val() == initialValue) || !mainQuestion.val().length){

        //reset value

        mainQuestion.val(initialValue);

        //animate closing here

        $('#register-form').stop().animate({top:"0px"},500);

        $('#register-block').slideUp(); 

        $('#media-logos').show();
	 $('#video-button').show();

    }

});



	

});

$('.q-1').scrollingParallax( {staticSpeed : .6,

staticScrollLimit: false,});

$('.q-2').scrollingParallax({staticSpeed : .6,

staticScrollLimit: false,});

$('.q-3').scrollingParallax({staticSpeed : .6,

staticScrollLimit: false,});

$('.q-4').scrollingParallax({staticSpeed : .6,

staticScrollLimit: false,});

$('.q-5').scrollingParallax({staticSpeed : .6,

staticScrollLimit: false,});

$('.q-6').scrollingParallax({staticSpeed : .7,

staticScrollLimit: false,});

$('.q-7').scrollingParallax({staticSpeed : .8,

staticScrollLimit: false,});

$('.q-8').scrollingParallax({staticSpeed : .8,

staticScrollLimit: false,});

$('#video-button').click(function() {
	wistiaEmbed = jQuery("#promo-video")[0].wistiaApi;
	wistiaEmbed.play();	
});

