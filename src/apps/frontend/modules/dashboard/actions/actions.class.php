<?php
/**
 * dashboard actions.
 *
 * @package    elifes
 * @subpackage dashboard
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class dashboardActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {




 if(!empty($_COOKIE["timer"])) : 

	$this->redirect('/dashboard/rating');

 endif; 


//============================================================Modified By DAC021===============================================================================//
			$con = mysql_connect("localhost", "rayku_db", "db_*$%$%") or die(mysql_error());

			$db = mysql_select_db("rayku_db", $con) or die(mysql_error());

$logedUserId = $_SESSION['symfony/user/sfUser/attributes']['symfony/user/sfUser/attributes']['user_id'];

$this->logedUserId =  $logedUserId;

$query = mysql_query("select * from user where id=".$logedUserId." ") or die(mysql_error());
$row = mysql_fetch_assoc($query);




////////get rank of the user
	$c = new Criteria();
	$rankexperts = ExpertCategoryPeer::doSelect($c);

	$rankUsers = array(); $ji =0; $newUserLimit = array(); 

		 foreach($rankexperts as $exp): 

	
					if(!in_array($exp->getUserId(), $newUserLimit)) :

					$newUserLimit[] = $exp->getUserId();

						 $_query = mysql_query("select * from user_tutor where userid =".$exp->getUserId()." ") or die(mysql_error()); 
						 if(mysql_num_rows($_query) > 0) : 

							$query = mysql_query("select * from user_score where user_id=".$exp->getUserId()) or die(mysql_error());
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






 $this->rankUsers = $rankUsers;
	

//////////////////////////////

	$this->getResponse()->setCookie("practice_name", $row['username'],time()+3600);


	$queryScore = mysql_query("select * from user_score where user_id =".$logedUserId." and score >= 125 and status = 0") or die(mysql_error());

	if(mysql_num_rows($queryScore) > 0) :

			$this->changeUserType = 1;

	endif;



  }

  
	function cmp($a, $b)
	{


	    if ($a["score"] == $b["score"]) {
		return strcmp($a["createdat"], $b["createdat"]);
	    }
	    return ($a["score"] < $b["score"]) ? 1 : -1;
	    
	}

  public function executeVerifytutor() {

		$con = mysql_connect("localhost", "rayku_db", "db_*$%$%");
		$db = mysql_select_db("rayku_db", $con);

	$_userId = $this->getUser()->getRaykuUser()->getId();

	$queryScore = mysql_query("select * from user_score where user_id =".$_userId."") or die(mysql_error());

	if(mysql_num_rows($queryScore) > 0) :

			mysql_query("update user_score set status = 1 where user_id =".$_userId."") or die(mysql_error());

	endif;

	$this->redirect('http://www.rayku.com/dashboard');


 }


  public function executeList()
  {

	
		$con = mysql_connect("localhost", "rayku_db", "db_*$%$%");
		                        $db = mysql_select_db("rayku_db", $con);
	$logedUserId = $_SESSION['symfony/user/sfUser/attributes']['symfony/user/sfUser/attributes']['user_id'];


if(!empty($_POST['subject'])) {


	if(!empty($_COOKIE['whiteclose']) && $_COOKIE['whiteclose'] == 1):

		mysql_query("delete from popup_close where user_id=".$logedUserId) or die(mysql_error());

			$this->getResponse()->setCookie("whiteclose", "", time()-3600);


	endif;


	$query = mysql_query("Select * from popup_close where user_id=".$logedUserId) or die(mysql_error());
	if(mysql_num_rows($query) > 0) :

		$_SESSION['conversation'] = 1;
		$this->redirect('http://www.rayku.com/dashboard');

	endif;


	$_SESSION['question'] = $_POST['question'];
	$_SESSION['subject'] = $_POST['subject'];


	if($_POST['redirect'] == "2"):

		$this->redirect('http://www.rayku.com/dashboard/direct');

	endif;



$this->redirect('http://www.rayku.com/expertmanager/list');

	

}





$this->redirect('http://www.rayku.com/dashboard');

  }


  public function executeTutor()
  {

	$con = mysql_connect("localhost", "rayku_db", "db_*$%$%");
	$db = mysql_select_db("rayku_db", $con);

	$_userId = $this->getUser()->getRaykuUser()->getId();


	$_select = mysql_query("select * from user_tutor where userid=".$_userId) or die(mysql_error());

	if(mysql_num_rows($_select) > 0) {
		
			mysql_query("delete from user_tutor where userid = ".$_userId." ") or die(mysql_error());	

			$_query = mysql_query("update user_rate set rate = 0.00 where userid=".$_userId) or die(mysql_error());

			if(!$_query) :

				mysql_query("insert into user_rate(userid,rate) values(".$_userId.", '0.00') ") or die(mysql_error());

			endif;


		

	} else {

			 mysql_query("insert into user_tutor(userid) values(".$_userId.")") or die(mysql_error());

			$_query = mysql_query("update user_rate set rate = 0.00 where userid=".$_userId) or die(mysql_error());

			if(!$_query) :

				mysql_query("insert into user_rate(userid,rate) values(".$_userId.", '0.00') ") or die(mysql_error());

			endif;

	}

	$this->redirect('http://www.rayku.com/dashboard');

  }

  public function executeDirect()
  {

	$con = mysql_connect("localhost", "rayku_db", "db_*$%$%");
	$db = mysql_select_db("rayku_db", $con);

	$logedUserId = $_SESSION['symfony/user/sfUser/attributes']['symfony/user/sfUser/attributes']['user_id'];

		$currentUser = $this->getUser()->getRaykuUser();

		$userId = $currentUser->getId();


		if(!empty($_SESSION['subject']))
			{
			
					$this->cat = $_SESSION['subject'];
					
			} 


					$con = mysql_connect("localhost", "rayku_db", "db_*$%$%");
		                        $db = mysql_select_db("rayku_db", $con);

$logedUserId = $_SESSION['symfony/user/sfUser/attributes']['symfony/user/sfUser/attributes']['user_id'];
					

		$c = new Criteria();
		
		
		
		if($this->cat==5)
		{
						
					$experts=ExpertCategoryPeer::doSelect($c);
				 
		}else
		{
		$c->add(ExpertCategoryPeer::CATEGORY_ID,$this->cat);
		
		$experts = ExpertCategoryPeer::doSelect($c);
		}		


					$queryPoints = mysql_query("select * from user where id=".$userId) or die("Error In rate".mysql_error());

					if(mysql_num_rows($queryPoints) > 0) {

					$rowPoints = mysql_fetch_assoc($queryPoints);

						$_points = $rowPoints['points'];

					}


		$newUser= array(); $i =0; $newUserLimit= array(); 

		 foreach($experts as $exp): 

									 
				if($userId != $exp->getUserId()):

					if(!in_array($exp->getUserId(), $newUserLimit)) :

					$newUserLimit[] = $exp->getUserId();

						 $_query = mysql_query("select * from user_tutor where userid =".$exp->getUserId()." ") or die(mysql_error()); 
						 if(mysql_num_rows($_query) > 0) : 

							$query = mysql_query("select * from user_score where user_id=".$exp->getUserId()) or die(mysql_error());
							$score = mysql_fetch_assoc($query);

							if($score['score'] != 0):

								if($_points == '' || $_points == '0.00' ) {

									$emptyRCquery = mysql_query("select * from user_rate where userid=".$exp->getUserId()." and (rate = 0.00 || rate = 0) ") or die("Error In rate".mysql_error());

									if(mysql_num_rows($emptyRCquery) > 0) {

									$newUser[$i] = array("score" => $score['score'], "userid" => $exp->getUserId(), "category" => $this->cat);

									$i++;

									}


								} else {

								$newUser[$i] = array("score" => $score['score'], "userid" => $exp->getUserId(), "category" => $this->cat);

								$i++;

								}
							endif;
		      
      						 endif; 

					endif;

				endif;	


		 endforeach; 



					 asort($newUser);  

					 arsort($newUser);

				
					 		$onlineusers = array(); 
							$j =0;

							foreach($newUser as $new):
						
								 $a=new Criteria();
								 $a->add(UserPeer::ID,$new['userid']);
								 $users_online=UserPeer::doSelectOne($a);

								$onlinecheck = '';

								if($users_online->isOnline()) {

									$onlinecheck = "online";

								} 


								if(empty($onlinecheck)) {

					
									$gtalkquery = mysql_query("select * from user_gtalk where userid=".$new['userid']) or die(mysql_error());

									if(mysql_num_rows($gtalkquery) > 0) {

										$status = mysql_fetch_assoc($gtalkquery);

										$gtalkmail = $status['gtalkid'];

										 $onlinecheck = file_get_contents('http://www.rayku.com:8892/status/'.$gtalkmail);
									} 

								}

							      if(empty($onlinecheck) || ($onlinecheck != "online")) {


								$fb_query = mysql_query("select * from user_fb where userid=".$new['userid']) or die(mysql_error());

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
	
										if($_user['email'] == $users_online->getEmail()):

											 $onlinecheck = 'online'; 		
											 break;	
										endif;

									endforeach;

								}


								 if($onlinecheck == "online") {

										$onlineusers[$j] = $new['userid'];
										$j++;

								 } elseif($users_online->isOnline()) {

										$onlineusers[$j] = $new['userid'];
										$j++;
								
								  } 
							
							 endforeach; 


						if(count($onlineusers) < 1)
						{
							$this->redirect('http://www.rayku.com/forum/newthread/'.$_SESSION[subject].'?exp_online=1');
						}
						
				
		

		$time = time();


		if(!empty($onlineusers)) {



		$count = count($onlineusers);

		if($count > 4): 

			$count = 4;

		endif;

		if($count > 2) {

			$close = 21000;

		} else if($count == 2) {

			$close = 31000;

		} else if($count == 1) {

			$close = 61000;

		} 

		$j = 0;
			for($i=0; $i < $count; $i++) {

		mysql_query("INSERT INTO `user_expert` (`user_id`, `checked_id`, `category_id`, `question`, `exe_order`, `time`, status, close) VALUES ('".$userId."', '".$onlineusers[$i]."', '".$_SESSION['subject']."', '".$_SESSION['question']."','".(++$j)."', '".$time."', 1, ".$close.") ") or die(mysql_error());

			}

						setcookie("asker_que",$_SESSION['question'], time()+600, "/");


						$this->getResponse()->setCookie("redirection", 1,time()+600);

						$this->getResponse()->setCookie("forumsub", $_SESSION['subject'],time()+600);





			$this->redirect('expertmanager/connect');

		}


	
  }



  public function executeNew()
  {

	$this->user  = $this->getUser()->getRaykuUser();

	//$this->user->getId();

  }

  public function executeGetstarted()
  {

	$this->user = $this->getUser()->getRaykuUser();

	//$this->user->getId();

  }
  
    public function executeProcessprofile()
  {
	 $this->user = $this->getUser()->getRaykuUser();
  }

  public function executePointserror()
  {

  
	

  }

  public function executeExpire()
  {

  
	

  }

  public function executeMoneystore()
  {

  $con = mysql_connect("localhost", "rayku_db", "db_*$%$%");
		$db = mysql_select_db("rayku_db", $con);

		$userId = $this->getUser()->getRaykuUser()->getId();

	if($_POST['reason'] == "Reason For Asking Money Back..." || empty($_POST['reason']))  {

		$_SESSION['reason'] = 1;


	} elseif(!empty($_POST['reason'])) {

		if(!empty($_SESSION["whiteboard_Chat_Id"])) :

			 mysql_query("insert into whiteboard_moneyback(chat_id, reason) values(".$_SESSION["whiteboard_Chat_Id"].", '".$_POST['reason']."')") or die(mysql_error());

			$this->redirect('http://www.rayku.com/dashboard/moneyredirect');

		endif;

	}
	
$this->redirect('http://www.rayku.com/dashboard/moneyback');

  }

  public function executeMoneyback()
  {

		

	

  }

  public function executeMoneyredirect()
  {


  }

  public function executeFacebook()
  {

	$con = mysql_connect("localhost", "rayku_db", "db_*$%$%");
		$db = mysql_select_db("rayku_db", $con);

	$userId = $this->getUser()->getRaykuUser()->getId();



	if($_POST['_hidden_facebook'] && !empty($_POST['fbname'])) :

			
			$fb_username = $_POST['fbname'];

			$this->redirect('http://www.facebook.com/dialog/friends/?id=raykubot&app_id=304330886250108&redirect_uri=http://www.rayku.com/dashboard/facebookadd?username='.$fb_username);


	endif;

	$query = mysql_query("select * from user_fb where userid =".$userId." ") or die(mysql_error());

	 if(mysql_num_rows($query) > 0) :

		$this->record = 1;

		$row = mysql_fetch_assoc($query);

		$this->facebook = $row['fb_username'];

	 else :

		$this->record = 0;

	 endif;
	
  }

  public function executeFacebookadd()
  {

		$con = mysql_connect("localhost", "rayku_db", "db_*$%$%");
		$db = mysql_select_db("rayku_db", $con);

		$userId = $this->getUser()->getRaykuUser()->getId();

	 $query = mysql_query("select * from user_fb where userid =".$userId." ") or die(mysql_error());

	$fb_username = !empty($_GET['username']) ? $_GET['username'] : '';

	 if(!empty($fb_username)) :

			$this->display = 1;

			if(mysql_num_rows($query) > 0) :

				mysql_query("update user_fb set fb_username = '".$fb_username."' where userid = ".$userId." ") or die(mysql_error());
		

			else :

				mysql_query("insert into user_fb(userid, fb_username) values(".$userId.", '".$fb_username."' ) ") or die(mysql_error());

			endif;

	else :

		$this->display = 2;


	endif;

  }


  public function executeGtalk()
  {

		$con = mysql_connect("localhost", "rayku_db", "db_*$%$%");
		$db = mysql_select_db("rayku_db", $con);

	$userId = $this->getUser()->getRaykuUser()->getId();



	$query = mysql_query("select * from user_gtalk where userid =".$userId." ") or die(mysql_error());

	 if(mysql_num_rows($query) > 0) :

		$this->record = 1;

		$row = mysql_fetch_assoc($query);

		$this->gtalk = $row['gtalkid'];

	 else :

		$this->record = 0;

	 endif;



  }

  public function executeGtalkupdate()
  {

		$con = mysql_connect("localhost", "rayku_db", "db_*$%$%");
		$db = mysql_select_db("rayku_db", $con);

		$userId = $this->getUser()->getRaykuUser()->getId();

	$query = mysql_query("select * from user_gtalk where userid =".$userId." ") or die(mysql_error());

	$email = $_POST['gtalkname'];

	$checkemail = explode("@", $email);

	
	if(count($checkemail) == 1) {

		$email .= '@gmail.com';

	} 

	$test = file_get_contents('http://www.rayku.com:8892/add/'.$email);

	if($test) {

		$_SESSION['adduser'] = 1;

	} else {

		$_SESSION['adduser'] = 2;

		$this->redirect('http://www.rayku.com/dashboard/gtalk');

	}


	 if(mysql_num_rows($query) > 0) :

	
		mysql_query("update user_gtalk set gtalkid = '".$email."' where userid = ".$userId." ") or die(mysql_error());
		

	 else :

		mysql_query("insert into user_gtalk(userid, gtalkid) values(".$userId.", '".$email."' ) ") or die(mysql_error());

	 endif;



	$this->redirect('http://www.rayku.com/dashboard/gtalk');

  }



  public function executeBeforeclose()
  {

		$con = mysql_connect("localhost", "rayku_db", "db_*$%$%");
		$db = mysql_select_db("rayku_db", $con);

	$logedUserId = $_SESSION['symfony/user/sfUser/attributes']['symfony/user/sfUser/attributes']['user_id'];

mysql_query("delete from popup_close where user_id=".$logedUserId) or die(mysql_error());

$cookiename= $logedUserId."_question";
$limitcookiename = $logedUserId."_limit";



if (isset($_SERVER['HTTP_COOKIE'])) {

    $cookies = explode(';', $_SERVER['HTTP_COOKIE']);

    foreach($cookies as $cookie) {
       $parts = explode('=', $cookie);
        $name = trim($parts[0]);

		if(($name != $cookiename) && ($name != $limitcookiename) && ($name != "WRUID") && ($name != "rayku_frontend") && ($name != "practice_name")  ) :
				$this->getResponse()->setCookie($name, "", time()-3600);
		endif;

    }

}
  

  }

  public function executeChargerate()
  {

		$con = mysql_connect("localhost", "rayku_db", "db_*$%$%");
		$db = mysql_select_db("rayku_db", $con);

		$_Rate = !empty($_GET['rate']) ? $_GET['rate'] : '0.00';

		$userId = $this->getUser()->getRaykuUser()->getId();

			$query = mysql_query("select * from user_rate where userid=".$userId) or die(mysql_error());


			if(mysql_num_rows($query) > 0) {
	
				mysql_query("update user_rate set rate = ".$_Rate." where userid=".$userId) or die(mysql_error());

			} else {

				mysql_query("insert into user_rate(userid,rate) values(".$userId.", ".$_Rate.") ") or die(mysql_error());

			}

}

  public function executeStay()
  {
		$con = mysql_connect("localhost", "rayku_db", "db_*$%$%");
		$db = mysql_select_db("rayku_db", $con);

			$userId = $this->getUser()->getRaykuUser()->getId();

			$user = $this->getUser()->getRaykuUser();

			$time = time() - 1800;

			$query = mysql_query("select * from user_stay where user_id=".$userId." ") or die(mysql_error());

			if((mysql_num_rows($query) > 0) && ($user->isOnline())) {


				$queryStay = mysql_query("select * from user_stay where user_id=".$userId." and time <= '".$time."' ") or die(mysql_error());

				if(mysql_num_rows($queryStay) > 0) {

					$_time = time();
	
					$_rowStay = mysql_fetch_assoc($queryStay);

					$stayTime = $_rowStay['stay'] + 1;
	
					mysql_query("update user_stay set stay = '".$stayTime."', time = '".$_time."' where user_id=".$userId) or die(mysql_error());

				}

			} elseif($user->isOnline()) {

				$_time = time();

				mysql_query("insert into user_stay(user_id,time, stay) values(".$userId.",'".$_time."', 1) ") or die(mysql_error());

			}

die("In veera");

  }

  public function executeRating()
  {



		$con = mysql_connect("localhost", "rayku_db", "db_*$%$%");
		$db = mysql_select_db("rayku_db", $con);

	$logedUserId = $_SESSION['symfony/user/sfUser/attributes']['symfony/user/sfUser/attributes']['user_id'];

mysql_query("delete from popup_close where user_id=".$logedUserId) or die(mysql_error());


$cookiename= $logedUserId."_question";
$limitcookiename = $logedUserId."_limit";


if (isset($_SERVER['HTTP_COOKIE'])) {

    $cookies = explode(';', $_SERVER['HTTP_COOKIE']);

    foreach($cookies as $cookie) {
       $parts = explode('=', $cookie);
        $name = trim($parts[0]);



		if(($name != $cookiename) && ($name != $limitcookiename) && ($name != "WRUID") && ($name != "rayku_frontend") && ($name != "ratingExpertId") && ($name != "ratingUserId") && ($name != "timer") && ($name != "practice_name") && ($name != "rEmail") && ($name != "rPassword")) :


  			$this->getResponse()->setCookie($name, "", time()-3600);



		endif;
    }

}



if(!empty($_POST)) {



if(empty($_POST["rating"])) {

$this->redirect('http://www.rayku.com/dashboard/rating');

}


		if(!empty($_COOKIE['raykuCharge'])) {

			$rate = $_COOKIE['raykuCharge'];

		} else {

			$queryRPRate = mysql_query("select * from user_rate where userid=".$_COOKIE["ratingExpertId"]." ") or die(mysql_error());

			if(mysql_num_rows($queryRPRate)) {

				$rowRPRate = mysql_fetch_assoc($queryRPRate); 
			
				$rate = $rowRPRate['rate'];


			} else {

				$rate = '0.16';

			}

	      }
 

$timer = explode(":", $_COOKIE["timer"]);


$newTimer = (($timer[0]*3600)+($timer[1]*60)) / 60;

$raykuPercentage = $newTimer * $rate;

$_chat_rating = $_POST["rating"];

$date = date('Y-m-d H:i:s');




	$queryScore = mysql_query("select * from user_score where user_id=".$_COOKIE["ratingExpertId"]) or die(mysql_error());
	$rowScore = mysql_fetch_assoc($queryScore);

	$queryAsker = mysql_query("select * from user where id=".$_COOKIE["ratingUserId"]) or die(mysql_error());
	$rowAsker = mysql_fetch_assoc($queryAsker);

	$queryExpert = mysql_query("select * from user where id=".$_COOKIE["ratingExpertId"]) or die(mysql_error());
	$rowExpert = mysql_fetch_assoc($queryExpert);

	$queryKinkarso = mysql_query("select * from user where id=124") or die(mysql_error());
	$rowKinkarso = mysql_fetch_assoc($queryKinkarso);



	if($_POST["rating"] == 1) {

		$newRatingScore = $rowScore['score'] - 20;

		mysql_query("update user_score set score = ".$newRatingScore." where user_id=".$_COOKIE["ratingExpertId"]) or die(mysql_error());

		$kinkarsoPoints = $rowKinkarso["points"] + $raykuPercentage;

		mysql_query("update user set points = ".$kinkarsoPoints." where id=124") or die(mysql_error());

		mysql_query("insert into kinkarso_points(user_id, expert_id, points, date) values(".$_COOKIE["ratingUserId"].", ".$_COOKIE["ratingExpertId"].", ".$raykuPercentage.", '".$date."')") or die(mysql_error());

	

	}  elseif($_POST["rating"] == 2) {


		$askerPoints = $rowAsker["points"] - $raykuPercentage;

		mysql_query("update user set points = ".$askerPoints." where id=".$_COOKIE["ratingUserId"]) or die(mysql_error());

		$expertPer = ($raykuPercentage * 25) / 100;

		$kinkarsoPer = ($raykuPercentage * 75) / 100;

		$expertPoints = $rowExpert["points"] + $expertPer;

		$kinkarsoPoints = $rowKinkarso["points"] + $kinkarsoPer;

		mysql_query("update user set points = ".$expertPoints." where id=".$_COOKIE["ratingExpertId"]) or die(mysql_error());

		mysql_query("update user set points = ".$kinkarsoPoints." where id=124") or die(mysql_error());

		mysql_query("insert into kinkarso_points(user_id, expert_id, points, date) values(".$_COOKIE["ratingUserId"].", ".$_COOKIE["ratingExpertId"].", ".$kinkarsoPer.", '".$date."')") or die(mysql_error());




	} elseif($_POST["rating"] == 3) {

		$_Score = 0;

		if($newTimer > 10) :

			$_Score = 10;

		elseif($newTimer <= 10 && $newTimer >= 2) :

			$_Score = 4;
		
		endif;

			$newRatingScore = $rowScore['score'] + 6 + $_Score;


		mysql_query("update user_score  set score = ".$newRatingScore." where user_id=".$_COOKIE["ratingExpertId"]) or die(mysql_error());

		$askerPoints = $rowAsker["points"] - $raykuPercentage;

		mysql_query("update user set points = ".$askerPoints." where id=".$_COOKIE["ratingUserId"]) or die(mysql_error());

		$expertPer = ($raykuPercentage * 50) / 100;

		$kinkarsoPer = ($raykuPercentage * 50) / 100;

		$expertPoints = $rowExpert["points"] + $expertPer;

		$kinkarsoPoints = $rowKinkarso["points"] + $kinkarsoPer;

		mysql_query("update user set points = ".$expertPoints." where id=".$_COOKIE["ratingExpertId"]) or die(mysql_error());

		mysql_query("update user set points = ".$kinkarsoPoints." where id=124") or die(mysql_error());

		mysql_query("insert into kinkarso_points(user_id, expert_id, points, date) values(".$_COOKIE["ratingUserId"].", ".$_COOKIE["ratingExpertId"].", ".$kinkarsoPer.", '".$date."')") or die(mysql_error());




	} elseif($_POST["rating"] == 4) {

		$_Score = 0;

		if($newTimer > 10) :

			$_Score = 18;

		elseif($newTimer <= 10 && $newTimer >= 2) :

			$_Score = 7;
		
		endif;

			$newRatingScore = $rowScore['score'] + 12 + $_Score;


		mysql_query("update user_score  set score = ".$newRatingScore." where user_id=".$_COOKIE["ratingExpertId"]) or die(mysql_error());

		$askerPoints = $rowAsker["points"] - $raykuPercentage;

		mysql_query("update user set points = ".$askerPoints." where id=".$_COOKIE["ratingUserId"]) or die(mysql_error());

		$expertPer = ($raykuPercentage * 60) / 100;

		$kinkarsoPer = ($raykuPercentage * 40) / 100;

		$expertPoints = $rowExpert["points"] + $expertPer;

		$kinkarsoPoints = $rowKinkarso["points"] + $kinkarsoPer;

		mysql_query("update user set points = ".$expertPoints." where id=".$_COOKIE["ratingExpertId"]) or die(mysql_error());

		mysql_query("update user set points = ".$kinkarsoPoints." where id=124") or die(mysql_error());

		mysql_query("insert into kinkarso_points(user_id, expert_id, points, date) values(".$_COOKIE["ratingUserId"].", ".$_COOKIE["ratingExpertId"].", ".$kinkarsoPer.", '".$date."')") or die(mysql_error());

	

	} elseif($_POST["rating"] == 5) {

		$ratingScore = !empty($rowScore['score']) ? $rowScore['score'] : 0 ;

		$askerPoints = $rowAsker["points"] - $raykuPercentage;

		mysql_query("update user set points = ".$askerPoints." where id=".$_COOKIE["ratingUserId"]) or die(mysql_error());

		if($ratingScore >= 1000 ) { // Honour Tutor

			$expertPer = ($raykuPercentage * 75) / 100;

			$kinkarsoPer = ($raykuPercentage * 25) / 100;

		} else { // Normal Tutor

			$expertPer = ($raykuPercentage * 70) / 100;

			$kinkarsoPer = ($raykuPercentage * 30) / 100;

			
		}

		$expertPoints = $rowExpert["points"] + $expertPer;

		$kinkarsoPoints = $rowKinkarso["points"] + $kinkarsoPer;

		mysql_query("update user set points = ".$expertPoints." where id=".$_COOKIE["ratingExpertId"]) or die(mysql_error());

		mysql_query("update user set points = ".$kinkarsoPoints." where id=124") or die(mysql_error());

		mysql_query("insert into kinkarso_points(user_id, expert_id, points, date) values(".$_COOKIE["ratingUserId"].", ".$_COOKIE["ratingExpertId"].", ".$kinkarsoPer.", '".$date."')") or die(mysql_error());

		$_Score = 0;

		if($newTimer > 10) :

			$_Score = 25;

		elseif($newTimer <= 10 && $newTimer >= 2) :

			$_Score = 10;
		
		endif;

			$newRatingScore = $rowScore['score'] + 18 + $_Score;

		mysql_query("update user_score  set score = ".$newRatingScore." where user_id=".$_COOKIE["ratingExpertId"]) or die(mysql_error());



	} 


  // follow to this expert
  if(isset($_POST["checkbox"]) && !empty($_POST["checkbox"])) {


    if(!empty($_COOKIE["ratingExpertId"]) && !empty($_COOKIE["ratingUserId"])) {

  	  $query = mysql_query("select * from expert_subscribers where expert_id = ".$_COOKIE["ratingExpertId"]." and user_id =".$_COOKIE["ratingUserId"]) or die(mysql_error());

      if(mysql_num_rows($query) == 0) {

  		  mysql_query("insert into expert_subscribers(expert_id, user_id) values('".$_COOKIE["ratingExpertId"]."', '".$_COOKIE["ratingUserId"]."')") or die(mysql_error());

					$queryScore = mysql_query("select * from user_score where user_id =".$_COOKIE["ratingExpertId"]) or die(mysql_error());
					$rowScore = mysql_fetch_assoc($queryScore);
					$newScore = '';

					$newScore = $rowScore['score'] + 10;

					mysql_query("update user_score set score = ".$newScore." where user_id =".$_COOKIE["ratingExpertId"]) or die(mysql_error());

  		}
    }
  }

  // public session?

 
if(!empty($_COOKIE["whiteboardChatId"]) && !empty($_COOKIE["whiteboardChatId"])) {

 $chatId = $_COOKIE["whiteboardChatId"];

$_SESSION["whiteboard_Chat_Id"] = $_COOKIE["whiteboardChatId"];

	 if(isset($_POST["chkIsPublic"]) && !empty($_POST["chkIsPublic"])) {
	      // chat query
	          $criteria = new Criteria();
	  	  $criteria->add(WhiteboardChatPeer::ID, $chatId);
	      $chat = WhiteboardChatPeer::doSelectOne($criteria);

	      if ($chat) {
	        $chat->setIsPublic(true);
	        $chat->save();
	      }
	}

	$_comments = !empty($_POST['content'])?$_POST['content']:'';

	$_chat_query = mysql_query("select * from whiteboard_chat where id=".$chatId."") or("Error In Select".mysql_error());

	 if(mysql_num_rows($_chat_query) > 0) {


		$_chat_row = mysql_fetch_assoc($_chat_query);

	mysql_query("update whiteboard_chat set timer = '".$newTimer."', rating = ".$_chat_rating.", amount=".$raykuPercentage.", comments = '".$_comments."' where id=".$chatId." ") or die(mysql_error());

		//$_chat_rating //$raykuPercentage //$expertPer

	 }


}


$this->getResponse()->setCookie("timer", "", time()-3600);
  $this->getResponse()->setCookie("whiteboardChatId", "", time()-3600);
  $this->getResponse()->setCookie("ratingExpertId", "", time()-3600);
  $this->getResponse()->setCookie("ratingUserId", "", time()-3600);


	if($_chat_rating == 1 || $_chat_rating == 2) {

		$this->redirect('http://www.rayku.com/dashboard/moneyback');

	}

  $this->redirect('http://www.rayku.com/dashboard');
}
}




}
