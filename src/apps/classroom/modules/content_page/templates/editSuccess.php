<?php use_helper('Object') ?>

<div class="title" style="float:left">

	<img src="../../../images/newspaper.gif" alt="" />

	<p>Add New Page to Classroom</p>

</div>



<div class="spacer"></div>

<?php echo form_tag('content_page/update', 'multipart=true') ?>

<?php echo object_input_hidden_tag($content_page, 'getId') ?>

<?php echo object_input_hidden_tag($content_page, 'getClassroomId') ?>

<div class="entry" style="margin-bottom:11px;">

	<div class="top"></div>

	<div class="content">

		<div class="hand-in">

			<div class="infleft" style="margin-right: 10px;">

			<label>New Page Name:</label>

			<?php echo object_input_tag($content_page, 'getTitle', array (

  'class' => 'replyc',

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

			<?php /* echo object_textarea_tag($content_page, 'getContent', array (

  'size' => '30x3',

  'rich' => true, 

  'tinymce_options' => 'width:590,height:400', 

)) */ 
		echo object_textarea_tag($content_page, 'getContent',  array('size' => '54x40', 'rich' => 'fck'))
		?>

			<br />

			<br />
						
						<h3 style="margin-bottom:15px;">Attachment(s)</h3>
	
						<?php foreach($page_attach as $attachment) : ?>
	
						<?php  echo $attachment->getFile(); ?>
	
						&nbsp;&nbsp;&nbsp;<?php  echo link_to('delete', 'content_page/deleteAttachment?id='.$attachment->getId().'&pageid='.$content_page->getId(),'post=true&confirm=Are you sure?') ; ?>
	
						<br />
	
					   <?php endforeach ; ?>

			
						<h3 style="margin-bottom:15px; margin-top:15px;">Upload attachment(s)</h3>

						<?php echo input_file_tag('file') ?>
						
			<br />

			<br />


			<?php echo submit_tag('save', array('class'=>'blue', 'style'=>'margin-left:10px;')) ?>

			<?php if ($content_page->getId()): ?>

			  <?php echo link_to('delete', 'content_page/delete?id='.$content_page->getId(), array('class'=>'blue', 'style'=>'line-height:38px; margin-left:10px;'), 'post=true&confirm=Are you sure?') ?>

			  <?php echo link_to('cancel', 'content_page/show?id='.$content_page->getId(), array('class'=>'blue', 'style'=>'line-height:38px;')) ?>

			<?php else: ?>

			  <?php echo link_to('cancel', 'content_page/list', array('class'=>'blue', 'style'=>'line-height:38px;')) ?>

			<?php endif; ?>

			<div class="clear-both"></div>			

			</div>

		</div>



	</div>

	<div class="bottom"></div>

</div>



</form>
