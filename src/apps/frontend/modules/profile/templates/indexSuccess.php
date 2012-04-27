<script type="text/javascript">
<!--
window.location = "http://rayku.com/tutor/<?php echo $user->getUsername();?>";
//-->
</script>

<div class="skyscrapers"> <a href="http://rayku.com/register/invitation"><img src="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/images/ad-unit-1.jpg" alt="ad" /></a> </div>
<div class="content">
<?php  
	setcookie("newUser",$user->getId(), time()*60*60*24*30);
	$_COOKIE["newUser"] = $user->getId();
?>
  <?php if ($sf_user->isAuthenticated() && $user->equals($sf_user->getRaykuUser())): ?>
  <?php include_component('nudge', 'showNudges', array('user' => $user)) ?>
  <h2><?php echo $user->getName();?>'s Profile (<?php echo link_to('edit', '@profile_edit?username=' . $user->getUsername()); ?>)</h2>
  <?php else: ?>
  <h2><?php echo $user->getName();?>'s Profile</h2>
  <?php endif ?>
  <div class="content-main">
    <?php
    $urlIndex = url_for('@profile?username=' . $user->getUsername(), true);

    echo '<div class="url" align="center">';
      if($sf_user->isAuthenticated())
      { 
        if( $sf_user->getRaykuUser()->getUsername() != $user->getUsername() )
        {
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
    <br class="clear-both" />
    <a name="comments" id="comments"></a>
        <div id="newone" class="newone">
      <?php include_partial( 'shoutbox', array( 'raykuPager' => $raykuPagerNew, 'user' => $user, 'current' => $current) ); ?>
    </div>

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
    </div>
    <?php include_partial( 'about_me', array( 'user' => $user ) ); ?>
  </div>
</div>

