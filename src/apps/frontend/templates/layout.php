<?php if( ( sfContext::getInstance()->getModuleName() == 'start' )) : ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>On-Demand P2P Math Tutoring | Calculus, Algebra, Statistics, more | Rayku.com</title>
<link href="../css/landing/style.css" rel="stylesheet" media="screen" type="text/css" />
<!--[if lte IE 8]>
<link href="css/ie78.css" rel="stylesheet" media="screen" type="text/css" />
<![endif]-->
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-21399448-5']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</head>

<body>
<div id="top-nav">
  <!-- For the person who will use this code. Check the TITLES of the <a> tags! They correspond in the CSS file aswell! -->
  <div id="top-nav-center">
    <ul class="top-menu">
      <li><a href="http://www.rayku.com/start" title="Rayku">Rayku</a></li>
    </ul>
    <!--ul.top-menu-->
    <div id="user-box" align="left">
    <a href="#whiteboard" title="Whiteboard" target="_blank" class="tt-whiteboard">Whiteboard</a>
    <div style="float:right;padding:15px 20px 0 0;"><a href="http://twitter.com/raykuedu" target="_blank"><img src="/landing/images/twitter.png" /></a></div>
    <div style="float:right;padding:15px 20px 0 0;"><a href="http://facebook.com/raykuedu" target="_blank"><img src="/landing/images/facebook.png" /></a></div>
    </div>
    <!--div#user-box-->
    <div class="clear"></div>
  </div>
  <!--div#top-nav-center-->
</div>
</div>
<!--div#top-nav-->

<!--register-->
<div id="register">

  <!--container-->
  <div class="container"> <img src="../images/landing/banner-txt.png" alt="RAYKU IS ON-DEMAND" />
    <div class="play"> <a href="#newsletter">Play Video</a> </div>

    <!--registration options-->
    <div id="registration-options">
      <h2><img src="../images/landing/connect-to-rayku.png" alt="Connect To Rayku" /></h2>
      <div id="connect-to-tabs">
        <ul>
          <li id="registration-tab" class="active"><a href="javascript:;" class="register-tab">Create Account</a></li>
          <li id="login-tab"><a href="javascript:;" class="login-tab">Log In</a></li>
        </ul>
      </div>
    </div>
    <!--registration opens-->

    <!--registration form-->
    <div class="login-form-div">
    <form action="/login/loginCheck" id="login-form" method="post">
      <div class="input-fader">
        <label for="email">Email Address</label><input class="email" id="email" name="name" type="text" />

     	</div>
      <div class="input-fader">
        <label for="email">Password</label><input class="password" type="password" id="password" name="pass">
      </div>
      <p>
        <input type="submit" value="Login" />
      </p>
    </form>
    </div>
    <!--registration form-->

    <!--login form-->
    <div class="register-form-div">
    <form action="/register" id="registration-form">
      <div class="input-fader">
	        <label for="name">Full Name</label><input class="name" type="text" />
      </div>
      <div class="input-fader">
        <label for="email">Email Address</label><input class="email" type="text" />
      </div>
      <p>
        <input type="submit" value="Register" />
      </p>
    </form>
    </div>
    <!--rlogin form-->

    <!--scroll for more-->
    <div id="scroll-for-more">
      <p><a href="#whiteboard"><img src="../images/landing/scroll-arrow.png" alt="Scroll" style="margin-top:20px;"/></a></p>
    </div>
    <!--scroll for more-->

  </div>
  <!--container-->

</div>
<!--register-->

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
    <img src="../images/landing/qmark-6.png" alt="Questions?" class="q-6" /><!--q-6-->

    <!--q-7-->
    <img src="../images/landing/qmark-7.png" alt="Questions?" class="q-7" /><!--q-7-->

    <!--q-8-->
    <img src="../images/landing/qmark-8.png" alt="Questions?" class="q-8" /><!--q-8-->

  </div>
  <!--container-->

</div>
<!--questions-->

<!--whiteboard-->
<div id="whiteboard">

  <!--container-->
  <div class="container"> <a><img src="../images/landing/whiteboard.png" alt="Whiteboard" /></a> <a class="plus-green plus">+</a>

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
        <object width="465" height="260" id="wistia_355291" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000">
          <param name="movie" value="http://embed.wistia.com/flash/embed_player_v1.1.swf"/>
          <param name="allowfullscreen" value="true"/>
          <param name="allowscriptaccess" value="always"/>
          <param name="wmode" value="opaque"/>
          <param name="flashvars" value="videoUrl=http://embed.wistia.com/deliveries/ba0a68c9caf8ac95d7db03fa1af41508ce3aae18.bin&stillUrl=http://embed.wistia.com/deliveries/25764ea6e2c447c5d69d07633de6e3ff91fa0e14.bin&unbufferedSeek=false&controlsVisibleOnLoad=false&autoPlay=false&endVideoBehavior=reset&playButtonVisible=true&embedServiceURL=http://distillery.wistia.com/x&accountKey=wistia-production_6330&mediaID=wistia-production_355291&mediaDuration=116.08"/>
          <embed src="http://embed.wistia.com/flash/embed_player_v1.1.swf" width="465" height="260" name="wistia_355291" type="application/x-shockwave-flash" allowfullscreen="true" allowscriptaccess="always" wmode="opaque" flashvars="videoUrl=http://embed.wistia.com/deliveries/ba0a68c9caf8ac95d7db03fa1af41508ce3aae18.bin&stillUrl=http://embed.wistia.com/deliveries/25764ea6e2c447c5d69d07633de6e3ff91fa0e14.bin&unbufferedSeek=false&controlsVisibleOnLoad=false&autoPlay=false&endVideoBehavior=reset&playButtonVisible=true&embedServiceURL=http://distillery.wistia.com/x&accountKey=wistia-production_6330&mediaID=wistia-production_355291&mediaDuration=116.08"></embed>
        </object>
        <script src="http://embed.wistia.com/embeds/v.js" charset="ISO-8859-1"></script><script>if(!navigator.mimeTypes['application/x-shockwave-flash'] || navigator.userAgent.match(/Android/i)!==null)Wistia.VideoEmbed('wistia_355291',465,260,{videoUrl:'http://embed.wistia.com/deliveries/aeee0f5fed348f465177b871fde7bb0b30ab7405.bin',stillUrl:'http://embed.wistia.com/deliveries/25764ea6e2c447c5d69d07633de6e3ff91fa0e14.bin',distilleryUrl:'http://distillery.wistia.com/x',accountKey:'wistia-production_6330',mediaId:'wistia-production_355291',mediaDuration:116.08})</script>
        <form action="#" id="newsletter-form">
          <p>Take 30 seconds</p>
          <p><a href="#register">Register Now</a></p>
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
    <div style="width:300px;float:left;">Copyright 2011 Rayku, Inc. All rights reserved.</div>
    <div style="width:300px;float:right;" align="right"><a href="mailto:cs@rayku.com">contact us</a> // <a href="http://rayku.com/tos.html" target="_blank" title="[Opens in pop-up window]">legal</a> // <a href="http://rayku.com/joinus">become a rayku tutor</a></div>
  </div>
<!--container-->

</div>
<!--footer-->

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>
<script type="text/javascript" src="../js/landing/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="../js/landing/jquery.scrolling-parallax.js"></script>
<script type="text/javascript" src="../js/landing/functions.js"></script>
<script type="text/javascript" src="../js/landing/input-fader.js"></script>
</body>
</html>

<?php else: ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include_http_metas() ?>
<?php include_metas() ?>
<?php include_title() ?>
	<link rel="stylesheet" type="text/css" href="/css/navigation.css"/>
	<link rel="stylesheet" type="text/css" href="/css/main.css"/>
<?php if($sf_context->getModuleName() =='journal'): ?>
	<link rel="stylesheet" type="text/css" href="/css/custom/read-journal.css"/>
	<link rel="stylesheet" type="text/css" href="/css/forum.css"/>
<?php endif; ?>
<?php if($sf_context->getModuleName() =='profile'): ?>
	<link rel="stylesheet" type="text/css" href="/css/custom/edit-profile.css"/>
<?php endif; ?>
<?php if($sf_context->getModuleName() =='message' and $sf_context->getActionName() !='compose'): ?>
	<link rel="stylesheet" type="text/css" href="/css/custom/pm-homepage.css"/>
<?php endif; ?>
<?php if($sf_context->getModuleName() =='search' || $sf_context->getModuleName() =='friends' || $sf_context->getModuleName() =='profile' || $sf_context->getModuleName() =='tutors'): ?>
	<link rel="stylesheet" type="text/css" href="/styles/donny.css"/>
	<link rel="stylesheet" type="text/css" href="/css/custom/pplsrch-results.css"/>
	<link rel="stylesheet" type="text/css" href="/css/pager.css"/>
<?php endif; ?>
<?php if($sf_context->getModuleName() =='gallery' and $sf_context->getActionName() =='home'): ?>
	<link rel="stylesheet" type="text/css" href="/css/custom/gallery-homepage.css"/>
<?php endif; ?>
<?php if($sf_context->getModuleName() =='gallery' and $sf_context->getActionName() =='show'): ?>
	<link rel="stylesheet" type="text/css" href="/css/custom/album-homepage.css"/>
<?php endif; ?>
<?php if($sf_context->getModuleName() =='gallery' and $sf_context->getActionName() =='upload'): ?>
	<link rel="stylesheet" type="text/css" href="/css/custom/upload-media.css"/>
<?php endif; ?>
<?php if($sf_context->getModuleName() =='gallery'): ?>
	<link rel="stylesheet" type="text/css" href="/css/custom/view-media.css"/>
<?php endif; ?>
<?php if($sf_context->getModuleName() =='network'): ?>
	<link rel="stylesheet" type="text/css" href="/styles/donny.css"/>
	<link rel="stylesheet" type="text/css" href="/css/custom/network-homepage.css"/>
	<link rel="stylesheet" type="text/css" href="/styles/pf_global.css"/>
	<link rel="stylesheet" type="text/css" href="/css/46.css"/>
<?php endif; ?>
<?php if($sf_context->getModuleName() =='login'): ?>
	<link rel="stylesheet" type="text/css" href="/styles/donny.css"/>
<?php endif; ?>
<?php if($sf_context->getModuleName() =='dashboard'): ?>
	<link rel="stylesheet" type="text/css" href="/styles/pf_global.css"/>
	<link rel="stylesheet" type="text/css" href="/css/46.css"/>
<?php endif; ?>
<?php if($sf_context->getModuleName() =='invitation'): ?>
	<link rel="stylesheet" type="text/css" href="/styles/donny.css"/>
<?php endif; ?>
<?php if($sf_context->getModuleName() =='studentmanager' && $sf_context->getActionName() =='search'): ?>
	<link rel="stylesheet" type="text/css" href="/styles/donny.css"/>
	<link rel="stylesheet" type="text/css" href="/css/custom/pplsrch-results.css"/>
<?php endif; ?>
<?php if($sf_context->getModuleName() =='whiteboard'): ?>
	<link rel="stylesheet" type="text/css" href="/styles/pf_global.css"/>
	<link rel="stylesheet" type="text/css" href="/css/46.css"/>
<?php endif; ?>
	<script type="text/javascript" src="/js/add-event.js"></script>
	<script type="text/javascript" src="/js/popup.js"></script>
  <script type="text/javascript" src="/js/jquerynav.js"></script>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
  <script type="text/javascript" src="/js/jquery.notifier.js"></script>
<style type="text/css">
<?php if( ( ( sfContext::getInstance()->getModuleName() == 'classmanager' ) && ( sfContext::getInstance()->getActionName() == 'list') || ( sfContext::getInstance()->getModuleName() == 'studentmanager' ) && ( sfContext::getInstance()->getActionName() == 'index') ) || ( ( sfContext::getInstance()->getModuleName() == 'profile' ) && ( sfContext::getInstance()->getActionName() == 'edit') ) ): ?> @import "/styles/cm_global.css";
 @import "/css/46.css";
 @import "/styles/donny.css";
<?php endif; ?>
<?php if( ( sfContext::getInstance()->getModuleName() == 'expertmanager' ) && ( sfContext::getInstance()->getActionName() == 'index')): ?> @import "styles/ex_global.css";
 @import "css/46.css";
 @import "styles/ex_donny.css";
 @import "styles/ex_tabcontent.css";
<?php endif; ?>
</style>
<?php if( ( sfContext::getInstance()->getModuleName() == 'profile' ) &&
	          ( sfContext::getInstance()->getActionName() == 'index')): ?>
	<link href="/styles/pf_global.css" type="text/css" rel="stylesheet" />
<?php endif; ?>
<?php if( ( sfContext::getInstance()->getModuleName() == 'expert_lesson' ) &&
	          ( sfContext::getInstance()->getActionName() == 'edit') ||
            ( sfContext::getInstance()->getModuleName() == 'expert_lesson' ) &&
	          ( sfContext::getInstance()->getActionName() == 'create') ): ?>
	<link rel="stylesheet" type="text/css" href="/styles/ex_create_lesson.css"/>
<?php endif; ?>
<?php if( ( sfContext::getInstance()->getModuleName() == 'experts_immediate_lesson' ) &&
	          ( sfContext::getInstance()->getActionName() == 'edit') ||
            ( sfContext::getInstance()->getModuleName() == 'experts_immediate_lesson' ) &&
	          ( sfContext::getInstance()->getActionName() == 'create') ): ?>
	<link rel="stylesheet" type="text/css" href="/styles/ex_create_lesson.css"/>
<?php endif; ?>
<?php if( $sf_context->getModuleName() =='tourpage'
          && ( sfContext::getInstance()->getActionName() == 'index') ): ?>
<?php echo stylesheet_tag('custom/tourpage') ?><?php echo javascript_include_tag('slider1') ?><?php echo javascript_include_tag('jquery-min') ?>
<?php endif; ?>
<?php if( $sf_context->getModuleName() =='register'): ?>
	<link rel="stylesheet" type="text/css" href="/css/46.css"/>
<?php endif; ?>
<?php if( $sf_context->getModuleName() =='register'
          && ( sfContext::getInstance()->getActionName() == 'index'
             || sfContext::getInstance()->getActionName() == 'stepthird' ) ): ?>
	<link rel="stylesheet" type="text/css" href="/css/custom/register.css"/>
<?php endif; ?>
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-21399448-5']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
</head>

<?php if(( sfContext::getInstance()->getModuleName() == 'profile' ) && ( sfContext::getInstance()->getActionName() == 'index')): ?>
<body id="subpage" style="background:none">
<?php else: ?>
<body style="background:none">
<?php endif; ?>

<?php include_partial('global/topNav'); ?>
<div id="wrapper">
  <div class="primary">
    <div id="body">
      <?php  include_partial('global/messages') ?>
      <?php echo $sf_content ?>
      <div class="clear-both" style="height:30px"></div>
      <form action="/search" method="post">
        <div style="background: none repeat scroll 0pt 0pt rgb(235, 235, 235); border-color: rgb(177, 177, 177); border-style: solid; border-width: 1px 0pt; font: 1.4em Arial; margin: 0pt 16px; padding: 20px 0pt; text-align: center;">
          <fieldset>
            <span style="font-size:16px;margin-right:10px;font-weight:bold">Search:</span>
            <?php $options=array("people"=>"People","groups"=>"Groups","forums"=>"Forums"); ?>
            <input type="text" name="criteria" class="text-box" style="padding:4px;font-size:14px;margin-right:8px" value="<?php echo $sf_request->getParameter('criteria') ?>" />
            <?php echo select_tag("findfrom",options_for_select($options,$sf_request->getParameter('findfrom')),array('style' => 'padding:2px;background:none;height:auto;width:auto;margin:0 8px 0 0;border:1px solid #999999')); ?>
            <input type="submit" style="padding:3px" value="Search" />
          </fieldset>
        </div>
      </form>
    </div>
    <!-- end of div#body -->

    <div id="footer" style="padding-bottom:40px;">
      <div class="foo">
        <div class="partners"><a href="http://rayku.com" target="_blank"><img src="/images/img-footer-logo-1.png" alt="rayku.com"/></a> </div>
        <p>Rayku is not sponsored or endorsed by any college or university.</p>
        <p>Copyright 2011 Rayku, Inc.  All rights reserved.</p>
        <ul>
          <li><?php echo link_to( 'member list', 'friends/index' ); ?></li>
          <li><a href="http://rayku.com/tos.html" rel="popup standard 800 600 noicon">legal</a></li>
          <li><a href="http://rayku.com/joinus">get certified</a></li>
          <li class="nobg"><a href="mailto:cs[at]rayku.com">contact us</a></li>
        </ul>
        <div style="clear:both"></div>
      </div>
    </div>
    <!-- end of footer -->

  </div>
  <!-- end of primary -->
</div>
<!-- end of wrapper -->
</body>
</html>
<?php endif; ?>
