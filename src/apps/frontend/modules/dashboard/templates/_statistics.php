<?php
  use_helper('MyAvatar', 'Javascript');
  $raykuUser = $sf_user->getRaykuUser();
$connection = RaykuCommon::getDatabaseConnection();
?>
<?php
  $raykuUser = $sf_user->getRaykuUser();
  $stats = $raykuUser->getStatisticsForDashboard();


?>

<div class="following">
  <div class="top">
    <div class="bot">
      <div class="left" align="center"> <?php echo avatar_tag_for_user($raykuUser, 5) ; ?> </div>
      <div class="right"> You currently have:<br />
        <ul>
          <?php if(!$stats['classroomsCount']) 
		       $stats['classroomsCount']=0;
		?>
          <li><strong><?php echo $stats['classroomsCount']; ?></strong> Expert-Connect Sessions</li>
          <li><strong><?php echo $stats['friendsCount']; ?></strong> Friends on Rayku.com</li>
          <li><strong><?php $logedUserId = $_SESSION['symfony/user/sfUser/attributes']['symfony/user/sfUser/attributes']['user_id'];
		$query = mysql_query("select * from user where id=".$logedUserId." ", $connection) or die(mysql_error());
		$detailPoints = mysql_fetch_assoc($query);
		echo $detailPoints['points']; ?></strong>RP (<a rel="popup standard 600 435 noicon" href="http://rayku.com/rp.html" title="[Opens in pop-up window]">Rayku Points</a>)</li>
          <li><strong><?php echo $stats['teachersCount']; ?></strong> Media Files (Video/Pictures)</li>
          <li><strong><?php echo $stats['expertCount']; ?></strong>ES (<a rel="popup standard 600 435 noicon" href="http://rayku.com/es.html" title="[Opens in pop-up window]">Expert Score</a>)</li>
          <li><strong><?php echo $stats['journalCount']; ?></strong> Journal Entries</li>
        </ul>
        <?php 
		//SOFTLAUNCH
		
		//echo link_to(
              //image_tag( 'body-left-following-addphoto.png' ),
              //'@gallery_index?user_id=' . $raykuUser->getId()); ?>
        <?php
        //echo link_to(
        	  //image_tag( 'body-left-following-addvideo.png' ),
              //'@gallery_index?user_id=' . $raykuUser->getId()); ?>
        <?php
        //echo link_to(
              //image_tag( 'body-left-following-compose.png' ),
              //'http://www.rayku.com/message/compose'); ?>
      </div>
      <div class="clear-both"></div>
    </div>
  </div>
</div>
