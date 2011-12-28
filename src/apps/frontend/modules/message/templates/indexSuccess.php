<div class="body-main">
  <div id="what-is">
    <div style="width:30px;float:left;"> <img height="25" width="42" alt="" src="/images/green_arrow.jpg"/> </div>
    <p style="font-size:16px;color:rgb(28, 81, 124);font-weight:bold;margin:0 0 32px 55px;"> Private Messages </p>
  </div>
  <div id="msgnav"> <?php echo link_to('Inbox', '@inbox',array('id'=>'inbox','class'=>"active")); ?> <?php echo link_to('Send Messages', '@outbox',array('id'=>'sent')); ?> <?php echo link_to('Compose new message', 'message/compose',array('id'=>'new')); ?>
    <div class="clear-both"></div>
  </div>
</div>
