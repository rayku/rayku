<?php use_helper('Javascript'); ?>
<?php use_helper('Text'); ?>

	<div class="body-main">
		<div id="what-is">
			<div style="width:30px; float:left;">
				<img src="images/green_arrow.jpg" width="42" height="25" alt="" />
			</div>
			<p style="font-size:16px; color:#1c517c; font-weight:bold; margin-left:55px;">
				Mr. <?php echo $sf_user->getRaykuUser() ?>'s Classroom.
			</p>
		</div>
		
		<div class="clrm">
			<div class="clrm-top"></div>
			<div class="content">
				<h3>Classrooms:</h3>
				<?php foreach ($classrooms as $classroom): ?>
				<div class="class"><div class="title"><?php echo link_to($classroom->getFullname(),'classroom/index?id='.$classroom->getId()) ?></div> <div class="settings"><?php echo link_to('Settings', 'classmanager/show?id='.$classroom->getId()) ?></div><div class="clear-both"></div></div>
				<?php endforeach; ?>				
			</div>
			<div class="clrm-bottom"></div>
		</div>
		
		<div class="left-bg" id="left-bg">
			<?php
        include_partial( 'recent' );
			?>
		</div>
		<?php echo link_to_remote(image_tag('view-more-activity.png'), array(
		  			'update' => 'left-bg',
					'url'    => 'classmanager/moreactivity',
					), array(
					'style'  => 'margin-bottom: 15px; display: block;'
		)) ?>
	</div>
	<div class="body-side" style="margin-top:40px">
<!--		<a href="#" class="navlink add">Join Classroom</a>
		<a href="#" class="navlink back" style="background-image: url(images/news-bg.png);">Notifications</a>-->
		<?php echo link_to ('Create Classroom<span style="font-size: 10px; color: #6F6F6F; font-weight: normal;">(max 10)</span>', 'classmanager/create', array('class' => 'navlink add')) ; ?>
		<?php echo link_to ('E-mail your Students', 'classmanager/writeMail', 
							array('class' => 'navlink back', 'style' => 'background-image: url(images/mail-bg.png);')) ?>
	</div>
	<br class="clear-both" />






