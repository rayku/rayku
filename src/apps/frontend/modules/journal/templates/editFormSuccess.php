<?php use_helper('Enum'); ?>
<?php use_helper('Validation'); ?>
<?php use_helper('Javascript'); ?>
<?php echo javascript_tag('
window.onload = function()
{
	$("journalentry_type").onchange = function()
	{
		if(this.value == '.JournalEntry::TYPE_SPECIFIC_PEOPLE_ONLY.')
		{
			'.visual_effect('BlindDown', 'friends').'
		}
		else
		{
			'.visual_effect('BlindUp', 'friends').'
		}
	}
}

'); ?>

<div id="top" style="margin-left:18px;padding-top:2px">
  <div class="title" style="float:left"> <img src="<?php echo image_path('arrow-right.gif', false); ?>" alt="" />
    <p style="font-size:16px; line-height:24px;color:#1C517C;font-weight:bold;margin-left:15px;"><a href="http://www.rayku.com/journal/<? echo $expertusr; ?>"><? echo $expertname; ?>'s Journal Entries</a> > Create/Edit Journal Entry</p>
  </div>
  <div class="spacer"></div>
</div>
<div class="body-main">
  <?php
    if($journal->isNew())
      echo form_tag('journal/edit', array('name' => 'journal'));
    else
      echo form_tag('journal/edit?id='.$journal->getId(), array('name' => 'journal'));
  ?>
  <?php echo form_error('subject'); ?>
  <div class="box">
    <div class="top"></div>
    <div class="content">
      <div class="title">Entry Title</div>
      <div class="entry" style="margin-top:10px"> <?php echo input_tag('subject', $journal->getSubject()); ?>
        <div class="availableb">Create a title that is eye catching!</div>
      </div>
      <div class="spacer"></div>
    </div>
    <div class="bottom"></div>
    <div class="spacer"></div>
  </div>
  <?php echo form_error('journalentry[type]'); ?>
  <div class="box">
    <div class="top"></div>
    <div class="content">
      <div class="title">Who'll Be Able to See This?</div>
      <div class="entry" style="margin-top:10px;width:160px;"> <?php echo select_tag(
                                            'journalentry[type]',
                                            options_for_select(
                                                    JournalEntry::getTypes(),
                                                    $journal->getShowEntity() ) );
                                    ?>
        <div class="spacer"></div>
      </div>
      <?php
    if($journal->getShowEntity() != 3)
      echo '<div id="friends" style="display:none;margin-top:20px;">';
	  else
      echo '<div id="friends">';
  ?>
  <?php if (@is_array($friends)): ?>
  <strong style="color:#069; font-size:14px; font-weight:bold">Select the friends you'd like this entry to be viewable for:</strong>
  <ul id="journalFriends">
    <?php foreach($friends as $friend): ?>
    <?php
          echo '<li><label style="font-size:12px"><input type="checkbox" name="friend['.$friend->getId().']"';

          if( in_array($friend->getId(), $selectedFriends) )
            echo 'checked="checked" ';

          echo '/>'.$friend.'</label></li>';
        ?>
    <?php endforeach; ?>
  </ul>
  <?php else: ?>
  You have no friends on Rayku.
  <?php endif; ?>
</div>
    </div>
    <div class="bottom"></div>
  </div>
  
<br />
<br />
<?php echo form_error('content'); ?>
<div class="box">
  <div class="top"></div>
  <div class="content">
    <div class="title">Journal Entry Content</div>
    <div style="position:relative; width:610px; height:356px; margin-top:20px;"> <?php echo textarea_tag('content',$journal->getContent(),array('size' => '60x40', 'rich' => 'fck')); ?> </div>
    <?php echo submit_tag('Post this Journal entry',array('id'=>'register','class'=>'button','style'=>'margin-top:60px;')); ?>
    <div class="spacer"></div>
  </div>
  <div class="bottom"></div>
  <div class="spacer"></div>
</div>
</form>
</div>
<div class="body-side">
  <div class="box">
    <div class="top"></div>
    <div class="content" style="position:relative; _top:-3px; _bottom:-3px;">
      <div class="title" style="margin-top:0px">Why write a journal?</div>
      <div class="text"> Journals allow you to express your thoughts; reading back on them can be a motivator for your future. </div>
    </div>
    <div class="bottom"></div>
  </div>
</div>
<br class="clear-both" />
