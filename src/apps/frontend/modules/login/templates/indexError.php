<div class="body-main">
<link rel="stylesheet" type="text/css" href="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/styles/classroom.css" />

<div class="entry" style="margin-bottom:30px;">
        	<div class="top"></div>
            <div class="content">
            	<div class="hand-in">
                	<div class="email-st">
                    <h1 style="font-size:22px; font-weight:bold; margin-bottom:30px;">Login Error</h1>
				    <span style="font-weight:normal; font-size:14px; line-height:20px">You are already logged in! You can not log in again. Click <?php echo link_to( 'here', 'login/logout', array("style"=>"text-decoration:underline") ); ?> to log out of this account.</span>
					</div>
                </div>
            </div>
            <div class="bottom"></div>
 </div>
</div><!-- end of body-main -->