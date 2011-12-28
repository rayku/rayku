<?php  use_helper('MyForm') ?>

<h2>Login</h2>
<div class="main-body">
	<?php echo form_tag('login/loginCheck', array('method' => 'post')) ?>
		<?php echo form_row('username', input_tag('username')) ?>
		<?php echo form_row('password', input_password_tag('password')) ?>
		<?php echo form_row_indented('remember', checkbox_tag('remember', '1', true), 'Remember Me') ?>
		<?php // echo form_row_indented('invisible',checkbox_tag('invisible','1', false), 'Login as Invisible') ?>
		
		<?php echo form_row_no_label(submit_tag('Log Into Your Account')) ?>
	</form><br />
	
	<p><?php //echo link_to('Lost Password?', '@recover_password') ?></p>	
</div>