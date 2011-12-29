

var popPopOpen = false;

var popCheck = 1;

var stopTitle = 1;

var closeCount = 0;


var countGlobal = 20;


/* Dynamic Title Bar Content - Start */

var message = new Array();
// Set your messages below -- follow the pattern.
// To add more messages, just add more elements to the array.
message[0] = "New Question";
//message[1] = "";
//message[2] = "";
//message[3] = "";
//message[4] = "";


// Set the number of repetitions (how many times the arrow
// cycle repeats with each message).
var reps = 2;
var speed = 600;  // Set the overall speed (larger number = slower action).

// DO NOT EDIT BELOW THIS LINE.
var p = message.length;
var T = "";
var C = 0;
var mC = 0;
var s = 0;
var sT = null;
if (reps < 1) reps = 1;


function doTheThing() {
T = message[mC];
callTitle();
}


function callTitle() {


s++;
if (s > 2) { s = 1;}
// you can fiddle with the patterns here...
if (s == 1) { document.title = T+' (1)'; }
if (s == 2) { document.title = T; }
if (C < (2 * reps)) {



if(stopTitle == 1) {



sT = setTimeout('callTitle()', speed);

} else {

defaultTitle();

}


C++;
}
else {
C = 0;
s = 0;
mC++;
if(mC > p - 1) mC = 0;
sT = null;
doTheThing();
   }
}

function defaultTitle() {

document.title = "Rayku.com Peer Online Tutoring";

stopTitle = 1;

}

/* Dynamic Title Bar Content - End */

function music() {


document.getElementById('music').innerHTML = '<embed src="http://'+getHostname()+'/alert.mp3" autostart="true" loop="false" width="2" height="0"></embed><noembed><bgsound src="http://'+getHostname()+'/alert.mp3"></noembed>';

setTimeout('music()', 9000);


}


function checkedUser()
{



	if(popCheck == 1) {

		var dv = jQuery.noConflict();

		dv.ajax({ cache: false,
			type : "POST",
			url: "http://"+getHostname()+"/expertmanager/mapuser",
			success : function (data)  {

				var result = data.split("<");

				if(result[0].length != 1) {

					var newChecking = result[0].split("-");



					if(newChecking[8] == "expert") {	

						  var newResult = result[0].split("-");

						  popup(newResult[0],newResult[1],newResult[2],newResult[3],newResult[4],newResult[5],newResult[6],newResult[7],newResult[9],newResult[10], newResult[11], newResult[12]);

					} /*else if(newChecking[0] == "msg") {


					     if(Page == "/expertmanager/connect") {

						asker_row_id = newChecking[1];  
						asker_chat_id = newChecking[4]; 

						setTimeout('askerOpen(asker_row_id,asker_chat_id)', 5000);

					    }


					}*/

				}


			}

		});

	}


setTimeout("checkedUser()", 5000);

}

/*

function askerOpen(row_id,chat_id) {

	 var details = new Array();

			details[0] = row_id;
  			details[1] = chat_id;
					 
		document.location='http://'+getHostname()+'/expertmanager/answer?details='+details;

}*/

function popup(expid, userid, ques, school, sub, year, id,loginname, points, close, browser, modelbox){

  popPopOpen = true;
  var details = new Array();

var musicCheck = '';

popCheck = 2;

closeCount =  close - 1000;

countGlobal = (closeCount /1000);

stopTitle = 1;


  var newQues = ques.replace(",","");

  details[0] = expid;
  details[1] = userid;
  details[2] = 'question';
  details[3] = school;
  details[4] = sub;
  details[5] = year;
  details[6] = id;
  details[7] = loginname;



doTheThing();

  newexpid = expid;
  newuserid= userid;
  newques = 'question';
  newschool = school;
  newsub = sub;
  newyear = year;
  newid = id;
  newloginname = loginname;

/* Dynamic Title Bar Content - End */

if(modelbox == 1) {


	if(browser == 'others') {


	musicCheck = '<embed src="http://'+getHostname()+'/alert.mp3" autostart="true" loop="false" width="2" height="0"></embed><noembed><bgsound src="http://'+getHostname()+'/alert.mp3"></noembed>';

	setTimeout('music()', 9000);

	} else {

	musicCheck = '<iframe src="http://'+getHostname()+'/musical.php" width="1" height="1"></iframe>';

	}

}


	Modalbox.show('<div id="music" style="display:none;"> </div><div class="notifbg"><h1><span>'+ school +'</span> student:</h1> <div class="content"> <div class="question">'+ ques +' <span>(year '+ year +' '+ sub +')</span> </div> <div class="price"> Paying <span>'+ points +'RP</span> ($'+ points +') per minute </div> <div class="connect"> <div style="float:left;width:120px;height:40px;font-size:20px;line-height:30px;font-weight:bold;" align="center"><a href="http://'+getHostname()+'/expertmanager/answer?details='+ details +'">Connect!</a></div> '+ musicCheck +'  <div class="expire">this question expires<br> in <span id="countDown"> '+countGlobal+' Seconds </span> </div> </div> <div class="ignore" align="right"> <a href="#" onClick="ignoreclose(newexpid, newuserid, newques, newschool, newsub, newyear, newid, newloginname)">ignore</a> </div> </div> </div><script type="text/javacript"> setTimeout("countCheck()", 1000);</script>', {title: this.title,overlayClose: false,  width: 400 });

//countCheck();




  setTimeout('autoclose(newexpid, newuserid, newques, newschool, newsub, newyear, newid, newloginname)', close);

 //return false;
}


function countCheck() { countGlobal = countGlobal - 1; document.getElementById("countDown").innerHTML = countGlobal + " Seconds";


	popupclose = getCookie("_popupclose");

	if(popupclose == '' || popupclose == null ) {

		  stopTitle = 2;

		  Modalbox.hide('', {title: this.title,overlayClose: false,  height: 350, width: 400 });

	}

setTimeout("countCheck()", 1000); }

function finalclose(newexpid, newuserid, newques, newschool, newsub, newyear, newid, newloginname){


  Modalbox.hide('', {title: this.title,overlayClose: false,  height: 350, width: 400 });

 popPopOpen = false;
  var details = new Array();

  details[0] = newexpid;
  details[1] = newuserid;
  details[2] = newques;
  details[3] = newschool;
  details[4] = newsub;
  details[5] = newyear;
  details[6] = newid;
  details[7] = newloginname;


 document.location="http://"+getHostname()+"/expertmanager/auto?details="+ details;

  
}


function ignoreclose(newexpid, newuserid, newques, newschool, newsub, newyear, newid, newloginname){


popCheck = 1;

stopTitle = 2;


  popPopOpen = false;
  Modalbox.hide('', {title: this.title,overlayClose: false,  height: 350, width: 400 });

  var details = new Array();

  details[0] = newexpid;
  details[1] = newuserid;
  details[2] = newques;
  details[3] = newschool;
  details[4] = newsub;
  details[5] = newyear;
  details[6] = newid;
  details[7] = newloginname;


		var dxv = jQuery.noConflict();

		dxv.ajax({ cache: false,
			type : "POST",
			url: "http://"+getHostname()+"/expertmanager/ignore?details="+ details,
			success : function (data)  {

				stopTitle = 2;

				return false;

			}

		});
  
}


function autoclose(newexpid, newuserid, newques, newschool, newsub, newyear, newid, newloginname){


popCheck = 1;

stopTitle = 2;


  popPopOpen = false;
  Modalbox.hide('', {title: this.title,overlayClose: false,  height: 350, width: 400 });

  var details = new Array();

  details[0] = newexpid;
  details[1] = newuserid;
  details[2] = newques;
  details[3] = newschool;
  details[4] = newsub;
  details[5] = newyear;
  details[6] = newid;
  details[7] = newloginname;


		var dxv = jQuery.noConflict();

		dxv.ajax({ cache: false,
			type : "POST",
			url: "http://"+getHostname()+"/expertmanager/auto?details="+ details,
			success : function (data)  {

				stopTitle = 2;

				return false;

			}

		});
  
}



function newpopup(rowid, chatid){
  
  popPopOpen = true;
  var details = new Array();

  details[0] = rowid;
  details[1] = chatid;

	alert("An expert is available to help!");

  Modalbox.show('<div style="padding:20px 15px"><p style="color:#000;font-size:14px;">An expert has offered to help!<br><br><a href="http://'+getHostname()+'/expertmanager/answer?details='+ details +'" style="font-size:16px;font-weight:bold">Connect Now!</a></p></div>', {title: this.title,overlayClose: false,  height: 150, width: 350 });

  newrowid = rowid;

  setTimeout('newfinalclose(newrowid)', 16000);

  //return false;
}



function newfinalclose(newrowid){

  popPopOpen = false;
  
  Modalbox.hide('', {title: this.title,overlayClose: false,  height: 300, width: 400 });

  document.location="http://"+getHostname()+"/expertmanager/ignore?details="+ newrowid;

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


function getHostname() {
    return document.URL.match(/http:\/\/([^\/]*).*/)[1];
}
