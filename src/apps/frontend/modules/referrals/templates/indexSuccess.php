<?php
session_start();
$user_id = $_SESSION['symfony/user/sfUser/attributes']['symfony/user/sfUser/attributes']['user_id'];

if(!$user_id)
	die("Please login!");

?><!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<title>Rayku.com Referrals</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Le styles -->
<link href="css/bootstrap.css" rel="stylesheet">
<link rel="stylesheet" href="css/font-awesome.css">
<link href="css/bootstrap-responsive.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">

<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->


<script>

function tweet()
{
	u="http://www.rayku.com/register?ref=<?php echo $user_id; ?>";
	desc = document.getElementById("share_desc").value;
	t=document.title;window.open('https://twitter.com/intent/tweet?url='+u+'&text='+desc+'','sharer','toolbar=0,status=0,width=626,height=436');
	return false;

}

function fb_click()
{
	u="http://www.rayku.com/register?ref=<?php echo $user_id; ?>";
	desc = document.getElementById("share_desc").value;
	t=document.title;window.open('https://www.facebook.com/dialog/feed?%20app_id=458358780877780&%20link='+u+'&%20name2=Name&%20caption2=Caption%20here&%20description='+desc+'&%20redirect_uri=http://mighty-lowlands-6381.herokuapp.com/','sharer','toolbar=0,status=0,width=626,height=436');
	return false;

}

function copy()
{

document.getElementById('ref_url').focus();
document.getElementById('ref_url').select();
}

function subm()
{
document.getElementById('frm1').submit();
}
</script>

</head>

<body>
<div id="wrapper">
  <div id="callout">
    <h3>Get free tutoring credits for inviting your friends!</h3>
    <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas tristique vulputate arcu, non interdum leo pretium at. Sed et consequat lectus. Vestibulum gravida ornare pharetra.</p>
    <div id="progress-diagram">
      <div class="numberCircle">1</div>
      <span>Invite a Friend</span>
      <div class="numberCircle">2</div>
      <span>Friend Joins Rayku</span>
      <div class="numberCircle"><i class="icon-check"></i></div>
      <span>Both Get Minutes!</span> </div>
  </div>
  <?php if($_POST['emails']){ ?>
  <div class="alert" align="center"><strong>Awesome!</strong> Emails sent.</div>
 <?php } ?>
  <div id="share-link">
    <form>
      <span>Use this unique link to share with friends:</span>
      <input type="text" value="http://rayku.com/register?ref=<?php echo $user_id; ?>" size="60" id="ref_url">
      <button class="myButton" type="button" onclick="copy()"><i class="icon-link"></i> Copy link</button>
    </form>
  </div>
  <div id="social-invite">
  <h3>Invite friends on Twitter / Facebook</h3>
  <textarea rows="4" id="share_desc">Free online tutoring with @rayku ! Get it here: http://www.rayku.com/register?ref=<?php echo $user_id; ?></textarea>
  <div class="clear"></div>
  <button class="myButton" type="button" onclick="fb_click()"><i class="icon-facebook"></i> Share on Facebook</button>
  <button class="myButton" type="button" onclick="tweet()"><i class="icon-twitter"></i> Tweet to Twitter</button>
  </div>
  <div id="email-invite">
  <h3>Invite by email <span><a href="#">(preview)</a></span></h3>
	<form method="post" name="frm1" id="frm1">
		<input type="hidden" name="ref" value="<?php echo $user_id; ?>">

		<textarea rows="4" placeholder="Please enter one email per line." name="emails"></textarea>
		<div class="clear"></div>
		<button class="myButton" type="button" onclick='subm()'><i class="icon-envelope-alt"></i> Send Invites</button>
	</form>
</div>
</div>

<!-- Le javascript
	================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>