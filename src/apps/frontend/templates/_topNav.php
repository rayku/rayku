<?php
  use_helper('MyAvatar', 'Javascript');
  $raykuUser = $sf_user->getRaykuUser();
  $logedUserId = $_SESSION['symfony/user/sfUser/attributes']['symfony/user/sfUser/attributes']['user_id'];

    ////////checking user is authirzed to the site
	$num_of_row=0;
  $connection = RaykuCommon::getDatabaseConnection();
  $IP=$_SERVER['REMOTE_ADDR'];

	$_query = mysql_query("select * from thread  where user_ip='".$IP."' and banned=1", $connection);
	$num_of_row= mysql_num_rows($_query);
	if($num_of_row>0)
	{
		echo "
        <script type='text/javascript'>
			document.location='http://" . RaykuCommon::getCurrentHttpDomain() . "/error';
		</script>";
	}

	$_query = mysql_query("select * from banned_ips  where ip like '%".$IP."%' ", $connection);
	$num_of_row= mysql_num_rows($_query);
	if($num_of_row>0)
	{
		echo "
        <script type='text/javascript'>
			document.location='http://" . RaykuCommon::getCurrentHttpDomain() . "/error';
		</script>";

	}

	if($logedUserId<>'')
	{
			$user_id=$raykuUser->getId();
			$num_of_row=0;
			$_query = mysql_query("select * from thread  where 	poster_id='".$user_id."' and banned=1", $connection);
			$num_of_row= mysql_num_rows($_query);
			if($num_of_row>0)
			{
				echo "
				<script type='text/javascript'>
                    document.location='http://" . RaykuCommon::getCurrentHttpDomain() . "/error';
				</script>";

			}
	}
//////////////////////////

  if(!$sf_user->isAuthenticated())
  {
?>
<div id="top-nav">
  <!-- For the person who will use this code. Check the TITLES of the <a> tags! They correspond in the CSS file aswell! -->
  <div id="top-nav-center">
    <ul class="top-menu">
      <li><a href="http://www.rayku.com/start" title="Rayku">Rayku</a></li>
    </ul>
    <!--ul.top-menu-->
    <div id="user-box" align="left"> <a href="#whiteboard" title="Whiteboard" target="_blank" class="tt-whiteboard">Whiteboard</a> </div>
    <!--div#user-box-->
    <div class="clear"></div>
  </div>
  <!--div#top-nav-center-->
</div>
</div>
<!--div#top-nav-->
<?php } else { ?>


<?php
$queryPoints = mysql_query("select * from user where id=".$raykuUser->getId(), $connection) or die(mysql_error());
$detailPoints = mysql_fetch_assoc($queryPoints);
?>

<?php $email=$raykuUser->getEmail();  ?>
<div id="top-nav">
	<!-- For the person who will use this code. Check the TITLES of the <a> tags! They correspond in the CSS file aswell! -->
	<div id="top-nav-center">
		<ul class="top-menu">
			<li><?php echo link_to( 'Rayku', RaykuCommon::getCurrentHttpDomain() . '/', array('title'=>'Rayku') ); ?></li>
			<li><?php echo link_to( 'Ask Question', RaykuCommon::getCurrentHttpDomain() . '/dashboard', array('title'=>'Ask Question','class'=>'tt-questions') ); ?></li>
			<li><?php echo link_to( 'Q&A Boards', 'forum/index', array('title'=>'Q&A Boards','class'=>'tt-boards') ); ?></li>

            <?php if($raykuUser->getNrOfNewMessages() >= 1) : ?>
            <li><a href="http://<?php echo RaykuCommon::getCurrentHttpDomain(); ?>/message/inbox" title="Messages" class="tt-messages"><span><?php echo $raykuUser->getNrOfNewMessages(); ?></span>Messages</a></li>
            <?php else:  ?>
            <li><a href="http://<?php echo RaykuCommon::getCurrentHttpDomain(); ?>/message/inbox" title="Messages" class="tt-messages">Messages</a></li>
			<?php endif; ?>

			<li><?php echo link_to( 'Tutors', 'tutors/index', array('title'=>'Tutors','class'=>'tt-tutors') ); ?></li>
			<li><?php echo link_to( 'Rayku Points', 'shop/index', array('title'=>'Rayku Points','class'=>'tt-points') ); ?></li>
		</ul>
		<!--ul.top-menu-->

		<div id="user-box" align="left">
			<a href="http://whiteboard.rayku.com" title="Test Whiteboard" target="_blank" class="tt-whiteboard">Test Whiteboard</a>
			<ul>
                <li class="main-row">
					<?php //echo avatar_tag_for_user($raykuUser, 2) ; ?>

					<!--<img src="http://rayku.com/images/topnav/mini-profile.jpg" alt="<?php echo $raykuUser->getName(); ?>" />-->

<?php $_image = avatar_tag_for_user($raykuUser); $_image = str_replace("img", "img width='25'", $_image);?> <?php echo $_image; ?>

					<?php echo $raykuUser->getName(); ?>
					<ul>
						<li class="profile"><a href="<? echo 'http://'. RaykuCommon::getCurrentHttpDomain() .'/tutor/'.$raykuUser->getUsername(); ?>" title="View Profile">View Profile</a></li>
						<li class="edit"><a href="<? echo 'http://'. RaykuCommon::getCurrentHttpDomain() .'/profile/'.$raykuUser->getUsername().'/edit'; ?>" title="Edit Profile">Edit Profile</a></li>
                        <li class="signout"><a href="http://<?php echo RaykuCommon::getCurrentHttpDomain(); ?>/logout" title="Sign-Out" style="border-bottom: none;">Log Out</a></li>
					</ul>
				</li>
			</ul>
		</div>
		<!--div#user-box-->

		<div class="clear"></div>
	</div>
	<!--div#top-nav-center-->
</div>
<!--div#top-nav-->

<script type="text/javascript">
  var rayku_jq = jQuery.noConflict();
  rayku_jq(document).ready(function()
  {
       rayku_jq("li.main-row").hover(
            function() { rayku_jq('ul', this).fadeIn("fast");
           },
           function()  { rayku_jq('ul', this).fadeOut("fast");
       });
       rayku_jq('a.tt-questions,a.tt-boards,a.tt-messages,a.tt-tutors,a.tt-points,a.tt-whiteboard').notifier();
  });
 </script>
 <div id="tt-questions-tooltip" class="tooltip">
	Ask a Question
</div>
<div id="tt-boards-tooltip" class="tooltip html-able">
	Q&A Boards
</div>
<div id="tt-messages-tooltip" class="tooltip html-able">
	You have <strong><?php echo $raykuUser->getNrOfNewMessages(); ?></strong> new messages
</div>
<div id="tt-tutors-tooltip" class="tooltip html-able">
	Tutors List
</div>
<div id="tt-points-tooltip" class="tooltip html-able">
	<strong><span style="color:#69D171"><?php echo $detailPoints['points'];?></span>RP</strong> (<a rel="popup standard 600 435 noicon" href="http://rayku.com/rp.html" title="What are RP?" style="color:#FFF">?</a>)
    </div>
<div id="tt-whiteboard-tooltip" class="tooltip html-able">
	Practice Whiteboard
</div>

  <?php } ?>
  <ul class="main-nav">
    <li class="home">
    </li>
    <?php if($sf_user->isAuthenticated()): ?>
    <?php if($raykuUser->getType() == '4'): ?>
    <li><?php echo link_to( 'Admin', 'http://' . RaykuCommon::getCurrentHttpDomain() . '/admin.php' ); ?></li>
    <?php endif; ?>
    <?php endif;?>
  </ul>


</div>

<?php
if(($_SERVER['REDIRECT_URL'] != "/login/loginCheck") &&  ($_SERVER['REDIRECT_URL'] != "/logout") && ($_SERVER['REDIRECT_URL'] != "/register") && ($_SERVER['REDIRECT_URL'] != "/start") && ($_SERVER['REDIRECT_URL'] != "/dashboard/beforeclose")):
?>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="/css/modalbox.css" media="screen" />
<link rel="stylesheet" type="text/css" href="/css/popup.css" media="screen" />
<script type="text/javascript" src="/js/scriptaculous.js"></script>
<script type="text/javascript" src="/js/builder.js"></script>
<script type="text/javascript" src="/js/effects.js"></script>
<script type="text/javascript" src="/js/unittest.js"></script>
<script type="text/javascript" src="/js/modalbox.js"></script>
<script type="text/javascript" src="/js/checkuser.js"></script>
<script type="text/javascript" src="/js/checkuserstay.js"></script>

<?php if($sf_user->isAuthenticated()) : ?>


	<link rel="stylesheet" type="text/css" href="/styles/popup-window.css" />
	<script type="text/javascript" src="/scripts/popup-window.js"></script>

	<script type="text/javascript" src="/js/question_popup.js"></script>
	<script language="javascript">checkMissedQuestion();</script>


	<input type="hidden" value='1' name="question_hidden" id="question_hidden" />

	<div class="sample_popup"   id="question_popup" style="display: none;">
	<div class="menu_form_header" id="popup_drag" style="background:#E57A72 none;border:2px solid #E57A72;height:25px;">
	<img class="menu_form_exit"   id="popup_exit" src="/styles/form_exit.png" alt="Exit" /></div>

	<div class="menu_form_body" style="background:#FFF;border:2px solid #E57A72; height:100px;padding-top:50px;">
					<font style="font-size:20px;margin:100px;color:red">Oops. You missed a question!</font>
	</div>
	</div>


 <?php endif; ?>

<?php if($_SERVER['REQUEST_URI'] == "/expertmanager/connect") : ?>

	<script type="text/javascript" src="/js/checkedMsgUser.js"></script>

	<script type="text/javascript">
	checkedMsgUser();

	setTimeout('checkForRedirect()', 55000);
	</script>

 <?php endif; ?>


<script type="text/javascript">
checkedUser();
checkUserStay();

function hideDiv() {

document.getElementById("question_popup").style.display = 'none';
return true;

}


function getCookie(c_name)
{

if (document.cookie.length>0)
  {
  c_start=document.cookie.indexOf(c_name + "=");
  if (c_start!=-1)
    {
    c_start=c_start + c_name.length+1;
    c_end=document.cookie.indexOf(";",c_start);
    if (c_end==-1) c_end=document.cookie.length;
    return unescape(document.cookie.substring(c_start,c_end));
    }
  }
return "";
}

function checkForRedirect() {
redirect = getCookie("redirection");
forumsub = getCookie("forumsub");

	if(redirect != '' && redirect != null ) {
		var d = jQuery.noConflict();
		d.ajax({ cache: false,
			type : "POST",
			url: "http://www.rayku.com/register/redirect",
			success : function (data)  {
				var check = data.split("<");
				if(check[0] == "redirect") {
                    document.location = "http://<?php echo RaykuCommon::getCurrentHttpDomain(); ?>/forum/newthread/"+forumsub+"?exp_online=1";
				}
			}
		});
	}
setTimeout('checkForRedirect()', 20000);
}
</script>

<?php
endif;
?>
