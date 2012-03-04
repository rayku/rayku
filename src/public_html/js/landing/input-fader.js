$(document).ready(function(){
		
	$('.login-form-div').hide();
	$('#login-tab').click(function(){
		$('.register-form-div').hide();
		$('.login-form-div').fadeIn('fast');
		
	});
	
	$('#registration-tab').click(function(){
		$('.login-form-div').hide();
		$('.register-form-div').fadeIn('fast');
		
	});
	
	$('.input-fader').each(function(){		
		
		if($('input', $(this)).val()!=''&&$('input', $(this)).val()!=' '){		
			$('label', $(this).parent()).hide();			
		}
		
		$('input', $(this)).bind('propertychange keyup input paste', function(){			
			$('label', $(this).parent()).fadeOut('slow');			
		});
		
	});
	
	$('.play a').click(function(){
		window.document['wistia_355291'].videoPlay();
	});
	
})
