<?php
  /* @var $user User */
  $history = $user->getRecentHistory();


?>
<div class="recent">
  <?php
    echo link_to( image_tag( "http://www.rayku.com/images/rss_logo.jpg",
                                 array( 'style' => "width:15px; height:15px; float:left; margin-left:3px; margin-right:5px;" )),
                  'rss/index?id='.$user->getId() . '&context=profile', array( 'target' => '_blank' ) );
  ?>
  <h4><?php
    echo link_to( 'view all <em>+</em>', 'rss/index?id='.$user->getId() . '&context=profile', array( 'target' => '_blank' ) );
  ?><?php echo $user->getName() ?>'s <strong>Recent History</strong></h4>
  <ul>
  <?php

			$con = mysql_connect("localhost", "rayku_db", "db_*$%$%") or die(mysql_error());

			$db = mysql_select_db("rayku_db", $con) or die(mysql_error());


    if( count( $history ) > 0 )
    {
      foreach( $history as $item )

	if($item->getEntityType() == "Friend") {

		$query = mysql_query("select * from history as h, friend as f where h.created_at = f.created_at and h.id=".$item->getId()." and h.created_at = '".$item->getCreatedAt()."' ");

			$row = mysql_fetch_array($query);


			if($row["status"] == 1) :

				echo "<li>$item</li>";
			endif;
			
			       
	} else {

		 echo "<li>$item</li>";

	}


    }
    else
      echo "<li>No History</li>";
  ?>
  </ul>
</div>

