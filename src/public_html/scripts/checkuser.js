

var popPopOpen = false;

var popCheck = 1;

function checkedUser()
{

//alert("Veera");
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

						var newResult = result[0].split("-");
          
          if (!popPopOpen)
					  popup(newResult[0],newResult[1],newResult[2],newResult[3],newResult[4],newResult[5],newResult[6],newResult[7],newResult[9]);

				} else if(newChecking[0] == "msg") {

					asker_row_id = newChecking[1];  
					asker_chat_id = newChecking[4]; 

					setTimeout('askerOpen(asker_row_id,asker_chat_id)', 5000);


				}

			}

		} 
    }
  }

xmlhttp.open("POST","/expertmanager/mapuser", true);
xmlhttp.send();




setTimeout("checkedUser()", 25000);

}

function askerOpen(row_id,chat_id) {

	 var details = new Array();

			details[0] = row_id;
  			details[1] = chat_id;
					 
		document.location='/expertmanager/answer?details='+details;

}

function popup(expid, userid, ques, school, sub, year, id,loginname, points){

  popPopOpen = true;
  var details = new Array();

  var newQues = ques.replace(",","");

  details[0] = expid;
  details[1] = userid;
  details[2] = newQues;
  details[3] = school;
  details[4] = sub;
  details[5] = year;
  details[6] = id;
  details[7] = loginname;



	//alert("A student is asking you for help!");

/* Dynamic Title Bar Content - Start */

var message = new Array();
// Set your messages below -- follow the pattern.
// To add more messages, just add more elements to the array.
message[0] = "Someone Needs Help From You...";
message[1] = "Clarify Asker Doubts & Get Rayku Points";
message[2] = "Question Available for you...";
//message[3] = "";
//message[4] = "";


// Set the number of repetitions (how many times the arrow
// cycle repeats with each message).
var reps = 2;
var speed = 200;  // Set the overall speed (larger number = slower action).

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
if (s > 8) { s = 1;}
// you can fiddle with the patterns here...
if (s == 1) { document.title = '||||||====||| '+T+' -----'; }
if (s == 2) { document.title = '|||=|||===||| '+T+' -----'; }
if (s == 3) { document.title = '|||==|||==||| '+T+' -----'; }
if (s == 4) { document.title = '|||===|||=||| '+T+' -----'; }
if (s == 5) { document.title = '|||====|||||| '+T+' -----'; }
if (s == 6) { document.title = '|||===|||=||| '+T+' -----'; }
if (s == 7) { document.title = '|||==|||==||| '+T+' -----'; }
if (s == 8) { document.title = '|||=|||===||| '+T+' -----'; }
if (C < (8 * reps)) {
sT = setTimeout('callTitle()', speed);
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
doTheThing();


/* Dynamic Title Bar Content - End */

	Modalbox.show('<div class="notifbg"> <h1><span>'+ school +'</span> student:</h1> <div class="content"> <div class="question">'+ ques +' <span>(year '+ year +' '+ sub +')</span> </div> <div class="price"> Paying <span>'+ points +'RP</span> ($'+ points +') per minute </div> <div class="connect"> <input type="button" name="continue" value="Continue" onclick="javascript:document.location=\'/expertmanager/answer?details='+ details +'\'" class="myButton"> <div class="expire">this question expires<br> in <span>15 seconds</span> </div> </div> <div class="ignore" align="right"> <a href="#" onClick="ignoreclose(newexpid, newuserid, newques, newschool, newsub, newyear, newid, newloginname)">ignore</a> </div> </div> </div>', {title: this.title,overlayClose: false,  width: 400 });


  newexpid = expid;
  newuserid= userid;
  newques = newQues;
  newschool = school;
  newsub = sub;
  newyear = year;
  newid = id;
  newloginname = loginname;

  setTimeout('ignoreclose(newexpid, newuserid, newques, newschool, newsub, newyear, newid, newloginname)', 16000);

 //return false;
}




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


 document.location="/expertmanager/auto?details="+ details;

  
}


function ignoreclose(newexpid, newuserid, newques, newschool, newsub, newyear, newid, newloginname){


var popCheck = 2;


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
			return false;

		} 
    }
  }

xmlhttp.open("POST","/expertmanager/ignore?details="+ details, true);
xmlhttp.send();


  
}

function newpopup(rowid, chatid){
  
  popPopOpen = true;
  var details = new Array();

  details[0] = rowid;
  details[1] = chatid;

	alert("An expert is available to help!");

  Modalbox.show('<div style="padding:20px 15px"><p style="color:#000;font-size:14px;">An expert has offered to help!<br><br><a href="/expertmanager/answer?details='+ details +'" style="font-size:16px;font-weight:bold">Connect Now!</a></p></div>', {title: this.title,overlayClose: false,  height: 150, width: 350 });

  newrowid = rowid;

  setTimeout('newfinalclose(newrowid)', 16000);

  //return false;
}



function newfinalclose(newrowid){

  popPopOpen = false;
  
  Modalbox.hide('', {title: this.title,overlayClose: false,  height: 300, width: 400 });

  document.location="/expertmanager/ignore?details="+ newrowid;

}


