<?php
session_start();

  $raykuUser = $sf_user->getRaykuUser();
  $stats = $raykuUser->getStatisticsForDashboard();
$id=$raykuUser->getId();
?>
<?php $raykuUser = $sf_user->getRaykuUser(); ?>
<style media="all" type="text/css">
			@import "http://www.rayku.com/styles/global.css";
				.left-bg h3 { font: bold 14px Arial, Helvetica, sans-serif; color: #056a9a; padding:0; }
				.privacy_block_left { float: left; width: 30px; text-align: center; margin-left: -6px; }
				.privacy_block_text { float: right; width: 575px; }
		</style>

		<script type="text/javascript">
		window.onbeforeunload = function () {
			return "This page is very important - please make sure you've read it completely!"}
        </script>

					<a name="start" id="start"></a>
                    <div id="expert-left">
                    <h1><span>1</span>Complete your Profile</h1>
						<div class="step-body">
                        	<p>Customize your profile to reflect who you are. Upload a picture, and give yourself an identity. <a href="http://www.rayku.com/register/step3" target="_blank">Click here</a>.</p></div>
						<div class="step-footer"></div>
						
				    <div style="margin:25px 0 0 15px;"><a href="http://www.rayku.com/dashboard" onclick="popupWin()"><img src="http://www.rayku.com/images/button.png" alt="" /></a></div> </div>
					<div id="expert-main"><img src="http://www.rayku.com/images/expert-img.png" />
      <div style="padding:0 10px">
						<h2>How to Get Started Immediately</h2>
<p style="color:#333;padding-left:10px;font-size:14px;">Using Rayku is simple. You are starting off with <strong><?php $logedUserId = $_SESSION['symfony/user/sfUser/attributes']['symfony/user/sfUser/attributes']['user_id'];

		$query = mysql_query("select * from user where id=".$logedUserId." ") or die(mysql_error());
		$detailPoints = mysql_fetch_assoc($query);
		echo $detailPoints['points']; ?>RP</strong>. With Rayku Points (RP), you can get one-to-one tutoring with our database of experts.<br />
  <br />
  Get RP by answering questions, <a href="http://www.rayku.com/register/invitation" target="_blank">inviting your friends</a>, or <a href="http://www.rayku.com/shop/paypal">buying some</a>. With enough RP, you can spend them at the <a href="http://www.rayku.com/shop" target="_blank">Rayku Shop</a> for <strong>ipods, UofT shirts, or even cash.</strong><br />
  <br />
  That's it, you're ready to go!   
</p>
<p style="margin-top:25px"><a href="http://www.rayku.com/dashboard" style="color:#060;font-size:18px;text-decoration:underline;">Click Here to Start Using Rayku Now</a></p>
      </div>
					</div><?php $_SESSION['logid']=$logedUserId;?>
                    
					<br class="clear-both" />

