function loadVideo (step,title){
	
	var rayku_v = jQuery.noConflict();

	for (i=1;i<=5;i+=1) {
		if(rayku_v('step'+i).hasClass("selected")==true){
			rayku_v('step'+step).removeClass("selected");
		}
	}
	
	rayku_v('#step'+step).addClass("selected"); //sets active link
	rayku_v('#video-title').text(title); //changes title
	
	rayku_v('#video-content').load('external/video'+step+'.html');
	rayku_v('#video-description').load('external/description'+step+'.html');
	
}

function launch(){
	loadVideo('1','Getting Started as a Rayku Tutor');
}
