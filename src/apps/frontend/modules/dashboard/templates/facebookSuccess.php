<link rel="stylesheet" type="text/css" href="/styles/donny.css">
<script type="text/javascript" src="http://www.rayku.com/js/jquery-1.4.2.min.js"></script>

<div class='body-main'>
  <div id="what-is">
    <div style="width:30px;float:left;"> <img height="25" width="42" alt="" src="<?php echo image_path('green_arrow.jpg', false); ?>"/> </div>
    <p style="font-size:16px;color:rgb(28, 81, 124);font-weight:bold;margin-left:45px;">Get notifications via Facebook Chat</p>
  </div>

  <?php if($userFb) { ?>
  <div class="box">
    <div class="top"></div>
    <div class="content">
      <div class="entry">
        <div class="spacer"></div>
        <?php  if(@$_SESSION['adduser'] == 1) { ?>
            <div style="border-top:2px solid #900;padding:12px;color:#333;background:#FFF0F0;font-size:14px;line-height:18px;margin-bottom:20px;">Your friend request to 'raykubot' has just been sent! We will automatically accept it in a few moments, and you will start getting notifications through Facebook.</div>
            <?php unset($_SESSION['adduser']); ?>
        <?php } ?>

        <div style="border-top:2px solid #D0CA82;padding:12px;color:#666;background:#FFFECC;font-size:14px;line-height:18px;margin-bottom:20px;"><strong>This does not currently support mobile</strong> - if you are using Facebook Chat with your mobile device, please do not install this. Download the software instead. Thanks!</div>

        <div style="font-size:14px;color:#666;line-height:20px;padding-bottom:20px;margin-bottom:10px;border-bottom:1px solid #F4F4F4"><strong>Get question notifications in real time.</strong> Connect with your instant messenger account and we will notify you with questions from students when your IM status is 'online', and never when you are 'busy' or 'offline'. <br /><br />
            1. Enter your <a href="http://facebook.com/username" target="_blank">Facebook username</a> below<br />
            2. Accept to add 'raykubot' to your friends list<br />
            3. You're done!
        </div>
        <p class="cn-pricepermin" style="color:#333;font-weight:normal">Your connected Facebook account username is <?php echo "<b>".$userFb->getFbUsername()."</b>"; ?>.</p>
      </div>
    </div>
    <div class="bottom"></div>
    <div class="spacer"></div>
  </div>
    <div class="box">
      <div class="top"></div>
      <div class="content">
        <div class="entry">
      <div class="ttle" style="font-size:18px">Change Facebook Account:</div>
      <div class="spacer"></div>
      <form name="facebook" action="/dashboard/facebook" method="post">

	<input type="hidden" name="_hidden_facebook" id="_hidden_facebook" value="1" />

         <input type="hidden" name="_hidden_fb_name" id="_hidden_fb_name" value="<?php echo $userFb->getFbUsername(); ?>" />

        <input type="text" value="raykubot" id="fbname" name="fbname" onblur="if(this.value=='') this.value='raykubot';" onfocus="if(this.value=='raykubot') this.value='';" style="font-size:14px;border:1px solid #999;padding:5px 7px;background:none;float:left;margin-right:10px;">
          </div>
          <input type="submit"  id="save" name="commit" value="Add Me!" onClick = "return validation();" style="font-size:14px;padding:4px" >
                     <div class="text" id="text" style="display:none;line-height:16px"></div>
          <div class="spacer"></div>
      </form>
      </div>
      <div class="bottom"></div>
      <div class="spacer"></div>
    </div>
  <?php } else { ?>
  <div class="box">
    <div class="top"></div>
    <div class="content">
      <div class="entry">
       <div style="border-top:2px solid #D0CA82;padding:12px;color:#666;background:#FFFECC;font-size:14px;line-height:18px;margin-bottom:20px;"><strong>This does not currently support mobile</strong> - if you are using Facebook Chat with your mobile device, please do not install this. Download the software instead. Thanks!</div>
       
      <div style="font-size:14px;color:#666;line-height:20px;padding-bottom:20px;margin-bottom:10px;border-bottom:1px solid #F4F4F4"><strong>Get question notifications in real time.</strong> Connect with your instant messenger account and we will notify you with questions from students when your IM status is 'online', and never when you are 'busy' or 'offline'. <br />
        <br />
1. Enter your <a href="http://facebook.com/username" target="_blank">Facebook username</a> below<br />
2. Accept to add 'raykubot' to your friends list<br />
3. You're done!</div>
      <div class="ttle" style="font-size:18px">Connect Facebook account with your facebook username:</div>
      <div class="spacer"></div>
      <form name="facebook" action="/dashboard/facebook" method="post">

	<input type="hidden" name="_hidden_facebook" id="_hidden_facebook" value="1" />
        <input type="text" value="raykubot" id="fbname" name="fbname" onblur="if(this.value=='') this.value='raykubot';" onfocus="if(this.value=='raykubot') this.value='';" style="font-size:14px;border:1px solid #999;padding:5px 7px;background:none;float:left;margin-right:10px;">
          </div>
          <input type="submit"  id="save" name="commit" value="Add Me!" onClick = "return validation();" style="font-size:14px;padding:4px" >
                     <div class="text" id="text" style="display:none;line-height:16px"></div>
          <div class="spacer"></div>
      </form>
      
    </div>
    <div class="bottom"></div>
    <div class="spacer"></div>
  </div>
  <?php } ?>
</div>
<script type='text/javascript'>

function showdiv() {

	document.getElementById('show').style.display = "block";


}

function validation() {


	var fb_username = document.getElementById("fbname").value;

         var x_fb_username = document.getElementById("_hidden_fb_name").value;

		if((fb_username =='' && fb_username == null) || (fb_username == 'raykubot'))
		{

			document.getElementById('text').style.display = "block";
			document.getElementById('text').innerHTML = "<font color='#FF0000'>This field can not be empty.</font>";
			document.getElementById('fbname').focus();

			return false;
		}

		if((x_fb_username != '' && x_fb_username != null) && (fb_username == x_fb_username))
		{

			document.getElementById('text').style.display = "block";
			document.getElementById('text').innerHTML = "<font color='#FF0000'>Provided Username And Used Existing FB Username are Same!!!</font>";
			document.getElementById('fbname').focus();

			return false;

		}	
return true;
		
}

</script> 
<style>
.icon-list 
{
	list-style: none;
	padding: 0;
	background: #d2e6f6;
}
.icon-list li a
{
	display: block;
	float: left;
	width: 74px;
	height: 73px;
	margin-right:15px;
	text-indent: -5000px;
}
.icon-list li a.windows { background: url('/images/tutorshelp/icon-windows.jpg') center center no-repeat;}
.icon-list li a.windows:hover { background: url('/images/tutorshelp/icon-windows-hover.jpg') center center no-repeat;}		
.icon-list li a.mac { background: url('/images/tutorshelp/icon-mac.jpg') center center no-repeat;}
.icon-list li a.mac:hover { background: url('/images/tutorshelp/icon-mac-hover.jpg') center center no-repeat;}
</style>
<div class="body-side">
  <div class="box">
    <div class="top" style="margin-top:43px;"></div>
    <div class="content" style="position:relative; _top:-3px; _bottom:-3px;">
      <div class="title" style="margin-top:0px; font-size:16px">Download notification software</div>
      <div class="text">Get our spyware-free notification software and you'll be open for business whenever your computer is connected to the Internet.<br />
        <br />
        <ul class="icon-list">
          <li><a href="http://notification-bot.rayku.com/download/rayku.exe" class="icon windows">Windows Software</a></li>
          <li><a href="http://notification-bot.rayku.com/download/rayku.dmg" class="icon mac">MacOS Software</a></li>
        </ul>
        <div style="clear:both"></div>
      </div>
    </div>
    <div class="bottom"></div>
  </div>
</div>
