<?php


// Browser Check
$HTTP_USER_AGENT=$_SERVER['HTTP_USER_AGENT'];

echo "User Agent--->".$HTTP_USER_AGENT;

echo "<br/><br/>";


$browser=""; $browserh="";

if (eregi ("(netscape|mozilla)", $HTTP_USER_AGENT)==true) $browser="Netscape";

if (eregi ("mozilla/3", $HTTP_USER_AGENT)==true) $browser="mozilla";
if (eregi ("mozilla", $HTTP_USER_AGENT)==true) $browser="mozilla";

if (eregi ("mozilla/4.5", $HTTP_USER_AGENT)==true) $browser="mozilla";

if (eregi ("mozilla/4.6", $HTTP_USER_AGENT)==true) $browser="mozilla";

if (eregi ("mozilla/4.7", $HTTP_USER_AGENT)==true) $browser="mozilla";

if (eregi ("(mozilla/5|gecko/)", $HTTP_USER_AGENT)==true) $browser="mozilla";

if (eregi ("(Chrome/)", $HTTP_USER_AGENT)==true) $browser="chrome";

if (eregi ("(Safari/)", $HTTP_USER_AGENT)==true) $browser="Safari";



if (eregi ("(MSIE 7.0;)", $HTTP_USER_AGENT)==true) $browser="IE7";

if (eregi ("(MSIE 6.0;)", $HTTP_USER_AGENT)==true) $browser="IE6";

if (eregi ("(MSIE 8.0;)", $HTTP_USER_AGENT)==true) $browser="IE8";

if (eregi ("netscape/6", $HTTP_USER_AGENT)==true) $browser="Netscape 6";

if (eregi ("msie", $HTTP_USER_AGENT)==true) $browser="IE";

if (eregi ("msie 3", $HTTP_USER_AGENT)==true) $browser="IE 3";

if (eregi ("msie 3.0", $HTTP_USER_AGENT)==true) $browser="IE 3.0";

if (eregi ("msie 3.01", $HTTP_USER_AGENT)==true) $browser="IE 3.01";

if (eregi ("msie 4", $HTTP_USER_AGENT)==true) $browser="IE 4";

if (eregi ("msie 4.0", $HTTP_USER_AGENT)==true) $browser="IE 4.0";

if (eregi ("msie 4.01", $HTTP_USER_AGENT)==true) $browser="IE 4.01";

if (eregi ("msie 5", $HTTP_USER_AGENT)==true) $browser="IE 5";

if (eregi ("msie 5.0", $HTTP_USER_AGENT)==true) $browser="IE 5.0";

if (eregi ("msie 5.01", $HTTP_USER_AGENT)==true) $browser="IE 5.01";

if (eregi ("msie 5.1", $HTTP_USER_AGENT)==true) $browser="IE 5.1";

if (eregi ("msie 5.5", $HTTP_USER_AGENT)==true) $browser="IE 5.5";

if (eregi ("msie 6", $HTTP_USER_AGENT)==true) $browser="IE 6";

if (eregi ("msie 6.0", $HTTP_USER_AGENT)==true) $browser="IE 6.0";

if (eregi ("msie 6.0b", $HTTP_USER_AGENT)==true) $browser="IE 6.0b";

if (eregi ("opera", $HTTP_USER_AGENT)==true) $browser="Opera";

if (eregi ("opera.2", $HTTP_USER_AGENT)==true) $browser="Opera 2";

if (eregi ("opera.3", $HTTP_USER_AGENT)==true) $browser="Opera 3";

if (eregi ("opera.4", $HTTP_USER_AGENT)==true) $browser="Opera 4";

if (eregi ("opera.5", $HTTP_USER_AGENT)==true) $browser="Opera 5";

if (eregi ("opera.5.11", $HTTP_USER_AGENT)==true) $browser="Opera 5.11";

if (eregi ("opera.5.12", $HTTP_USER_AGENT)==true) $browser="Opera 5.12";

if (eregi ("opera.6", $HTTP_USER_AGENT)==true) $browser="Opera 6";

if (eregi ("opera.7.01", $HTTP_USER_AGENT)==true) $browser="Opera 7.01";

if (eregi ("opera.7.10", $HTTP_USER_AGENT)==true) $browser="Opera 7.10";

if (eregi ("opera.7.11", $HTTP_USER_AGENT)==true) $browser="Opera 7.11";

if (eregi ("lynx", $HTTP_USER_AGENT)==true) $browser="lynx";

if (eregi ("w3m", $HTTP_USER_AGENT)==true) $browser="w3m";

if (eregi ("konqueror", $HTTP_USER_AGENT)==true) $browser="Konqueror";



echo $browser;


?>

