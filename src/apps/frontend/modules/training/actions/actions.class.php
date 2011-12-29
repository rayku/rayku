<?php

/**
 * friends actions.
 *
 * @package    elifes
 * @subpackage friends
 * @author     Adam A Flynn <adamaflynn@criticaldevelopment.net>
 */
class trainingActions extends sfActions
{
   /**
    * all members database
    */
   public function executeIndex()
   {
		$currentUser = $this->getUser()->getRaykuUser();

		$userId = $currentUser->getId();
   }
}

