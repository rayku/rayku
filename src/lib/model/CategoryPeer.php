<?php

/**
 * Subclass for performing query and update operations on the 'category' table.
 *
 * 
 *
 * @package lib.model
 */ 
class CategoryPeer extends BaseCategoryPeer
{
  static function getAll()
  {
    $c = new Criteria;
    $c->addAscendingOrderByColumn( self::NAME );

    return self::doSelect( $c );
  }

  static function getAllForSelect()
  {
    $options = array();
    foreach( self::getAll() as $key => $category)
    {
      $options[$category->getId()] = $category->getName();
    }

    return $options;
  }

  static function getOneForExpertCategoryUserId( $user_id )
  {
    $c=new Criteria();
    $c->add(ExpertCategoryPeer::USER_ID, $user_id);
    $c->addJoin(ExpertCategoryPeer::CATEGORY_ID, CategoryPeer::ID);
    return CategoryPeer::doSelectOne($c);
  }

  static function getForExpertCategoryUserId( $user_id )
  {
    $c = new Criteria();
    $c->add(ExpertCategoryPeer::USER_ID, $user_id);
    $c->addJoin(ExpertCategoryPeer::CATEGORY_ID, CategoryPeer::ID);
    return CategoryPeer::doSelect($c);
  }
} 
