<?php

/**
 * payout actions.
 *
 * @package    elifes
 * @subpackage payout
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class payoutActions extends sfActions
{
  /**
   * Executes index action
   *
   */
 
  public function executePayout()
  {
  			
			$expertid = $this->getUser()->getRaykuUserId() ;
			
			$c = new Criteria();
			$c->add(ExpertsFinalCreditPeer::EXPERT_ID,$expertid);
			$finalcredit = ExpertsFinalCreditPeer::doSelectOne($c);
			
			$this->sumamount=$finalcredit->getAmount(); 
			
			$c= new Criteria();
			$c->add(UserPeer::ID, $this->getUSer()->getRaykuUserId());
			$this->points=UserPeer::doSelectOne($c);
  
  }
  public function executeCredittopaypal()
  {
  		
		$expert_id = $this->getUSer()->getRaykuUserId();
		$creditamount =$this->getRequestParameter('credit');
		$paypalId =$this->getRequestParameter('paypalId');
		
		$expertadmin = new ExpertsAdminPayout();
		$expertadmin->setExpertId($expert_id);
		$expertadmin->setAmount($creditamount);
		$expertadmin->setPaypalId($paypalId);
		$expertadmin->save();
		  
  }
  public function executeRaykupoints()
  {
  	
		$this->amount = $this->getRequestParameter('amount');
		$this->currentpoints= $this->getRequestParameter('raykupoints');
		$expert_id = $this->getUSer()->getRaykuUserId();
		
		$c= new Criteria();
		$c->add(UserPeer::ID,$this->getUser()->getRaykuUserId());
		$user = UserPeer::doSelectOne($c);
  
  		$points=$user->getPoints() + $this->currentpoints;
		$user->setPoints($points);
		$user->save(); 
		
		$expertsdebit = new ExpertsDebitDetails();
		$expertsdebit->setExpertId($expert_id);
		$expertsdebit->setAmount($this->amount);
		$expertsdebit->setTime(date('Y-m-d H:i:s'));
		$expertsdebit->save();
		
		
		$c = new Criteria();
		$c->add(ExpertsFinalCreditPeer::EXPERT_ID,$expert_id);
		$current = ExpertsFinalCreditPeer::doSelectOne($c);
		
		if($current != NULL)
		{
			$finalamount = $current->getAmount() - $this->amount ;
			
			$current->setAmount($finalamount);
			$current->save();
			
		}
		
  
  }
  public function executePayment_error()
 {
 }
  
}
