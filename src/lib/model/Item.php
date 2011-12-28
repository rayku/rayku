<?php

/**
 * Subclass for representing a row from the 'item' table.
 *
 * 
 *
 * @package lib.model
 */ 
class Item extends BaseItem
{
	/*
	 * return name instead of id for dropdown list
	 */
	public function __toString()
	{
		return $this->getName();
	}

}
