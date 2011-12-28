<?php use_helper('MyText') ?>
<!--
<?php use_helper('Debug') ?>
<?php debug_message($message) ?>-->
   
<div id="top" style="margin-left:16px;padding-top:2px">
  <div style="width:30px; float:left;"><img height="25" width="42" src="/images/green_arrow.jpg"/></div>
    <div style="font-size:16px; color:#1C517C; font-weight:bold; margin-left:25px; padding-top:3px;float:left">Gallery Home</div>
  <div class="spacer"></div>
</div>
<div class="body-main">
  <?php if (count($galleries) > 0) { ?>
  <div class="box">
    <div class="top"></div>
    <div class="mediacount">
      <p id="galleryname"><?php echo $owner ?>'s Gallery</p>
      <p id="albumcount">Contains <?php echo count($galleries) . ' ' . pluralise(count($galleries), 'Album'); ?></p>
      <div class="spacer"></div>
    </div>
    <?php
      foreach ($galleries as $gallery)
        include_partial( 'album_preview', array( 'gallery' => $gallery ) );
      ?>
    <div class="spacer"></div>
    <div class="bottom"></div>
  </div>
  <?php } else { ?>
  <div class="box">
    <div class="top"></div>
    <div class="content" style="padding-bottom:2px;float:left;">
      <div class="title" style="float:left;width:100%;text-align:left;">Oops! There aren't any albums available yet.</div>
      <div class="subtitle" style="float:left;width:100%;text-align:left;">Why not create one?</div>
      <?php echo link_to('Create album', '@gallery_create',array('style'=>'background:url(/images/ico/green-plus.jpg) no-repeat 14px 14px;float:left;text-align:left;','class'=>'nhp nladd')) ?>
      <div class="spacer"></div>
    </div>
    <div class="spacer"></div>
    <div class="bottom"></div>
  </div>
  <?php } ?>
</div>
<div class="body-side">
<?php if($owner == $sf_user->getRaykuUser()): ?>
<a href="/gallery/new" class="navlink add">Create album</a>
<?php endif; ?>
<a href="/profile/<?php echo $owner->getusername() ?>" class="navlink back">Back to <?php echo $owner ?>'s Profile</a> 
</div>
