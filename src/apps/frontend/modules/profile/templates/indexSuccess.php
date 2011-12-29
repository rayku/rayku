<script type="text/javascript">
<!--
window.location = "http://<?php echo RaykuCommon::getCurrentHttpDomain(); ?>/tutor/<?php echo $user->getUsername();?>";
//-->
</script>

<div class="skyscrapers"> <a href="http://<?php echo RaykuCommon::getCurrentHttpDomain(); ?>/register/invitation"><img src="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/images/ad-unit-1.jpg" alt="ad" /></a> </div>
<div class="content">
<?php
	setcookie("newUser",$user->getId(), time()*60*60*24*30);
	$_COOKIE["newUser"] = $user->getId();
?>
  <?php if ($sf_user->isAuthenticated() && $user->equals($sf_user->getRaykuUser())): ?>
  <?php include_component('nudge', 'showNudges', array('user' => $user)) ?>
  <?php
			$c= new Criteria();
			$c->add(UsersNetworksPeer::USER_ID,$sf_user->getRaykuUser()->getId());
			$networkusers = UsersNetworksPeer::doSelectOne($c);
	?>
  <?php if($networkusers == NULL): ?>
  <?php include_component('network', 'network'); ?>
  <?php endif ; ?>
  <h2><?php echo $user->getName();?>'s Profile (<?php echo link_to('edit', '@profile_edit?username=' . $user->getUsername()); ?>)</h2>
  <?php else: ?>
  <h2><?php echo $user->getName();?>'s Profile</h2>
  <?php endif ?>
  <div class="content-main">
    <?php
    $urlIndex = url_for('@profile?username=' . $user->getUsername(), true);

    if( $sf_user->isAuthenticated() )
      $isFriend = $current->isFriendsWith( $user );
    else
      $isFriend = false;

    if( $isFriend )
    {
      echo '<h3>'.$user->getName().'  is in your Friends Network!</h3>';
    }

    echo '<div class="url" align="center">';
      if($sf_user->isAuthenticated())
      {
        if( $sf_user->getRaykuUser()->getUsername() != $user->getUsername() )
        {
          if( $isFriend )
            echo link_to( $urlIndex, '@profile?username=' . $user->getUsername());
          else
            echo link_to( $urlIndex, '@profile?username=' . $user->getUsername());
        }
        else
          echo link_to( $urlIndex, '@profile_edit?username=' . $user->getUsername() );
      }
      else
      {
        echo link_to( $urlIndex, '@profile?username=' . $user->getUsername());
      }
    echo '</div>';

    ?>
<div class="texts">
      <?php include_component('journal', 'mostRecentEntry', array('user' => $user)) ?>
    </div>
    <ul class="comment">
      <li><?php echo link_to('Read more...', '@journal_index?user_id=' . $user->getId()); ?></li>
    </ul>

    <br class="clear-both" />
    <div class="friends">
      <?php
     	 $friends = $user->getAllFriends();



    ?>
  <!--    <h4> <?php echo link_to('view all', 'friends/members?type=1'); ?><em>+</em></a> Friends of <strong><?php echo $user ?></strong> (<?php echo count($friends); ?>) </h4>-->
<!--============================================================Modified By DAC021===============================================================================-->
      <h4> <?php echo link_to('view all', 'friends/members?username='.$user->getUsername(), array("style"=>"font-size:14px;text-decoration:underline")); ?><em>+</em></a> Friends of <strong><?php echo $user ?></strong> (<?php echo count($friends); ?>) </h4>
<!--============================================================Modified By DAC021===============================================================================-->
      <?php include_partial('friends/profilelist', array('friends' => $friends)) ?>
    </div>
    <a name="comments" id="comments"></a>
        <div id="newone" class="newone">
      <?php include_partial( 'shoutbox', array( 'raykuPager' => $raykuPagerNew, 'user' => $user, 'current' => $current) ); ?>
    </div>

<?php
if( $sf_user->isAuthenticated()
    && $user->isFriendsWith( $current ) )
{
  include_partial( 'shoutbox_form' );
}
?>

  </div>
  <div class="content-side">
  <div style="margin:0 0 10px 10px;padding:12px 3px;background:#DDF4FF;font-size:16px;" align="center">
  <a href="http://rayku.com/tutor/<?php echo $user->getUsername() ?>">Visit <?php echo $user->getName() ?>'s Portfolio Page</a>
  </div>
    <div class="bulletin">
      <div class="header">
        <h3 style="width: 210px;"><a href="#"><strong><?php echo $user ?>'s Launch Pad</strong></a></h3>
        <h4 style="padding: 0 0 0 50px; width:90px;"><?php echo link_to('Send Message', '@compose_to?nickname=' . $user->getUsername()) ?></h4>
      </div>
      <?php include_partial('userBlockProfile', array('user' => $user,'currentuser' => $sf_user->getRaykuUser())) ?>
      <div style="clear:both"></div>
      <div style="margin-top: 11px; margin-left:10px; font-size:12px">
        <?php
      if ($user->isOnline())
        echo link_to('<div style="font-size:12px">'.$user->getName().' is online</div>', '@profile?username=' . $user->getUsername(),array('class' => 'online'));
      else
        echo link_to('<span style="color:#000000">'.$user->getName().' is offline</span>', '@profile?username=' . $user->getUsername(),array('class' => 'offline')); ?>
        <?php echo link_to('View All Photos', '@gallery_index?user_id=' . $user->getId(),array('class' => 'all-photos')) ?> </div>
    </div>
    <?php include_partial( 'about_me', array( 'user' => $user ) ); ?>
<div id="new" class="new">
    <?php include_partial( 'recent', array( 'raykuPager' => $raykuPager, 'user' => $user) ); ?>
  </div>

  </div>
</div>

