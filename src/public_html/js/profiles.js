$(document).ready(function(){
	var id;
	var prev = 'profile-ouyang';
	var animating = false;
	var prevLink = '#link-ouyang';
	$('#profile-solomon').clone().appendTo('#previous');
	$('#profile-ouyang').clone().appendTo('#current');

	$('#profile-solomon').show();
	$('#profile-ouyang').show();
	$('#link-ouyang').addClass('active-link');

	$(".board-of-advisor-right-profile").click(function() {
		// Stop the function if currently animating
		if (animating == true) return;

		id = $(this).attr('id');
		id = 'profile' + id.substring(4);
		if (id == prev) return;
		animating = true;

		$(prevLink).removeClass('active-link');
		prevLink = $(this);
		$(this).addClass('active-link');

		$('#previous').empty();
		$('#' + prev).clone().appendTo('#previous');
		$('#' + id).clone().appendTo('#current');

		$('#' + prev).fadeOut('slow', function() {
			$('#' + id).fadeIn('slow', function() {
   				animating = false;
 			});
		});
		prev = id;
	});

});