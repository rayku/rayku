<?php /* include the PHP Facebook Client Library to help with the API calls and make life easy */
require_once('facebook-client/facebook.php'); 
/* initialize the facebook API with your application API Key and Secret */ 
$facebook = new Facebook('72a0b4b7144eb2fa6e62573e516d6aad','49d25bc19791fac6878114f8c92eca3d'); /* require the user to be logged into Facebook before using the application. If they are not logged in they will first be directed to a Facebook login page and then back to the application's page. require_login() returns the user's unique ID which we will store in fb_user */ 
$fb_user = $facebook->require_login(); /* now we will say: Hello USER_NAME! Welcome to my first application! */ ?> 
Hello <fb:name uid='<?php echo $fb_user; ?>' useyou='false' possessive='true' />! Welcome to my first application!


