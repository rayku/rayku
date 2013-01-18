<?php use_helper('Javascript'); ?>
<div class="entry" id="message<?php echo $message->getId(); ?>">
 <input type="checkbox" id="PM_Check[<?php echo $count_msgs;?>]" name="PM_Check[]" value="<?php echo $message->getId() ?>" style="width:20px"> 

  <div class="container">
    <?php echo link_to($message->getRecipient()->getName(), '@profile?username='.$message->getRecipient()->getUsername(),array('class'=>'author')); ?>
    <div class="date"><?php echo $message->getFormattedDate(); ?></div>
  </div>

  <div class="desc">
    <?php echo link_to($message->getSubject(), 'message/read?id='.$message->getId()); ?>
  </div>

  <form method="post" id="formDeleteMessage" action="/message/delete/id/<?php echo $message->getId() ?>" onsubmit="new Ajax.Request('/message/delete/id/<?php echo $message->getId() ?>', {asynchronous:true, evalScripts:false, onComplete:function(request, json){new Effect.Fade('message<?php echo $message->getId() ?>', {});}, parameters:Form.serialize(this)}); return false;">
    <a class="delete" onclick="$('formDeleteMessage').submit()"></a>
  </form>

</div><!-- end of entry -->
