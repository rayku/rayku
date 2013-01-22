<script type="text/javascript">

function hideDiv() {

document.getElementById("question_popup").style.display = 'none';
return true;

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


function checkForRedirect() {

redirect = getCookie("redirection");
//alert(redirect);
forumsub = getCookie("forumsub");
//alert(forumsub);

redirect = getCookie("redirection");
forumsub = getCookie("forumsub");

	if(redirect != '' && redirect != null ) {
		var d = jQuery.noConflict();
		d.ajax({ cache: false,
			type : "POST",
			url: "http://"+getHostname()+"/register/redirect",
			success : function (data)  {
				var check = data.split("<");
				if(check[0] == "redirect") {
					document.location = "http://"+getHostname()+"/expertmanager/studentconfirmation";
				}
			}
		});
	}
setTimeout('checkForRedirect()', 20000);
}
</script>
