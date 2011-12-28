<?php use_helper('Javascript', 'MyForm') ?>

<div class="body-main">
  <div id="what-is">
    <div style="width:30px;float:left;"> <img height="25" width="42" alt="" src="/images/green_arrow.jpg"/> </div>
    <p style="font-size:16px;color:rgb(28, 81, 124);font-weight:bold;margin:0 0 32px 55px;"> <?php echo link_to('Private Messages', '@inbox',array('style'=>'color:#069')); ?> > New Message </p>
  </div>
  <div id="msgnav"> <?php echo link_to('Inbox', '@inbox',array('id'=>'inbox')); ?> <?php echo link_to('Sent Messages', '@outbox',array('id'=>'sent')); ?> <?php echo link_to('Compose New Message', 'message/compose',array('id'=>'new','class'=>"active")); ?>
    <div class="clear-both"></div>
  </div>
  <div class="box">
    <div class="top"></div>
    <div class="content"> <?php echo form_tag('message/send') ?>
      <div class="entry">
        <div class="ttle">To (username):</div>
        <div> <?php echo input_auto_complete_tag('name', $to, 'friends/autocomplete', array(), array('use_style' => true)); ?> <?php echo form_error('name'); ?>
          <div class="availableb">Type a username, or select a friend to PM.</div>
        </div>
      </div>
      <div class="entry">
        <div class="ttle">Message Subject:</div>
        <?php echo input_tag('subject', $sf_params->get('subject', '')); ?> <?php echo form_error('subject'); ?> </div>
      <div class="entry">
        <div class="ttle">Message:</div>
        <div class="spacer"></div>
        <div style="position:relative; width:610px; height:300px;"> <input type="text" id="content" name="body" value="" style="display:none" /><input type="text" id="content___Config" value="" style="display:none" /><iframe id="content___Frame" src="/js/fckeditor/editor/fckeditor.html?InstanceName=content&amp;Toolbar=Basic" width="600px" height="300px" frameborder="0" scrolling="no"></iframe> </div>
        
      </div>
      <?php echo submit_tag('Send this private message',array('class'=>'button')); ?>
      <div class="spacer"></div>
      </form>
    </div>
    <div class="spacer"></div>
    <div class="bottom"></div>
  </div>
  <br class="clear" />
</div>
<?php include_partial('message/rightSideBlock', array('friends' => $friends)); ?>
