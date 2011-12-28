<?php

/**
 * Subclass for representing a row from the 'sales' table.
 *
 * 
 *
 * @package lib.model
 */ 
class Sales extends BaseSales
{
	/*
	 * return name instead of id for dropdown list
	 */
	public function __toString()
	{
		return $this->getName();
	}

}
