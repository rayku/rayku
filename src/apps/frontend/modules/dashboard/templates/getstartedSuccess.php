<?php
session_start();
$connection = RaykuCommon::getDatabaseConnection();

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

					<a name="start" id="start"></a>
                    <div id="expert-left">
                    <h1><span>1</span>Complete your Profile</h1>
						<div class="step-body">
                        	<p>Customize your profile to reflect who you are. Upload a picture, and give yourself an identity. <a href="/profile/<?php echo $raykuUser->getUsername() ?>/edit" target="_blank">Click here</a>.</p></div>
						<div class="step-footer"></div>
						
				     </div>
					<div id="expert-main"><img src="http://www.rayku.com/images/expert-img.png" />
      <div style="padding:0 10px">
						<h2>How to Get Started Immediately</h2>
<p style="color:#333;padding-left:10px;font-size:14px;">Using Rayku is simple. You are starting off with <strong><?php $logedUserId = $_SESSION['symfony/user/sfUser/attributes']['symfony/user/sfUser/attributes']['user_id'];
		$query = mysql_query("select * from user where id=".$logedUserId." ", $connection) or die(mysql_error());
		$detailPoints = mysql_fetch_assoc($query);
		echo $detailPoints['points']; ?>RP</strong>. With Rayku Points (RP), you can get <em>premium</em> one-to-one tutoring with our database of experts. <a href="http://www.rayku.com/shop/paypal">Purchase some now</a>.<br />
  <br />
  You can get started immediately! Go ahead and ask your first question.
</p>
<p style="margin-top:25px"><a href="http://www.rayku.com/dashboard" style="color:#060;font-size:18px;text-decoration:underline;">Click here for your dashboard</a></p>
      </div>
					</div><?php $_SESSION['logid']=$logedUserId;?>
                    
					<br class="clear-both" />

