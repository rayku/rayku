<link rel="stylesheet" type="text/css" href="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/styles/classroom.css" />
<link rel="stylesheet" type="text/css" href="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/css/global.css" />
<link rel="stylesheet" type="text/css" href="/css/custom/button.css"/>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"></script>
<script language="javascript">
$(function() {
// OPACITY OF BUTTON SET TO 25%
$(".body-connect-left").css("opacity","0.25");

// ON MOUSE OVER
$(".body-connect-left").hover(function () {

// SET OPACITY TO 100%
$(this).stop().animate({
opacity: 1.0
}, "slow");
},

// ON MOUSE OUT
function () {

// SET OPACITY BACK TO 25%
$(this).stop().animate({
opacity: 0.25
}, "slow");
});
});
</script>
<div class="body" >
  <?php $sfuser=$sf_user->getRaykuUser()->getID();?>
  <div id="cn-body">
    <div class="body-connect-left">
      <div class="cn-left-bg" style="margin-top: 25px;">
        <div class="cn-left-top"></div>
        <h3 style="margin-bottom:8px;">Subject:</h3>
        <?php $categories = CategoryPeer::doSelect(new Criteria()); ?>

<?php $limitSubject = array('0' => '1', '1' => '5'); ?>

        <label>
        <form name="form1" id="form1" method="post">
          <select name="category" onchange="this.form.submit();">
            <option value="">--- SELECT ---</option>
            <?php foreach( $categories as $category): ?>

		<?php if(in_array($category->getId(), $limitSubject)): ?>

			    <option value="<?=$category->getId();?>" <?php if($cat == $category->getId()): ?> selected="selected" <?php endif; ?> >
			    <?=$category->getName();?>
			    </option>
		<?php endif; ?>

            <?php endforeach; ?>
          </select>
        </form>
        </label>
        <div class="cn-spacer"></div>
        <h3>Filtering Options:</h3>

        <h4>Expert Status: <img src="../images/greyarrow-down.jpg" width="10" height="11" alt="" /></h4>
        <p><a href="" onClick="return setStatus(1)">Online</a></p>
        <p><a href="" onClick="return setStatus(2)">Offline</a></p>
        <script language="javascript">
	function setStatus(value)
	{
		 var onoff;
		 document.cookie = "onoff"+ "=" +value;

	}

</script>
        <h4>School: <img src="../images/greyarrow-down.jpg" width="10" height="11" alt="" /></h4>
        <select name="school" onchange="return setSchool(this.value)" style="background:none;padding:4px;height:auto;border:1px solid #CCC">
          <option value="">---- SELECT ----</option>
          <option value="utoronto" <?php if($_COOKIE["school"] == "utoronto"): ?> selected="selected" <?php endif; ?> >University of Toronto</option>
          <option value="ubc" <?php if($_COOKIE["school"] == "ubc"): ?> selected="selected" <?php endif; ?> >University of British Columbia</option>
        </select>
        <script language="javascript">

function setSchool(value)
{

var school;
document.cookie = "school"+ "=" +value;
window.location.reload();
}

</script>
        <!--<h4>Price: <span id="currentPrice"></span></h4>
                            <div id="sliderContainer" style="width: 170px; height: 16px; margin: 0 auto; color: #1e1e1e; padding-bottom: 15px; background-image: url(images/slider/sliderBg.jpg); background-repeat: no-repeat; background-position: top center;">
                            	<img src="images/slider/sliderCarot.jpg" style="position: relative;" onMouseDown="return true;" id="sliderCarot" alt="" height="16" width="8"><br />
                                <span class="cn-price-left">$0.25/min</span>     <span class="cn-price-right">$2.00/min</span> <div class="clear-both"></div>
                            </div>-->

        <script lang="text/javascript">
								var count_checkboxclicks=0;
							    var expertcount=0;  var expertIds=new Array();

								var origMouseX = 0;
								var currentSliderValue = 0;
								var maxSliderValue = 168;
								var minSliderValue = 0;
								function setvalue(a)
								{



									if(expertcount == 4) {

									if (document.getElementById(a).checked == true)
										{

										document.getElementById(a).checked = false;


										alert("You are Limited To Select Four Expers At Once");

										return false;

										}


									}

									if (document.getElementById(a).checked == true)
									{

									var newId = a.split('[');

									var lastOne = newId[1].split(']');


									document.getElementById("first"+lastOne[0]).style.backgroundColor = '#DEF3FE';

										expertcount=expertcount+1;

									}

							        	if (document.getElementById(a).checked == false)
									{

									var newId = a.split('[');

									var lastOne = newId[1].split(']');


									document.getElementById("first"+lastOne[0]).style.backgroundColor = '';

										expertcount=expertcount-1;


									}



								}

								function entirerow(a)
								{

									var newvalue = a.split('.');


									b = "checkbox["+newvalue[0]+"]";





							        	if (document.getElementById(b).checked == true)
									{

									document.getElementById("first"+newvalue[0]).style.backgroundColor = '';

									document.getElementById(b).checked = "";

										expertcount=expertcount-1;

									} else if (document.getElementById(b).checked == false)
									{

									document.getElementById("first"+newvalue[0]).style.backgroundColor = '#DEF3FE';

									document.getElementById(b).checked = "checked";

										expertcount=expertcount+1;

									}


									if(expertcount == 5) {

										if (document.getElementById(b).checked == true)
										{

											document.getElementById(b).checked = false;
											document.getElementById("first"+a).style.backgroundColor = '';

											expertcount=expertcount-1;

											alert("You are limited to select four expers at once");

											return false;

										}


									}



								}


								function checkExpertCheckBoxes()
								{

									var online_user = document.getElementById("online_user").value;


									if(expertcount > 1)
									{
										return true;

									} else if(expertcount == 1 && online_user == 1) {

										return true;

									}

									if(expertcount == 1)
									{

						var result = confirm("It's recommended to select 2 to 4 experts for best results! Please click 'cancel' to do so, or 'ok' to continue anyways.");
										if (result == true)
										  {
										  	return true;
										  }
										else
										  {
										 	 return false;
										  }


									}

									if(expertcount == 0) {

										alert("Please select at least one expert for connect");
										return false;

									}
								}

								</script>
        <br/><br />
        <p><a href="" onClick="return reSet(0)" style="color:darkred">Reset All Filter Settings</a></p>
        <script language="javascript" >
function setScore(value)
{
		var ss;

		document.cookie = "ss"+ "=" +value;

		window.location.reload();


}
function reSet(value)
{
	     var onoff;
		 var ss;
		 var school;
		 document.cookie = "onoff"+ "=" +value;
	     document.cookie = "ss"+ "=" +value;
	     document.cookie = "school"+ "=" +value;

}
</script>
      </div>
      <div class="cn-left-bottom"></div>
    </div>
    <div class="body-connect-right" style="margin-top: 25px;">
      <div style="height:50px;margin-bottom:10px">
      <form name='listform' id='listform' method='post' action="">
      <div style="float:left;width:700px;font-size:21px;color:#333;line-height:30px"><strong>Choose</strong> up to 4 online tutors below. Then click <strong><a href="javascript: document.listform.submit()" onclick="return checkExpertCheckBoxes();" type="submit" id="submit_connect">here</a></strong> to connect.</div>
        <input type="hidden" name="hidden" value="hidden" />
          </div>
        <div class="cn-content">
        <div class="cn-right-top">
          <div class="cn-column-one" style="width:50px">Ranking</div>
          <div class="cn-column-one" style="width:450px">Rayku Experts</div>
          <div class="cn-column-two" align="center">Rate /min.</div>
          <div class="cn-column-four" align="center">Connect</div>
          <div class="clear-both"></div>
        </div>
<?php

		$connection = RaykuCommon::getDatabaseConnection();

	$c = new Criteria();

	$rankexperts = ExpertCategoryPeer::doSelect($c);

	$rankUsers = array(); $ji =0; $newUserLimit = array();  $rankScore = array();

		 foreach($rankexperts as $exp):


					if(!in_array($exp->getUserId(), $newUserLimit)) :

					$newUserLimit[] = $exp->getUserId();

						 $_query = mysql_query("select * from user_tutor where userid =".$exp->getUserId()." ", $connection) or die(mysql_error());
						 if(mysql_num_rows($_query) > 0) :

							$query = mysql_query("select * from user_score where user_id=".$exp->getUserId(), $connection) or die(mysql_error());
							$score = mysql_fetch_assoc($query);

							if($score['score'] != 0):

								$dv=new Criteria();
								$dv->add(UserPeer::ID,$exp->getUserId());
								$_thisUser = UserPeer::doSelectOne($dv);
								$rankUsers[$ji] = array("score" => $score['score'], "userid" => $exp->getUserId(), "createdat" => $_thisUser->getCreatedAt());

								$ji++;

							endif;

      						 endif;

					endif;
		 endforeach;



					asort($rankUsers);

					arsort($rankUsers);

usort($rankUsers, "cmp");



function cmp($a, $b)
{
    if ($a["score"] == $b["score"]) {
	return strcmp($a["createdat"], $b["createdat"]);
    }
    return ($a["score"] < $b["score"]) ? 1 : -1;

}
?>
        <?php if($cat != NULL): ?>
        <?php if(count($expert_cats) >= 1 ):

  			$_SESSION['temp1'] = array();

		$newUser= array(); $i =0;
		$newOnlineUser= array(); $j =0;
		$newOfflineUser= array(); $k =0;

		usort($expert_cats, "cmp");


		foreach($expert_cats as $new):

			$newUser[$i] = array("score" => $new['score'], "userid" => $new['userid'], "category" => $new['category']);

			$i++;

		endforeach;



		$xy = 1;

		 $_count_online_user = 0;


	$_count_check = count($newUser);


	$_v = 1;


				 foreach($newUser as $newOne):


						$sfcategory = $newOne['category'];
						$c=new Criteria();
						$c->add(UserPeer::ID,$newOne['userid']);
						$experts=UserPeer::doSelectOne($c);

                        if($sfcategory == 5) {

                            $query1 = mysql_query("select * from user_course where user_id=".$newOne['userid']." ", $connection) or die(mysql_error());

                            $query3 = mysql_query("select * from user_course where user_id=".$newOne['userid']." ", $connection) or die(mysql_error());
                            $detail3=mysql_fetch_assoc($query3);

                            $query2 = mysql_query("select * from user_course where user_id=".$newOne['userid']." ", $connection) or die(mysql_error());
                            $detail2=mysql_fetch_assoc($query2);


                            $query4 = mysql_query("select * from user_course where user_id=".$newOne['userid']."  ", $connection) or die(mysql_error());
                            $allsub= "General"." Student (Year: ".$detail3['course_year'].")";

                        } else {

                            $query1 = mysql_query("select * from user_course where user_id=".$newOne['userid']." AND course_subject=".$sfcategory, $connection) or die(mysql_error());

                            $query3 = mysql_query("select * from user_course where user_id=".$newOne['userid']." AND course_subject=".$sfcategory, $connection) or die(mysql_error());
                            $detail3=mysql_fetch_assoc($query3);

                            $query2 = mysql_query("select * from user_course where user_id=".$newOne['userid']." AND course_subject=".$sfcategory, $connection) or die(mysql_error());
                            $detail2=mysql_fetch_assoc($query2);




                            $query4 = mysql_query("select * from user_course where user_id=".$newOne['userid']." AND course_subject=".$sfcategory, $connection) or die(mysql_error());

                            $allsub=" ";
                            while ($row = mysql_fetch_array($query4, MYSQL_NUM))
                            {


                                if($allsub==" ")
                                {
                                    $allsub=$row[3];
                                }
                                else
                                {
                                    $allsub=$allsub." | ".$row[3];
                                }
                            }

                            $allsub=$allsub." Student (Year: ".$detail3['course_year'].")";

                        }

						$query5 = mysql_query("select * from user_rate where userid=".$newOne['userid']." ", $connection) or die(mysql_error());
						if(mysql_num_rows($query5) > 0) {

						$rowValues = mysql_fetch_assoc($query5);

							$rate=$rowValues['rate']."RP";

						} else {

							$rate="0.16RP";

						}

						$usercoursedetail=$detail3['course_name']." Student (Year: ".$detail3['course_year'].")";
						//$usercoursedetail=$experts->getName().$score1;




$onlinecheck = '';

	$gtalkquery = mysql_query("select * from user_gtalk where userid=".$experts->getId(), $connection) or die(mysql_error());

	if(mysql_num_rows($gtalkquery) > 0) {
		$status = mysql_fetch_assoc($gtalkquery);
		$gtalkmail = $status['gtalkid'];
		$onlinecheck = file_get_contents('http://'.RaykuCommon::getCurrentHttpDomain().':8892/status/'.$gtalkmail);
	} else {
		 $onlinecheck = '';
	}

	 if(empty($onlinecheck) || ($onlinecheck != "online")) {
		$fb_query = mysql_query("select * from user_fb where userid=".$experts->getId(), $connection) or die(mysql_error());
		if(mysql_num_rows($fb_query) > 0) {
			$fbRow = mysql_fetch_assoc($fb_query);
			$fb_username = $fbRow['fb_username'];
			$details = file_get_contents("http://facebook.rayku.com/tutor");
			$Users = json_decode($details, true);
			foreach($Users as $key => $user) :
				if($user['username'] == $fb_username):
					 $onlinecheck = "online";
					 break;
				endif;
			endforeach;
		}
	}

	 if(empty($onlinecheck) || ($onlinecheck != "online")) {

		$onlineUsers = file_get_contents("http://notification-bot.rayku.com/tutor");

		$_Users = json_decode($onlineUsers, true);

		foreach($_Users as $key => $_user) :

			if($_user['email'] == $experts->getEmail()):

				 $onlinecheck = 'online';
				 break;
			endif;

		endforeach;

	}


	$curr_user_rank=''; $ij =1;


	foreach($rankUsers as $_expert):

		if($_expert['userid'] == $experts->getId()):

			$curr_user_rank=$ij;
			break;

		endif;

	$ij++;

	endforeach;



if(strlen($allsub) > 100) :

 $allsub = substr($allsub,0,100);

 $allsub =  $allsub." ...";
endif;


?>

<?php

 if(!empty($_COOKIE["ss"]) && $_COOKIE["ss"] <= $newOne['score']) {

$k = 1; ?>

<div class="cn-result"  id="<?php echo 'first'.$xy; ?>">
          <div  id="<?php echo $xy.'.1'; ?>" class="cn-column-one"  onclick="entirerow(this.id)" style="padding-right:15px;width:500px;">
            <p id="<?php echo $xy.'.2'; ?>"  class="cn-title"  onclick="entirerow(this.id)">
            <div id="<?php echo $xy.'.3'; ?>"  class="cn-user-info" onclick="entirerow(this.id)" style="float:right;width:150px;line-height:14px" align="right">

              <?php if($onlinecheck == "online" || $experts->isOnline()) : ?>
              <?php if($experts->getType() == 5): ?>

	<?php if($curr_user_rank <= 10): ?>
              <img src="/images/portfolio/certified-online.png" width='20' height='20' alt="Certified" id="certified" title="Certified Tutor" />
         <?php endif; ?>

 <img src="/images/expert_saved.png" alt="Rayku Staff" />
              <?php endif; ?>
              <a href="/tutor/<?php echo $experts->getUsername()?>" target="_blank" style="color:#8FAFC8"><?php echo $experts->getName()?> <span class="onlinenow">(online)</span></a>
              <?php else: ?>
              <?php if($experts->getType() == 5): ?>

	<?php if($curr_user_rank <= 10): ?>
              <img src="/images/portfolio/certified-online.png" width='20' height='20' alt="Certified" id="certified" title="Certified Tutor"/>
         <?php endif; ?>

              <img src="/images/expert_saved.png" alt="Rayku Staff" />
              <?php endif; ?>
              <a href="/tutor/<?php echo $experts->getUsername()?>" target="_blank" style="color:#8FAFC8"><?php echo $experts->getName()?> <span class="offlinenow">(offline)</span></a>
              <?php endif; ?>
            </div>


			<?php if(($experts->getType() == 5) && ($curr_user_rank > 10)): ?>

		 		<div style="float:left;height:50px;line-height:20px;width:50px;border-right:1px solid #CFD0D2;"><img src="/images/portfolio/certified-online.png" alt="Certified" id="certified" title="Certified Tutor"/></div>

			<?php elseif($curr_user_rank <= 10): ?>

					<div style='float:left;height:50px;line-height:20px;width:50px;border-right:1px solid #CFD0D2;'><strong>#<?php echo $curr_user_rank; ?></strong></div>

			<?php endif; ?>


            <?php if($onlinecheck == "online" || $experts->isOnline()) : ?>

            <div style="padding-left:60px;"> <u><a href="#" title="Click to Select"><?php echo $allsub;?></a></u></div>

            <?php else: ?>
           <div>  <?php echo $allsub;?></div>
            <?php endif; ?>

            </p>
          </div>

          <div id="<?php echo $xy.'.4'; ?>"  class="cn-column-two" align="center">
				            	<p class="cn-expertscore" style="font-size:13px;color:#333">
										<?php echo $rate; ?></p>
				       </div>

          <div class="cn-column-four">
            <p class="cn-pricepermin" align="center" style="margin-top:10px">
	     <?php

		$query = mysql_query("select * from popup_close where user_id=".$newOne['userid'], $connection) or die(mysql_error());

		if(mysql_num_rows($query) > 0) {

			$newFlag = 1;

		} else {

			$newFlag = 2;
		} ?>
              <?php if($onlinecheck == "online" || $experts->isOnline()) : ?>
              <?php if($newFlag != 1) : ?>

			<?php $_count_online_user += 1; ?>
              <input type="checkbox" name="checkbox[]" id="checkbox[<?php echo $xy?>]" value="<?php echo $newOne['userid']?>" onclick="setvalue(this.id)" />
              <?php else: ?>
              <a href="../../message/compose/<?php echo $experts->getUsername(); ?>"><img height="18" width="59" alt="" src="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/images/em-email.jpg"></a>
              <?php endif; ?>
              <?php else: ?>
              <a href="../../message/compose/<?php echo $experts->getUsername(); ?>"><img height="18" width="59" alt="" src="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/images/em-email.jpg"></a>
              <?php endif; ?>
            </p>
          </div>
          <div> </div>
          <div class="clear-both"></div>
        </div>
        <?php

							 $_SESSION['temp1'][$newOne['userid']]=1;

	} else if(!empty($_COOKIE['ss'])) {

			///	//style="background-color:#DEF3FE;"

    } else {
?>



<div class="cn-result"  id="<?php echo 'first'.$xy; ?>">
          <div  id="<?php echo $xy.'.1'; ?>" class="cn-column-one"  onclick="entirerow(this.id)" style="padding-right:15px;width:500px;">
            <p id="<?php echo $xy.'.2'; ?>"  class="cn-title"  onclick="entirerow(this.id)">
            <div id="<?php echo $xy.'.3'; ?>"  class="cn-user-info" onclick="entirerow(this.id)" style="float:right;width:150px;line-height:14px" align="right"><strong style="color:#069"></strong>

              <?php if($onlinecheck == "online" || $experts->isOnline()) : ?>
              <?php if($experts->getType() == 5): ?>

	<?php if($curr_user_rank <= 10): ?>
    <img src="/images/portfolio/certified-online.png" width='20' height='20' alt="Certified" id="certified" title="Certified Tutor" />
         <?php endif; ?>

 <img src="/images/expert_saved.png" alt="Rayku Staff" />
              <?php endif; ?>
              <a href="/tutor/<?php echo $experts->getUsername()?>" target="_blank" style="color:#8FAFC8"><?php echo $experts->getName()?> <span class="onlinenow">(online)</span></a>
              <?php else: ?>
              <?php if($experts->getType() == 5): ?>

	<?php if($curr_user_rank <= 10): ?>
              <img src="/images/portfolio/certified-online.png" width='20' height='20' alt="Certified" id="certified" title="Certified Tutor" />
         <?php endif; ?>

              <img src="/images/expert_saved.png" alt="Rayku Staff" />
              <?php endif; ?>
              <a href="/tutor/<?php echo $experts->getUsername()?>" target="_blank" style="color:#8FAFC8"><?php echo $experts->getName()?> <span class="offlinenow">(offline)</span></a>
              <?php endif; ?>
            </div>


			<?php if(($experts->getType() == 5) && ($curr_user_rank > 10)): ?>

		 		<div style="float:left;height:50px;line-height:20px;width:50px;border-right:1px solid #CFD0D2;"><img src="/images/portfolio/certified-online.png" alt="Certified" id="certified" title="Certified Tutor" /></div>

			<?php elseif($curr_user_rank <= 10): ?>

					<div style='float:left;height:50px;line-height:20px;width:50px;border-right:1px solid #CFD0D2;' align="center"><strong>#<?php echo $curr_user_rank; ?></strong></div>

			<?php endif; ?>

            <?php if($onlinecheck == "online" || $experts->isOnline()) : ?>

            <div style="padding-left:60px;"> <u><a href="#" title="Click to Select"><?php echo $allsub;?></a></u></div>
            <?php else: ?>
           <div>  <?php echo $allsub;?></div>
            <?php endif; ?>

            </p>
          </div>

          <div id="<?php echo $xy.'.4'; ?>"  class="cn-column-two" align="center">
				            	<p class="cn-expertscore" style="font-size:13px;color:#333">
										<?php echo $rate; ?></p>
				       </div>

          <div class="cn-column-four">
            <p class="cn-pricepermin" align="center" style="margin-top:10px">
	     <?php

		$query = mysql_query("select * from popup_close where user_id=".$newOne['userid'], $connection) or die(mysql_error());

		if(mysql_num_rows($query) > 0) {

			$newFlag = 1;

		} else {

			$newFlag = 2;
		} ?>
              <?php if($onlinecheck == "online" || $experts->isOnline()) : ?>
              <?php if($newFlag != 1) : ?>

			<?php $_count_online_user += 1; ?>
              <input type="checkbox" name="checkbox[]" id="checkbox[<?php echo $xy?>]" value="<?php echo $newOne['userid']?>" onclick="setvalue(this.id)" />
              <?php else: ?>
              <a href="../../message/compose/<?php echo $experts->getUsername(); ?>"><img height="18" width="59" alt="" src="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/images/em-email.jpg"></a>
              <?php endif; ?>
              <?php else: ?>
              <a href="../../message/compose/<?php echo $experts->getUsername(); ?>"><img height="18" width="59" alt="" src="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/images/em-email.jpg"></a>
              <?php endif; ?>
            </p>
          </div>
          <div> </div>
          <div class="clear-both"></div>
        </div>


        <?php



							 $_SESSION['temp1'][$newOne['userid']]=1;

	}



					if($_count_check == $_v) :

						echo "<input type='hidden' name='online_user' id='online_user' value='".$_count_online_user."' >";
					endif;

			$xy++; 		$_v++;


		endforeach; ?>
      </form>
      <?php if(!empty($_COOKIE["ss"]) && $k != 1) {

				?>
      <p class="cn-pricepermin" align="center" style="margin-top:10px"> No Experts found for this category with the criteria of Expert Score Level.... </p>
      <?php
						} ?>
      <?php else: ?>
      </form>
      <?php

if($_COOKIE["onoff"] == 1) {


	  if(!empty($_COOKIE["ss"])) {

									if(!empty($_COOKIE["school"])) {

										?>
      <p class="cn-pricepermin" align="center" style="margin-top:10px"> No online Experts found for this category with the criteria of Expert Score level and School level.... </p>
      <?php
									} else {

						 ?>
      <p class="cn-pricepermin" align="center" style="margin-top:10px"> No online Experts found for this category with the criteria of Expert Score level.... </p>
      <?php
									}


	  } else {

		if(!empty($_COOKIE["school"])) {

			?>
      <p class="cn-pricepermin" align="center" style="margin-top:10px"> No online Experts found for this category with the criteria of School level.... </p>
      <?php

		} else {

				?>
      <p class="cn-pricepermin" align="center" style="margin-top:10px"> No online Experts found for this category.... </p>
      <?php

		}

	  }



} else if($_COOKIE["onoff"] == 2) {



	  if(!empty($_COOKIE["ss"])) {

									if(!empty($_COOKIE["school"])) {

										?>
      <p class="cn-pricepermin" align="center" style="margin-top:10px"> No offline Experts found for this category with the criteria of Expert Score level and School level.... </p>
      <?php
									} else {

						 ?>
      <p class="cn-pricepermin" align="center" style="margin-top:10px"> No offline Experts found for this category with the criteria of Expert Score level.... </p>
      <?php
									}


	  } else {

		if(!empty($_COOKIE["school"])) {

			?>
      <p class="cn-pricepermin" align="center" style="margin-top:10px"> No offline Experts found for this category with the criteria of School level.... </p>
      <?php

		} else {

				?>
      <p class="cn-pricepermin" align="center" style="margin-top:10px"> No offline Experts found for this category.... </p>
      <?php

		}

	  }


} else {

     if(!empty($_COOKIE["ss"])) {

						if(!empty($_COOKIE["school"])) {


		?>
      <p class="cn-pricepermin" align="center" style="margin-top:10px"> No Experts found for this category with the criteria of Expert Score Level and School.... </p>
      <?php

						} else {

				?>
      <p class="cn-pricepermin" align="center" style="margin-top:10px"> No Experts found for this category with the criteria of Expert Score Level.... </p>
      <?php
						}

     } else {

			if(!empty($_COOKIE["school"])) {
			?>
      <p class="cn-pricepermin" align="center" style="margin-top:10px"> No Experts found for this category with the criteria of School Level.... </p>
      <?php


		}

      }

}

		?>
      <!--<p class="cn-pricepermin" align="center" style="margin-top:10px; color:#C30">
                        	    Please Select category from the category list
                      	    </p>-->

      <div class="clear-both"></div>
      <? endif; ?>
      <?php else: ?>
      </form>
      <p class="cn-pricepermin" align="center" style="margin-top:10px"> No Experts found..... </p>
      <p class="cn-pricepermin" align="center" style="margin-top:10px; color:#C30"> Please Select category from the category list </p>
      <div class="clear-both"></div>
      <?php endif; ?>
    </div>
  </div>
</div>
</div>
