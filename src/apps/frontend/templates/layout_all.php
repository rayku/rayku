<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include_http_metas() ?>
<?php include_metas() ?>
<?php include_title() ?>
<link rel="stylesheet" type="text/css" href="<?php echo $baseRootPath; ?>/css/navigation.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo $baseRootPath; ?>/css/global.css" />
<?php if($sf_context->getModuleName() =='profile'): ?>
<link rel="stylesheet" type="text/css" href="<?php echo $baseRootPath; ?>/css/custom/edit-profile.css"/>
<?php endif; ?>
<?php if($sf_context->getModuleName() =='message' and $sf_context->getActionName() !='compose'): ?>
<link rel="stylesheet" type="text/css" href="<?php echo $baseRootPath; ?>/css/custom/pm-homepage.css"/>
<?php endif; ?>
<?php if($sf_context->getModuleName() =='search' || $sf_context->getModuleName() =='profile' || $sf_context->getModuleName() =='tutors'): ?>
<link rel="stylesheet" type="text/css" href="<?php echo $baseRootPath; ?>/styles/donny.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo $baseRootPath; ?>/css/custom/pplsrch-results.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo $baseRootPath; ?>/css/pager.css"/>
<?php endif; ?>
<?php if($sf_context->getModuleName() =='login'): ?>
<link rel="stylesheet" type="text/css" href="<?php echo $baseRootPath; ?>/styles/donny.css"/>
<?php endif; ?>
<?php if($sf_context->getModuleName() =='dashboard'): ?>
<link rel="stylesheet" type="text/css" href="<?php echo $baseRootPath; ?>/styles/pf_global.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo $baseRootPath; ?>/css/46.css"/>
<?php endif; ?>
<?php if($sf_context->getModuleName() == 'expertmanager'):?>
<link rel="stylesheet" type="text/css" href="<?php echo $baseRootPath; ?>/styles/classroom.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $baseRootPath; ?>/css/custom/button.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo $baseRootPath; ?>/css/pager.css"/>
<!-- Connect Pop Up CSS -->
<link rel="stylesheet" type="text/css" href="<?php echo $baseRootPath; ?>/css/connect.css" />
<?php endif; ?>
<?php if($sf_context->getModuleName() == 'tutors'):?>
<link rel="stylesheet" type="text/css" href="<?php echo $baseRootPath; ?>/styles/classroom.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $baseRootPath; ?>/css/custom/button.css"/>
<!-- Connect Pop Up CSS -->
<link rel="stylesheet" type="text/css" href="<?php echo $baseRootPath; ?>/css/connect.css" />
<?php endif; ?>
<?php if($sf_context->getModuleName() =='whiteboard'): ?>
<link rel="stylesheet" type="text/css" href="<?php echo $baseRootPath; ?>/styles/pf_global.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo $baseRootPath; ?>/css/46.css"/>
<?php endif; ?>

<?php
if($sf_context->getModuleName() !='expertmanager') {
	if(@$_SESSION['symfony/user/sfUser/attributes']['symfony/user/sfUser/attributes']['user_id']!="") { 
		$sessUserId = $_SESSION['symfony/user/sfUser/attributes']['symfony/user/sfUser/attributes']['user_id'];
		$queryStatus = mysql_query("select * from user_expert where user_id=".$sessUserId." ") or die(mysql_error());
		if(mysql_num_rows($queryStatus)) {
			mysql_query("DELETE FROM `sendmessage` WHERE `asker_id` =".$sessUserId." ") or die(mysql_error());
			mysql_query("DELETE FROM `user_expert` WHERE `user_id`=".$sessUserId." ") or die(mysql_error());
			setCookie("redirection", "",time()-600);
			setCookie("forumsub", "",time()-600);
		}
	}
}
?>

<script type="text/javascript" src="<?php echo $baseRootPath; ?>/js/add-event.js"></script>
<script type="text/javascript" src="<?php echo $baseRootPath; ?>/js/popup.js"></script>
<script type="text/javascript" src="<?php echo $baseRootPath; ?>/js/jquerynav.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo $baseRootPath; ?>/js/jquery.notifier.js"></script>
<script type="text/javascript">
  window.globalConfig = {
    whiteboard_url: '<?php echo sfConfig::get('app_whiteboard_url').'/'; ?>',
    cookies_domain: '<?php echo sfConfig::get('app_cookies_domain').'/'; ?>'
  }
</script>
<style type="text/css">
<?php if( ( sfContext::getInstance()->getModuleName() == 'expertmanager' ) && ( sfContext::getInstance()->getActionName() == 'index')): ?> @import "styles/ex_global.css";
 @import "<?php echo $baseRootPath; ?>/css/46.css";
 @import "<?php echo $baseRootPath; ?>/styles/ex_donny.css";
 @import "<?php echo $baseRootPath; ?>/styles/ex_tabcontent.css";
<?php endif;
?>
</style>
<?php if( $sf_context->getModuleName() =='tourpage'
          && ( sfContext::getInstance()->getActionName() == 'index') ): ?>
<?php echo stylesheet_tag('custom/tourpage') ?><?php echo javascript_include_tag('slider1') ?><?php echo javascript_include_tag('jquery-min') ?>
<?php endif; ?>
<?php if( $sf_context->getModuleName() =='register'): ?>
<link rel="stylesheet" type="text/css" href="<?php echo $baseRootPath; ?>/css/46.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo $baseRootPath; ?>/css/custom/register.css"/>
<?php endif; ?>

<?php if( $sf_context->getModuleName() !='tutorsignup'): ?>
<?php templateGoogleAnalytics(); ?>
<?php endif; ?>

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
      <div class="clear-both"></div>
      <form action="/search" method="post">
        <div class="searchform">
          <fieldset>
            Find
            <?php $options=array("people"=>"People:","forums"=>"Q&A Posts:"); ?>
            <?php echo select_tag("findfrom",options_for_select($options,$sf_request->getParameter('findfrom')),array('class' => 'sselect')); ?>
            <input type="text" name="criteria" class="text-box" value="<?php echo $sf_request->getParameter('criteria') ?>" />
            <input type="submit" class="myButton" value="Search!" />
          </fieldset>
        </div>
      </form>
    </div>
    <!-- end of content -->
    
    <div id="footer" style="padding-bottom:40px;">
      <div class="foo">
        <div class="partners"><a href="http://rayku.com" target="_blank"><img src="<?php echo image_path('img-footer-logo-1.png', false); ?>" alt="rayku.com"/></a> </div>
        <p style="margin-top:10px">Copyright 2012 Rayku, Inc.  All rights reserved.</p>
        <ul>
          <li><a href="mailto:cs[at]rayku.com">contact us</a></li>
          <li><a href="http://rayku.com/tos.html" rel="popup standard 800 600 noicon">legal</a></li>
          <?php if(!$sf_user->isAuthenticated()) { ?>
          <li class="nobg"><a href="http://rayku.com/joinus">become a rayku tutor</a></li>
          <?php } else { ?>
          <li class="nobg"><a href="http://rayku.com/dashboard">activate tutor status</a></li>
          <?php } ?>
        </ul>
        <div style="clear:both"></div>
      </div>
    </div>
    <!-- end of footer --> 
    
  </div>
  <!-- end of primary --> 
</div>
<!-- end of wrapper -->
<?php templateUserVoice(); ?>
</body>
</html>