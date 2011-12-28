<div class="left-top"></div>
  <h3>
    <?php
      $oUser = sfContext::getInstance()->getUser()->getRaykuUser();

      echo link_to( image_tag( "http://www.rayku.com/images/rss_logo.jpg",
                                   array( 'style' => "width:15px; height:15px; margin-left:0px; margin-right:3px;" )),
                        'rss/index?id='.$oUser->getId(), array( 'target' => '_blank' ) );

      if( !isset( $historyEntries ) )
        $historyEntries = $oUser->getRecentHistory( 2 );
    ?>
    Recent Activity:
  </h3>
  <?php foreach( $historyEntries as $historyEntry): ?>
  <div class="status-update">
    <div class="text-status">
      <p>
      <?php
        echo $historyEntry;
      ?>
      </p>
      <span class="performed"><?php echo $historyEntry->getCreatedAt(); ?></span>
    </div>
    <div style="clear: both;"></div>
  </div>
  <?php endforeach; ?>
<div class="left-bottom"></div>