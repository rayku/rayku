<link rel="stylesheet" type="text/css" href="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/css/global.css" />
<link rel="stylesheet" type="text/css" href="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/css/widget/jquery.ui.css" />
<link rel="stylesheet" type="text/css" href="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/css/widget/style.css" />
<?php

$connection = RaykuCommon::getDatabaseConnection();
    
/* @var $raykuUser User */
$raykuUser = $sf_user->getRaykuUser();
$stats = $raykuUser->getStatisticsForDashboard();

	usort($rankUsers, "cmp");

	$curr_user_rank=''; $ij =1;


	if(count($rankUsers) > 0) :
         
	foreach($rankUsers as $_expert):

		if($_expert['userid'] == $logedUserId):

			$curr_user_rank = $ij;				 
			break;

		endif;

	$ij++;

	endforeach;
		
	endif;

function cmp($a, $b)
{
    if ($a["score"] == $b["score"]) {
	return strcmp($a["createdat"], $b["createdat"]);
    }
    return ($a["score"] < $b["score"]) ? 1 : -1;
    
}



?>
<div id="body">
      	<?php if($sf_user->getRaykuUser()->getType() != 5 && $changeUserType == 1): ?>

	<div style="padding:10px;border-bottom:2px solid #009900;background:#E4FFE0;font-size:14px;" align="center">Click Here <a href="/dashboard/verifytutor" style="text-decoration:underline;color: #060;">'Get Verified'</a> To Change Verified Tutors</div>


         <?php endif; ?>



<div style="margin-left:16px;padding-top:25px;width:600px;float:left;">
  <img height="25" width="42" src="/images/green_arrow.jpg" style="float:left;"/>
  <div style="font-size:16px;line-height:24px;color:#1C517C;font-weight:bold;margin-left:10px;width:300px;float:left;">Ask a Question</div>
  </div>

  <?php $logedUserId = $_SESSION['symfony/user/sfUser/attributes']['symfony/user/sfUser/attributes']['user_id']; ?>
  <div class="body-left" style="margin-top:30px;">
    <?php include_partial('asknewquestion'); ?>
 
    
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

      <div style="float:left;width:150px;"><h3>Tutor Status:</h3> </div>
	<?php $query = mysql_query("select * from user_tutor where userid =".$logedUserId." ", $connection) or die(mysql_error()); ?>
    
    <div style="float:right;width:60px;">
        <?php if(mysql_num_rows($query) > 0) : ?>
        	 	<span id="on-off"><strong style="color:#060">On</strong> | <a href="/dashboard/tutor" style="color:#333;text-decoration:underline">Off</a></span>
        <?php else: ?>
        		<span id="on-off"><a href="/dashboard/tutor" style="color:#333;text-decoration:underline">On</a> | <strong style="color:#900">Off</strong></span>
        <?php endif; ?>             
        </div>
        <div style="clear:both;"></div>



   </div><!--widget-head-->

        <?php if(mysql_num_rows($query) > 0 && empty($_COOKIE['loginname'])) : ?>

   <!--widget main-->    

   <div id="widget-main">

       <p>Your rank is...</p>

       <!--rank wrap-->

       <div id="rank-wrap">
	
	<?php if($curr_user_rank > 100 && !empty($curr_user_rank)) : $curr_user_rank = '100+'; endif; ?>

          <div id="rank-no">#<?php echo ($curr_user_rank? $curr_user_rank: '-'); ?></div>

	<?php $_dispalyQuote = '';?>

	<?php if($curr_user_rank <= 25) : 

		$_dispalyQuote = 'you are ranked!';

	 else : 

		$_dispalyQuote = 'not in top #25';

	endif;?>

          <div id="rank"><?php echo $_dispalyQuote; ?></div>

          <div class="clear"></div>

       </div><!--rank wrap-->

       <!--Tutor Rate Slider--> 

       <div id="tutor-rate-slider">

	  <p><span class="black">Your Tutoring Rate:</span> <!--(set recommended)-->
	     <div class="amount"><input type="text" id="amount" style="text-align:right" /> RP/min.</div>

	  </p>
	
	 <div id="tutor-rate"></div> 
<input type="hidden" id="amount_hidden" name ="amount_hidden" value=''>

      </div><!--Tutor Rate Slider-->

   </div><!--widget main-->    

   <!--widget-foot-->

   <div id="error-message" style="display:none">

       <p>Sorry! You can't charge a tutoring rate unless you become <em style="font-weight:bold">verified</em>. <a href="http://rayku.com/joinus">Click here to learn how.</a></p>

   </div><!--widget-foot-->

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
	if($stats['expertCount'] >= 72 && $changeUserType != 1): 

		$_max = '0.89';

	else:
		$_max = '0.50';
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

		vd( "#tutor-rate" ).slider({
			range: "min",
			value:<?php echo $_Rate; ?>,
			min: 0.00,
			max: <?php echo $_max; ?>,
			step:0.01,
			slide: function( event, ui ) {
				vd( "#amount" ).val(ui.value); vd( "#amount_hidden" ).val(ui.value);

			}

		});

		vd( "#amount" ).val( vd( "#tutor-rate" ).slider( "value" ) );
		vd( "#amount_hidden" ).val( vd( "#tutor-rate" ).slider( "value" ) );



vd('#tutor-rate').mouseout(function() {

	var rate = document.getElementById("amount_hidden").value;

				vd.ajax({ cache: false,
					type : "GET",
					url: "http://www.rayku.com/dashboard/chargerate?rate="+rate
				});


});



vd('#_slider_call').mouseover(function() {

	var rate = <?php echo $_max; ?>

	if(rate == "0.00") {

	document.getElementById("error-message").style.display = "block";

	}

});



vd('#tutor-rate').mouseover(function() {

	var rate = document.getElementById("amount_hidden").value;

				vd.ajax({ cache: false,
					type : "GET",
					url: "http://www.rayku.com/dashboard/chargerate?rate="+rate
				});


});

		
	</script>
		<?php elseif(mysql_num_rows($query) == 0) : ?>
   <!--widget main-->    
   <div id="widget-main">
       <p>Your tutor status is turned off. You won't be listed or available to tutor for <a rel="popup standard 600 435 noicon" href="http://rayku.com/rp.html" title="[Opens in pop-up window]" style="color:#809EB7">RP</a>.</p>
   </div>
        
        <?php endif; ?>

</div><!--widget-->
</div>


 <div id="widget" style="margin-top:15px;"> 
  <!--widget-head-->
  <div id="widget-head">
    <h3>
      <?php if($stats['expertCount']>= 72 && $changeUserType != 1): ?>
      Account Type:
      	<?php if($sf_user->getRaykuUser()->getType() == 5): ?>
      	<span style="color:#900">Staff</span>
      	<?php else: ?>
      	<span style="color:#060">Level Two Tutors</span>
      	<?php endif; ?>
      
      <?php else: ?>
      Account Type:
      	<?php if($sf_user->getRaykuUser()->getType() == 5): ?>
        <span style="color:#900"> Staff </span>
        <?php else: ?>
        Tutor (<em>Level One</em>)

        <?php endif; ?>
      <?php endif; ?>
    </h3>


  </div>
  <!--widget-head--> 
  
  <!--widget main-->
  <div id="widget-main">
    <p>You currently receive question notifications through:</p>
    <ul class="icon-list">
	<li><img src="../images/icon-web.jpg" title="web" style="display:block;float:left;width:74px;height:73px;margin-right:10px;text-indent:-5000px;" /></li>
	
<?php
    $userGtalk = $raykuUser->getUserGtalk();
    if($userGtalk) {
        $cssClass = 'icon gtalk';
    } else {
        $cssClass = 'icon gtalk-no';
    }
?>
    <li><a href="http://rayku.com/dashboard/gtalk" class="<?php echo $cssClass; ?>">Google Talk</a></li>
    
    
    <?php $query = mysql_query("select * from user_fb where userid =".$logedUserId." ", $connection) or die(mysql_error());
    if(mysql_num_rows($query) > 0) : ?>
	<li><a href="http://rayku.com/dashboard/facebook" class="icon facebook">Facebook Chat</a></li>
    <?php else: ?>
	<li><a href="http://rayku.com/dashboard/facebook" class="icon facebook-no">Facebook Chat</a></li>
    <?php endif; ?>
	</ul>
    
    <div style="clear:both"></div>

  </div>
  <!--widget main--> 
</div>
<!--widget-->


<!--
<div id="myvar4">
  <div class="updates">
    <div class="top"></div>
    <ul>
      <?php



						$query = mysql_query("select * from news_update order by id DESC limit 0,4", $connection) or die(mysql_error());



							while($row = mysql_fetch_array($query)) { ?>
      <li>
        <div class="right" style="width:260px;padding-left:10px;"><span><?php echo $row['title']; ?></span>:<br />
          <?php echo $row['description']; ?> </div>
        <br class="clear-both" />
      </li>
      <?php }	?>
    </ul>
    <div class="bot"></div>
  </div>
</div> -->

<div id="myvar5">
</div>
</div>
<script type="text/javascript">
function validateRate() {

var rate = document.getElementById('rate').value;

var Rate = rate.split('.');

var CheckRate;


if(Rate.length < 2) {

CheckRate = Rate[0]+".00";

}  else {

CheckRate = rate;

}

CheckRate = parseFloat(CheckRate);

	if(CheckRate < '0.00' || CheckRate > '5.00') {

		document.getElementById('rateError').innerHTML = "<font color='red'>Rate Should Be <strong>0.00</strong> to <strong>5.00</strong></font><br>";
		
		return false;


	}

return true;

}
</script>
