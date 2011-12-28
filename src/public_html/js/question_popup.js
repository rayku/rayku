

			var jk = jQuery.noConflict();

	function checkMissedQuestion() {


			jk.ajax({ cache: false,
			type : "POST",
			url: "http://www.rayku.com/expertmanager/topic",
			success : function (data)  {

				    if(data == "yes") {
							if(document.getElementById("question_hidden").value == 1)  {

						       	    popup_show('question_popup', 'popup_drag', 'popup_exit', 'screen-center', 0, 0);

					   		    document.getElementById("question_hidden").value = 2;

							    setTimeout('popupClose()', 1000);

							}
				   }
			}


		});

	setTimeout('checkMissedQuestion()', 10000);

	}




function popupClose() {



         var popup_close = getCookie("popup_close");


	if(document.getElementById("question_hidden").value == 2)  {

		if(popup_close == 1) {

		 	document.getElementById("question_popup").style.display = 'none';

			document.getElementById("question_hidden").value = 1;

			setTimeout('popupCookieClear()', 2000);


		} else {
	
			setTimeout('popupClose()', 1000);

		}
	}		




}



function popupCookieClear()
{


		jk.ajax({ cache: false,
			type : "POST",
			url: "http://www.rayku.com/expertmanager/cookieadd?cookie=0"
		});


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
