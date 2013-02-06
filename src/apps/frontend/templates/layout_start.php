<!DOCTYPE html>
<html>
<head>
<title>Free Online Math Tutoring | Calculus, Algebra, Statistics, more | Rayku.com</title>
<link rel="stylesheet" type="text/css" href="<?php echo $baseRootPath; ?>/css/landing/style.css"  media="screen" />
<!--[if lte IE 8]>
<link rel="stylesheet" type="text/css" href="<?php echo $baseRootPath; ?>/css/ie78.css" media="screen" />
<![endif]-->

<!-- Form Validation -->
<link rel="stylesheet" type="text/css" href="<?php echo $baseRootPath; ?>/css/validation/validationEngine.jquery.css" media="screen" />
<!-- End of form validation files include -->

<?php templateGoogleAnalytics(); ?>
</head>

<body>
<!--header-->

<div id="header">
  <!--container-->
  <div class="container clearfix">
    <h1><a href="/"><img src="<?php echo $baseRootPath; ?>/images/landing/topnav/rayku.jpg" alt="Rayku"/></a></h1>
    <!--navigation-->
    <ul id="navigation">
      <li><a href="/login">Login</a></li>
       <li><a href="/register">Register</a></li>
       <li><a href="/about">About</a></li>
       <li><a href="/jobs">Jobs</a></li>
       <li><a href="/joinus">Become a Tutor</a></li>
       <!--<li><a href="/tourpage">Tour</a></li>-->
    </ul>
    <!--navigation-->
    <div class="clear"></div>
  </div>
  <!--container-->
  <!--[if IE]>
<div style="width:100%;padding:8px 0;background:#FFCCCC;border-bottom:2px solid #BF3535;font-size:14px;color:#666" text-align="center">
Rayku currently does not work every well with <strong>Internet Explorer</strong>. Please use Firefox or Chrome or another browser.
</div>
<![endif]-->
</div>
<!--header-->

<!--register-->
<div id="register">

  <!--container-->
  <div class="container">
	<a href="#">
	<img id="video-button" src="<?php echo $baseRootPath; ?>/images/vidbutton.png" 
onmouseover="this.src='<?php echo $baseRootPath; ?>/images/vidbutton-hover.png'" 
onmouseout="this.src='<?php echo $baseRootPath; ?>/images/vidbutton.png'" />
	</a>
	<a href="#"><img id="close-video" src="<?php echo $baseRootPath; ?>/images/landing/close-video.png" /></a>
	<iframe id="video-player" src="http://fast.wistia.com/embed/iframe/6311e77c10?videoWidth=465&amp;videoHeight=262&amp;volumeControl=true&amp;playerColor=313131&amp;plugin%5BpostRoll%5D%5Bversion%5D=v1&amp;plugin%5BpostRoll%5D%5Btext%5D=Click%20here%20to%3Cbr%2F%3Eregister%20(it's%20free!)&amp;plugin%5BpostRoll%5D%5Blink%5D=http%3A%2F%2Frayku.com%2Fregister&amp;plugin%5BpostRoll%5D%5Bstyle%5D%5BbackgroundColor%5D=%23006699&amp;plugin%5BpostRoll%5D%5Bstyle%5D%5Bcolor%5D=%23ffffff&amp;plugin%5BpostRoll%5D%5Bstyle%5D%5BfontSize%5D=22px&amp;plugin%5BpostRoll%5D%5Bstyle%5D%5BfontFamily%5D=Gill%20Sans%2C%20Helvetica%2C%20Arial%2C%20sans-serif" class="wistia_embed" name="wistia_embed" width="509" height="286"></iframe>
	<div id="hide-for-video">
		<img id="media-logos" src="/images/media-logos.png" alt="Media logos" />
	    <form name="register-form" id="register-form" action="quickreg/register" method="post">
	      <h3>Instant Math Tutoring
	
	      </h3>
	      <p class="main-question">
	        <input type="text" name="question" id="question" value="Describe your question briefly here"/>
	      </p>
	      <!--register-block-->
	      <div id="register-block">
	        <h4 class="clearfix" style="font-weight:normal">Your first few sessions are <strong>free</strong>! Create an account to get started:</h4>
	        <!--register block fields-->
	        <div id="register-block-fields">
	          <ul class="clearfix">
	            <li>
	              <input type="text"  class="validate[required,custom[onlyLetterSp],funcCall[checkName]]" id="name" name="name" placeholder="Full Name"/>
	            </li>
	            <li>
	            <input type="text" id="email" class="validate[required,custom[email],funcCall[emailDupcheck],funcCall[resData]]" name="email" placeholder="Email Address"/>
	            </li>
	            <li>
	              <input type="password" class="validate[required,funcCall[checkPassword]]" id="password" name="password" placeholder="Password"/>
	            </li>
	            <li>
	              <input type="password" class="validate[required,funcCall[checkRPassword]] " id="confirm-password" name="confirm-password" placeholder="Confirm Password"/>
	            </li>
	            <!-- Email Filter Utoronto.ca - ,funcCall[emailValidateNew]  -->
	          </ul>
	          <div id="tos-create-account" class="clearfix">
	            <p class="tos">By submitting this form, you indicate that you have read and agree to the <a href="tos.html" target="_blank">Terms &amp; Conditions</a></p>
	            <p class="create-account"><input type="image" src="<?php echo $baseRootPath; ?>/images/landing/ask-question-button.png" alt="Question" />
	            </p>
	            <input type="hidden" id="checkdata" name="checkdata" />
	          </div>
	        </div>
	        <!--register block fields start/register -->
	
	      </div>
	      <!--register-block-->
	
	    </form>
		</div>
  </div>
  <!--container-->
  <?php //print_r($_SESSION); ?>
</div>
<!--register-->

<!--bubble section-->
<div id="bubble-section">

  <!--container-->
  <div class="container clearfix">

    <!--bubble-->
    <div class="bubble">
      <h3>1. Ask a Question</h3>
      <p>Let us know the math question or topic that you need help with.</p>
      <img src="<?php echo $baseRootPath; ?>/images/landing/bubble-1-question.png" alt="Ask a Question" /> </div>
    <!--bubble-->

    <!--bubble-->
    <div class="bubble">
      <h3>2. Select a Tutor</h3>
      <p>We generate a list of online tutors that are BEST suited to help you, right now.</p>
      <img src="<?php echo $baseRootPath; ?>/images/landing/bubble-2-tutor.png" alt="Tutor" /> </div>
    <!--bubble-->

    <!--bubble-->
    <div class="bubble">
      <h3>3. Learn</h3>
      <p>Within 60 seconds, you are connected to our interactive whiteboard with your live tutor.</p>
      <img src="<?php echo $baseRootPath; ?>/images/landing/bubble-3-learn.png" alt="Learn" /> </div>
    <!--bubble-->

  </div>
  <!--container-->

</div>
<!--bubble-section-->

<!--questions-->
<div id="questions">

  <!--container-->
  <div class="container">

    <!--q-1-->
    <div class="q-1">
      <h3>Connect to</h3>
      <p>peers and experts who are specifically qualified to help you...</p>
    </div>
    <!--q-1-->

    <!--q-2-->
    <div class="q-2">
      <h3>Get Help</h3>
      <p>on algebra, limits, integrals, trigonometry, mortgages, matrices...</p>
    </div>
    <!--q-2-->

    <!--q-3-->
    <div class="q-3"> </div>
    <!--q-3-->

    <!--q-4-->
    <div class="q-4">
      <p>&quot;What is the derivative of 2x^2+34x^2?&quot;</p>
    </div>
    <!--q-4-->

    <!--q-5-->
    <div class="q-5">
      <p>&quot;What are the exact steps to factor f(x)= x^(3)+2x^(2)-45x-126?&quot;</p>
    </div>
    <!--q-5-->

    <!--q-6-->
    <img src="<?php echo $baseRootPath; ?>/images/landing/qmark-6.png" alt="Questions?" class="q-6" /><!--q-6-->

    <!--q-7-->
    <img src="<?php echo $baseRootPath; ?>/images/landing/qmark-7.png" alt="Questions?" class="q-7" /><!--q-7-->

    <!--q-8-->
    <img src="<?php echo $baseRootPath; ?>/images/landing/qmark-8.png" alt="Questions?" class="q-8" /><!--q-8-->

  </div>
  <!--container-->

</div>
<!--questions-->

<!--whiteboard-->
<div id="whiteboard">

  <!--container-->
  <div class="container"> <a><img src="<?php echo $baseRootPath; ?>/images/landing/whiteboard.png" alt="Whiteboard" /></a> <a class="plus-green plus">+</a>

    <!--plus green-->
    <div id="plus-green" class="tooltip fade">
      <h3>Tools</h3>
      <p>The math equation writer makes it easy to communicate your question and thoughts. </p>
    </div>
    <!--plus green-->

    <a class="plus-grey plus">+</a>

    <!--plus grey-->
    <div id="plus-grey" class="tooltip fade">
      <h3>Video</h3>
      <p>See or listen to the tutor explain the concepts in question as they draw it out for you in real time. </p>
    </div>
    <!--plus grey-->

    <a class="plus-blue plus">+</a>

    <!--plus blue-->
    <div id="plus-blue" class="tooltip fade">
      <h3>Chat</h3>
      <p>More comfortable typing? We've got you covered! </p>
    </div>
    <!--plus blue-->

    <a class="plus-orange plus">+</a>

    <!--plus orange-->
    <div id="plus-orange" class="tooltip fade">
      <h3>Board</h3>
      <p>Watch as the tutor illustrates each step in a visual way on the live shared whiteboard. </p>
    </div>
    <!--plus orange-->

    <div class="clip-left clip"></div>
    <div class="clip-right clip"></div>
  </div>
  <!--container-->

</div>
<!--whiteboard-->

<!--newletter-->
<div id="newsletter">

  <!--container-->
  <div class="container">

    <!--newsletter-content-->
    <div id="newsletter-content">

      <!--video-->
      <div class="video">
        <iframe id="promo-video" src="http://fast.wistia.com/embed/iframe/6311e77c10?videoWidth=465&amp;videoHeight=262&amp;volumeControl=true&amp;playerColor=313131&amp;plugin%5BpostRoll%5D%5Bversion%5D=v1&amp;plugin%5BpostRoll%5D%5Btext%5D=Click%20here%20to%3Cbr%2F%3Eregister%20(it's%20free!)&amp;plugin%5BpostRoll%5D%5Blink%5D=http%3A%2F%2Frayku.com%2Fregister&amp;plugin%5BpostRoll%5D%5Bstyle%5D%5BbackgroundColor%5D=%23006699&amp;plugin%5BpostRoll%5D%5Bstyle%5D%5Bcolor%5D=%23ffffff&amp;plugin%5BpostRoll%5D%5Bstyle%5D%5BfontSize%5D=22px&amp;plugin%5BpostRoll%5D%5Bstyle%5D%5BfontFamily%5D=Gill%20Sans%2C%20Helvetica%2C%20Arial%2C%20sans-serif" class="wistia_embed" name="wistia_embed" width="465" height="262"></iframe>
        <form action="#" id="newsletter-form">
          <p>Take 30 seconds</p>
          <p><a href="/register">Register Now</a></p>
        </form>
      </div>
      <!--video-->

    </div>
    <!--newsletter-content-->
  </div>
  <!--container-->

</div>
<!--newsletter-->

<!--footer-->
<div class="footer">

  <!--container-->
  <div class="container">
    <div style="width:300px;float:left;">Copyright 2012 Rayku, Inc. All rights reserved.</div>
    <div style="width:500px;float:right; text-align: right;">Get in touch! 1-888-98RAYKU // <a href="mailto:cs@mail.rayku.com">email us</a> // <a href="<?php echo sfConfig::get('app_rayku_url') ?>/tos.html" target="_blank" title="[Opens in pop-up window]">legal</a></div>
  </div>
  <!--container-->

</div>

<!--footer--> 
<script type="text/javascript" src="<?php echo $baseRootPath; ?>/js/validation/languages/jquery.validationEngine-en.js"></script>
<script type="text/javascript" src="<?php echo $baseRootPath; ?>/js/validation/jquery.validationEngine.js"></script>
<script type="text/javascript" src="<?php echo $baseRootPath; ?>/js/start_validation.js"></script>
<script type="text/javascript" src="<?php echo $baseRootPath; ?>/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="<?php echo $baseRootPath; ?>/js/placeholder_fixer.js"></script>
<script type="text/javascript" src="<?php echo $baseRootPath; ?>/js/landing/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="<?php echo $baseRootPath; ?>/js/landing/jquery.scrolling-parallax.js"></script>
<script type="text/javascript" src="<?php echo $baseRootPath; ?>/js/landing/functions.js"></script>
<script type="text/javascript" src="<?php echo $baseRootPath; ?>/js/landing/input-fader.js"></script>
<script type="text/javascript" src="<?php echo $baseRootPath; ?>/js/iframe-api-v1.js"></script>
</body>
</html>