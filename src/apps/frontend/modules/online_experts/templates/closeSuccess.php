<?php

          
		 
		 $res = '';
				 
		 $c=new Criteria();
		 $s = $c->getNewCriterion(ChatDataPeer::EXPERT_NAME, $user);
		 $s->addOr($c->getNewCriterion(ChatDataPeer::USER_NAME,$user));
		 $c->add($s); 
		 $chatdatas=ChatDataPeer::doSelect($c);
			 
		  foreach($chatdatas as $chatdata)
		  {
		  		$text[] = $chatdata->getUserName()." :u: ".$chatdata->getText()." :d: ".$chatdata->getTime();
		   		
				$res = implode(" /n ",$text);
		  }
		 
		  if($res != NULL )
		  {
			   
			   
			   $c= new Criteria();
			   $c->add(ChatDetailPeer::USER, $user);
			   $c->addDescendingOrderByColumn(ChatDetailPeer::ID);
			   $c->setLimit(1);
			   $details=ChatDetailPeer::doSelectOne($c);
			   
			   
			   $chat_history = new ChatHistory();
			   $chat_history->setUserName($user);
			   $chat_history->setExpertName($details->getExpert());
			   $chat_history->setText($res);
			   $chat_history->setTime(date('Y-m-d H:i:s'));
			   $chat_history->save();
			   
		  }
		  
		  foreach($chatdatas as $chatdata)
		  {
		  		$chatdata->delete();
		  }  
		
		
		 if($type == 'main')
		 {
		 			
		 		    $c=new Criteria();
				    $c->add(ChatDetailPeer::USER,$user);
				    $details=ChatDetailPeer::doSelect($c); 
					
					foreach($details as $detail)
					{
							$detail->delete();
					}  	  			  
		 }
		 else 
		 {
		 		  $temp = explode('_',$type);
				  $student= $temp[1];
				  
				  $c=new Criteria();
				  $c->add(ChatDetailPeer::EXPERT, $user);
				  $c->add(ChatDetailPeer::USER,$student);
				  $details=ChatDetailPeer::doSelect($c); 
				  
				  
				  	 foreach($details as $detail)
					  {
							$detail->delete();
					  }  	
		 
		 }
		 
		
		  
		  
		  
		  
	 		  
?>