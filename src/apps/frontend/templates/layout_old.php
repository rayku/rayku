<?php if( ( sfContext::getInstance()->getModuleName() == 'start' )) : ?>

<!DOCTYPE html  PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>Rayku.com - On-Demand College Education Help</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="/css/landing.css"/>
<link rel="stylesheet" href="/css/lightbox.css" type="text/css" media="screen" />
<link rel="stylesheet" type="text/css" href="/styles/style.css" media="screen" />
<link rel="stylesheet" type="text/css" href="/styles/print.css" media="print" />
<link rel="stylesheet" href="js/register_popup/general.css" type="text/css" media="screen" />
<script type="text/javascript">document.documentElement.className += " js";</script>
<script type="text/javascript" src="/js/lightbox.js"></script>
<script type="text/javascript" src="/scripts/landing.js"></script>
<script type="text/javascript" src="/video/flowplayer-3.2.2.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script src="js/register_popup/jquery-1.2.6.min.js" type="text/javascript"></script>
<script src="js/register_popup/popup.js" type="text/javascript"></script>	
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-21399448-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</head>
<body>

<?php if ($sf_user->isAuthenticated()): ?>
<?php header ("Location: http://www.rayku.com/dashboard"); ?>
<?php endif ; ?>
<div id="wrapper">
  <div id="top"> <a href="http://www.rayku.com" title="home"><img src="/images/rayku_logo.png" alt="Rayku.com" /></a>
    <ul>
      <li><a href="http://www.rayku.com/images/oops.jpg" rel="lightbox">Members Sign In</a></li>
    </ul>
  </div>
   
  <!--End top-->
  
  <div id="featured">
    <p class="info" style="font-size:16px;margin-top:30px"><br />
      Rayku.com is a peer-to-peer online tutoring website for instant, on-demand academic help.<br />
      <br />
    We are currently in <strong>private beta</strong> to the <strong>University of Toronto</strong>. Interested? <a href="http://www.rayku.com/register" style="color:#C3EFFF;">Register for free</a>.</p>
    <div id="video" align="center"> <a href="http://www.rayku.com/video/raykuvid.flv" id="player" style="display:block;width:430px;height:242px;color:#FFF"> <img src="/images/prescreen2.jpg" alt="Rayku Introduction Video" /> </a> 
      <script language="JavaScript">
	  flowplayer("player", "http://www.rayku.com/video/flowplayer-3.2.2.swf", {
		  clip : {
			 autoBuffering: true,
			 },
			 onLoad: function() {	// called when player has finished loading
			 this.setVolume(100);	// set volume property
			 }
	  });
      </script> 
    </div>
    <form action="#" method="get">
      <p><?php echo link_to('<img src="/images/startnowbutton.png"/>', 'register/index'); ?></p>
      <p><?php echo link_to('<img src="/images/tourbutton.png"/>', 'tourpage/index'); ?></p>
    </form>
    <div style="clear: both;"></div>
  </div>
  <!-- End Featured-->
  
    <div id="quotebox">
    <p>"My college recommends that I spend 3 hours of study for each class I attend. With Rayku, 2's enough." -<span>Theo Swami</span></p>
  </div><!--End Quote Box-->


  <!--<div id="content">
    <div id="registrationarea">
      <div id="roundtop"></div>
      <a href="http://www.rayku.com/register"><img src="http://www.rayku.com/images/registernow.png" border="0"/></a>
      <h2 style="font-size:16px;color:#333">Use coupon code <strong>'launch11'</strong> for a $10 tutoring credit (first 500)</h2>
    </div>
  </div>

      <div id="roundbottom"></div>
</div>-->

    <!--End Registration Area-->
  <!--End content-->
  
  <div id="footer" style="margin-top:0">
    <div style="font-size:12px;color:#333;font-family:Tahoma, Geneva, sans-serif;margin:8px 0 20px 0;line-height:18px" align="center">Copyright 2011 Rayku.com All Rights Reserved | <a href="http://www.rayku.com/certification">Paid Tutor Certification</a> | <a href="mailto:admin@rayku.com">Email Us</a><br />
</div></div>
  <!--End Footer--> 
</div>
<!--End Wrapper-->

</body>
</html>
<?php else: ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include_http_metas() ?>
<?php include_metas() ?>
<?php include_title() ?>
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
<?php if($sf_context->getModuleName() =='search' || $sf_context->getModuleName() =='friends' || $sf_context->getModuleName() =='profile'): ?>
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
<script type="text/javascript" src="/js/flowplayer-3.1.4.min.js"></script>
<script type="text/javascript" src="http://www.rayku.com/js/add-event.js"></script>
<script type="text/javascript" src="http://www.rayku.com/js/popup.js"></script>
<style type="text/css">
<?php if( ( ( sfContext::getInstance()->getModuleName() == 'classmanager' ) && ( sfContext::getInstance()->getActionName() == 'list') || ( sfContext::getInstance()->getModuleName() == 'studentmanager' ) && ( sfContext::getInstance()->getActionName() == 'index') ) || ( ( sfContext::getInstance()->getModuleName() == 'profile' ) && ( sfContext::getInstance()->getActionName() == 'edit') ) ): ?> @import "/styles/cm_global.css";
 @import "/css/46.css";
 @import "/styles/donny.css";
 <?php endif;
?> <?php if( ( sfContext::getInstance()->getModuleName() == 'expertmanager' ) && ( sfContext::getInstance()->getActionName() == 'index')): ?> @import "styles/ex_global.css";
 @import "css/46.css";
 @import "styles/ex_donny.css";
 @import "styles/ex_tabcontent.css";
 <?php endif;
?>
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
</head>
<?php if(( sfContext::getInstance()->getModuleName() == 'profile' ) && ( sfContext::getInstance()->getActionName() == 'index')): ?>
<body id="subpage">
<?php else: ?>
<body>
<?php endif; ?>

<div id="wrapper">

  <div class="primary">
    <?php include_partial('global/topNav'); ?>
    <div id="body">
      <?php  include_partial('global/messages') ?>
      <?php echo $sf_content ?>
      <div class="clear-both" style="height:30px"></div>
      <form action="/search" method="post">
      <div style="background: none repeat scroll 0pt 0pt rgb(235, 235, 235); border-color: rgb(177, 177, 177); border-style: solid; border-width: 1px 0pt; font: 1.4em Arial; margin: 0pt 16px; padding: 20px 0pt; text-align: center;">
      <fieldset>
        <span style="font-size:16px;margin-right:10px;font-weight:bold">Search Rayku:</span>
        <?php $options=array("people"=>"People","groups"=>"Groups","forums"=>"Forums"); ?>
        <input type="text" name="criteria" class="text-box" style="padding:4px;font-size:14px;margin-right:8px" value="<?php echo $sf_request->getParameter('criteria') ?>" />
        <?php echo select_tag("findfrom",options_for_select($options,$sf_request->getParameter('findfrom')),array('style' => 'padding:2px;background:none;height:auto;width:auto;margin:0 8px 0 0;border:1px solid #999999')); ?>
        <input type="submit" style="padding:3px" value="Search" />
      </fieldset>
      </div>
      </form>
    </div>
    <!-- end of div#body -->
    
    <div id="footer">
      <div class="foo">
        <div class="partners"> <a href="http://www.kinkarso.com" target="_blank"><img src="../../../images/img-footer-logo-2.png" alt="kinkarso.com"/></a> <a href="http://www.rayku.com" target="_blank"><img src="../../../images/img-footer-logo-1.png" alt="rayku.com"/></a> </div>
        <p>Copyright 2011 Rayku.com.  All rights reserved.</p>
        <p>Rayku is a subsidiary of Kinkarso Tech, LLC.</p>
        <ul>
          <li><?php echo link_to( 'member list', 'friends/index' ); ?></li>
          <li><a href="http://www.rayku.com/tos.html" rel="popup standard 800 600 noicon">legal</a></li>
          <li><a href="http://www.rayku.com/certification">certification</a></li>
          <li class="nobg"><a href="mailto:administration[at]rayku.com">contact us</a></li>
        </ul>
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
