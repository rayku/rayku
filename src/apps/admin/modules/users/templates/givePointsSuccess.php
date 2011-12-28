<?php use_helper('Javascript'); ?>
<p class="page-title">Grant Points</p>
<div class="main-body">
	You can use this system to manually give points to a user. The number of
	points given can be either positive (points given) or negative (points taken
	away).<br /><br />
	
	<?php echo form_remote_tag(array('url' => 'users/ajaxGivePoints', 'complete' => 'alert("Done"); $("username").value=""; $("points").value=""')); ?>
		Username: <?php echo input_auto_complete_tag('username', '', 'users/autocomplete?hidden=no', array('autocomplete' => 'on', 'size' => 50), array('use_style' => true)); ?><br />
		Points: <?php echo input_tag('points', '', array('size' => 5)); ?><br />
		<?php echo submit_tag('Give Points'); ?>
	</form>
</div>