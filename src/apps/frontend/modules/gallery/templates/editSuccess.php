<?php use_helper('MyForm', 'MyAclView', 'Javascript') ?>

<?php echo acl_javascript() ?>

<div id="top" style="margin-left:16px;padding-top:2px">
  <div style="width:30px; float:left;"><img height="25" width="42" src="/images/green_arrow.jpg"/></div>
    <div style="font-size:16px; color:#1C517C; font-weight:bold; margin-left:25px; padding-top:3px;float:left"><a href="/gallery/list/<?php echo $sf_user->getRaykuUser()->getId() ?>">Gallery Home</a> > <a href="/gallery/show/<?php echo htmlentities($gallery->getId()) ?>">Album "<?php echo htmlentities($gallery->getTitle()) ?>"</a> > Edit Album</div>
    <div class="spacer"></div>
</div>

<div class="body-main">
<div class="box">
	<div class="top"></div>
	<div class="content">
	  <?php echo form_tag('@gallery_edit?id=' . $gallery->getId()) ?>
        <div class="entry">
           	<div class="ttle">Album Title:</div>
               <div style="clear:left">
               	<?php echo input_tag('title', $gallery->getTitle()); ?>
                <?php echo form_error('title'); ?>
               </div>
         </div>
        <div class="entry">
          <div class="ttle">Make Visible to:</div>

          <div style="clear:left">
            <?php
              echo select_tag(
                      'gallery[type]',
                      options_for_select(
                              Gallery::getTypes(),
                              $gallery->getShowEntity()));
            ?>
           </div>
        </div>   
      <?php echo submit_tag('Save',array('class'=>'button-sm','style'=>'margin-top:2px;')); ?>
    </form>
    </div>
 <div class="spacer"></div>
<div class="bottom"></div>
</div>
</div>
<div class="body-side">
<a href="/gallery/show/<?php echo htmlentities($gallery->getId()) ?>" class="navlink back">Back to Album</a>
</div>
