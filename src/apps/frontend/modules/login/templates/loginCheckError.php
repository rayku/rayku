<div class="body-main">

  <div id="top">
      <div class="title">
          <img alt="" src="<?php echo image_path('arrow-right.gif', false); ?>"/>
          <p>Login Error</p>
      </div>
      <div class="spacer"></div>
  </div>

  <div class="body-main">
    <div class="box">
        <div class="top"></div>
          <div class="content">
           <div class="title"><?php echo $msg; ?><br /><br />
             <span style="font-weight:normal; font-size:14px; line-height:20px; font-weight:bold"><?php echo link_to('Forgot Your Password?', '@login#forgot') ?></span>
             </div>
          </div>
      <div class="bottom"></div>
    </div>
  </div>
</div><!-- end of body-main -->
