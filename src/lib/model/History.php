<?php

/**
 * Subclass for representing a row from the 'history' table.
 *
 * 
 *
 * @package lib.model
 */ 
class History extends BaseHistory
{
	public function __toString()
	{
    $class = $this->getEntityType();
    $entryData = new HistoricalObjectEntry($this->getUserId(), unserialize( $this->getData() ) );
    return call_user_func( "$class::renderForHistory", $entryData );
	}
}
