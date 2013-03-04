<link rel="stylesheet" type="text/css" href="../css/tutorshelp.css" />
<script type="text/javascript" src="/js/tutorshelp-jquery.js"></script>
<script type="text/javascript" src="/js/tutorshelp-ajax.js"></script>
<!--div#top-nav-->
<div id="tcontent">
  <h1 style="font-size:20px"><a href="/dashboard" style="text-decoration:underline">Dashboard</a> > Tutor Help Videos</h1>
  <?php 
	if((isset($_GET['tutor']))&& ($_GET['tutor']== "activate")):
	?>
  <div class="activated"> Your tutor status is activated! Make sure that you're connected:</div>
  <div class="notifications">
  <div class="gtalkfb" style="width:700px;"><a href="/dashboard/gtalk" target="_blank"><img src="/images/gtalk-large.png"/>
      <h2>Connect with Google Talk</h2></a>
      When you connect, you will have question notifications sent to you via Google Talk. We will then see whenever you are online, and send you question requests from students when you are available, and never when you are 'busy' or 'offline'.</div>
    <div style="clear:both"></div>
  </div>
  <?php
	endif;
	?>
  <p style="margin-top:20px;">Please spend 15 minutes to watch all 4 videos thoroughly to get started as a Rayku tutor!</p>
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
  <div align="right" style="font-size:14px;color:#333"><strong>Need help?</strong> We're here to answer any questions: 1-888-98RAYKU or <a href="mailto:cs@mail.rayku.com">email us</a>.</div>
</div>
<!--div#content-->

<div class="clear"></div>
