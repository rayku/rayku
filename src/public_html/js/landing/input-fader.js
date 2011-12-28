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
		$('input', $(this)).bind('propertychange keyup input paste', function(){			
			$('label', $(this).parent()).fadeOut('slow');			
		});
	});
	
})
