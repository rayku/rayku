<?
require_once("attachmentread.class.php");
$host="{localhost:995/pop3/ssl/novalidate-cert}"; // pop3host
$login="himanshu@rayku.com"; //pop3 login
$password="himanshu"; //pop3 password
$savedirpath="" ; // attachement will save in same directory where scripts run othrwise give abs path
$jk=new readattachment(); // Creating instance of class####
$jk->getdata($host,$login,$password,$savedirpath); // calling member function

?>