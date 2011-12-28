<div class="title" style="float:left">
	<img src="http://<?php echo RaykuCommon::getCurrentHttpDomain(); ?>/images/newspaper.gif" alt="" />
    <p>News blog</p>
</div>
<div class="spacer"></div>
<?php if($sf_user->getRaykuUser()->getType() == UserPeer::getTypeFromValue('teacher')):?>
<?php echo link_to ('create blog', 'classroom_blog/create', array('class' => 'blue', 'style' => 'line-height: 38px; float: left;'))?>
<div class="spacer" style="margin-bottom:30px; margin-top:15px;"></div>
<?php endif;?>
<?php if(count($classroom_blogs) != 0): ?>
<?php foreach ($classroom_blogs as $classroom_blog): ?>
		<div class="entry" style="margin-bottom:11px;">
        	<div class="top"></div>
            <div class="content" style="margin-bottom:auto;">
            	<div style="border:1px solid #fff">
                	<div class="titles" style="margin:0; margin-right:200px;">
						<?php echo link_to($classroom_blog->getTitle(), 'classroom_blog/show?id='.$classroom_blog->getId(), array('class' => 'title02')) ?>
					</div>
					  
					<div style="float:right;">
						
							<?php if($sf_user->getRaykuUser()->getType() == UserPeer::getTypeFromValue('teacher')):?>
							<?php echo link_to ('Edit blog', 'classroom_blog/edit?id='.$classroom_blog->getId().'', array('class' => 'blue', 'style' => 'line-height: 38px; float: left;'))?>
							
							<?php endif;?>
					</div>

                    <div class="clear-both"></div>
                </div>
                <div class="paragraph" style="margin:0;">
                	<div id="bordersplitter"></div>
                    <div class="text" style="border-bottom:0;">
                  <?php echo $classroom_blog->getMessage() ?>
                    </div>
                </div>
				<div id="bordersplitter"></div>
			
				<div class="readmore">
							<?php echo link_to('Read more'.'<img src="../../../images/classroom_greenarrowright.gif" alt="" />', 'classroom_blog/show?id='.$classroom_blog->getId()); ?> 

						<div class="dropin"><?php echo link_to('Hand-in dropbox is turned on','assignment/list'); ?></div>
						
				</div>
				
				<div class="clear-both"></div>
            </div>

            <div class="bottom"></div>
        </div>
<?php endforeach; ?>
<?php else: ?>
	<font style=" size:16px; font-weight:bold;">There is no blog for this class.</font>
<?php endif;?>
