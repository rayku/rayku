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

		$con = mysql_connect("localhost", "rayku_db", "db_*$%$%");
		$db = mysql_select_db("rayku_db", $con);

		$currentUser = $this->getUser()->getRaykuUser();

		$userId = $currentUser->getId();

   }


}

