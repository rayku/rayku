<link rel="stylesheet" type="text/css" href="/css/global.css" />
<link rel="stylesheet" type="text/css" href="/css/widget/jquery.ui.css" />
<link rel="stylesheet" type="text/css" href="/css/widget/style.css" />
<link rel="stylesheet" type="text/css" href="/css/tutor_profile/tprofile-style.css" />
<!-- Tutor Profile Form -->
<div id="tutor_profile" style="position:absolute;z-index:999999;margin-left:350px;"></div>
<?php
$connection = RaykuCommon::getDatabaseConnection();
$raykuUser = $sf_user->getRaykuUser();
$stats = $raykuUser->getStatisticsForDashboard();
usort($rankUsers, "cmp");
$curr_user_rank = '';
$ij = 1;

if (count($rankUsers) > 0):
	foreach($rankUsers as $_expert):
		if ($_expert['userid'] == $logedUserId):
			$curr_user_rank = $ij;
			break;
		endif;
		$ij++;
	endforeach;
endif;

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
  <div style="padding:10px;border-bottom:2px solid #009900;background:#E4FFE0;font-size:14px;" align="center">You qualify for an upgrade! <a href="/dashboard/verifytutor" style="text-decoration:underline;color: #060;">Click to upgrade to tutor level two</a></div>
  <?php endif; ?>
  <!--[if IE]>
<div style="width:100%;padding:8px 0;background:#FFCCCC;border-bottom:2px solid #BF3535;font-size:14px;color:#666" align="center">
Rayku doesn't work well with Internet Explorer. Please use Firefox or Chrome or another browser.
</div>
<![endif]-->
  
  <div style="margin-left:16px;padding-top:25px;width:600px;float:left;"> <img height="25" width="42" src="/images/green_arrow.jpg" style="float:left;"/>
    <div style="font-size:16px;line-height:24px;color:#1C517C;font-weight:bold;margin-left:10px;width:300px;float:left;">Ask a Question</div>
  </div>
  <?php $logedUserId = $_SESSION['symfony/user/sfUser/attributes']['symfony/user/sfUser/attributes']['user_id']; ?>
  <div class="body-left" style="margin-top:15px;">
    <?php include_partial('askquestion'); ?>
    <div>
      <?php include_partial('recent'); ?>
    </div>
  </div>
</div>
<div class="body-right" style="margin-top:10px;">
  <div id="myvar_activate"> 
    <!--widget-->
    
    <div id="widget"> 
      
      <!--widget-head-->
      
      <div id="widget-head">
        <?php $query = mysql_query("select * from user_tutor where userid =".$logedUserId." ", $connection) or die(mysql_error()); ?>
        <div style="float:left;width:150px;">
          <h3>
            <?php if(mysql_num_rows($query) > 0) : ?>
            <?php if($stats['expertCount'] >= 125 && $stats['expertCount'] <= 500 && $changeUserType != 1){ ?>
            <?php if($sf_user->getRaykuUser()->getType() == 5): ?>
            <span style="color:#900">Staff (Level 9001)</span>
            <?php else: ?>
            Tutor (level 2)
            <?php endif; ?>
            <?php } elseif($stats['expertCount'] <= 125) { ?>
            <?php if($sf_user->getRaykuUser()->getType() == 5): ?>
            <span style="color:#900">Staff (Level 9001)</span>
            <?php else: ?>
            Tutor (level 1)
            <?php endif; ?>
            <?php }  elseif($stats['expertCount'] > 500) { ?>
            <?php if($sf_user->getRaykuUser()->getType() == 5): ?>
            <span style="color:#900">Staff (Level 9001)</span>
            <?php else: ?>
            Tutor (level 3)
            <?php endif; ?>
            <?php } ?>
            <?php else: ?>
            Tutor Status:
            <?php endif; ?>
          </h3>
        </div>
        <div style="float:right;width:60px;">
          <?php if(mysql_num_rows($query) > 0) : ?>
          <span id="on-off"><strong style="color:#060">On</strong> | <a href="/dashboard/tutor" style="color:#333;text-decoration:underline">Off</a></span>
          <?php else: ?>
          <span id="on-off"><a href="javascript:tutorprofile();" style="color:#333;text-decoration:underline">On</a> | <strong style="color:#900">Off</strong></span>
          <?php endif; ?>
        </div>
        <div style="clear:both;"></div>
      </div>
      <!--widget-head-->
      
      <?php


		if(mysql_num_rows($query) > 0 && empty($_COOKIE['loginname'])) : ?>
      
      <!--widget main-->
      
      <div id="widget-main"> 
        
        <!--progress wrap-->
        <?php
		$percentage = '';
		//echo $logedUserId."---**".$stats['expertCount'];
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
		}

		?>
        <div id="progress-wrap">
          <div style="width:200px;float:left">
            <div class="ui-progress-bar ui-container" id="progress_bar">
              <div class="ui-progress" style="width:<?=$percentage?>%;"> <span class="ui-label">
                <?php if($stats['expertCount'] <= 25) {	} else { ?>
                <b class="value">
                <?=$percentage?>
                %</b>
                <?php } ?>
                </span> </div>
            </div>
          </div>
          <div class="goal">
            <?php if($stats['expertCount'] >= 125 && $stats['expertCount'] <= 500 && $changeUserType != 1){ ?>
            Level 3
            <?php } elseif( ($stats['expertCount'] < 125)) { ?>
            Level 2
            <?php } elseif( ($stats['expertCount'] > 500) ) { echo "Level 4"; }?>
          </div>
          <div class="clear"></div>
          Become a level 2 tutor and be able to charge up to 0.50RP/minute for sessions. You also rank higher on our tutor lists! </div>
        <!--progress wrap--> 
        
        <!--Tutor Rate Slider-->
        
        <div id="tutor-rate-slider">
          <p><span class="black">Your Tutoring Rate:</span> <!--(set recommended)-->
          <div class="amount">
            <input type="text" id="amount" style="text-align:right" />
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
      
      <div id="error-message" style="display:none">
        <p><span style="color:#900;font-weight:bold">Sorry!</span> You must be at least a <em>level two tutor</em> in order to charge a tutoring rate.</p>
      </div>
      <!--widget-foot-->
      
      <?php
		$query = mysql_query("select * from user_rate where userid=".$logedUserId." ", $connection) or die(mysql_error());
		$rate = mysql_fetch_assoc($query);
		$_Rate = ''; $_max = '';
		if(mysql_num_rows($query) == 0) :
			$_Rate = '0.00';
		else :
			$_Rate = $rate['rate'];
		endif; ?>
      <?php
	if($stats['expertCount'] >= 125 && $changeUserType != 1):

		$_max = '0.50';

	else:
		$_max = '0.00';
	endif; ?>
   <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script> 
   <script src="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/js/widget/jquery.ui.core.js"></script> 
   <script src="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/js/widget/jquery.ui.widget.js"></script> 
   <script src="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/js/widget/jquery.ui.mouse.js"></script> 
   <script src="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/js/widget/jquery.ui.slider.js"></script> 
   <script type="text/javascript" src="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/js/widget/jquery.qtip-1.0.0-rc3.min.js"></script> 
   <script type="text/javascript">
    var vd = jQuery.noConflict();

    vd('#rank').qtip({
        content: '<span style="line-height:16px;">Rank in the <strong>top #25</strong> and<br >you will show up on the<br >1st page of tutor search lists.</span>',
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
        value: <?php echo $_Rate; ?> , min: 0.00,
        max: <?php echo $_max; ?> , step: 0.01,
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

    vd('#_slider_call').mouseover(function() {

	var rate = <?php echo $_max; ?>

	if(rate == "0.00") {

	document.getElementById("error-message").style.display = "block";

	}

});

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
  <div id="widget" style="margin-top:15px;"> 
    <!--widget-head-->
    <div id="widget-head">
      <h3> Question Notifications </h3>
    </div>
    <!--widget-head--> 
    
    <!--widget main-->
    <div id="widget-main">
      <p>Connect with as many notification channels as you can:</p>
      <ul class="icon-list">
        <li><img src="../images/icon-web.jpg" title="web" style="display:block;float:left;width:74px;height:73px;margin-right:12px;text-indent:-5000px;" /></li>
        <li><a href="/dashboard/gtalk" class="icon gtalk">Google Talk</a></li>
        <li><a href="/dashboard/facebook" class="icon facebook">Facebook Chat</a></li>
        <li><a href="http://notification-bot.rayku.com/download/rayku.exe" class="icon windows">Windows Software</a></li>
        <li><a href="http://notification-bot.rayku.com/download/rayku.dmg" class="icon mac">MacOS Software</a></li>
      </ul>
      <div style="clear:both"></div>
    </div>
    <!--widget main--> 
  </div>
  <!--widget-->
  
  <?php elseif(mysql_num_rows($query) == 0) : ?>
  <!--widget main-->
  <div id="widget-main">
    <p>Your tutor status is turned off. You won't be listed or available to tutor for <a rel="popup standard 600 435 noicon" href="/rp.html" title="[Opens in pop-up window]" style="color:#809EB7">RP</a>.</p>
  </div>
</div>
<!--widget-->
</div>
<?php endif; ?>
</div>

<script type="text/javascript">
    var tp = jQuery.noConflict();

    function tutorprofile() {
        tp('#tutor_profile').load('http://' + getHostname() + '/dashboard/tutor', '', function (response) {
            tp("#profile_content").html(response);

        });
    }

    function tutorprofileedit() {
        tp('#tutor_profile').load('http://' + getHostname() + '/dashboard/tutorprofile', '', function (response) {
            tp("#profile_edit_content").html(response);
        });
    }

    function validateRate() {
        var rate = document.getElementById('rate').value;
        var Rate = rate.split('.');
        var CheckRate;

        if (Rate.length < 2) {
            CheckRate = Rate[0] + ".00";
        } else {
            CheckRate = rate;
        }
        CheckRate = parseFloat(CheckRate);
        if (CheckRate < '0.00' || CheckRate > '5.00') {
            document.getElementById('rateError').innerHTML = "<font color='red'>Rate Should Be <strong>0.00</strong> to <strong>5.00</strong></font><br>";
            return false;

        }
        return true;
    }
</script>