var startTime = 0;
var start = 0;
var end = 0;
var diff = 0;
var timerID = 0;
var useboard = false;

$(document).ready(function(){
	$('ul#drawing-tools li a').click(function() {
		$('ul#drawing-tools li a').removeClass('current-tool');	
		$(this).addClass('current-tool');
	});
	
	$('ul#color-tools li a').click(function() {
		$('ul#color-tools li a').removeClass('current');	
		$(this).addClass('current');
	});
	
	$('#t-color ul li a').click(function() {
		$('ul#color-tools li a').removeClass('current');
		var c = $(this).attr('class'); 
		$('ul#color-tools li.'+c+' a').addClass('current');
	});	
	
	$('#session').click(function() {
		if($('#session a').attr('class') == 'start') {
			$('#session a').removeClass('start');
			$('#session a').addClass('end');
			useboard = true;
			start = new Date();
			
			$('ul#drawing-tools li a').removeClass('current-tool');	
			jQuery.get("/chrono", {id: CONFIG.id, control: 1}, function (data) { clearTimeout(timerID); chrono(); }, "json");
		}
		else {
			$('#session a').removeClass('end');
			$('#session a').addClass('start');
			tool = '';
			useboard = false;
			$('ul#drawing-tools li a').removeClass('current-tool');	
			
			jQuery.get("/chrono", {id: CONFIG.id, control: 0}, function (data) { clearTimeout(timerID); }, "json");
			
			$('#dialog-2 p').replaceWith("<p>Session ended.</p>");
			$('#dialog-2').dialog('open');
		}
	});
	
	$(function() {
		$("#dialog").dialog({ 
			autoOpen: false,
			buttons: { 
				"Close": function() { $(this).dialog('close'); },
				"Insert": function() { 
					var string = $(this).find('input#text-tool').val();
					var px = $(this).find('input#text-tool-x').val();
					var py = $(this).find('input#text-tool-y').val();
					write_text(string,px,py);
				
				}
			},
			resizable: false
		});
		$("#dialog-2").dialog({ 
			autoOpen: false,
			buttons: { 
				"Close": function() { 
					$(this).dialog('close'); 
					$('ul#drawing-tools li a').removeClass('current-tool');
				}
			},
			resizable: false
		});
	});
});

function write_text(string,px,py) {
	context.fillText(string, px, py);
	$('input#text-tool').val('');
	$('input#text-tool-x').val('');
	$('input#text-tool-y').val('');
	$('#dialog').dialog('close');
	draw_canvas("text", px, py, string);
}

function chrono(){
	end = new Date();
	
	diff = end - start;
	diff = new Date(diff);
	
	var sec = diff.getUTCSeconds();
	var min = diff.getUTCMinutes();
	var hr = diff.getUTCHours();
	
	//alert(end.getHours()+'-'+start.getHours());
	
	if (hr < 10){
		hr = "0" + hr;
	}
	if (min < 10){
		min = "0" + min;
	}
	if (sec < 10){
		sec = "0" + sec;
	}
	document.getElementById("timer").innerHTML = hr + ":" + min + ":" + sec;
	timerID = setTimeout("chrono()", 10);
}