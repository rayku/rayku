<?php use_helper('Object') ?>

<div class="title" style="float:left">

	<img src="../../../images/newspaper.gif" alt="" />

	<p>Add Student Voice</p>

</div>



<div class="spacer"></div>

<?php echo form_tag('student_voice/update') ?>



<?php echo object_input_hidden_tag($student_voice, 'getId') ?>

<div class="entry" style="margin-bottom:11px;">

	<div class="top"></div>

	<div class="content">

		<div class="hand-in">

			<div class="infleft" style="margin-right: 10px;">

			<label>Title:</label>

			<?php echo object_input_tag($student_voice, 'getTitle', array (

  'size' => 80, 'class' => 'replyc'

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

			<label>Content:</label>

			<?php /*echo object_textarea_tag($student_voice, 'getDescription', array (

  'size' => '30x3', 'rich' => true, 'tinymce_options' => 'width: 590'

))*/

			echo object_textarea_tag($student_voice, 'getDescription', array('size' => '54x40', 'rich' => 'fck'))

			 ?>

			</div>

		</div>



	</div>

	<div class="bottom"></div>

</div>

<?php echo submit_tag('save', array('class'=>'blue')) ?>

<?php if ($student_voice->getId()): ?>

  <?php echo link_to('delete', 'student_voice/delete?id='.$student_voice->getId(), array('class'=>'blue', 'style'=>'line-height:38px; margin-right: 10px;'), 'post=true&confirm=Are you sure?') ?>

  <?php echo link_to('cancel', 'student_voice/show?id='.$student_voice->getId(), array('class'=>'blue', 'style'=>'line-height:38px; margin-right: 10px;')) ?>

<?php else: ?>

  <?php echo link_to('cancel', 'student_voice/list', array('class'=>'blue', 'style'=>'line-height:38px; margin-right: 10px;')) ?>

<?php endif; ?>

</form>