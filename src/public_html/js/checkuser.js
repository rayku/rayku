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

function doTheThing()
{
    T = message[mC];
    callTitle();
}

function callTitle()
{
    s++;
    if (s > 2) { s = 1;}
    // you can fiddle with the patterns here...
    if (s == 1) { document.title = '(1) '+T; }
    if (s == 2) { document.title = T; }
    if (C < (2 * reps)) {

        if (stopTitle == 1) {
            sT = setTimeout('callTitle()', speed);
        } else {
            defaultTitle();
        }

        C++;
    } else {
        C = 0;
        s = 0;
        mC++;
        if (mC > p - 1) mC = 0;
        sT = null;
        doTheThing();
    }
}

function defaultTitle() {
    document.title = "Rayku.com Peer Online Tutoring";
    stopTitle = 1;
}

/* Dynamic Title Bar Content - End */

function music()
{
    if (stopTitle == 1) {
        document.getElementById('music').innerHTML = '<embed src="http://' + getHostname() + '/alert.mp3" autostart="true" loop="loop" width="2" height="0"></embed><noembed><bgsound src="http://'+getHostname()+'/alert.mp3"></noembed>';
        setTimeout('music()', 9000);
    }
}


function checkedUser()
{
    if (popCheck != 1) {
        setTimeout("checkedUser()", 5000);
        return;
    }
    var dv = jQuery.noConflict();

    dv.ajax({ cache: false,
        type : "POST",
        url: 'http://' + getHostname() + '/expertmanager/mapuser',
        success : function (data)  {
            var result = data.split("<");
            if (result[0].length != 1) {
                var newChecking = result[0].split("-");
                if (newChecking[8] == "expert") {
                    var newResult = result[0].split("-");
                    popup(newResult[0], newResult[1], newResult[2], newResult[3], newResult[4], newResult[5], newResult[6], newResult[7], newResult[9], newResult[10], newResult[11], newResult[12], newResult[13]);
                }
            }
        }
    });
    setTimeout("checkedUser()", 5000);
}

function popup(expid, userid, questionEncoded, school, sub, year, id,loginname, points, close, browser, modelbox, questionId)
{
    popPopOpen = true;
    var details = new Array();
    var musicCheck = '';
    popCheck = 2;
    closeCount =  close - 1000;
    countGlobal = (closeCount /1000);
    stopTitle = 1;
    questionDecoded = decodeBase64(questionEncoded);

    details[0] = expid;
    details[1] = userid;
    details[2] = questionEncoded;
    details[3] = school;
    details[4] = sub;
    details[5] = year;
    details[6] = id;
    details[7] = loginname;

    doTheThing();

    newexpid = expid;
    newuserid= userid;
    newques = questionEncoded;
    newschool = school;
    newsub = sub;
    newyear = year;
    newid = id;
    newloginname = loginname;

    /* Dynamic Title Bar Content - End */
    if (modelbox == 1) {
        if (browser == 'others') {
            musicCheck = '<embed src="http://' + getHostname() + '/alert.mp3" autostart="true" loop="loop" width="2" height="0"></embed><noembed><bgsound src="http://'+getHostname()+'/alert.mp3"></noembed>';
            setTimeout('music()', 9000);
        } else {
            musicCheck = '<iframe src="http://' + getHostname() + '/musical.php" width="1" height="1"></iframe>';
        }
    }

    Modalbox.show(
            '<div id="music" style="display:none;"></div>' +
            '<div class="notifbg">' +
            '    <h1>A student is asking you this question:</h1>' +
            '    <div class="content">' +
            '        <div class="question">' + questionDecoded + ' <span>(' + year + ' ' + sub + ')</span></div>' +
            '        <div class="price"> Paying <span>' + points + 'RP</span> ($' + points +') per minute </div>' +
            '        <div class="connect">' +
            '            <div style="float:left;width:120px;height:40px;font-size:20px;line-height:30px;font-weight:bold;" align="center">' +
            '                <a href="http://' + getHostname() + '/expertmanager/answer?details=' + details + '&questionId=' + questionId + '">Connect!</a>' +
            '            </div>' + musicCheck +
            '            <div class="expire">this question expires<br> in <span id="countDown"> '+countGlobal+' Seconds </span> </div>' +
            '        </div>' +
            '        <div class="ignore" align="right">' +
            '            <a href="#" onClick="ignoreclose(newexpid, newuserid, newques, newschool, newsub, newyear, newid, newloginname)">ignore</a>' +
            '        </div>' +
            '    </div>' +
            '</div>' +
            '<script type="text/javacript"> setTimeout("countCheck()", 1000);</script>',
            { title: this.title,overlayClose: false,  width: 400 });
    setTimeout('autoclose(newexpid, newuserid, newques, newschool, newsub, newyear, newid, newloginname)', close);
}

function countCheck()
{
    popupclose = getCookie("_popupclose");
    if (popupclose == '' || popupclose == null ) {
        stopTitle = 2;
        Modalbox.hide('', {title: this.title,overlayClose: false,  height: 350, width: 400 });
    }

    if (stopTitle == 1) {
        countGlobal = countGlobal - 1; document.getElementById("countDown").innerHTML = countGlobal + " Seconds";
        setTimeout("countCheck()", 1000);
    }
}

function ignoreclose(newexpid, newuserid, newques, newschool, newsub, newyear, newid, newloginname)
{
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
        url: 'http://' + getHostname() + '/expertmanager/ignore?details=' + details,
        success : function (data)  {
            stopTitle = 2;
            return false;
        }
    });
}

function autoclose(newexpid, newuserid, newques, newschool, newsub, newyear, newid, newloginname)
{
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
        url: 'http://' + getHostname() + '/expertmanager/auto?details=' + details,
        success : function (data)  {
            stopTitle = 2;
            return false;
        }
    });
}

function getCookie(c_name)
{
    if (document.cookie.length>0) {
        c_start=document.cookie.indexOf(c_name + "=");
        if (c_start!=-1) {
            c_start=c_start + c_name.length+1;
            c_end=document.cookie.indexOf(";",c_start);
            if (c_end==-1) c_end=document.cookie.length;
            return unescape(document.cookie.substring(c_start,c_end));
        }
    }
    return "";
}

function getHostname()
{
    return window.location.host;
}

