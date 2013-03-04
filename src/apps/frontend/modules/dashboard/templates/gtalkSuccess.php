<link rel="stylesheet" type="text/css" href="/styles/donny.css">
<script type="text/javascript" src="<?php echo sfConfig::get('app_rayku_url'); ?>/js/jquery-1.4.2.min.js"></script>

<div class='body-main'>
  <div id="what-is">
    <div style="width:30px;float:left;"> <img height="25" width="42" alt="" src="<?php echo image_path('green_arrow.jpg', false); ?>"/> </div>
    <p style="font-size:16px;color:rgb(28, 81, 124);font-weight:bold;margin-left:45px;">Get notifications via Google Talk</p>
  </div>
  <?php if($record == 1): ?>
  <div class="box">
    <div class="top"></div>
    <div class="content">
      <div class="entry">
        <div class="spacer"></div>
        <?php  if(@$_SESSION['adduser'] == 1) : ?>
        <div style="border-top:2px solid #900;padding:12px;color:#333;background:#FFF0F0;font-size:14px;line-height:18px;margin-bottom:20px;"> Our bot has just sent you a friend request to your google talk account. <strong>Click on the yes button</strong>, and you're all set! If you run into any problems, <a href="mailto:cs@mail.rayku.com">shoot us an email</a>.</div>
        <?php unset($_SESSION['adduser']); ?>
        <?php endif; ?>
        
        <div style="border-top:2px solid #D0CA82;padding:12px;color:#666;background:#FFFECC;font-size:14px;line-height:18px;margin-bottom:20px;"><strong>Note:</strong> This does not support mobile usage of Google Talk on your smart phone</div>
        
        <div style="font-size:14px;color:#666;line-height:20px;padding-bottom:20px;margin-bottom:10px;border-bottom:1px solid #F4F4F4"><strong>Get question notifications in real time via Google Talk.</strong><br />
          <br />
          1. Have <a href="http://google.com/talk/" target="_blank">Google Talk</a> set up<br />
          2. Submit your google talk email below<br />
          <em>(we will automatically send you an add request from 'Rayku Bot')</em><br />
          3. Accept the invitation. You're done!</div>
        <p class="cn-pricepermin" style="color:#333;font-weight:normal">Currently connect as: <?php echo "<b>".$gtalk."</b>"; ?></p>
      </div>
    </div>
    <div class="bottom"></div>
    <div class="spacer"></div>
  </div>
  <div class="box">
    <div class="top"></div>
    <div class="content">
      <div class="entry">
      <div class="ttle" style="font-size:18px">Change connected account:</div>
      <div class="spacer"></div>
      <form name="gtalk" action="/dashboard/gtalkupdate" method="post">
        <input type="text" value="example@gmail.com" id="gtalkname" name="gtalkname" onblur="if(this.value=='') this.value='example@gmail.com';" onfocus="if(this.value=='example@gmail.com') this.value='';" style="font-size:14px;border:1px solid #999;padding:5px 7px;background:none;float:left;margin-right:10px;">
        </div>
        <input type="submit"  id="save" name="commit" value="Change" onClick = "return validation();" style="font-size:14px;padding:4px" >
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
      <div style="border-top:2px solid #D0CA82;padding:12px;color:#666;background:#FFFECC;font-size:14px;line-height:18px;margin-bottom:20px;"><strong>Note:</strong> This does not support mobile usage of Google Talk on your smart phone</div>
      
      <div style="font-size:14px;color:#666;line-height:20px;padding-bottom:20px;margin-bottom:10px;border-bottom:1px solid #F4F4F4"><strong>Get question notifications in real time via Google Talk.</strong><br />
        <br />
1. Have <a href="http://google.com/talk/" target="_blank">Google Talk</a> set up<br />
2. Submit your google talk email below<br />
<em>(we will automatically send you an add request from 'Rayku Bot')</em><br />
3. Accept the invitation. You're done!</div>
      <div class="ttle" style="font-size:18px">Connect Google Talk account:</div>
      <div class="spacer"></div>
      <form name="gtalk" action="/dashboard/gtalkupdate" method="post">
        <input type="text" value="example@gmail.com" id="gtalkname" name="gtalkname" onblur="if(this.value=='') this.value='example@gmail.com';" onfocus="if(this.value=='example@gmail.com') this.value='';" style="font-size:14px;border:1px solid #999;padding:5px 7px;background:none;float:left;margin-right:10px;">
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


	var email = document.getElementById("gtalkname").value;
	var check = email.split("@");

		if(email =='')
		{
			document.getElementById('text').style.display = "block";
			document.getElementById('text').innerHTML = "<font color='#FF0000'>This field can not be empty.</font>";

			document.getElementById('gtalkname').focus();
			return false;
		}	
		if(check.length < 2) {

			email = email+'@gmail.com';
		}
	
		var patt1=new RegExp("^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$");
		if (patt1.test(email)==false)
		{
			document.getElementById('text').style.display = "block";

			document.getElementById('text').innerHTML = "<font color='#FF0000'>*This Google Talk handle is not valid.</font>";
			document.getElementById('gtalkname').focus();
			return false;
		}

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
    <div class="bottom"></div>
  </div>
</div>
