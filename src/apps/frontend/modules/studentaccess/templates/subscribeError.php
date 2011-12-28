<link rel="stylesheet" type="text/css" href="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/styles/classroom.css" />

<div class="body-main">

<div class="title" style="float:left;margin-left:20px; margin-top:20px;">

	<img src="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/images/newspaper.gif" alt="" />

	<p>Notifications Settings</p>

</div>

<div class="spacer"  style="margin-top:60px;"></div>

	 <div class="entry" style="margin-bottom:11px;">

            <div class="top"></div>

			<div class="content">

            	<div class="hand-in">

                	<div class="email-st">

                    <label><?php echo $error ?></label>

					<label style="margin-bottom:30px; margin-top:15px;">

						<a href="<?php echo url_for('studentaccess/notifications?userid='.$sf_user->getRaykuUserId().'');?>" class="blue" style="line-height:35px; float:left;"><span>Back</span></a>

					</label>

					</div>

                </div>

            </div>

            <div class="bottom"></div>

 </div>

</div><!-- end of body-main -->
