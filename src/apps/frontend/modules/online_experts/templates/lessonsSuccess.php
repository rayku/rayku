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
	<div id="top">
		<div class="title" style="float:left">
			<img src="/images/arrow-right.gif" alt="" />
			<?php if($expert->getUsername() == $sf_user->getRaykuUser()->getUsername()): ?>
			<p>Welcome <?php echo $expert->getUsername(); ?> <!--<span>(username)</span>--></p>
			<?php else: ?>
			<p><?php echo $expert->getUsername(); ?>'s Lesson plans <!--<span>(username)</span>--></p>
			<?php endif; ?>
		</div>

		<div class="spacer"></div>
	</div>


	<div class="body-main">
	
	  <h3>Immediate 1-on-1 Help Services</h3>
	  <div class="pbox">
			<div class="top">
				<div class="name">Course Name</div>
				<div class="schedule">Availability / Order Information</div>
				<div class="price">Pricing</div>
			</div>
			
			<?php 
			
				$c = new Criteria();
				$c->add(ExpertsImmediateLessonPeer::USER_ID, $expert->getId());
				$expert_immediate_lessons = ExpertsImmediateLessonPeer::doSelect($c);
				
				$count = 0;
			?>	
			
			<?php foreach($expert_immediate_lessons as $expert_lesson):?>
			<?php echo form_tag('online_experts/immediate'); ?>
			<input type="hidden" name="expert_immediate_lesson_id" value="<?php echo $expert_lesson->getId(); ?>" />
			<input type="hidden" name="expert_id" value="<?php echo $expert_lesson->getUserId(); ?>" />
			<div class="<?php echo ($count++%2 == 0)?"light":"dark"; ?>">
				<div class="name"><?php echo $expert_lesson->getTitle(); ?></div>
				<div class="schedule">
					<?php echo submit_image_tag('/images/start.png', array('width' => '71', 'height' => '19', 'border' => '0')); ?>
				</div>
				<div class="price">$<?php echo $expert_lesson->getPrice();?> / Minute</div>
			</div>
			</form>
			<?php endforeach; ?>
			
			<div class="bot"></div>
	</div><!--pbox-->
	<div class="clear-both"></div>
	
		<h3>Scheduled Online Tutoring Services</h3>
		<div class="pbox">
			<div class="top">
				<div class="name">Course Name</div>
				<div class="schedule">Order Information</div>
				<div class="price">Pricing</div>
			</div>
			<?php 
			
				$c = new Criteria();
				$c->add(ExpertLessonPeer::USER_ID, $expert->getId());
				$expert_lessons = ExpertLessonPeer::doSelect($c);
				
				$count = 0;
			?>	
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
		<div style="margin-bottom:25px; color:#A6A6A6">*Free Trial Available</div>
		<!--pbox-->
		
								

		<h3><br />
	  Videos</h3>
		<div class="box">
			<div class="top"></div>
			<div class="content2">
				<h3>Expert's public Video Replies</h3>

				<div class="entry" style="margin-top:10px;">

				<div class="portimg">
					<a href="#"><img src="/images/img_portfolio.jpg" alt="img" /></a>
					<div class="desc"><span>Video Title here</span>  -  Enter your very short description here :-).</div>
				</div>
				
				<div class="portimg">
					<a href="#"><img src="/images/img_portfolio.jpg" alt="img" /></a>
					<div class="desc"><span>Video Title here</span>  -  Enter your very short description here :-).</div>
				</div>
				
				<div class="portimg">
					<a href="#"><img src="/images/img_portfolio.jpg" alt="img" /></a>
					<div class="desc"><span>Video Title here</span>  -  Enter your very short description here :-).</div>
				</div>
				
				<div class="clear-both" style="height:40px;"></div>
				
				<h3>Best Response</h3>
				
				<div class="portimg best">
					<a href="#"><img src="/images/img_portfolio.jpg" alt="img" /></a>
					<div class="desc"><span>Video Title here</span>  -  Enter your very short description here :-).</div>
				</div>
				
				<div class="portimg best">
					<a href="#"><img src="/images/img_portfolio.jpg" alt="img" /></a>
					<div class="desc"><span>Video Title here</span>  -  Enter your very short description here :-).</div>
				</div>
				
				<div class="portimg best">
					<img src="/images/img_portfolio.jpg" alt="img" />
					<div class="desc"><span>Video Title here</span>  -  Enter your very short description here :-).</div>
				</div>
				
				<div class="clear-both"></div>

					<div class="spacer"></div>
				</div>
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
					<div class="displaypic"><img src="/images/default-avatar.jpg" alt="img" /></div>
					<h1 class="name"><?php echo $expert->getUsername(); ?></h1>
					<strong>Experts Trust:</strong>  583<br />
					<strong style="float:left;">Rank:</strong>
					<ul class="ranks">
						<li>#6 <span>(for maths)</span></li>
						<li>#6 <span>(for maths)</span></li>
					</ul>
					
					<div class="clear-both"></div>
					
					<div class="status">
						This user is <?php if ($expert->isOnline()): ?><span class="online">online</span>
						<?php else: ?><span class="offline">offline</span><?php endif; ?>
					</div>
					<a href="#" class="contact">Contact</a>
					
					<div class="clear-both"></div>
					
				</div>
			</div>
			<div class="bottom"></div>
		</div>
		
		<div class="box">
			<div class="top"></div>
			<div class="content" style="position:relative; _top:-3px; _bottom:-3px;">
				<h1 class="tit">About <?php echo $expert->getUsername(); ?></h1>
				<div class="about">
					Hi, my name's <?php echo $expert->getUsername(); ?> and I'm a very passionate freelance designer, originally from London, England, although I'm currently residing inside the city of Aberdeen, which is located in north-east Scotland. <strong>I specialize in UI Design and Print Design</strong>. I'm currently starting up a webdesign business under the name of <strong><?php echo $expert->getUsername(); ?> Design (JDD)!</strong>
				</div>
			</div>
			<div class="bottom"></div>
		</div>
		
		<div class="box">
			<div class="top"></div>
			<div class="content" style="position:relative; _top:-3px; _bottom:-3px;">
				<h1 class="rcg"><?php echo $expert->getUsername(); ?>' Recognition</h1>
				<div class="imp">
					<div class="badge">#1</div>
					<div class="lvl"><?php echo $expert->getUsername(); ?> is currently the #1 maths tutor (as decided by users) on rayku!</div>
					<div class="clear-both"></div>
				</div>
				<div class="uni">
					<div class="level">#1</div>
					<div class="lvl"><?php echo $expert->getUsername(); ?> is currently the #1 maths tutor (as decided by users) on rayku!</div>
					<div class="clear-both"></div>
				</div>
				<div class="uni">
					<div class="level">#1</div>
					<div class="lvl"><?php echo $expert->getUsername(); ?> is currently the #1 maths tutor (as decided by users) on rayku!</div>
					<div class="clear-both"></div>
				</div>
			</div>
			<div class="bottom"></div>
		</div>
		
	</div>
