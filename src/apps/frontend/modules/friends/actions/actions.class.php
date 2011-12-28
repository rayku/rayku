<?php

/**
 * friends actions.
 *
 * @package    elifes
 * @subpackage friends
 * @author     Adam A Flynn <adamaflynn@criticaldevelopment.net>
 */
class friendsActions extends sfActions
{
   /**
    * all members database
    */
   public function executeIndex()
   {


     $sLetter = trim( $this->getRequestParameter( 'l' ) );
     $criteria = UserPeer::getMembersCriteriaForLetter( $sLetter );

		$pager = new sfPropelPager('User', 10);
		$pager->setCriteria($criteria);
		$pager->setPage($this->getRequestParameter('page', 1));
		$pager->init();

    $raykuPager = new RaykuPagerRenderer($pager);
    $pagerBaseUrl = '/friends/index' . ( $sLetter != '' ? "?l=$sLetter" : '' );
    $raykuPager->setBaseUrl( $pagerBaseUrl );
    $raykuPager->setLinkToRemoteElementId('memberlist_ajax');

    $this->raykuPager = $raykuPager;
    

     if( $this->getRequest()->isXmlHttpRequest() )
     {
    		sfProjectConfiguration::getActive()->loadHelpers('Partial');
       return $this->renderText(
               get_partial(
                       'member_list',
                       array(
                         'users' => $this->users,
                         'raykuPager' => $raykuPager ) ) );
     }
   }

	/**
	* AJAX action for a friend list autocomplete
	*/
	public function executeAutocomplete()
	{

    $this->users = UserPeer::getWithMatchingUsername(
                     $this->getRequestParameter('name'),
                     sfConfig::get( 'app_friends_autocomplete_limit' ) );
	}
	
	/**
	* Add a friend request
	*/
	public function executeFriendshipRequest()
	{



		$user = UserPeer::getByUsername($this->getRequestParameter('username'));

    $raykuUser = $this->getUser()->getRaykuUser();

    if( !$user instanceof User )
      return sfView::ERROR;

		if( !$raykuUser->requestFriendshipFrom( $user ) )
			return sfView::ERROR;

		if ($this->getRequest()->isXmlHttpRequest())
		{
			$this->setTemplate('requestAjax');
			$this->user = $user;
		}
		
	}

  /**
	* Accept friend request
	*/
	public function executeAcceptFriendshipRequest()
	{





		$friendUser = UserPeer::retrieveByPK($this->getRequestParameter('user_id'));

		$this->forward404Unless($friendUser instanceof User);

		$this->getUser()->getRaykuUser()->respondToFriendshipRequestFrom($friendUser, true);

		if ($this->getRequest()->isXmlHttpRequest())
		{
			$this->setTemplate('requestAcceptAjax');
			$this->user = $friendUser;
			return sfView::SUCCESS;
		}

		$this->redirect('@profile?username=' . $friendUser->getUsername());
	}

  /**
	* Deny friend request
	*/
	public function executeDenyFriendshipRequest()
	{


		$friendUser = UserPeer::retrieveByPK($this->getRequestParameter('user_id'));

		$this->forward404Unless($friendUser instanceof User);

		$this->getUser()->getRaykuUser()->respondToFriendshipRequestFrom($friendUser, false);

		if ($this->getRequest()->isXmlHttpRequest())
		{
			$this->setTemplate('requestDenyAjax');
			$this->user = $friendUser;
			return sfView::SUCCESS;
		}

		$this->redirect('@profile?username=' . $friendUser->getUsername());
	}
	
	public function executeRemoveFriendship()
	{




		$friendUser = UserPeer::retrieveByPK($this->getRequestParameter('user_id'));
		
		$this->forward404Unless($friendUser instanceof User);
		
		if( !$this->getUser()->getRaykuUser()->removeFriendshipWith( $friendUser ) )
      $friendUser->removeFriendshipWith( $this->getUser()->getRaykuUser() );
		
		if ($this->getRequest()->isXmlHttpRequest())
		{
			$this->setTemplate('removeAjax');
			$this->user = $friendUser;
			return sfView::SUCCESS;
		}
		
		$this->redirect('@profile?username=' . $friendUser->getUsername());
	}
	
	/*
	 * This is the function to return memeberslist
	 */
	public function executeMembers()
	{



//============================================================Modified By DAC021===============================================================================//
	 $a = new Criteria();
	 $a->add(UserPeer::USERNAME,$this->getRequestParameter('username'));
	 $newuser = UserPeer::doSelectOne($a); 

    $iType = $this->getRequestParameter('type', 1);
    if( $iType == 1 )
      $c = FriendPeer::getCriteriaForFriendsFor( $newuser );

    else if( $iType == 2 )
      $c = FriendPeer::getCriteriaForRequestees( $this->getUser()->getRaykuUser() );
    else if( $iType == 3 )
      $c = FriendPeer::getCriteriaForRequesters( $this->getUser()->getRaykuUser() );
    else
      $this->forward404();

    UserPeer::addActiveUserCriteria($c);


		//Setup the pager
		$pager = new sfPropelPager('User', 10);
		$pager->setCriteria($c);
		$pager->setPage($this->getRequestParameter('page', 1));
		$pager->init();

  	  $raykuPager = new RaykuPagerRenderer( $pager );
    if( $iType == 1 )
    	  $raykuPager->setBaseUrl( "/friends/members?username=".$newuser->getUsername() );
    else if( $iType == 2 )
     	  $raykuPager->setBaseUrl( "/friends/members?type=".$iType );
    else if( $iType == 3 )
 	  $raykuPager->setBaseUrl( "/friends/members?type=".$iType );
    else
        $raykuPager->setBaseUrl( "/friends/members?username=".$newuser->getUsername() );
//============================================================Modified By DAC021===============================================================================//

	  $raykuPager->setLinkToRemoteElementId('tcontent');

   $this->raykuPager = $raykuPager;


    if( $this->getRequest()->isXmlHttpRequest() )
    {
  		sfProjectConfiguration::getActive()->loadHelpers('Partial');
      return $this->renderText( get_partial( 'allList', array( 'raykuPager' => $raykuPager ) ) );
    }
	}
	
	public function executeGames()
	{
		$this->user=$this->getUser()->getRaykuUser();
	}
	
}
