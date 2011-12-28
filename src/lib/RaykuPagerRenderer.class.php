<?php
/**
 * This class will have some additional information attached.
 * Those will be used in view layer to correctly generate all elements of pager.
 *
 * @author lukas
 */
class RaykuPagerRenderer
{
  /**
   * Id of HTML element used when using link_to_remote
   * If set we will generate links with link_to_remote function
   *
   * @var string
   */
  private $linkToRemoteElementId = null;

  /**
   * Base url for pager links generation.
   * It will be suffixed with &page=$page
   *
   * @var string
   */
  private $baseUrl = null;

  /**
   * Css class used for pager wrapper div
   *
   * @var string
   */
  private $cssClass = 'pager-pages';

  /**
   * @var sfPropelPager
   */
  private $pager = null;

  function  __construct( sfPager $pager )
  {
    $this->pager = $pager;
  }

  function getPager()
  {
    return $this->pager;
  }

  /**
   * Activates use of link_to_remote() when generating pager links
   *
   * @param string $elementId
   */
  function setLinkToRemoteElementId( $elementId )
  {
    $this->linkToRemoteElementId = $elementId;
  }

  /**
   * Sets $baseUrl property
   *
   * @param string $baseUrl
   */
  function setBaseUrl( $baseUrl )
  {
    if( !is_numeric( strpos( $baseUrl, '?' ) ) )
      $baseUrl .= '?';
    $this->baseUrl = $baseUrl;
  }

  /**
   * Generates pager link for $page page
   *
   * @param int $page
   */
  function generateLinkForPage( $page, $linkName = null )
  {
    if (is_null($linkName))
      $linkName = $page;
    
    return is_null( $this->linkToRemoteElementId )
             ? $this->generateWithLinkTo( $page, $linkName )
             : $this->generateWithLinkToRemote( $page, $linkName );
  }

  /**
   * Generates next page link if needed
   */
  function generateLinkNextPage()
  {
    if( $this->pager->getPage() < $this->pager->getNextPage() )
      return $this->generateLinkForPage($this->pager->getNextPage(), '&gt;');
  }

  /**
   * Generates previous page link
   */
  function generateLinkPreviousPage()
  {
    if( $this->pager->getPage() > 1 )
      return $this->generateLinkForPage($this->pager->getPreviousPage(), '&lt;');
  }



  private function generateWithLinkTo( $page, $linkName )
  {
    return link_to( $linkName,
                    "{$this->baseUrl}&page=$page",
                    array( 'class' => $page == $this->pager->getPage() ? 'active' : '' ) );
  }

  private function generateWithLinkToRemote( $page, $linkName )
  {
    sfProjectConfiguration::getActive()->loadHelpers('Javascript');
    return link_to_remote(
             $linkName,
             array( 'url' => "{$this->baseUrl}&page=$page",
                     'update' => $this->linkToRemoteElementId ),
             array( 'class' => $page == $this->pager->getPage() ? 'active' : '' ) );
  }

  function setCssClass( $cssClass )
  {
    $this->cssClass = $cssClass;
  }

  function getCssClass()
  {
    return $this->cssClass;
  }


}
?>