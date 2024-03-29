<?php

/*
 * This class can be used to get data for areas like "Recent Activities"
 *
 * @author lukas
 */
class RecentActivities
{
  /**
   * Contains number of records which We want to fetch
   * @var int
   */
  private $limit;

  private $feed;

  function setLimit( $limit )
  {
    $this->limit = $limit;
  }
  
  private function fetchForStudent( User $student )
  {
    return HistoryPeer::getFor( $student->getId(), $this->limit );
  }

  function fetchForUser( User $user, $context = null )
  {
      return $this->fetchForStudent($user);
  } 
  
  private function createFeed()
  {
    $this->feed = new sfRss201Feed();

    $this->feed->setTitle('rayku.com');
    $this->feed->setLink(sfConfig::get('app_rayku_url'));
    $this->feed->setAuthorEmail('');
    $this->feed->setAuthorName('autor');
  }

  /**
   *
   * @param array $historyEntries Many objects of History class
   * @return sfRss201Feed
   */
  public function getFeed( $historyEntries )
  {
    $this->createFeed();

    $i = 0;
    foreach( $historyEntries as $historyEntry )
    {
      $user = $historyEntry->getUser();
      $content = (string)$historyEntry;

      $item = new sfFeedItem();
      $item->initialize(array(
        'title'       => strip_tags( $content ),
        'link'        => 'http://' . RaykuCommon::getCurrentHttpDomain(),
        'pubDate'     => strtotime( $historyEntry->getCreatedAt() ),
        'description' => $content,
      ));

      $this->feed->addItem($item);
    }

    return $this->feed;
  }
}
?>
