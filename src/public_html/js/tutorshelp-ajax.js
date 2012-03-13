jQuery.noConflict();function loadVideo (step,title){

	for (var i=1;i<=5;i+=1) 
		jQuery('#step' + i).removeClass('selected'); //cleans active elements
	
	jQuery('#step'+step).addClass('selected'); //sets active link
	jQuery('#video-title').empty().html(title); //changes title
	
	jQuery('#video-content').load('/help-external/video'+step+'.html');
	jQuery('#video-description').load('/help-external/description'+step+'.html');
	
}
jQuery(document).ready(function(){
loadVideo('1','Getting Started as a Rayku Tutor');
});