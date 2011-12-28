<?php  use_helper('MyForm') ?>

<div class="main-body">
	<?php echo form_tag('invitation/sendConfirmation',  array('name' => 'invitation')) ?>
		<?php echo form_row('Enter E-mail address', input_tag('email')) ?>
		<?php echo submit_tag('Send Invitation mail', array('class' => 'clearBlock')) ?>
	</form>
</div>
<br />
