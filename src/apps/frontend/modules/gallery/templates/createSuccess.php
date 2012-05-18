<?php use_helper('Enum', 'MyForm', 'MyAclView', 'Javascript') ?>
<?php echo acl_javascript() ?>

<div id="top" style="margin-left:16px;padding-top:2px">
  <div style="width:30px; float:left;"><img height="25" width="42" src="<?php echo image_path('green_arrow.jpg', false); ?>"/></div>
    <div style="font-size:16px; color:#1C517C; font-weight:bold; margin-left:25px; padding-top:3px;float:left"><a href="/gallery/list/<?php echo $sf_user->getRaykuUser()->getId() ?>">Gallery Home</a> > Create New Album</div>
  <div class="spacer"></div>
</div>
<div class="body-main">
  <div class="box">
    <div class="top"></div>
    <div class="content"> <?php echo form_tag('@gallery_create') ?>
      <div class="entry">
        <div class="ttle">Album Title:</div>
        <div style="clear:left"> <?php echo input_tag('title'); ?> <?php echo form_error('title'); ?> </div>
      </div>
      <?php //echo form_row('title', input_tag('title')) ?>
      <div class="entry">
        <div class="ttle">Make Visible to:</div>
        <div style="clear:left">
          <?php
          echo select_tag(
                  'gallery[type]',
                  options_for_select(Gallery::getTypes()));
        ?>
        </div>
      </div>
      <?php echo acl_select_friends($friends) ?> <?php echo submit_tag('Create',array('class'=>'button-sm','style'=>'margin-top:2px;')); ?>
      <?php //echo form_row_no_label(submit_tag('Create')) ?>
      </form>
    </div>
    <div class="spacer"></div>
    <div class="bottom"></div>
  </div>
</div>
<div class="body-side">
<a href="/gallery/list/<?php echo $sf_user->getRaykuUser()->getId() ?>" class="navlink back">Back to Gallery</a>
</div>