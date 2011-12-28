<?php

/**
 * online_experts actions.
 *
 * @package    elifes
 * @subpackage online_experts
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class online_expertsActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {
    			
	if(empty($_COOKIE["popupopen"])) :
			$this->redirect("dashboard/popuperror");
	endif;


				$this->categories=CategoryPeer::doSelect(new Criteria());
				
				$this->cat=$this->getRequestParameter('category');
				
				$c = new criteria();
				$c->addJoin(UserPeer::ID,ExpertCategoryPeer::USER_ID, Criteria::JOIN);
				$c->add(ExpertCategoryPeer::CATEGORY_ID,$this->getRequestParameter('category'));
				$this->alluser = UserPeer::doSelect($c);
				
				/*	$c->setDistinct();*/

			
  }
  public function executeLessons()
  {

	if(empty($_COOKIE["popupopen"])) :
			$this->redirect("dashboard/popuperror");
	endif;

  
  			$expertid=$this->getRequestParameter('expert_id');
			$this->expert = UserPeer::retrieveByPk($expertid);
  
  }
  public function executeCheckout()
  {
  		

	if(empty($_COOKIE["popupopen"])) :
			$this->redirect("dashboard/popuperror");
	endif;

		$this->expert_id = $this->getRequestParameter('expert_id');
		$this->expert_lesson_id = $this->getRequestParameter('expert_lesson_id');
		
		$c= new Criteria();
		$c->add(ExpertLessonPeer::ID,$this->expert_lesson_id);
		$this->expert_lesson=ExpertLessonPeer::doSelectOne($c);
		
		
		$c=new Criteria();
		$c->add(ExpertLessonSchedulePeer::EXPERT_LESSON_ID,$this->expert_lesson_id);
		$this->lesson_shedule=ExpertLessonSchedulePeer::doSelectOne($c);


 }
 public function executeImmediate()
  {

	if(empty($_COOKIE["popupopen"])) :
			$this->redirect("dashboard/popuperror");
	endif;

	
		$this->expert_id = $this->getRequestParameter('expert_id');
		$this->expert_immediate_lesson_id = $this->getRequestParameter('expert_immediate_lesson_id');
		
		$c= new Criteria();
		$c->add(ExpertsImmediateLessonPeer::ID,$this->expert_immediate_lesson_id);
		$this->expert_lesson=ExpertsImmediateLessonPeer::doSelectOne($c);
 }
 
 public function executePaypal()
 {

	if(empty($_COOKIE["popupopen"])) :
			$this->redirect("dashboard/popuperror");
	endif;
 
 		$c=new Criteria();
		$c->add(UserPeer::ID,$this->getUser()->getRaykuUserId());
		$this->user=UserPeer::doSelectOne($c); 
		
		
		$this->expert_id=$this->getRequestParameter('expert_id');
		$this->expert_immediate_lesson_id=$this->getRequestParameter('expert_immediate_lesson_id');
		$this->experts_price=$this->getRequestParameter('experts_price');
		$this->immediate=$this->getRequestParameter('immediate');
		
		$this->minutes=$this->getRequestParameter('minutes');
		
		
		$this->amount=($this->minutes)*($this->experts_price);
		
	
 }
 
 public function executeConfirmation() {
 
 		

	if(empty($_COOKIE["popupopen"])) :
			$this->redirect("dashboard/popuperror");
	endif;


		$this->expertid = $this->getRequestParameter('expert_id');
		$this->studentid = $this->getUser()->getRaykuUserId() ;
		$this->minutes = $this->getRequestParameter('minutes');
		$this->expert_immediate_lesson_id = $this->getRequestParameter('expert_immediate_lesson_id');
		
		if($this->getRequestParameter('e_id') != '')
		{
				$this->e_id = $this->getRequestParameter('e_id');
				$this->minu = $this->getRequestParameter('min');
				$this->el_id = $this->getRequestParameter('el_id');
				
				$c = new Criteria();
				$c->add(ExpertsImmediateLessonPeer::USER_ID,$this->e_id);
				$c->add(ExpertsImmediateLessonPeer::ID,	$this->el_id);
				$lessondetail = ExpertsImmediateLessonPeer::doSelectOne($c);
				
				$amount = $this->minu * $lessondetail->getPrice();
				
				$credits= new ExpertsCreditDetails();
				$credits->setStudentId($this->studentid);
				$credits->setExpertId($this->e_id);
				$credits->setCreditAmount($amount);
				$credits->setImmediateLessonId($this->el_id);
				$credits->save(); 
				
				$c = new Criteria();
				$c->add(ExpertsFinalCreditPeer::EXPERT_ID,$this->e_id);
				$currentfinal = ExpertsFinalCreditPeer::doSelectOne($c);
				
				if($currentfinal != NULL)
				{
				
					$finalcredit= $currentfinal->getAmount() + $amount ; 
					
					$currentfinal->setAmount($finalcredit);
					$currentfinal->save(); 
					
				}
				else
				{
						$finalcredit = new ExpertsFinalCredit();
						$finalcredit->setExpertId($this->e_id);
						$finalcredit->setAmount($amount);
						$finalcredit->save(); 
				}
				
		}
		
 }
 
  public function executeChat() { 

	if(empty($_COOKIE["popupopen"])) :
			$this->redirect("dashboard/popuperror");
	endif;

  
  			$this->type= $this->getUser()->getRaykuUser()->getType() ;
				
			$c=new Criteria();
			$c->add(ChatUserPeer::USER_NAME,$this->getUser()->getRaykuUser()->getUsername());
			$this->chatuser=ChatUserPeer::doSelectOne($c); 
			
			if($this->chatuser == NULL) 
			{
				
				if($this->getUser()->getRaykuUser()->getType() == '1' ) 
				{
					$c1=new ChatUser();
					$c1->setUserName($this->getUser()->getRaykuUser()->getUsername());
					$c1->setStatus(0);
					$c1->save();
				}
				elseif($this->getUser()->getRaykuUser()->getType() == '5')
				{
				
					$c1=new ChatUser();
					$c1->setUserName($this->getUser()->getRaykuUser()->getUsername());
					$c1->setStatus(1);
					$c1->save();
				
				}
				
				
			}
			
					
		if($this->getUser()->getRaykuUser()->getType() == '1')
		{
		
			$c=new Criteria();
			$c->add(UserPeer::ID,$this->getRequestParameter('ex_id'));
			$this->expert=UserPeer::doSelectOne($c); 
		
			$this->student = $this->getUser()->getRaykuUser()->getUsername();
			$this->experty = $this->expert->getUsername();
			$this->minutes = $this->getRequestParameter('min');
			
			
			$c=new Criteria();
			$c->add(ChatDetailPeer::USER,$this->getUser()->getRaykuUser()->getUsername());
			$c->add(ChatDetailPeer::EXPERT,$this->expert->getUsername());
			$this->details=ChatDetailPeer::doSelectOne($c);
			
			
			if($this->details == NULL) {
			
				$c1=new ChatDetail();
				$c1->setUser($this->getUser()->getRaykuUser()->getUsername());
				$c1->setExpert($this->expert->getUsername()); 
				$c1->setMinutes($this->getRequestParameter('min')); 
				$c1->save();
			
			} 
			else
			{
				$this->details->setMinutes($this->getRequestParameter('min')); 
				$this->details->setExpertAgreed(0); 
				$this->details->save();
					
			}  
			
			
				
		}	
		
  
  
  }
 
  public function executeSave() {

	if(empty($_COOKIE["popupopen"])) :
			$this->redirect("dashboard/popuperror");
	endif;

  
  			sfProjectConfiguration::getActive()->loadHelpers('Partial');
	
	
			if($this->getUser()->getRaykuUser()->getType() == '1')
			{
					$cht_txt_box = $this->getRequestParameter('cht_txt_box');
					$status = $this->getRequestParameter('status');
					$username= $this->getRequestParameter('username');
					$expert= $this->getRequestParameter('expert'); 
					$current_user = $this->getUser()->getRaykuUser()->getUsername();
					
					
					return $this->renderText(get_partial('save', array('cht_txt_box' => $cht_txt_box , 'status' => $status, 'type' => 'chat', 'username' => $username, 'expert' => $expert,'current_user' =>$current_user )));
					
			}
			elseif($this->getUser()->getRaykuUser()->getType() == '5')
			{
			
							
					$to= $this->getRequestParameter('to');
					$status = $this->getRequestParameter('status');
					$cht_txt_box = $this->getRequestParameter('cht_txt_box_'.$to);
					$expert= $this->getRequestParameter('expert');
					
					return $this->renderText(get_partial('save', array('cht_txt_box' => $cht_txt_box , 'status' => $status, 'type' => 'expchat', 'to' => $to, 'expert' => $expert,'current_user' =>$current_user)));
					
			
			}
	
		  
  } 
  
   public function executeClose() {

	if(empty($_COOKIE["popupopen"])) :
			$this->redirect("dashboard/popuperror");
	endif;
   
		
		 echo $this->type = $this->getRequestParameter('type');
				
		 $this->user= $this->getUser()->getRaykuUser()->getUsername();  
		 
		 
		 
		 		
   }
   
   public function executeTimer() { 

	if(empty($_COOKIE["popupopen"])) :
			$this->redirect("dashboard/popuperror");
	endif;
	
	    $countto= $this->getRequestParameter('countto');
		
		$temp=explode(' ',$countto);
		$d = explode('-',$temp[0]);
		$t= explode(':',$temp[1]);
		
		$scheduleddate = date('Y-m-d H:i:s', mktime($t[0],$t[1],$t[2],$d[1],$d[2],$d[0]));
		
		$countdown_to = trim($scheduleddate); 
		
		$count_from = date("Y-m-d H:i:s"); 
				
		echo $diff = $this->datediff("s", $count_from, $countdown_to);  
		
	}
	
	private function datediff($interval, $datefrom, $dateto, $using_timestamps = false) 
	{
	 
		 	if (!$using_timestamps) {
				$datefrom = strtotime($datefrom, 0);
				$dateto = strtotime($dateto, 0);
  			}
			
  			$difference = $dateto - $datefrom; // Difference in seconds
   
  			switch($interval) {
   
    			case 'yyyy': // Number of full years

							  $years_difference = floor($difference / 31536000);
							  if (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom), date("j", $datefrom), date("Y", $datefrom)+$years_difference) > $dateto) {
								$years_difference--;
							  }
							  if (mktime(date("H", $dateto), date("i", $dateto), date("s", $dateto), date("n", $dateto), date("j", $dateto), date("Y", $dateto)-($years_difference+1)) > $datefrom) {
								$years_difference++;
							  }
							  $datediff = $years_difference;
							  break;

    			case "q": // Number of full quarters

							  $quarters_difference = floor($difference / 8035200);
							  while (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom)+($quarters_difference*3), date("j", $dateto), date("Y", $datefrom)) < $dateto) {
								$months_difference++;
							  }
							  $quarters_difference--;
							  $datediff = $quarters_difference;
							  break;

    			case "m": // Number of full months

							  $months_difference = floor($difference / 2678400);
							  while (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom)+($months_difference), date("j", $dateto), date("Y", $datefrom)) < $dateto) {
								$months_difference++;
							  }
							  $months_difference--;
							  $datediff = $months_difference;
							  break;

   				case 'y': // Difference between day numbers

							  $datediff = date("z", $dateto) - date("z", $datefrom);
							  break;

    			case "d": // Number of full days

							  $datediff = floor($difference / 86400);
							  break;

    			case "w": // Number of full weekdays

							  $days_difference = floor($difference / 86400);
							  $weeks_difference = floor($days_difference / 7); // Complete weeks
							  $first_day = date("w", $datefrom);
							  $days_remainder = floor($days_difference % 7);
							  $odd_days = $first_day + $days_remainder; // Do we have a Saturday or Sunday in the remainder?
							  if ($odd_days > 7) { // Sunday
								$days_remainder--;
							  }
							  if ($odd_days > 6) { // Saturday
								$days_remainder--;
							  }
							  $datediff = ($weeks_difference * 5) + $days_remainder;
							  break;

    			case "ww": // Number of full weeks

							  $datediff = floor($difference / 604800);
							  break;

    			case "h": // Number of full hours

							  $datediff = floor($difference / 3600);
							  break;

    			case "n": // Number of full minutes

							  $datediff = floor($difference / 60);
							  break;

    			default: // Number of full seconds (default)

							  $datediff = $difference;
							  break;
  			}    

  			return $datediff;
	}

   
   public function executeOnload() {

	if(empty($_COOKIE["popupopen"])) :
			$this->redirect("dashboard/popuperror");
	endif;
   				
								
					$c=new Criteria();
					$c->add(ChatUserPeer::USER_NAME,$this->getUser()->getRaykuUser()->getUsername());
					$this->chatuser=ChatUserPeer::doSelectOne($c);   
					
					 echo $this->chatuser->getStatus()."$";
					
					if($this->chatuser->getStatus() == '0')
					{
																		
							 $c=new Criteria();
							 $s = $c->getNewCriterion(ChatDataPeer::EXPERT_NAME,$this->getUser()->getRaykuUser()->getUsername());
							 $s->addOr($c->getNewCriterion(ChatDataPeer::USER_NAME,$this->getUser()->getRaykuUser()->getUsername()));
							 $c->add($s); 
							 $c->add(ChatDataPeer::FLAG,0);
							 $chatusers=ChatDataPeer::doSelect($c);
							
							 if($chatusers!= NULL)
							  {
									 foreach($chatusers as $chatuser)
									 {
									 		 $expim = explode("/",$chatuser->getText());
											 
											 if($expim[0] == "smileys")
											 { 
											  	$val = '<img src="http://'.RaykuCommon::getCurrentHttpDomain().'/'.$chatuser->getText().'" />';
												
												
												
											 }else 
											 { 
											  	$val = $chatuser->getText(); 
											 }
											  ?>
												
												<div style=" font-size:12px;"> <label style="color: #000000;"><b><?php echo $chatuser->getUserName(); ?> : </b></label><label style="color: #2D2D2D;"> <?php echo $val; ?></label></div>
												
										<?php 
										}
							}
							else
							{
							   echo "fail";
							}
							
					}
					if($this->chatuser->getStatus() == "1") 
					{
							 							  
							  $c= new Criteria();
							  $c->add(ChatDetailPeer::EXPERT,$this->getUser()->getRaykuUser()->getUsername());
							  $chatdetails=ChatDetailPeer::doSelect($c);
							  
							  foreach($chatdetails as $chatdetail)
							  {
							  
										$user = $chatdetail->getUser(); 
																		
									 	 $c=new Criteria();
										 $s = $c->getNewCriterion(ChatDataPeer::EXPERT_NAME,$this->getUser()->getRaykuUser()->getUsername());
										 $s->addOr($c->getNewCriterion(ChatDataPeer::USER_NAME,$this->getUser()->getRaykuUser()->getUsername()));
										 $c->add($s); 
										 $c->add(ChatDataPeer::FLAG,0);
										 $chatdatas=ChatDataPeer::doSelect($c);
										
										
										foreach($chatdatas as  $chatdata)
										{
												$expim = explode("/",$chatdata->getText());
												
										  		if($expim[0] == "smileys")
											    { 
													$val = '<img src="http://'.RaykuCommon::getCurrentHttpDomain().'/'.$chatdata->getText().'" />';
											    }else 
											    { 
													$val = $chatdata->getText(); 
											    }	
												?>									   																
													
													
													
													<div style=" font-size:12px;"> <label style="color: #000000;"><b><?php echo $chatdata->getUserName(); ?> : </b></label><label style="color: #2D2D2D;"> <?php echo $val; ?></label></div>
													
									 			<?php 
										}
										
										echo "|@&".$user."-@&";
							  }
					}
			
	}
	
	
	public function executeChathistory()
	{
	 
	 			if($this->getUser()->getRaykuUser()->getType() == '1')
				{
					$c= new Criteria();
					$c->add(ChatHistoryPeer::USER_NAME,$this->getUser()->getRaykuUser()->getUsername());
					$this->chathistoriesstudent=ChatHistoryPeer::doSelect($c); 
				}
				elseif($this->getUser()->getRaykuUser()->getType() == '5')
				{
					$c= new Criteria();
					$c->add(ChatHistoryPeer::EXPERT_NAME,$this->getUser()->getRaykuUser()->getUsername());
					$this->chathistoriesexpert=ChatHistoryPeer::doSelect($c); 
				}
	
	}
	
	public function executeChatdeatils() 
	{
			   
			    $this->chatid= $this->getRequestParameter('id') ;
			   
			    $c= new Criteria();
				$c->add(ChatHistoryPeer::ID,$this->getRequestParameter('id'));
				$this->chatdetails=ChatHistoryPeer::doSelectOne($c);
	
	}
	
	public function executeAskanexpert()
	{
	
			
			$c=new Criteria();
			$c->add(ChatDetailPeer::USER,$this->getRequestParameter('student'));
			$c->add(ChatDetailPeer::EXPERT,$this->getRequestParameter('experty'));
			$this->details=ChatDetailPeer::doSelectOne($c);	 
			
			$this->details->setUserAsk(1);
			$this->details->save(); 
			
			
			$chat = new ChatData();
			$chat->setUserName($this->getRequestParameter('student')); 
			$chat->setExpertName($this->getRequestParameter('experty'));
			$chat->setText($this->getRequestParameter('qn'));
			$chat->setTime(date('Y-m-d H:i:s'));
			$chat->setFlag(1);
			$chat->save();  
			
	}
	
	public function executeCheckagree() {
	
			$c=new Criteria();
			$c->add(ChatDetailPeer::EXPERT,$this->getUser()->getRaykuUser()->getUsername());
			$c->add(ChatDetailPeer::USER_ASK,1);
			$c->add(ChatDetailPeer::EXPERT_AGREED,0);
			$c->addDescendingOrderByColumn(ChatDetailPeer::ID);
			$this->details=ChatDetailPeer::doSelectOne($c);	 
		
			
			if($this->details->getUser() != NULL)
			{
			
					$c=new Criteria();
					$c->add(ChatDataPeer::EXPERT_NAME,$this->getUser()->getRaykuUser()->getUsername());
					$c->add(ChatDataPeer::FLAG,1);
					$c->addDescendingOrderByColumn(ID);
					$this->chatdata=ChatDataPeer::doSelectOne($c);	 
					
					echo $this->details->getUser().'@qns@'.$this->chatdata->getText();  
					
			}
	
	}
	
	public function executeExpertagree() {
	
		    $c=new Criteria();
			$c->add(ChatDetailPeer::USER,$this->getRequestParameter('student'));
			$c->add(ChatDetailPeer::USER_ASK,1);
			$c->add(ChatDetailPeer::EXPERT_AGREED,0);
			$c->addDescendingOrderByColumn(ChatDetailPeer::ID);
			$this->details=ChatDetailPeer::doSelectOne($c);	 
			
			if($this->details !=NULL)
			{
			
				$this->details->setExpertAgreed(1);
				$this->details->save();   
				
				
				$c=new Criteria();
				$c->add(ChatDataPeer::USER_NAME,$this->getRequestParameter('student'));
				$c->add(ChatDataPeer::EXPERT_NAME,$this->getUser()->getRaykuUser()->getUsername());
				$c->add(ChatDataPeer::FLAG,1);  
				$this->chatqn = ChatDataPeer :: doSelectOne($c); 
				
				$this->chatqn->setFlag(0);
				$this->chatqn->save();
				
				echo 'start'.':@&:'.$this->getRequestParameter('student').':&@:'; 
			}
	
	
	}
	
	public function executeExpertdisagree() {
	
		    $c=new Criteria();
			$c->add(ChatDetailPeer::USER,$this->getRequestParameter('student'));
			$c->add(ChatDetailPeer::USER_ASK,1);
			$c->add(ChatDetailPeer::EXPERT_AGREED,0);
			$c->addDescendingOrderByColumn(ChatDetailPeer::ID);
			$this->details=ChatDetailPeer::doSelectOne($c);	 

			 $this->details->setExpertAgreed(2);
			 $this->details->save();  
	}
	
	public function executeStartchat() {
	
		    $c=new Criteria();
			$c->add(ChatDetailPeer::USER,$this->getUser()->getRaykuUser()->getUsername());
			$c->add(ChatDetailPeer::USER_ASK,1);
			$c->add(ChatDetailPeer::EXPERT_AGREED,1);
			$c->addDescendingOrderByColumn(ChatDetailPeer::ID);
			$this->details=ChatDetailPeer::doSelectOne($c);	
			
			if($this->details != NULL) 
			{
				 echo 'agreed'; 
			}
			
			$c=new Criteria();
			$c->add(ChatDetailPeer::USER,$this->getUser()->getRaykuUser()->getUsername());
			$c->add(ChatDetailPeer::USER_ASK,1);
			$c->add(ChatDetailPeer::EXPERT_AGREED,2);
			$c->addDescendingOrderByColumn(ChatDetailPeer::ID);
			$this->details=ChatDetailPeer::doSelectOne($c);	
			
			if($this->details != NULL) 
			{
				 echo 'disagreed'; 
			}
			
	
	}


}
