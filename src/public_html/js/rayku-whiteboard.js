var context, canvas, contextmp, canvastmp, colorStroke, colorFill;
var x, y;

var tool = '';
var tool_default = 'draw';

$(document).ready(function() {
     //Get Canvas Element  
	 canvas = document.getElementById('whiteboard');
     context = canvas.getContext('2d');
	 
	 //Get Canvas for temporal drawings Element  
	 canvastmp = document.getElementById('whiteboard-temp');
     contextmp = canvastmp.getContext('2d');
	 
	context.strokeStyle = '#000000';
	context.fillStyle = '#000000';
	 
	 //Get the tool click
	var tool_select = document.getElementById('drawing-tools');
	tool_select.addEventListener('click', ev_tool_click, false);
	
	//// Activate the default tool.
//	if (tools[tool_default]) {
//		tool = new tools[tool_default]();
//	}
	
	// Attach the mousedown, mousemove and mouseup event listeners.
	canvas.addEventListener('mousedown', ev_canvas, false);
	canvas.addEventListener('mousemove', ev_canvas, false);
	canvas.addEventListener('mouseup',   ev_canvas, false);
	
	//Set font style
	context.font = "bold 12px sans-serif";
});  

// The event handler for any changes made to the tool selector.
function ev_tool_click (ev) {
	if(useboard == true || ($('.current-tool').parent().attr('id') == 'clear')) {
		tool = new tools[$('.current-tool').parent().attr('id')]();
	}
	else {
		$('#dialog-2 p').replaceWith("<p>Click on 'Start Session' to enable the drawing board and chat session.</p>");
		$('#dialog-2').dialog('open');
	}
	//alert($('.current-tool').parent().attr('id'));
}

// This function draws the #imageTemp canvas on top of #imageView, after which 
// #imageTemp is cleared. This function is called each time when the user 
// completes a drawing operation.
function img_update () {
	context.drawImage(canvastmp, 0, 0);
	contextmp.clearRect(0, 0, canvastmp.width, canvastmp.height);
}

// This object holds the implementation of each drawing tool.
var tools = {};

//Text tool
tools.text = function () {
	var tool = this;
	
	// This is called when you start holding down the mouse button.
	// This starts the pencil drawing.
	this.mousedown = function (ev) {
		$('#dialog').dialog('option','position', [ev.pageX, ev.pageY]);
		$('input#text-tool-x').val(ev._x);
		$('input#text-tool-y').val(ev._y);
		$('#dialog').dialog('open');
		$('#dialog input#text-tool').focus();
	};
}

// Drawing pencil.
tools.draw = function () {
	var tool = this;
	this.started = false;
	
	// This is called when you start holding down the mouse button.
	// This starts the pencil drawing.
	this.mousedown = function (ev) {
		context.beginPath();
		context.moveTo(ev._x, ev._y);
		context.lineTo(ev._x, ev._y+1);
		context.closePath();
		tool.started = true;
		draw_canvas("draw",ev._x,ev._y,'open');
	};
	
	// This function is called every time you move the mouse. Obviously, it only 
	// draws if the tool.started state is set to true (when you are holding down 
	// the mouse button).
	this.mousemove = function (ev) {
		if (tool.started) {
			context.lineTo(ev._x, ev._y);
			context.stroke();
			draw_canvas("draw",ev._x,ev._y,'');
		}
	};
	
	// This is called when you release the mouse button.
	this.mouseup = function (ev) {
		if (tool.started) {
			tool.started = false;
			context.closePath();
			draw_canvas("draw",ev._x,ev._y,'close');
		}
	};

}

//Erase Tool
tools.erase = function () {
	var tool = this;
	this.started = false;
	
	colorStroke = context.strokeStyle;
	colorFill = context.fillStyle;
	
	
	// This is called when you start holding down the mouse button.
	// This starts the pencil drawing.
	this.mousedown = function (ev) {
		context.strokeStyle = '#ffffff';
		context.fillStyle = '#ffffff';
		context.lineWidth = 10;
		context.beginPath();
		context.moveTo(ev._x, ev._y);
		tool.started = true;
		draw_canvas("erase",ev._x,ev._y,'open');
	};
	
	// This function is called every time you move the mouse. Obviously, it only 
	// draws if the tool.started state is set to true (when you are holding down 
	// the mouse button).
	this.mousemove = function (ev) {
		if (tool.started) {
			context.lineTo(ev._x, ev._y);
			context.stroke();
			draw_canvas("erase",ev._x,ev._y,'');
		}
	};
	
	// This is called when you release the mouse button.
	this.mouseup = function (ev) {
		if (tool.started) {
			tool.started = false;
			context.strokeStyle = colorStroke;
			context.fillStyle = colorFill;
			context.lineWidth = 1;
			draw_canvas("erase",ev._x,ev._y,'close');
		}
	};

}

//Line tool
tools.line = function () {
	var tool = this;
	this.started = false;
	
	this.mousedown = function (ev) {
		tool.started = true;
		tool.x0 = ev._x;
		tool.y0 = ev._y;
	};
	
	this.mousemove = function (ev) {
		if (!tool.started) {
			return true;
		}
		
		contextmp.clearRect(0, 0, canvastmp.width, canvastmp.height);
		
		contextmp.beginPath();
		contextmp.moveTo(tool.x0, tool.y0);
		contextmp.lineTo(ev._x,   ev._y);
		contextmp.stroke();
		contextmp.closePath();
	};
	
	this.mouseup = function (ev) {
		if (tool.started) {
			tool.mousemove(ev);
			tool.started = false;
			img_update();
			draw_canvas("line",tool.x0,tool.y0,'',ev._x,ev._y);
		}
	};

}

//Arrow tool
tools.arrow = function () {
	var tool = this;
	this.started = false;
	
	this.mousedown = function (ev) {
		tool.started = true;
		tool.x0 = ev._x;
		tool.y0 = ev._y;
	};
	
	this.mousemove = function (ev) {
		if (!tool.started) {
			return true;
		}
		
		contextmp.clearRect(0, 0, canvastmp.width, canvastmp.height);
		
		contextmp.beginPath();
		contextmp.moveTo(tool.x0, tool.y0);
		contextmp.lineTo(ev._x,   ev._y);
		contextmp.stroke();
		contextmp.closePath();
		
		//Draw the arrow points
		
		var endPoint1 = new Array(); 
		var endPoint2 = new Array(); 
		
		endPoint1 = calc_arrow1(tool.x0, tool.y0, ev._x,ev._y);
		endPoint2 = calc_arrow2(tool.x0, tool.y0, ev._x,ev._y);
		
		contextmp.beginPath();
		contextmp.moveTo(ev._x,ev._y);
		contextmp.lineTo(endPoint1[0],endPoint1[1]);
		contextmp.moveTo(ev._x,ev._y);
		contextmp.lineTo(endPoint2[0],endPoint2[1]);
		contextmp.lineTo(endPoint1[0],endPoint1[1]);
		contextmp.stroke();
		contextmp.fill();
		contextmp.closePath();
		
	};
	
	this.mouseup = function (ev) {
		if (tool.started) {
			tool.mousemove(ev);
			tool.started = false;
			img_update();
			draw_canvas("arrow",tool.x0,tool.y0,'',ev._x,ev._y);
		}
	};

}

//Arrow2 tool
tools.arrow2 = function () {
	var tool = this;
	this.started = false;
	
	this.mousedown = function (ev) {
		tool.started = true;
		tool.x0 = ev._x;
		tool.y0 = ev._y;
	};
	
	this.mousemove = function (ev) {
		if (!tool.started) {
			return true;
		}
		
		contextmp.clearRect(0, 0, canvastmp.width, canvastmp.height);
		contextmp.beginPath();
		contextmp.moveTo(tool.x0, tool.y0);
		contextmp.lineTo(ev._x,ev._y);
		contextmp.stroke();
		contextmp.closePath();
		
		//Draw the arrow end points
		
		var endPoint1 = new Array(); 
		var endPoint2 = new Array(); 
		
		endPoint1 = calc_arrow1(tool.x0, tool.y0, ev._x,ev._y);
		endPoint2 = calc_arrow2(tool.x0, tool.y0, ev._x,ev._y);
		
		contextmp.beginPath();
		contextmp.moveTo(ev._x,ev._y);
		contextmp.lineTo(endPoint1[0],endPoint1[1]);
		contextmp.moveTo(ev._x,ev._y);
		contextmp.lineTo(endPoint2[0],endPoint2[1]);
		contextmp.lineTo(endPoint1[0],endPoint1[1]);
		contextmp.stroke();
		contextmp.fill();
		contextmp.closePath();
		
		
		//Draw the arrow start points
		
		var startPoint1 = new Array(); 
		var startPoint2 = new Array(); 
		
		startPoint1 = calc_arrow1(ev._x,ev._y,tool.x0, tool.y0);
		startPoint2 = calc_arrow2(ev._x,ev._y,tool.x0, tool.y0);
		
		contextmp.beginPath();
		contextmp.moveTo(tool.x0,tool.y0);
		contextmp.lineTo(startPoint1[0],startPoint1[1]);
		contextmp.moveTo(tool.x0,tool.y0);
		contextmp.lineTo(startPoint2[0],startPoint2[1]);
		contextmp.lineTo(startPoint1[0],startPoint1[1]);
		contextmp.stroke();
		contextmp.fill();
		contextmp.closePath();
	};
	
	this.mouseup = function (ev) {
		if (tool.started) {
			tool.mousemove(ev);
			tool.started = false;
			img_update();
			draw_canvas("arrow2",tool.x0,tool.y0,'',ev._x,ev._y);
		}
	};

}

//Draw rectangles tool
tools.rectangle = function () {
	var tool = this;
	this.started = false;
	
	this.mousedown = function (ev) {
		tool.started = true;
		tool.x0 = ev._x;
		tool.y0 = ev._y;
	};
	
	this.mousemove = function (ev) {
		if (!tool.started) {
			return true;
		}
		
		var w,h;
		
		w = ev._x - tool.x0;
		h = ev._y - tool.y0;
		
		contextmp.clearRect(0, 0, canvastmp.width, canvastmp.height);
		contextmp.fillRect(tool.x0, tool.y0, w, h);
	};
	
	this.mouseup = function (ev) {
		if (tool.started) {
			tool.started = false;
			img_update();
			draw_canvas("rect",tool.x0,tool.y0,'',ev._x,ev._y);
		}
	};

}

//Draw circles tool
tools.circle = function () {
	var tool = this;
	this.started = false;
	
	this.mousedown = function (ev) {
		tool.started = true;
		tool.x0 = ev._x;
		tool.y0 = ev._y;
	};
	
	this.mousemove = function (ev) {
		if (!tool.started) {
			return true;
		}
		
		var w;
		
		w = ev._x - tool.x0;
	
		contextmp.clearRect(0, 0, canvastmp.width, canvastmp.height);
		contextmp.beginPath();
		contextmp.arc(tool.x0, tool.y0, w, 0, Math.PI * 2, false);
		contextmp.stroke();
		contextmp.fill();
		contextmp.closePath();		
	};
	
	this.mouseup = function (ev) {
		if (tool.started) {
			tool.started = false;
			img_update();
			draw_canvas("circle",tool.x0,tool.y0,'',ev._x,ev._y);
		}
	};

}

//Clear all tool
tools.clear = function () {
	var tool = this;
	context.clearRect(0, 0, canvas.width, canvas.height);
	draw_canvas("clear",0,0,'',0,0);
}

function calc_arrow1 (px0,py0,px,py) {
	var points = new Array();
	var l = Math.sqrt(Math.pow((px-px0),2) + Math.pow((py-py0),2));
	
	points[0] = px - ((px-px0) * Math.cos(0.5) - (py-py0) * Math.sin(0.5))*10/l;
	points[1] = py - ((py-py0) * Math.cos(0.5) + (px-px0) * Math.sin(0.5))*10/l;
	return points;
}

function calc_arrow2 (px0,py0,px,py) {
	var points = new Array();
	var l = Math.sqrt(Math.pow((px-px0),2) + Math.pow((py-py0),2));
	
	points[0] = px - ((px-px0) * Math.cos(0.5) + (py-py0) * Math.sin(0.5))*10/l;
	points[1] = py - ((py-py0) * Math.cos(0.5) - (px-px0) * Math.sin(0.5))*10/l;
	return points;
}

function ev_canvas (ev) {
  if (ev.layerX || ev.layerY) { // Firefox
    ev._x = ev.layerX;
    ev._y = ev.layerY;
  } else if (ev.offsetX || ev.offsetY) { // Opera
    ev._x = ev.offsetX;
    ev._y = ev.offsetY;
  }

  // Call the event handler of the tool.
  var func = tool[ev.type];
  if (func) {
    func(ev);
  }
};

function set_color(color) {
	context.strokeStyle = color;
	context.fillStyle = color;
	contextmp.strokeStyle = color;
	contextmp.fillStyle = color;
	return true;
}