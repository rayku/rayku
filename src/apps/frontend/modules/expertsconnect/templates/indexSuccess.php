<style media="all" type="text/css"> @import "styles/global.css"; </style>

<link rel="stylesheet" href="/js/jquery-tooltip/jquery.tooltip.css" />
<!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>-->
<script src="/js/jquery-tooltip/jquery.dimensions.js" type="text/javascript"></script>
<script src="/js/jquery-tooltip/jquery.tooltip.js" type="text/javascript"></script>

<script type="text/javascript">
	$(function() { 
		$(".content a").tooltip({
			delay: 0,
			showURL: false,
			fixPNG: true,
			fade: 250,
			top: -50,
			track: true,
			extraClass: "rate",
			showBody: " - "
		}); 
	}); 
</script>


				
<div id="body">
					<div id="experts">
                    	<div class="breadcrumb">
                        
                        	<div class="tl"></div>
                            <div class="tr"></div>
                            <div class="br"></div>
                            <div class="bl"></div>
                            
                            <ul>
                            	<li class="active"><a href="#">Home</a></li>
                                <li><a href="/expertmanager/list">Browse Experts</a></li>
                                <li><a href="/online_experts/chathistory">Lesson History</a></li>
                                <li><a href="#">Expert Connect Help</a></li>
                                <div class="clear"></div>
                            </ul>
                            
                        </div><!--breadcrumb-->

							<?php 
											
											$time=time();
											
											$c = new Criteria();
											$c->add(ExpertStudentSchedulesPeer::STUDENT_ID,$sf_user->getRaykuUser()->getId());
											$c->add(ExpertStudentSchedulesPeer::DATE,$time, Criteria::GREATER_EQUAL);
											$c->add(ExpertStudentSchedulesPeer::ACCEPT_REJECT,1);
											$expschedules = ExpertStudentSchedulesPeer::doSelect($c);
										
											if($expschedules != NULL) :
											
									?>


                            <div class="box">
                            	<div class="title"><h1 class="active">Active Experts</h1>
											<a href="/expertmanager/studentlesson" class="button">Reschedule a Lesson</a> 
								</div>
                                <div class="content">
									<div class="br"></div>
		                            <div class="bl"></div>
									<ul>
                                	
									<?php foreach($expschedules as $expschedule): ?>
											
											<?php 
													$c = new Criteria();
													$c->add(ExpertLessonPeer::USER_ID,$expschedule->getExpId());
													$expertlessons = ExpertLessonPeer::doSelectOne($c); 
													
													if($expertlessons !=NULL): 
											
											
													$c = new Criteria();
													$c->add(UserPeer::ID,$expschedule->getExpId());
													$expert = UserPeer::doSelectOne($c);
											
											?>
							
												<li>
													<div class="lesson">
																									
													<a href="/expertmanager/portfolio/<?=$expert->getUsername()?>"><?=$expertlessons->getTitle();?> Lesson</a> with Mr.<?php echo $expert->getName(); ?>
													</div><!--lesson-->
													<div class="date">
														
													<?php 
													
														$date = date('Y-m-d',$expschedule->getDate());
															
														$timing= $expschedule->getTime();
														
														if($timing == '0') { $time='0AM-1AM'; }
														if($timing == '1') { $time= '1AM-2AM'; }
														if($timing == '2') { $time= '2AM-3AM'; }
														if($timing == '3') { $time= '3AM-4AM'; }
														if($timing == '4') { $time= '4AM-5AM'; }
														if($timing == '5') { $time= '5AM-6AM'; }
														if($timing == '6') { $time= '6AM-7AM'; }
														if($timing == '7') { $time= '7AM-8AM'; }
														if($timing == '8') { $time= '8AM-9AM'; }
														if($timing == '9') { $time= '9AM-10AM'; }
														if($timing == '10') { $time= '10AM-11AM'; }
														if($timing == '11') { $time= '11AM-12PM'; }
														if($timing == '12') { $time= '12PM-1PM'; }
														if($timing == '13') { $time= '1PM-2PM'; }
														if($timing == '14') { $time= '2PM-3PM'; }
														if($timing == '15') { $time= '3PM-4PM'; }
														if($timing == '16') { $time= '4PM-5PM'; }
														if($timing == '17') { $time= '5PM-6PM'; }
														if($timing == '18') { $time= '6PM-7PM'; }
														if($timing == '19') { $time= '7PM-8PM'; }
														if($timing == '20') { $time= '8PM-9PM'; }
														if($timing == '21') { $time= '9PM-10PM'; }
														if($timing == '22') { $time= '10PM-11PM'; }
														if($timing == '23') { $time= '11PM-12PM'; }
														
													
														echo $date.",&nbsp;".$time." ";		  
																  
														?>		 													
														
													</div><!--date-->
													<div class="clear"></div>
												</li>
                                       
									   		<?php endif; ?>
                                   
									<?php endforeach ; ?>
									 </ul>
									
                                </div><!--content-->
                            </div><!--box-->
                            
							<?php endif; ?>
							
							
                            <a href="/online_experts" class="help">
                            	<h1>Urgent? <span>Get Help Now</span></h1>
                                Click here and get connected to an online expert immediately
                            </a><!--help-->
                            
                            <div class="small">
                            	
							<?php 
							
								$c = new Criteria();
								$c->add(SavedExpertsPeer::USER_ID,$sf_user->getRaykuUser()->getId());
								$savedexperts = SavedExpertsPeer::doSelect($c);
									
							?>
								
								<div class="title"><h1 class="saved">Saved Experts</h1></div>
                                <div class="content" id="caca">
                                	
                                    <div class="bl"></div>
                                    <div class="br"></div>
                                    
                                    <?php if($savedexperts != NULL): ?>
									
										
										<?php $count = 0; ?>
										
										<?php foreach($savedexperts as $savedexpert): ?>
										
												<?php 
												
																									
														$c = new Criteria();
														$c->add(UserPeer::ID,$savedexpert->getExpertId());
														$expert = UserPeer::doSelectOne($c);
														 										
																								
												?>
																				
										<ul class="<?php echo ($count++%2 == 0)?"even":"odd" ; ?>">
                                        	
												 <?php if($expert->isOnline()) : ?>
											
												  <li><a href="<?php echo url_for('@profile?username='.$expert->getUsername()); ?>" class="online" title="$24 - hour"><?php echo $expert->getName(); ?> </a></li>
												  <?php else: ?>
												  
												   <li><a href="<?php echo url_for('@profile?username='.$expert->getUsername()); ?>" class="offline" title="$24 - hour"><?php echo $expert->getName(); ?> </a></li>
												  
												  <?php endif; ?>
												  
                                        </ul><!--odd-->
                                                                   
									   <?php endforeach ; ?>
									   
									   <?php else: ?>
									   
									   		<ul>
											<li style="color:#056A9A; font-weight:bold; font-size:16px; padding:20px;">No experts saved. </li>
											</ul>
									   <?php endif; ?>
									   
									                                          
                                        <div class="clear"></div>
                                    
									
									
                                </div><!--content-->
								
								
								
                            </div><!--small-->
                        
                        	<div class="clear"></div>
                            
                            <div class="search">
                            	<form action="expertsconnect/searchexpert" method="post">
                           	    <input type="text" name="criteria" value="Enter Experts Name Here (E.g. John Smith)" onblur="if(this.value=='') this.value='Enter Experts Name Here (E.g. John Smith)';" onfocus="if(this.value=='Enter Experts Name Here (E.g. John Smith)') this.value='';" />
                       	      <input type="hidden" name="expertsearch" value="5" />
                                    <input type="submit" value=" " />
                                    <div class="clear"></div>
                                </form>
                            </div><!--search-->
                        
                        <div class="box">
                        	<div class="title"><h1 class="best">Top Experts</h1></div>
                            <div class="content">
                            	
                                <div class="bl"></div>
                                <div class="br"></div>
                            
								<?php $allcounts = array(); ?>
								
								<?php
										
										$cats = CategoryPeer::doSelect(new Criteria());
										
										foreach($cats as $cat)
										{
											$allcounts[] = $cat->getId();
										}
										
										if(count($allcounts) > 3)
										{
											
											$randcats = array_rand($allcounts,3);
										}
										
										for($i=0;$i<3;$i++)
										{
											if( $allcounts[$randcats[$i]] != ''):
																																	
												 $c = new Criteria();
												 $c->add(CategoryPeer::ID,$allcounts[$randcats[$i]]);
												 $cat = CategoryPeer::doSelectOne($c);
																							
												?>
																							
													<ul class="english">
													<h1><?php echo $cat->getName();?> </h1>
													
														<?php
														 
														$c = new Criteria();
														$c->addJoin(ExpertCategoryPeer::USER_ID,UserPeer::ID,Criteria::JOIN);
														$c->add(ExpertCategoryPeer::CATEGORY_ID,$cat->getId());
														$c->addDescendingOrderByColumn(UserPeer::POINTS);
														$c->setLimit(5);
														$expertcats = ExpertCategoryPeer::doSelect($c);
																										
															foreach($expertcats as $expertcat):
																
																	$c = new Criteria();
																	$c->add(UserPeer::ID,$expertcat->getUserId());
																	$users = UserPeer::doSelectOne($c);
																																		
																																																		
																		$c = new Criteria();
																		$subSelect = "expert_lesson .price IN (
																			SELECT
																				  min(expert_lesson.price)
																			FROM
																				  expert_lesson
																			WHERE
																				 expert_lesson.user_id = ".$users->getId()."
																			)";
																		$c->add(ExpertLessonPeer::PRICE, $subSelect, Criteria::CUSTOM);
																		$lessprices = ExpertLessonPeer::doSelect($c);
																	
																	
																		$lessvalue = 'N/A';
																		
																		foreach($lessprices as $lessprice) :
																		
																			$lessvalue = '$'.$lessprice->getPrice();
																		
																		endforeach ;
																		
																																	
																	?>
																	
																																	
																	
																	<?php if($users->isOnline()) : ?>
																	
																	<li><a href="<?php echo url_for('@profile?username='.$users->getUsername()); ?>" class="online" title="<?=$lessvalue;?> - hour"><?php echo $users->getName(); ?></a> </li>
																	<?php else: ?>
																	
																	<li><a href="<?php echo url_for('@profile?username='.$users->getUsername()); ?>" class="offline" title="<?=$lessvalue;?> - hour"><?php echo $users->getName(); ?></a> </li>
																	
																	<?php endif; ?>
																	
																	<?php 
															
															
															endforeach; 
															
															?>
														
														 </ul>
													
													<?php
												
											
											endif;
											
											
										}
								?>
								                           									
                                <div class="clear"></div>
                            </div><!--content-->
                        </div><!--box-->
                    
                    </div><!--experts-->                    
                    
					
</div>
	
