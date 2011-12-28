<?php

/**
 * Subclass for representing a row from the 'item_type' table.
 *
 * 
 *
 * @package lib.model
 */ 
class ItemType extends BaseItemType
{
	/*
	 * return name instead of id for dropdown list
	 */
	public function __toString()
	{
		return $this->getName();
	}

}
