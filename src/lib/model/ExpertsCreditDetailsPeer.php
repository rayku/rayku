<?php

/**
 * Subclass for performing query and update operations on the 'experts_credit_details' table.
 *
 * 
 *
 * @package lib.model
 */ 
class ExpertsCreditDetailsPeer extends BaseExpertsCreditDetailsPeer
{
  static function getTotalAmountFor(User $user)
  {
    $userId = $user->getId();
    $query = "select sum(credit_amount) as totalamount from experts_credit_details  where expert_id= '$userId' ";
    $con = Propel::getConnection( self::DATABASE_NAME );
    $stmt = $con->query($query);
    if( $stmt )
    {
      $row = $stmt->fetch();
      return $row['totalamount'];
    }
    
    return 0;
  }
}
