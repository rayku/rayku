<link rel="stylesheet" type="text/css" href="/styles/donny.css"/>

<script type="text/javascript" src="/js/emailvalidation.js"></script>
<script>

//Check all radio/check buttons script- by javascriptkit.com
//Visit JavaScript Kit (http://javascriptkit.com) for script
//Credit must stay intact for use  

function checkall(thestate){
var el_collection = document.forms['form_results'].elements['list[]'];
for (var c=0;c<el_collection.length;c++)
el_collection[c].checked=thestate
} 

function webmail(email) {

	new Ajax.Request('/register/test?email='+email, {asynchronous:true, evalScripts:false, onComplete:function(request, json){
					if (200 == request.status) { 
				 		if(request.readyState==4) { 
				 
							//	alert(request.responseText) ; 
								
 							 	document.getElementById("item_suggestion").style.display = "block";  
								 document.getElementById("item_suggestion").innerHTML =request.responseText ;
							}
						}
					}
				}) ;

}

</script>
<?php use_helper('MyForm', 'Javascript', 'Enum','Validation') ?>



<div class="body-main">
  <div id="what-is">
    <div style="width:30px;float:left">
      <img height="25" width="42" alt="" src="/images/green_arrow.jpg"/>
    </div>
    <p style="font-size:16px;font-weight:bold;margin-left:55px;margin-bottom:20px"><a href="http://www.rayku.com/register/invitation" style="color:rgb(28, 81, 124)">Invite  Friends, Get RP</a> > Email Invite Tool</p>
  </div>

<?php


$cookieName = "stay_".$user->getId(); 

if(!empty($_COOKIE[$cookieName])): 

$cookieName = "stay_".$user->getId();
setCookie($cookieName,'',time()+3600);
$_COOKIE[$cookieName] = '';


echo "<script type='text/javascript'>alert('Your invitation email(s) has been sent out successfully.');</script>";


 endif; ?>

  <div class="left-bg">
    <div class="left-top"></div>
    <div class="send-gift import-email">
      <h3 class="invite-friends">Send Invite Coupon Codes to Friends</h3>
      <p style="line-height:20px; font-size:14px">        Enter the email address and password of your primary email account, and our system will automatically fetch your contacts.</p>
      <h3 class="we-support">Some of the email clients we support:</h3>
      <img class="supported-emails" src="/images/supported-emails.png" alt="" />
      <form id="emailform" name='emailform' onsubmit="if(emailCheck($('input-email').value))new Ajax.Updater('target', '/register/getcontact?userid=<?php echo $user->getId()?>', {asynchronous:true, evalScripts:true, onComplete:function(request, json){}, onLoading:function(request, json){}, onSuccess:function(request, json){}, parameters:Form.serialize(this)}); return false;" action="/register/getcontact?userid=<?php echo $user->getId()?>" method="post" autocomplete="off">
        <h3 style="margin-bottom: 5px;">Email address (eg. youremail@gmail.com):</h3>
        <?php //echo input_tag('',array('class'=>'field','id'=>'input-email')); ?>
        <input type="text" value="" id="input-email" name="username" class="field" onchange="return webmail(this.value);"/>
        <label class="email-label" for="input-email">We will <strong>NOT</strong> record your email to a mailing list or send you any unwanted mail.</label>
        <h3 style="margin-bottom: 5px; padding-top: 10px; clear: both;">Password:</h3>
        <?php //echo input_password_tag('password',array('class'=>'field')); ?>
        <input class="field" name="password" type="password" id="input-password" value="" />
        <?php echo form_error('password'); ?>
        <label class="pass-label" for="input-password">For your safety (and ours) your password will <strong>NEVER</strong> be recorded.</label>
        <div id="item_suggestion" style="display:none;"> </div>
        <?php //echo enum_values_select_tag(get_class($user), 'RelationshipStatuse', $user->getRelationshipStatus()); ?>
        <?php //echo submit_tag('Invite My Friends',array('style'=>"clear: both; float: right; margin-top: 14px;")); ?>
        <p style="clear:both">
          <input name="submit" type="submit" value="List my Email Contacts" alt="List my Contacts" style="margin-top:20px; height:40px; font:Arial, Helvetica, sans-serif; font-size:16px; font-weight:bold; float:left" onClick="window.location='#contacts'"/>
        </p>
        <input name="skip" type="button" onClick="javascript:window.location='http://www.rayku.com/register/invitation';" value="Go to 'Get RP' Page" style="height:40px; font:Arial, Helvetica, sans-serif; font-size:16px; float:right" />
      </form>
    </div>
    <div class="left-bottom"></div>
  </div>
  </div>
  
<div class="body-side" style="margin-top:40px">
  <div class="box">
    <div class="top"></div>
    <div class="content" style="position:relative; _top:-3px; _bottom:-3px;">
      <div class="title" style="margin-top:0px; font-size:16px">Earn RP For Inviting</div>
      <div class="text"><span style="line-height:20px; font-size:14px">When you invite your friends to join Rayku, you earn <strong>0.50RP (plus bonuses)</strong> for each person who registers with your coupon code!<br />
        <br />
      Your friend gets <strong>11.00RP</strong> by using your coupon code.</span></div>
    </div>
    <div class="bottom"></div>
  </div>
</div>

<br class="clear-both" />
<a name="contacts" id="contacts"></a>
<div id="target" style="position:relative;float:left;padding:20px;width:100%; font-size:14px; margin-bottom:100px"> </div>
