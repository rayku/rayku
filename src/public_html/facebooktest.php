<?php /* include the PHP Facebook Client Library to help with the API calls and make life easy */


require_once('../lib/facebook.php'); 
require_once('../lib/FBToolbox.class.php'); 

/* initialize the facebook API with your application API Key and Secret */ 
$facebook = new Facebook('27361b7c544ba443e405884861b47a80','4d37539c26045eb625a61401ead28fea'); /* require the user to be logged into Facebook before using the application. If they are not logged in they will first be directed to a Facebook login page and then back to the application's page. require_login() returns the user's unique ID which we will store in fb_user */ 

try
{
	if(!$_GET['auth_token'])
	{
		$facebook->expire_session();
		$fb_user = $facebook->require_login();
	}
	else
	{
		$fb_user = $facebook->require_login();	
	}
}
catch(Exception $e)
{
	$fb_user = $facebook->require_login(); /* now we will say: Hello USER_NAME! Welcome to my first application! */ 	
}



 try 
 {  
 	if (!$facebook->api_client->users_isappadded())
	{  
		 $facebook->redirect($facebook->get_add_url());  
 	}  
 } 
 catch(Exception $e)
 {
	 $facebook->set_user(null, null);  
	 $facebook->redirect(callback_url); 		 
 }






$fbtoolbox= new FbToolbox('27361b7c544ba443e405884861b47a80','4d37539c26045eb625a61401ead28fea');

$session_id = $facebook->do_get_session($_GET['auth_token']);

?>
<?php //var_dump($fbtoolbox->getFriendList($fb_user));
$friends = $fbtoolbox->getFriendList($fb_user);
//var_dump($fbtoolbox->getUserInfo($friends[0]));

if($_GET['auth_token'])
{
	header('Location:http://' . $_SERVER['HTTP_HOST']  . '/login/testfacebook?userdetails=' . $fb_user);
}

?>


</div> 