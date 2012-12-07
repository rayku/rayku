<!-- Le styles -->
<link rel="stylesheet" href="css/font-awesome.css">
<link href="css/style.css" rel="stylesheet">

<script>
function tweet()
{
	u="http://www.rayku.com/register?ref=<?php echo $user_id; ?>";
	desc = document.getElementById("share_desc").value;
	t=document.title;window.open('https://twitter.com/intent/tweet?text='+desc+'','sharer','toolbar=0,status=0,width=626,height=436');
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
<style>
.register-success {
  margin-top:40px;
  padding:15px;
  background:#FEFFEB;
  border-bottom:#CCAD00 2px solid;
  color:#333;
}
.register-success .content{
  width:800px;
  float: left;
}
.register-success .content h2{
  font-size:18px;
}
.register-success .content p{
  font-size:14px;
}
.register-success .skip {
  width:50px;
  float:right;
  font-size:14px;
}
#callout {
   padding:25px 25px 10px 25px;
   background:none;
   border:none;
   border-bottom:2px solid #069;
}
#callout h3 {
  font-size:22px;
}
#callout h3 span {
  font-weight:normal;
  font-size:22px;
}
#callout p{
  font-size:15px;
  color:#777;
  line-height:20px;
  margin-bottom:10px;
}
#progress-diagram span{
  font-size:18px;
  font-weight:normal;
}
.alert {
  background:#DBFFDB;
  font-size:14px;
  padding:10px;
  color:#333;
}
#share-link {
  color:#333;
  margin-bottom:15px;
}
#share-link input[type=text]{
  padding:5px;
  font-size:14px;
  width:230px;
}
#social-invite {
   border-top:2px solid #30BA09;
   padding-top:5px;
   margin-top:20px;
}
#social-invite h3 {
  color:#333;
}
#social-invite textarea{
  padding:8px;
  font-size:14px;
  margin-bottom:10px;
}
#email-invite {
   border-top:2px solid #30BA09;
   padding-top:5px;
   margin-top:20px;
}
#email-invite h3 {
  color:#333;
}
#email-invite textarea{
  padding:8px;
  font-size:14px;
  margin-bottom:10px;
}
.footnote {
  margin:40px 0 60px 0;
  font-size:12px;
  color:#333;
}
</style>
</head>

<body>
<div id="wrapper">
  <?php if($_GET['register'] == "success"): ?>
  <div class="register-success">
    <div class="content"><h2>Your email has been confirmed!</h2></div>
    <div class="skip" align="right"><a href="/dashboard/getstarted">skip</a></div>
    <div style="clear:both"></div>
  </div>
  <?php endif; ?>
  <?php if($_GET['session'] == "complete"): ?>
  <div class="register-success">
    <div class="content" style="width:700px"><h2>Thanks giving us a try!</h2></div>
    <div class="skip" align="right" style="width:150px"><a href="/dashboard">go back to dashboard</a></div>
    <div style="clear:both"></div>
  </div>
  <?php endif; ?>
  <div id="callout">
    <h3>Until Dec. 31st:<span> Get premium tutoring credits for inviting your friends!</span></h3>
    <p>When you have premium tutoring credits (<a href="/rp.html" target="_blank">RP</a>), you get access to premium, on-demand, tutoring help with our highest-rated tutors! Premium tutoring sessions are not capped to 15 minutes per session. For a limited time only, you get <strong>15 minutes</strong><sup>*</sup> of free premium tutoring when you successfully refer a friend, and your <strong>friend gets 10</strong><sup>*</sup>! This is a $10 combined value.</p>
    <div id="progress-diagram" style="margin-top:10px">
      <div class="numberCircle">1</div>
      <span>Invite a Friend</span>
      <div class="numberCircle">2</div>
      <span>Friend Joins Rayku</span>
      <div class="numberCircle"><i class="icon-check"></i></div>
      <span>Both Get Credits!</span> </div>
  </div>
  <?php if($_POST['emails']){ ?>
  <div class="alert" align="center"><strong>Awesome, emails sent!</strong> Please also share on facebook or twitter<?php if($_GET['register'] == "success"): ?>
, or <a href="/dashobard/getstarted">continue here</a><?php endif; ?><?php if($_GET['session'] == "complete"): ?>
, or <a href="/dashobard">continue here</a><?php endif; ?>.</div>
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
  <textarea rows="4" id="share_desc">Free hookup for 10min. of premium online math tutoring from @raykuedu! Thank me later ;) http://rayku.com/register?ref=<?php echo $user_id; ?></textarea>
  <div class="clear"></div>
  <button class="myButton" type="button" onclick="fb_click()"><i class="icon-facebook"></i> share</button>
  <button class="myButton" type="button" onclick="tweet()"><i class="icon-twitter"></i> tweet</button>
  </div>
  <div id="email-invite">
  <h3>Invite by email <span><a href="#">(preview message)</a></span></h3>
	<form method="post" name="frm1" id="frm1">
		<input type="hidden" name="ref" value="<?php echo $user_id; ?>">

		<textarea rows="4" placeholder="Please enter one email per line." name="emails"></textarea>
		<div class="clear"></div>
		<button class="myButton" type="button" onclick='subm()'><i class="icon-envelope-alt"></i> Send Invites</button>
	</form>
</div>
</div>
<div style="clear:both"></div>
<div class="footnote">*minutes are approximate and is based on an average of 0.40RP/minute for premium tutoring</div>
</body>
