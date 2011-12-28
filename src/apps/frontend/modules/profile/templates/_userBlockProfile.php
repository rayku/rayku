<?php use_helper('MyAvatar', 'Javascript') ?>


<?php $raykuUser = $sf_user->getRaykuUser(); ?>


			<?php
			/////checking profile picture exist or not
			$con = mysql_connect("localhost", "rayku_db", "db_*$%$%") or die(mysql_error());

			$db = mysql_select_db("rayku_db", $con) or die(mysql_error());

			if(!empty($raykuUser)) {

					$user_id=$raykuUser->getId();
			
					//echo "select * from gallery where 	user_id=".$user_id;
			//	$query_gallery_pf = mysql_query("select * from gallery where 	user_id=".$user_id) ;
				//echo $fetch_gallery_pf=mysql_num_rows($query_gallery_pf);
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
		<li><?php echo link_to('View/Edit Galleries', '@gallery_index?user_id=' . $user->getId()) ?></li>
		<li><?php echo link_to('View/Edit Journal', '@journal_index?user_id=' . $user->getId()) ?></li>	
        <li><?php echo link_to('Edit Course Information', 'profile/course?name='.$user->getUsername()); ?> </li>			
		<li><?php echo link_to('Profile Display Permissions', '@profile_edit?username=' . $user->getUsername()); ?></li>
        <?php 
			$c= new Criteria();
			$c->add(UsersNetworksPeer::USER_ID,$sf_user->getRaykuUser()->getId());
			$networkusers = UsersNetworksPeer::doSelectOne($c);
		?>
		<?php if($networkusers != NULL): ?>
			<li><?php echo link_to('Networks', '/network/index'); ?></li>
		<?php endif ; ?>

	  	<?php if ( ($raykuUser->getType() == UserPeer::getTypeFromValue('teacher')) || ($raykuUser->getType() == UserPeer::getTypeFromValue('admin')) ) :?>
		<li><?php echo link_to('Class Room', '/classmanager/index') ?></li>
        <li><?php 

			$left = $raykuUser->howManyInvitationsLeft();
      		$invitationText = 'Invite Teacher ('.$left.'/'.User::NR_OF_INVITATIONS.' left!)';
      		echo link_to( " $invitationText", '/invitation/index');
		?></li>
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
		<!--<li><?php //echo link_to('Send a Gift', '/gifts/index') ?></li>-->
		<li><?php echo link_to('View Galleries', '@gallery_index?user_id=' . $user->getId()) ?></li>
		<li><?php echo link_to('View Journal', '@journal_index?user_id=' . $user->getId()) ?></li>
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
				
				
		<?php if ($sf_user->isAuthenticated() && !empty($raykuUser) ): ?>
			<li id="friendActions[<?php echo $user->getId() ?>]">

				<?php if ($user->isFriendsWith($raykuUser) && !empty($raykuUser) ): ?>

					<?php if (isset($ajaxAdd) && $ajaxAdd): ?>

						<?php echo link_to_remote(
							'Remove as Friend',

							array(
								'url' => '@friend_remove?ajax=1&user_id=' . $user->getId(),

								'update' => 'friendActions[' . $user->getId() . ']',

							),

							array('href' => url_for('@friend_remove?user_id=' . $user->getId()))

						) ?>
					<?php else: ?>
						<?php echo link_to('Remove as Friend', '@friend_remove?user_id=' . $user->getId()) ?>

					<?php endif ?>

				<?php else: ?>

					<?php if (isset($ajaxAdd) && $ajaxAdd): ?>
						<?php echo link_to_remote(

							'Add as Friend',
							array(

								'url' => '@submit_friend_request?username=' . $user->getUsername(),
								'update' => 'friendActions[' . $user->getId() . ']',

							),

							array('href' => url_for('@submit_friend_request?username=' . $user->getUsername()))

						) ?>
						<?php else: ?>

						<?php echo link_to('Add as Friend', '@submit_friend_request?username=' . $user->getUsername()) ?>

					<?php endif ?>

				<?php endif ?>

			</li>
		<?php endif ?>

	</ul>
<?php endif ?>
