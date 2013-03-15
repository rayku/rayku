<?php $baseRootPath = sfContext::getInstance()->getRequest()->getRelativeUrlRoot();?>
<div id="tutor_profile"></div>
<!-- Tutor Profile Form -->
<div id="preload">
	<img src="/images/tutorshelp/icon-gtalk-hover.jpg" alt="gtalk"
		width="74" height="73" />
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
	<div id="page-title">
		<img height="25" width="42"
			src="<?php echo image_path('green_arrow.png', false); ?>" />
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
					<h3 id="tutor-level">Tutor:</h3>
					<div id="tutor-status-head">
						<?php if($raykuUser->isTutorStatusEnabled()) { ?>
						<span id="on-off"><span class="is-on">On</span> | <a
							href="/dashboard/tutor" class="deactivated">Off</a> </span>
						<?php } else { ?>
						<span id="on-off"><a href="javascript:tutorprofile();"
							class="deactivated">On</a> | <span class="is-off">Off</span> </span>
						<?php } ?>
					</div>
					<div class="clear"></div>
				</div>
				<!--widget-head-->

				<?php if($raykuUser->isTutorStatusEnabled()) : ?>

				<!--widget main-->

				<div class="widget-main">

					<!--Tutor Rate Slider-->

					<div id="tutor-rate-slider">
						<p>
							<span class="black">Your Tutoring Rate:</span>
							<!--(set recommended)-->
						
						
						<div class="amount">
							<input type="text" id="amount" /> RP/min.
						</div>
						</p>
						<div id="tutor-rate"></div>
						<input type="hidden" id="amount_hidden" name="amount_hidden"
							value=''>
					</div>
					<!--Tutor Rate Slider-->
					<?php
					$usrpro = $sf_user->getRaykuUser()->getUsername();
      if($usrpro) : ?>
					<div id="tutor_profile_form">
						<a href="javascript:tutorprofileedit();">Edit Tutor Profile</a> |
						<a href="/tutorshelp" target="_blank">Help Guide</a>
					</div>
					<?php endif; ?>
				</div>
				<!--widget main-->

				<!--widget-foot-->

				<div id="error-message">
					<p>
						<span>Sorry!</span> You must be at least a <em>level two tutor</em>
						in order to charge a tutoring rate.
					</p>
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
				<script
					src="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/js/widget/jquery.ui.core.js"></script>
				<script
					src="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/js/widget/jquery.ui.widget.js"></script>
				<script
					src="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/js/widget/jquery.ui.mouse.js"></script>
				<script
					src="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/js/widget/jquery.ui.slider.js"></script>
				<script type="text/javascript"
					src="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/js/widget/jquery.qtip-1.0.0-rc3.min.js"></script>
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
        value: <?php echo $_Rate; ?> , min: 0,
        max: 
<?php 
if(strpos($raykuUser->getEmail(), 'ryerson') === false){ echo '100'; }else{ echo '45'; }
?>
            , step: 1,
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
				<h3>Question Notifications</h3>
			</div>
			<!--widget-head-->

			<!--widget main-->
			<div class="widget-main">
				<p>Connect to be notified when a student has a question:</p>
				<ul class="icon-list">
					<li><img src="../images/icon-web.png" title="web" id="icon-web"
						alt="web" width="74" height="73" /></li>
					<li><a href="/dashboard/gtalk" class="icon gtalk">Google Talk</a></li>
				</ul>
				<div class="clear"></div>
			</div>
			<!--widget main-->
		</div>
		<!--widget-->

		<?php elseif($raykuUser->isTutorStatusDisabled()) : ?>
		<!--widget main-->
		<div class="widget-main" id="tutor-status">
			<p>
				Your tutor status is turned off. You won't be listed or available to
				tutor for <a rel="popup%20standard%20600%20435%20noicon"
					href="/rp.html" title="[Opens in pop-up window]">RP</a>.<br /> <br />
				<strong>Why become a tutor?</strong><br /> <br /> Why not? If you
				are great at math and would like to tutor students in the same or
				lower grades than you, <a href="/joinus">become a Rayku tutor today!</a><br />
				<br /> You can earn money during your free time, and help the
				community out in a big way.
			</p>
		</div>
	</div>
	<!--widget-->
</div>
<?php endif; ?>
</div>

<script
	type="text/javascript"
	src="<?php echo $baseRootPath; ?>/js/tutor-rate-validation.js"></script>
