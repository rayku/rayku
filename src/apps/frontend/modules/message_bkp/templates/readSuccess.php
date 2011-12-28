<?php use_helper('MyAvatar'); ?>

<div id="top">
  <div class="title"> <img src="/images/arrow-right.gif" alt="" />
    <p><a href="/message">Private Messages</a> > <?php echo $message->getSubject(); ?></p>
  </div>
  <div class="spacer"></div>
</div>
<div class="body-main">
  <div class="box">
    <div class="top"></div>
    <div class="content">
      <div class="title">Sent By:</div>
      <div class="recdate">Received at <?php echo $message->getCreatedAt('H:i'); ?></div>
      <div class="spacer"></div>
      <div class="user2">
        <?php
          if($message->getSender()->getPicture()!='')
           echo avatar_tag_for_user($message->getSender());
          else
           echo image_tag('/images/dev/emptyprofile-small.gif', array('alt' => 'avatar'));

          echo link_to($message->getSender()->getName(), '@profile?username='.$message->getSender()->getUsername(), array('class'=>'usrname'));
        ?>
        <p class="pnts">Points: <?php echo $message->getSender()->getPoints();?></p>
        <p class="awrds">Awards: <?php echo $message->getSender()->getCountUserAward();?></p>
      </div>
      <div class="spacer"></div>
      <div class="title">Message:</div>
      <div class="spacer"></div>
      <p class="msg" style="border-top:1px solid #EBEBEB; padding-top:15px; margin-top:10px;font-size:14px">
        <?php

        $kinkarsoUser = UserPeer::getByUsername(RaykuCommon::SITE_USER_USERNAME);
     
	    if( $kinkarsoUser && $kinkarsoUser->getId() == $message->getSenderId() )
        {
          echo $message->getBody();
        } else {
          echo $message->getBody();
        }

        ?>
      </p>
    </div>
    <div class="spacer"></div>
    <div class="bottom"></div>
  </div>
  <div style="float:right;"> <a href="/message/compose/<?php echo $message->getSender()->getUsername();?>/subject/Re: <?php echo $message->getSubject(); ?>" style="width: 81px; height: 35px; float: left;margin-right:5px;" id="reply"></a> <a href="/message/delete/id/<?php echo $message->getId();?>" style="width: 81px; height: 35px; float: left;" id="delete"></a> </div>
</div>
<?php include_partial('message/rightSideBlock', array('friends' => $friends)); ?>
