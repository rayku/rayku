<?php

/**
 * Subclass for performing query and update operations on the 'shopping_cart' table.
 *
 * 
 *
 * @package lib.model
 */ 
class ShoppingCartPeer extends BaseShoppingCartPeer
{
  static function getForUser($userId)
  {
    $c = new Criteria();
		$c->add(ShoppingCartPeer::IS_ACTIVE, true);
		$c->add(ShoppingCartPeer::USER_ID, $userId);
		$c->addDescendingOrderByColumn(ShoppingCartPeer::CREATED_AT);
		return ShoppingCartPeer::doSelect($c);
  }
}
