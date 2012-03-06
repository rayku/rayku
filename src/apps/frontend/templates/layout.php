<?php RaykuCommon::getDatabaseConnection(); ?>
<?php if( ( sfContext::getInstance()->getModuleName() == 'start' )) : ?>

<?php

$c = new Criteria();
//$c->add(UserPeer::ID);
$newUser  = UserPeer::doSelect($c);
//print_r($newUser);


////if no online expert available redirecting to the board page

$onlineusers = array();  
$offlineusers = array();
$newOnlineUser = array();  
$newOfflineUser = array();
							
$j=0; $k = 0;
$facebookTutors = BotServiceProvider::createFor("http://facebook.rayku.com/tutor")->getContent();
$onlineTutorsByNotificationBot = BotServiceProvider::createFor("http://notification-bot.rayku.com/tutor")->getContent();

$Users = json_decode($facebookTutors, true);
$_Users = json_decode($onlineTutorsByNotificationBot, true);


foreach($newUser as $new):
	
	
	 $a=new Criteria();
	 $a->add(UserPeer::ID,$new->getId());
	 $users_online=UserPeer::doSelectOne($a);

		$onlinecheck = '';

		if($users_online->isOnline()) {

			$onlinecheck = "online";

		} 

		if(empty($onlinecheck)) {
		
			$gtalkquery = mysql_query("select * from user_gtalk where userid=".$new->getId()) or die(mysql_error());
		
			if(mysql_num_rows($gtalkquery) > 0) {
		
				$status = mysql_fetch_assoc($gtalkquery);
		
				$gtalkmail = $status['gtalkid'];
		
				 $onlinecheck = BotServiceProvider::createFor('http://www.rayku.com:8892/status/'.$gtalkmail)->getContent();
			} 
		
		}

		if((empty($onlinecheck) || ($onlinecheck != "online")) && is_array($Users)) {

					$fb_query = mysql_query("select * from user_fb where userid=".$new->getId()) or die(mysql_error());

					if(mysql_num_rows($fb_query) > 0) {

						$fbRow = mysql_fetch_assoc($fb_query);

						$fb_username = $fbRow['fb_username'];


					foreach($Users as $key => $user) :

						if($user['username'] == $fb_username):

							 $onlinecheck = 'online'; 	

							 break;	
						endif;

					endforeach;

					}

		}
	
	  if((empty($onlinecheck) || ($onlinecheck != "online")) && is_array($_Users)) {



		foreach($_Users as $key => $_user) :

			if($_user['email'] == $users_online->getEmail()):

				 $onlinecheck = 'online'; 		
				 break;	
			endif;

		endforeach;

	}
	


	if($onlinecheck == "online") {

	$onlineusers[$j] = $new->getId();
	$j++;

	} elseif($users_online->isOnline()) {
		$onlineusers[$j] = $new->getId();
	    $j++;

	} 
							
	endforeach;
	//echo "<pre>";
	//print_r($onlineusers);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>On-Demand P2P Math Tutoring | Calculus, Algebra, Statistics, more | Rayku.com</title>
<link href="../css/landing/style.css" rel="stylesheet" media="screen" type="text/css" />
<!--[if lte IE 8]>
<link href="css/ie78.css" rel="stylesheet" media="screen" type="text/css" />
<![endif]-->

<!-- Form Validation -->

<link href="../css/validation/validationEngine.jquery.css" rel="stylesheet" media="screen" type="text/css" />
 <script src="../js/validation/jquery-1.6.min.js" type="text/javascript"> </script>
<script src="../js/validation/languages/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="../js/validation/jquery.validationEngine.js"></script>

<script>

	var frmVal = jQuery.noConflict();

   frmVal(document).ready(function(){
                // binds form submission and fields to the validation engine
            frmVal("#register-form").validationEngine();
   });
   
   
   
   function checkName(field, rules, i, options){
                if (field.val() == "Full Name") {
                    // this allows to use i18 for the error msgs
			        return "* Please enter Full Name";
                }
   }
   
   function checkPassword(field, rules, i, options){
                if (field.val() == "Password") {
                    // this allows to use i18 for the error msgs
			        return "* Please enter Password";
                }
   }
   
   function checkRPassword(field, rules, i, options){
		
		
		if (field.val() == "Confirm Password") {
                    // this allows to use i18 for the error msgs
			        return "* Please enter Confirm Password";
                }
		else if(document.getElementById("password").value != field.val() ){
		  return "* Password and Confirm Password fields do not match.";
		}
				
   }

	function emailValidateNew(field, rules, i, options)
	{

		var email = field.val();

		var mailadd = email.split("@");
		
		if(mailadd.length>1)
		{
			var finalsplit = mailadd[1].split(".");

			if(mailadd[1] == "utoronto.ca")
			{

			}
			else if(mailadd[1] == "alumni.utoronto.ca")
			{

			}
			else if(mailadd[1] == "toronto.edu")
			{

			}
			else
			{
				return '* Rayku is currently available for certain schools only.';			
			}
		}
		else
		{
			return '* Please enter a valid Email address';			
		}
		
	}
	
	function emailDupcheck(field, rules, i, options)
	{
		var email = field.val();
		var flag = 1;
		frmVal.ajax({ cache: false,

			type : "POST",

			url: "http://www.rayku.com/quickreg/duplicationcheck",
			data: "emailId="+email,

			success : function (data) {
				if(data == 'yes')
				{
					document.getElementById('checkdata').value = data;
				}
				else
				{
					document.getElementById('checkdata').value = data;
				}
			

			}
		});
				
	}
	
	function resData(field, rules, i, options)
	{
		var storeData = document.getElementById('checkdata').value;
		if(storeData == 'yes')
		{
			return '* Email address already exist';
		}
	}
	
	
   
</script>			
			


<!-- End of form validation files include -->


<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-21399448-5']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<style>
#header {
    background: url("/images/landing/topnav/header-bg.gif") repeat-x scroll 0 0 transparent;
    height: 47px;
    padding-top: 4px;
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 99999;
}
#header .container h1 {
    float: left;
    margin-top: -4px;
}
#navigation {
    background: url("/images/landing/topnav/navigation-gradient.png") repeat-x scroll 0 0 transparent;
    border-radius: 5px 5px 5px 5px;
    float: right;
    font-family: Tahoma,Geneva,sans-serif;
    font-size: 13px;
    height: 32px;
    line-height: 32px;
    margin-left: 24px;
    margin-top: 2px;
}
#navigation li {
    background: url("/images/landing/topnav/nav-border.png") no-repeat scroll right 6px transparent;
    display: inline-block;
    padding: 0 11px;
}
#navigation li a:hover {
    text-decoration: underline;
}
#navigation li:last-child {
    background: none repeat scroll 0 0 transparent;
}
</style>
</head>

<body>
<!--header-->
<div id="header"> 
  <!--container-->
  <div class="container clearfix">
    <h1><a href="#register"><img src="images/landing/topnav/rayku.jpg" alt="Rayku"/></a></h1>
    <!--navigation-->
    <ul id="navigation">
      <li><a href="/login">Login</a></li>
      <li><a href="/register">Register</a></li>
      <li><a href="/tourpage">Tour</a></li>
      <li><a href="/joinus">Tutors</a></li>
    </ul>
    <!--navigation-->
    <div class="clear"></div>
  </div>
  <!--container--> 
  <!--[if IE]>
<div style="width:100%;padding:8px 0;background:#FFCCCC;border-bottom:2px solid #BF3535;font-size:14px;color:#666" align="center">
Rayku currently does not work every well with <strong>Internet Explorer</strong>. Please use Firefox or Chrome or another browser.
</div>
<![endif]-->
</div>
<!--header--> 

<!--register-->
<div id="register"> 
  
  <!--container-->
  <div class="container">
    <form name="register-form" id="register-form" action="quickreg/register" method="post">
       
      <h3>Ask any math question <span style="font-weight:normal"><?php if(count($onlineusers) > 0){ ?>(<span style="color:#003"><?php echo count($onlineusers); ?></span> tutors online):</span> <?php } ?></h3>
      <p class="main-question">
        <input type="text" name="question" id="question" value="Type the question or topic you need help with here"/>
      </p>
      <!-- class="validate[required,custom[onlyLetterNumber]]"  -->
      <!--register-block-->
      <div id="register-block">
        <h4 class="clearfix">Create account as you ask your first question (it's free!):</h4>
        <!--register block fields-->
        <div id="register-block-fields">
          <ul class="clearfix">
            <li>
              <input type="text"  class="validate[required,custom[onlyLetterSp],funcCall[checkName]]" id="name" name="name" placeholder="Full Name"/>
            </li>
            <li>
            <input type="text" id="email" class="validate[required,custom[email],funcCall[emailDupcheck],funcCall[resData]]" name="email" placeholder="Email Address"/>
            </li>
            <li>
              <input type="password" class="validate[required,funcCall[checkPassword]]" id="password" name="password" placeholder="Password"/>
            </li>
            <li>
              <input type="password" class="validate[required,funcCall[checkRPassword]] " id="confirm-password" name="confirm-password" placeholder="Confirm Password"/>
            </li>
            <!-- Email Filter Utoronto.ca - ,funcCall[emailValidateNew]  -->
          </ul>
          <div id="tos-create-account" class="clearfix">
            <p class="tos">By submitting this form, you indicate that you have read and agree to the <a href="tos.html" target="_blank">Terms & Conditions</a></p>
            <p class="create-account"><input type="image" src="images/landing/ask-question-button.png" value="" />
            </p>
            <input type="hidden" id="checkdata" name="checkdata" />
          </div>
        </div>
        <!--register block fields start/register --> 
        
      </div>
      <!--register-block-->
      
    </form>
  </div>
  <!--container--> 
  <?php //print_r($_SESSION); ?>
</div>
<!--register--> 

<!--bubble section-->
<div id="bubble-section"> 
  
  <!--container-->
  <div class="container clearfix"> 
    
    <!--bubble-->
    <div class="bubble">
      <h3>1. Ask a Question</h3>
      <img src="images/landing/bubble-1-question.png" alt="Ask a Question" /> </div>
    <!--bubble--> 
    
    <!--bubble-->
    <div class="bubble">
      <h3>2. Select a Tutor</h3>
      <img src="images/landing/bubble-2-tutor.png" alt="Tutor" /> </div>
    <!--bubble--> 
    
    <!--bubble-->
    <div class="bubble">
      <h3>3. Learn</h3>
      <a href="#whiteboard"><img src="images/landing/bubble-3-learn.png" alt="Learn" /></a> </div>
    <!--bubble--> 
    
  </div>
  <!--container--> 
  
</div>
<!--bubble-section--> 

<!--questions-->
<div id="questions"> 
  
  <!--container-->
  <div class="container"> 
    
    <!--q-1-->
    <div class="q-1">
      <h3>Connect to</h3>
      <p>peers and experts who are specifically qualified to help you...</p>
    </div>
    <!--q-1--> 
    
    <!--q-2-->
    <div class="q-2">
      <h3>Get Help</h3>
      <p>on algebra, limits, integrals, trigonometry, mortgages, matrices...</p>
    </div>
    <!--q-2--> 
    
    <!--q-3-->
    <div class="q-3"> </div>
    <!--q-3--> 
    
    <!--q-4-->
    <div class="q-4">
      <p>&quot;What is the derivative of 2x^2+34x^2?&quot;</p>
    </div>
    <!--q-4--> 
    
    <!--q-5-->
    <div class="q-5">
      <p>&quot;What are the exact steps to factor f(x)= x^(3)+2x^(2)-45x-126?&quot;</p>
    </div>
    <!--q-5--> 
    
    <!--q-6--> 
    <img src="../images/landing/qmark-6.png" alt="Questions?" class="q-6" /><!--q-6--> 
    
    <!--q-7--> 
    <img src="../images/landing/qmark-7.png" alt="Questions?" class="q-7" /><!--q-7--> 
    
    <!--q-8--> 
    <img src="../images/landing/qmark-8.png" alt="Questions?" class="q-8" /><!--q-8--> 
    
  </div>
  <!--container--> 
  
</div>
<!--questions--> 

<!--whiteboard-->
<div id="whiteboard"> 
  
  <!--container-->
  <div class="container"> <a><img src="../images/landing/whiteboard.png" alt="Whiteboard" /></a> <a class="plus-green plus">+</a> 
    
    <!--plus green-->
    <div id="plus-green" class="tooltip fade">
      <h3>Tools</h3>
      <p>The math equation writer makes it easy to communicate your question and thoughts. </p>
    </div>
    <!--plus green--> 
    
    <a class="plus-grey plus">+</a> 
    
    <!--plus grey-->
    <div id="plus-grey" class="tooltip fade">
      <h3>Video</h3>
      <p>See or listen to the tutor explain the concepts in question as they draw it out for you in real time. </p>
    </div>
    <!--plus grey--> 
    
    <a class="plus-blue plus">+</a> 
    
    <!--plus blue-->
    <div id="plus-blue" class="tooltip fade">
      <h3>Chat</h3>
      <p>More comfortable typing? We've got you covered! </p>
    </div>
    <!--plus blue--> 
    
    <a class="plus-orange plus">+</a> 
    
    <!--plus orange-->
    <div id="plus-orange" class="tooltip fade">
      <h3>Board</h3>
      <p>Watch as the tutor illustrates each step in a visual way on the live shared whiteboard. </p>
    </div>
    <!--plus orange-->
    
    <div class="clip-left clip"></div>
    <div class="clip-right clip"></div>
  </div>
  <!--container--> 
  
</div>
<!--whiteboard--> 

<!--newletter-->
<div id="newsletter"> 
  
  <!--container-->
  <div class="container"> 
    
    <!--newsletter-content-->
    <div id="newsletter-content"> 
      
      <!--video-->
      <div class="video">
        <object width="465" height="260" id="wistia_355291" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000">
          <param name="movie" value="http://embed.wistia.com/flash/embed_player_v1.1.swf"/>
          <param name="allowfullscreen" value="true"/>
          <param name="allowscriptaccess" value="always"/>
          <param name="wmode" value="opaque"/>
          <param name="flashvars" value="videoUrl=http://embed.wistia.com/deliveries/ba0a68c9caf8ac95d7db03fa1af41508ce3aae18.bin&stillUrl=http://embed.wistia.com/deliveries/25764ea6e2c447c5d69d07633de6e3ff91fa0e14.bin&unbufferedSeek=false&controlsVisibleOnLoad=false&autoPlay=false&endVideoBehavior=reset&playButtonVisible=true&embedServiceURL=http://distillery.wistia.com/x&accountKey=wistia-production_6330&mediaID=wistia-production_355291&mediaDuration=116.08"/>
          <embed src="http://embed.wistia.com/flash/embed_player_v1.1.swf" width="465" height="260" name="wistia_355291" type="application/x-shockwave-flash" allowfullscreen="true" allowscriptaccess="always" wmode="opaque" flashvars="videoUrl=http://embed.wistia.com/deliveries/ba0a68c9caf8ac95d7db03fa1af41508ce3aae18.bin&stillUrl=http://embed.wistia.com/deliveries/25764ea6e2c447c5d69d07633de6e3ff91fa0e14.bin&unbufferedSeek=false&controlsVisibleOnLoad=false&autoPlay=false&endVideoBehavior=reset&playButtonVisible=true&embedServiceURL=http://distillery.wistia.com/x&accountKey=wistia-production_6330&mediaID=wistia-production_355291&mediaDuration=116.08"></embed>
        </object>
        <script src="http://embed.wistia.com/embeds/v.js" charset="ISO-8859-1"></script><script>if(!navigator.mimeTypes['application/x-shockwave-flash'] || navigator.userAgent.match(/Android/i)!==null)Wistia.VideoEmbed('wistia_355291',465,260,{videoUrl:'http://embed.wistia.com/deliveries/aeee0f5fed348f465177b871fde7bb0b30ab7405.bin',stillUrl:'http://embed.wistia.com/deliveries/25764ea6e2c447c5d69d07633de6e3ff91fa0e14.bin',distilleryUrl:'http://distillery.wistia.com/x',accountKey:'wistia-production_6330',mediaId:'wistia-production_355291',mediaDuration:116.08})</script>
        <form action="#" id="newsletter-form">
          <p>Take 30 seconds</p>
          <p><a href="/register">Register Now</a></p>
        </form>
      </div>
      <!--video--> 
      
    </div>
    <!--newsletter-content--> 
  </div>
  <!--container--> 
  
</div>
<!--newsletter--> 

<!--footer-->
<div class="footer"> 
  
  <!--container-->
  <div class="container">
    <div style="width:300px;float:left;">Copyright 2012 Rayku, Inc. All rights reserved.</div>
    <div style="width:300px;float:right;" align="right"><a href="mailto:cs@rayku.com">contact us</a> // <a href="http://rayku.com/tos.html" target="_blank" title="[Opens in pop-up window]">legal</a> // <a href="http://rayku.com/joinus">become a rayku tutor</a></div>
  </div>
  <!--container--> 
  
</div>
<!--footer--> 

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>
<script type="text/javascript" src="http://placeholder-fixer.googlecode.com/svn/trunk/placeholder_fixer.js"></script>
<script type="text/javascript" src="../js/landing/jquery.easing.1.3.js"></script> 
<script type="text/javascript" src="../js/landing/jquery.scrolling-parallax.js"></script> 
<script type="text/javascript" src="../js/landing/functions.js"></script> 
<script type="text/javascript" src="../js/landing/input-fader.js"></script> 

</body>
</html>

<?php else: ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include_http_metas() ?>
<?php include_metas() ?>
<?php include_title() ?>
<link rel="stylesheet" type="text/css" href="/css/navigation.css"/>
<link rel="stylesheet" type="text/css" href="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/css/global.css" />
<?php if($sf_context->getModuleName() =='journal'): ?>
<link rel="stylesheet" type="text/css" href="/css/custom/read-journal.css"/>
<link rel="stylesheet" type="text/css" href="/css/forum.css"/>
<?php endif; ?>
<?php if($sf_context->getModuleName() =='profile'): ?>
<link rel="stylesheet" type="text/css" href="/css/custom/edit-profile.css"/>
<?php endif; ?>
<?php if($sf_context->getModuleName() =='message' and $sf_context->getActionName() !='compose'): ?>
<link rel="stylesheet" type="text/css" href="/css/custom/pm-homepage.css"/>
<?php endif; ?>
<?php if($sf_context->getModuleName() =='search' || $sf_context->getModuleName() =='friends' || $sf_context->getModuleName() =='profile' || $sf_context->getModuleName() =='tutors'): ?>
<link rel="stylesheet" type="text/css" href="/styles/donny.css"/>
<link rel="stylesheet" type="text/css" href="/css/custom/pplsrch-results.css"/>
<link rel="stylesheet" type="text/css" href="/css/pager.css"/>
<?php endif; ?>
<?php if($sf_context->getModuleName() =='gallery' and $sf_context->getActionName() =='home'): ?>
<link rel="stylesheet" type="text/css" href="/css/custom/gallery-homepage.css"/>
<?php endif; ?>
<?php if($sf_context->getModuleName() =='gallery' and $sf_context->getActionName() =='show'): ?>
<link rel="stylesheet" type="text/css" href="/css/custom/album-homepage.css"/>
<?php endif; ?>
<?php if($sf_context->getModuleName() =='gallery' and $sf_context->getActionName() =='upload'): ?>
<link rel="stylesheet" type="text/css" href="/css/custom/upload-media.css"/>
<?php endif; ?>
<?php if($sf_context->getModuleName() =='gallery'): ?>
<link rel="stylesheet" type="text/css" href="/css/custom/view-media.css"/>
<?php endif; ?>
<?php if($sf_context->getModuleName() =='network'): ?>
<link rel="stylesheet" type="text/css" href="/styles/donny.css"/>
<link rel="stylesheet" type="text/css" href="/css/custom/network-homepage.css"/>
<link rel="stylesheet" type="text/css" href="/styles/pf_global.css"/>
<link rel="stylesheet" type="text/css" href="/css/46.css"/>
<?php endif; ?>
<?php if($sf_context->getModuleName() =='login'): ?>
<link rel="stylesheet" type="text/css" href="/styles/donny.css"/>
<?php endif; ?>
<?php if($sf_context->getModuleName() =='dashboard'): ?>
<link rel="stylesheet" type="text/css" href="/styles/pf_global.css"/>
<link rel="stylesheet" type="text/css" href="/css/46.css"/>
<?php endif; ?>
<?php if($sf_context->getModuleName() =='invitation'): ?>
<link rel="stylesheet" type="text/css" href="/styles/donny.css"/>
<?php endif; ?>
<?php if($sf_context->getModuleName() =='studentmanager' && $sf_context->getActionName() =='search'): ?>
<link rel="stylesheet" type="text/css" href="/styles/donny.css"/>
<link rel="stylesheet" type="text/css" href="/css/custom/pplsrch-results.css"/>
<?php endif; ?>
<?php if($sf_context->getModuleName() == 'expertmanager'):?>
<link rel="stylesheet" type="text/css" href="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/styles/classroom.css" />
<link rel="stylesheet" type="text/css" href="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/css/custom/button.css"/>
<link rel="stylesheet" type="text/css" href="/css/pager.css"/>
<!-- Connect Pop Up CSS -->
<link rel="stylesheet" type="text/css" href="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/css/connect.css" />
<?php endif; ?>
<?php if($sf_context->getModuleName() == 'tutors'):?>
<link rel="stylesheet" type="text/css" href="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/styles/classroom.css" />
<link rel="stylesheet" type="text/css" href="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/css/custom/button.css"/>
<!-- Connect Pop Up CSS -->
<link rel="stylesheet" type="text/css" href="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/css/connect.css" />
<?php endif; ?>
<?php if($sf_context->getModuleName() =='whiteboard'): ?>
<link rel="stylesheet" type="text/css" href="/styles/pf_global.css"/>
<link rel="stylesheet" type="text/css" href="/css/46.css"/>
<?php endif; ?>

<?php if($sf_context->getModuleName() !='expertmanager'){ 
         
        if(@$_SESSION['symfony/user/sfUser/attributes']['symfony/user/sfUser/attributes']['user_id']!="")
	{ 
        $sessUserId = $_SESSION['symfony/user/sfUser/attributes']['symfony/user/sfUser/attributes']['user_id'];
	
	$queryStatus = mysql_query("select * from user_expert where user_id=".$sessUserId." ") or die(mysql_error());
	
	if(mysql_num_rows($queryStatus)) {

		mysql_query("DELETE FROM `sendmessage` WHERE `asker_id` =".$sessUserId." ") or die(mysql_error());

		mysql_query("DELETE FROM `user_expert` WHERE `user_id`=".$sessUserId." ") or die(mysql_error());

		setCookie("redirection", "",time()-600);
		setCookie("forumsub", "",time()-600);
	
	}
   }

	
} ?>



<script type="text/javascript" src="/js/add-event.js"></script>
<script type="text/javascript" src="/js/popup.js"></script>
<script type="text/javascript" src="/js/jquerynav.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script type="text/javascript" src="/js/jquery.notifier.js"></script>
<style type="text/css">
<?php if( ( ( sfContext::getInstance()->getModuleName() == 'classmanager' ) && ( sfContext::getInstance()->getActionName() == 'list') || ( sfContext::getInstance()->getModuleName() == 'studentmanager' ) && ( sfContext::getInstance()->getActionName() == 'index') ) || ( ( sfContext::getInstance()->getModuleName() == 'profile' ) && ( sfContext::getInstance()->getActionName() == 'edit') ) ): ?> @import "/styles/cm_global.css";
 @import "/css/46.css";
 @import "/styles/donny.css";
<?php endif;
?> <?php if( ( sfContext::getInstance()->getModuleName() == 'expertmanager' ) && ( sfContext::getInstance()->getActionName() == 'index')): ?> @import "styles/ex_global.css";
 @import "css/46.css";
 @import "styles/ex_donny.css";
 @import "styles/ex_tabcontent.css";
<?php endif;
?>
</style>
<?php if( ( sfContext::getInstance()->getModuleName() == 'profile' ) &&
	          ( sfContext::getInstance()->getActionName() == 'index')): ?>
<link href="/styles/pf_global.css" type="text/css" rel="stylesheet" />
<?php endif; ?>
<?php if( ( sfContext::getInstance()->getModuleName() == 'expert_lesson' ) &&
	          ( sfContext::getInstance()->getActionName() == 'edit') ||
            ( sfContext::getInstance()->getModuleName() == 'expert_lesson' ) &&
	          ( sfContext::getInstance()->getActionName() == 'create') ): ?>
<link rel="stylesheet" type="text/css" href="/styles/ex_create_lesson.css"/>
<?php endif; ?>
<?php if( ( sfContext::getInstance()->getModuleName() == 'experts_immediate_lesson' ) &&
	          ( sfContext::getInstance()->getActionName() == 'edit') ||
            ( sfContext::getInstance()->getModuleName() == 'experts_immediate_lesson' ) &&
	          ( sfContext::getInstance()->getActionName() == 'create') ): ?>
<link rel="stylesheet" type="text/css" href="/styles/ex_create_lesson.css"/>
<?php endif; ?>
<?php if( $sf_context->getModuleName() =='tourpage'
          && ( sfContext::getInstance()->getActionName() == 'index') ): ?>
<?php echo stylesheet_tag('custom/tourpage') ?><?php echo javascript_include_tag('slider1') ?><?php echo javascript_include_tag('jquery-min') ?>
<?php endif; ?>
<?php if( $sf_context->getModuleName() =='register'): ?>
<link rel="stylesheet" type="text/css" href="/css/46.css"/>
<?php endif; ?>
<?php if( $sf_context->getModuleName() =='register'
          && ( sfContext::getInstance()->getActionName() == 'index'
             || sfContext::getInstance()->getActionName() == 'stepthird' ) ): ?>
<link rel="stylesheet" type="text/css" href="/css/custom/register.css"/>
<?php endif; ?>

<?php if( $sf_context->getModuleName() !='tutorsignup'): ?>
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-21399448-5']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
<?php endif; ?>

</head>
<?php if(( sfContext::getInstance()->getModuleName() == 'profile' ) && ( sfContext::getInstance()->getActionName() == 'index')): ?>
<body id="subpage" style="background:none">
<?php else: ?>
<body style="background:none">
<?php endif; ?>
<?php include_partial('global/topNav'); ?>
<div id="wrapper">
  <div class="primary">
    <div id="body">
      <?php  include_partial('global/messages') ?>
      <?php echo $sf_content ?>
      <div class="clear-both"></div>
      <form action="/search" method="post">
        <div class="searchform">
          <fieldset>
            Find
            <?php $options=array("people"=>"People:","forums"=>"Q&A Posts:"); ?>
            <?php echo select_tag("findfrom",options_for_select($options,$sf_request->getParameter('findfrom')),array('class' => 'sselect')); ?>
            <input type="text" name="criteria" class="text-box" value="<?php echo $sf_request->getParameter('criteria') ?>" />
            <input type="submit" class="myButton" value="Search!" />
          </fieldset>
        </div>
      </form>
    </div>
    <!-- end of content -->
    
    <div id="footer" style="padding-bottom:40px;">
      <div class="foo">
        <div class="partners"><a href="http://rayku.com" target="_blank"><img src="/images/img-footer-logo-1.png" alt="rayku.com"/></a> </div>
        <p style="margin-top:10px">Copyright 2012 Rayku, Inc.  All rights reserved.</p>
        <ul>
          <!--<li><?php echo link_to( 'member list', 'friends/index' ); ?></li>-->
          <li><a href="mailto:cs[at]rayku.com">contact us</a></li>
          <li><a href="http://rayku.com/tos.html" rel="popup standard 800 600 noicon">legal</a></li>
          <li class="nobg"><a href="http://rayku.com/joinus">become a rayku tutor</a></li>
        </ul>
        <div style="clear:both"></div>
      </div>
    </div>
    <!-- end of footer --> 
    
  </div>
  <!-- end of primary --> 
</div>
<!-- end of wrapper -->
<script type="text/javascript">
  var uvOptions = {};
  (function() {
    var uv = document.createElement('script'); uv.type = 'text/javascript'; uv.async = true;
    uv.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'widget.uservoice.com/zFbqWgC8UzwfpVPULytOQ.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(uv, s);
  })();
</script>
</body>
</html>
<?php endif; ?>
