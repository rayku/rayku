<?php use_helper('MyAvatar', 'Javascript') ?>


<?php $raykuUser = $sf_user->getRaykuUser(); ?>


			<?php
			/////checking profile picture exist or not
                        $connection = RaykuCommon::getDatabaseConnection();

			if(!empty($raykuUser)) {

					$user_id=$raykuUser->getId();
			
				 $profile_pic_exist=0;
				 
				 $action=base64_decode($_GET['action']);
				if($action=='reset')
				{
			
					unlink("/home/rayku/public_html/uploads/avatar/{$user_id}");
					unlink("/home/rayku/public_html/uploads/avatar/{$user_id}_2");
					unlink("/home/rayku/public_html/uploads/avatar/{$user_id}_3");
					unlink("/home/rayku/public_html/uploads/avatar/{$user_id}_4");
				}
				if(file_exists("/home/rayku/public_html/uploads/avatar/{$user_id}"))
				{
					 $profile_pic_exist=1;
				}
			
			}
			
			?>




<div class="big-avatar">
<?php   echo avatar_tag_for_user($user, 4) ?>


							   <?php
							   if($profile_pic_exist==1)
							   {

								if(!empty($raykuUser)) {

										 if($sf_user->getRaykuUser()->getId() == $user->getId() ) : 

													 	echo "<div align='left'><h4 style='font-size:8px;'><a href='http://www.rayku.com/profile/".$user->getUsername()."?action=".base64_encode("reset")."'>(Clear Profile Picture)</a></div><h4>";

										endif; 

								}

				
							   }
							   ?>


</div>


<?php if ($sf_user->isAuthenticated() && $user->equals($raykuUser) && !empty($raykuUser)): ?>
	<ul>
        <li><?php echo link_to('Edit Course Information', 'profile/course?name='.$user->getUsername()); ?> </li>			
		<li><?php echo link_to('Profile Display Permissions', '@profile_edit?username=' . $user->getUsername()); ?></li>
		<?php endif ?>
        
    	<?php 
			$c= new Criteria();
			$c->add(NotificationEmailsPeer::USER_ID,$sf_user->getRaykuUser()->getId());
			$notificationemails = NotificationEmailsPeer::doSelectOne($c);
		?>
	
		<?php	if($notificationemails != NULL):  ?>
					<?php if($notificationemails->getOnOff() == 0): ?>
					<li><?php echo link_to('Turn Rayku emails OFF', '/profile/emailNotify/user_id/' . $user->getId().'/st/1') ?></li>
					<?php else : ?>
					<li><?php echo link_to('Turn Rayku emails ON', '/profile/emailNotify/user_id/' . $user->getId().'/st/0') ?></li>
					<?php endif; ?>
		<?php else: ?>
					<li><?php echo link_to('Turn Rayku emails OFF', '/profile/emailNotify/user_id/' . $user->getId().'/st/1') ?></li>
		<?php endif; ?>    
    
    
	</ul>

<?php else: ?>

	<ul>
		<li><?php echo link_to('Send a Nudge', '/nudge/send/username/' . $user->getUsername()) ?></li>

		
		<?php if($user->getType() == '5'): ?>
		
			<?php 
			
					
					//echo $currentuser->getId().','.$user->getId();
						if(!empty($raykuUser)) :
								$c = new Criteria();
								//if(!empty($raykuUser)) {
									$c->add(SavedExpertsPeer::USER_ID,$currentuser->getId());
								//}
								$c->add(SavedExpertsPeer::EXPERT_ID,$user->getId());
								$savedexperts = SavedExpertsPeer::doSelectOne($c);
					
								if($savedexperts == NULL) :?>
		
								<li><?php echo link_to('Save this Expert', 'expertsconnect/saveanexpert?expid='.$user->getId()) ?></li>
					
								<?php else: ?>
					
								<li><?php echo link_to('Saved', '@profile?username='.$user->getUsername()); ?></li>
					
								<?php endif; ?>
						<?php endif; ?>
				
		<?php  endif; ?>
	</ul>
<?php endif ?>
