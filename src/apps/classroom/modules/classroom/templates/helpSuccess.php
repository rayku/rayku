<?php use_helper('Javascript') ?>
<div class="title" style="float:left">
	<img src="../../../images/newspaper.gif" alt="" />
	<p>Help &amp; About Mr. <?php echo $teacher->getUserName();?></p>
</div>
<div class="spacer"></div>
<div class="entry" style="margin-bottom:11px;">
	<div class="top"></div>
	<div class="content">
		<div style="border:1px solid #fff">
		  <div class="titles" style="margin:0;"> <a href="#" class="title02" style="float:left;">About Mr. <?php echo $teacher->getUserName();?></a> </div>
		  <div class="clear-both"></div>
	  </div>
		<div class="paragraph" style="margin:0;">
			<div id="bordersplitter"></div>
			<div class="text2" style="border-bottom:0;">
				<?php echo $teacher->getAboutMe();?>
			</div>
		</div>
		<div class="hand-in">
		  <div class="all" style="border-bottom:0; padding-top:10px; padding-bottom:0;">
			<div class="pmteacher"><?php echo link_to('Send Private Message','message/compose?nickname='.$teacher->getUserName());?></div>
				<div class="temail"><?php echo $teacher->getEmail();?></div>
				<?php $raykuUser = $sf_user->getRaykuUser(); ?>
				<?php if($raykuUser->getType() != 2): ?>
					<?php if( $chatapproved AND ( $chatapproved->getApproved() == 0)): ?>
						<?php if( $teacher->isOnline() ): ?>						
							<div id="myzone"></div>
							
							<div class="livehelpon">
							<?php echo link_to_remote('Request Live Video Help',array(
								'update'	=>	'myzone',
								'url'	=>	'classroom/videorequest?status=1&teacher_id='.
								$teacher->getId(),
								));
							?>
							</div>
			
							<div id="orbon">s</div>
							
							<?php else: ?>
							
							<div id="myzone"></div>
							<div class="livehelpoff">
							<?php echo link_to_remote('Request Live Video Help',array(
								'update'	=>	'myzone',
								'url'	=>	'classroom/videorequest?status=0&teacher_id='.
								$teacher->getId(),
								));
							?>
							</div>		
							
							<div id="orboff">s</div>
						<?php endif; ?>			
	
					<?php endif; ?>
				
				<?php else: ?>
					<div id="myzone"></div>
					<?php echo javascript_tag(
					  remote_function(array(
						'update'  => 'myzone',
						'url'     => 'classroom/checkvideorequest',
					  ))
					) ?>
				
				<?php endif; ?>
				
				<div class="clear-both"></div>
				<?php if($raykuUser->getType()=='1'): ?>
					
					<?php if( $chatapproved AND ( $chatapproved->getApproved() == 1) ):?>
						<object width="550" height="400">
		
						<param name="movie" value="/flash/reciever.swf">
		
						<embed src="/flash/reciever.swf" width="550" height="400">
		
						</embed>
						
						</object>
					<?php elseif( $chatapproved AND ( $chatapproved->getApproved() == 0) ): ?>
						<label style=" font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#009900; font-weight:bold;">
							<?php echo "Your request for video chat needs to be approved.";?>
						</label>					
					<?php endif; ?>
				<?php endif;?>

				<?php if($raykuUser->getType()=='2'): ?>
				<object width="550" height="400">
				<param name="movie" value="/flash/brodcaster.swf">
				<embed src="/flash/brodcaster.swf" width="550" height="400">

				</embed>
				</object>
				<?php endif;?>

		  </div>
	  </div>
	</div>
	<div class="bottom"></div>
</div>
