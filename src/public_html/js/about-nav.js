$('#about-nav a').click(function() {

	if ($(this).parent().is('#timeline')) 
		$('#timeline').addClass('active-nav');
	else
	$('#timeline').removeClass('active-nav');
})

$(function() {

            $('a').bind('click',function(event){

                var $anchor = $(this);

                

                $('html, body').stop().animate({

                    scrollTop: $($anchor.attr('href')).offset().top

                }, 3000,'easeOutSine');

				event.preventDefault();

            });

        });