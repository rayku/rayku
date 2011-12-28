<link type="text/css" rel="stylesheet" href="/css/custom/forum-threads.css" />
<link type="text/css" rel="stylesheet" href="/css/custom/forum-threads-bit.css" />
<link type="text/css" rel="stylesheet" href="/styles/forum_global.css" />
<link type="text/css" rel="stylesheet" href="/styles/forum_donny.css" />

<?php use_helper('Date') ?>

<?php use_helper('MyAvatar', 'Javascript') ?>
			<div class="body-main">
                        
												
						<div class="box">
                        	<div class="top"></div>
                            <div class="content">
                            	<div class="userinfo">
								
										<?php $user = UserPeer::retrieveByPK($question->getUserId()); ?>

								<div class="avatar-holder" style="float:none !important;">
									<?php echo avatar_tag_for_user($user); ?>

									</div>
									
                                    <div class="spacer"></div>
                                    <?php echo link_to($user->getUsername(), '@profile?username=' . $user->getUsername(),array('class' => 'username')) ?>
                                    
                                </div>
								
								 <div class="cmmt">
										<div class="info">
											<div>
												<img src="/images/forum-threads-statuson.gif" alt="" />
												<p><?php echo $question->getTitle() ; ?></p>
											</div>
											<?php
					
												$d1=explode(' ',$question->getUpdatedAt());
												$d=explode('-',$d1[0]);
												$t=explode(':',$d1[1]);
												$date=date('F jS , Y  \a\t  h:i a',mktime($t[0],$t[1],$t[2],$d[1],$d[2],$d[0]));
														
											?>
											
											<div class="postdate">Posted on <?php echo $date; ?></div>
											
											<?php if($sf_user->getRaykuUserId() == $user->getId()): ?>
											
											<div class="btns">
												
											<?php if($question->getVisible() == '1'): ?>
																								
												<?php echo link_to('close','forum_answer/questionstatus?qn_id='.$question->getId().'&status=close',array('class' => 'close')); ?>

											<?php else: ?>
											
												<?php echo link_to('Re-activate','forum_answer/questionstatus?qn_id='.$question->getId().'&status=reactive',array('class' => 'reac')); ?>
												
											<?php endif; ?>
												
													
										<?php echo link_to('Cancel','forum_answer/questionstatus?qn_id='.$question->getId().'&status=cancel',array('class' => 'cancel')) ; ?>
																			
																								
											</div>
											 <div class="clear-both"></div>
											 
											 <?php endif; ?>
											 
										</div>
										
										<p class="message">
											<?php echo $question->getQuestion(); ?>
										</p>
                              </div>
							  
                              <div class="spacer"></div>
                          </div>
                            <div class="spacer"></div>
                            <div class="bottom"></div>
                        </div>
						
					<?php $i=1; ?>
					
					<?php  
							$c=new Criteria();
							$c->addJoin(ForumAnswerPeer::USER_ID,UserPeer::ID,Criteria::JOIN);
							$c->add(UserPeer::TYPE,'5');
							$c->add(ForumAnswerPeer::FORUM_QUESTION_ID,$question->getId());
							$c->add(ForumAnswerPeer::BEST_RESPONSE,'1');
							$answers=ForumAnswerPeer::doSelect($c);
					
					?>
					
					<?php if($answers != NULL) : ?>
					
					<?php foreach($answers as $post): ?>
					
					
					<?php $c = new Criteria();
						  $c->add(UserPeer::ID,$post->getUserId()); 
						  $user=UserPeer::doSelectOne($c);
					?>
					
					<div class="spacer"></div>
					<div class="expertrply">
                        	<div class="ptitle"><span>Expert Answer <?php echo $i; ?></span> <div class="bestest"></div></div>
                            <div class="msg">
                            	   <?php echo $post->getAnswer(); ?>
                            </div>
                            <table>
                                <tr>
                                    <td class="user">
                                        
										<?php echo avatar_tag_for_user($user); ?>
										<!--<img src="images/dev/emptyprofile-small.gif" alt="" />-->
                                        <?php echo link_to($user->getUsername(), '@profile?username=' . $user->getUsername(),array('class' => 'username')); ?>
                                        <p class="pnts">Points: 300</p>
                                        <p class="awrds">Awards: 5</p>

                                        <div class="spacer"></div>

                                       	<?php 	
												$c=new Criteria();
												$c->add(ExpertCategoryPeer::USER_ID,$post->getUserId());
												$cat=ExpertCategoryPeer::doSelectOne($c); 
												
												$c=new Criteria();
												$c->add(CategoryPeer::ID,$cat->getCategoryId() );
												$cat_name=CategoryPeer::doSelectOne($c);
												
										?>
									   
									    <div class="expertise"><?php echo $cat_name->getPrefix();?></div>                                    
									</td>
                                    <td class="expabout">
                                        <div class="abtitle"><span>About <?php echo $user->getUsername(); ?></span> <div class="pitchg"></div> <div class="clear-both"></div></div>
                                       
									   <?php
									   		
											$c=new Criteria();
											$c->add(UserPeer::ID,$post->getUserId());
											$user_details=UserPeer::doSelectOne($c);
									   
									   ?>
									   
									    <p class="abtxt"><?php echo $user_details->getAboutMe(); ?></p>
                                        
										<?php echo link_to('See profile', '@profile?username=' . $user->getUsername()) ?>
										
										<!--<a href="#">See profile</a>  -->                   
									</td>
                                </tr>
                            </table>
                            <div class="spacer"></div>
                            <div class="btm"></div>
                      </div>
					  
					  <?php $i++; ?>

					 <?php endforeach ?>	
					 <?php endif; ?>
					 
	
								
					
					<?php $j=1; ?>
					
					<?php  
							$c=new Criteria();
							$c->addJoin(ForumAnswerPeer::USER_ID,UserPeer::ID,Criteria::JOIN);
							$c->add(UserPeer::TYPE,'5');
							$c->add(ForumAnswerPeer::FORUM_QUESTION_ID,$question->getId());
							$c->add(ForumAnswerPeer::BEST_RESPONSE,'0');
							$exp_answers=ForumAnswerPeer::doSelect($c);
					
					?>
					
					<?php if($exp_answers != NULL) : ?>
					
					
					<?php foreach($exp_answers as $post): ?>
					
					
					<?php $c = new Criteria();
						  $c->add(UserPeer::ID,$post->getUserId()); 
						  $user=UserPeer::doSelectOne($c);
						  						  
					?>
						
					  <div class="spacer"></div>

                        <div class="expertrplyb" style="margin:0 0 0 13px;position:relative; top:-22px; z-index:3;">
                        	<div class="ptitleb" style="padding:12px 0 0 15px;">
									<div style="float:left">Expert Answer <?php echo $j; ?></div> 
									
									<?php
											
											$c=new Criteria();
											$c->add(ForumQuestionPeer::ID,$post->getForumQuestionId());
											$questionid=ForumQuestionPeer::doSelectOne($c);
									
									?>
														
									
				<?php  if($sf_user->getRaykuUserId() == $questionid->getUserId() ): ?>
									
										
	<?php echo link_to('Set as best','forum_answer/bestresponse?post_id='.$post->getId().'&temp='.$post->getUpdatedAt(),array('class' => 'setbest')); ?>
										
																			
									 <?php endif; ?>
															
							</div>
                            <div class="msgb">
                            	 <?php echo $post->getAnswer(); ?>
                            </div>
                            <table class="b">
                                <tr>
                                    <td class="user">
                                       
									    <?php echo avatar_tag_for_user($user); ?>
										
									  <!--  <img src="images/dev/emptyprofile-small.gif" alt="" />-->
                                       <?php echo link_to($user->getUsername(), '@profile?username=' . $user->getUsername(),array('class' => 'username')); ?>
                                        <p class="pnts">Points: 300</p>
                                        <p class="awrds">Awards: 5</p>

                                        <div class="spacer"></div>

                                        <?php 	
												$c=new Criteria();
												$c->add(ExpertCategoryPeer::USER_ID,$post->getUserId());
												$cat=ExpertCategoryPeer::doSelectOne($c); 
												
												$c=new Criteria();
												$c->add(CategoryPeer::ID,$cat->getCategoryId() );
												$cat_name=CategoryPeer::doSelectOne($c);
												
												
										?>
									   
									    <div class="expertise"><?php echo $cat_name->getPrefix();?></div>
										
									</td>
                                </tr>
                            </table>
                          <div class="spacer"></div>
                            <div class="btmb"></div>
                      </div> 
					
					<?php $j++; ?>

					<?php endforeach ?>
					
				 <?php endif; ?>
				 
<!--				  <div id="commrply"> <?php // echo count($others_ans->getResults()); ?> Community Reply</div>
-->					 
					 
					 <?php  
							$c=new Criteria();
							$c->addJoin(ForumAnswerPeer::USER_ID,UserPeer::ID,Criteria::JOIN);
							$c->add(UserPeer::TYPE,'5',Criteria::NOT_EQUAL);
							$c->add(ForumAnswerPeer::FORUM_QUESTION_ID,$question->getId());
							$c->add(ForumAnswerPeer::BEST_RESPONSE,'1');
							$others_best=ForumAnswerPeer::doSelect($c);
					
					?>
					
					<?php if($answers != NULL) : ?>
					
				
				 <?php foreach($others_best as $post): ?>
					 
					 	<?php $c = new Criteria();
						  $c->add(UserPeer::ID,$post->getUserId()); 
						  $user=UserPeer::doSelectOne($c);
						  						  
					?>
					
                        <div class="box">
                        	<div class="topb"></div>
                            <div class="contentb">
                               <div class="userinfo">
                                	
									<div class="avatar-holder" style="float:none !important;">

									<?php echo avatar_tag_for_user($user); ?>

									</div>
                                    <div class="spacer"></div>

                                 <?php echo link_to($user->getUsername(), '@profile?username=' . $user->getUsername(),array('class' => 'username')); ?>

                                    <div class="points">Points: 300</div>
                                    <div class="medals">Awards: 5</div>
                                </div>
                          
                          <div class="cmmtb">
                          <div class="info">
						  
						  					<?php
					
												$d1=explode(' ', $post->getUpdatedAt());
												$d=explode('-',$d1[0]);
												$t=explode(':',$d1[1]);
												$date=date('F jS , Y  \a\t  h:i a',mktime($t[0],$t[1],$t[2],$d[1],$d[2],$d[0]));
														
											?>
						  
                                    <div class="postdate">Posted on <?php echo $date; ?></div>
								
									<div class="bestr"></div>
									 <div class="clear-both"></div>
									
                                </div>
                                <p class="message"><?php echo nl2br(htmlentities($post->getAnswer())) ?> </p>
                          </div>
                                <div class="spacer"></div>
                            </div>
                            <div class="spacer"></div>
                            <div class="bottom"></div>
                        </div>
						
				<?php endforeach ?>		
				
				<?php endif; ?>
				
				<?php  
							$c=new Criteria();
							$c->addJoin(ForumAnswerPeer::USER_ID,UserPeer::ID,Criteria::JOIN);
							$c->add(UserPeer::TYPE,'5',Criteria::NOT_EQUAL);
							$c->add(ForumAnswerPeer::FORUM_QUESTION_ID,$question->getId());
							$c->add(ForumAnswerPeer::BEST_RESPONSE,'0');
							$others_ans=ForumAnswerPeer::doSelect($c);
					
					?>
					
				<?php if($others_ans != NULL): ?>
				
				<?php foreach($others_ans as $post): ?>
				
						<?php $c = new Criteria();
						  $c->add(UserPeer::ID,$post->getUserId()); 
						  $user=UserPeer::doSelectOne($c);
						?>
						
                        <div class="box">
                        	<div class="top"></div>
                            <div class="content">
                               <div class="userinfo">
                                	
									<div class="avatar-holder" style="float:none !important;">

									<?php echo avatar_tag_for_user($user); ?>

									</div>
                                    <div class="spacer"></div>

                                 <?php echo link_to($user->getUsername(), '@profile?username=' . $user->getUsername(),array('class' => 'username')); ?>

                                    <div class="points">Points: 300</div>
                                    <div class="medals">Awards: 5</div>
                                </div>
                          
                          <div class="cmmt">
                          <div class="info">
						  
						  					<?php
					
												$d1=explode(' ', $post->getUpdatedAt());
												$d=explode('-',$d1[0]);
												$t=explode(':',$d1[1]);
												$date=date('F jS , Y  \a\t  h:i a',mktime($t[0],$t[1],$t[2],$d[1],$d[2],$d[0]));
														
											?>
						  
                                    <div class="postdate">Posted on <?php echo $date; ?></div>
									
									<?php
											
											$c=new Criteria();
											$c->add(ForumQuestionPeer::ID,$post->getForumQuestionId());
											$userid=ForumQuestionPeer::doSelectOne($c);
									
									?>
														
											
									
				<?php if($sf_user->getRaykuUserId() == $userid->getUserId() ): ?>
									
										
				<?php echo link_to('Set as best','forum_answer/bestresponse?post_id='.$post->getId().'&temp='.$post->getUpdatedAt(),array('class' => 'setbest')); ?>
										
																			
									 <?php endif; ?>
									
                                </div>
                                <p class="message"><?php echo nl2br(htmlentities($post->getAnswer())) ?> </p>
                          </div>
                                <div class="spacer"></div>
                            </div>
                            <div class="spacer"></div>
                            <div class="bottom"></div>
                        </div>
						
				<?php endforeach ?>		

				<?php endif; ?>
				 

				</div>
				
				<div class="body-side">
					 
										
							<?php 
							
							$c=new Criteria();
							$c->add(ForumQuestionPeer::ID,$questionid);
							$c->add(ForumQuestionPeer::VISIBLE,'1');
							$response=ForumQuestionPeer::doSelectOne($c);
							
							if($response != NULL) {
										   
					 ?>
					 
					 					<div id="status"></div>

										<p id="activate_form">
											
												<?php // echo link_to ('Add response', '', array('id' => 'postLink', 'class'=> 'navlink add')); ?>
												
										</p>
								
								<?php
									
							} ?>

                    </div>

                    <br class="clear-both" />
					