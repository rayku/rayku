<html>
<head>
<title>Rayku Expert-Connect Window</title>
<link rel="stylesheet" type="text/css" href="http://www.rayku.com/css/global.css" />
<link rel="stylesheet" type="text/css" href="/css/popup.css" media="screen" />
<script type="text/javascript" src="http://www.rayku.com/js/jquery-1.4.2.min.js"></script>


<script language="javascript">

    $(document).ready(function() {


	$(window).bind("beforeunload", function(){

				var popupopen;
				var value = '';
				document.cookie = "popupopen" + "=" + value; path="/"; domain="rayku.com";



						var confirmLeave = confirm('If you close this, you will lost the alert messages from Rayku, Are you Sure?');


						if (confirmLeave==false) {

							//$(window).unbind("unload");	

							

							$(window).unbind("beforeunload");

							window.location.reload();

							return false;


							

						} else {

								
								$.ajax({ cache: false,
									type: "POST", // XXX should be POST
									url: "http://www.rayku.com/dashboard/checkdata"

								});

								$(window).unbind("beforeunload");

								self.close();
						}



		 })


		$('#connectButton').click(function() {
		    $(window).unbind("beforeunload");

		});

		$('#ignore').click(function() {
		    $(window).unbind("beforeunload");

		});



     });


function toopenpopup() {


				var popupopen;
				var value = 1;
				document.cookie = "popupopen" + "=" + value; path="/"; domain="rayku.com";

}
	 

	 
function checkedUser()
{
	




popupclose = getCookie("popupneedclose");


if(popupclose != '' && popupclose != null ) {

var popupneedclose;
var value = '';
document.cookie = "popupneedclose" + "=" + value; path="/"; domain="rayku.com";

		$.ajax({ cache: false,
			 type: "POST", // XXX should be POST
			 url: "http://www.rayku.com/dashboard/checkdata"

			});


$(window).unbind("beforeunload");

self.close();

}






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


			if(newChecking[8] == "expert") {	

			document.getElementById('window-a').style.display = "block";
			document.getElementById('message').style.display = "none";
			document.getElementById('nothing').style.display = "none";

//To Give alert for Expert: Start//

				
				/*if(navigator.userAgent.indexOf("Firefox")!=-1) {

						    var winX = (screen.availWidth - window.outerWidth) / 2
						    var winY = 50
						    window.resizeTo(360,415)
						    window.moveTo(winX, winY)

				//} else {*/

					alert("Someone needs your help!");

				//}



//To Give alert for Expert: End//

								var newResult = result[0].split("-");

								var details = new Array();

								details[0] = newResult[0];
								details[1] = newResult[1];
								details[2] = newResult[2];
								details[3] = newResult[3];
								details[4] = newResult[4];
								details[5] = newResult[5];
								details[6] = newResult[6];
								details[7] = newResult[7];

								document.getElementById('question').innerHTML = "<span>Question: "+ newResult[2] + "</span>";


								document.getElementById('school').innerHTML = "<span>School: "+ newResult[3] + "</span>";
								document.getElementById('subject').innerHTML = "<span class='a'><span>Subject: </span>"+ newResult[4] + "</span>";
								document.getElementById('year').innerHTML = "<span class='b'><span>Year: </span>"+ newResult[5] + "</span>";
								//document.getElementById('nickInput').value = newResult[7];

								document.getElementById('ignore').value =  details;

								document.getElementById('connectButton').value =  details;


newexpid = newResult[0];
newuserid= newResult[1];
newques = newResult[2];
newschool = newResult[3];
newsub = newResult[4];
newyear = newResult[5];
newrowid = newResult[6];


setTimeout('callExpertClose(newexpid, newuserid, newques, newschool, newsub, newyear, newrowid)', 9000);



					} else if(newChecking[0] == "msg") {

document.getElementById('message').style.display = "block";
document.getElementById('nothing').style.display = "none";
document.getElementById('window-a').style.display = "none";


				if(navigator.userAgent.indexOf("Firefox")!=-1) {

						//
				} else {

					alert("An expert has accepted your request for help!");

				}



								var newMsgResult = result[0].split("-");

								var details = new Array();

								details[0] = newMsgResult[1];
								details[1] = newMsgResult[4];

	

callAnswer(details);


					}

			} else {

				
document.getElementById('nothing').style.display = "block";
document.getElementById('message').style.display = "none";
document.getElementById('window-a').style.display = "none";

setTimeout("toopenpopup()", 2000);




			}


		} 
    }
  }

xmlhttp.open("POST","http://www.rayku.com/expertmanager/mapuser", true);
xmlhttp.send();


setTimeout("checkedUser()", 10000);


}


function callExpertClose(newexpid, newuserid, newques, newschool, newsub, newyear, newrowid){


				//if(navigator.userAgent.indexOf("Firefox")!=-1) {

						$(window).unbind("beforeunload");
				//} else {

					//$(window).unbind("unload");

				//}



var details = new Array();

details[0] = newexpid;
details[1] = newuserid;
details[2] = newques;
details[3] = newschool;
details[4] = newsub;
details[5] = newyear;
details[6] = newrowid;

document.location="http://www.rayku.com/expertmanager/auto?details="+ details;
//self.close();

}

function callIgnore(details){

				//if(navigator.userAgent.indexOf("Firefox")!=-1) {

						$(window).unbind("beforeunload");
				//} else {

					//$(window).unbind("unload");

				//}


document.location = "http://www.rayku.com/expertmanager/ignore?details="+ details;
//self.close();

}


function callAnswer(details){

				//if(navigator.userAgent.indexOf("Firefox")!=-1) {

						$(window).unbind("beforeunload");
				//} else {

					//$(window).unbind("unload");

				//}


document.location = "http://www.rayku.com/expertmanager/answer?details="+ details;

    window.moveTo(0,0)
    window.resizeTo(screen.availWidth, screen.availHeight)


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


</script>
<head>
<body onLoad="checkedUser()">

  
<div class="window-a" id="window-a" style="display:none;">
  <embed src="http://www.rayku.com/back.wav" autostart="true" loop="true" width="2" height="0"></embed>
  <noembed>
  <bgsound src="http://www.rayku.com/back.wav" loop="infinite">
  </noembed>
  <h1 class="heading-b">Student Needs Help</h1>
  <div align="left">
    <p class="scheme-a" id="question">Question: </p>
  </div>
  <div class="student-a">
    <div align="left">
      <p class="a" id="school"></p>
      <p class="a" id="subject">
      <p class="a" id="year"></p>
    </div>
  </div>
  <p><a href="#" id="ignore" class="link-a" value="" onClick="callIgnore(this.value);">Ignore</a></p>
  <p>Answer and get 5$RP PLUS Bonus Expert Score</p>
  <br/>
  <p class="respond"><span>15</span> seconds to respond...</p>
  <a id="connectButton" value="" onClick="callAnswer(this.value)" class="answer" style="cursor:pointer;cursor:hand;">Answer</a></div>
<div id="nothing" style="display:none;">
  <div class="window-a" style="height:375px;padding:13px 0;">
    <p class="scheme-a" style="margin-bottom:50px;font-size:14px;font-weight:bold" align="left"><img src="http://www.rayku.com/images/logowindow.png"></p>
<p style="font-size:22px;line-height:26px;color:#666" align="center"><strong><span style="color:#000">IMPORTANT:</span> Keep this window open</strong> at all times!</p>
        <p style="font-size:11px;line-height:13px;color:#666;margin-top:150px" align="left">Your expert score will <strong>increase for every <em>15 minutes</em></strong> this window stays active. The purpose of this window is to connect you to experts through our Rayku Whiteboard App when you have a question, and also to allow other users to ask you questions. <strong>So, keep it open for as long as possible!</strong></p>
  </div>
</div>
<div id="message" style="display:none;">
  <embed src="http://www.rayku.com/back.wav" autostart="true" loop="true" width="2" height="0"></embed>
  <noembed>
  <bgsound src="http://www.rayku.com/back.wav" loop="infinite">
  </noembed> </div>
  
</body>
</html>


<?php

if(!empty($_POST)) {

					$con = mysql_connect("localhost", "rayku_db", "db_*$%$%");
		                        $db = mysql_select_db("rayku_db", $con);

	//$logedUserId = $_SESSION['symfony/user/sfUser/attributes']['symfony/user/sfUser/attributes']['user_id'];

	$queryScore = mysql_query("select * from user_score where user_id=".$_COOKIE["ratingExpertId"]) or die(mysql_error());
	$rowScore = mysql_fetch_assoc($queryScore);

	if($_POST["rating"] == 1) {

		$newRatingScore = $rowScore['score'] - 6;

		mysql_query("update user_score  set score = ".$newRatingScore." where user_id=".$_COOKIE["ratingExpertId"]) or die(mysql_error());

	

	}  elseif($_POST["rating"] == 3) {

		$newRatingScore = $rowScore['score'] + 6;

		mysql_query("update user_score  set score = ".$newRatingScore." where user_id=".$_COOKIE["ratingExpertId"]) or die(mysql_error());

	

	} elseif($_POST["rating"] == 4) {

		$newRatingScore = $rowScore['score'] + 12;

		mysql_query("update user_score  set score = ".$newRatingScore." where user_id=".$_COOKIE["ratingExpertId"]) or die(mysql_error());

	

	} elseif($_POST["rating"] == 5) {

		$newRatingScore = $rowScore['score'] + 18;

		mysql_query("update user_score  set score = ".$newRatingScore." where user_id=".$_COOKIE["ratingExpertId"]) or die(mysql_error());

	

	} 



if(isset($_POST["checkbox"]) && !empty($_POST["checkbox"])) {

		$query = mysql_query("select * from expert_subscribers where expert_id = ".$_COOKIE["ratingExpertId"]." and user_id =".$_COOKIE["ratingUserId"]) or die(mysql_error());

		if(mysql_num_rows == 0) {

		mysql_query("insert into expert_subscribers(expert_id, user_id) values('".$_COOKIE["ratingExpertId"]."', '".$_COOKIE["ratingUserId"]."')") or die(mysql_error());

		}

}

}


?>

