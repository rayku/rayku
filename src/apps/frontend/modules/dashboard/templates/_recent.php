<?php
$latestUser = UserPeer::getNewestUser();
$connection = RaykuCommon::getDatabaseConnection();
?>

<div style="width:580px;margin:90px 20px 20px 20px;" >
  <?php 
  $raykuUser = $sf_user->getRaykuUser();
  $history = $raykuUser->getRecentHistory();
    if( count( $history ) > 0 )
	$c=0;
    {
  foreach( $history as $historyItem )
		{ 
		$c=$c+1;
		if($c>7)
		break;
  ?>
  <?php
	if($historyItem->getEntityType() == "Friend") {
		$query = mysql_query("select * from history as h, friend as f where h.created_at = f.created_at and h.id=".$historyItem->getId()." and h.created_at = '".$historyItem->getCreatedAt()."' ", $connection);
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
  <div class="update-item" style="border-bottom:none;padding-top:10px;">
    <div class="update-info" style="float:left;">
      <p class="update-text">
        <?php
    echo link_to( image_tag( "http://img44.imageshack.us/img44/5153/1280612122icontextoinsi.png",array( 'style' => "margin:0 5px;padding:0;float:left;" )) . 'Subscribe to RSS updates','rss/index?id='.$raykuUser->getId() . '&context=profile', array( 'target' => '_blank' ) );
  ?>
      </p>
    </div>
    <div class="clear-both"></div>
  </div>
  <div class="clear-both"></div>
</div>
<?php } ?>
