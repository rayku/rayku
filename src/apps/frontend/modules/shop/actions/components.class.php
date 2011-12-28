<?php

/**
 * shop actions.
 *
 * @package    elifes
 * @subpackage shop
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class shopComponents extends sfComponents
{
	public function executeCartBox()
	{
		$this->user = $this->getUser()->getRaykuUser();
		$c = new Criteria();
		$c->add(ShoppingCartPeer::IS_ACTIVE,true);
		$c->add(ShoppingCartPeer::USER_ID,$this->user->getId());
		$c->addDescendingOrderByColumn(ShoppingCartPeer::CREATED_AT);
		$this->cart_items = ShoppingCartPeer::doSelect($c);
	}
	
	public function executeCartCheckoutBox()
	{
		$this->user = $this->getUser()->getRaykuUser();
		$c = new Criteria();
		$c->add(ShoppingCartPeer::IS_ACTIVE,true);
		$c->add(ShoppingCartPeer::USER_ID,$this->user->getId());
		$c->addDescendingOrderByColumn(ShoppingCartPeer::CREATED_AT);
		$this->cart_items = ShoppingCartPeer::doSelect($c);
	}
	
	public function executeRightBox()
	{
	 $category = $this->getRequestParameter('category'); 
	 $c= new Criteria();
	 $c->add(ItemPeer::IS_ACTIVE,true);
	 $c->addDescendingOrderByColumn(ItemPeer::CREATED_AT);
	 if($category)
	 	$c->add(ItemPeer::ITEM_TYPE_ID, $category);
	 $this->items = ItemPeer::doSelect($c);
	 $this->itemTypes = ItemTypePeer::doSelect(new Criteria());
	 $this->user = $this->getUser()->getRaykuUser();

	}

}
