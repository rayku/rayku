<?php use_helper('MyAvatar'); ?>
<div class="box">
<div class="top"></div>
<div class="content">
<div class="users">
<?php foreach($friends as $friend): ?>                                
     <div class="user">
     <?php if($friend->getPicture()!=''): ?>
     <?php echo avatar_tag_for_user($friend); ?>
     <?php else: ?>
     <img src="<?php echo image_path('dev/emptyprofile-small.gif', false); ?>" alt="" />
     <?php endif; ?>
     <div>
     <?php echo link_to($friend, '@compose_to?nickname=' . $friend->getUsername(),array('class'=>'usrname')); ?>
     <p class="pnts"><span style="font-weight:normal"><?php echo $friend->getPoints();?>RP</span></p>
     </div>
     <div class="spacer"></div>
      </div>
<?php endforeach; ?>
                             
</div>
</div>
<div class="spacer"></div>
<div class="bottom"></div>
</div>


