<?php

/**
 * Subclass for representing a row from the 'classroom_comment' table.
 *
 * 
 *
 * @package lib.model
 */ 
class ClassroomComment extends BaseClassroomComment implements HistoricalObjectI
{
	public function save(PropelPDO $con = null)
	{
    $new = $this->isNew();

    $ret = parent::save($con);

    if( $new )
      HistoryPeer::createFor($this);

    return $ret;
	}

  public function getDataForHistory()
  {
    return new HistoricalObjectEntry(
            $this->getUserId(),
            array( 'classroom_blog_id' => $this->getClassroomBlogId(),
                   'title' => $this->getClassroomBlog()->getTitle() )
            );
  }

  public static function renderForHistory( HistoricalObjectEntry $historyEntryData )
  {
    $data = $historyEntryData->getData();

    $userLink = $historyEntryData->getUserLink();

    return "$userLink commented classroom blog titled " . link_to( $data['title'], 'classroom_blog/show?id=' . $data['classroom_blog_id'] ) ;
  }
}
