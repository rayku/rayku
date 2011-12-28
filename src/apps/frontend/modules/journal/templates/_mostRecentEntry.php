<h4><div style="width:325px;float:left"><strong><?php if(isset($journalEntry) && $journalEntry instanceof JournalEntry) : ?>
  <?php 
  echo 'Latest Journal Entry:&nbsp;';
  echo link_to($journalEntry->getSubject(),'journal/view?id='.$journalEntry->getId().'',array('style' =>'font-size:14px')); ?>
  <?php endif; ?></strong></div>
  <div style="width:50px;float:right"><?php echo link_to( 'view all <em>+</em>', '@journal_index?user_id=' . $user->getId() ); ?></div></h4>

<?php
if(isset($journalEntry) && $journalEntry instanceof JournalEntry)
  {
	$length = strlen(trim($journalEntry->getContent()));
	if($length <= '400')
		{
 			 echo '<div style="padding:10px 0;color:#242424;font-family:Arial;font-size:11px;width:400px">'.$journalEntry->getContent().'</div>';
		} else {
			 $newJournal = substr(trim($journalEntry->getContent()), 0, 400);
			 echo '<div style="padding:10px 0;color:#242424;font-family:Arial;font-size:11px;width:400px">'.$newJournal.'... </div>';
		}
  }
  else
	  echo '<div style="padding:10px 5px;color:#242424;font-family:Arial;font-size:11px;width:400px">This user has no viewable journal entries at this time.</div>';
?>
