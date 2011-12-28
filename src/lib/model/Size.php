<?php

/**
 * Subclass for representing a row from the 'size' table.
 *
 * 
 *
 * @package lib.model
 */ 
class Size extends BaseSize
{
	/*
	 * return name instead of id for dropdown list
	 */
	public function __toString()
	{
		return $this->getName();
	}
}
