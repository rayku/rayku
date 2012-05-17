<?php
/**
 * Class responsible for handling search functionality of rayku.com
 *
 * @author lukas
 */
class Search
{
  private $criteria;
  private $objects = array();

  function __construct( $criteria )
  {
    $this->criteria = $criteria;
  }

  function withinUsers( sfUser $user )
  {
      $this->addFromStatement( UserPeer::search($this->criteria, $user) );
  }

  function withinPosts()
  {
    $this->addFromStatement( PostPeer::search( $this->criteria ) );
  }

  function withinGroups()
  {
    $this->addFromStatement( GroupPeer::search( $this->criteria ) );
  }

  private function addFromStatement( PDOStatement $stmt )
  {
    $rows = array();
    while( $row = $stmt->fetch() )
      $rows[] = $row;

    if( count( $rows ) > 0 )
      $this->objects = array_merge( $this->objects, $rows );
  }

  private function sort()
  {
    usort( $this->objects, array( $this, 'compareByName' ) );
  }

  private function compareByName( $obj1, $obj2 )
  {
    if( $obj1['NAME'] > $obj2['NAME'] )
      return 1;
    else if( $obj1['NAME'] == $obj2['NAME'] )
      return 0;
    else
      return -1;

  }

  function getObjects()
  {
    $this->sort();
    return $this->objects;
  }

  function nrOfObjects()
  {
    return count( $this->objects );
  }

  function getPartialTemplateNameFor( $object )
  {
    switch( $object['TNAME'] )
    {
      case UserPeer::TABLE_NAME:  return 'objectUser';
      case PostPeer::TABLE_NAME:  return 'objectPost';
      case GroupPeer::TABLE_NAME: return 'objectGroup';
    }
  }

}
?>
