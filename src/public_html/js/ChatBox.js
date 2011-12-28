function PingServer() {
    PingServerForMsg()
    setTimeout(PingServer, 1000);
}

var xmlHttp;
var requestURL = 'http://www.rayku.com/expertmanager/mapuser?cid=';
var is_ie = (navigator.userAgent.indexOf('MSIE') >= 0) ? 1 : 0;
var is_ie5 = (navigator.appVersion.indexOf("MSIE 5.5") != -1) ? 1 : 0;
var is_opera = ((navigator.userAgent.indexOf("Opera6") != -1) || (navigator.userAgent.indexOf("Opera/6") != -1)) ? 1 : 0;
//netscape, safari, mozilla behave the same??? 
var is_netscape = (navigator.userAgent.indexOf('Netscape') >= 0) ? 1 : 0;

function PingServerForMsg() {
  
alert(requestURL);
        //Append the name to search for to the requestURL
        var url = requestURL + 454;

        //Create the xmlHttp object to use in the request 
        //stateChangeHandler will fire when the state has changed, i.e. data is received back 
        // This is non-blocking (asynchronous) 
        xmlHttp = GetXmlHttpObject(stateChangeHandler);

        //Send the xmlHttp get to the specified url 
        xmlHttp_Get(xmlHttp, url);
  
}

//stateChangeHandler will fire when the state has changed, i.e. data is received back 
// This is non-blocking (asynchronous) 
function stateChangeHandler() {
    //readyState of 4 or 'complete' represents that data has been returned 
    if (xmlHttp.readyState == 4 || xmlHttp.readyState == 'complete') {
        //Gather the results from the callback 
        var str = xmlHttp.responseText;
        if (str != "") {            
            //document.getElementById('msgPanel').innerHTML += str;            
            var msgs = str.split('#');

            for (ind = 0; ind < msgs.length; ind++) {
                msgs[ind] = msgs[ind].replace("_@HASH__", "#");
                var msg = msgs[ind].split("&");
                msg[0] = msg[0].replace("_@AMP__", "&");
                msg[1] = msg[1].replace("_@AMP__", "&");
                msg[2] = msg[2].replace("_@AMP__", "&");

                document.getElementById('msgPanel').innerHTML += "<br><b>" + msg[0] + ": </b>" + msg[2];
                document.getElementById('msgPanel').doScroll("scrollbarPageDown");
            }
        }
    }
}

// XMLHttp send GET request 
function xmlHttp_Get(xmlhttp, url) {
    xmlhttp.open('GET', url, true);
    xmlhttp.send();
}

function GetXmlHttpObject(handler) {
    var objXmlHttp = null;    //Holds the local xmlHTTP object instance 

    //Depending on the browser, try to create the xmlHttp object 
    if (is_ie) {
        //The object to create depends on version of IE 
        //If it isn't ie5, then default to the Msxml2.XMLHTTP object 
        var strObjName = (is_ie5) ? 'Microsoft.XMLHTTP' : 'Msxml2.XMLHTTP';

        //Attempt to create the object 
        try {
            objXmlHttp = new ActiveXObject(strObjName);
            objXmlHttp.onreadystatechange = handler;
        }
        catch (e) {
            //Object creation errored 
            alert('IE detected, but object could not be created. Verify that active scripting and activeX controls are enabled');
            return;
        }
    }
    else if (is_opera) {
        //Opera has some issues with xmlHttp object functionality 
        alert('Opera detected. The page may not behave as expected.');
        return;
    }
    else {
        // Mozilla | Netscape | Safari 
        objXmlHttp = new XMLHttpRequest();
        objXmlHttp.onload = handler;
        objXmlHttp.onerror = handler;
    }

    //Return the instantiated object 
    return objXmlHttp;
}

PingServer();
