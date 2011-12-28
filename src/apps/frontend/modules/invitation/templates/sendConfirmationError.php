<div class="body-main">

  <div id="top">
      <div class="title">
          <img alt="" src="/images/arrow-right.gif"/>
          <p>Invitation sent Error</p>
      </div>
      <div class="spacer"></div>
  </div>

  <div class="body-main">
    <div class="box">
        <div class="top"></div>
          <div class="content">
           <div class="title">
           	<?php
              if($msg=='2')
                echo 'Sorry entered email address is not valid!';
              elseif($msg=='3')
                echo 'Person is already a member of rayku. Please choose different email to invite!.';
              elseif($msg=='4')
                echo 'You have already sent a request to this email. Please choose different email id to invite!.';
             ?>
           </div>
          </div>
      <div class="bottom"></div>
    </div>
  </div>

</div><!-- end of body-main -->
