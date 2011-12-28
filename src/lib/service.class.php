<?php

class service {

//loader for each network

function servicefun($service,$username,$password){

if ($service == "gmail"){

//------------------------------------------------------------------ GMAIL START -----------------------------------------------------------------	
$display_array = array();

$refering_site = "http://mail.google.com/mail/";//setting the site for refer

$browser_agent = "Mozilla/5.0 (Windows; U; Windows NT 5.0; en-US; rv:1.7.12) Gecko/20050915 Firefox/1.0.7";//setting browser type

$mycookie = $username.'.cookie';
$fh = fopen($mycookie,'w');
fclose($fh);

$path_to_cookie = realpath("$mycookie");

$setcookie = fopen($path_to_cookie,'wb');//this opens the file and resets it to zero length
fclose($setcookie);

//---------------------------------------------------STEP 1

$url = "http://mail.google.com/mail/";
$page_result = config::curl_get($path_to_cookie,$browser_agent,$url,1,0);

//---------------------------------------------------STEP 2

$postal_data = "ltmpl=yj_blanco&ltmplcache=2&continue=http%3A%2F%2Fmail.google.com%2Fmail%3F&service=mail&rm=false&ltmpl=yj_blanco&Email=".
    $username."&Passwd=".$password."&rmShown=1&null=Sign+in";
$url = 'https://www.google.com/accounts/ServiceLoginAuth';
$result = config::curl_post($path_to_cookie,$browser_agent,$url,$postal_data,1,0);
// [pick up forwarding url]
preg_match_all("/location.replace.\"(.*?)\"/",$result,$matches);
$matches = $matches[1][0];

//---------------------------------------------------STEP 3

$url = $matches;
$result = config::curl_get($path_to_cookie,$browser_agent,$url,1,0);

//---------------------------------------------------STEP 4 - html only

$url = 'https://mail.google.com/mail/?ui=html&zy=e';
$result = config::curl_get($path_to_cookie,$browser_agent,$url,1,0);

//---------------------------------------------------STEP 5 - open export contacts page
$url = 'https://mail.google.com/mail/?ui=1&ik=&view=sec&zx=';
$result = config::curl_get($path_to_cookie,$browser_agent,$url,1,0);
preg_match_all("/value=\"(.*?)\"/",$result,$matches);
$matches = $matches[1][0];
//echo $matches;

//---------------------------------------------------STEP 6 - download csv

$postal_data = 'at='.$matches.'&ecf=g&ac=Export Contacts';
$url = 'https://mail.google.com/mail/?ui=1&view=fec';
$result = config::curl_post($path_to_cookie,$browser_agent,$url,$postal_data,1,0);
@unlink ($path_to_cookie);

//------------------------------------------------------------------GMAIL - END -----------------------------------------------------------------
}



if ($service == 'hotmail'){
//------------------------------------------------------------------HOTMAIL START -----------------------------------------------------------------	
$display_array = array();

$refering_site = "http://mail.hotmail.com/"; //setting the site for refer

$browser_agent = "Mozilla/5.0 (Windows; U; Windows NT 5.0; en-US; rv:1.4) Gecko/20030624 Netscape/7.1 (ax)"; //setting browser type

$mycookie = $username.'.cookie';
$fh = fopen($mycookie,'w');
fclose($fh);

$path_to_cookie = realpath("$mycookie");
$setcookie = fopen($path_to_cookie,'wb');//this opens the file and resets it to zero length
fclose($setcookie);


//---------------------------------------------------STEP 1

$url = "http://login.live.com/login.srf?id=2&vv=400&lc=1033";
$page_result =config::curl_get($path_to_cookie,$browser_agent,$url,1,0);
preg_match_all("/name=\"PPFT\" id=\"i0327\" value=\"(.*?)\"/", $page_result, $matches1); 
$found1 = $matches1[1][0];                 
preg_match_all("/name=\"PPSX\" value=\"(.*?)\"/", $page_result, $matches2); 
$found2 = $matches2[1][0]; 
preg_match_all("/name=\"PwdPad\" id=\"i0340\" value=\"(.*?)\"/", $page_result, $matches3); 
$found3= $matches3[1][0]; 
preg_match_all("/method=\"POST\" target=\"_top\" action=\"(.*?)\"/", $page_result, $matches4); 
$found4= $matches4[1][0]; 
preg_match_all("/name=\"LoginOptions\" id=\"i0136\" value=\"(.*?)\"/", $page_result, $matches5); 
$found5= $matches5[1][0];

//---------------------------------------------------STEP 2

$postal_data ='PPSX='.$found2.'&'.'PwdPad='.$found3.'&'.'login='.$username.'&'.'passwd='.$password.'&'.'LoginOptions='.$found5.'&'.'PPFT='.$found1;
$url = $found4;
$result =config::curl_post($path_to_cookie,$browser_agent,$url,$postal_data,1,0);
preg_match_all("/replace\(\"(.*?)\"/", $result, $matches);	
$matches = $matches[1][0];

//---------------------------------------------------STEP 3

$url = $matches;
$result =config::curl_get($path_to_cookie,$browser_agent,$url,1,0);

//---------------------------------------------------STEP 4 - OPEN ADDREDD CHERRY PICKER

$url = 'http://by101fd.bay101.hotmail.msn.com/cgi-bin/AddressPicker?Context=InsertAddress&_HMaction=Edit&qF=to';
$result =config::curl_get($path_to_cookie,$browser_agent,$url,1,0);
preg_match_all('%<option[^>]*value="([^"]*)"[^>]*>([^<]*)&lt;[^>]*&gt;</option>%', $result, $matches, PREG_SET_ORDER);
@unlink ($path_to_cookie);

//------------------------------------------------------------------HOTMAIL - END -----------------------------------------------------------------
}




if ($service == "yahoo"){

//------------------------------------------------------------------YAHOO START-----------------------------------------------------------------			
$display_array = array();

$refering_site = "http://yahoo.com/"; //setting the site for refer

$browser_agent = "Mozilla/5.0 (Windows; U; Windows NT 5.0; en-US; rv:1.4) Gecko/20030624 Netscape/7.1 (ax)"; //setting browser type

$mycookie = $username.'.cookie';

$fh = fopen($mycookie,'w');
fclose($fh);

$path_to_cookie = realpath("$mycookie");


$setcookie = fopen($path_to_cookie,'wb');//this opens the file and resets it to zero length
fclose($setcookie);

//---------------------------------------------------STEP 1

$url = "https://login.yahoo.com/config/mail?.intl=us";
$page_result =config::curl_get($path_to_cookie,$browser_agent,$url,1,0);
preg_match_all("/name=\".tries\" value=\"(.*?)\"/", $page_result, $tries); 
$tries_found = $tries[1][0];                 
preg_match_all("/name=\".src\" value=\"(.*?)\"/", $page_result, $src); 
$src_found = $src[1][0];                 
preg_match_all("/name=\".u\" value=\"(.*?)\"/", $page_result, $u); 
$u_found = $u[1][0];                 
preg_match_all("/name=\".v\" value=\"(.*?)\"/", $page_result, $v); 
$v_found = $v[1][0];                 
preg_match_all("/name=\".challenge\" value=\"(.*?)\"/", $page_result, $challenge); 
$challenge_found = $challenge[1][0];

//---------------------------------------------------STEP 2 - submit login info

$postal_data ='.tries='.$tries_found.'&.src='.$src_found.'&.md5=&.hash=&.js=&.last=&promo=&.intl=us&.bypass=&.partner=&.u=6bu841h2d7p4o&.v=0&.challenge='.$challenge_found.'&.yplus=&.emailCode=&pkg=&stepid=&.ev=&hasMsgr=1&.chkP=Y&.done=http://mail.yahoo.com&.pd=ym_ver%253d0&login='.$username.'&passwd='.$password;
$url = 'https://login.yahoo.com/config/login?';
$result =config::curl_post($path_to_cookie,$browser_agent,$url,$postal_data,1,0);
preg_match_all("/replace\(\"(.*?)\"/", $result, $matches);	

$matches = $matches[1][0];
	
//---------------------------------------------------STEP 3 - Redirect

$url = $matches;
$result =config::curl_get($path_to_cookie,$browser_agent,$url,1,0);
//---------------------------------------------------STEP 4 - Redirect

$url = 'http://us.rd.yahoo.com/mail_us/pimnav/ab/*http://address.mail.yahoo.com';
$result =config::curl_get($path_to_cookie,$browser_agent,$url,1,0);

//var_dump($result);
//---------------------------------------------------STEP 5 - Open address book

$url = 'http://address.mail.yahoo.com';
$result =config::curl_get($path_to_cookie,$browser_agent,$url,1,0);
preg_match_all("/rand=(.*?)\"/", $result, $array_names);	
$rand_value = str_replace('"', '', $array_names[0][0]);
//---------------------------------------------------STEP 6 - Export address book

$url = 'http://address.mail.yahoo.com/?1&VPC=import_export&A=B&.rand='.$randURL;
$result =config::curl_get($path_to_cookie,$browser_agent,$url,1,0);
preg_match_all("/id=\"crumb1\" value=\"(.*?)\"/", $result, $array_names);	
$matches = $array_names[1][0];


//---------------------------------------------------STEP 7 - Checking if address book is empty

IF (empty($matches)){

    $show = 1;
    $error_message = "No contacts found - check your login details and try again";

}ELSE{




//---------------------------------------------------STEP 8 - submit login info

$postal_data ='.crumb='.$matches.'&VPC=import_export&A=B&submit%5Baction_export_yahoo%5D=Export+Now';
$url = 'http://address.mail.yahoo.com/index.php';
$result =config::curl_post($path_to_cookie,$browser_agent,$url,$postal_data,1,0);


$matches = 1;
}
@unlink ($path_to_cookie);

//------------------------------------------------------------------YAHOO END-----------------------------------------------------------------			
}

if ($service == "live"){
//------------------------------------------------------------------LIVE START -----------------------------------------------------------------		
$display_array = array();

$refering_site = "http://mail.live.com/";//setting the site for refer

$browser_agent = "Mozilla/5.0 (Windows; U; Windows NT 5.0; en-US; rv:1.4) Gecko/20030624 Netscape/7.1 (ax)";//setting browser type

$mycookie = $username.'.cookie';
$fh = fopen($mycookie,'w');
fclose($fh);

$path_to_cookie = realpath("$mycookie");
$setcookie = fopen($path_to_cookie,'wb');//this opens the file and resets it to zero length
fclose($setcookie);

//---------------------------------------------------STEP 1

$url = "http://login.live.com/login.srf?id=64855";
$page_result = config::curl_get($path_to_cookie,$browser_agent,$url,1,0);
preg_match_all("/name=\"PPFT\" id=\"i0327\" value=\"(.*?)\"/",$page_result,$matches1);
$found1 = $matches1[1][0];
preg_match_all("/srf_uPost='(.*?)';var/",$page_result,$matches2);
$found2 = $matches2[1][0];

//---------------------------------------------------STEP 2

$postal_data = 'idsbho=1&PwdPad=IfYouAreReadingThisYouHaveTooMuc&LoginOptions=3&login='.
    $username.'&passwd='.$password.'&NewUser=1&PPFT='.$found1;
$url = $found2;
$result = config::curl_post($path_to_cookie,$browser_agent,$url,$postal_data,1,0);
// [pick up forwarding url]
preg_match_all("/replace\(\"(.*?)\"/",$result,$matches);
$found3 = $matches[1][0];

//---------------------------------------------------STEP 3

$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$found3);
curl_setopt($ch,CURLOPT_USERAGENT,$browser_agent);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,0);
//curl_setopt($ch,CURLOPT_REFERER,$login_page2);
curl_setopt($ch,CURLOPT_COOKIEFILE,$path_to_cookie);
curl_setopt($ch,CURLOPT_COOKIEJAR,$path_to_cookie);
$page_result = curl_exec($ch);
curl_close($ch);

preg_match_all("/href=\"(.*?)\"/",$page_result,$matches);
$found4 = $matches[1][0];
$found100 = preg_replace("/\/mail.*/",'',$found4);
$found101 = $found100.'/mail/mail.aspx';

//---------------------------------------------------STEP 4

$url = $found101;
$page_result = config::curl_get($path_to_cookie,$browser_agent,$url,1,0);
preg_match_all("/\"\/(.*?)\"/",$page_result,$matches);
$found = $matches[1][0];
$found101 = $found100.'/'.$found;

//---------------------------------------------------STEP 5

$url = $found101;
$page_result = config::curl_get($path_to_cookie,$browser_agent,$url,1,0);
preg_match_all("/InboxLight.aspx.n=(.*?)\"/",$page_result,$matches);
$found = $matches[1][0];
$found101 = $found100.'/mail/InboxLight.aspx?n='.$found;

//---------------------------------------------------STEP 6

$url = $found101;
$page_result = config::curl_get($path_to_cookie,$browser_agent,$url,1,0);

//---------------------------------------------------STEP 7

$url = $found101;
$page_result = config::curl_get($path_to_cookie,$browser_agent,$url,1,0);
preg_match_all("/EditMessageLight.aspx._ec=1&n.(.*?)\"/",$page_result,$matches);
$found = $matches[1][0];
$found101 = $found100.'/mail/EditMessageLight.aspx?_ec=1&n='.$found;

//---------------------------------------------------STEP 8

$url = $found101;
$page_result = config::curl_get($path_to_cookie,$browser_agent,$url,1,0);
preg_match_all("/href=\"javascript:pickContact.'(.*?)', '(.*?)'/",$page_result,
    $matches,PREG_SET_ORDER);
@unlink ($path_to_cookie);

//------------------------------------------------------------------LIVE END -----------------------------------------------------------------		
}



$arr=array();
$arr[0]=$matches;
$arr[1]=$result;
$arr[2]=$path_to_cookie;
return $arr;
}
}

?>