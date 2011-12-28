<?php use_helper('Object') ?>
<?php $classroom = RaykuCommon::getCurrentClassroom( $sf_user ); ?>
<div class="title" style="float:left">
	<img src="images/newspaper.gif" alt="" />
	<p>
		<?php if ($assignment->getId()): ?>
			Edit Assignment
		<?php else: ?>
			Create assignment
		<?php endif ?>
	</p>
</div>

<div class="spacer"></div>

<?php echo form_tag('assignment/update','multipart=true') ?>

<?php echo object_input_hidden_tag($assignment, 'getId') ?>

<div class="entry" style="margin-bottom:11px;">
	<div class="top"></div>
	<div class="content">
		<div class="hand-in">
			<div class="infleft" style="margin-right: 10px;">
			<label>
				Title
			</label>
			<?php echo object_input_tag($assignment, 'getTitle', array (
  'size' => 50, 'class' => 'replyc',
)) ?>
			</div>
			<div id="eyecatching">Create an eye catching title</div>
			<div class="clear-both"></div>
		</div>
	</div>
	<div class="bottom"></div>
</div>

<div class="entry" style="margin-bottom:11px;">
	<div class="top"></div>
	<div class="content">
		<div class="hand-in">
			<div class="email-st">
			<label>Page Content:</label>
			 <?php // echo object_textarea_tag($assignment, 'getDescription', array ('size' => '60x2','rich' => true, 'tinymce_options' => 'width:590'))
			 		echo object_textarea_tag($assignment, 'getDescription', array('size' => '54x40', 'rich' => 'fck'))
			  ?>
			</div>
		</div>

		<?php if($assignment->getAttachments() != "") : ?>
	
		<div class="hand-in" style="margin-top:10px;">
			<div class="email-st">
			<label>Attachment:</label>
      <label><?php echo link_to($assignment->getAttachments(),'http://'.RaykuCommon::getCurrentHttpDomain().'/uploads/teachers_assignments/'.$assignment->getAttachments().'') ; ?>
			
			
			<?php echo link_to('Delete','assignment/deleteAttachment?id='.$assignment->getId(),'post=true&confirm=Are you sure?'); ?> </label>
			</div>
		</div>
		
		<?php endif; ?>
		
		<div class="hand-in" style="margin-top:10px;">
			<div class="email-st">
			<label>Upload:</label>
			<?php echo input_file_tag('file'); ?>
			</div>
		</div>
		<div class="hand-in" style="margin-top:10px;">
			<div class="email-st">
			<label>Format:</label>
			<?php echo select_tag('format', options_for_select(array('TEXT' => 'Basic TEXT type','HTML' => 'Basic HTML type', 'UPLOAD' => 'File Attachment'),$assignment->getFormat())); ?>
			</div>
		</div>
		<div class="hand-in" style="margin-top:10px;">
			<div class="email-st">
			<label>Due Dates:</label>
			<?php echo object_input_date_tag($assignment, 'getDueDate', array (
			  'rich' => true,
			  'withtime' => false,
			)) ?>
			</div>
		</div>
		
		

	</div>
	<div class="bottom"></div>
</div>
<br />
<?php echo submit_tag('save',array('class' => 'blue', 'style' => 'float: left; margin-right: 10px;')) ?>
	<?php if ($assignment->getId()): ?>
	  &nbsp;<?php echo link_to('delete', 'assignment/delete?id='.$assignment->getId(),array('class' => 'blue', 'style' => 'line-height:38px; float: left; margin-right: 10px'), 'post=true&confirm=Are you sure?') ?>
	  &nbsp;<?php echo link_to('cancel', 'assignment/show?id='.$assignment->getId(),array('class' => 'blue', 'style' => 'line-height:38px; float: left')) ?>
	<?php else: ?>
	  &nbsp;<?php echo link_to('cancel', 'assignment/list',array('class' => 'blue', 'style' => 'line-height:38px; float: left')) ?>
	<?php endif; ?>

</form>
