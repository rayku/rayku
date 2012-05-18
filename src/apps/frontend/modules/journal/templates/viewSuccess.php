<div id="top" style="margin-left:18px;padding-top:2px">
  <div class="title" style="float:left"> <img src="<?php echo image_path('arrow-right.gif', false); ?>" alt="" />
    <p style="font-size:16px; line-height:24px;color:#1C517C;font-weight:bold;margin-left:15px;"><? echo $journal->getUser(); ?>'s Journal Entries</p>
  </div>
  <div class="spacer"></div>
</div>
<div class="body-main">
  <div class="box">
    <div class="top"></div>
    <div class="content" style="padding-bottom:4px">
      <div class="title"><span style="font-weight:normal">[Entry ID<?php echo $journal->getID(); ?>]</span> <?php echo $journal->getSubject(); ?></div>
      <div class="postdate">Posted on: <span style="color:#056a9a"><?php echo date(sfConfig::get('app_general_date_format'), strtotime($journal->getCreatedAt())); ?></span></div>
    </div>
    <div class="spacer"></div>
    <div class="bottom"></div>
  </div>
  <div class="box">
    <div class="top"></div>
    <div class="content">
      <div class="paragraph">
        <div class="text"> <?php echo $journal->getContent(); ?> </div>
      </div>
    </div>
    <div class="spacer"></div>
    <div class="bottom"></div>
  </div>
</div>
<div class="body-side">
  <?php
    $nextJournal = $journal->getNext();
    $previousJournal = $journal->getPrevious();

    if( $nextJournal instanceof JournalEntry )
      echo link_to("Next Entry (ID".$nextJournal->getId().")",'journal/view?id='.$nextJournal->getId(), array('class'=>'navlink next'));

    if( $previousJournal instanceof JournalEntry )
      echo link_to("Previous Entry (ID".$previousJournal->getId().")",'journal/view?id='.$previousJournal->getId(),array('class'=>'navlink back'));

    if ($sf_user->isAuthenticated() && $owner->equals($sf_user->getRaykuUser())): ?>
  <div class="divider" style="margin-bottom:35px"></div>
  <?php echo link_to("Create a New Entry",'/journal/editForm',array('class'=>'navlink add')); ?>
  <?php echo link_to("Edit This Entry",'/journal/editForm?id='.$journal->getId(),array('class'=>'navlink add')); ?>
  <?php 
  
       if( $nextJournal instanceof JournalEntry )
       echo link_to("Delete This Entry",'journal/delete?id='.$journal->getId(),array('class'=>'navlink delete')); 
	   
	   
   ?>
  <?php endif ?>
</div>
