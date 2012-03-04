<?php
session_start();
include "config.php";
$connection = RaykuCommon::getDatabaseConnection();

  $raykuUser = $sf_user->getRaykuUser();
  $stats = $raykuUser->getStatisticsForDashboard();
$id=$raykuUser->getId();
$_SESSION['tbid123']=$id;
?>
<?php $raykuUser = $sf_user->getRaykuUser(); ?>
<style media="all" type="text/css">
			@import "http://www.rayku.com/styles/global.css";
				.left-bg h3 { font: bold 14px Arial, Helvetica, sans-serif; color: #056a9a; padding:0; }
				.privacy_block_left { float: left; width: 30px; text-align: center; margin-left: -6px; }
				.privacy_block_text { float: right; width: 575px; }
		</style>
        <!--
		<script type="text/javascript">
		window.onbeforeunload = function () {
			return "This page is very important - please make sure you've read it completely!"}
        </script> -->
<div id="fb-root"></div>
        <script>
            window.fbAsyncInit = function() {
                FB.init({appId: '<?php echo $apik;?>', status: true, cookie: true, xfbml: true});
			 FB.Event.subscribe('auth.login', function(response) {
        window.location="<?php echo $process_url;?>";})
            };
            (function() {
                var e = document.createElement('script'); e.async = true;
                e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
                document.getElementById('fb-root').appendChild(e);
            }());
			

        </script>

					<a name="start" id="start"></a>
                    <div id="expert-left">
                    <h1><span>1</span> <?php echo $_SESSION['tbid123'];?> Complete your Profile <?php echo $id;?></h1>
						<div class="step-body">
                        	<p style="margin-top:25px"> <fb:login-button v="2" size="large" length="long" perms="status_update,publish_stream,user_birthday,user_hometown,user_about_me,user_activities,user_interests,user_location,user_relationship_details">Connect with Facebook</fb:login-button></p>
							<p>Customize your profile to reflect who you are. Upload a picture, and give yourself an identity. <a href="http://www.rayku.com/register/step3" target="_blank">Click here</a>.</p></div>
						<div class="step-footer"></div>
						
				    <div style="margin:25px 0 0 15px;"><a href="http://www.rayku.com/dashboard" onclick="popupWin()"><img src="http://www.rayku.com/images/button.png" alt="" /></a></div> </div>
					<div id="expert-main"><img src="http://www.rayku.com/images/expert-img.png" />
      <div style="padding:0 10px">
						<h2>How to Get Started Immediately</h2>
<p style="color:#333;padding-left:10px;font-size:14px;">Using Rayku is simple. You are starting off with <?php $logedUserId = $_SESSION['symfony/user/sfUser/attributes']['symfony/user/sfUser/attributes']['user_id'];

		$query = mysql_query("select * from user where id=".$logedUserId." ", $connection) or die(mysql_error());
		$detailPoints = mysql_fetch_assoc($query);
		echo $detailPoints['points']; ?>RP. With Rayku Points (RP), you can get one-to-one tutoring with our database of experts.<br />
  <br />
  You can earn additional RP by <em>inviting your friends</em> to Rayku, or <em>helping other users</em> when you are alerted with a question.
  <br />
  <br />
  Once you have allocated enough RP, you can spend them at the Rayku Shop for <strong>ipods, UofT T-shirts, or even cash money.</strong><br />
  <br />
  That's it, you're ready to go!   
</p>
<p style="margin-top:25px"><a href="http://www.rayku.com/dashboard" style="color:#060;font-size:18px;text-decoration:underline;">Click Here to Start Using Rayku Now</a></p>
      </div>
					</div><?php $_SESSION['logid']=$logedUserId;?>
                    
					<br class="clear-both" />

