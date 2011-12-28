			<div class="entry" style="margin-bottom:11px;">

					<div class="top"></div>

					<div class="content">
		
						<div class="hand-in">
		
							<div class="email-st">	
							
							<div class="title" style="float:left">

							<img src="../../../images/newspaper.gif" alt="" />

							<p> Comments :</p> 
							</div>
							<div class="spacer"></div>
							
								<?php
									
									$c=new Criteria();
									$c->add(ClassroomForumCommentPeer::THREAD_ID,$threadID);
									$forumcomments=ClassroomForumCommentPeer::doSelect($c);
									
								 if ($forumcomments != NULL): 
								
									foreach($forumcomments as $forumcomment) :
											
								?>	
	
							<label style="margin-left:50px;"> >
							<?php
								$user=UserPeer::retrieveByPK($forumcomment->getCommentorId());
								echo link_to($user->getName(),'@profile?username=' . $user->getName().'');
							 ?>
							said: </label>
							<label style="margin-left:50px;"><?php echo $forumcomment->getContent();?></label> <br />
					   

             

	<?php endforeach ?>

<?php else: ?>
	<label style="margin-left:50px;">No Comments yet!</label>
<?php endif ?>
		
	 				   </div>
				  </div>

            </div>

            <div class="bottom"></div>

 </div>