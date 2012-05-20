<div class="body-main">
  <div id="what-is">
    <div style="width:30px;float:left;"> <img height="25" width="42" alt="" src="<?php echo image_path('green_arrow.jpg', false); ?>"/> </div>
    <p style="font-size:16px;color:rgb(28, 81, 124);font-weight:bold;margin:0 0 32px 55px;"> <?php echo link_to('Private Messages', '@inbox',array('style'=>'color:#069')); ?> > Delete Message </p>
  </div>
  <div style="font-size:16px;padding:10px;"> This message has been deleted. <?php echo link_to('Back to private messages', '@inbox',array('style'=>'color:#069;font-weight:bold')); ?>.</div>
</div>
