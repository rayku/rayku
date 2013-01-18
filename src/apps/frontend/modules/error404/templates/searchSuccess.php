<?php use_helper('Text'); ?>
					<div class="body-main">
                        <div class="box">
                        	<div class="top"></div>
                            <div class="content">

                             	
<?php
  $threads = $raykuPager->getPager()->getResults();
?>
							<?php if ( count( $threads ) > 0 ): ?>
                  <div style="padding-right: 10px;" >
                    <?php include_partial( 'global/pager', array( 'raykuPager' => $raykuPager ) ); ?>
                  </div>
									<div class="title">Search results for "<?php echo $keyword; ?>" </div>
							
							   
							   <?php foreach( $threads as $thread): ?>

			<?php if($thread->getCancel() != 1) { ?>


							   

                               <?php  $c=new Criteria();
							   		  $c->addAscendingOrderByColumn(PostPeer::ID);
									  $c->add(PostPeer::THREAD_ID,$thread->getId());
									  $c->setLimit(1);
									  $post=PostPeer::doSelectOne($c);
								?>
							   
							   
							   <div class="entry">
                               		<div class="status"><img src="<?php echo image_path('forum-threads-statuson.gif', false); ?>" alt="" /></div>
                                    <div class="information">
                                    	
										<?php echo link_to($thread, '@view_thread?thread_id='.$thread->getId(),array('class' => 'threadttle')); ?>
										
                                        <div class="threadst"><?php echo $post->getContent(); ?></div>
                                    </div>
									
                                   	<?php 
									
											$c = new Criteria();
											$c->add(UserPeer::ID,$post->getPosterId());
											$user= UserPeer::doSelectOne($c);
									
									?>
									
									<?php  echo link_to($user->getUsername(), '@profile?username=' . $user->getUsername(),array('class' => 'author')); ?>
									
									<?php 
			  		
											$c =new Criteria();
											$c->add(PostPeer::THREAD_ID,$post->getId());
											$countofpost= PostPeer::doCount($c);
									  
									  ?>
									
									
									<div class="replies"><?php  echo ($countofpost - 1) ; ?> Replies</div>
                                   	<div class="spacer"></div>
                               </div>
							   

						<?php } ?>
							   <?php endforeach; ?>
							   
						<?php  else: ?>
							
									<div class="title">	Sorry! No search results for "<?php echo $keyword; ?>" . 	</div>
							   
						 <?php endif; ?>

                            </div>
                            <div class="spacer"></div>
                            <div class="bottom"></div>
                        </div>

                        
					</div>
					
					<div class="body-side">
						<!--<a href="#" class="navlink add">Start a new thread</a>-->

                        <div class="spacer"></div>

                        <div class="box">
                        	<div class="top"></div>
                            <div class="content">
                            	<div class="title">Top Keywords</div>

                                <div class="spacer"></div>

                                <a href="#" class="keyword">Math</a>
                                <a href="#" class="keyword">Calculus</a>
                                <a href="#" class="keyword">Equations</a>
                                <a href="#" class="keyword">Algebra</a>
                                <a href="#" class="keyword">Measurement</a>

                                <div class="spacer"></div>

                                <div class="title" style="margin-top:19px">Search for a topic</div>
								
								
								<?php  echo form_tag('@search_thread', array('method'=>'post')); ?>
								                              	
										<input type="text" id="searchbox" name="threadsearch"/>
										
										<?php // echo input_hidden_tag('forum_id',$forumId); ?>
										
										<div class="spacer"></div>
										<?php echo submit_tag('search',array('class' => 'blue')); ?>
										<div class="spacer"></div>
									</form>

                            </div>
                            <div class="spacer"></div>
                            <div class="bottom"></div>
                        </div>

                        <div class="spacer"></div>
                        
						<?php  echo link_to('Back to Public Forums', '@view_forums',array('class' => 'btmlnk')); ?>
						
					</div>

            
