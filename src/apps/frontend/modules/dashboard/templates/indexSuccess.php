<?php $baseRootPath = sfContext::getInstance()->getRequest()->getRelativeUrlRoot();?>
<div id="tutor_profile"></div>
<!-- Tutor Profile Form -->
<div id="preload">
	<img src="/images/tutorshelp/icon-gtalk-hover.jpg" alt="gtalk" width="74" height="73" />
</div>
<?php
$connection = RaykuCommon::getDatabaseConnection();
/* @var $raykuUser User */
$raykuUser = $sf_user->getRaykuUser();
$stats = $raykuUser->getStatisticsForDashboard();
usort($rankUsers, "cmp");
$curr_user_rank = '';
$ij = 1;

if (count($rankUsers) > 0) {
    foreach($rankUsers as $_expert) {
        if ($_expert['userid'] == $raykuUser->getId()) {
            $curr_user_rank = $ij;
            break;
        }
        $ij++;
    }
}

function cmp($a, $b)
	{
	if ($a["score"] == $b["score"])
		{
		return strcmp($a["createdat"], $b["createdat"]);
		}

	return ($a["score"] < $b["score"]) ? 1 : -1;
	}

?>
<?php $raykuUser = $sf_user->getRaykuUser(); ?>
<div id="body">
  <?php if($sf_user->getRaykuUser()->getType() != 5 && $changeUserType == 1): ?>
  <div id="upgrade">
	  You qualify for an upgrade! You can now get more exposure and charge rates for tutoring: <a href="/dashboard/verifytutor">Click to activate</a>
  </div>
  <?php endif; ?>
  	<!--[if IE]>
		<div id="ie">
			Rayku doesn't work well with Internet Explorer. Please use Firefox or Chrome or another browser.
		</div>
	<![endif]-->  
	<div id="page-title">
		<img height="25" width="42" src="<?php echo image_path('green_arrow.png', false); ?>" />
		<div id="ask-question">Ask a Question</div>
	</div>
	
	<div class="body-left">
		<?php include_partial('askquestion'); ?>
	<div>
	
    <?php include_partial('recent'); ?>
    </div>
</div>
<div class="body-right">
  <div id="myvar_activate"> 
    <!--widget-->
    
    <div class="widget"> 
      
      <!--widget-head-->
      
      <div class="widget-head">
          <h3 id="tutor-level">
            <?php /*if($raykuUser->isTutorStatusEnabled()) : */?><!--
            <?php /*if($stats['expertCount'] >= 125 && $stats['expertCount'] <= 500 && $changeUserType != 1){ */?>
            <?php /*if($sf_user->getRaykuUser()->getType() == 5): */?>
            <span>Staff</span>
            <?php /*else: */?>
            Tutor (level 2)
            <?php /*endif; */?>
            <?php /*} elseif($stats['expertCount'] <= 125) { */?>
            <?php /*if($sf_user->getRaykuUser()->getType() == 5): */?>
            <span>Staff</span>
            <?php /*else: */?>
            Tutor (level 1)
            <?php /*endif; */?>
            <?php /*}  elseif($stats['expertCount'] > 500) { */?>
            <?php /*if($sf_user->getRaykuUser()->getType() == 5): */?>
            <span>Staff</span>
            <?php /*else: */?>
            Tutor (level 3)
            <?php /*endif; */?>
            <?php /*} */?>
            <?php /*else: */?>
            Tutor Status:
            --><?php /*endif;*/ ?>
              Tutor:
          </h3>
        <div id="tutor-status-head">
          <?php if($raykuUser->isTutorStatusEnabled()) { ?>
          <span id="on-off"><span class="is-on">On</span> | <a href="/dashboard/tutor" class="deactivated">Off</a></span>
          <?php } else { ?>
          <span id="on-off"><a href="javascript:tutorprofile();" class="deactivated">On</a> | <span class="is-off">Off</span></span>
          <?php } ?>
        </div>
        <div class="clear"></div>
      </div>
      <!--widget-head-->
      
      <?php


		if($raykuUser->isTutorStatusEnabled() && empty($_COOKIE['loginname'])) : ?>
      
      <!--widget main-->
      
      <div class="widget-main"> 
        
        <!--progress wrap-->
        <?php
		/*$percentage = '';
		if ($stats['expertCount'] <= 125 )
		{
			$percentage = ($stats['expertCount'] / 125) * 100;
		}
		elseif ( ($stats['expertCount'] > 126) && ($stats['expertCount'] <= 500) )
		{
			$percentage = ($stats['expertCount'] / 500) * 100;
		}
		elseif ($stats['expertCount'] > 501 )
		{
			$percentage = 100;
		}*/

		?>
        <!--
        <div id="progress-wrap">
            <div class="ui-progress-bar ui-container" id="progress_bar">
              <div class="ui-progress" style="width:<?=$percentage?>%;"> <span class="ui-label">
                <?php if($stats['expertCount'] <= 25) {	} else { ?>
                <b class="value">
                <?=$percentage?>
                %</b>
                <?php } ?>
                </span> </div>
            </div>
          <div class="goal">
            <?php if($stats['expertCount'] >= 125 && $stats['expertCount'] <= 500 && $changeUserType != 1){ ?>
            Level 3
            <?php } elseif( ($stats['expertCount'] < 125)) { ?>
            Level 2
            <?php } elseif( ($stats['expertCount'] > 500) ) { echo "Level 4"; }?>
          </div>
          <div class="clear"></div>
          Become a level 2 tutor and be able to charge up to 50RP/minute for sessions. You also rank higher on our tutor lists!
       </div>
       -->
        <!--progress wrap--> 
        
        <!--Tutor Rate Slider-->
        
        <div id="tutor-rate-slider">
          <p><span class="black">Your Tutoring Rate:</span> <!--(set recommended)-->
          <div class="amount">
            <input type="text" id="amount" />
            RP/min.</div>
          </p>
          <div id="tutor-rate"></div>
          <input type="hidden" id="amount_hidden" name ="amount_hidden" value=''>
        </div>
        <!--Tutor Rate Slider-->
        <?php
      $usrpro = $sf_user->getRaykuUser()->getUsername();
      if($usrpro) : ?>
        <div id="tutor_profile_form"> <a href="javascript:tutorprofileedit();">Edit Tutor Profile</a> | <a href="/tutorshelp" target="_blank">Help Guide</a> </div>
        <?php endif; ?>
      </div>
      <!--widget main--> 
      
      <!--widget-foot-->
      
      <div id="error-message">
        <p><span>Sorry!</span> You must be at least a <em>level two tutor</em> in order to charge a tutoring rate.</p>
      </div>
      <!--widget-foot-->
      
      <?php
        $_max = '';
        $_Rate = $raykuUser->getRate();
        
	if($stats['expertCount'] >= 125 && $changeUserType != 1):

		$_max = '50.00';

	else:
		$_max = '0.00';
	endif; ?>
   <script src="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/js/widget/jquery.ui.core.js"></script> 
   <script src="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/js/widget/jquery.ui.widget.js"></script> 
   <script src="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/js/widget/jquery.ui.mouse.js"></script> 
   <script src="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/js/widget/jquery.ui.slider.js"></script> 
   <script type="text/javascript" src="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/js/widget/jquery.qtip-1.0.0-rc3.min.js"></script> 
   <script type="text/javascript">
    var vd = jQuery.noConflict();

    vd('#rank').qtip({
        content: '<span id="rank-heading">Rank in the <b>top #25</b> and<br >you will show up on the<br >1st page of tutor search lists.</span>',
        position: {
            corner: {
                target: 'topRight',
                tooltip: 'topLeft'
            }
        },
        show: 'mouseover',
        hide: 'mouseout',
        style: {
            color: '#CCC',
            background: '#113048',
            border: {
                width: 1,
                radius: 3,
                color: '#1C517B'
            }
        }
    });
    vd("#tutor-rate").slider({
        range: "min",
        value: <?php echo $_Rate; ?> , min: 40,
        max: 200 , step: 1,
        slide: function (event, ui) {
            vd("#amount").val(ui.value);
            vd("#amount_hidden").val(ui.value);
        }
    });
    vd("#amount").val(vd("#tutor-rate").slider("value"));
    vd("#amount_hidden").val(vd("#tutor-rate").slider("value"));

    vd('#tutor-rate').mouseout(function () {
        var rate = document.getElementById("amount_hidden").value;
        vd.ajax({
            cache: false,
            type: "GET",
            url: "http://" + getHostname() + "/dashboard/chargerate?rate=" + rate
        });

    });

    /*vd('#_slider_call').mouseover(function() {

	var rate = <?php //echo $_max; ?>

	if(rate == "0.00") {

	document.getElementById("error-message").style.display = "block";

	}
    });*/


    vd('#tutor-rate').mouseover(function () {
        var rate = document.getElementById("amount_hidden").value;
        vd.ajax({
            cache: false,
            type: "GET",
            url: "/dashboard/chargerate?rate=" + rate
        });

    });
</script>
    </div>
    <!--widget--> 
  </div>
  <div class="widget"> 
    <!--widget-head-->
    <div class="widget-head">
      <h3> Question Notifications </h3>
    </div>
    <!--widget-head--> 
    
    <!--widget main-->
    <div class="widget-main">
      <p>Connect to be notified when a student has a question:</p>
      <ul class="icon-list">
        <li><img src="../images/icon-web.png" title="web" id="icon-web" alt="web" width="74" height="73" /></li>
        <li><a href="/dashboard/gtalk" class="icon gtalk">Google Talk</a></li>
        <!-- <li><a href="/dashboard/facebook" class="icon facebook">Facebook Chat</a></li>  -->
        <li><a href="<?php echo sfConfig::get('app_notification_bot_url'); ?>/download/rayku.exe" class="icon windows">Windows Software</a></li>
        <li><a href="<?php echo sfConfig::get('app_notification_bot_url'); ?>/download/rayku.dmg" class="icon mac">MacOS Software</a></li>
      </ul>
      <div class="clear"></div>
    </div>
    <!--widget main--> 
  </div>
  <!--widget-->
  
  <?php elseif($raykuUser->isTutorStatusDisabled()) : ?>
  <!--widget main-->
  <div class="widget-main" id="tutor-status">
    <p>Your tutor status is turned off. You won't be listed or available to tutor for <a rel="popup%20standard%20600%20435%20noicon" href="/rp.html" title="[Opens in pop-up window]">RP</a>.<br />
    <br />
    <strong>Why become a tutor?</strong><br /><br />
    Why not? If you are great at math and would like to tutor students in the same or lower grades than you, <a href="/joinus">become a Rayku tutor today!</a><br /><br />
    You can earn money during your free time, and help the community out in a big way.</p>
  </div>
</div>
<!--widget-->
</div>
<?php endif; ?>
</div>

<script type="text/javascript" src="<?php echo $baseRootPath; ?>/js/tutor-rate-validation.js"></script>
