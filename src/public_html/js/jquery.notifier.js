(function($){
	$.fn.notifier = function(){
		var tt,ttc;
		var pos;
		var x,y,w,h;
		var boxes = "";
		$(this).each(function(){	
			boxes = boxes + $(this).attr('class') + "|";
			ttc = $(this).attr('class');	
			$('#'+ttc+'-tooltip').hide();
			$(this).mouseover(
				function(){
						tt = $(this).attr('class');	
						
						for(var z=0;z<=(boxes.length)-2;z++){
							$('#'+boxes[z]+'-tooltip').hide();
						}
							
					
						$(this).removeAttr('title');
						if($('#'+tt+'-tooltip').hasClass('tooltip')==false){
							$('#'+tt+'-tooltip').addClass('tooltip')
						}
						
						pos = $(this).position();
						
						x = pos.left + Math.floor($(this).outerWidth()/2) - Math.floor($('#'+tt+'-tooltip').outerWidth()/2);
						
						y = (pos.top + $(this).height())+6;
						
						$('#'+tt+'-tooltip').css('top',y+'px');
						$('#'+tt+'-tooltip').css('left',x+'px');
						
						$('#'+tt+'-tooltip').fadeIn('fast')
					
				}
			);
			
			$(this).mouseout(
				function(){
					
						tt = $(this).attr('class');	
						if(!$('#'+tt+'-tooltip').hasClass('html-able')){
							$('#'+tt+'-tooltip').fadeOut(fast);
						} else {							
							$('#'+tt+'-tooltip').bind('mouseenter',function(){
									$('#'+tt+'-tooltip').show();		});									
							$('#'+tt+'-tooltip').bind('mouseleave',function(){
									$('#'+tt+'-tooltip').fadeOut(fast);		});
						}
					
				}
			)
		})
		
		boxes = boxes.split("|");
	}
})(jQuery)
