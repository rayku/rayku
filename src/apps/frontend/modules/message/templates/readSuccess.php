<?php //use_helper('MyAvatar'); ?>
<?php use_helper('MyAvatar', 'Javascript') ?>


<div class="body-main">
  <div id="what-is">
    <div style="width:30px;float:left;"> <img height="25" width="42" alt="" src="<?php echo image_path('green_arrow.jpg', false); ?>"/> </div>
    <p style="font-size:16px;color:rgb(28, 81, 124);font-weight:bold;margin:0 0 32px 55px;"> <?php echo link_to('Private Messages', '@inbox',array('style'=>'color:#069')); ?> > "<?php echo $message->getSubject(); ?>"</p>
  </div>
  <div class="box">
    <div class="top"></div>
    <div class="content">
      <div class="title">Sent From:</div>
      <div class="recdate">Received on <?php echo $message->getFormattedDate(); ?> at <?php echo $message->getCreatedAt('H:i'); ?></div>
      <div class="spacer"></div>
      <div class="user2">
        <?php
		//1645
				
		$c = new Criteria();
		
		$c->add(UserPeer::ID, $message->getSender()->getId());
		
		$_Sender = UserPeer::doSelectOne($c);
		
		//print_r($message); echo link_to( avatar_tag_for_user($message->getSender()), '@profile?username=' . $message->getSender()->getUsername() ); 

          if($_Sender->getUsername()!='')
		  
		  echo link_to( avatar_tag_for_user($_Sender), '@profile?username=' . $_Sender->getUsername() ); 		   
		
          else
		  
           echo image_tag('/images/dev/emptyprofile-small.gif', array('alt' => 'avatar'));
		   
		   

if($message->getSender()->getType() == 5): ?>

<img src="http://www.rayku.com/images/expert_saved.png" />

<?php endif; ?>

 <?php  echo link_to($message->getSender()->getName(), '@profile?username='.$message->getSender()->getUsername(), array('class'=>'usrname')); ?><br/><br/>

        <p class="awrds" style="line-height:16px">NOTE: *The contents of this message is confidential and should<br />
          not be duplicated without the expressed permission of sender*</p>
      </div>
      <div class="spacer" style="border-top:1px solid #DDD;margin-bottom:15px;"></div>
      <div class="title">Message:</div>
      <div class="spacer"></div>
      <div class="msg">
        <?php

        $kinkarsoUser = UserPeer::getByUsername(RaykuCommon::SITE_USER_USERNAME);
     
	    if( $kinkarsoUser && $kinkarsoUser->getId() == $message->getSenderId() )
        {
          echo $message->getBody();
        } else {
          echo $message->getBody();
        }

        ?>
      </div>
    </div>
    <div class="spacer"></div>
    <div class="bottom"></div>
  </div>
  <div style="float:right;"> <a href="/message/compose/<?php echo $message->getSender()->getUsername();?>/subject/Re: <?php echo $message->getSubject(); ?>" style="width: 81px; height: 35px; float: left;margin-right:5px;" id="reply"></a> <a href="/message/delete/id/<?php echo $message->getId();?>" style="width: 81px; height: 35px; float: left;" id="delete"></a> </div>
</div>
<?php include_partial('message/rightSideBlock', array('friends' => $friends)); ?>
