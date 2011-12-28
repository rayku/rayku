<?php
  use_helper('MyAvatar', 'Javascript');
  $raykuUser = $sf_user->getRaykuUser();
  
  
  $logedUserId = $_SESSION['symfony/user/sfUser/attributes']['symfony/user/sfUser/attributes']['user_id'];

 ////////checking user is authirzed to the site 
	$num_of_row=0;
	$con = mysql_connect("localhost", "rayku_db", "db_*$%$%");
         $db = mysql_select_db("rayku_db", $con);
		 $IP=$_SERVER['REMOTE_ADDR'];
		 
		 
	$_query = mysql_query("select * from thread  where user_ip='".$IP."' and banned=1");
	$num_of_row= mysql_num_rows($_query);
	if($num_of_row>0)
	{
		echo "
        <script type='text/javascript'>
			document.location='http://www.rayku.com/error';
		</script>";
        
	}
	
	$_query = mysql_query("select * from banned_ips  where ip like '%".$IP."%' ");
	$num_of_row= mysql_num_rows($_query);
	if($num_of_row>0)
	{
		echo "
        <script type='text/javascript'>
			document.location='http://www.rayku.com/error';
		</script>";
        
	}
	
	if($logedUserId<>'')
	{
			$user_id=$raykuUser->getId();
			$num_of_row=0;
			$_query = mysql_query("select * from thread  where 	poster_id='".$user_id."' and banned=1");
			$num_of_row= mysql_num_rows($_query);
			if($num_of_row>0)
			{
				echo "
				<script type='text/javascript'>
					document.location='http://www.rayku.com/error';
				</script>";
				
			}
	}
//////////////////////////

  if(!$sf_user->isAuthenticated())
  {
?>
<div id="header">
<h1><?php echo link_to( 'Rayku.com Home Page', '@homepage' ); ?></h1>
<form id="log-in" action="<?php echo url_for('/login/loginCheck') ?>" method="post">
  <div style="width:690px; clear:both">
    <div style="float:left; width:195px; margin-left:5px; margin-top:8px;">
      <input type="text" name="name" class="text-box" value="Email" onBlur="if(this.value=='') this.value='Email';" onFocus="if(this.value=='Email') this.value='';" />
    </div>
    <div style="float:left; width:180px; margin-top:8px;">
      <input type="password" name="pass" class="text-box" value="Password" onBlur="if(this.value=='') this.value='Password';" onFocus="if(this.value=='Password') this.value='';" />
    </div>
    <div style="float:left; width:85px; margin-left:15px; ">
      <input type="image" src="/images/login_btn.png" class="image-button" />
    </div>
    <div style="float:left; width:150px; margin-left:15px;font-size:12px; color:#6b6e77;"><?php echo checkbox_tag('remember', '1', true, array('class' => 'checkbox')); ?>
      <p style="color:#fff; font-size:12px; padding-top:2px; padding-bottom:8px;">Remember</p>
      <?php echo checkbox_tag('invisible', '1', false, array('class' => 'checkbox')); ?>
      <p style="color:#fff; font-size:12px; padding-top:0; padding-bottom:8px;">Invisible</p>
    </div>
  </div>
</form>
<?php } else { ?>
<?php $email=$raykuUser->getEmail();
  ?>
<div id="header1">
  <h1><?php echo link_to( 'Dashboard', 'http://rayku.com/dashboard' ); ?></h1>
  <div style="position:absolute;top:12px;left:170px;border:6px solid #a5c9db;"><?php echo avatar_tag_for_user($raykuUser, 2) ; ?></div>
  <p class="welcome"><?php echo link_to($raykuUser->getName(), 'http://rayku.com/profile/'.$raykuUser->getUsername().'/edit',array(style=>'font-weight:bold;font-size:18px;color:#81D6FF',title=>'Edit your Information')) ?><span style="font-weight:normal;font-size:14px;"> | <a href="http://www.rayku.com/tutor/<?php echo $raykuUser->getUsername() ?>" style="color:#81D6FF">my portfolio</a></span>    
    <?php 

  $queryPoints = mysql_query("select * from user where id=".$raykuUser->getId()) or die(mysql_error());
  $detailPoints = mysql_fetch_assoc($queryPoints); 


?>
  </p>
  <p class="pt"><a href="http://www.rayku.com/shop" style="color:#81D6FF"><?php echo $detailPoints['points'];?></a> <a rel="popup standard 600 435 noicon" href="http://rayku.com/rp.html" title="[Opens in pop-up window]" style="color:#809EB7"><img src="http://rayku.com/images/whatisrp.jpg" border="0"/></a></p>
  <ul class="action">
    <?php if($raykuUser->getNrOfNewMessages() >= 1) : ?>
    <li style="font-weight:bold; font-size:11px;">&nbsp;<?php echo link_to($raykuUser->getNrOfNewMessages()." new messages!", 'message/inbox' ); ?></li>
    <?php else:  ?>
    <li>&nbsp;<?php echo link_to($raykuUser->getNrOfNewMessages()." new messages!", 'message/inbox' ); ?></li>
    <?php endif; ?>
  </ul>
  <?php } ?>
  <ul class="main-nav">
    <li class="home">
      <?php
        if( $sf_user->isAuthenticated())
          echo link_to('Ask Qu', 'dashboard/index');
      ?>
    </li>
    <?php if(!$sf_user->isAuthenticated()): ?>
    <li ><?php echo link_to('Tour', 'tourpage/index'); ?></li>
    <li class="register"><?php echo link_to('Register', 'register/index'); ?></li>
    <?php endif;?>
    <?php if($sf_user->isAuthenticated()): ?>
    <li><?php echo link_to( 'Boards', 'forum/index' ); ?></li>
    <li><?php echo link_to( 'Tutors', 'tutors/index' ); ?></li>
    <li><?php echo link_to( 'RP Shop', 'shop/index' ); ?></li>
    
    <?php //if($raykuUser->getType() == '5'): ?>
    <!--<li><?php echo link_to( 'Manager', 'expertmanager/index' ); ?></li>-->
    <?php if($raykuUser->getType() == '4'): ?>
    <li><?php echo link_to( 'Admin', 'http://' . RaykuCommon::getCurrentHttpDomain() . '/admin.php' ); ?></li>
    <?php endif; ?>
    <li style="margin-left:15px;"><?php echo link_to( 'Logout', 'login/logout' ); ?></li>
    <?php endif;?>
  </ul>


  <div class="search">
    <form id="search-form" style="width:160px;margin-top:8px;color:#FFC973;font-size:14px;line-height:20px"> 
      <!--NEW: <a href="http://www.rayku.com/certification" style="color:#FFF">Tutor Certification</a>-->  
    </form>
    <!--<?php echo form_tag('search/index', array('method' => 'post','id'=>'search-form')) ?>
    <fieldset>
      <input type="text" name="criteria" class="text-box" />
      <input src="/images/btn-search.png"  type="image" class="image-button" onClick="javascript:form.submit();" />
    </fieldset>
    </form>-->
  </div>
</div>

<?php

if(($_SERVER['REDIRECT_URL'] != "/login/loginCheck") &&  ($_SERVER['REDIRECT_URL'] != "/logout") && ($_SERVER['REDIRECT_URL'] != "/register") && ($_SERVER['REDIRECT_URL'] != "/start") && ($_SERVER['REDIRECT_URL'] != "/dashboard/beforeclose")):

?>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="/css/modalbox.css" media="screen" />
<link rel="stylesheet" type="text/css" href="/css/popup.css" media="screen" />
<script type="text/javascript" src="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/js/scriptaculous.js"></script>
<script type="text/javascript" src="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/js/builder.js"></script>
<script type="text/javascript" src="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/js/effects.js"></script>
<script type="text/javascript" src="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/js/unittest.js"></script>
<script type="text/javascript" src="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/js/modalbox.js"></script>
<script type="text/javascript" src="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/js/checkuser.js"></script>
<script type="text/javascript" src="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/js/checkuserstay.js"></script>

<?php if($sf_user->isAuthenticated()) : ?>


	<link rel="stylesheet" type="text/css" href="http://www.rayku.com/styles/popup-window.css" />
	<script type="text/javascript" src="http://www.rayku.com/scripts/popup-window.js"></script>

	<script type="text/javascript" src="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/js/question_popup.js"></script>
	<script language="javascript">checkMissedQuestion();</script>


	<input type="hidden" value='1' name="question_hidden" id="question_hidden" />

	<div class="sample_popup"   id="question_popup" style="display: none;">
	<div class="menu_form_header" id="popup_drag" style="background:#E57A72 none;border:2px solid #E57A72;height:25px;">
	<img class="menu_form_exit"   id="popup_exit" src="http://www.rayku.com/styles/form_exit.png" alt="Exit" /></div>

	<div class="menu_form_body" style="background:#FFF;border:2px solid #E57A72; height:100px;padding-top:50px;">
					<font style="font-size:20px;margin:100px;color:red">You Have Missed The Question !!!</font>
	</div>
	</div>


 <?php endif; ?>


<script type="text/javascript">
checkedUser();
checkForRedirect();
checkUserStay();

function hideDiv() {

document.getElementById("question_popup").style.display = 'none';
return true;

}


function getCookie(c_name)
{

if (document.cookie.length>0)
  {
  c_start=document.cookie.indexOf(c_name + "=");
  if (c_start!=-1)
    {
    c_start=c_start + c_name.length+1;
    c_end=document.cookie.indexOf(";",c_start);
    if (c_end==-1) c_end=document.cookie.length;
    return unescape(document.cookie.substring(c_start,c_end));
    }
  }
return "";
}

function checkForRedirect() {
redirect = getCookie("redirection");
forumsub = getCookie("forumsub");

	if(redirect != '' && redirect != null ) {
		var d = jQuery.noConflict();
		d.ajax({ cache: false,
			type : "POST",
			url: "http://www.rayku.com/register/redirect?page=<?php echo $_SERVER['REQUEST_URI']; ?>",
			success : function (data)  {
				var check = data.split("<");
				if(check[0] == "redirect") {
					document.location = "http://www.rayku.com/forum/newthread/"+forumsub+"?exp_online=1";
				}
			}
		});
	}
setTimeout('checkForRedirect()', 30000);
}
</script>

<?php
endif;  
?>
