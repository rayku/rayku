<link rel="stylesheet" type="text/css" href="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/styles/classroom.css" />

<div class="body-main">

<div class="entry" style="margin-bottom:11px;">
  <div class="top"></div>
  <div class="content">
    <div class="hand-in">
      <div class="email-st">
        <label style="margin-top: 20px;"><?php echo $error ?></label>
        <label style="margin-top:20px;"><?php echo link_to('Go Back','forum_question/show?id='.$qnid.'');?></label>
      </div>
    </div>
  </div>
  <div class="bottom"></div>
 </div>

</div><!-- end of body-main -->