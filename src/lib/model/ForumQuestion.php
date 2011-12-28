<?php

/**
 * Subclass for representing a row from the 'forum_question' table.
 *
 * 
 *
 * @package lib.model
 */ 
class ForumQuestion extends BaseForumQuestion
{
  public function isLoggedUserOwner()
  {
    return ( $this->getUserId() == sfContext::getInstance()->getUser()->getRaykuUserId() );
  }
}
