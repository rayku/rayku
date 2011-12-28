<?php
/* 
 * This is only containter for few history object entry related data
 */

class HistoricalObjectEntry
{
  private $userId = 0;
  private $entryData = array();

  function __construct( $userId, $entryData = array() )
  {
    $this->userId = $userId;
    $this->entryData = $entryData;
  }

  function getUserId()
  {
    return $this->userId;
  }

  function getData()
  {
    return $this->entryData;
  }

  function getUserLink( $userId = null )
  {
    if( is_null( $userId ) )
      $userId = $this->getUserId();
    
    sfProjectConfiguration::getActive()->loadHelpers( array( 'Tag', 'Url' ) );
    $user = UserPeer::retrieveByPK( $userId );
    return !$user ? '<i>Deleted account</i>' : link_to( $user->getUsername(), '@profile?username=' . $user->getUsername() );
  }
}
?>
