<?php
  use_helper('MyAvatar', 'Javascript');
  $raykuUser = $sf_user->getRaykuUser();

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

  $logedUserId = @$_SESSION['symfony/user/sfUser/attributes']['symfony/user/sfUser/attributes']['user_id'];
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
<style>
#navigation {
	background: url("/images/landing/topnav/navigation-gradient.png") repeat-x scroll 0 0 transparent;
	border-radius: 5px 5px 5px 5px;
	float: right;
	font-family: Tahoma, Geneva, sans-serif;
	font-size: 13px;
	height: 32px;
	line-height: 32px;
	margin-left: 24px;
	margin-top: 7px;
}
#navigation li {
	background: url("/images/landing/topnav/nav-border.png") no-repeat scroll right 6px transparent;
	display: inline-block;
	padding: 0 11px;
}
#navigation li a {
	color:#FFF;
}
#navigation li a:hover {
	text-decoration: underline;
}
#navigation li:last-child {
	background: none repeat scroll 0 0 transparent;
}
</style>

<div id="top-nav">
  <!-- For the person who will use this code. Check the TITLES of the <a> tags! They correspond in the CSS file aswell! -->
  <div id="top-nav-center">
    <ul class="top-menu">
      <li><a href="/start" title="Rayku">Rayku</a></li>
    </ul>
    <!--navigation-->
    <ul id="navigation">
      <li><a href="/login">Login</a></li>
      <li><a href="/register">Register</a></li>
      <li><a href="/tourpage">Tour</a></li>
      <li><a href="/joinus">Tutors</a></li>
    </ul>
    <!--navigation-->
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
      <li><?php echo link_to( 'Rayku', '/', array('title'=>'Rayku') ); ?></li>
      <li><?php echo link_to( 'Ask Question', '/dashboard', array('title'=>'Ask Question','class'=>'tt-questions') ); ?></li>
      <li><?php echo link_to( 'Q&A Boards', '/forum/index', array('title'=>'Q&A Boards','class'=>'tt-boards') ); ?></li>
      <?php if($raykuUser->getNrOfNewMessages() >= 1) : ?>
      <li><a href="/message/inbox" title="Messages" class="tt-messages"><span><?php echo $raykuUser->getNrOfNewMessages(); ?></span>Messages</a></li>
      <?php else:  ?>
      <li><a href="/message/inbox" title="Messages" class="tt-messages">Messages</a></li>
      <?php endif; ?>
      <li><?php echo link_to( 'Tutors', 'tutors/index', array('title'=>'Tutors','class'=>'tt-tutors') ); ?></li>
      <li><?php echo link_to( 'Rayku Points', 'shop/paypal', array('title'=>'Rayku Points','class'=>'tt-points') ); ?></li>
    </ul>
    <!--ul.top-menu-->

    <div id="user-box" align="left"> <a href="http://whiteboard.rayku.com" title="Test Whiteboard" target="_blank" class="tt-whiteboard">Test Whiteboard</a>
      <ul>
        <li class="main-row">
          <?php $_image = avatar_tag_for_user($raykuUser); $_image = str_replace("img", "img height='24'", $_image);?>
          <?php echo $_image; ?> <?php echo $raykuUser->getName(); ?>
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
<!--[if IE]>
<div style="width:100%;padding:8px 0;background:#FFCCCC;border-bottom:2px solid #BF3535;font-size:14px;color:#666" align="center">
Rayku doesn't work well with Internet Explorer. Please use Firefox or Chrome or another browser.
</div>
<![endif]-->
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


 <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7/themes/smoothness/jquery-ui.css"/>
 <script type="text/javascript" src="/js/jquery.idle-timer.js"></script>


<div id="status" style="padding:0 5px;">&nbsp;</div>
<form name="idleform" id="idleform" >
<input type="hidden" name="user_val" id="user_val"  value="<?php echo @$_SESSION['symfony/user/sfUser/attributes']['symfony/user/sfUser/attributes']['user_id'];?>"/>
</form>
    <script type="text/javascript">
    var ds = jQuery.noConflict();
    (function(ds){

        var timeout = 600000;

		var usid = document.getElementById("user_val").value;

        ds(document).bind("idle.idleTimer", function(){
            //ds("#status").html("User is idle :(").css("backgroundColor", "silver");
			//alert(usid)
			ds.ajax({
				type: "GET",
				url: 'http://'+getHostname()+'/tutors/ajaxidle?userid='+usid+'&status=1',
				success: function(msg){
				//alert(msg);

				}
			});


        });

        ds(document).bind("active.idleTimer", function(){
            // ds("#status").html("User is active :D").css("backgroundColor", "yellow");

			 ds.ajax({
				type: "GET",
				url: 'http://'+getHostname()+'/tutors/ajaxidle?userid='+usid+'&status=2',
				success: function(msg){
				//alert(msg);

				}
			});


        });

        ds.idleTimer(timeout);

        // correct the page
        ds('#timeout').text(timeout/1000);


    })(jQuery);

    </script>


<div id="tt-questions-tooltip" class="tooltip"> Ask a Question </div>
<div id="tt-boards-tooltip" class="tooltip"> Q&A Boards </div>
<div id="tt-messages-tooltip" class="tooltip"> You have <strong><?php echo $raykuUser->getNrOfNewMessages(); ?></strong> new messages </div>
<div id="tt-tutors-tooltip" class="tooltip"> Tutors List </div>
<div id="tt-points-tooltip" class="tooltip"> You have <strong><?php echo $detailPoints['points'];?>RP</strong> </div>
<div id="tt-whiteboard-tooltip" class="tooltip"> Practice Whiteboard </div>
<?php } ?>
<ul class="main-nav">
  <li class="home"> </li>
  <?php if($sf_user->isAuthenticated()): ?>
  <?php if($raykuUser->getType() == '4'): ?>
  <li><?php echo link_to( 'Admin', 'http://' . RaykuCommon::getCurrentHttpDomain() . '/admin.php' ); ?></li>
  <?php endif; ?>
  <?php endif;?>
</ul>
</div>
<script type="text/javascript" src="/js/checkuser.js"></script>
<script type="text/javascript" src="/js/checkuserstay.js"></script>
<?php
if( isset($_SERVER['REDIRECT_URL']) && ($_SERVER['REDIRECT_URL'] != "/login/loginCheck") &&  ($_SERVER['REDIRECT_URL'] != "/logout") && ($_SERVER['REDIRECT_URL'] != "/register") && ($_SERVER['REDIRECT_URL'] != "/start") && ($_SERVER['REDIRECT_URL'] != "/dashboard/beforeclose")):
?>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="/css/modalbox.css" media="screen" />
<link rel="stylesheet" type="text/css" href="/css/popup.css" media="screen" />
<script type="text/javascript" src="/js/scriptaculous.js"></script>
<script type="text/javascript" src="/js/builder.js"></script>
<script type="text/javascript" src="/js/effects.js"></script>
<script type="text/javascript" src="/js/modalbox.js"></script>
<script type="text/javascript" src="/js/encode_decode.js"></script>
<?php if($sf_user->isAuthenticated()) : ?>
<link rel="stylesheet" type="text/css" href="/styles/popup-window.css" />
<script type="text/javascript" src="/scripts/popup-window.js"></script>
<script type="text/javascript" src="/js/question_popup.js"></script>
<script type="text/javascript" language="javascript">checkMissedQuestion();</script>
<input type="hidden" value='1' name="question_hidden" id="question_hidden" />
<!-- Missed Question Popup Start -->
<div class="sample_popup" id="question_popup" style="display:none;z-index:50;border:3px solid #999;background:#F5F5F5;padding:4px 4px 25px 25px;width:420px;">
  <div style="width:30px;float:right;" align="right"><a href="/expertmanager/cookieadd">
  <img class="menu_form_exit" id="popup_exit" src="/styles/form_exit.png" alt="Exit"/></a>
  </div>
  <div style="width:340px;float:left;color:#990000;font-size:20px;font-weight:bold;margin-top:21px;">Oops! You missed a question.</div>
  <div style="clear:both"></div>
  <div id="misqry">
  </div>
</div>
<!-- Missed Question Popup Stop -->
<?php endif; ?>
<?php if($_SERVER['REQUEST_URI'] == "/expertmanager/connect") : ?>
<script type="text/javascript" src="/js/checkedMsgUser.js"></script>
<script type="text/javascript">
	checkedMsgUser();

	setTimeout('checkForRedirect()', 25000);
	</script>
<?php endif; ?>
<?php if ($sf_user->isAuthenticated()) { ?>
<script type="text/javascript">
checkedUser();
checkUserStay();
</script>
<?php } ?>
<script type="text/javascript">

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
//alert(redirect);
forumsub = getCookie("forumsub");
//alert(forumsub);

redirect = getCookie("redirection");
forumsub = getCookie("forumsub");

	if(redirect != '' && redirect != null ) {
		var d = jQuery.noConflict();
		d.ajax({ cache: false,
			type : "POST",
			url: "http://"+getHostname()+"/register/redirect",
			success : function (data)  {
				var check = data.split("<");
				if(check[0] == "redirect") {
					document.location = "http://"+getHostname()+"/expertmanager/studentconfirmation";
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
