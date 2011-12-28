<?php
$latestUser = UserPeer::getNewestUser();
?>

<div style="width:600px;margin:20px auto" >
  <div style="float:right;font-size:12px; font-weight:normal;margin-top:5px; width:300px" align="right">
    <?php
    $raykuUser = $sf_user->getRaykuUser();
    echo link_to( image_tag( "http://img44.imageshack.us/img44/5153/1280612122icontextoinsi.png",array( 'style' => "margin:0 5px;padding:0;float:right;" )) . 'Subscribe to RSS updates','rss/index?id='.$raykuUser->getId() . '&context=profile', array( 'target' => '_blank' ) );

    $history = $raykuUser->getRecentHistory();
    if( count( $history ) > 0 )
	$c=0;
    {
  ?>
  </div>
  <?php foreach( $history as $historyItem )
		{ 
		$c=$c+1;
		if($c>7)
		break;
  ?>
  <?php
	if($historyItem->getEntityType() == "Friend") {
		$query = mysql_query("select * from history as h, friend as f where h.created_at = f.created_at and h.id=".$historyItem->getId()." and h.created_at = '".$historyItem->getCreatedAt()."' ");
		$row = mysql_fetch_array($query);
			if($row["status"] == 1) : ?>
  <div class="update-item">
    <div class="update-info" style="float: left; padding-left: 15px;">
      <p class="update-text"><?php echo $historyItem; ?></p>
    </div>
    <div class="clear-both"></div>
  </div>
  <?php endif;		       
  } else {
  ?>
  <div class="update-item">
    <div class="update-info" style="float: left; padding-left: 15px;">
      <p class="update-text"><?php echo $historyItem; ?></p>
    </div>
    <div class="clear-both"></div>
  </div>
  <?php } ?>
  <?php } ?>
  <!--<div class="update-item">
    <div class="update-info" style="float: left; padding-left: 15px;">
      <p class="update-text">
        <?php if($sf_user->isAuthenticated()) : ?>
        <?php $livefeeds = $sf_user->getRaykuUser()->getLiveFeed();
			
				
				                 if($livefeeds != NULL)
				                  {
						         foreach( $livefeeds as $livefeed )
       				 
					 	         echo "<strong style='color:#1C517C;font-size:15px;'>$livefeed</strong>";
							
				                   }
					
				                 else
				                  {
					?>
        <?php echo link_to($latestUser->getName(),'@profile?username='.$latestUser->getUsername().'',array('style'=>'color:#1C517C;font-size:12px;')); ?>
        <?php if($latestUser->getShowHometown() && $latestUser->getShowAddress()): ?>
        <?php if(($latestUser->getAddress() != '' && $latestUser->getShowAddress()) && ($latestUser->getHometown() != '' && $latestUser->getShowHometown())): ?>
        from <?php echo $latestUser->getHometown() ?>
        <?php endif; ?>
        <?php endif; ?>
        has just joined Rayku!
        <?php }
						
									 
			 ?>
        <?php else: ?>
        <?php echo link_to($latestUser->getName(),'@profile?username='.$latestUser->getUsername().'',array('style'=>'color:#1C517C;font-size:15px;')); ?>
        <?php if($latestUser->getShowHometown() && $latestUser->getShowAddress()): ?>
        <?php if(($latestUser->getAddress() != '' && $latestUser->getShowAddress()) && ($latestUser->getHometown() != '' && $latestUser->getShowHometown())): ?>
        from <?php echo $latestUser->getHometown() ?>
        <?php endif; ?>
        <?php endif; ?>
        has just joined Rayku!
        <?php endif; ?>
      </p>
    </div>
    <div class="clear-both"></div>
  </div>-->
  <div class="clear-both"></div>
</div>
<?php } ?>
