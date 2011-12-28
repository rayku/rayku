<?php
/**
 * Defines required interface for objects that wants to be historical
 *
 * Object that wants to be historical should set some data with getDataForHisory() method.
 * Later that data will be back in renderForHistory method
 *
 * Note that renderForHistory() is static method and when it is called You have no
 * access to Propel object from which given entry was previously created
 *
 * Object that wants to be historical is responsible also for creating history entry
 * That object must decide when he wants to create such entry.
 * Common case will be in save method, for example:
 	public function save($con = null)
	{
    $new = $this->isNew();
    $ret = parent::save($con);

    if( $new )
      HistoryPeer::createFor($this);

    return $ret;
	}
 */
interface HistoricalObjectI
{
  /**
   * This method should return array of HistoricalObjectEntry objects
   * From each one of them there will be history record created
   *
   * @return HistoricalObjectEntry
   */
  function getDataForHistory();

  /**
   * This method renders as HTML given HistoricalObjectEntry
   * @param HistoricalObjectEntry $history
   */
  static function renderForHistory( HistoricalObjectEntry $history );
}
?>
