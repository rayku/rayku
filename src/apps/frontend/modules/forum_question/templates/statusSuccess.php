<link rel="stylesheet" type="text/css" href="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/styles/classroom.css" />

<div class="body-main">

<div class="entry" style="margin-bottom:11px;">
        	<div class="top"></div>
            <div class="content">
            	<div class="hand-in">
                	<div class="email-st">
						
						<?php if($success): ?>
							<label style="margin-top:20px;">Status has been changed successfully!</label>
						<?php else: ?>
							<label style="margin-top:20px;">[You have crossed the limit of creating questions up to 2, because experts are not yet responded for your questions. If you want to create new question, please inactive the question which is answered by expert or make the response as best response and increase the question credits.]</label>
						<?php endif; ?>
						<label style="margin-top:20px;"><?php echo link_to('Go Back','forum_question/list');?></label>
					
                    </div>
                </div>
            </div>
            <div class="bottom"></div>
 </div>

</div><!-- end of body-main -->
