<?php
/**
 * Journal components file
 *
 * @copyright Copyright (c) 2007, Critical Development
 * @author Adam A. Flynn <adamaflynn@criticaldevelopment.net>
 * @version 1.0
 */
class nudgeComponents extends sfComponents
{
	public function executeShowNudges()
	{
		$user = $this->user;

		$nudges = $user->getNudges();

		$this->nudges = $nudges;
	}
}
