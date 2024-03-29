<?php
    RaykuCommon::getDatabaseConnection();
    use_helper('MyAvatar', 'Javascript');
    
    /**
     * @todo - fix this if needed at all - or it would be better to wipe this out
     *         currently it creates infinite loop of redirects
     */
    // include_partial('global/topNav_bannedIps');
    
    $raykuUser = $sf_user->getRaykuUser();

    if(!$sf_user->isAuthenticated())
    {
        
        
?>
<div id="top-nav">
  <!-- For the person who will use this code. Check the TITLES of the <a> tags! They correspond in the CSS file aswell! -->
  <div id="top-nav-center">
    <ul class="top-menu">
      <li><a href="/start" title="Rayku">Rayku</a></li>
    </ul>
    <!--navigation-->
    <ul id="navigation" style="margin-top:6px;">
      <li><a href="/login">Login</a></li>
       <li><a href="/register">Register</a></li>
       <li><a href="/about">About</a></li>
       <li><a href="/jobs">Jobs</a></li>
       <li><a href="/joinus">Become a Tutor</a></li>
       <!--<li><a href="/tourpage">Tour</a></li>-->
    </ul>
    <!--navigation-->
    <div class="clear"></div>
  </div>
  <!--div#top-nav-center-->
</div>
</div>
<!--div#top-nav-->
<?php



} else {
    
    $queryPoints = mysql_query("select * from user where id=".$raykuUser->getId()) or die(mysql_error());
    $detailPoints = mysql_fetch_assoc($queryPoints);

    
    $email=$raykuUser->getEmail();
    
?>
<div id="top-nav">
  <!-- For the person who will use this code. Check the TITLES of the <a> tags! They correspond in the CSS file aswell! -->
  <div id="top-nav-center">
    <ul class="top-menu">
      <li><?php echo link_to( 'Rayku', '/', array('title'=>'Rayku') ); ?></li>
      <li><?php echo link_to( 'Ask Question', '/dashboard', array('title'=>'Ask Question','class'=>'tt-questions') ); ?></li>
      <li><?php echo link_to( 'Tutors', 'tutors/index', array('title'=>'Tutors','class'=>'tt-tutors') ); ?></li>
      <!--<li><?php echo link_to( 'Q&A Boards', '/forum/index', array('title'=>'Q&A Boards','class'=>'tt-boards') ); ?></li>-->
      <?php if($raykuUser->getNrOfNewMessages() >= 1) : ?>
      <li><a href="/message/inbox" title="Messages" class="tt-messages"><span><?php echo $raykuUser->getNrOfNewMessages(); ?></span>Messages</a></li>
      <?php else:  ?>
      <li><a href="/message/inbox" title="Messages" class="tt-messages">Messages</a></li>
      <?php endif; ?>
      <li><?php echo link_to( 'Rayku Points', 'shop/paypal', array('title'=>'Rayku Points','class'=>'tt-points') ); ?></li>
    </ul>
    <!--ul.top-menu-->

    <div id="user-box" align="left"> <a href="<?php echo sfConfig::get('app_whiteboard_url') ?>/standalone" title="Test Whiteboard" target="_blank" class="tt-whiteboard">Test Whiteboard</a>
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

<div id="tt-questions-tooltip" class="tooltip"> Ask a Question </div>
<div id="tt-boards-tooltip" class="tooltip"> Q&amp;A Boards </div>
<div id="tt-messages-tooltip" class="tooltip"> You have <strong><?php echo $raykuUser->getNrOfNewMessages(); ?></strong> new messages </div>
<div id="tt-tutors-tooltip" class="tooltip"> Tutors List </div>
<div id="tt-points-tooltip" class="tooltip"> You have <strong><?php echo $detailPoints['points'];?>RP</strong> </div>
<div id="tt-whiteboard-tooltip" class="tooltip"> Practice Whiteboard </div>
<?php


}


?>
</div>


<script type="text/javascript" src="/js/checkuser.js"></script>


<?php
if(isset($_SERVER['REDIRECT_URL']) && ($_SERVER['REDIRECT_URL'] != "/login/loginCheck")
        &&  ($_SERVER['REDIRECT_URL'] != "/logout")
        && ($_SERVER['REDIRECT_URL'] != "/register")
        && ($_SERVER['REDIRECT_URL'] != "/start")
        && ($_SERVER['REDIRECT_URL'] != "/dashboard/beforeclose")
) {
    
    if($sf_user->isAuthenticated()) {
        include_partial('global/topNav_questionPopup');
    }

    if($_SERVER['REQUEST_URI'] == "/expertmanager/connect") {
        echo '
            <script type="text/javascript" src="/js/checkedMsgUser.js"></script>
            <script type="text/javascript">
                checkedMsgUser();
                setTimeout(\'checkForRedirect()\', 25000);
            </script>';
    }

    if ($sf_user->isAuthenticated()) {
        ?>
            <script type="text/javascript">
                checkedUser();
            </script>
<?php

    $userTutorResult = mysql_query("select * from user_tutor where userid=".$raykuUser->getId());

    if (mysql_num_rows($userTutorResult) > 0) {
?>
            <div id="idleStateMessage">
                <div>
                    <div class="warning">Warning!</div> Your will be logged out in <span></span> seconds due to inactivity. <a href="#">Click here to abort</a>
                </div>
            </div>
            <script src="/js/vendor/ehynds/jquery-idle-timeout/src/jquery.idletimer.js" type="text/javascript"></script>
            <script src="/js/vendor/ehynds/jquery-idle-timeout/src/jquery.idletimeout.js" type="text/javascript"></script>
            <script type="text/javascript">
jQuery.idleTimeout('#idleStateMessage', '#idleStateMessage a', {
        idleAfter: 1800,
        warningLength: 60,
        onTimeout: function(){
            window.location = '/login/logout?redirectTo=idle';
        },
        onIdle: function(){
            jQuery(this).slideDown();
        },
        onCountdown: function( counter ){
            jQuery(this).find("span").html( counter );
        },
        onResume: function(){
            jQuery(this).slideUp();
        }
});            
            </script>
        <?php
        }
    }

    include_partial('global/topNav_someJSScripts');
}
?>
