<?php

/**
 * gifts actions.
 *
 * @package    rayku
 * @subpackage gifts
 * @author     Himanshu Rauthan
 * @version    SVN: $Id: actions.class.php 2288 2006-10-02 15:22:13Z fabien $
 */
 
class giftsActions extends sfActions
{
	public function executeIndex()
	{




		//Grab the user
		$user = $this->getUser()->getRaykuUser();
		
    	$this->gifts = GiftPeer::doSelect(new Criteria);

		$user_credit = $user->getPoints();
		if($user_credit == 0)
		{
			$this->redirect = 'credit';
			$this->credit = 0;
		}else
		{
			$this->redirect = 'process';
			$this->credit = $user_credit;
		}
		
    	$this->giftId = $this->getRequestParameter('giftid',null);
		
		if( is_numeric($this->giftId ) )
		{
      		$this->selectedGift = GiftPeer::retrieveByPK($this->giftId);
			
			if($user_credit < $this->selectedGift->getCost())
				$this->redirect = 'credit';
		}		


    	$this->userGifts = $user->getReceivedGifts();
		
		$_SESSION['sent']  = '';
		$this->user = $user;
	}
	public function executeCredit()
	{




		if($_SESSION['credited'] == 'done')
		{
			$_SESSION['credited'] = '';
		}
		$_SESSION['credituser'] = $this->getUser()->getRaykuUser()->getUsername();
	}
	public function executeProcess()
	{






		if($_SESSION['sent'] == '')
		{
      $raykuUser = $this->getUser()->getRaykuUser();
			$send_type = $this->getRequestParameter('send_type');
			$message = $this->getRequestParameter('message');

			$gift = GiftPeer::retrieveByPk( $this->getRequestParameter('giftid') );
			$recipient = UserPeer::getByUsername($this->getRequestParameter('recipient'));
      if( !$gift || !$recipient || $message == '' || !is_numeric($send_type))
        return sfView::ERROR;
			
      $raykuUser->sendGift($gift, $recipient, $send_type, $message);
			$_SESSION['sent'] = 'done';
		}
	}
	
	public function executePayment()
	{
    die( 'todo' );
//		$this->checkpayment = '';
//		if($_SESSION['credituser'] == $this->getUser()->getRaykuUser()->getUsername())
//		{
//			$this->checkpayment = 'done';
//			$this->username = $this->getUser()->getRaykuUser()->getUsername();
//
//			$credit = $this->getRequestParameter('amt','');
//
//			if($_SESSION['credited'] != 'done')
//			{
//				$conn = Propel::getConnection();
//
//				$query_add_credit = "UPDATE user SET credit = credit + ".$credit."
//				WHERE username = '$this->username'";
//
//				$this->query = $query_add_credit ;
//				$result_add_credit = mysql_query($query_add_credit);
//
//				if($result_add_credit)
//				{
//					$_SESSION['credited'] = 'done';
//				}
//			}
//
//		}
//
	}
	
	public function executePayment_error()
	{
	}
	
}
