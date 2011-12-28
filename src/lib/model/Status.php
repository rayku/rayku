<?php

/**
 * Subclass for representing a row from the 'status' table.
 *
 * 
 *
 * @package lib.model
 */ 
class Status extends BaseStatus
{
	/*
	 * return name instead of id for dropdown list
	 */
	public function __toString()
	{
		return $this->getName();
	}

}
