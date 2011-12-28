<?php
  use_helper('MyAvatar', 'Javascript');
  $raykuUser = $sf_user->getRaykuUser();

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
      <p style="color:#fff; font-size:12px; padding-top:2px; padding-bottom:8px;">Remember Login</p>
      <?php echo checkbox_tag('invisible', '1', false, array('class' => 'checkbox')); ?>
      <p style="color:#fff; font-size:12px; padding-top:0; padding-bottom:8px;">Login as Invisible</p>
    </div>
  </div>
</form>
<?php } else { ?>
<?php $email=$raykuUser->getEmail();
  ?>
<div id="header1">
  <h1><?php echo link_to( 'Rayku.com Dashboard', 'http://www.rayku.com/dashboard' ); ?></h1>
  <?php echo avatar_tag_for_user($raykuUser, 2) ; ?>
  <?php
  $con = mysql_connect("localhost", "rayku_db", "db_*$%$%");
  $db = mysql_select_db("rayku_db", $con); 
  $query = mysql_query("select * from user_score where user_id=".$raykuUser->getId()) or die(mysql_error());
  $detail=mysql_fetch_assoc($query);
  //echo $detail['score'];
  if(!$detail['score'])
      $detail['score']=900;
  ?>
  <p class="welcome" style="font-size:16px"><span style="font-weight:bold;font-size:18px"><?php echo $raykuUser->getName(); ?><span style="font-weight:normal;font-size:14px;"> | <?php echo link_to('profile', '@profile?username='.$raykuUser->getUsername(),array(style=>'color:#81D6FF')) ?> | <a href="/expertmanager/portfolio/<?php echo $raykuUser->getUsername() ?>" style="color:#81D6FF">portfolio</a> |</span></span>
    <!--&nbsp;&nbsp;|&nbsp;&nbsp;  Expert Score: <strong><?php //echo $detail['score']; ?> 
  
  <?php 
  //if($detail['score']>1000)
  {
	//print " <em>(Honors)</em>";  
  }
  //else
  {
	//print "<em>(Basic)</em>";  
  }
  ?>
  </strong>-->

  <?php 

  $queryPoints = mysql_query("select * from user where id=".$raykuUser->getId()) or die(mysql_error());
  $detailPoints = mysql_fetch_assoc($queryPoints); 


?>
    
  </p>
  <p class="pt"><a href="http://www.rayku.com/register/invitation" style="color:#81D6FF"><?php echo $detailPoints['points'];?></a></p>
  <ul class="action">
    <?php if($raykuUser->getNrOfNewMessages() >= 1) : ?>
    <li style="font-weight:bold; text-decoration: blink; font-size:11px;">&nbsp;<?php echo link_to($raykuUser->getNrOfNewMessages()." new messages!", 'message/inbox' ); ?></li>
    <?php else:  ?>
    <li>&nbsp;<?php echo link_to($raykuUser->getNrOfNewMessages()." new messages!", 'message/inbox' ); ?></li>
    <?php endif; ?>
    <li style="float:right; padding-left:360px; font-weight:bold"><?php echo link_to( 'Logout', 'login/logout' ); ?></li>
  </ul>
  <?php } ?>
  <ul class="main-nav">
    <li class="home">
      <?php
        if( $sf_user->isAuthenticated())
          echo link_to('Start', 'dashboard/index');
        else
          echo link_to('Home', '@homepage');
      ?>
    </li>
    <?php if(!$sf_user->isAuthenticated()): ?>
    <li ><?php echo link_to('Take Tour', 'tourpage/index'); ?></li>
    <li class="register"><?php echo link_to('Register', 'register/index'); ?></li>
    <?php endif;?>
    <?php if($sf_user->isAuthenticated()): ?>
    <li><?php echo link_to( 'Boards', 'forum/index' ); ?></li>
    <li><?php echo link_to( 'Spend $RP', 'shop/index' ); ?></li>
    <li><a href="http://www.rayku.com/register/invitation">Get $RP</a></li>
    <!--<li><a href="http://www.rayku.com:8001/">Practice</a></li>-->
    
    <?php //if($raykuUser->getType() == '5'): ?>
    <!--<li><?php echo link_to( 'Manager', 'expertmanager/index' ); ?></li>-->
    <?php if($raykuUser->getType() == '4'): ?>
    <li><?php echo link_to( 'Admin', 'http://' . RaykuCommon::getCurrentHttpDomain() . '/admin.php' ); ?></li>
    <?php endif; ?>
    <?php endif;?>
  </ul>
  <div class="search"><?php echo form_tag('search/index', array('method' => 'post','id'=>'search-form')) ?>
    <fieldset>
      <input type="text" name="criteria" class="text-box" />
      <input src="/images/btn-search.png"  type="image" class="image-button" onClick="javascript:form.submit();" />
    </fieldset>
    </form>
  </div>
  <div class="latest" id="latestusers">
    <?php include_partial('register/topNavNewUser') ?>
  </div>
  <script type="text/javascript">

new Ajax.PeriodicalUpdater('latestusers', '<?php echo url_for('/register/latestUserHeader');?>', {
method: 'post', frequency:10, decay:2
});


</script>

</div>
<?php

if(($_SERVER['REDIRECT_URL'] != "/login/loginCheck") &&  ($_SERVER['REDIRECT_URL'] != "/logout") && ($_SERVER['REDIRECT_URL'] != "/register") && ($_SERVER['REDIRECT_URL'] != "/start") && ($_SERVER['REDIRECT_URL'] != "/dashboard/beforeclose") ):
?>
<script language="javascript">

function testRedirect() {
setTimeout('checkForRedirect()', 20000);
}

function checkForRedirect() {

redirect = getCookie("redirection");
forumsub = getCookie("forumsub");

	if(redirect != '' && redirect != null ) {
			if (window.XMLHttpRequest)
			  {// code for IE7+, Firefox, Chrome, Opera, Safari
			  xmlhttp=new XMLHttpRequest();
			  }
			else
			  {// code for IE6, IE5
			  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			  }

			xmlhttp.onreadystatechange=function()
			  {
			  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			    {

			   	if(xmlhttp.responseText != '')
				{
							var result = xmlhttp.responseText.split("<");							
								if(result[0] == "redirect") {

									document.location = "http://www.rayku.com/forum/newthread/"+forumsub;

								} 
				}
			    }
			 }

			xmlhttp.open("POST","http://www.rayku.com/register/redirect", true);
			xmlhttp.send();

	}
setTimeout('checkForRedirect()', 30000);

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


</script>
<?php 
endif;
?>
<?php

if(($_SERVER['REDIRECT_URL'] != "/login/loginCheck") &&  ($_SERVER['REDIRECT_URL'] != "/logout") && ($_SERVER['REDIRECT_URL'] != "/register") && ($_SERVER['REDIRECT_URL'] != "/start") && ($_SERVER['REDIRECT_URL'] != "/dashboard/beforeclose")):

?>
<link rel="stylesheet" type="text/css" href="/css/modalbox.css" media="screen" />
<link rel="stylesheet" type="text/css" href="/css/popup.css" media="screen" />
<script type="text/javascript" src="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/js/scriptaculous.js"></script>
<script type="text/javascript" src="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/js/builder.js"></script>
<script type="text/javascript" src="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/js/effects.js"></script>
<script type="text/javascript" src="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/js/unittest.js"></script>
<script type="text/javascript" src="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/js/modalbox.js"></script>
<script type="text/javascript" src="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/js/checkuser.js"></script>
<html>
<head>
</head>

<body onLoad="checkedUser(); testRedirect()">
</body>
</html>
<?php
endif;  
?>
