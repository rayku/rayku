(function(safe){
	safe.fn.tooltips = function(){
		var tt;
		var pos;
		var x,y,w,h;
		var boxes = "";
		this.each(function(){	
						alert ('here');
			boxes = boxes + safe(this).attr('class') + "|";
			safe(this).mouseover(
				function(){
						tt = safe(this).attr('class');	
						
						for(var z=0;z<=(boxes.length)-2;z++){
							safe('#'+boxes[z]+'-tooltip').hide();
						}
							
					
						safe(this).removeAttr('title');
						if(safe('#'+tt+'-tooltip').hasClass('tooltip')==false){
							safe('#'+tt+'-tooltip').addClass('tooltip')
						}
						
						pos = safe(this).position();
						
						x = pos.left + Math.floor(safe(this).outerWidth()/2) - Math.floor(safe('#'+tt+'-tooltip').outerWidth()/2);
						
						y = (pos.top + safe(this).height())+6;
						
						safe('#'+tt+'-tooltip').css('top',y+'px');
						safe('#'+tt+'-tooltip').css('left',x+'px');
						
						safe('#'+tt+'-tooltip').fadeIn()
					
				}
			);
			
			safe(this).mouseout(
				function(){
					
						tt = safe(this).attr('class');	
						
						safe('#'+tt+'-tooltip').hover(
							function(){
								safe('#'+tt+'-tooltip').show();							
							},
							function(){		
								safe('#'+tt+'-tooltip').fadeOut();	
							}
						);
					
				}
			)
		})
		
		boxes = boxes.split("|");
	}
})(jQuery)
