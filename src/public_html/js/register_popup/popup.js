//SETTING UP OUR POPUP
//0 means disabled; 1 means enabled;


var popupStatus = 0;

//loading login popup with jQuery magic!
function loadPopuplogin()
{
	
	
	//loads popup only if it is disabled
	if(popupStatus==0){
		document.getElementById('backgroundPopup').style.opacity="0.7";
		document.getElementById('backgroundPopup').style.display='block';
		document.getElementById('popuplogin').style.display='block';
		
		popupStatus = 1;
	}
}

//loading register popup with jQuery magic!
function loadPopupregister()
{
	//loads popup only if it is disabled
	if(popupStatus==0){
		document.getElementById('backgroundPopup').style.opacity="0.7";
		document.getElementById('backgroundPopup').style.display='block';
		
		$("#backgroundPopup").fadeIn("slow");
		$("#popupregister").fadeIn("slow");
		popupStatus = 1;
	}
}


//disabling login popup with jQuery magic!
function disableloginPopup()
{
	//disables popup only if it is enabled
	if(popupStatus==1){
		document.getElementById('referral_code').value='';
		document.getElementById('referral_code_quick').value='';
		document.getElementById('error_referral').innerHTML="";
		document.getElementById('error_referral_quick').innerHTML="";
		document.getElementById('popuplogin').style.display='none';
			document.getElementById('backgroundPopup').style.display='none';
		popupStatus = 0;
	}
}

//disabling login popup with jQuery magic!
function disableregisterPopup()
{
	//disables popup only if it is enabled
	if(popupStatus==1)
	{
		$("#backgroundPopup").fadeOut("slow");
		$("#popupregister").fadeOut("slow");
		popupStatus = 0;
	}
}


//centering login popup
function centerPopuplogin()
{
	
	//request data for centering
	var windowWidth = document.documentElement.clientWidth;
	var windowHeight = document.documentElement.clientHeight;
	var popupHeight =200;
	var popupWidth =408;
	
	//centering
	document.getElementById('popuplogin').style.position='absolute';
	document.getElementById('popuplogin').style.top='300px';
	document.getElementById('popuplogin').style.left='450px';
	//only need force for IE6
	document.getElementById('popuplogin').style.height="170px";

	//alert(popupHeight+""+popupWidth);
}

//centering login popup
function centerPopupregister()
{
	//request data for centering
	var windowWidth = document.documentElement.clientWidth;
	var windowHeight = document.documentElement.clientHeight;
	alert(windowWidth);
	//centering

	//only need force for IE6
	
	$("#backgroundPopup").css({
		"height": windowHeight
	});
	
}
function openRegisterPopup()
{
	
	//	disableregisterPopup();
		//centering with css
		centerPopuplogin();
		//load popup
		loadPopuplogin();
}
function closeRegisterPopup()
{
	disableloginPopup();
}
//CONTROLLING EVENTS IN jQuery


function checkReferralcode()
{


	
	var code=document.getElementById('referral_code').value;
	if(code=='')
	{
		document.getElementById('error_referral').innerHTML="Please enter referral code";	
		return false;
	}
	
	//var from=document.getElementById('youremail').value;
	
	//var suggestform=document.getElementById('popuplogin').innerHTML;
	
	
	var xmlHttp;
				try
				  {
				  // Firefox, Opera 8.0+, Safari
				  xmlHttp=new XMLHttpRequest();
				  
				  }
				catch (e)
				  {
				  // Internet Explorer
				  try
					{
					xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
					
					}
				  catch (e)
					{
					try
					  {
					  xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
					  
					  }
					catch (e)
					  {
					  alert("Your browser does not support AJAX!");
					  return false;
					  }
					}
				  }
				  xmlHttp.onreadystatechange=function()
					{
						if(xmlHttp.readyState==3)
						{
							document.getElementById('error_referral').innerHTML="Processing the Code............";
						}
					if(xmlHttp.readyState==4)
					  {
						
						var response=xmlHttp.responseText;
						
							if(response==1)
							{
								document.location.href="http://www.rayku.com/register";
							}
							else
							{
									document.getElementById('error_referral').innerHTML="Incorrect Referral Code";
							}
							
						//document.getElementById('popuplogin').innerHTML=suggestform;
							//document.getElementById('popuplogin').style.display= 'none';
							
                       }
					}
					//document.getElementById('popuplogin').innerHTML="<p align='center'><img src='images/Send-Mail.gif' /></p>";
					var url = "js/register_popup/check_refcode.php?code="+code;
					
					//document.getElementById('popuplogin').innerHTML="<b>Sending Mail.........</b>";
					xmlHttp.open("GET",url,true);
					xmlHttp.send(null);
		
}

function checkReferralcode_quick()
{

	var code=document.getElementById('referral_code_quick').value;
	if(code=='')
	{
		document.getElementById('error_referral_quick').innerHTML="Please enter referral code";	
		return false;
	}
	//var from=document.getElementById('youremail').value;
	
	//var suggestform=document.getElementById('popuplogin').innerHTML;
	
	
	var xmlHttp;
				try
				  {
				  // Firefox, Opera 8.0+, Safari
				  xmlHttp=new XMLHttpRequest();
				  
				  }
				catch (e)
				  {
				  // Internet Explorer
				  try
					{
					xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
					
					}
				  catch (e)
					{
					try
					  {
					  xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
					  
					  }
					catch (e)
					  {
					  alert("Your browser does not support AJAX!");
					  return false;
					  }
					}
				  }
				  xmlHttp.onreadystatechange=function()
					{
						if(xmlHttp.readyState==3)
						{
							document.getElementById('error_referral_quick').innerHTML="Processing the Code............";
						}
					if(xmlHttp.readyState==4)
					  {
						
						var response=xmlHttp.responseText;
						
							if(response==1)
							{
								document.location.href="http://www.rayku.com/register";
							}
							else
							{
									document.getElementById('error_referral_quick').innerHTML="Incorrect Referral Code";
							}
							
						//document.getElementById('popuplogin').innerHTML=suggestform;
							//document.getElementById('popuplogin').style.display= 'none';
							
                       }
					}
					//document.getElementById('popuplogin').innerHTML="<p align='center'><img src='images/Send-Mail.gif' /></p>";
					var url = "http://www.rayku.com/js/register_popup/check_refcode.php?code="+code;
					
					//document.getElementById('popuplogin').innerHTML="<b>Sending Mail.........</b>";
					xmlHttp.open("GET",url,true);
					xmlHttp.send(null);
		
}
function emailvalidation(email)
{
	var str=email;
		var at="@"
		var dot="."
		var lat=str.indexOf(at)
		var lstr=str.length
		var ldot=str.indexOf(dot)
		
		
	
	if (str.indexOf(at)==-1){
		  
		   i=1;
		
		return false;
		}

		if (str.indexOf(at)==-1 || str.indexOf(at)==0 || str.indexOf(at)==lstr){
		  ;
		  i=1;
		 
		return 0;
		}

		if (str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)==lstr){
		 
		  i=1;
		  
		return 0;
		}

		 if (str.indexOf(at,(lat+1))!=-1){
		  
		   i=1;
		  
		return 0;
		 }

		 if (str.substring(lat-1,lat)==dot || str.substring(lat+1,lat+2)==dot){
		  
		   i=1;
		  
		return 0;
		 }

		 if (str.indexOf(dot,(lat+2))==-1){
		 
		 i=1;
		
		return 0;
		 }
		
		 if (str.indexOf(" ")!=-1){
		  
		  i=1;
		  
		return 0;
		 }
		 return 1;
}
