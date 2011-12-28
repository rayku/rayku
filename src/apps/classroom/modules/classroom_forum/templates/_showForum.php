					<?php
							
							$c=new Criteria();
							$c->add(ClassroomForumPostPeer::FORUM_ID,$forumID);
							$c->addDescendingOrderByColumn('Created_at');
							$forumthreads=ClassroomForumPostPeer::doSelect($c);
							
						 	if ($forumthreads != NULL): 
						
							foreach($forumthreads as $forumthread) :
									
						?>	
	
		 
			  		<div class="entry" style="margin-bottom:11px;">

					<div class="top"></div>

					<div class="content">
		
						<div class="hand-in">
		
							<div class="email-st">
					
					
							<label> <?php echo link_to($forumthread->getTitle(), 'classroom_forum/comment?thread_id='.$forumthread->getId().''); ?> 
							- By
							<?php
								$user=UserPeer::retrieveByPK($forumthread->getPosterId());
								echo $user->getName();
							 ?>
							
							</label>
							<label><?php echo $forumthread->getContent();?></label>
						</div>

                </div>

            </div>

            <div class="bottom"></div>

 </div>

	<?php endforeach ?>

<?php else: ?>

	
	<div class="entry" style="margin-bottom:11px;">

        	<div class="top"></div>

            <div class="content">

            	<div class="hand-in">

                	<div class="email-st">
	
						<label style="margin-left:50px;"> No posts yet! </label>
						
					</div>

                </div>

            </div>

            <div class="bottom"></div>

 </div>


<?php endif ?>
