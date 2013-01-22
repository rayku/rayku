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

var initialValue = 'Describe your question briefly here';



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
	
var animating_video = false;
	
	$('#video-button').click(function() {
	if (animating_video) {
		return;
		}
	animating_video = true;
		$('#hide-for-video').fadeTo(700, 0.0, function() {
			$('#hide-for-video').hide();
		
			$('#video-button').animate({'left': '+=595px'}, 'slow', function() {
				$(this).attr("src","images/vidbutton-hover.png");
				$('#video-button').animate({'height': '286px', 'width': '509px', 'left': '-=110px', 'margin-top': '-39px'}, 'slow', function() {
					$('#video-player').show(function() {
						$('#video-button').hide();
							wistiaEmbed = $("#video-player")[0].wistiaApi;
						wistiaEmbed.play();
						$('#close-video').show();
					});
				});
				
			});
		});
	});
	

$('#close-video').click(function() { 

		wistiaEmbed = $("#video-player")[0].wistiaApi;
		wistiaEmbed.pause();
		$('#close-video').hide();
		$('#video-button').show();
	    $('#video-player').hide(function() {
		    $('#video-button').animate({'left': '-=595px'}, 'slow', function() {
				$('#video-button').animate({'height': '208px', 'width': '356px', 'left': '+=126px', 'margin-top': '0px'}, 'slow', function() {
					$('#hide-for-video').show();
					$('#hide-for-video').fadeTo(700, 1.0);
				});
				
			});

		});     
		animating_video = false;
});	

