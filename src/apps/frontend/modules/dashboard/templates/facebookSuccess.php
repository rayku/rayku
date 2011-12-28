<link rel="stylesheet" type="text/css" href="/styles/donny.css">
<script type="text/javascript" src="http://www.rayku.com/js/jquery-1.4.2.min.js"></script>

<div class='body-main'>
  <div id="what-is">
    <div style="width:30px;float:left;"> <img height="25" width="42" alt="" src="/images/green_arrow.jpg"/> </div>
    <p style="font-size:16px;color:rgb(28, 81, 124);font-weight:bold;margin-left:45px;">Sync with IM</p>
  </div>

  <?php if($record == 1): ?>
  <div class="box">
    <div class="top"></div>
    <div class="content">
      <div class="entry">
        <div class="spacer"></div>
         <?php  if($_SESSION['adduser'] == 1) : ?>

        <div style="border-top:2px solid #900;padding:12px;color:#333;background:#FFF0F0;font-size:14px;line-height:18px;margin-bottom:20px;"> Your Friend Request Has Been Sent To 'raykubot'. Your Friend Request Will be Added with rayku bot quickly and You can get Online Question help Thorugh FB!</div>

  <?php unset($_SESSION['adduser']); ?>
  <?php endif; ?>
  <div style="font-size:14px;color:#666;line-height:20px;padding-bottom:20px;margin-bottom:10px;border-bottom:1px solid #F4F4F4"><strong>Get question notifications in real time.</strong> Connect with your instant messenger account and we will notify you with questions from students when your IM status is 'online', and never when you are 'busy' or 'offline'. <br /><br />
      <strong>Earn RP</strong> while you're not doing anything else productive!<br /><br />
      1. Submit your instant messenger information below.<br />
      2. We will automatically send you an add request from 'Rayku Bot'.<br />
      3. Accept the invitation. You're done!</div>
        <p class="cn-pricepermin" style="color:#333;font-weight:normal">Your connected FB Username account is <?php echo "<b>".$facebook."</b>"; ?>.</p>
      </div>
    </div>
    <div class="bottom"></div>
    <div class="spacer"></div>
  </div>
    <div class="box">
      <div class="top"></div>
      <div class="content">
        <div class="entry">
      <div class="ttle" style="font-size:18px">Change Facebook Username :</div>
      <div class="spacer"></div>
      <form name="facebook" action="/dashboard/facebook" method="post">

	<input type="hidden" name="_hidden_facebook" id="_hidden_facebook" value="1" />

         <input type="hidden" name="_hidden_fb_name" id="_hidden_fb_name" value="<?php echo $facebook; ?>" />

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
  <?php else : ?>
  <div class="box">
    <div class="top"></div>
    <div class="content">
      <div class="entry">
      <div style="font-size:14px;color:#666;line-height:20px;padding-bottom:20px;margin-bottom:10px;border-bottom:1px solid #F4F4F4"><strong>Get question notifications in real time.</strong> Connect with your instant messenger account and we will notify you with questions from students when your IM status is 'online', and never when you are 'busy' or 'offline'. <br /><br />
      <strong>Earn RP</strong> while you're not doing anything else productive!<br /><br />
      1. Submit your instant messenger information below.<br />
      2. We will automatically send you an add request from 'Rayku Bot'.<br />
      3. Accept the invitation. You're done!</div>
      <div class="ttle" style="font-size:18px">Connect Facebook Account With 'FB Username':</div>
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
  <?php endif; ?>
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
<div class="body-side">
  <div class="box">
    <div class="top" style="margin-top:43px;"></div>
    <div class="content" style="position:relative; _top:-3px; _bottom:-3px;">
      <div class="title" style="margin-top:0px; font-size:16px">Don't use IM often?</div>
      <div class="text"><strong><span style="line-height:20px; font-size:14px">Download the software! </span></strong> Get the notification software and you'll be open for business whenever your computer is connected to the Internet.<br /><br />
      <center><img src="../images/windows.png" /></center></div>
    </div>
    <div class="bottom"></div>
  </div>
</div>
