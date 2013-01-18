placeholders = function (){	
	
		var defaults = {}
	
		if ( jQuery.browser.msie ){
			
			jQuery('input[type=text]').each(function(){
				
				if ( jQuery(this).attr('placeholder') != undefined && jQuery(this).val() == '' ){					
					defaults[jQuery(this).attr('id')] = jQuery(this).attr('placeholder');		
					jQuery(this).val(jQuery(this).attr('placeholder'));		
				}
				
				jQuery(this).bind({
					focusin: function(){
					
							if ( defaults[jQuery(this).attr('id')] != undefined &&
								jQuery(this).val() == defaults[jQuery(this).attr('id')] ){
									
									jQuery(this).val('');
									
								}
						},
					focusout: function(){
						
						if ( defaults[jQuery(this).attr('id')] != undefined &&
						jQuery(this).val() == '' ){
							
							jQuery(this).val(defaults[jQuery(this).attr('id')]);
							
						}
						
					}
					
				})
				
			})
			
		}
			
	}