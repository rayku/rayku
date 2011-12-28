<?php

/**
 * experts_payouts actions.
 *
 * @package    elifes
 * @subpackage experts_payouts
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class experts_payoutsActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {
    	
  }
  
  public function executeUnpaidExperties()
  {
  		if($this->getRequestParameter('e_id') != NULL)
		{
			
				$c = new Criteria();
				$c->add(ExpertsAdminPayoutPeer::ID,$this->getRequestParameter('id'));
				$c->add(ExpertsAdminPayoutPeer::EXPERT_ID,$this->getRequestParameter('e_id'));
				$expertspaid = ExpertsAdminPayoutPeer::doSelectOne($c); 
				
				$expertspaid->setPaid(1);
				$expertspaid->save(); 
				
				
				$expertsdebit = new ExpertsDebitDetails();
				$expertsdebit->setExpertId($this->getRequestParameter('e_id'));
				$expertsdebit->setAmount($expertspaid->getAmount());
				$expertsdebit->setTime(date('Y-m-d H:i:s'));
				$expertsdebit->save();
				
				$c = new Criteria();
				$c->add(ExpertsFinalCreditPeer::EXPERT_ID,$this->getRequestParameter('e_id'));
				$current = ExpertsFinalCreditPeer::doSelectOne($c);
				
				if($current != NULL)
				{
					$finalamount = $current->getAmount() - $expertspaid->getAmount() ;
					
					$current->setAmount($finalamount);
					$current->save();
					
				}
				
				$c = new Criteria();
				$c->add(ExpertsAdminPayoutPeer::PAID,0);
				$this->expertspayouts = ExpertsAdminPayoutPeer::doSelect($c); 
				
		
		}
  }
  
  public function executePaidExperties()
  {
  				$c = new Criteria();
				$c->add(ExpertsAdminPayoutPeer::PAID,1);
				$this->expertspayouts = ExpertsAdminPayoutPeer::doSelect($c); 
				
  }
  
  
  
}
