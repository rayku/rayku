<?php

/**
 * network actions.
 *
 * @package    elifes
 * @subpackage network
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class networkActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->networks = NetworkPeer::doSelect(new Criteria); 
	
		
		$c = new Criteria();
		$c->add(UsersNetworksPeer::USER_ID,$this->getUser()->getRaykuUser()->getId());
		$this->mynetworks = UsersNetworksPeer::doSelect($c);
	
  }

  public function executeShow(sfWebRequest $request)
  {
  
  		/*$c = new Criteria();
		$c->add(NetworkPeer::ID,$this->getRequestParameter('id'));
	    $this->network = NetworkPeer::doSelectOne($c);*/
  
    	$this->network = NetworkPeer::retrieveByPK($this->getRequestParameter('id'));

    $this->forward404Unless(is_object($this->network));
  }
  
  public function executeJoin()
  {
  
  		$this->network_id = $this->getRequestParameter('id');
		$this->user_id= $this->getUser()->getRaykuUser()->getId();
		
		
		$network = new UsersNetworks();
		$network->setNetworkId($this->network_id);
		$network->setUserId($this->user_id);
		$network->setJoinedOn(date('Y-m-d h:i:s'));
		$network->save();
		
		$this->redirect('/network/show/id/'.$this->network_id.'');
		
  
  }
  
  public function executeUnjoin()
  {
  
  		$this->network_id = $this->getRequestParameter('id');
		$this->user_id= $this->getUser()->getRaykuUser()->getId();
		
		
		$c = new Criteria();
		$c->add(UsersNetworksPeer::NETWORK_ID,$this->network_id);
		$c->add(UsersNetworksPeer::USER_ID,$this->user_id);
		$network = UsersNetworksPeer::doSelectOne($c);
		
		$network->delete();
				
		$this->redirect('/network/show/id/'.$this->network_id.'');
  	
  
  }
  
  
  
}
