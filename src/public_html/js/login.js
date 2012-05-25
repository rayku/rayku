
$(document).ready(function() {
	
  var nick = getCookie("loginname");

  if(nick == '' || nick == null || nick.length == 0) {
    nick = getCookie("practice_name");
  }
  
  var ss_id  = getCookie("chatid");
  var question = getCookie("question");
  var askerid = null;
  var expertid = null;
  var askerName = null;
  
  if (ss_id){
    
    // asker session
    askerid = getCookie("ratingUserId");
    expertid = getCookie("ratingExpertId");
  
  }
  else {
  
    // expert session
    askerName = getCookie("askerUsername");
    askerid = getCookie("askerid");
    expertid = getCookie("expertid");
  }
	
	//alert(document.cookie.split(';').join('\n'));

		//dont bother the backend if we fail easy validations
		if (nick.length > 50) {
			alert("Nick too long. 50 character max.");
			return false;
		}
		
		//more validations
		if (/[^\w_\-^!]/.exec(nick)) {
			alert("Bad character in nick. Can only have letters, numbers, and '_', '-', '^', '!'");
			return false;
		}
		
		//make the actual join request to the server
		$.ajax({ cache: false,
			type: "POST", // XXX should be POST
			dataType: "json",
			url: "/join",
			data: { 
			  nick: nick, 
			  session: ss_id,
			  askerid: askerid,
			  expertid: expertid, 
			  question: question,
			  askerNick: askerName
			},
			error: function (msg) {
				alert("error connecting to server: " + msg.responseText);
			},
			success: onConnect
		});
		return false;

});

function onConnect (session) {
  // error handler
	if (session.error) {
		alert("error connecting: " + session.error);
		return true;
	}
	
	askerid = getCookie("askerid");
  loginId = getCookie("expertid");
	setCookie('whiteboardChatId', session.whiteboardChatId, 60);
	
  if(session.experts == 1) {
    var flag = sendID(session.s_id, loginId, askerid);
  }

  newid = session.id;
  newsessionid = session.s_id;
  setTimeout('openWhiteboard(newid, newsessionid)', 3000);
}

function openWhiteboard(newid, newsessionid) {
  window.location = window.globalConfig.whiteboard_url+'/session?id='+newid+'&sid='+newsessionid;
}

function sendID(newchatid, loginId, askerid) {


		$.ajax({ cache: false,
			type : "POST",
			url: "http://www.rayku.com/whiteboard/sendid.php?newchatid="+newchatid+"&loginId="+loginId+"&askerid="+askerid

		});

return true;


}

function setCookie( name, value, expires)
{
  _setCookie( name, value, expires, '/', window.globalConfig.cookies_domain);
}

function _setCookie( name, value, expires, path, domain, secure )
{
  // set time, it's in milliseconds
  var today = new Date();
  today.setTime(today.getTime());

  /*
  if the expires variable is set, make the correct
  expires time, the current script below will set
  it for x number of days, to make it for hours,
  delete * 24, for minutes, delete * 60 * 24
  */
  if (expires)
  {
    expires = expires * 1000 * 60; // * 60 * 24;
  }
  var expires_date = new Date(today.getTime() + (expires));

  document.cookie = name + "=" +escape(value) +
  ((expires) ? ";expires=" + expires_date.toGMTString() : "") +
  ((path) ? ";path=" + path : "" ) +
  ((domain) ? ";domain=" + domain : "" ) +
  ((secure) ? ";secure" : "" );
}

function getCookie(c_name)
{
  if (document.cookie.length>0)
  {
    c_start=document.cookie.indexOf(c_name + "=");
    if (c_start!=-1)
    {
      c_start=c_start + c_name.length+1;
      c_end=document.cookie.indexOf(";",c_start);
    
      if (c_end==-1) c_end=document.cookie.length;
        return unescape(document.cookie.substring(c_start,c_end));
    }
  }

  return "";
}

function getParameterByName( name )
{
  name = name.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
  var regexS = "[\\?&]"+name+"=([^&#]*)";
  var regex = new RegExp( regexS );
  var results = regex.exec( window.location.href );
  if( results == null )
    return "";
  else
  {
    var value = decodeURIComponent(results[1].replace(/\+/g, " "));
    //alert(name + ' : "' + value + '"');
    return value;
  }
}

/**
 * Function : dump()
 * Arguments: The data - array,hash(associative array),object
 *    The level - OPTIONAL
 * Returns  : The textual representation of the array.
 * This function was inspired by the print_r function of PHP.
 * This will accept some data as the argument and return a
 * text that will be a more readable version of the
 * array/hash/object that is given.
 * Docs: http://www.openjs.com/scripts/others/dump_function_php_print_r.php
 */
function dump(arr,level) {
	var dumped_text = "";
	if(!level) level = 0;
	
	//The padding given at the beginning of the line.
	var level_padding = "";
	for(var j=0;j<level+1;j++) level_padding += "    ";
	
	if(typeof(arr) == 'object') { //Array/Hashes/Objects 
		for(var item in arr) {
			var value = arr[item];
			
			if(typeof(value) == 'object') { //If it is an array,
				dumped_text += level_padding + "'" + item + "' ...\n";
				dumped_text += dump(value,level+1);
			} else {
				dumped_text += level_padding + "'" + item + "' => \"" + value + "\"\n";
			}
		}
	} else { //Stings/Chars/Numbers etc.
		dumped_text = "===>"+arr+"<===("+typeof(arr)+")";
	}
	return dumped_text;
}
