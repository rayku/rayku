<div class="title" style="float:left">
	<img src="../../../images/newspaper.gif" alt="" />
	<p>Edit Submission</p>
</div>

<div class="spacer"></div>
<?php use_helper('Object') ?>
<?php echo form_tag('submission/update', 'multipart=true') ?>
<?php echo object_input_hidden_tag($submission, 'getId') ?>
<?php echo input_hidden_tag('assignmentid', $submission->getAssignmentId() ) ?>
<div class="entry" style="margin-bottom:11px;">
	<div class="top"></div>
	<div class="content">
		<div class="hand-in">
			<div class="email-st">
			<label>Page Content:</label>
			<?php
				echo object_textarea_tag($submission, 'getData', array (
				'size' => '60x3','rich' => true,'tinymce_options' => 'width:590',
				))
			?>
			</div>
		</div>

	</div>
	<div class="bottom"></div>
</div>

<?php if( $submission->getAssignment()->getFormat() == 'UPLOAD'):?>
<div class="entry">
	<div class="top"></div>
	<div class="content">
		<div class="hand-in">
			<h3>Upload attachment(s)</h3>
			<?php if($submission->getPath()):?>

				<?php echo $submission->getPath() ?>

			<?php else: ?>

				<?php echo input_file_tag('path') ?>

			<?php endif;?>
			<div class="clear-both"></div>
		</div>

	</div>
	<div class="bottom"></div>
	<div class="clear-both"></div>
</div>
<?php else: ?>
	<?php echo object_input_hidden_tag($submission, 'getPath') ?>
<?php endif; ?>
<?php echo submit_tag('save', array('class' => 'blue')) ?>
<?php if ($submission->getId()): ?>
  <?php echo link_to('delete', 'submission/delete?id='.$submission->getId(), array('class'=>'blue', 'style' => 'line-height: 38px; margin-right: 10px;'), 'post=true&confirm=Are you sure?') ?>
  <?php echo link_to('cancel', 'submission/show?id='.$submission->getId(), array('class'=>'blue', 'style' => 'line-height: 38px; margin-right: 10px;')) ?>
<?php else: ?>
  <?php echo link_to('cancel', 'submission/list', array('class'=>'blue', 'style' => 'line-height: 38px; margin-right: 10px;')) ?>
<?php endif; ?>

</form>
