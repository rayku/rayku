<link rel="stylesheet" type="text/css" href="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/styles/classroom.css" />

<div class="title" style="float:left; margin-left:20px; margin-top:20px;">

  <img src="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/images/newspaper.gif" alt="" />

	<p><?php echo $content_page->getTitle(); ?></p> 
	
	<?php  if($sf_user->getRaykuUser()->getType()== '2'): ?>
	
		<p align="right"><?php echo link_to('Edit','content_page/edit?id='.$id.''); ?> </p>
		
		<p align="right"><?php echo link_to('Delete','content_page/delete?id='.$id.'','post=true&confirm=are you sure?') ?> </p>
		
	<?php endif; ?>

</div>

<div class="spacer"></div>

	 <div class="entry" style="margin-bottom:11px;">

        	<div class="top"></div>

            <div class="content">

            	<div class="hand-in">

                	<div class="email-st">

						<label><?php echo $content_page->getContent(); ?></label>
						</div>

                </div>

            </div>

            <div class="bottom"></div>

 </div>
 
 <div class="spacer"></div>

	 <div class="entry" style="margin-bottom:11px;">

        	<div class="top"></div>

            <div class="content">

            	<div class="hand-in">

                	<div class="email-st">

						<div class="title" style="margin:0px 0px 9px 4px">
						<img src="../../../images/classroom_attach.gif" alt="" />

						<p style="font-size:15px">Attachments</p>
						</div>

					
						<?php if($page_attach == NULL): ?>
			
							<div class="attachment">
			
							<a href="" style="text-decoration:none; margin-left:50px;">No attachments</a>
							</div>
		
						<?php else: ?>
					
					
						 <?php foreach($page_attach as $attach) : ?>
	
							<div class="attachment" style="margin-left:50px;">
	
							<label><img src="../../../images/icon_doc.gif" alt="" /><a href="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/uploads/content_page/<?=$attach->getFile()?>"><?php echo $attach->getFile(); ?></a></label>
							</div>
	
						<?php endforeach; ?>
					
						
				<?php endif; ?>
					
					</div>

                </div>

            </div>

            <div class="bottom"></div>

 </div>
