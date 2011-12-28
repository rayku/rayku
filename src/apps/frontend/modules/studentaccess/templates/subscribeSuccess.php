<link rel="stylesheet" type="text/css" href="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/styles/classroom.css" />

<div class="body-main">

<div class="title" style="float:left; margin-left:20px; margin-top:20px;">
	<img src="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/images/newspaper.gif" alt="" />
	<p>Notifications Settings</p>
</div>

<div class="spacer" style="margin-top:60px;"></div>
	<div class="entry" style="margin-bottom:11px;">
    <div class="top"></div>
    <div class="content">
      <div class="hand-in">
        <div class="email-st">
          <?php
            $sStype = '';
            switch($stype)
            {
              case '1': echo $sStype = 'Assignments'; break;
              case '2': echo $sStype = 'News'; break;
              case '3': echo $sStype = 'Due-dates'; break;
              default:
            }
          ?>

          <label>
            You have successfully subscribed for the "<?php echo $classroom->getFullName(); ?>" classes "<?php echo $sStype ?>"
          </label>

					<label style="margin-bottom:30px; margin-top:15px;">
					  <a href="<?php echo url_for('studentaccess/notifications?userid='.$sf_user->getRaykuUser()->getId().'');?>" class="blue" style="line-height:35px; float:left;">
              <span>Back</span>
            </a>
					</label>

			  </div>
      </div>
    </div>
    <div class="bottom"></div>
  </div>
</div><!-- end of body-main -->