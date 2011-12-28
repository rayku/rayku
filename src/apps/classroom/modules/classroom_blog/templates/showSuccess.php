<?php use_helper('MyAvatar') ?>
<div class="title" style="float:left">
	<img src="../../../images/newspaper.gif" alt="" />
	<p>News Blog</p>
</div>

<div class="spacer"></div>

<div class="entry">
	<div class="top"></div>
	<div class="content">
		<div style="border:1px solid #fff">
			<div class="titles">
						<?php
					  $raykuUser = $sf_user->getRaykuUser();
						$d1=explode(' ',$classroom_blog->getUpdatedAt());
						$d=explode('-',$d1[0]);
						$t=explode(':',$d1[1]);
						$date=date('F jS , Y  \a\t  h:i a',mktime($t[0],$t[1],$t[2],$d[1],$d[2],$d[0]));
								
					?>
				<div class="postdate" align="left">Posted on <?php echo  $date; ?></div>

				<?php if($raykuUser->getType() == 2): ?>
				<a href="<?php echo url_for('classroom_blog/edit?id='.$classroom_blog->getId())?>" class="title02">
				<?php echo $classroom_blog->getTitle() ?></a>
				<?php else: ?>
				<a href="#" class="title02">
				<?php echo $classroom_blog->getTitle() ?></a>
				<?php endif;?>
			</div>

			<a href="#" class="comments"><?php echo count($classroom_blog_comments);?> comments</a>

			<div class="spacer"></div>
		</div>

		<img src="../../../images/dev/classroom_image001.gif" alt="" />

		<div class="paragraph">
			<div class="head"><?php echo $classroom_blog->getTitle() ?></div>
			<div class="text">
				<?php echo $classroom_blog->getMessage() ?>
			</div>
		</div>
	 <?php if($blog_attach == NULL): ?>
			
	 
	 <?php else: ?>		
		
		
		<div class="attachments">
			<div class="title" style="margin:0px 0px 9px 4px">
				<img src="../../../images/classroom_attach.gif" alt="" />
				<p style="font-size:15px">Attachments</p>
			</div>
			 <?php foreach($blog_attach as $attach) : ?>

				<div class="attachment">
	
	
	
					<img src="../../../images/icon_doc.gif" alt="" />
	
	
	
					<a href="http://<?php echo RaykuCommon::getCurrentHttpDomain(); ?>/uploads/blog/<?=$attach->getFile()?>"><?php echo $attach->getFile(); ?></a>
	
	
	
				</div>
			<?php endforeach; ?>
			
			

		</div>
<?php endif; ?>
		<!--<div class="spacer"></div>
-->

	</div>
	<div class="bottom"></div>
</div>


<div class="title" style="float:left; padding-left:0; margin-left:0;">
	<p style="padding-left:0; margin-left:0;">Leave a comment!</p>
</div>

<div class="spacer"></div>
<div class="entry">
	<div class="top"></div>
	<div class="content">
		<form action="<?php echo url_for('classroom_blog/comment')?>" method="post">
		<input type="hidden" name="classroom_blog_id" value="<?php echo $classroom_blog->getId() ?>" />
		<div class="hand-in">
			<div class="infleft" style="margin-right: 20px;">
			<label>Name:</label>
			<input name="title" type="text" class="replyc" value="<?php echo $raykuUser->getUserName();?>" disabled="disabled" />
			</div>
			<div class="infleft">
			<label>Email:</label>
			<input name="" type="text" class="replyc" value="<?php echo $raykuUser->getEmail();?>" disabled="disabled" />
			</div>
			<div class="clear-both"></div>
			<div style="margin-top:15px;">
			<label>Content:</label>
			<textarea name="content" cols="" rows="" class="comm"></textarea>
			<input name="save" type="submit" class="blue" value="Post!" />
			<div class="clear-both"></div>
			</div>
		</div>
		</form>
	</div>
	<div class="bottom"></div>
</div>

<div class="title" style="float:left; padding-left:0; margin-left:0;">
	<p style="padding-left:0; margin-left:0;"><?php echo count($classroom_blog_comments);?> Comment</p>
</div>


<?php foreach($classroom_blog_comments as $comment):?>

<div class="spacer"></div>
<div class="entry">
	<div class="top"></div>
	<div class="content">
		<div class="hand-in">
			<div class="thecomments-left">
			<div class="ava">
				<?php
					$c=new Criteria();
					$c->add(Userpeer::ID,$comment->getUserId());
					$user=UserPeer::doSelectOne($c);

					echo link_to(avatar_tag_for_user($user), '@profile?username=' . $user->getUsername())
				?>
			</div>
			<div class="by"><?php echo link_to($user->getUsername(),'@profile?username=' . $user->getUsername()); ?></div>
			<div class="points">Points: 300</div>
			<div class="awards">Awards: 5</div>
			</div>
			<div class="thecomments-right">
			<?php
					
						$d1=explode(' ',$comment->getPostedAt());
						$d=explode('-',$d1[0]);
						$t=explode(':',$d1[1]);
						$date=date('F jS , Y  \a\t  h:i a',mktime($t[0],$t[1],$t[2],$d[1],$d[2],$d[0]));
								
			?>
			
			
			<div class="postedby">Posted at <?php echo $date;?></div>
			<?php echo $comment->getContent();?>
			</div>
			<div class="clear-both"></div>
		</div>

	</div>
	<div class="bottom"></div>
</div>

<?php endforeach;?>
