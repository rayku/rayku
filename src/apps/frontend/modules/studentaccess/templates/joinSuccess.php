<link rel="stylesheet" type="text/css" href="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/styles/classroom.css" />

<div class="body-main">

  <div class="title" style="float:left; margin-top:20px; margin-left:20px;">
    <img src="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/images/newspaper.gif" alt="" />
    <p>Join to classroom</p>
  </div>

  <div class="spacer"  style="margin-top:60px;"></div>
  <div class="entry" style="margin-bottom:11px;">
    <div class="top"></div>
    <div class="content">
      <div class="hand-in">
        <div class="email-st">
          <label>
            In order to join to classroom, please do the following procedure. <br /><br />
            1) Select the category <br />
            2) Then select teacher<br />
            3) Then select the classroom.<br />
            4) Finally join to that classroom.<br />
          </label>
          
          <div id="ajaxindicator" style="display: none; text-align:center; padding-top: 100px; padding-bottom: 90px;">
            <?php echo image_tag('ajaxindicator.gif'); ?>
          </div>

          <div id="tcontent">
            <?php include_partial( 'selects', array( 'categories' => $categories, 'alluser' => $alluser, 'allclassroom' => $allclassroom ) ); ?>
          </div>

        </div>
      </div>
    </div>
    <div class="bottom"></div>

  </div><!-- end of entry -->
</div><!-- end of body-main -->

