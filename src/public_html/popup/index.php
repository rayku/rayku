<html>
<head>

<link rel="stylesheet" type="text/css" href="http://www.rayku.com/css/global.css" />
<link rel="stylesheet" type="text/css" href="/css/popup.css" media="screen" />
<!--<script type="text/javascript" src="http://www.rayku.com/js/popup-window.js"></script>-->

<script language="javascript">



function checkedUser()
{


if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {


   	if(xmlhttp.responseText != '')
	{
			
		var result = xmlhttp.responseText.split("<");

			
		if(result[0].length != 1) {

		var newChecking = result[0].split("-");

			if(newChecking[0] != "msg") {	

			document.getElementById('window-a').style.display = "block";
document.getElementById('message').style.display = "none";
document.getElementById('nothing').style.display = "none";

			alert("User Need Help From U");

						var newResult = result[0].split("-");

								var details = new Array();

								details[0] = newResult[0];
								details[1] = newResult[1];
								details[2] = newResult[2];
								details[3] = newResult[3];
								details[4] = newResult[4];
								details[5] = newResult[5];
								details[6] = newResult[6];

					
								document.getElementById('question').innerHTML = "<span>Question :"+ newResult[2] + "</span>";


								document.getElementById('school').innerHTML = "<span>School     : "+ newResult[3] + "</span>";
								document.getElementById('subject').innerHTML = "<span class='a'><span>Subject:</span>"+ newResult[4] + "</span>";
								document.getElementById('year').innerHTML = "<span class='b'><span>Year &nbsp;&nbsp;&nbsp;&nbsp;:</span>"+ newResult[5] + "</span>";
								//document.getElementById('nickInput').value = newResult[7];

								document.getElementById('ignore').value =  details;

								document.getElementById('connectButton').value =  details;
					} else if(newChecking[0] == "msg") {

document.getElementById('message').style.display = "block";
document.getElementById('nothing').style.display = "none";
document.getElementById('window-a').style.display = "none";

alert("Expert Accepts Your Request");

			var newMsgResult = result[0].split("-");

			document.getElementById('ignorenew').value =  newMsgResult[1];

			document.getElementById('connectbu').value =  newMsgResult[1];


			document.getElementById('chatid').innerHTML =  "<span>Chat ID : <font color='#FF000'>"+ newMsgResult[4] + "</font></span>";

					}

			} else {

				
document.getElementById('nothing').style.display = "block";
document.getElementById('message').style.display = "none";
document.getElementById('window-a').style.display = "none";

			}


		} 
    }
  }

xmlhttp.open("POST","http://www.rayku.com/expertmanager/mapuser", true);
xmlhttp.send();


setTimeout("checkedUser()", 10000);


}

function callIgnore(details){

opener.document.location = "http://www.rayku.com/expertmanager/ignore?details="+ details;
self.close();

}


function callAnswer(details){

opener.document.location = "http://www.rayku.com/expertmanager/answer?details="+ details;
self.close();

}

function popupClose() {


	var r = confirm("If close this, You will not get any intimation when user conncts you, Are you sure?");



	if(r == false) {

	newWindow = window.open('http://www.rayku.com/index.php','newWindow','width=350,height=350,resizable=no');

	} else {

		location.href = "http://www.rayku.com/dashboard";

		window.location.reload();

		var close;
		var value = 1;


		document.cookie = "close"+ "=" + value; "path=/"; domain="rayku.com";

		window.location.reload();
	}

}

</script>
<head>

<body onload="checkedUser()" onbeforeUnload="popupClose()" >

<div class="window-a" id="window-a" style="display:none;"><h1 class="heading-b">Student Needs Help</h1><div align="left"><p class="scheme-a" id="question">Question :</p></div><div class="student-a"><div align="left"><p class="a" id="school"></p><p class="a" id="subject"><p class="a" id="year"></p></div></div><p><a href="#" id="ignore" class="link-a" value="" onclick="callIgnore(this.value);">Ignore</a></p><p>Answering this question gives you $5RP</p><br/><p class="respond"><span>5</span> seconds to respond...</p><div id="content"><div id="connect"><form action="#"><fieldset><input id="nickInput" class="text" type="hidden" name="nick" value=""/><input id="sessionID" class="text" type="hidden" name="session" value=""/></fieldset></form><a id="connectButton" value="" onclick="callAnswer(this.value)" class="answer">Answer</a></div>
</div></div>

<div id="nothing" style="display:none;">

<div class="window-a">
<br/><br/><br/><br/><br/><br/><br/><br/>
<p class="scheme-a">You will intimate when users connects you.</p>
<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
</div>
</div>

<div id="message" style="display:none;">

<div class="window-a"><h1 class="heading-b">Expert Accepts Your Request</h1><div align="left"><p class="scheme-a" id="question">Please Make Note of the Following Chat Id, It will use you to Connects With Expert</p></div><div class="student-a"><div align="left"><p class="a" id="chatid"><font color="#FF000"></font></p></div></div><br/><br/><p><a href="#" id="ignorenew" class="newlink-a" value="" onclick="callIgnore(this.value);">Ignore</a></p><div id="content"><a href="#" id="connectbu" value="" onclick="callAnswer(this.value)" class="connect"></a>
</div>
</div>

</div>

</body>
</html>
