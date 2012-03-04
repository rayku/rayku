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
			$(this).hover(
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
						
						$('#'+tt+'-tooltip').slideDown(150)
					
				},			
				function(){
						
							tt = $(this).attr('class');	
							var classTest = 'html-able';
							
							if ($('#'+tt+'-tooltip').hasClass('html-able')){							
								$('#'+tt+'-tooltip').hoverIntent( { over: showTip, timeout: 500, out: hideTip } );
							} else {
								$('#'+tt+'-tooltip').slideUp(150);
							}
						
					});
		})
		
		boxes = boxes.split("|");
	}
	
	function showTip (){
		$(this).show();
	}
	
	function hideTip (){
		$(this).slideUp(150);
	}
	
	$.fn.hoverIntent=function(f,g){var cfg={sensitivity:7,interval:100,timeout:0};cfg=$.extend(cfg,g?{over:f,out:g}:f);var cX,cY,pX,pY;var track=function(ev){cX=ev.pageX;cY=ev.pageY};var compare=function(ev,ob){ob.hoverIntent_t=clearTimeout(ob.hoverIntent_t);if((Math.abs(pX-cX)+Math.abs(pY-cY))<cfg.sensitivity){$(ob).unbind("mousemove",track);ob.hoverIntent_s=1;return cfg.over.apply(ob,[ev])}else{pX=cX;pY=cY;ob.hoverIntent_t=setTimeout(function(){compare(ev,ob)},cfg.interval)}};var delay=function(ev,ob){ob.hoverIntent_t=clearTimeout(ob.hoverIntent_t);ob.hoverIntent_s=0;return cfg.out.apply(ob,[ev])};var handleHover=function(e){var ev=jQuery.extend({},e);var ob=this;if(ob.hoverIntent_t){ob.hoverIntent_t=clearTimeout(ob.hoverIntent_t)}if(e.type=="mouseenter"){pX=ev.pageX;pY=ev.pageY;$(ob).bind("mousemove",track);if(ob.hoverIntent_s!=1){ob.hoverIntent_t=setTimeout(function(){compare(ev,ob)},cfg.interval)}}else{$(ob).unbind("mousemove",track);if(ob.hoverIntent_s==1){ob.hoverIntent_t=setTimeout(function(){delay(ev,ob)},cfg.timeout)}}};return this.bind('mouseenter',handleHover).bind('mouseleave',handleHover)}
	
})(jQuery)
