var popup_dragging = false;
var popup_target;
var popup_mouseX;
var popup_mouseY;
var popup_mouseposX;
var popup_mouseposY;
var popup_oldfunction;


// ***** popup_mousedown *******************************************************

function popup_mousedown(e)
{
  var ie = navigator.appName == "Microsoft Internet Explorer";

  popup_mouseposX = ie ? window.event.clientX : e.clientX;
  popup_mouseposY = ie ? window.event.clientY : e.clientY;
}


// ***** popup_mousedown_window ************************************************

function popup_mousedown_window(e)
{
  var ie = navigator.appName == "Microsoft Internet Explorer";

  if ( ie && window.event.button != 1) return;
  if (!ie && e.button            != 0) return;

  popup_dragging = true;
  popup_target   = this['target'];
  popup_mouseX   = ie ? window.event.clientX : e.clientX;
  popup_mouseY   = ie ? window.event.clientY : e.clientY;

  if (ie)
       popup_oldfunction = document.onselectstart;
  else popup_oldfunction = document.onmousedown;

  if (ie)
       document.onselectstart = new Function("return false;");
  else document.onmousedown   = new Function("return false;");
}


// ***** popup_mousemove *******************************************************

function popup_mousemove(e)
{
  var ie      = navigator.appName == "Microsoft Internet Explorer";
  var element = document.getElementById(popup_target);
  var mouseX  = ie ? window.event.clientX : e.clientX;
  var mouseY  = ie ? window.event.clientY : e.clientY;

  if (!popup_dragging) return;

  element.style.left = (element.offsetLeft+mouseX-popup_mouseX)+'px';
  element.style.top  = (element.offsetTop +mouseY-popup_mouseY)+'px';

  popup_mouseX = ie ? window.event.clientX : e.clientX;
  popup_mouseY = ie ? window.event.clientY : e.clientY;
}

// ***** popup_mouseup *********************************************************

function popup_mouseup(e)
{
  var ie      = navigator.appName == "Microsoft Internet Explorer";
  var element = document.getElementById(popup_target);

  if (!popup_dragging) return;

  popup_dragging = false;

  if (ie)
       document.onselectstart = popup_oldfunction;
  else document.onmousedown   = popup_oldfunction;
}

// ***** popup_exit ************************************************************

function popup_exit(e)
{

  var ie      = navigator.appName == "Microsoft Internet Explorer";
  var element = document.getElementById(popup_target);

  popup_mouseup(e);
  element.style.display = 'none';

		document.getElementById("question_hidden").value = 3;

		var jk = jQuery.noConflict();

		jk.ajax({ 
			cache: false,
			type : "POST",
			url: "/expertmanager/cookieadd?cookie=1"
		});


}


// ***** popup_show ************************************************************

function popup_show_post(aId)
{

alert(aId);

	setCookie("_post_Id", aId, 1);
	return true;

}

function popup_show(id, drag_id, exit_id, position, x, y, position_id)
{
  var element      = document.getElementById(id);
  var drag_element = document.getElementById(drag_id);
  var exit_element = document.getElementById(exit_id);

  var width        = window.innerWidth  ? window.innerWidth  : document.documentElement.clientWidth;
  var height       = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight;

  element.style.position = "absolute";
  element.style.display  = "block";

  if (position == "element" || position == "element-right" || position == "element-bottom")
  {
    var position_element = document.getElementById(position_id);

    for (var p = position_element; p; p = p.offsetParent)
      if (p.style.position != 'absolute')
      {
        x += p.offsetLeft;
        y += p.offsetTop;
      }

    if (position == "element-right" ) x += position_element.clientWidth;
    if (position == "element-bottom") y += position_element.clientHeight;

    element.style.left = x+'px';
    element.style.top  = y+'px';
  }

  if (position == "mouse")
  {
    element.style.left = (document.documentElement.scrollLeft+popup_mouseposX+x)+'px';
    element.style.top  = (document.documentElement.scrollTop +popup_mouseposY+y)+'px';
  }

  if (position == "screen-top-left")
  {
    element.style.left = (document.documentElement.scrollLeft+x)+'px';
    element.style.top  = (document.documentElement.scrollTop +y)+'px';
  }

  if (position == "screen-center")
  {


    element.style.left = (document.documentElement.scrollLeft+(width -element.clientWidth )/2+x)+'px';
    element.style.top  = (document.documentElement.scrollTop +(height-element.clientHeight)/2+y)+'px';
  }

  if (position == "screen-bottom-right")
  {
    element.style.left = (document.documentElement.scrollLeft+(width -element.clientWidth )  +x)+'px';
    element.style.top  = (document.documentElement.scrollTop +(height-element.clientHeight)  +y)+'px';
  }

  drag_element['target']   = id;
  drag_element.onmousedown = popup_mousedown_window;

  exit_element.onclick     = popup_exit;
}

function setCookie(c_name,value,exdays)
{
var exdate=new Date();
exdate.setDate(exdate.getDate() + exdays);
var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
document.cookie=c_name + "=" + c_value + ";path=/;domain="+window.globalConfig.cookies_domain;
}


// ***** Attach Events *********************************************************

if (navigator.appName == "Microsoft Internet Explorer")
     document.attachEvent   ('onmousedown', popup_mousedown);
else document.addEventListener('mousedown', popup_mousedown, false);

if (navigator.appName == "Microsoft Internet Explorer")
     document.attachEvent   ('onmousemove', popup_mousemove);
else document.addEventListener('mousemove', popup_mousemove, false);

if (navigator.appName == "Microsoft Internet Explorer")
     document.attachEvent   ('onmouseup', popup_mouseup);
else document.addEventListener('mouseup', popup_mouseup, false);
