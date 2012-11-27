<?php
session_start();
$user_id = $_SESSION['symfony/user/sfUser/attributes']['symfony/user/sfUser/attributes']['user_id'];

if($user_id)
{

	echo '
<br/>
Use this link with friends: <input type="text" id="global-referral-link" class="textinput" value="http://www.rayku.com/register?ref='.$user_id.'" size="100"><br/>
';

	echo '
<hr/>
<br/>
<h2>Invite Friends from FaceBook or Twitter</h2>
<textarea rows=4 cols=60 id="share_desc">Free online tutoring with @rayku ! Get it here: http://www.rayku.com/register?ref='.$user_id.'</textarea>
<br/>
<!-- <a href="https://twitter.com/share" class="twitter-share-button" data-url="http://www.rayku.com/register?ref='.$user_id.'" data-via="rayku" data-lang="en" >Tweet</a> -->
<button text="Tweet" onclick="tweet()">Tweet</button>

<script>

function tweet()
{
	u="http://www.rayku.com/register?ref='.$user_id.'";
	desc = document.getElementById("share_desc").value;
	t=document.title;window.open(\'https://twitter.com/intent/tweet?url=\'+u+\'&text=\'+desc+\'\',\'sharer\',\'toolbar=0,status=0,width=626,height=436\');return false;

}

function fbs_click() {u="http://www.rayku.com/register?ref='.$user_id.'";t=document.title;window.open(\'http://www.facebook.com/sharer.php?u=\'+encodeURIComponent(u)+\'&t=\'+encodeURIComponent(t),\'sharer\',\'toolbar=0,status=0,width=626,height=436\');return false;}

function fb_click()
{
	u="http://www.rayku.com/register?ref='.$user_id.'";
	desc = document.getElementById("share_desc").value;
	t=document.title;window.open(\'https://www.facebook.com/dialog/feed?%20app_id=458358780877780&%20link=\'+u+\'&%20name2=Name&%20caption2=Caption%20here&%20description=\'+desc+\'&%20redirect_uri=http://mighty-lowlands-6381.herokuapp.com/\',\'sharer\',\'toolbar=0,status=0,width=626,height=436\');return false;

}
</script>

<style> html .fb_share_button { display: -moz-inline-block; display:inline-block; padding:1px 20px 0 5px; height:15px; border:1px solid #d8dfea; background:url(http://static.ak.facebook.com/images/share/facebook_share_icon.gif?6:26981) no-repeat top right; } html .fb_share_button:hover { color:#fff; border-color:#295582; background:#3b5998 url(http://static.ak.facebook.com/images/share/facebook_share_icon.gif?6:26981) no-repeat top right; text-decoration:none; } </style> <a rel="nofollow" href="http://www.facebook.com/share.php?u=http://www.rayku.com/register?ref='.$user_id.'" class="fb_share_button" onclick="return fb_click()" target="_blank" style="text-decoration:none;">Share</a>

';


?>

<hr/>
<br/>
or invite email addresses
<form method="post">
<input type="hidden" name="ref" value="<?php echo $user_id; ?>">
<textarea rows=4 cols=60 name="emails" id="emails" title="Type a list of invitee email addresses." placeholder="Type a list of invitee email addresses."></textarea>
<br/><input type="submit" value="Send Invites">
</form>
<?php
}else{
	echo "Not logged in!";
}