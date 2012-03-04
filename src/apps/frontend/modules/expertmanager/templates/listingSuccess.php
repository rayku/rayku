<link rel="stylesheet" type="text/css" href="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/styles/classroom.css" />
<link rel="stylesheet" type="text/css" href="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/css/global.css" />
<link rel="stylesheet" type="text/css" href="/css/custom/button.css"/>
<!-- Connect Pop Up CSS -->
<link rel="stylesheet" type="text/css" href="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/css/connect.css" />

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"></script>
<script type="text/javascript">
/* Popup */
$(function() {

    var $sidebar   = $("#popup_connect"),
	$window    = $(window),
	offset     = $sidebar.offset(),
	topPadding = 40;
	$sidebar.css({"position":"absolute","top":"60px"});

    $window.scroll(function() {
	if ($window.scrollTop() > offset.top) {
	    $sidebar.stop().animate({
		marginTop: $window.scrollTop() - offset.top + topPadding
	    });
	} else {
	    $sidebar.stop().animate({
		marginTop: 0
	    });
	}
    });

}); 
</script>		
<div class="body" >
  <?php $sfuser=$sf_user->getRaykuUser()->getID(); ?>
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
        
        <h4>Tutor Status: <img src="../images/greyarrow-down.jpg" width="10" height="11" alt="" /></h4>
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
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
        <script lang="text/javascript">
		var count_checkboxclicks=0;
	   	var expertcount=0;  var expertIds=new Array();

		var origMouseX = 0;
		var currentSliderValue = 0;
		var maxSliderValue = 168;
		var minSliderValue = 0;
		var icount = 1;
		/*var slider = document.getElementById('sliderCarot').value;
		slider.setAttribute('onmousedown','sliderOnMouseDown(event)');
		slider.setAttribute('onmouseup','sliderOnMouseDown(event)');
		onSliderChange();
		
		function sliderOnMouseDown(e){
			if(origMouseX == 0) origMouseX = e.clientX;
			document.onmouseup = sliderOnMouseUp;
			document.onmousemove = slideSlider;
			document.body.focus();
			document.onselectstart = function(){ return false; };
			slider.ondragstart = function() { return false; }; 
			return false;
		}
		
		function sliderOnMouseUp(e){
			document.onmouseup = '';
			document.onmousemove = '';
			onSliderChange();
			return false;
		}
		
		function slideSlider(e){
			if (!e) e = window.event;
			
			if((e.clientX - origMouseX) > maxSliderValue)
				return false;
			
			if((e.clientX - origMouseX) < minSliderValue)
				return false;
			
			slider.style.left = (e.clientX - origMouseX) + "px";
			currentSliderValue = e.clientX - origMouseX;
			onSliderChange();
			return false;
		}
		
		function getCurrentSliderPercent(){
			return parseInt((currentSliderValue / maxSliderValue) * 100);
		}
		
		function onSliderChange(){
			var sliderCost = 2.00 * (getCurrentSliderPercent() / 100);
			if(sliderCost < .25) sliderCost = .25;
			stringSliderCost = sliderCost.toString();
			if(stringSliderCost.length == 3) stringSliderCost += "0";
			if(stringSliderCost.length == 1) stringSliderCost += ".00";
			document.getElementById('currentPrice').innerHTML = "$" + stringSliderCost;
		}*/
		
		
		
		
		function deletecookie(a)
		{
			var tid = a;
			
			document.getElementById("first"+tid).style.backgroundColor = '';
			
			var chkbox = "checkbox_"+tid;
			
			document.getElementById(chkbox).checked = false;
			
			/* Delete Cookie */
			
			for(j=1;j<=icount;j++)
			{
				var cookieval = getCookie("tutor_"+j);
				
				if(cookieval == tid)
				{
					var currcookie = "tutor_"+j;			
				}
			}
			
			//alert(currcookie);
			
			var tcount = getCookie('tutorcount');
			
			tcount=tcount-1;
			
			expertcount = tcount;
			
			setCookie("tutorcount", tcount, 36000)	
			
			var cookie_date = new Date();  // current date & time
			
			cookie_date.setTime(cookie_date.getTime() - 1);
			
			document.cookie = currcookie += "=; expires=" + cookie_date.toGMTString();
				
			$(document).ready(function(){
			$('#popup_content').load('http://www.rayku.com/expertmanager/checkoutpopup', '', function(response) {
			
			    $("#popup_connect").html(response);
			    
			});
		    	});								    	
		    	
		}
		
		function setvalue(a)
		{
			//alert(a);
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
			
			var newId = a.split('_');

			var lastOne = newId[1];
			
			var tid = lastOne;
			document.getElementById("first"+tid).style.backgroundColor = '#DEF3FE';

				expertcount=expertcount+1;
			
			//alert(expertcount);
			
			var tutname = "tutor_"+icount;
			
			var maxcook = icount;
			
			setCookie(tutname, tid, 36000);
			
			setCookie("cookcount", maxcook, 36000);
			
			//var TID = getCookie(tutname);
												
			setCookie("tutorcount", expertcount, 36000);
			
			$(document).ready(function(){
			$('#popup_connect').load('http://www.rayku.com/expertmanager/checkoutpopup', '', function(response) {
			
			    $("#popup_content").html(response);
			    
			});
		    	});
		    	
			icount = icount+1;
			
			}

	        	if (document.getElementById(a).checked == false)
			{									
			
			var newId = a.split('_');

			var lastOne = newId[1];

			var tid = lastOne;
			
			document.getElementById("first"+tid).style.backgroundColor = '';
			
			var b = 'checkbox_'+tid;			
			
			document.getElementById(b).checked = false;
			
			/* Delete Cookie */

			for(j=1;j<=icount;j++)
			{
				var cookieval = getCookie("tutor_"+j);
				if(cookieval == tid)
				{
					var currcookie = "tutor_"+j;			
				}
			}
			
			//var currcookie = "tutor_"+lvar newvalue = a.split('.');			
			
			expertcount=expertcount-1;
			//alert(expertcount);
			setCookie("tutorcount", expertcount, 36000);
			
			var cookie_date = new Date();  // current date & time
			
			cookie_date.setTime(cookie_date.getTime() - 1);
			
			document.cookie = currcookie += "=; expires=" + cookie_date.toGMTString();
				
			$(document).ready(function(){
			$('#popup_content').load('http://www.rayku.com/expertmanager/checkoutpopup', '', function(response) {
			
			    $("#popup_connect").html(response);
			    
			});
		    	});

			}



		}
		
		
		function rowCheck(a){
		
			var newvalue = a.split('.');			
			
			var b = "checkbox_"+newvalue[0];			
			
			if(!document.getElementById(b).checked)
			{
				//alert("Ex:Un-Checked:"+b);
				document.getElementById(b).checked=true;
				//alert("Current Box::"+document.getElementById(b).checked);
				document.getElementById("first"+newvalue[0]).style.backgroundColor = '#DEF3FE';
				expertcount=expertcount+1;
				
				var tid = newvalue[0];
				
				var tutname = "tutor_"+icount;
			
				var maxcook = icount;
			
				setCookie(tutname, tid, 36000);
			
				setCookie("cookcount", maxcook, 36000);
				
				setCookie("tutorcount", expertcount, 36000);
				
				$(document).ready(function()
				{
				
					$('#popup_content').load('http://www.rayku.com/expertmanager/checkoutpopup', '', function(response) {
			
				    	$("#popup_connect").html(response);
				    
					});
			    	});	
				
				icount = icount+1;
			}
			else
			{
				//alert("Ex: Checked:"+b);
				document.getElementById(b).checked=false;
				//alert("Current Box::"+document.getElementById(b).checked);
				document.getElementById("first"+newvalue[0]).style.backgroundColor = '';
				expertcount=expertcount-1;
				
				setCookie("tutorcount", expertcount, 36000);
				
				var tid = newvalue[0];
				
				//Delete Cookie
			
				for(m=1;m<=icount;m++)
				{
					var cookieval = getCookie("tutor_"+m);
				
					if(cookieval == tid)
					{
						var currcookie = "tutor_"+m;			
					}
				}	
				
				var cookie_date = new Date(); 
			
				cookie_date.setTime(cookie_date.getTime() - 1);
			
				document.cookie = currcookie += "=; expires=" + cookie_date.toGMTString();
				
				$(document).ready(function()
				{
					$('#popup_content').load('http://www.rayku.com/expertmanager/checkoutpopup', '', function(response) {
			
				    	$("#popup_connect").html(response);
				    
					});
			    	});					
				 
				
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
      <div style="float:left;width:650px;font-size:21px;color:#333;line-height:30px">Choose 1 to 4 online tutors below. Then <strong>click <a href="javascript: document.listform.submit()" onclick="return checkExpertCheckBoxes();" type="submit" id="submit_connect">here</a> to connect.</strong></div>
        <input type="hidden" name="hidden" value="hidden" />
        <div style="float:right;width:60px" align="right"><!--<a href="whiteboard">-->
          <input type="button" name="post_on_boards" value="Skip" onclick="javascript:document.location='http://www.rayku.com/forum/newthread/<?=$_SESSION['subject'];?>?pob=1'" class="myButton" style="width:55px;font-weight:normal">
          </div>

          </div>
        <div class="cn-content">
        <div class="cn-right-top">
          <div class="cn-column-one" style="width:510px">Rayku Experts</div>
          <div class="cn-column-two" align="center">Rate /min.</div>
          <div class="cn-column-four" align="center">Connect</div>
          <div class="clear-both"></div>
        </div>
        <?php 
        //print_r($_COOKIE);
$connection = RaykuCommon::getDatabaseConnection();

$logedUserId = $_SESSION['symfony/user/sfUser/attributes']['symfony/user/sfUser/attributes']['user_id'];

$c = new Criteria();
	$rankexperts = ExpertCategoryPeer::doSelect($c);

	$rankedUsers = array(); $ji =0; $newUserLimit = array(); 

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
								$rankedUsers[$ji] = array("score" => $score['score'], "userid" => $exp->getUserId(), "createdat" => $_thisUser->getCreatedAt());

								$ji++;
							endif;
		      
      						 endif; 

					endif;


		 endforeach; 

					asort($rankedUsers);  

					arsort($rankedUsers);

usort($rankedUsers, "cmp");



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
		foreach($expert_cats as $new): 


//==========================================Expert Score increase when both user and asker belongs to the same school=======================================//
	 					$c=new Criteria();
						$c->add(UserPeer::ID,$new['userid']);
						$newExperts=UserPeer::doSelectOne($c);



						$z=new Criteria();
						$z->add(UserPeer::ID,$logedUserId);
						$loginUser=UserPeer::doSelectOne($z);



						 $mailExperts = explode("@", $newExperts->getEmail());	     
															
						 $newMailExperts = explode(".", $mailExperts[1]);

					 	 $mailUser = explode("@", $loginUser->getEmail());	     
															
						 $newMailUser = explode(".", $mailUser[1]);


						if(($newMailExperts[0] == $newMailUser[0]) || ($newMailExperts[1] == $newMailUser[1])) {

						$new['score'] = $new['score'] * 1.6;

						}
//================================================//

//=====================================Expert Score increasing based on experts and users year performance=============================//

if($cat == 5) {

$queryExp = mysql_query("select * from user_course where user_id=".$new['userid']."", $connection) or die(mysql_error());
$rowExp = mysql_fetch_assoc($queryExp);

$queryUser = mysql_query("select * from user_course where user_id=".$logedUserId."", $connection) or die(mysql_error());
$rowUser = mysql_fetch_assoc($queryUser);

} else {

$queryExp = mysql_query("select * from user_course where user_id=".$new['userid']." AND course_subject=".$new['category'], $connection) or die(mysql_error());
$rowExp = mysql_fetch_assoc($queryExp);

$queryUser = mysql_query("select * from user_course where user_id=".$logedUserId." AND course_subject=".$new['category'], $connection) or die(mysql_error());
$rowUser = mysql_fetch_assoc($queryUser);

}



		if(!is_numeric($rowExp['course_year'])) {

			if($rowExp['course_year'] == "graduated") {
				
				$rowExp['course_year'] = 5;

			} else {

				$rowExp['course_year'] = 4;
			}

		} 

		if(!is_numeric($rowUser['course_year'])) {

			if($rowUser['course_year'] == "graduated") {
				
				$rowUser['course_year'] = 5;

			} else {

				$rowUser['course_year'] = 4;
			}

		} 

	$value = $rowExp['course_year'] - $rowUser['course_year'];

	if($value == 1)
	{
		$new['score'] = $new['score'] * 1.5;

	} else if($value == 2) {

		$new['score'] = $new['score'] * 1.4;

	} else if($value == 3) {

		$new['score'] = $new['score'] * 1.3;

	} else if($value == 4) {

		$new['score'] = $new['score'] * 1.2;
	}
//=====================================================//

//=========================Expert Score increasing based on experts and grade performance=====================//

if($rowExp['course_performance'] == "A") {

	$rowExp['course_performance'] = 4;

} else if($rowExp['course_performance'] == "B") {

	$rowExp['course_performance'] = 3;

} else if($rowExp['course_performance'] == "C") {

	$rowExp['course_performance'] = 2;

} else if($rowExp['course_performance'] == "D") {

	$rowExp['course_performance'] = 1;

}

if($rowUser['course_performance'] == "A") {

	$rowUser['course_performance'] = 4;

} else if($rowUser['course_performance'] == "B") {

	$rowUser['course_performance'] = 3;

} else if($rowUser['course_performance'] == "C") {

	$rowUser['course_performance'] = 2;

} else if($rowUser['course_performance'] == "D") {

	$rowUser['course_performance'] = 1;

}

$newValue = $rowExp['course_performance'] - $rowUser['course_performance'];

	if($newValue == 1)
	{
		$new['score'] = $new['score'] * 1.2;

	} else if($newValue == 2) {

		$new['score'] = $new['score'] * 1.4;

	} else if($newValue == 3) {

		$new['score'] = $new['score'] * 1.6;

	} 


//================================================================================================================================================================//


				if(empty($_COOKIE["onoff"])) {

$onlinecheck = '';

					if($newExperts->isOnline()) {

						$onlinecheck = "online";

					} 


					if(empty($onlinecheck)) {

					
						$gtalkquery = mysql_query("select * from user_gtalk where userid=".$new['userid'], $connection) or die(mysql_error());

						if(mysql_num_rows($gtalkquery) > 0) {

							$status = mysql_fetch_assoc($gtalkquery);

							$gtalkmail = $status['gtalkid'];

							 $onlinecheck = file_get_contents('http://www.rayku.com:8892/status/'.$gtalkmail);
						} 

					}

				      if(empty($onlinecheck) || ($onlinecheck != "online")) {

					$fb_query = mysql_query("select * from user_fb where userid=".$new['userid'], $connection) or die(mysql_error());

								if(mysql_num_rows($fb_query) > 0) {

									$fbRow = mysql_fetch_assoc($fb_query);

									$fb_username = $fbRow['fb_username'];

								$details = file_get_contents("http://facebook.rayku.com/tutor");

								$Users = json_decode($details, true);


								foreach($Users as $key => $user) :
	
									if($user['username'] == $fb_username):

										 $onlinecheck = 'online'; 	
		
										 break;	
									endif;

								endforeach;

								}

					}

						 if(empty($onlinecheck) || ($onlinecheck != "online")) {
	
							$onlineUsers = file_get_contents("http://notification-bot.rayku.com/tutor");

							$_Users = json_decode($onlineUsers, true);

							foreach($_Users as $key => $_user) :
	
								if($_user['email'] == $newExperts->getEmail()):

									 $onlinecheck = 'online'; 		
									 break;	
								endif;

							endforeach;

						}
	
					
						if($onlinecheck == "online") {

								$dv=new Criteria();
								$dv->add(UserPeer::ID,$new['userid']);
								$_thisUser = UserPeer::doSelectOne($dv);

						$newOnlineUser[$j] = array("score" => $new['score'], "userid" => $new['userid'], "category" => $new['category'], "createdat" => $_thisUser->getCreatedAt());

						 $j++;

						} elseif($newExperts->isOnline()) {

								$dv=new Criteria();
								$dv->add(UserPeer::ID,$new['userid']);
								$_thisUser = UserPeer::doSelectOne($dv);

						$newOnlineUser[$j] = array("score" => $new['score'], "userid" => $new['userid'], "category" => $new['category'], "createdat" => $_thisUser->getCreatedAt());

						 $j++;

						} else {
								$dv=new Criteria();
								$dv->add(UserPeer::ID,$new['userid']);
								$_thisUser = UserPeer::doSelectOne($dv);

						$newOfflineUser[$k] = array("score" => $new['score'], "userid" => $new['userid'], "category" => $new['category'], "createdat" => $_thisUser->getCreatedAt());

						$k++;
						}
				} else {

								$dv=new Criteria();
								$dv->add(UserPeer::ID,$new['userid']);
								$_thisUser = UserPeer::doSelectOne($dv);
					
						$newUser[$i] = array("score" => $new['score'], "userid" => $new['userid'], "category" => $new['category'], "createdat" => $_thisUser->getCreatedAt());

					 	$i++;
				}

	

				 endforeach; 





$_l = 1; $_h = 1; $_Tutor = array(); 	$_NonTutor = array();

				if(empty($_COOKIE["onoff"])) {

					$_all_users = $newOnlineUser;

				} else {

					$_all_users = $newUser;

				}

				foreach($_all_users as $key => $user) :

				$_user = UserPeer::retrieveByPk($user['userid']);

					if($_user->getType() == 5):
				
						$_Tutor[$_l] = array("score" => $user['score'], "userid" => $user['userid'], "category" => $user['category']);

						$_l++;

					else :

						$_NonTutor[$_h] = array("score" => $user['score'], "userid" => $user['userid'], "category" => $user['category']);

						$_h++;
					

					endif;

				endforeach;



					asort($_Tutor);  

					arsort($_Tutor);


					asort($_NonTutor);  

					arsort($_NonTutor);


$_dv = 1;  $_vd = 1;
				foreach($_NonTutor as $key => $user) :


					$query = mysql_query("select * from user_rate where userid=".$user['userid']." and (rate = 0.00 || rate = 0) ", $connection) or die("Error In rate".mysql_error());

					if(mysql_num_rows($query) > 0) {

						$_emptyRateUsers[$_dv] = array("score" => $user['score'], "userid" => $user['userid'], "category" => $user['category']);

						$_dv++;

					} else {

						$_rateUsers[$_vd] = array("score" => $user['score'], "userid" => $user['userid'], "category" => $user['category']);

						$_vd++;

					}	



				endforeach;



		$finalusers = array();

		$fianl_users = array(); $_fianl_users = array(); $_dd =1;  $_vx = 1;

			
		$rateUsersCount = count($_rateUsers);

		if($rateUsersCount > 3) {

			foreach($_rateUsers as $key => $user) :
				
				if($_dd%4==0 && $_vx <= 3 && !empty($_emptyRateUsers)):

					$fianl_users[$_dd] = $_emptyRateUsers[$_vx];
			
					unset($_emptyRateUsers[$_vx]); 

					$_vx++; $_dd++;


				elseif($_dd%4==0 && $_vx > 3 && !empty($_emptyRateUsers)) :

					$fianl_users[$_dd] = $_emptyRateUsers[$_vx];
									
					unset($_emptyRateUsers[$_vx]); 

					$_vx++; $_dd++;
			
 
				endif;

					$fianl_users[$_dd] = array("score" => $user['score'], "userid" => $user['userid'], "category" => $user['category']);

				
					$_dd++;

			//echo "List".$_dd++;print_r($fianl_users);echo "<br/><br/>";

			
			endforeach;

			if(!empty($_emptyRateUsers)) :

				$finalusers = array_merge($fianl_users,$_emptyRateUsers);

			else :

				$finalusers = $fianl_users;


			endif;

		} else {

					if(!empty($_emptyRateUsers) && !empty($_rateUsers)) {

						$finalusers = array_merge($_rateUsers,$_emptyRateUsers);

					} else if(empty($_emptyRateUsers) && !empty($_rateUsers)) {


						$finalusers = $_rateUsers;

					} else if(!empty($_emptyRateUsers) && empty($_rateUsers)) {

						$finalusers = $_emptyRateUsers;

					}

			
		}


				if(empty($_COOKIE["onoff"])) {

					asort($newOfflineUser);  

					arsort($newOfflineUser);


					$newUser = array();

					if(!empty($_Tutor) && !empty($finalusers)) {


						$newUser = array_merge($_Tutor,$finalusers,$newOfflineUser);

					} else if(!empty($_Tutor) && empty($finalusers)) {


						$newUser = array_merge($_Tutor,$newOfflineUser);

					} else if(empty($_Tutor) && !empty($finalusers)) {

						$newUser = array_merge($finalusers,$newOfflineUser);

					} else if(empty($_Tutor) && empty($finalusers)) {

						$newUser = $newOfflineUser;


					}




				} else {


					$newUser = array();

					if(!empty($_Tutor) && !empty($finalusers)) {

						$newUser = array_merge($_Tutor,$finalusers);

					} else if(!empty($_Tutor) && empty($finalusers)) {

						$newUser = $_Tutor;

					} else if(empty($_Tutor) && !empty($finalusers)) {

						$newUser = $finalusers;

					}


				}




		//$xy = 1; 




		 $_count_online_user = 0;

			
					
	$_count_check = count($newUser);




	$_v = 1; 





					$rankUsers = $newUser;

					asort($rankUsers);  

					arsort($rankUsers);


	//usort($newUser, "cmp");



				 foreach($newUser as $newOne): 

				$xy =  $newOne['userid'];


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
                                 //printf("ID: %s  Name: %s", $row[0], $row[3]); 
								 
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

		$onlinecheck = file_get_contents('http://www.rayku.com:8892/status/'.$gtalkmail);


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

?>


<?php 

       
	$curr_user_rank=''; $ij =1;


	foreach($rankedUsers as $_expert):

		if($_expert['userid'] == $experts->getId()):

			$curr_user_rank=$ij;				 
			break;

		endif;

	$ij++;

	endforeach;


?>

<?php

if(strlen($allsub) > 100) :

 $allsub = substr($allsub,0,100); 

 $allsub =  $allsub."&nbsp;&nbsp;...";
endif;


?>

<?php
								
 if(!empty($_COOKIE["ss"]) && $_COOKIE["ss"] <= $newOne['score']) { 

$k = 1; ?>

<div class="cn-result"  id="<?php echo 'first'.$xy; ?>">
          <div  id="<?php echo $xy.'.1'; ?>" class="cn-column-one"  onclick="rowCheck(this.id)" style="padding-right:15px;width:500px;">
            <p id="<?php echo $xy.'.2'; ?>"  class="cn-title"  onclick="rowCheck(this.id)">
            <div id="<?php echo $xy.'.3'; ?>"  class="cn-user-info" onclick="rowCheck(this.id)" style="float:right;width:150px;line-height:14px" align="right"><strong style="color:#069"></strong>

              <?php if($onlinecheck == "online" || $experts->isOnline()) : ?>
              <?php if($experts->getType() == 5): ?>
              <img src="http://www.rayku.com/images/expert_saved.png" alt="Rayku Staff" />
              <?php endif; ?>
              <a href="/tutor/<?php echo $experts->getUsername()?>" target="_blank" style="color:#8FAFC8"><?php echo $experts->getName()?> <span class="onlinenow">(online)</span></a>
              <?php else: ?>
              <?php if($experts->getType() == 5): ?>
              <img src="http://www.rayku.com/images/expert_saved.png" alt="Rayku Staff" />
              <?php endif; ?>
              <a href="/tutor/<?php echo $experts->getUsername()?>" target="_blank" style="color:#8FAFC8"><?php echo $experts->getName()?> <span class="offlinenow">(offline)</span></a>
              <?php endif; ?>
            </div>
            <?php if($onlinecheck == "online" || $experts->isOnline()) : ?>

 	<?php if(($experts->getType() == 5)) : ?>

 		<div style="float:left;height:50px;line-height:20px;width:50px;border-right:1px solid #CFD0D2;"><img src="http://www.rayku.com/images/portfolio/certified-online.png" alt="Certified" id="certified" /></div>

	<?php elseif($curr_user_rank <= 10) : ?>

			<div style='float:left;height:50px;line-height:20px;width:50px;border-right:1px solid #CFD0D2;'>ranked <strong>#<?php echo $curr_user_rank; ?></strong></div>

         <?php endif; ?>

            <div style="padding-left:60px;"> <u><a href="#" title="Click to Select"><?php echo $allsub;?></a></u></div>
            <?php else: ?>
            <?php echo $allsub;?>
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
              <input type="checkbox" name="checkbox[]" id="checkbox_<?php echo $xy; ?>" value="<?php echo $newOne['userid']?>" onclick="setvalue(this.id)" />
              <?php else: ?>
              <a href="../../message/compose/<?php echo $experts->getUsername(); ?>"><img height="18" width="59" alt="" src="/images/em-email.jpg"></a>
              <?php endif; ?>
              <?php else: ?>
              <a href="../../message/compose/<?php echo $experts->getUsername(); ?>"><img height="18" width="59" alt="" src="/images/em-email.jpg"></a>
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

	} else { ?>



<div class="cn-result"  id="<?php echo 'first'.$xy; ?>">
          <div  id="<?php echo $xy.'.1'; ?>" class="cn-column-one"  onclick="rowCheck(this.id)" style="padding-right:15px;width:500px;">
            <p id="<?php echo $xy.'.2'; ?>"  class="cn-title"  onclick="rowCheck(this.id)">
            <div id="<?php echo $xy.'.3'; ?>"  class="cn-user-info" onclick="rowCheck(this.id)" style="float:right;width:150px;line-height:14px" align="right"><strong style="color:#069"></strong>

              <?php if($onlinecheck == "online" || $experts->isOnline()) : ?>
              <?php if($experts->getType() == 5): ?>
              <img src="http://www.rayku.com/images/expert_saved.png" alt="Rayku Staff" />
              <?php endif; ?>
              <a href="/tutor/<?php echo $experts->getUsername()?>" target="_blank" style="color:#8FAFC8"><?php echo $experts->getName()?> <span class="onlinenow">(online)</span></a>
              <?php else: ?>
              <?php if($experts->getType() == 5): ?>
              <img src="http://www.rayku.com/images/expert_saved.png" alt="Rayku Staff" />
              <?php endif; ?>
              <a href="/tutor/<?php echo $experts->getUsername()?>" target="_blank" style="color:#8FAFC8"><?php echo $experts->getName()?> <span class="offlinenow">(offline)</span></a>
              <?php endif; ?>
            </div>

            <?php if($onlinecheck == "online" || $experts->isOnline()) : ?>

		 	<?php if(($experts->getType() == 5)) : ?>

		 		<div style="float:left;height:50px;line-height:20px;width:50px;border-right:1px solid #CFD0D2;"><img src="http://www.rayku.com/images/portfolio/certified-online.png" alt="Certified" id="certified" /></div>

			<?php elseif($curr_user_rank <= 10) : ?>

					<div style='float:left;height:50px;line-height:20px;width:50px;border-right:1px solid #CFD0D2;'>ranked <strong>#<?php echo $curr_user_rank; ?></strong></div>

			<?php endif; ?>

            <div style="padding-left:60px;"> <u><a href="#" title="Click to Select"><?php echo $allsub;?></a></u></div>
            <?php else: ?>
            <?php echo $allsub;?>
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
              <input type="checkbox" name="checkbox[]" id="checkbox_<?php echo $xy?>" value="<?php echo $newOne['userid']?>" onclick="setvalue(this.id)" />
              <?php else: ?>
              <a href="/message/compose/<?php echo $experts->getUsername(); ?>"><img alt="in session" src="/images/em-busy.jpg"></a>
              <?php endif; ?>
              <?php else: ?>
              <a href="/message/compose/<?php echo $experts->getUsername(); ?>"><img height="18" width="59" alt="" src="/images/em-email.jpg"></a>
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

			 		$_v++;


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
<div id="popup_connect" style="border:1px solid red;">		
	</div>
</div>
</div>
