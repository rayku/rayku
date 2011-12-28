<?php
class Network extends BaseNetwork
{
	/**
	* Returns the number of members in this network
	*/
	public function getMemberCount()
	{
		$c = new Criteria();
		$c->add(UserPeer::NETWORK_ID, $this->getId());
		
		return UserPeer::doCount($c);
	}
	
	/**
	* Returns the network's name
	*/
	public function __toString()
	{
		return $this->getName();
	}

  function getMembers()
  {
    $criteria = new Criteria;
    $criteria->addAscendingOrderByColumn(UserPeer::NAME);
    return $this->getUsers($criteria);
  }

  function getLatestThreads()
  {
    return ThreadPeer::getLastNetworkThreads( $this );
  }
}
