<?php

/**
 * rss actions.
 *
 * @package    elifes
 * @subpackage rss
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class rssActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {
    $oUser = UserPeer::retrieveByPK( $this->getRequestParameter('id') );

    $oRecentActivities = new RecentActivities();
    $oRecentActivities->setLimit( 10 );

    $historyEntries = $oRecentActivities->fetchForUser( $oUser, $this->getRequestParameter('context') );
    
    $oFeed = $oRecentActivities->getFeed( $historyEntries );

    return $this->renderText( $oFeed->asXml() );
  }
}
