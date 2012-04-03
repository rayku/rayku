<?php use_helper('Javascript'); ?>
<p class="page-title">Ban / Unban / Delete User</p>
<div class="main-body">
	When a staff member deletes a user through the "User Management" panel, the
	user is not actually deleted from the system for technical reasons; the user
	continues to exist (so that all threads, posts, comments, PMs, etc can
	continue to exist... otherwise there would be "gaps" in  conversations
	involving other users). If you are 100% sure that you wish to remove a user
	from the database, you can use this form to remove them. Similarly, this
	form can be used to unban users.<br /><br />
	
	
	<div id="banusers" style="color:#FF0000; font-weight:bold;"></div>
		<?php echo form_remote_tag(array(
			'update'   => 'banusers',
			'url'      => 'users/ajaxDeleteUser',
		)) ?>
		
		  Username: 
		  <?php echo input_tag('username', '', array('size' => 30), array('use_style' => true)); ?>
		  <?php // echo input_auto_complete_tag('username', '', 'users/autocomplete?hidden=yes', array('autocomplete' => 'on', 'size' => 50), array('use_style' => true)); ?>
		  
		&nbsp;&nbsp;&nbsp;
		<?php echo submit_tag('BanUser'); ?>
</form>
	
	</div>
	
	<div id="unbanusers" style="color:#FF0000; font-weight:bold;"></div>
		<?php echo form_remote_tag(array(
			'update'   => 'unbanusers',
			'url'      => 'users/ajaxDeleteUser',
		)) ?>
		
		  Username: <?php echo input_tag('username', '', array('size' => 30), array('use_style' => true)); ?>
			  
			&nbsp;&nbsp;&nbsp;
			<?php echo submit_tag('UnbanUser'); ?>
			
		</form>
	
	</div>
	
	
	<div id="deleteusers" style="color:#FF0000; font-weight:bold;"></div>
		<?php echo form_remote_tag(array(
			'update'   => 'deleteusers',
			'url'      => 'users/ajaxDeleteUser',
		)) ?>
		
		  Username: <?php echo input_tag('username', '', array('size' => 30), array('use_style' => true)); ?>
			  
		  &nbsp;&nbsp;&nbsp;
		 <?php echo submit_tag('DeleteUser'); ?>
	
		</form>
	
	
    
    
    	<div id="deleteusers" style="color:#FF0000; font-weight:bold;"></div>
		<form action="/admin.php/users/banIp" method="post">
		
		  IP: &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; <?php echo input_tag('banip', '', array('size' => 30), array('use_style' => true)); ?>
          &nbsp;&nbsp;&nbsp;
         
		 <?php echo submit_tag('Ban IP'); ?>
          <br/>(Enter multiple IP's with ',' delimited, ex: 127.0.0.1,127.0.0.2,...)
	
		</form>
	
	</div>