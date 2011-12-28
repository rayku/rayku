<?php
/**
 * Forum components file
 *
 * @copyright Copyright (c) 2007, Critical Development
 * @author Adam A. Flynn <adamaflynn@criticaldevelopment.net>
 * @version 1.0
 */
class forumComponents extends sfComponents
{
	/**
	* The component to display a single forum (i.e. the threads in it)
	*/
	public function executeShowForum()
	{
		
		
		$this->category = CategoryPeer::retrieveByPK($this->forumID);

   		if($this->category == NULL)
		{
			$this->category = ForumPeer::retrieveByPK($this->forumID);
		}
		
		$c = ThreadPeer::getCriteriaForCategory($this->forumID);
		
		$pager = new sfPropelPager('Thread', 10);
		$pager->setCriteria($c);
		$pager->setPage($this->getRequestParameter('page', 1));
		$pager->init();

		$raykuPager = new RaykuPagerRenderer( $pager );
		$raykuPager->setBaseUrl( '@view_page?forum_id='.$this->category->getId() );
	
		$this->raykuPager = $raykuPager;
		
		
	}
	
	/**
	* The component to display a single thread
	*/
	public function executeShowThread()
	{		
		$this->thread = ThreadPeer::retrieveByPK($this->threadID);
		$this->post = PostPeer::getFirstForThreadId($this->threadID);
		
		//First are experts anserws ( firest best than other )
    //Than are other users answers ( first best than other )
    $this->expert_best_posts = PostPeer::getForThreadIdAndFor($this->threadID, $this->post->getId(), true, 1);
    $this->expert_others_posts = PostPeer::getForThreadIdAndFor($this->threadID, $this->post->getId(), true, 0);
    $this->other_best_posts = PostPeer::getForThreadIdAndFor($this->threadID, $this->post->getId(), false, 1);
    $this->other_others_posts = PostPeer::getForThreadIdAnd($this->threadID, $this->post->getId());
	}
}
?>
