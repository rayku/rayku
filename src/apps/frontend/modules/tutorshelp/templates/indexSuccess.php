<link rel="stylesheet" type="text/css" href="../css/tutorshelp.css" />
<script type="text/javascript" src="/js/tutorshelp-jquery.js"></script>
<script type="text/javascript" src="/js/tutorshelp-ajax.js"></script>
<!--div#top-nav-->
<div id="tcontent">
  <h1 style="font-size:20px"><a href="/dashboard" style="text-decoration:underline">Dashboard</a> > Tutor Help Videos</h1>
  <?php 
	if($_GET['tutor'] == "activate"):
	?>
  <div class="activated"> Your tutor status is activated!</div>
  <div class="notifications">
    <div class="gtalkfb"><a href="http://rayku.com/dashboard/gtalk" target="_blank"><img src="/images/gtalk-large.png"/>
      <h2>Connect with Google Talk</h2></a>
      Have question notifications sent to you via Google Talk</div>
    <div class="gtalkfb"><a href="http://rayku.com/dashboard/facebook" target="_blank"><img src="/images/fbchat-large.png"/>
      <h2>Connect with Facebook Chat</h2></a>
      Have question notifications sent to you via FB chat</div>
    <div class="software"align="right"><a href="http://notification-bot.rayku.com/download/rayku.dmg">
      <h2>MacOS Notification Software</h2>
      </a><br />
      <a href="http://notification-bot.rayku.com/download/rayku.exe">
      <h2>Windows Notification Software</h2>
      </a></div>
    <div style="clear:both"></div>
  </div>
  <?php
	endif;
	?>
  <p style="margin-top:20px;">Make sure to spend 10 minutes to watch all 4 videos thoroughly to get started as a Rayku tutor!</p>
  <div id="video-box">
    <div class="video">
      <div id="video-title">Get started with tutoring on Rayku</div>
      <div id="video-content"></div>
    </div>
    <!--div.video-->
    
    <ul id="steps">
      <li><a href="javascript:;" onclick="loadVideo('1','Get started with tutoring on Rayku');" id="step1"><span>1.</span> Getting Started</a></li>
      <li><a href="javascript:;" onclick="loadVideo('2','Set up your account to receive questions');" id="step2"><span>2.</span> Profile & Notifications</a></li>
      <li><a href="javascript:;" onclick="loadVideo('3','Tutoring on the whiteboard takes practice');" id="step3"><span>3.</span> Using the Whiteboard</a></li>
      <li><a href="javascript:;" onclick="loadVideo('4','The better you do, the more you make');" id="step4"><span>4.</span> Leveling & Compensation</a></li>
    </ul>
    <!--ul#steps-->
    
    <div class="clear"></div>
    <!-- separating both video box and 5 steps from description below -->
    
    <div id="video-description"> </div>
    <!--div.video-description--> 
    
  </div>
  <!--div#video-box-->
  
  <div class="clear"></div>
  <div class="separator">&nbsp;</div>
  <!--#cropeed bg separator-->
  <div align="right"><a href="http://wistia.com/?badge" target="_blank"><span style="font-family:Arial;font-size:12px;color:#000;margin:0;padding:0 10px 0 0;position:relative;top:-3px;display:inline-block;text-shadow: #ccc 1px -1px">VIDEO HOSTING BY</span><img src="http://static.wistia.com/images/badges/wistia_100x96_black.png" width="100" height="16" alt="Wistia" style="border:0;margin:0;padding:0;display:inline;"/></a></div>
</div>
<!--div#content-->

<div class="clear"></div>
