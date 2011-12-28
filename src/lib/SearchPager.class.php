<?php
/**
 * Pager used in search module
 */

class SearchPager extends sfPager
{
  private $search;

  public function getSearch()
  {
    return $this->search;
  }
  
  public function setSearch( Search $search )
  {
    $this->search = $search;
  }

  public function init()
  {
    $this->setLastPage( ceil($this->getNbResults() / $this->getMaxPerPage()) );
  }

  public function getNbResults()
  {
    return $this->search->nrOfObjects();
  }

  public function getResults()
  {
    $offset = ($this->getPage() - 1) * $this->getMaxPerPage();
    $aObject = $this->search->getObjects();

    return array_slice( $aObject, $offset, $this->getMaxPerPage() );
  }

  protected function retrieveObject($offset)
  {
    
  }
}
?>
