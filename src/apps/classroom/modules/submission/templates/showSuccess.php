<style type="text/css">
ul.subopt {
}
ul.subopt li {
	display:block;
}
ul.subopt li label{
	font-size:12px;
	color:#257000;
	font-weight:bold;
	float:left;
	width:80px;
}
</style>
<?php
  /* @var $submission Submission */
  $assignment = $submission->getAssignment();
?>


<div class="title" style="float:left">
	<img src="../../../images/newspaper.gif" alt="" />
	<p>Submission Description</p>
</div>

<div class="spacer"></div>

<div class="entry" style="margin-bottom:11px;">
	<div class="top"></div>
	<div class="content">
		<div style="border:1px solid #fff">
			<div class="titles" style="margin:0;">
				<a href="#" class="title02" style="float:left;"><?php echo $assignment->getTitle();?></a>
			</div>

			<div style="float: right; font-size: 12px;">
				<div class="format" style="display: inline;">Format: <strong>HTML</strong></div>
				<div class="date-due" style="display: inline; padding-left: 15px;">Due: <strong>2009-07-31</strong></div>
			</div>
			<div class="clear-both"></div>
		</div>

		<div class="paragraph" style="margin:0;">
			<div id="bordersplitter"></div>
			<div class="text" style="border-bottom:0;">
				<?php echo $submission->getData() ?>
			<br />
			<br />
			<ul class="subopt">
			<li>
				<label>Grade </label>:
        <?php $raykuUser = $sf_user->getRaykuUser(); ?>
				<?php if( $raykuUser->getType() == 2): ?>
				<?php echo form_tag('submission/assigngrade', array('style' => 'width: 300px; float: left')) ?>
				<?php echo input_hidden_tag('id', $submission->getId()); ?>
				<?php echo select_tag('grade', options_for_select(array('A'=>'A','B'=>'B','C'=>'C','D'=>'D','E'=>'E'), $submission->getGrade() )); ?>
				<?php echo submit_tag('Submit Grade');?>
				</form>
				<?php else: ?>
					<?php if($submission->getGrade() == '-'):?>
						<?php echo "No Grade" ?>
					<?php else: ?>
						<?php echo $submission->getGrade() ?>
					<?php endif;?>
				<?php endif; ?>
			</li>
			<li>
				<label>Attachment </label> :
				<?php if($submission->getPath() == NULL): ?>
				<?php echo "No Attachment" ?>
				<?php else: ?>
				<?php echo link_to($submission->getPath(),'submission/download?id='.$submission->getId()) ?>
				<?php endif; ?>
			</li>
			<li>
				<label>Created At </label>:
				<?php echo $submission->getCreatedAt() ?>
			</li>
			<li>
				<label>Updated At </label>:
				<?php echo $submission->getUpdatedAt() ?>
			</li>
			</ul>
			<?php if(($raykuUser->getType() == 2) && ( $submission->getApproved()!='1') ): ?>
				<?php echo form_tag('submission/approve', array('style'=>'width:100px; float:right; padding:0px;')) ?>
				<?php echo input_hidden_tag('id', $submission->getId()); ?>
				<?php echo input_hidden_tag('approve', '1'); ?>
				<?php echo submit_tag('Approve', array('class' => 'blue')); ?>
				</form>
			<?php endif; ?>
			<?php if(($submission->getApproved() != 1) &&
				($raykuUser->getType() == 1) ): ?>
				<?php echo link_to('Edit', 'submission/edit?id='.$submission->getId(), array('class' => 'blue', 'style' => 'line-height: 38px;')) ?>
				<?php endif;?>

			<?php echo link_to('Back','assignment/list', array('class' => 'blue', 'style' => 'margin-right: 10px; line-height: 38px;'))?>
			<div class="clear-both"></div>

			</div>
		</div>

	</div>
	<div class="bottom"></div>
</div>

<div class="spacer"></div>

<div class="entry">
	<div class="top"></div>
	<div class="content">
		<div class="hand-in">
			<h3>Comments</h3>
			<br />
			<br />
			<?php if($raykuUser->getType() == 2): ?>
				<?php echo form_tag('submission/comment') ?>
				<?php echo input_hidden_tag('id', $submission->getId()); ?>
				<?php echo textarea_tag('comment',$submission->getComment(), array('class' => 'comm')); ?>
				<?php echo submit_tag('Add Comment', array('style'=>'vertical-align:top', 'class' => 'blue'));?>
				</form>
			<?php else: ?>
				<?php if($submission->getComment() == "NULL"): ?>
					<?php echo "No Comments" ?>
				<?php else: ?>
					<?php echo $submission->getComment() ?>
				<?php endif; ?>
			<?php endif; ?>
			<div class="clear-both"></div>
		</div>

	</div>
	<div class="bottom"></div>
</div>
