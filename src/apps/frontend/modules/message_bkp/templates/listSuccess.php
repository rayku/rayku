<div id="top">
    <div class="title">
    <img src="/images/arrow-right.gif" alt="" />
    <p>Private Messages</p>
    </div>
    <div class="spacer"></div>
</div>

<div class="body-main">
  <div id="msgnav">
    <?php

      if($messageRowPartialName == 'message_row_inbox')
      {
        echo link_to('Inbox', '@inbox',array('id'=>'inbox','class'=>"active"));
        echo link_to('Sent Messages', '@outbox',array('id'=>'sent'));
      }
      else
      {
        echo link_to('Inbox', '@inbox',array('id'=>'inbox'));
        echo link_to('Send Messages', '@outbox',array('id'=>'sent','class'=>"active"));
      }
   
      echo link_to('Compose new message', 'message/compose',array('id'=>'new'));
    ?>
    <div class="clear-both"></div>
  </div>

  <?php
    $messages = $raykuPager->getPager()->getResults();

    if( count( $messages ) > 0 )
    { 
      foreach($messages as $message)
      {
        include_partial($messageRowPartialName, array('message' => $message));
      }
    }
    else
      echo '<div align="center" style="font-size:18px">You have no messages</div>';
  ?>
    
  <div class="spacer" style="margin-bottom: 15px;"></div>
  <?php include_partial('global/pager', array('raykuPager' => $raykuPager)); ?>
</div>

<?php include_partial('message/rightSideBlock', array('friends' => !isset( $friends ) ? array() : $friends ) ); ?>
