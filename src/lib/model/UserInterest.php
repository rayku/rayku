<?php

/**
 * Subclass for representing a row from the 'user_interest' table.
 *
 * 
 *
 * @package lib.model
 */ 
class UserInterest extends BaseUserInterest
{
	public function __toString()
	{
		return $this->getInterest();
	}
}
