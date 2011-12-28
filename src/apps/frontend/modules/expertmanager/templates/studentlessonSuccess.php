<style media="all" type="text/css"> @import "/styles/ex_supernote.css"; </style>


<div class="body-main">
				
		<h3>Experts Lessons</h3>
		<div class="pbox">
			<div class="top">
				<div class="name">Name</div>
				<div class="schedule">Scheduled Time / Date</div>
		  </div>
			
			<?php  
			$count = 0;
			
			foreach($lessonids as $lessonid): ?>
			
				<?php 
						
						$c=new Criteria();
						$c->add(ExpertLessonPeer::ID,$lessonid->getLessonId());
						$expert_lesson=ExpertLessonPeer::doSelectOne($c);
						
						
						$c=new Criteria();
						$c->add(ExpertLessonSchedulePeer::EXPERT_LESSON_ID,$expert_lesson->getId());
						$schedules=ExpertLessonSchedulePeer::doSelect($c);
				
				?>
			
			<div class="<?php echo ($count++%2 == 0)?"light":"dark"; ?>">
				<div class="name"><?php echo $expert_lesson->getTitle(); ?></div>
				<div class="schedule"><?php echo $expert_lesson->getDay(); ?>
				
					<?php foreach($schedules as $schedule):
								
								echo '('.date('d-m-Y',$schedule->getDate()).')';
								
								$time=explode("|",$schedule->getTimings());
							
									foreach($time as $timing):
										
										if($timing == '0') { echo '(0am-1am)'; }
										if($timing == '1') { echo '(1am-2am)'; }
										if($timing == '2') { echo '(2am-3am)'; }
										if($timing == '3') { echo '(3am-4am)'; }
										if($timing == '4') { echo '(4am-5am)'; }
										if($timing == '5') { echo '(5am-6am)'; }
										if($timing == '6') { echo '(6am-7am)'; }
										if($timing == '7') { echo '(7am-8am)'; }
										if($timing == '8') { echo '(8am-9am)'; }
										if($timing == '9') { echo '(9am-10am)'; }
										if($timing == '10') { echo '(10am-11am)'; }
										if($timing == '11') { echo '(11am-12pm)'; }
										if($timing == '12') { echo '(12pm-1pm)'; }
										if($timing == '13') { echo '(1pm-2pm)'; }
										if($timing == '14') { echo '(2pm-3pm)'; }
										if($timing == '15') { echo '(3pm-4pm)'; }
										if($timing == '16') { echo '(4pm-5pm)'; }
										if($timing == '17') { echo '(5pm-6pm)'; }
										if($timing == '18') { echo '(6pm-7pm)'; }
										if($timing == '19') { echo '(7pm-8pm)'; }
										if($timing == '20') { echo '(8pm-9pm)'; }
										if($timing == '21') { echo '(9pm-10pm)'; }
										if($timing == '22') { echo '(10pm-11pm)'; }
										if($timing == '23') { echo '(11pm-12pm)'; }
									
									endforeach;
								
						  endforeach;
					 ?>
				
				</div>
				
				<div class="hist"><?php echo link_to('AskReschedule','expertmanager/studentreschedule?l_id='.$lessonid->getLessonId().'&e_id='.$lessonid->getExpertId().'',array('class' => 'blue1')); ?></div>
				
			</div>
			
			<?php endforeach; ?>
		
			
			<div class="bot"></div>
		</div><!--pbox-->
		
		
</div>
