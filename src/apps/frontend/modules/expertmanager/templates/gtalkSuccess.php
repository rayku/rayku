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
        <div class="ttle"></div>
        <div class="spacer"></div>
         <?php  if($_SESSION['adduser'] == 1) : ?>

        <div style="border-top:2px solid #900;padding:12px;color:#333;background:#FFF0F0;font-size:14px;line-height:18px;margin-bottom:20px;"> Our bot has just sent you a friend request to your google talk account. <strong>Click on the yes button</strong>, and you're all set!</div>

  <?php unset($_SESSION['adduser']); ?>
  <?php endif; ?>
        <p class="cn-pricepermin" style="color:#333;font-weight:normal">Your incorporated Google talk account is <?php echo "<b>".$gtalk."</b>"; ?>.</p>
      </div>
    </div>
    <div class="bottom"></div>
    <div class="spacer"></div>
  </div>
    <div class="box">
      <div class="top"></div>
      <div class="content">
        <div class="entry">
      <div class="ttle" style="font-size:18px">Change Google Talk Account:</div>
      <div class="spacer"></div>
        <form name="gtalk" action="/expertmanager/gtalkupdate" method="post">
        <input type="text" value="example@gmail.com" id="gtalkname" name="gtalkname" onblur="if(this.value=='') this.value='example@gmail.com';" onfocus="if(this.value=='example@gmail.com') this.value='';" style="font-size:14px;border:1px solid #999;padding:4px 7px;background:none;float:left;margin-right:10px;">
                  </div>
          <input type="submit"  id="save" name="commit" value="Change" onClick = "return validation();" style="font-size:14px;padding:7px" >
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
      <div class="ttle" style="font-size:18px">Incorporate with Google Talk:</div>
      <div class="spacer"></div>
      <form name="gtalk" action="/expertmanager/gtalkupdate" method="post">
        <input type="text" value="example@gmail.com" id="gtalkname" name="gtalkname" onblur="if(this.value=='') this.value='example@gmail.com';" onfocus="if(this.value=='example@gmail.com') this.value='';" style="font-size:14px;border:1px solid #999;padding:4px 7px;background:none;float:left;margin-right:10px;">
          </div>
          <input type="submit"  id="save" name="commit" value="Add Me!" onClick = "return validation();" style="font-size:14px;padding:7px" >
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