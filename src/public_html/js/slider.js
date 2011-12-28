 /*$(document).ready(function(){
	$('ul.tabNav a.tab').click(function() {
		var curChildIndex = $(this).parent().prevAll().length + 1;
		$(this).parent().parent().children('.current').removeClass('current');
		$(this).parent().addClass('current');
		$(this).parent().parent().next('.tabContainer').children('.current').fadeOut('fast',function() {
			$(this).removeClass('current');
			$(this).parent().children('div:nth-child('+curChildIndex+')').fadeIn('normal',function() {
				$(this).addClass('current');
			});
		});
		return false;
	});
}); */