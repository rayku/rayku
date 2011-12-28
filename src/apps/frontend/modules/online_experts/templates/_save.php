<?php
error_reporting(E_ALL);
ini_set('display_errors',1);

if($type == 'chat') 
{
	
	 $value = $cht_txt_box;	
	
	 $exp = explode("-",$value); 
	 
	 if($value[0] == '-')
	 {
	  	$value = "smileys/".$exp[1].".gif ";
	 }
 
	 if($status != "display")
	 {
			 $chat_date = new ChatData();
			 $chat_date->setUserName($username);
			 $chat_date->setExpertName($expert);
			 $chat_date->setText($value);
			 $chat_date->setTime(date('Y-m-d H:i:s'));
			 $chat_date->save();
			
	 }
	 

	 $c=new Criteria();
	 $s = $c->getNewCriterion(ChatDataPeer::EXPERT_NAME,$current_user);
	 $s->addOr($c->getNewCriterion(ChatDataPeer::USER_NAME,$current_user));
	 $c->add($s); 
	 $chatdatas=ChatDataPeer::doSelect($c);
	 
	foreach($chatdatas as $chatdata)
	{
			
			$expim = explode("/",$chatdata->getText());
			if($expim[0] == "smileys")
			{ 
				$val = '<img src="http://'.RaykuCommon::getCurrentHttpDomain().'/'.$chatdata->getText().'" />';
			}
			else 
			{ 
				$val = $chatdata->getText(); 
			}
			?>
			<div style=" font-size:12px;"> <label style="color: #000000;"><b><?php echo $chatdata->getUsername(); ?> : </b></label><label style="color: #2D2D2D;"> <?php echo $val; ?></label></div>
			<?php
 
	}

} 

if($type == 'expchat') 
{
	
			
		$value = $cht_txt_box;	
 		$exp = explode("-",$value); 
		
		if($value[0] == '-')
		{
			  $value = "smileys/".$exp[1].".gif ";
		}
		
		
		 $chat_date = new ChatData();
		 $chat_date->setUserName($expert);
		 $chat_date->setExpertName($to);
		 $chat_date->setText($value);
		 $chat_date->setTime(date('Y-m-d H:i:s'));
		 $chat_date->save();
		
		  $c=new Criteria();
		  $s = $c->getNewCriterion(ChatDataPeer::EXPERT_NAME,$current_user);
		  $s->addOr($c->getNewCriterion(ChatDataPeer::USER_NAME,$current_user));
		  $c->add($s); 
		  $chatdatas=ChatDataPeer::doSelect($c);
				
		 foreach($chatdatas as $chatdata)
		 {
				
				$expim = explode("/",$chatdata->getText());
				if($expim[0] == "smileys")
				{ 
					$val = '<img src="http://'.RaykuCommon::getCurrentHttpDomain().'/'.$chatdata->getText().'" />';
				}
				else 
				{ 
					$val = $chatdata->getText(); 
				}
				?>
				<div style=" font-size:12px;"> <label style="color: #000000;"><b><?php echo $chatdata->getUsername(); ?> : </b></label><label style="color: #2D2D2D;"> <?php echo $val; ?></label></div>
				<?php
	 
		}
		
		 
} 


?>