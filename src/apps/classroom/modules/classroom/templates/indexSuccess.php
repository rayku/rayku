<?php use_helper('Javascript'); ?>

<div class="spacer"></div>
<div class="title" style="float:left">
	<img src="../../../images/newspaper.gif" alt="" />
	<p>Blog section</p>
</div>
<div class="spacer"></div>
<?php  foreach( $classroom->getBlogEntries() as $blog_content) :?>
<div class="entry">
	<div class="top"></div>
	<div class="content">
		<div style="border:1px solid #fff">
			<div class="titles">
			
					<?php
					
						$d1=explode(' ',$blog_content->getCreatedAt());
						$d=explode('-',$d1[0]);
						$t=explode(':',$d1[1]);
						$date=date('F jS , Y  \a\t  h:i a',mktime($t[0],$t[1],$t[2],$d[1],$d[2],$d[0]));
								
					?>
			
			
				<div class="postdate" align="left"> Posted on <?php echo $date; ?> </div>
				<a href="#" class="title02"><?php echo $blog_content->getTitle(); ?></a>
			</div>
			<?php 
					$c=new criteria();
					$c->add(ClassroomCommentPeer::CLASSROOM_BLOG_ID,$blog_content->getId());
					$comments=ClassroomCommentPeer::doCount($c);
			?>
			<?php 
				echo link_to($comments.' comments','classroom_blog/show?id='.$blog_content->getId().'',array('class' => 'comments'));
			?>
			
			<div class="spacer"></div>
		</div>

		<div class="paragraph">
			<div class="text">
			<?php echo substr($blog_content->getMessage(),0,300); ?>
			</div>
		</div>
		<?php
      $blog_attach = $blog_content->getBlogAttachmentss();
		 ?>
		 
		<?php if( count( $blog_attach ) > 0 ): ?>
		 <div class="attachments">
			<div class="title" style="margin:0px 0px 9px 4px">
				<img src="../../../images/classroom_attach.gif" alt="" />
				<p style="font-size:15px">Attachments</p>
			</div>
			
				<?php  foreach($blog_attach as $blog_att): ?>
					
											
				<div class="attachment">
	
	
					<img src="../../../images/icon_doc.gif" alt="" />
	
					<a href="http://<?php echo RaykuCommon::getCurrentHttpDomain(); ?>/uploads/blog/<?=$blog_att->getFile()?>"><?php echo $blog_att->getFile(); ?></a>
	
				</div>
						
						
				<?php  endforeach; ?>
			
				
		</div>
		<?php endif; ?>
		<div class="readmore">
			<?php echo link_to('Read more <img src="../../../images/classroom_greenarrowright.gif" alt="" />','classroom_blog/show?id='.$blog_content->getId().''); ?>
		</div>

		<div class="spacer"></div>

	</div>
	<div class="bottom"></div>
</div>
<?php endforeach; ?>
