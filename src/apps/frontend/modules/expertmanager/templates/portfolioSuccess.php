<?php
    use_helper('MyAvatar', 'Javascript');
    $connection = RaykuCommon::getDatabaseConnection();
?>

<link type="text/css" rel="stylesheet" href="/styles/ex_global.css" />
<link type="text/css" rel="stylesheet" href="/styles/ex_donny.css" />

<style type="text/css" media="all">


.entry select {
	width:295px; height:40px;
	background:#fff url(images/add-journal-view.gif) no-repeat;
	float:left;
	margin-right:5px;
	color:#3d3d3d;
	font:14px "Arial";
	border:0px;
	padding:11px 10px 10px 12px;
	}
</style>

<link rel="stylesheet" type="text/css" href="http://www.rayku.com/styles/popup-window.css" />

<script type="text/javascript" src="http://www.rayku.com/scripts/js/popup-window.js"></script>
	<!--<script type="text/javascript" src="http://www.rayku.com/js/jquery-1.4.2.min.js"></script>
   	<script type="text/javascript" src="http://www.rayku.com/scripts/fancybox/jquery.fancybox-1.3.1.js"></script>
	<link rel="stylesheet" type="text/css" href="http://www.rayku.com/scripts/fancybox/jquery.fancybox-1.3.1.css" media="screen" />
	<script type="text/javascript">
		$(document).ready(function() {
			$("#various1").fancybox({
				'titlePosition'		: 'inside',
				'transitionIn'		: 'none',
				'transitionOut'		: 'none'
			});
		});
	</script>-->


	<div id="top" style="margin-left:18px;padding-top:2px">
		<div class="title" style="float:left;">
			<img src="<?php echo image_path('arrow-right.gif', false); ?>" alt="" />
			<p style="line-height:24px"><?php echo $expert->getName(); ?>'s Tutor Portfolio <!--<span>(username)</span>--></p>
		</div>

		<div class="spacer"></div>
	</div>


	<div class="body-main">

		<div class="box">
			<div class="top"></div>
			<div class="content3" style="font-size:14px">
            <?php 

						$queryRPRate = mysql_query("select * from user_rate where userid=".$expert->getId()." ", $connection) or die(mysql_error());

					if(mysql_num_rows($queryRPRate)) {

					$rowRPRate = mysql_fetch_assoc($queryRPRate); 

					$rate = $rowRPRate['rate'];


					} else {

					$rate = '0.16';

					} ?>
            <h1>How I Can Help: &nbsp;&nbsp;
			
					<?php if($sf_user->getRaykuUser()->getId() == $expert->getId() ) : ?>
 

		<a href="#" onclick="popup_show('popup', 'popup_drag', 'popup_exit', 'screen-center', 0, 0);">[edit promo text]</a>
						
						
					<?php endif; ?>
				
				
</h1>
				
					<p>
					<?php 
							$c= new Criteria();
							$c->add(ExpertsPromoTextPeer::EXP_ID,$expert->getId());
							$promotext = ExpertsPromoTextPeer::doSelectOne($c);
							
					?>
					
					
					<?php if($promotext != NULL): ?>
			
						<?php echo $promotext->getContent(); ?>
					
					<?php else: ?>
					
					Welcome to my portfolio profile. I am a new expert at Rayku so you may not be able to see much on this page. Though, if you have a question that's within my field, I'm sure I can help you out!<br />
					<br />
					I charge <strong><? echo $rate; ?>RP per minute</strong>.			  <br />
					<br />
					If I'm online, connect with me! If not, feel free to leave me a message and I'll get back to you.
                    </p>
			  <?php endif; ?>
				
			
			</div>
		<div class="bottom"></div>
		</div>
      
      <!-- <h3>Immediate 1-on-1 Help Topics</h3>
	  
	 <?php 
			
				$c = new Criteria();
				$c->add(ExpertsImmediateLessonPeer::USER_ID, $expert->getId());
				$expert_immediate_lessons = ExpertsImmediateLessonPeer::doSelect($c);
				
				$count = 0;
	?>	
	
	  <?php if($expert_immediate_lessons != NULL): ?>
	  
		  <div class="pbox">
				<div class="top">
					<div class="name">Course Name</div>
					<div class="schedule">Availability / Order Information</div>
					<div class="price">Pricing</div>
				</div>
				
				<?php foreach($expert_immediate_lessons as $expert_lesson):?>
				<?php echo form_tag('online_experts/immediate'); ?>
				<input type="hidden" name="expert_immediate_lesson_id" value="<?php echo $expert_lesson->getId(); ?>" />
				<input type="hidden" name="expert_id" value="<?php echo $expert_lesson->getUserId(); ?>" />
				<div class="<?php echo ($count++%2 == 0)?"light":"dark"; ?>">
					<div class="name"><?php echo $expert_lesson->getTitle(); ?></div>
					<div class="schedule" style="font-size:8px">
					<?php if ($expert->isOnline()): ?>                        
						<?php echo submit_image_tag('/images/start.png', array('width' => '71', 'height' => '19', 'border' => '0')); ?>
					<?php else: ?>
						<img src="<?php echo image_path('start-gray.png', false); ?>" /><br />
						(expert is offline)
					<?php endif; ?>
					</div>
					<div class="price">$<?php echo $expert_lesson->getPrice();?> / Minute</div>
				</div>
				</form>
				<?php endforeach; ?>
				
				<div class="bot"></div>
		</div>
	
		<?php else : ?>
		
			<p style="font-size:12px; font-family:verdana; color:#000000; font-weight:bold; padding-left:30px; padding-top:5px; padding-bottom:20px;">No immediate lessons created yet! </p>
	
	<?php endif;?>
	
	<div class="clear-both"></div>
	
		<h3>Scheduled Lesson Topics</h3>
		
		<?php 
				$c = new Criteria();
				$c->add(ExpertLessonPeer::USER_ID, $expert->getId());
				$expert_lessons = ExpertLessonPeer::doSelect($c);
				$count = 0;
		?>	

		<?php if($expert_lessons != NULL): ?>
		
				<div class="pbox">
					<div class="top">
						<div class="name">Course Name</div>
						<div class="schedule">Order Information</div>
						<div class="price">Pricing</div>
					</div>
					
					<?php foreach($expert_lessons as $expert_lesson):?>
					<?php echo form_tag('expertmanager/checkout'); ?>
					<input type="hidden" name="expert_lesson_id" value="<?php echo $expert_lesson->getId(); ?>" />
					<input type="hidden" name="expert_id" value="<?php echo $expert_lesson->getUserId(); ?>" />
					<div class="<?php echo ($count++%2 == 0)?"light":"dark"; ?>">
						<div class="name"><?php echo $expert_lesson->getTitle(); ?></div>
						<div class="schedule">
							<?php echo submit_image_tag('/images/start.png', array('width' => '71', 'height' => '19', 'border' => '0')); ?>
						</div>
						<div class="price">$<?php echo $expert_lesson->getPrice();?> / Hour</div>
					</div>
					</form>
					<?php endforeach; ?>
		
					<div class="bot"></div>
				</div>
				
		<?php else : ?>
		
			<p style="font-size:12px; font-family:verdana; color:#000000; font-weight:bold; padding-left:30px; padding-top:5px;">No scheduled lessons created yet! </p>
	
	<?php endif;?>	-->

    
<div class="sample_popup"     id="popup" style="display: none;">

<div class="menu_form_header" id="popup_drag" style="background:#069 none;border:2px solid #069;height:25px;">
<img class="menu_form_exit"   id="popup_exit" src="http://www.rayku.com/styles/form_exit.png" alt="" /></div>

<div class="menu_form_body" style="background:#FFF;border:2px solid #069">
					<?php if(!empty($promotext)) {

						$content = $promotext->getContent();

					}  ?>



					<?php echo form_tag('expertmanager/promotext') ?>
						  <p style="padding:10px;font-weight:bold;font-size:14px;color:#333">Enter your promotional message here: </p>
							
														
						
		<?php echo textarea_tag('content',$content,array('size' => '54x40', 'rich' => 'fck')); ?>							
							<br />
							
						  <?php echo submit_tag('Edit Promo Text',array('style' => 'padding:5px;font-size:13px;')) ?>
						</form>
</div>

</div>

		<h3 style="font-size:20px; line-height:35px; margin-top:40px">Previous Rayku Work</h3>
		<div class="box">
			<div class="top"></div>
			<div class="content2">
				<h4 style="font-size:14px; font-weight:bold">Video Sessions with Students:</h4>
				<a href="<?php echo url_for('whiteboard/sessions/') . '/' . $expert->getUsername() ?>">view all sessions</a>
				<div class="entry" style="margin-top:10px;">
				  
				  <div class="portimg">  				
  					  <div class="sessions">
  					    
  					    <?php if (count($lastSessions) > 0) { ?>
  					      <div class="question">
  					        <a href="<?php echo url_for('whiteboard/show?id=' . $lastSessions[0]->getId()) ?>"> <?php echo urldecode($lastSessions[0]->getQuestion()) ?> </a>
                  </div>
  					    <?php } else { ?>
  					      <div>no sessions</div>
  					    <?php }; ?>
                
              </div>
  					<div class="desc">
  				    <span>This Feature</span> is being worked on, and will be available soon.
  				  </div>
  				</div>
				
  				<div class="portimg">  				
  					  <div class="sessions">
                
                <?php if (count($lastSessions) > 1) { ?>
  					      <div class="question">
  					        <a href="<?php echo url_for('whiteboard/show?id=' . $lastSessions[1]->getId()) ?>"> <?php echo urldecode($lastSessions[1]->getQuestion()) ?> </a>
                  </div>
  					    <?php } else { ?>
  					      <div>no sessions</div>
  					    <?php }; ?>
                
              </div>
  					<div class="desc">
  				    <span>This Feature</span> is being worked on, and will be available soon.
  				  </div>
  				</div>
                
          <div class="portimg">
            <div class="sessions">
              
              <?php if (count($lastSessions) > 2) { ?>
					      <div class="question">
					        <a href="<?php echo url_for('whiteboard/show?id=' . $lastSessions[2]->getId()) ?>"> <?php echo urldecode($lastSessions[2]->getQuestion()) ?> </a>
                </div>
					    <?php } else { ?>
					      <div>no sessions</div>
					    <?php }; ?>
              
            </div>
					<div class="desc">
				    <span>This Feature</span> is being worked on, and will be available soon.
				  </div>
          </div>
        
                <!--<div class="portimg">
					<a href="#"><img src="<?php echo image_path('img_portfolio.jpg', false); ?>" alt="img" /></a>
					<div class="desc"><span>Video Title here</span>  -  Enter your very short description here :-).</div>
				</div>
                
                <div class="clear-both" style="height:10px"></div>
                
                <div class="portimg">
					<a href="#"><img src="<?php echo image_path('img_portfolio.jpg', false); ?>" alt="img" /></a>
					<div class="desc"><span>Video Title here</span>  -  Enter your very short description here :-).</div>
				</div>
                
                <div class="portimg">
					<a href="#"><img src="<?php echo image_path('img_portfolio.jpg', false); ?>" alt="img" /></a>
					<div class="desc"><span>Video Title here</span>  -  Enter your very short description here :-).</div>
				</div>
                
                <div class="portimg">
					<a href="#"><img src="<?php echo image_path('img_portfolio.jpg', false); ?>" alt="img" /></a>
					<div class="desc"><span>Video Title here</span>  -  Enter your very short description here :-).</div>
				</div>-->
				
			  <div class="clear-both"></div>

					<div class="spacer"></div>
				</div>
			</div>
			<div class="bottom"></div>
		</div>
        
<div class="box">
			<div class="top"></div>
			<div class="content2">
            <h4 style="font-size:14px; font-weight:bold; margin-bottom:10px">Best Responses on the Question Boards:</h4>
		
		<?php  
		
			   $c=new Criteria();
			   $c->add(PostPeer::POSTER_ID,$expert->getId());
			   $c->add(PostPeer::BEST_RESPONSE, '1');
			   $c->addDescendingOrderByColumn('ID');
			 //  $c->setLimit(2);
			   $best_responses=PostPeer::doSelect($c);
			   
		?>
         <?php //print_r($best_responses);
		 ?>
		
			<?php if($best_responses != NULL): 
			
			?>
							
					  <ul>
					<?php foreach($best_responses as $best_response): 
                                 ?>  
                                 
                                 
                                 <li>
								 
								 <strong>
								 <?php $query = mysql_query("select * from thread where id='".$best_response->getThreadId()."' ", $connection) or die(mysql_error());
	                			       $row = mysql_fetch_assoc($query);
	                			       //echo $row['title'];
									   echo link_to($row['title'], '@view_thread?thread_id='.$row['id'],array('class' => 'threadttle'));
									   
									   ?>
                                       
                                       
                                       
                                       </strong><?php 
								//$a = new Criteria(); 
								//$a->add(ThreadPeer::ID,$best_response->getThreadId());
								//$threads = ThreadPeer::doSelectOne($a); 
								
								//print_r($threads);
								//echo $best_response->getThreadId();
								
								//echo link_to($row['title'], '@view_thread?thread_id='.$row['id'],array('class' => 'threadttle'));
								
	           
								
								
								
								?>
                               
									

								
					<?php endforeach; ?>
                    </ul>	
            <?php 
						else :
                    		echo 'This expert does not have any \'best response\' answers yet. Please check back later.';
                    	endif; ?>
		</div>
		<div class="bottom"></div>
		</div>


        
<div class="box">
			<div class="top"></div>
			<div class="content2">
            <h4 style="font-size:14px; font-weight:bold; margin-bottom:10px">Followers:</h4>
		
			<?php

		$logedUserId = $_SESSION['symfony/user/sfUser/attributes']['symfony/user/sfUser/attributes']['user_id'];


$query = mysql_query("select * from expert_subscribers where expert_id=".$expert->getId(), $connection) or die("error1");

if(mysql_num_rows($query) > 0) {

?>

<ul>

<?php


while($row = mysql_fetch_array($query)) {


$queryUser = mysql_query("select * from user where id=".$row["user_id"], $connection) or die("error2");

$rowUser = mysql_fetch_array($queryUser);

?>

<li><img src="http://www.rayku.com/images/classroom_commentbubble.gif"> <a href="http://www.rayku.com/profile/<?php echo $rowUser["username"]; ?>"><?php echo $rowUser["name"]; ?></a></li>



<?php } ?>

</ul> 

<?php } else { ?>

<p>This expert has no followers yet. Be the first by asking them a question!</p>

<?php }


?>
		</div>
		<div class="bottom"></div>
		</div>
        
		
	  <div class="spacer"></div>
	</div>




	<div class="body-side">

	

		<div class="box">
			<div class="top"></div>
			<div class="content" style="position:relative; _top:-3px; _bottom:-3px;">
				<div class="text">
					<div class="displaypic"><?php echo link_to( avatar_tag_for_user($expert), '@profile?username=' . $expert->getUsername() ); ?></div>
					<h1 class="name" style="font-size:14px"><?php echo link_to( $expert->getName(), '@profile?username=' . $expert->getUsername(), 'style=color:#257000'); ?></h1>
					<br /><br />
                    <strong style="float:left;">Member Since:&nbsp;</strong><? echo $expert->getCreatedAt('m-Y'); ?><br />
                    <strong>Points:</strong> 
					<?php $logedUserId = $expert->getID();
		$query = mysql_query("select * from user where id=".$logedUserId." ", $connection) or die(mysql_error());
		$detailPoints = mysql_fetch_assoc($query);
		echo $detailPoints['points']; ?>RP
        <br />
				<!-- Show the Charge amount for Live Help - start--->

					

					<strong >Rate:&nbsp;</strong><? echo $rate; ?>RP/minute<!-- Show the Charge amount for Live Help - end--->


					
                    <div class="clear-both" style="margin-top:10px"></div>
					
					<div class="status">
						This user is <?php if ($expert->isOnline()): ?><span class="online">online</span>
						<?php else: ?><span class="offline">offline</span><?php endif; ?>
					</div>
	<?php if($sf_user->getRaykuUser()->getId() != $expert->getId() ) : ?>

                    <?php if ($expert->isOnline()): ?>
					<a href="../direct?id=<?php echo $expert->getId(); ?>" class="contact" style="background:url(http://www.rayku.com/images/contact2.gif)">Connect</a>
                    <?php else: ?><a href="http://www.rayku.com/message/compose/<?php echo $expert->getUsername(); ?>" class="contact">Contact</a><?php endif; ?>
				
	<?php endif; ?>	
					<div class="clear-both"></div>
					
				</div>
			</div>
			<div class="bottom"></div>
		</div>


		
		<div class="box">
			<div class="top"></div>
			<div class="content" style="position:relative; _top:-3px; _bottom:-3px;">
				<h1 class="tit">Session Ratings</h1>
				<div class="about">
				<?php	$_query = mysql_query("select * from whiteboard_chat where expert_id =".$expert->getId()." and rating !='' ", $connection) or die(mysql_error());
					$chat_rating = 0; $rating_count = 0; $avg_rating = 0;
					
					if(mysql_num_rows($_query) > 0) {

					$rating_count = mysql_num_rows($_query);

						while($_row = mysql_fetch_array($_query)) {

							$chat_rating += $_row['rating'];

					
						}

	 				$avg_rating = $chat_rating / $rating_count;

					} 
				?>

				</div>
               <!-- <?php if($expert->getUsername() == $sf_user->getRaykuUser()->getUsername()): ?>-->

		<?php if(!empty($avg_rating)): ?>

               			 <p style="font-size:12px; margin-top:10px;">Average Session Rating : &nbsp;&nbsp;&nbsp;&nbsp;<strong><a id="various1" href="#inline1" style="color:rgb(255, 102, 0);"><?php echo number_format($avg_rating, 2); ?></a></strong> </p>
		<?php else: ?>
				<p style="font-size:12px; margin-top:10px;">Average Session Rating : - </p>
		<?php endif; ?>
               <!-- <?php endif; ?>-->
                
			</div>
			<div class="bottom"></div>
		</div>



		<div class="box">
			<div class="top"></div>
			<div class="content" style="position:relative; _top:-3px; _bottom:-3px;">
				<h1 class="tit">About <?php echo $expert->getName(); ?></h1>
				<div class="about">
					<?php $expertaboutmeval = $expert->getAboutMe(); 
					
						if($expertaboutmeval != NULL): 
							echo $expert->getAboutMe();
						else :
                    		echo 'No information about this expert is currently available. Please check back later.';
                    	endif; ?>

				</div>
                <?php if($expert->getUsername() == $sf_user->getRaykuUser()->getUsername()): ?>
                <p style="font-size:12px; margin-top:10px;"><a href="http://www.rayku.com/register/step3" style="color:#900">Edit Your 'About Me' Message</a></p>
                <?php endif; ?>
                
			</div>
			<div class="bottom"></div>
		</div>
		
	<?php 	
		
		$user_ids = array();
		
		$c = new Criteria();
		$c->add(UserPeer::TYPE,5);
		$c->addDescendingOrderByColumn(UserPeer::POINTS);
		$c->setLimit(5);
		$users = UserPeer::doSelect($c);
	
		foreach($users as $key => $user) {
					
			if( $user->getId() == $expert->getId() )
			{
				$rank = $key+1; 
			}
		
		}
		
	?> 
	
	<?php
			
			$categories = CategoryPeer::doSelect(new Criteria());
			
			$category_ranks = array();
			
			foreach($categories as $category): 
				
					$c = new Criteria();
					$c->addJoin(ExpertCategoryPeer::USER_ID,UserPeer::ID,Criteria::JOIN);
					$c->add(ExpertCategoryPeer::CATEGORY_ID,$category->getId());
					$c->addDescendingOrderByColumn(UserPeer::POINTS);
					$c->setLimit(5);
					$expertcats = ExpertCategoryPeer::doSelect($c);

										
					foreach($expertcats as $key => $expertcat) {
					
						if( $expertcat->getUserId() == $expert->getId() )
						{
							$cat_rank = $key+1;
							
							$category_ranks[] = $cat_rank .','.$expertcat->getCategoryId();
						}
					
					}
					
			
			endforeach;

			
						
	?>
		<?php if($rank != NULL) : ?>

		<div class="box">
			<div class="top"></div>
			<div class="content" style="position:relative; _top:-3px; _bottom:-3px;">
				<h1 class="rcg"><?php echo $expert->getName(); ?>'s Rayku Awards</h1>
				<div class="imp">
					<div class="badge">#<?php echo $rank; ?></div>
					<div class="lvl"><?php echo $expert->getName(); ?> is currently ranked the <strong>#<?php echo $rank; ?> overall expert</strong> on Rayku!</div>
					<div class="clear-both"></div>
				</div> 
				

				
					<?php 
							
						if($category_ranks != NULL): 
							
							foreach($category_ranks as $category_rank)
							{
							
								$ranks = explode(',',$category_rank);
								
								$c= new Criteria();
								$c->add(CategoryPeer::ID,$ranks[1]);
								$cate = CategoryPeer::doSelectOne($c); ?>
								
							<div class="uni">
								<div class="level">#<?php echo $ranks[0]; ?></div>
								<div class="lvl"><?php echo $expert->getName(); ?> is currently ranked the <strong>#<?php echo $ranks[0]; ?> <?php echo $cate->getName(); ?> expert</strong> on Rayku!</div>
								<div class="clear-both"></div>
							</div>

						<?php } else: ?>
						<?php endif; ?>
			</div>
			<div class="bottom"></div>
		</div>

	
			<?php  endif; ?> 





	</div>

	

<script type="text/javascript" src="/fancybox/jquery-1.4.2.min.js"></script>
	<script type="text/javascript" src="/fancybox/jquery.fancybox-1.3.1.js"></script>
	<link rel="stylesheet" type="text/css" href="/fancybox/jquery.fancybox-1.3.1.css" media="screen" />
	<script type="text/javascript">
	var k = jQuery.noConflict();
		k(document).ready(function() {
			k("#various1").fancybox({
				'titlePosition'		: 'inside',
				'transitionIn'		: 'none',
				'transitionOut'		: 'none'
			});
		});
	</script>
	<style type='text/css'>
	th {
	     background-color: #8FB5DB;
		border-color: #DDDDDD ;     
	    color: black;
	    font-weight: bold;
	    text-align: center;
	    	font-size: 17px;    
	}

	td {
		border-color: #DDDDDD ;
	    	font-size: 15px;
		padding: 6px;    	
	}
	table {
	 	border: groove;    	
		border-color: #DDDDDD ;
	    	font-size: 15px;
		border-bottom-width : 20px;
	}

	</style>

  
<div style="display: none;">
		<div id="inline1" style="width:650px;height:500px;overflow:auto;padding:25px" align="left">


			<h4 style="font-size:20px;color:#069;font-weight:bold;line-height:30px;">All Sessions Ratings :</h4><br/><br/>

		<table width="650"  border='2px' align='center' style = "'border-bottom-width : 4px';">
		<tr ><th width="130px">Session Question</th><th width="130px">Rating</th><th width="130px">Comments</th><th width="130px">Date</th></tr>

		<?php	$_query = mysql_query("select * from whiteboard_chat where expert_id =".$expert->getId()." and rating !='' ", $connection) or die(mysql_error());

									
					if(mysql_num_rows($_query) > 0) {

					$rating_count = mysql_num_rows($_query);

					while($_row = mysql_fetch_array($_query)) {

							echo '<tr align="center">';	
					
							echo '<td>'.urldecode($_row['question']).'</td>';
				
							echo '<td>'.$_row['rating'].'</td>';
							
							echo '<td>'.$_row['comments'].'</td>';
								
							echo '<td>'.$_row['started_at'].'</td>';
				
				
							echo '</tr>';

												
						}

	 				

					} 
				?>
                                        </table>          
		</div>
        </div>
