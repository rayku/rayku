<?php
  if ( count( $nudges ) > 0 )
  {
	  echo '<div align="center" style="padding:3px; border:2px solid #090; background:#ECFFE8; font-size:14px; margin-bottom:10px; line-height:18px">';

    foreach ($nudges as $nudge)
    {
      /* @var $nudge Nudge */
    
      $oUserFrom = UserPeer::retrieveByPK( $nudge->getUserFromId() );
      $sUserFromName = $oUserFrom->getUsername();

      echo 'You got a nudge from '.$sUserFromName.' on '.$nudge->getCreatedAt('d/m/Y').'! ';
	  	echo 'You can ';
        echo link_to('Nudge back', '@nudge?username=' . $sUserFromName );
        echo ' or ';
        echo link_to('Ignore', '@nudge_remove?username=' . $sUserFromName );
		echo '<br>';
    }
	      echo '</div>';
  }
?>
