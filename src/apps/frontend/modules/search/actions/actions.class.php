<?php

/**
 * search actions.
 *
 * @package    elifes
 * @subpackage search
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class searchActions extends sfActions
{
	public function executeIndex()
	{



    $search = $this->getSearch();
    $sCriteria = $this->getRequestParameter( 'criteria' );

    if( trim( $sCriteria ) == '' )
			return sfView::ERROR;

		$findfrom = $this->getRequestParameter('findfrom', 'ALL' );

    switch($findfrom)
		{
      case "ALL":
          $search->withinUsers( $this->getUser() );
          $search->withinPosts();
//          $search->withinGroups();
        break;
			case "people": $search->withinUsers( $this->getUser() ); break;
      case "posts" : $search->withinPosts(); break;
//			case "groups": $search->withinGroups(); break;
		}

		if( $search->nrOfObjects() == 0 )
			return sfView::ERROR;

    
    //Setup the pager and grab the appropriate resultset
    $pager = new SearchPager('Search', 4);
    $pager->setSearch($search);
    $pager->setPage($this->getRequestParameter('page', 1));
    $pager->init();

    $raykuPager = new RaykuPagerRenderer($pager);
    $raykuPager->setBaseUrl('search/index' . ( $sCriteria != '' ? '?criteria='.$sCriteria : '' ) . '&findfrom='.$findfrom );
    $raykuPager->setLinkToRemoteElementId( 'tcontent' );

		if( $this->getRequest()->isXmlHttpRequest() )
    {
  		sfProjectConfiguration::getActive()->loadHelpers('Partial');
      return $this->renderText( get_partial( 'allList', array( 'raykuPager' => $raykuPager, 'search' => $search ) ) );
    }

    $this->raykuPager = $raykuPager;
    $this->search = $search;
	}

  /**
   * @return Search
   */
  private function getSearch()
  {

    $search = new Search( $this->getRequestParameter('criteria') );
    return $search;
  }

}
