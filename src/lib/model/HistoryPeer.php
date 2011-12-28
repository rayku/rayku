<?php

/**
 * Subclass for performing query and update operations on the 'history' table.
 *
 * 
 *
 * @package lib.model
 */ 
class HistoryPeer extends BaseHistoryPeer
{
  static function createFor( HistoricalObjectI $object )
  {
    $data = $object->getDataForHistory();

    if( !is_array( $data ) )
      $data = array( $data );

    foreach( $data as $historyDataEntry )
    {
      $history = new History();
      $history->setUserId( $historyDataEntry->getUserId() );
      $history->setEntityType( get_class( $object ) );
      $history->setData( serialize( $historyDataEntry->getData() ) );
      $history->save();
    }
  }

  static function getFor( $userId, $limit = 10 )
  {
    $c = new Criteria;
    $c->add( self::USER_ID, (array)$userId, Criteria::IN );
    $c->addDescendingOrderByColumn( self::CREATED_AT );
   $c->setLimit( $limit );

  return self::doSelect( $c );
  }
}
