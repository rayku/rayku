<link rel="stylesheet" type="text/css" href="/styles/donny.css">
<script type="text/javascript" src="http://www.rayku.com/js/jquery-1.4.2.min.js"></script>
<div class="body-main">

    <div class="box" style="padding-left:144px;">
    <div class="top"></div>
    <div class="content">
      <div class="entry">
        <div class="spacer"></div>
         <?php if($weAreFriendsNow) { ?>

       	<div style="border-top: 2px solid rgb(56, 109, 37);  padding: 12px; background: rgb(201, 242, 201) none repeat scroll 0% 0%; color: rgb(51, 51, 51); -moz-background-clip: border; -moz-background-origin: padding; -moz-background-inline-policy: continuous; font-size: 14px; line-height: 18px; margin-bottom: 20px;">Your friend request to 'raykubot' has just been sent! We will automatically accept it in a few moments, and you will start getting notifications through Facebook.</div>

	<?php } else { ?>

  		 <div style="border-top:2px solid #900;padding:12px;color:#333;background:#FFF0F0;font-size:14px;line-height:18px;margin-bottom:20px;"> Opps! error. Something Wrong Here!!!<br />Maybe RaykuBit was already on your FB friends list ?</div>

	<?php } ?>
<br/><br/>
<?php header("Refresh: 15; url=\"../dashboard/facebook\""); ?>
		<p style="font-size: 16px; color: rgb(28, 81, 124); font-weight: bold; margin-left: 100px;">You will be redirected in 10 seconds...</p>

      </div>
    </div>
    <div class="bottom"></div>
    <div class="spacer"></div>
  </div>

  </div>



