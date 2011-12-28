<p class="page-title">Friend List</p>
<form id="mailtofriends" name="mailtofriends" action="emailtofriends">
<div class="main-body">
	<p>
		<?php 
		foreach($friendsdetails as $key => $value)
		{
			?><p><input type="checkbox"  id="<?php echo $key?>" name="friends[]" value="<?php echo $key?>"/><label><?php echo $value;?></label></p> <?php
			
		}
		
		
		
		
		
		?>
	</p>
</div>
<input type="submit" id="mail" name="mail" value="Send Mail"/>
</form>



