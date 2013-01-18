<div class="body-main">
  
  <div id="what-is">
	  <div style="width:30px; float:left;">
		  <img src="<?php echo image_path('green_arrow.jpg', false); ?>" width="42" height="25" alt="" />
	  </div>
	  <p style="font-size:16px; color:#1c517c; font-weight:bold; margin-left:45px;">Rayku Whiteboard sessions</p>
  </div>

  <div class="spacer"></div>
  <div class="spacer"></div>

  <div class="forum">
    <div class="top"></div>
    <div class="bg">
      
      <?php foreach ($chat_list as $chat): ?>
        
        <div class="cat" style="margin: 10px">
          <div class="iconnew2">
            <img src="../images/forum-icon-new2.png" />
          </div>
          <div class="desc">
            <h1>
              <a href="<?php echo url_for('whiteboard/show?id=' . $chat->getId()) ?>"> Whiteboard <?php echo $chat->getId() ?> </a>
            </h1>
          </div>
          <!--
          <div class="threads">
            6 Topics<br />
            1 Replies 
          </div>
          -->
          <div class="clear-both"></div>
        </div>
        
      <?php endforeach; ?>
      
    </div>
    
    <!--bg-->
    <div class="bot"></div>
  </div>
  <!--forum-->

</div>