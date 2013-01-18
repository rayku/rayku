<?php use_helper('Javascript') ?>
<?php
if (!isset($linkText) || '' === $linkText): ?>
<?php $linkText = (empty($threadID) ? 'Start a new thread' : 'Reply to this thread') ?>
<?php endif ?>

<div id="status"></div>
<p id="activate_form"> <?php echo link_to_function( $linkText,
                               visual_effect('toggle_blind', 'postForm') . visual_effect('toggle_blind', 'activate_form'),
                               array('id' => 'postLink', 'class'=> 'navlink add') ); ?> </p>
<div class="box" id="postForm" style="display:none;">
  <div class="top"></div>
  <div class="content"> <?php echo form_remote_tag(array('url' => '@make_post', 'update' => 'status', 'complete' => 'window.location.reload()')) ?>
    <?php if (empty($threadID)): ?>
    <?php echo input_hidden_tag('forum_id', $forumID) ?>
    <div class="expert"><strong>Topic:</strong></div>
    <div class="spacer"></div>
    <?php echo input_tag('thread_title','', 'size=30' ) ?>
    <?php else: ?>
    <?php echo input_hidden_tag('thread_id', $threadID) ?>
    <?php endif ?>
    <div class="expert"><strong>Post:</strong></div>
    <div class="spacer"></div>
    <?php echo textarea_tag('post_body', '', array('style' => 'height: 130px; width: 100%;')) ?>
    <div class="spacer"></div>
    <?php if (empty($threadID)): ?>
    <?php
            $c=new Criteria();
            $categories=CategoryPeer::doSelect($c);
          ?>
    <div class="expert"><strong>Select category :</strong></div>
    <div class="spacer"></div>
    <select name="category_id">
      <?php foreach($categories as $categorie): ?>
      <option value="<?=$categorie->getId();?>">
      <?=$categorie->getName();?>
      </option>
      <?php endforeach; ?>
    </select>
    <?php if($sf_user->getRaykuUser()->getType() == 1) :  ?>
    <div class="expert"><strong>Add school grade:</strong></div>
    <div class="spacer"></div>
    <input type="text" name="school_grade" value="" size="35" />
    <?php endif; ?>
    <div class="expert"><strong>Add Meta tags :</strong></div>
    <div class="spacer"></div>
    <input type="text" name="tags" value="" size="35" />
    <label style="color:#999999; font-size:10px;"><b>(Separate the tags with comma)</b></label>
    <div class="spacer"></div>
    <div class="expert"><strong>Notify when expert responds:</strong></div>
    <div class="spacer"></div>
    <input type="checkbox" name="notify_pm" value="1" checked="checked" />
    <strong>PM</strong>
    <div class="spacer"></div>
    <input type="checkbox" name="notify_email" value="1" />
    <strong> Email</strong> 
    
    <!--<div class="spacer"></div>
          <input type="checkbox" name="notify_sms" value="1" checked="checked" /><strong>SMS</strong> &nbsp;&nbsp;Enter cell number <input type="text" name="cell_number" value=""/>-->
    <div class="spacer"></div>
    <?php endif ; ?>
    <?php echo submit_tag('Post',array('class'=>'blue')) ?> <?php echo link_to_function('Cancel', visual_effect('toggle_blind', 'postForm') . visual_effect('toggle_blind', 'activate_form'), array('id' => 'postLink','class' => 'blue', 'style'=>'margin-right:10px; line-height:38px;')) ?>
    <div class="spacer"></div>
    </form>
  </div>
  <div class="spacer"></div>
  <div class="bottom"></div>
</div>
<!-- end of box --> 

