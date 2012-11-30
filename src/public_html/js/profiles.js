$(document).ready(function(){
	var id;
	var prev = 'profile-solomon';
	var animating = false;
	var prevLink = '#link-solomon';

	$('#profile-solomon').show();
	$('#profile-ouyang').show();
	$('#link-solomon').addClass('active-link');

	$(".board-of-advisor-right-profile").click(function() {
		if (animating == true) return;
		id = $(this).attr('id');
		id = 'profile' + id.substring(4);
		if (id == prev) return;
		animating = true;

		$(prevLink).removeClass('active-link');
		prevLink = $(this);
		$(this).addClass('active-link');

		$('#' + prev).fadeOut('slow', function() {
			$('#' + id).fadeIn('slow', function() {
   				animating = false;
 			});
		});
		prev = id;
	});

});