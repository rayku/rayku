 <div class="entry" style="margin-bottom:11px;">

        	<div class="top"></div>

            <div class="content">

            	<div class="hand-in">

                	<div class="email-st">

							
							<div class="title" style="float:left">

							<img src="../../../images/newspaper.gif" alt="" />

							<p> Topic: <?php echo $thread->getTitle(); ?></p> 
							</div>
							
							
							<div class="spacer"></div>
							
							<div class="title" style="float:left">

							<img src="../../../images/newspaper.gif" alt="" />

							<p><?php 
							  $c=new Criteria();
							  $c->add(UserPeer::ID,$thread->getPosterId());
							  $user=UserPeer::doSelectOne($c);
							?>
							
								Posted by : <?php echo $user->getName(); ?>:</p> 
							</div>
							
							<div class="spacer"></div>
							
							<div class="title" style="float:left">

							<img src="../../../images/newspaper.gif" alt="" />

							<p> Post: <?php echo $thread->getContent(); ?></p> 
							</div>
							
							<div class="spacer"></div>
													
					</div>

                </div>

            </div>

            <div class="bottom"></div>

 </div>


<div class="spacer"></div>

<?php include_partial('classroom_forum/showComment', array('forumID' => $thread->getForumID(), 'threadID' => $thread->getId())) ?>



<?php include_partial('classroom_forum/makeCommentForm', array('forumID' => $thread->getForumID(), 'threadID' => $thread->getId())) ?>

		  


	