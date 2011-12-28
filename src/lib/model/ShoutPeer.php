<?php

/**
 * Subclass for performing query and update operations on the 'shout' table.
 *
 * 
 *
 * @package lib.model
 */ 
class ShoutPeer extends BaseShoutPeer
{
  static function getUserComments( User $user )
  {
    $c = new Criteria;
    $c->add( self::RECIPIENT_ID, $user->getId() );
    $c->addDescendingOrderByColumn( self::CREATED_AT );
    return self::doSelectJoinUserRelatedByPosterId( $c );
  }

  static function createWelcomeComment( User $user, User $kinkarsoUser )
  {
    $content = 'Hi ' . $user->getName() . ', welcome to Rayku!';
    self::createComment($user, $kinkarsoUser, $content);
  }

  static function createComment( User $recipient, User $poster, $content )
  {
    $shout = new Shout;
    $shout->setUserRelatedByPosterId($poster);
    $shout->setUserRelatedByRecipientId($recipient);

    $time = strtotime(date('Y-m-d H:i:s')) + 3120;

    $newTime = date('Y-m-d H:i:s', $time);

    $shout->setCreatedAt($newTime);


    $shout->setContent($content);
    $shout->save();
  }

  static function getShoutCriteria( User $user )
  {
    $c = new Criteria;
    $c->add( self::RECIPIENT_ID, $user->getId() );
    $c->addDescendingOrderByColumn( self::CREATED_AT );
    return  $c;
  }
}
