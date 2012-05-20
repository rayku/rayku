<div class="body-main">
  
  <div id="what-is">
	  <div style="width:30px; float:left;">
		  <img src="<?php echo image_path('green_arrow.jpg', false); ?>" width="42" height="25" alt="" />
	  </div>
      
      <?php $_date = explode(" ", $chat->getCreatedAt()); ?>
	  <p style="font-size:16px; color:#1c517c; font-weight:bold; margin-left:45px;">Rayku Whiteboard : <?php echo urldecode($chat->getQuestion()) ?> <br/>[ <?php echo $_date[0]; ?> ]</p>
  </div>

  <div class="spacer"></div>
  <div class="spacer"></div>
  
  <div class="box">
    <div class="top"></div>
      <div class="content">
        
        <?php
        
          $m = 0;
          $s = 0;
          $msg = null;
          $snap = null;
          $renderMsg = false;
          $renderSnap = false;
          $msgLength = sizeof($messages);
          $snapLength = sizeof($snapshots);
          $hasNext = (($m < $msgLength) || ($s < $snapLength));
          
          // two list sync
          while($hasNext)
          {                
            if (($m < $msgLength) && ($s < $snapLength))
            {
              $msg = $messages[$m];
              $snap = $snapshots[$s];
               
              if ($msg->getCreatedAt() < $snap->getCreatedAt())
              {
                $renderMsg = true;
                $renderSnap = false;
              }                
              else
              {
                $renderMsg = false;
                $renderSnap = true;
              }
            }
            else
            {
              $renderMsg = ($m < $msgLength);
              $renderSnap = ($s < $snapLength);
            }
            
            if ($renderMsg)
            {
              $msg = $messages[$m];
              $nick = ($msg->getUserId() == $chat->getExpertId() ? $chat->getExpertNickname() : $chat->getAskerNickname());
              
              ?>
              
              <div class="entry" style="margin-left:10px; font-weight:bold; font-size:13px; padding: 4px">
              
              
              <?php $_time = explode(" ", $msg->getCreatedAt()); ?>
                <p><?php echo $_time[1] . ' :-    ' . $nick . ' : ' . $msg->getMessage() ?></p>
                <div class="spacer"></div>
              </div>
              
              <?php
              
              $renderMsg = false;
              $m++;
            }
            
            if ($renderSnap)
            {
              $snap = $snapshots[$s];
              ?>
              
              <div style="margin: 4px 4px 4px 20px;">          
                <img style="border:2px solid gray; padding: 4px" 
                  src="<?php echo '/whiteboard/data/' . $chat->getDirectory() . '/' . $snap->getFilename() ?>" alt="" />   
              </div>
              <?php
              
              $renderSnap = false;
              $s++;
            }
            
            $hasNext = (($m < $msgLength) || ($s < $snapLength));
          }
        ?>
        
        
     
      </div>
      <div class="spacer"></div>
      <div class="bottom"></div>
    </div
  ></div>
</div>
<!-- end of body-main -->
