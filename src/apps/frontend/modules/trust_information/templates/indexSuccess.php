<link rel="stylesheet" type="text/css" href="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/styles/classroom.css" />

<div class="body-main">

<!--<div class="title" style="float:left;">

	<img src="../../../images/newspaper.gif" alt="" />-->

	<p>Trust information [Experts best responses for all questions]</p>
<!--
</div>-->


<div class="spacer"></div>


<?php	foreach($questions as $question) : ?>
													
		<div class="entry" style="margin-bottom:11px;">
        	<div class="top"></div>
            <div class="content">
            	<div class="hand-in">
                	<div class="email-st">
		
						<label style=" margin-top:10px;">Question:</label> <?php echo $question->getQuestion() ;?> 
		
		
						<?php 
						
								$c=new Criteria();
								$c->add(ForumAnswerPeer::FORUM_QUESTION_ID,$question->getId());
								$c->add(ForumAnswerPeer::BEST_RESPONSE,1);
								$bestanswers=ForumAnswerPeer::doSelect($c);
								
								foreach($bestanswers as $bestanswer) : 
								
										$u=new Criteria();
										$u->add(UserPeer::ID,$bestanswer->getUserId());
										$user=Userpeer::doSelectOne($u); ?>
										
								
								
								<label style="margin-top:15px;"> Best response by   :  <?php echo $user->getName(); ?> </label>
									
								<label style="margin-top:15px;"> Answer:</label> <?php echo $bestanswer->getAnswer(); ?>
										
								
						<?php 	endforeach;
								
							
						?>
		
		
                    </div>
                </div>
            </div>
            <div class="bottom"></div>
 </div>
		

		
<?php endforeach; ?>

</div><!-- end of body-main -->
