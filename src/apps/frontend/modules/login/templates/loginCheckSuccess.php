<div class="body-main">
  <div id="top">
    <div style="width:30px; float:left;"><img height="25" width="42" src="<?php echo image_path('green_arrow.jpg', false); ?>"/></div>
    <div style="font-size:16px; color:#1C517C; font-weight:bold; margin-left:25px; padding-top:3px;float:left">Login Success!</div>
    <div class="spacer"></div>
  </div>
  <div class="body-main">
    <div class="box">
      <div class="top"></div>
      <div class="content">
        <div class="title">
          <?php
		header("Refresh: 1; url=\"../dashboard\"");
		echo "You are now logged in. Redirecting to dashboard in 2 seconds..."
	?>
        </div>
      </div>
      <div class="bottom"></div>
    </div>
  </div>
</div>
<!-- end of body-main -->