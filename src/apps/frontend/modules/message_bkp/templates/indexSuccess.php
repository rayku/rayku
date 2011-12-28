<div id="top">
    <div class="title">
    <img src="images/arrow-right.gif" alt="" />
    <p>Private Messages</p>
    </div>
    <div class="spacer"></div>
</div>

<div class="body-main">
  <div id="msgnav">
    <?php echo link_to('Inbox', '@inbox',array('id'=>'inbox','class'=>"active")); ?>
    <?php echo link_to('Send Messages', '@outbox',array('id'=>'sent')); ?>
    <?php echo link_to('Compose new message', 'message/compose',array('id'=>'new')); ?>
    <div class="clear-both"></div>
  </div>
</div>
