<?php
/**
 * expertmanager actions.
 *
 * @package    elifes
 * @subpackage expertmanager
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
 
 
class expertmanagerActions extends sfActions
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


   $this->expert = UserPeer::retrieveByPk($this->getUser()->getRaykuUserId());

	$c = new Criteria();
	$c->add(ExpertCategoryPeer::USER_ID, $this->getUser()->getRaykuUserId());
	$this->expert_categories = ExpertCategoryPeer::doSelect($c);
  	$this->questions = ForumQuestionPeer::doSelect(new Criteria());

	$c = new Criteria();
	$c->add(ExpertPeer::USER_ID, $this->getUser()->getRaykuUserId());
	$this->expert_info = ExpertPeer::doSelectOne($c);	
	
	
	$c=new Criteria();
	$c->add(ExpertLessonPeer::USER_ID,$this->getUser()->getRaykuUserId());
	$this->lessons=ExpertLessonPeer::doSelect($c);
	
	$c=new Criteria();
	$c->add(ExpertsImmediateLessonPeer::USER_ID,$this->getUser()->getRaykuUserId());
	$this->immlessons=ExpertsImmediateLessonPeer::doSelect($c);
	
	$c=new Criteria();
	$c->add(ExpertLessonSchedulePeer::USER_ID,$this->getUser()->getRaykuUserId());
	$this->monthschedules=ExpertLessonSchedulePeer::doSelect($c); 
	
	$c = new Criteria();
	$c->add(ExpertLessonSchedulePeer::USER_ID,$this->getUser()->getRaykuUserId());
	$this->lessondates = ExpertLessonSchedulePeer::doSelect($c); 
	
	$c = new Criteria();
	$c->add(ExpertAvailableDaysPeer::EXPERT_ID,$this->getUser()->getRaykuUserId());
	$this->lessondays = ExpertAvailableDaysPeer::doSelect($c);
	
	$c=new Criteria();
	$c->addJoin(ThreadPeer::CATEGORY_ID,ExpertCategoryPeer::CATEGORY_ID,Criteria::JOIN);
	$c->add(ExpertCategoryPeer::USER_ID,$this->getUser()->getRaykuUserId());
	$c->addDescendingOrderByColumn('ID');
	$this->questions=ThreadPeer::doSelect($c);
	
	
  }
  
  public function executePortfolio()
  {



//print_r($_SESSION);

//unset($_SESSION["modelPopupOpen"]);

    if(!empty($_COOKIE["timer"])) : 
	    $this->redirect('/dashboard/rating');
    endif; 

		$con = mysql_connect("localhost", "rayku_db", "db_*$%$%");
    $db = mysql_select_db("rayku_db", $con);

	  $name = explode("/", $_SERVER['REQUEST_URI']);
	  
	  $query = mysql_query("select * from user where username='".$name[3]."' ") or die(mysql_error());
	  $row = mysql_fetch_array($query);

	  $this->expert = UserPeer::retrieveByPk($row['id']);
	
	  $expertId = $row['id'];
	  $userId = $this->getUser()->getRaykuUserId();
    
    // last n whiteboard sessions    
    $cLastSessions = new Criteria();
    
    if ($userId != $expertId) {
  	  $cPublicA = $cLastSessions->getNewCriterion(WhiteboardChatPeer::EXPERT_ID, $expertId);
  	  $cPublicB = $cLastSessions->getNewCriterion(WhiteboardChatPeer::IS_PUBLIC, true);
  	  $cPublicC = $cLastSessions->getNewCriterion(WhiteboardChatPeer::ASKER_ID, $userId);
      $cPublicB->addOr($cPublicC);
      $cPublicA->addAnd($cPublicB);
    } else {
	    $cPublicA = $cLastSessions->getNewCriterion(WhiteboardChatPeer::EXPERT_ID, $userId);
	    $cPublicB = $cLastSessions->getNewCriterion(WhiteboardChatPeer::ASKER_ID, $userId);
      $cPublicA->addOr($cPublicB);
    } 
    
    $cLastSessions->add($cPublicA);
    $cLastSessions->add(WhiteboardChatPeer::STARTED_AT, null, Criteria::ISNOTNULL);
    $cLastSessions->addDescendingOrderByColumn(WhiteboardChatPeer::ID);
    $cLastSessions->setLimit(3);
    $this->lastSessions = WhiteboardChatPeer::doSelect($cLastSessions);


  }
  
  public function executeTransfer()
  {
  
	
  }
  
  public function executeTutorial()
  {
  
  }

  public function executeDirect()
  {

		$con = mysql_connect("localhost", "rayku_db", "db_*$%$%");
		$db = mysql_select_db("rayku_db", $con);

$logedUserId = $_SESSION['symfony/user/sfUser/attributes']['symfony/user/sfUser/attributes']['user_id'];

$currentUser = $this->getUser()->getRaykuUser();

$userId = $currentUser->getId();

$time = time();

mysql_query("INSERT INTO `user_expert` (`user_id`, `checked_id`, `category_id`, `question`, `exe_order`, `time`, `status`) VALUES ('".$userId."', '".$_GET['id']."', '5', 'To be discussed', 1, '".$time."', 1) ") or die(mysql_error());

				//$this->getResponse()->setCookie("asker_que", 'To be discussed',time()+600);

				setcookie("asker_que",'To be discussed', time()+600, "/");

				$this->getResponse()->setCookie("redirection", 1,time()+600);

				$this->getResponse()->setCookie("forumsub", 5,time()+600);

$this->redirect("http://www.rayku.com/expertmanager/connect");


	
  }

  public function executeStatus()
  {

		$con = mysql_connect("localhost", "rayku_db", "db_*$%$%");
		$db = mysql_select_db("rayku_db", $con);

		
		$_status_id = $_GET['id'];

		$_queryStatus = mysql_query("select * from user_expert where id=".$_status_id." ") or die(mysql_error());

		  if(mysql_num_rows($_queryStatus)) {


			mysql_query("update user_expert set status = 0 where id=".$_status_id." ") or die(mysql_error());

			echo "status updated";

		  } 

	   $this->redirect('http://www.rayku.com/dashboard');



	
  }




  
  public function executeCheckout()
  {
  		
		$this->expert_id = $this->getRequestParameter('expert_id');
		$this->expert_lesson_id = $this->getRequestParameter('expert_lesson_id');
		
		$date = mktime(0,0,0,date('m'),date('d'),date('Y'));
		
		$c= new Criteria();
		$c->add(ExpertLessonPeer::ID,$this->expert_lesson_id);
		$this->expert_lesson=ExpertLessonPeer::doSelectOne($c);
		
		$c=new Criteria();
		$c->add(ExpertLessonSchedulePeer::USER_ID,$this->expert_id);
		$c->add(ExpertLessonSchedulePeer::DATE,$date,Criteria::GREATER_EQUAL);
		$c->addAscendingOrderByColumn(ExpertLessonSchedulePeer::DATE);
		$this->lesson_shedules=ExpertLessonSchedulePeer::doSelect($c); 
		
			
		$c = new Criteria();
		$c->add(ExpertAvailableDaysPeer::EXPERT_ID,$this->expert_id);
		$this->lessondays = ExpertAvailableDaysPeer::doSelect($c);
		

 }
 public function executeImmediate()
  {
  		
	
		$this->expert_id = $this->getRequestParameter('expert_id');
		$this->expert_immediate_lesson_id = $this->getRequestParameter('expert_immediate_lesson_id');
		
		$c= new Criteria();
		$c->add(ExpertsImmediateLessonPeer::ID,$this->expert_immediate_lesson_id);
		$this->expert_lesson=ExpertsImmediateLessonPeer::doSelectOne($c);
		

 }
 
 public function executeHistory()
  {
  	
		$this->less_id= $this->getrequestParameter('less_id') ;
		
		$c=new Criteria();
		$c->add(ExpertLessonPeer::ID,$this->getrequestParameter('less_id'));
		$this->lesson=ExpertLessonPeer::doSelectOne($c);
		
				
		$c= new Criteria();
		$c->add(ExpertLessonPeer::ID,$this->getrequestParameter('less_id'));
		$this->expert_lesson=ExpertLessonPeer::doSelectOne($c);
		
		$c=new Criteria();
		$c->add(ExpertLessonSchedulePeer::EXPERT_LESSON_ID,$this->getrequestParameter('less_id'));
		$this->lesson_shedules=ExpertLessonSchedulePeer::doSelect($c);
		
 }
 
   public function executeWhiteboard()
  {



  }


  public function executeClose()
  {

		$con = mysql_connect("localhost", "rayku_db", "db_*$%$%");
		$db = mysql_select_db("rayku_db", $con);

		$currentUser = $this->getUser()->getRaykuUser();

		$userId = $currentUser->getId();



		$logedUserId = $_SESSION['symfony/user/sfUser/attributes']['symfony/user/sfUser/attributes']['user_id'];

		mysql_query("insert into popup_close(user_id) values(".$userId.")") or die(mysql_error());


		$this->redirect('http://www.rayku.com/dashboard');

  }


  public function executeAnswer()
  {
	  $con = mysql_connect("localhost", "rayku_db", "db_*$%$%");
		$db = mysql_select_db("rayku_db", $con);
		$logedUserId = $_SESSION['symfony/user/sfUser/attributes']['symfony/user/sfUser/attributes']['user_id'];

    $currentUser = $this->getUser()->getRaykuUser();
    $userId = $currentUser->getId();
    $time = time();

		$_SESSION["_modelbox"] = 0;

		@setcookie('_popupclose', '', time()-300, '/', null);

		if($_SESSION['modelPopupOpen']) :

			unset($_SESSION['modelPopupOpen']);

			if($_SESSION['popup_session']) :

				unset($_SESSION['popup_session']);
			endif;

		endif;
    
    $details =  explode(",", $_REQUEST['details']);
    
	  if( count($details) > 4 ) {

		$_record_id = $details[6];

		$_queryRecord = mysql_query("select * from user_expert where id=".$_record_id." ") or die(mysql_error());

		  if(mysql_num_rows($_queryRecord)) {

	    $newId = $details[6] + 1;
	    $asker = UserPeer::retrieveByPK($details[1]);
      setCookie("question", urlencode($details[2]), time()+3600, '/', "rayku.com");
			$this->getResponse()->setCookie("askerid", $details[1],time()+3600);
			$this->getResponse()->setCookie("askerUsername", $asker->getUsername(), time()+3600);
			$this->getResponse()->setCookie("expertid", $details[0],time()+3600);

			$this->getResponse()->setCookie("check_nick", $asker->getName(), time()+3600);
			
      
      $name =  str_replace(" ","", $details[7]);
	    $this->getResponse()->setCookie("loginname", $name,time()+3600);
			$query = mysql_query("select * from user_expert where id=".$details[6]." and user_id=".$details[1]) or die(mysql_error());

			if(mysql_num_rows($query) > 0) {

				$row = mysql_fetch_array($query);

				setcookie("asker_que",$row['question'], time()+600, "/");

				 	
			}

			mysql_query("delete from user_expert where user_id=".$details[1]) or die(mysql_error());

			    // redirect to rayku whiteboard
			    $this->redirect("http://www.rayku.com:8001/");

		} else {

			    // redirect to rayku dashboard
    			 $this->redirect("http://www.rayku.com/login/answer");

		}

     
	  } else {


		$_record_id = $details[0];

		$_queryRecord = mysql_query("select * from sendmessage where id=".$_record_id." ") or die(mysql_error());

		  if(mysql_num_rows($_queryRecord)) {

				  $query = mysql_query("select * from sendmessage where id=".$details[0]) or die("error1".mysql_error());
					$row = mysql_fetch_array($query);

				  $queryUser = mysql_query("select * from user where id=".$userId." ") or die("error2".mysql_error());
					$rowUser = mysql_fetch_array($queryUser);
			    
			    $this->getResponse()->setCookie("ratingExpertId", $row['expert_id'],time()+3600);
					$this->getResponse()->setCookie("ratingUserId", $row['asker_id'],time()+3600);

					$queryRPRate = mysql_query("select * from user_rate where userid=".$row['expert_id']." ") or die(mysql_error());

				  if(mysql_num_rows($queryRPRate)) {
				    
					  $rowRPRate = mysql_fetch_assoc($queryRPRate); 
						$raykuCharge = $rowRPRate['rate'];
		
				  } else {
		
				    $raykuCharge = '0.16';
		
				  }

					$this->getResponse()->setCookie("raykuCharge", $raykuCharge,time()+3600);

			    $a=new Criteria();
			    $a->add(UserPeer::ID, $logedUserId);
			    $asker=UserPeer::doSelectOne($a);

				  $this->getResponse()->setCookie("askerpoints", $rowUser['points'],time()+3600);
				  $this->getResponse()->setCookie("newredirect", 1,time()+100);
					$this->getResponse()->setCookie("redirection", "",time()-600);
					$this->getResponse()->setCookie("forumsub", "",time()-600);

					$name =  str_replace(" ","", $rowUser['name']);
		    			  $this->getResponse()->setCookie("loginname", $name,time()+3600);

					  $this->getResponse()->setCookie("check_nick", $name, time()+3600);
					$this->getResponse()->setCookie("chatid", $details[1],time()+3600);
		      
			    $cookiename = $logedUserId."_question";

					if(!empty($_COOKIE[$cookiename])) {
					  
					  $value = $_COOKIE[$cookiename] + 1;
						$expire = time()+60*60*24*30;
						$this->getResponse()->setCookie($cookiename, $value, $expire);
			
					} else {
					  
					  $expire = time()+60*60*24*30;
						$this->getResponse()->setCookie($cookiename, 1, $expire);

					}
			
					if(!empty($userId)) {
			
					  mysql_query("insert into popup_close(user_id) values(".$userId.")") or die("error3".mysql_error());
			
					}

				  if(!empty($details[0])) {			
					  mysql_query("delete from sendmessage where id=".$details[0]) or die("error4".mysql_error());		  
				  }

			    // redirect to rayku whiteboard
			    $this->redirect("http://www.rayku.com:8001/");

		} else {

			// redirect to rayku dashboard
    			 $this->redirect("http://www.rayku.com/dashboard");


		}
   	 }
    

  }

 public function executeCookieadd()
 {	

	$userId = $this->getUser()->getRaykuUser()->getId();

	 	 $con = mysql_connect("localhost", "rayku_db", "db_*$%$%");
		$db = mysql_select_db("rayku_db", $con);

	mysql_query("delete from user_question where user_id=".$userId) or die(mysql_error());

	if($_GET['cookie'] == 0):

		$this->getResponse()->setCookie("popup_close", '', time()-300);

	else :

		if(empty($_COOKIE['popup_close'])) {
	
			$this->getResponse()->setCookie("popup_close", $_GET['cookie'], time()+300);

		}

	endif;



 }

 public function executeTopic()
 {	


	$con = mysql_connect("localhost", "rayku_db", "db_*$%$%");
	$db = mysql_select_db("rayku_db", $con);

	$currentUser = $this->getUser()->getRaykuUser();

	$userId = $currentUser->getId();

	$_query = mysql_query("select * from user_question where status = 1 and user_id=".$userId) or die(mysql_error());

	if(mysql_num_rows($_query) > 0) :

		echo "yes";

	else :

		echo "no";

	endif;
exit(0);


  }


  public function executeIgnore()
  {

	$con = mysql_connect("localhost", "rayku_db", "db_*$%$%");
	$db = mysql_select_db("rayku_db", $con);

$currentUser = $this->getUser()->getRaykuUser();

$userId = $currentUser->getId();

		$_SESSION["_modelbox"] = 0;

		@setcookie('_popupclose', '', time()-300, '/', null);

	if($_SESSION['modelPopupOpen']) :

			unset($_SESSION['modelPopupOpen']);

			if($_SESSION['popup_session']) :

				unset($_SESSION['popup_session']);
			endif;

	endif;

		$logedUserId = $_SESSION['symfony/user/sfUser/attributes']['symfony/user/sfUser/attributes']['user_id'];

$details =  explode(",", $_REQUEST['details']);



		if(count($details) > 2 ) {

						$newId = $details[6] + 1; 

						$query = mysql_query("select * from user_expert where id=".$newId." and user_id=".$details[1]) or die(mysql_error());

							if(mysql_num_rows($query) > 0) {
	
						mysql_query("update user_expert set exe_order = 1 where id=".$newId) or die(mysql_error());
		
							}

						mysql_query("delete from user_expert where id=".$details[6]) or die(mysql_error());


						/* Expert Socre - Reduction */
						$queryScore = mysql_query("select * from user_score where user_id=".$userId) or die(mysql_error());

						if(mysql_num_rows($queryScore) > 0) {

							$rowScore = mysql_fetch_assoc($queryScore);
							$newRatingScore = $rowScore['score'] - 3;
							mysql_query("update user_score set score = ".$newRatingScore." where user_id=".$userId) or die(mysql_error());

						}

						/* Expert Socre - Reduction */

					} else {


						mysql_query("delete from sendmessage where id=".$_REQUEST['details']) or die(mysql_error());


					}

echo "close";
	//$this->redirect('http://www.rayku.com/dashboard');

	
}

  public function executeAuto()
  {

	$con = mysql_connect("localhost", "rayku_db", "db_*$%$%");
	$db = mysql_select_db("rayku_db", $con);

$currentUser = $this->getUser()->getRaykuUser();

$userId = $currentUser->getId();

	$_SESSION["_modelbox"] = 0;

	@setcookie('_popupclose', '', time()-300, '/', null);

	if($_SESSION['modelPopupOpen']) :

			unset($_SESSION['modelPopupOpen']);

			if($_SESSION['popup_session']) :

				unset($_SESSION['popup_session']);
			endif;

	endif;

		$logedUserId = $_SESSION['symfony/user/sfUser/attributes']['symfony/user/sfUser/attributes']['user_id'];

$details =  explode(",", $_REQUEST['details']);



		if(count($details) > 2 ) {

						$newId = $details[6] + 1; 

				$queryCheck = mysql_query("select * from user_expert where id=".$details[6]." ") or die(mysql_error());
				if(mysql_num_rows($queryCheck) > 0) {

							$query = mysql_query("select * from user_expert where id=".$newId." and user_id=".$details[1]) or die(mysql_error());

								if(mysql_num_rows($query) > 0) {
	
							mysql_query("update user_expert set exe_order = 1 where id=".$newId) or die(mysql_error());
		
								}

							mysql_query("delete from user_expert where id=".$details[6]) or die(mysql_error());

						/* Expert Socre - Reduction */
						$queryScore = mysql_query("select * from user_score where user_id=".$userId) or die(mysql_error());

						if(mysql_num_rows($queryScore) > 0) {

							$rowScore = mysql_fetch_assoc($queryScore);
							$newRatingScore = $rowScore['score'] - 3;
							mysql_query("update user_score set score = ".$newRatingScore." where user_id=".$userId) or die(mysql_error());

						}

						/* Expert Socre - Reduction */

					
			
								$time = time();

								mysql_query("insert into user_question(user_id, status, time) values(".$details[0].", 1,'".$time."')");
				}
		

					} else {


						mysql_query("delete from sendmessage where id=".$_REQUEST['details']) or die(mysql_error());


					}

echo "close";
	//$this->redirect('http://www.rayku.com/dashboard');

	
}

  public function executeCookie()
  {

	$this->getResponse()->setCookie("_post_id", $_GET['id'],time()+300);

	echo "cookie set";

	   	
		
}


 public function executeRedirect()
 {	 
					$con = mysql_connect("localhost", "rayku_db", "db_*$%$%");
		                        $db = mysql_select_db("rayku_db", $con);

	$logedUserId = $_SESSION['symfony/user/sfUser/attributes']['symfony/user/sfUser/attributes']['user_id'];

$currentUser = $this->getUser()->getRaykuUser();

$userId = $currentUser->getId();

	$query = mysql_query("select * from user_expert where user_id=".$userId) or die(mysql_error());

	if(mysql_num_rows($query) == 0) {
			

			 if(empty($_COOKIE["newredirect"]) && $_COOKIE["newredirect"] != 1) {

				 	 $redirectvalue = "redirect";

			}  

		echo $redirectvalue;


	}



	$this->redirect('http://www.rayku.com/dashboard');

}



 
 public function executeMapuser()
 {	 
   $con = mysql_connect("localhost", "rayku_db", "db_*$%$%");
	 $db = mysql_select_db("rayku_db", $con);


		if($_SESSION['modelPopupOpen']) :

			if($_SESSION['popup_session']) {

				$_now = time(); 

				$_remain_time = $_now - $_SESSION['popup_session'];

				if($_remain_time < 20) {

					echo "redirect";

					$this->redirect('http://www.rayku.com/dashboard');

				}

			} else {

				echo "redirect";

				$this->redirect('http://www.rayku.com/dashboard');

			}



		endif;



	 $logedUserId = $_SESSION['symfony/user/sfUser/attributes']['symfony/user/sfUser/attributes']['user_id'];

   $currentUser = $this->getUser()->getRaykuUser();

   $userId = $currentUser->getId();

   $time = time()-300;

	 $gtalkquery = mysql_query("select * from user_gtalk where userid=".$userId) or die(mysql_error());

	 if(mysql_num_rows($gtalkquery) > 0) {
	   
     $status = mysql_fetch_assoc($gtalkquery);
		 $gtalkmail = $status['gtalkid'];
		 $onlinecheck = file_get_contents('http://www.rayku.com:8892/status/'.$gtalkmail);
	 
	 } else {
	   
		 $onlinecheck = '';
	 }
// and status = 1

	 $query = mysql_query("select * from user_expert where checked_id=".$userId." and exe_order = 1 and time >= ".$time."") or die(mysql_error());

	 //if(mysql_num_rows($query) > 0 && $onlinecheck != "online") {

 	if(mysql_num_rows($query) > 0) {



		//$_SESSION['modelPopupOpen'] = 1;
		//$_SESSION['popup_session'] = time();

		

     $row = mysql_fetch_assoc($query);

		 $categories = CategoryPeer::doSelect(new Criteria()); 

	   foreach( $categories as $category): 
	      if($row['category_id'] == $category->getId()) :
		      $subject = $category->getName();
	      endif;						
     endforeach; 

     $c=new Criteria();
		 $c->add(UserPeer::ID,$row['user_id']);
		 $user = UserPeer::doSelectOne($c);
	   $mail = explode("@", $user->getEmail());	     
	   $newMail = explode(".", $mail[1]);
						
	   if($newMail[0] == "utoronto") { 
		 
		   $school = "University of Toronto";
	   
	   } else if($newMail[1] == "ubc") {
		 
		   $school = "University of Ubc";
		 
		 }

     // question
	   $length = strlen(trim($row['question']));

	   if($length <= 200) {
       $question = $row['question'];
	   } else {
       $question = substr(trim($row['question']), 0, 200);
	   }

		 $queryUser = mysql_query("select * from user_course where user_id=".$row['user_id']." and course_subject=".$row['category_id']) or die(mysql_error());
		 $rowUser = mysql_fetch_array($queryUser);
				
		 $x=new Criteria();
		 $x->add(UserPeer::ID,$row['checked_id']);
		 $newloginId = UserPeer::doSelectOne($x);
		 $queryRPRate = mysql_query("select * from user_rate where userid=".$userId." ") or die(mysql_error());

	   if(mysql_num_rows($queryRPRate)) {
		   $rowRPRate = mysql_fetch_assoc($queryRPRate); 
			 $raykuCharge = $rowRPRate['rate'];
	   } else {
		   $raykuCharge = '0.16';
		 }

		mysql_query("update user_expert set status = 0 where id=".$row['id']." ") or die(mysql_error());


	$HTTP_USER_AGENT=$_SERVER['HTTP_USER_AGENT'];

	$browser="others"; 

	if (eregi ("(Chrome/)", $HTTP_USER_AGENT)==true) $browser="chrome";
	if (eregi ("(Safari/)", $HTTP_USER_AGENT)==true) $browser="safari";



	$_SESSION["_modelbox"] = $_SESSION["_modelbox"] + 1;

	@setcookie('_popupclose', 1, time()+300, '/', null);



     echo $row['checked_id']."-".$row['user_id']."-".$question."-".$school."-".$subject."-".$rowUser['course_year']."-".$row['id']."-".$newloginId->getName()."-expert"."-".$raykuCharge."-".$row['close']."-".$browser."-".$_SESSION["_modelbox"];



   } 

exit(0);
   //$this->redirect('http://www.rayku.com/dashboard');
 }


public function executeMapmsguser()
 {	 
   $con = mysql_connect("localhost", "rayku_db", "db_*$%$%");
	 $db = mysql_select_db("rayku_db", $con);


		if($_SESSION['modelPopupOpen']) :

			if($_SESSION['popup_session']) {

				$_now = time(); 

				$_remain_time = $_now - $_SESSION['popup_session'];

				if($_remain_time < 20) {

					echo "redirect";

					$this->redirect('http://www.rayku.com/dashboard');

				}

			} else {

				echo "redirect";

				$this->redirect('http://www.rayku.com/dashboard');

			}



		endif;



	 $logedUserId = $_SESSION['symfony/user/sfUser/attributes']['symfony/user/sfUser/attributes']['user_id'];

   $currentUser = $this->getUser()->getRaykuUser();

   $userId = $currentUser->getId();

   $time = time()-300;


 if(!empty($_COOKIE['redirection']) && $_COOKIE['redirection'] == 1) {


	   $query = mysql_query("select * from sendmessage where asker_id=".$userId." and time >= ".$time."") or die(mysql_error());

		 if(mysql_num_rows($query) > 0) {

				$_SESSION['modelPopupOpen'] = 1;

				$_SESSION['popup_session'] = time();

	     $row = mysql_fetch_array($query);

		   echo "msg-".$row['id']."-".$row['expert_id']."-".$row['asker_id']."-".$row['chat_id'];
	   } 
   }

exit(0);

 }

 
  public function executeList()
  {





					$con = mysql_connect("localhost", "rayku_db", "db_*$%$%");
		                        $db = mysql_select_db("rayku_db", $con);



	$logedUserId = $_SESSION['symfony/user/sfUser/attributes']['symfony/user/sfUser/attributes']['user_id'];

$currentUser = $this->getUser()->getRaykuUser();

$userId = $currentUser->getId();

$time = time();


if(!empty($_POST['hidden'])) {




$count = count($_POST['checkbox']);

	if($count > 2) {

		$close = 21000;

	} else if($count == 2) {

		$close = 31000;

	} else if($count == 1) {

		$close = 61000;

	} 

$j = 0;
	for($i=0; $i < $count; $i++) {



mysql_query("INSERT INTO `user_expert` (`user_id`, `checked_id`, `category_id`, `question`, `exe_order`, `time`, status, close) VALUES ('".$userId."', '".$_POST['checkbox'][$i]."', '".$_SESSION['subject']."', '".$_SESSION['question']."','".(++$j)."', '".$time."', 1, ".$close.") ") or die(mysql_error());

	}

				

				setcookie("asker_que",$_SESSION['question'], time()+600, "/");

				$this->getResponse()->setCookie("redirection", 1,time()+600);

				$this->getResponse()->setCookie("forumsub", $_SESSION['subject'],time()+600);




	$this->redirect('expertmanager/connect');

}

 

		$this->cat = $this->getRequestParameter('category');

		if(empty($this->cat))
			{
			
					$this->cat = $_SESSION['subject'];
					
			} else {
					$_SESSION['subject'] = $this->cat;
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

									$dv=new Criteria();
									$dv->add(UserPeer::ID,$exp->getUserId());
									$_thisUser = UserPeer::doSelectOne($dv);
	
									$newUser[$i] = array("score" => $score['score'], "userid" => $exp->getUserId(), "category" => $this->cat, "createdat" => $_thisUser->getCreatedAt());

									$i++;

									}


								} else {

								$dv=new Criteria();
								$dv->add(UserPeer::ID,$exp->getUserId());
								$_thisUser = UserPeer::doSelectOne($dv);

								$newUser[$i] = array("score" => $score['score'], "userid" => $exp->getUserId(), "category" => $this->cat, "createdat" => $_thisUser->getCreatedAt());

								$i++;

								}
							endif;
		      
      						 endif; 

					endif;

				endif;	


		 endforeach; 




					 asort($newUser);  

					 arsort($newUser);
					 
			
				
					////if no online expert available redirecting to the board page
			
					
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
						
				
					 /////////////////////////////////////////////////////

if($_COOKIE["onoff"] == 1) {
		
		if(!empty($_COOKIE["school"])) {

			$cookieSchool = array(); $m =0;

			foreach($newUser as $new):
			
				 $b=new Criteria();
				 $b->add(UserPeer::ID,$new['userid']);
				 $schoolusers=UserPeer::doSelectOne($b);


				 $mail = explode("@", $schoolusers->getEmail());	     
								
				 $newMail = explode(".", $mail[1]);

$onlinecheck = '';

								if($schoolusers->isOnline()) {

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
	
										if($_user['email'] == $schoolusers->getEmail()):

											 $onlinecheck = 'online'; 		
											 break;	
										endif;

									endforeach;

								}

				 if($onlinecheck == "online" || $schoolusers->isOnline()) {
	
									
					if(($newMail[0] == $_COOKIE["school"]) || ($newMail[1] == $_COOKIE["school"])) {

							$cookieSchool[$m] = $new;
							$m++;

					}
				}
				
			 endforeach; 

			$this->expert_cats = $cookieSchool;

		} else {


				$cookieOneOn = array(); $j =0;

				foreach($newUser as $new):
			
					 $a=new Criteria();
					 $a->add(UserPeer::ID,$new['userid']);
					 $users=UserPeer::doSelectOne($a);

$onlinecheck = '';

								if($users->isOnline()) {

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
	
										if($_user['email'] == $users->getEmail()):

											 $onlinecheck = 'online'; 		
											 break;	
										endif;

									endforeach;

								}


		

					  if($onlinecheck == "online" || $users->isOnline()) {
							$cookieOneOn[$j] = $new;
							$j++;
					
					  }
				
				 endforeach; 

				$this->expert_cats = $cookieOneOn;

		}

	

} else if($_COOKIE["onoff"] == 2) {
		
		if(!empty($_COOKIE["school"])) {

			$cookieSchool = array(); $m =0;

			foreach($newUser as $new):
			
				 $b=new Criteria();
				 $b->add(UserPeer::ID,$new['userid']);
				 $schoolusers=UserPeer::doSelectOne($b);


				 $mail = explode("@", $schoolusers->getEmail());	     
								
				 $newMail = explode(".", $mail[1]);

				$onlinecheck = '';

								if($schoolusers->isOnline()) {

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
	
										if($_user['email'] == $schoolusers->getEmail()):

											 $onlinecheck = 'online'; 		
											 break;	
										endif;

									endforeach;

								}

				 if($onlinecheck != "online" && !$schoolusers->isOnline()) {
									
					if(($newMail[0] == $_COOKIE["school"]) || ($newMail[1] == $_COOKIE["school"])) {

							$cookieSchool[$m] = $new;
							$m++;

					}
				}
				
			 endforeach; 

			$this->expert_cats = $cookieSchool;

		} else {

				$cookieOneOn = array(); $j =0;

				foreach($newUser as $new):
			
					 $a=new Criteria();
					 $a->add(UserPeer::ID,$new['userid']);
					 $users=UserPeer::doSelectOne($a);

				$onlinecheck = '';

								if($users->isOnline()) {

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
	
										if($_user['email'] == $users->getEmail()):

											 $onlinecheck = 'online'; 		
											 break;	
										endif;

									endforeach;

								}



					  if($onlinecheck != "online" && !$users->isOnline()) {



							$cookieOneOn[$j] = $new;
							$j++;
					
					  }

		
				 endforeach; 

				$this->expert_cats = $cookieOneOn;

		}

	
} else {

		if(!empty($_COOKIE["school"])) {

			$cookieSchool = array(); $m =0;

			foreach($newUser as $new):
			
				 $b=new Criteria();
				 $b->add(UserPeer::ID,$new['userid']);
				 $schoolusers=UserPeer::doSelectOne($b);


				 $mail = explode("@", $schoolusers->getEmail());	     
								
				 $newMail = explode(".", $mail[1]);
									
				if(($newMail[0] == $_COOKIE["school"]) || ($newMail[1] == $_COOKIE["school"])) {

						$cookieSchool[$m] = $new;
						$m++;

				}
				
			 endforeach; 

			$this->expert_cats = $cookieSchool;

		} else {
		
				$this->expert_cats = $newUser;
		}


}


		$c=new Criteria();
	  	  $c->add(CategoryPeer::ID,$this->cat);
		$this->e=CategoryPeer::doSelectOne($c);


		

 }

  public function executeConnect()
  {


  }	

 
  public function executeReschedule()
  {
  	
		$this->less_id= $this->getrequestParameter('less_id') ;
		
		$c=new Criteria();
		$c->add(ExpertLessonPeer::ID,$this->getrequestParameter('less_id'));
		$this->lesson=ExpertLessonPeer::doSelectOne($c);
		
				
		$c= new Criteria();
		$c->add(ExpertLessonPeer::ID,$this->getrequestParameter('less_id'));
		$this->expert_lesson=ExpertLessonPeer::doSelectOne($c);
		
		$c=new Criteria();
		$c->add(ExpertLessonSchedulePeer::EXPERT_LESSON_ID,$this->getrequestParameter('less_id'));
		$this->lesson_shedules=ExpertLessonSchedulePeer::doSelect($c);
		
		if( $date = $this->getRequestParameter('date') )
		{
			$c = new Criteria();
			$c->add(ExpertLessonSchedulePeer::DATE, $this->getRequestParameter('date'));
			$c->add(ExpertLessonSchedulePeer::EXPERT_LESSON_ID,$this->getRequestParameter('less_id'));
			$check_date = ExpertLessonSchedulePeer::doSelectOne($c);
			
			// echo count($check_date) ;
					
			if(count($check_date) > 0)
			{
				$date = ExpertLessonSchedulePeer::retrieveByPk($check_date->getId());
			}else
			{
				$date = new ExpertLessonSchedule();
			}
							
			$timings = implode("|",$this->getRequestParameter('timings'));			
			
			$date->setTimings($timings);
			$date->setDate($this->getRequestParameter('date'));
			$date->setUserId($this->getUser()->getRaykuUserId());
			$date->setExpertLessonId($this->getRequestParameter('less_id'));
			
			$date->save();
			
					
					$lesson = ExpertLessonPeer::retrieveByPk($this->getRequestParameter('less_id'));
					$user=UserPeer::retrieveByPk($this->getUser()->getRaykuUserId());
			 		
					$c=new Criteria();
					$c->add(ExpertsLessonMembersPeer::LESSON_ID,$this->getRequestParameter('less_id'));
					$lesson_members=ExpertsLessonMembersPeer::doSelect();
					
					
					
					if($lesson_members !=NULL) 
					{
				
						$sub1='Lesson'.$lesson->getTitle().' has been rescheduled';
				   
				    	foreach($lesson_members as $lesson_member)
						{
						
								$student=UserPeer::retrieveByPk($lesson_member->getStudentId()); 
							
								$expert=UserPeer::retrieveByPk($lesson_member->getExpertId()); 

							
							 	$times=explode('|',$timings);
								
								$time = '';
								
								foreach($times as $timelist) {
					
									if($timelist == '0') { $time.= '00:00:00,' ; } 
									if($timelist == '1') { $time.= '01:00:00,' ; } 
									if($timelist == '2') { $time.= '02:00:00,' ; } 
									if($timelist == '3') { $time.= '03:00:00,' ; } 
									if($timelist == '4') { $time.= '04:00:00,' ; } 
									if($timelist == '5') { $time.= '05:00:00,' ; } 
									if($timelist == '6') { $time.= '06:00:00,' ; } 
									if($timelist == '7') { $time.= '07:00:00,' ; } 
									if($timelist == '8') { $time.= '08:00:00,' ; } 
									if($timelist == '9') { $time.= '09:00:00,' ; } 
									if($timelist == '10') { $time.= '10:00:00,' ; } 
									if($timelist == '11') { $time.= '11:00:00,' ; } 
									if($timelist == '12') { $time.= '12:00:00,' ; } 
									if($timelist == '13') { $time.= '13:00:00,' ; } 
									if($timelist == '14') { $time.= '14:00:00,' ; } 
									if($timelist == '15') { $time.= '15:00:00,' ; } 
									if($timelist == '16') { $time.= '16:00:00,' ; } 
									if($timelist == '17') { $time.= '17:00:00,' ; } 
									if($timelist == '18') { $time.= '18:00:00,' ; } 
									if($timelist == '19') { $time.= '19:00:00,' ; } 
									if($timelist == '20') { $time.= '20:00:00,' ; } 
									if($timelist == '21') { $time.= '21:00:00,' ; } 
									if($timelist == '22') { $time.= '22:00:00,' ; } 
									if($timelist == '23') { $time.= '23:00:00,' ; } 
								}
							
								$body1='Hi '.$student->getName().',
							
								The lesson '.$lesson->getTitle().' is rescheduled to '.$this->getRequestParameter('date').' at '.$time.'. Please co operate.
								
								Thank you,
								
								'.$expert->getName().'
							
							';
							
												
							//Grab the user object
							$expertuser = UserPeer::retrieveByPK($expert->getId());
							
							//Send the messages
							$expertuser->sendMessage($student->getId(),$sub1,$body1);
							
						}
					}
			
			return $this->redirect('expertmanager/history?less_id='.$this->getrequestParameter('less_id'));
						
		}
		
	
  }
  
  public function executeSchedule()
  {
	sfProjectConfiguration::getActive()->loadHelpers('Partial');
	
	$date = $this->getRequestParameter('date');
	$timing = array();
	$timing = $this->getRequestParameter('timing');
	
	return $this->renderText(get_partial('schedule', array('date' => $date, 'timing' => $timing)));
  }
  
  public function executeStudentlesson()
  {
	
		$c=new Criteria();
		$c->add(ExpertsLessonMembersPeer::STUDENT_ID,$this->getUser()->getRaykuUserId());
		$this->lessonids=ExpertsLessonMembersPeer::doSelect($c);
		
  }
  
  public function executeStudentreschedule()
  {
	
		$this->e_id=$this->getRequestParameter('e_id');
		$this->l_id=$this->getRequestParameter('l_id');
		
		
		$c=new Criteria();
		$c->add(ExpertLessonPeer::ID,$this->getrequestParameter('l_id'));
		$this->lesson=ExpertLessonPeer::doSelectOne($c);
		
		
		
		$c=new Criteria();
		$c->add(ExpertLessonSchedulePeer::EXPERT_LESSON_ID,$this->getrequestParameter('l_id'));
		$this->lesson_shedule=ExpertLessonSchedulePeer::doSelectOne($c);
		
		
		if($this->getRequestParameter('date'))
		{
					
					$expert=UserPeer::retrieveByPk($this->getRequestParameter('e_id'));
					$student=UserPeer::retrieveByPk($this->getUser()->getRaykuUserId());
					$lesson=ExpertLessonPeer::retrieveByPk($this->getRequestParameter('l_id'));
									
					$date=date('d-m-Y',$this->getRequestParameter('date'));
					
					$timings = implode("|",$this->getRequestParameter('timings'));		
						
					$times=explode('|',$timings);
								
								$time = '';
								
								foreach($times as $timelist) 
								{
					
									if($timelist == '0') { $time.= '00:00:00,' ; } 
									if($timelist == '1') { $time.= '01:00:00,' ; } 
									if($timelist == '2') { $time.= '02:00:00,' ; } 
									if($timelist == '3') { $time.= '03:00:00,' ; } 
									if($timelist == '4') { $time.= '04:00:00,' ; } 
									if($timelist == '5') { $time.= '05:00:00,' ; } 
									if($timelist == '6') { $time.= '06:00:00,' ; } 
									if($timelist == '7') { $time.= '07:00:00,' ; } 
									if($timelist == '8') { $time.= '08:00:00,' ; } 
									if($timelist == '9') { $time.= '09:00:00,' ; } 
									if($timelist == '10') { $time.= '10:00:00,' ; } 
									if($timelist == '11') { $time.= '11:00:00,' ; } 
									if($timelist == '12') { $time.= '12:00:00,' ; } 
									if($timelist == '13') { $time.= '13:00:00,' ; } 
									if($timelist == '14') { $time.= '14:00:00,' ; } 
									if($timelist == '15') { $time.= '15:00:00,' ; } 
									if($timelist == '16') { $time.= '16:00:00,' ; } 
									if($timelist == '17') { $time.= '17:00:00,' ; } 
									if($timelist == '18') { $time.= '18:00:00,' ; } 
									if($timelist == '19') { $time.= '19:00:00,' ; } 
									if($timelist == '20') { $time.= '20:00:00,' ; } 
									if($timelist == '21') { $time.= '21:00:00,' ; } 
									if($timelist == '22') { $time.= '22:00:00,' ; } 
									if($timelist == '23') { $time.= '23:00:00,' ; } 
								}
							
								$body1='Hello '.$expert->getName().', 
								
								This is from '.$student->getName().', since i want the  lesson '.$lesson->getTitle().' to be rescheduled to '.$date.' at '.$time.'. Please let me know.
								
								Thank you,
								
								'.$student->getName().'
							
							';
							
							$sub1='Needs the lesson '.$lesson->getTitle().' to be rescheduled';
							
							//Grab the user object
							$user = UserPeer::retrieveByPK($student->getId());
							
							//Send the messages
							$user->sendMessage($expert->getId(),$sub1,$body1);
		
		
					return $this->redirect('expertmanager/studentlesson');
		
		}
		
		
		
		
  }
 
  public function executeCancel() 
  {
  	
		$this->less_id=$this->getRequestParameter('less_id');
		
		$c = new Criteria();
		$c->add(ExpertLessonSchedulePeer::EXPERT_LESSON_ID,$this->less_id);
		$lessons=ExpertLessonSchedulePeer::doSelect($c);
		
		foreach($lessons as $lesson) 
		{
		
				$lesson->delete();
				
		}
		
		return $this->redirect('expertmanager/index');
		
  }
  
  public function executePaypal()
  {
  		$this->expert_id = $this->getRequestParameter('expert_id');
		$this->expert_lesson_id = $this->getRequestParameter('expert_lesson_id');
		$this->lesson_price=$this->getRequestParameter('lesson_price');
		
		$c=new Criteria();
		$c->add(UserPeer::ID,$this->getUser()->getRaykuUserId());
		$this->user=UserPeer::doSelectOne($c); 
			
  }
  public function executeConfirmation()
  {
  
  		$this->expertid = $this->getRequestParameter('expert_id'); 
		$this->studentid = $this->getUser()->getRaykuUserId() ;
		$this->expert_lesson_id = $this->getRequestParameter('expert_lesson_id'); 
		
		if($this->getRequestParameter('e_id') != '')
		{
				$this->e_id = $this->getRequestParameter('e_id');
				$this->l_id = $this->getRequestParameter('l_id');
				$this->amount = $this->getRequestParameter('amt');
				
				$credits= new ExpertsCreditDetails();
				$credits->setStudentId($this->studentid);
				$credits->setExpertId($this->e_id);
				$credits->setCreditAmount($this->amount);
				$credits->setLessonId($this->l_id);
				$credits->save(); 
				
				$c = new Criteria();

				$c->add(ExpertsFinalCreditPeer::EXPERT_ID,$this->e_id);
				$currentfinal = ExpertsFinalCreditPeer::doSelectOne($c);
				
				if($currentfinal != NULL)
				{
						$finalcredit= $currentfinal->getAmount() + $this->amount ; 
						
						$currentfinal->setAmount($finalcredit);
						$currentfinal->save(); 
				}
				else
				{
						$finalcredit = new ExpertsFinalCredit();
						$finalcredit->setExpertId($this->e_id);
						$finalcredit->setAmount($this->amount);
						$finalcredit->save(); 
				}
				
								
		}

		
  }
  
  public function executeStudentSchedule()
  {
  		
		$this->sdate= $this->getRequestParameter('date');
		$this->expid = $this->getRequestParameter('expid');
		$this->lessid = $this->getRequestParameter('lessid');
		
		$c = new Criteria();
		$c->add(ExpertLessonSchedulePeer::DATE,$this->getRequestParameter('date'));
		$c->add(ExpertLessonSchedulePeer::USER_ID,$this->getRequestParameter('expid'));
		$this->lessondates = ExpertLessonSchedulePeer::doSelectOne($c);  
		
	
		
  }
  
  public function executeSenttoexpert()
  {
  	
		$studentexpert = new ExpertStudentSchedules();
		$studentexpert->setExpId($this->getRequestParameter('expid'));
		$studentexpert->setStudentId($this->getUser()->getRaykuUserId());
		$studentexpert->setDate($this->getRequestParameter('date'));
		$studentexpert->setTime($this->getRequestParameter('time'));
		$studentexpert->setMessage($this->getRequestParameter('message'));
		$studentexpert->setExpertLessonId($this->getRequestParameter('lessid'));
		$studentexpert->save(); 
		
		
		$c = new Criteria();
		$c->add(ExpertLessonPeer::ID,$this->getRequestParameter('lessid'));
		$lesson = ExpertLessonPeer::doSelectOne($c);
	

		$timing = $this->getRequestParameter('time') ;
		
		if($timing == '0') { $time='(0am-1am)'; }
		if($timing == '1') { $time='(1am-2am)'; }
		if($timing == '2') { $time='(2am-3am)'; }
		if($timing == '3') {  $time='(3am-4am)'; }
		if($timing == '4') {  $time='(4am-5am)'; }
		if($timing == '5') {  $time='(5am-6am)'; }
		if($timing == '6') {  $time='(6am-7am)'; }
		if($timing == '7') {  $time='(7am-8am)'; }
		if($timing == '8') {  $time='(8am-9am)'; }
		if($timing == '9') {  $time='(9am-10am)'; }
		if($timing == '10') {  $time='(10am-11am)'; }
		if($timing == '11') {  $time='(11am-12pm)'; }
		if($timing == '12') {  $time='(12pm-1pm)'; }
		if($timing == '13') {  $time='(1pm-2pm)'; }
		if($timing == '14') {  $time='(2pm-3pm)'; }
		if($timing == '15') {  $time='(3pm-4pm)'; }
		if($timing == '16') {  $time='(4pm-5pm)'; }
		if($timing == '17') {  $time='(5pm-6pm)'; }
		if($timing == '18') {  $time='(6pm-7pm)'; }
		if($timing == '19') {  $time='(7pm-8pm)'; }
		if($timing == '20') {  $time='(8pm-9pm)'; }
		if($timing == '21') {  $time='(9pm-10pm)'; }
		if($timing == '22') {  $time='(10pm-11pm)'; }
		if($timing == '23') {  $time='(11pm-12pm)'; }
		
		
 		 $currentuser = $this->getUser()->getRaykuUser();
		
		 $subject='New Request for a lesson';		
		 $body='<table width="100%" >
				<tr>
				
					<td width="48%" style="border-top:dotted thin; border-color:#666666;">
						<table width="100%">
						<tr><td><font style=" font-size:12px; color:#CCCCCC;">subject,price</font></td></tr>
						<tr><td><b>'.$lesson->getTitle().'&nbsp;($'. $lesson->getPrice().'/hour)</b></td></tr>
						</table>
					</td>
					<td width="4%" align="left" style="width:0px;border-right:dotted thin; border-color:#666666;">&nbsp;</td>
					
					<td width="48%" style="border-top:dotted thin; border-color:#666666;">
						<table width="100%">
						<tr><td><font style=" font-size:12px; color:#CCCCCC;">Time</font></td></tr>
						<tr><td><b>'.date('l',$this->getRequestParameter('date')).','.date('Y-m-d',$this->getRequestParameter('date')).'</b></td></tr>
						<tr><td><b>'.$time.'</b></td></tr>
						</table>
					</td> 
				</tr>
				
				<tr>
					<td style="border-top:dotted thin; border-bottom:dotted thin; border-color:#666666;" colspan="3">
						
							Your decision <br>
							
							<form action="/expertmanager/expertsapproves" method="post">
							
							<input type="hidden" name="expid" value="'.$this->getRequestParameter('expid').'">
							<input type="hidden" name="studid" value="'.$this->getUser()->getRaykuUserId().'">
							<input type="hidden" name="lessid" value="'.$this->getRequestParameter('lessid').'">
							<input type="hidden" name="scheduledid" value="'.$studentexpert->getId().'">
							<input type="hidden" name="msgid" value="'.$this->getRequestParameter('id').'">
							
							<input type="submit" name="accept" value="Accept">
							<input type="submit" name="modify" value="Modify">
							<input type="submit" name="reject" value="Reject">
								
							</form>
					
					</td>
			  </tr>
				
			</table>
		';
		//Send the message
		 $currentuser->sendMessage($this->getRequestParameter('expid'),$subject,$body);
		
  }
  
  
  public function executeExpertsapproves()
  {
  		
				$c = new Criteria();
				$c->add(ExpertLessonPeer::ID,$this->getRequestParameter('lessid'));
				$lesson = ExpertLessonPeer::doSelectOne($c);
	
				$c = new Criteria();
				$c->add(ExpertStudentSchedulesPeer::ID,$this->getRequestParameter('scheduledid'));
				$schedules = ExpertStudentSchedulesPeer::doSelectOne($c);
				
				$timing = $schedules->getTime();
		
				if($timing == '0') { $time='(0am-1am)'; }
				if($timing == '1') {  $time='(1am-2am)'; }
				if($timing == '2') {  $time='(2am-3am)'; }
				if($timing == '3') {  $time='(3am-4am)'; }
				if($timing == '4') {  $time='(4am-5am)'; }
				if($timing == '5') {  $time='(5am-6am)'; }
				if($timing == '6') {  $time='(6am-7am)'; }
				if($timing == '7') {  $time='(7am-8am)'; }
				if($timing == '8') {  $time='(8am-9am)'; }
				if($timing == '9') {  $time='(9am-10am)'; }
				if($timing == '10') {  $time='(10am-11am)'; }
				if($timing == '11') {  $time='(11am-12pm)'; }
				if($timing == '12') {  $time='(12pm-1pm)'; }
				if($timing == '13') {  $time='(1pm-2pm)'; }
				if($timing == '14') {  $time='(2pm-3pm)'; }
				if($timing == '15') {  $time='(3pm-4pm)'; }
				if($timing == '16') {  $time='(4pm-5pm)'; }
				if($timing == '17') {  $time='(5pm-6pm)'; }
				if($timing == '18') {  $time='(6pm-7pm)'; }
				if($timing == '19') {  $time='(7pm-8pm)'; }
				if($timing == '20') {  $time='(8pm-9pm)'; }
				if($timing == '21') {  $time='(9pm-10pm)'; }
				if($timing == '22') {  $time='(10pm-11pm)'; }
				if($timing == '23') {  $time='(11pm-12pm)'; }
		
		
 		 		$currentuser = $this->getUser()->getRaykuUser();
		
		
		
		
		if($this->getRequestParameter('accept'))
		{
			
				$schedules->setAcceptReject(1);
				$schedules->save(); 
				
					
				
		 		$subject='Lesson scheduled.';		
				$body='<table width="100%" >
				<tr>
					<td style="border-top:dotted thin; border-bottom:dotted thin; border-color:#666666;" colspan="3">
					<b>Lesson Scheduled </b> <br>
					Expert has accepted the lesson schedule.
					</td>
				</tr>
	
				<tr>
				
					<td width="48%" style="border-top:dotted thin; border-color:#666666;">
						<table width="100%">
						<tr><td><font style=" font-size:12px; color:#CCCCCC;">subject,price</font></td></tr>
						<tr><td><b>'.$lesson->getTitle().'&nbsp;($'. $lesson->getPrice().'/hour)</b></td></tr>
						</table>
					</td>
					<td width="4%" align="left" style="border-right:dotted thin; border-color:#666666;">&nbsp;</td>
					
					<td width="48%" style="border-top:dotted thin; border-color:#666666;">
						<table width="100%">
						<tr><td width="100%"><font style=" font-size:12px; color:#CCCCCC;">Time</font></td></tr>
						<tr><td><b>'.date('l',$schedules->getDate()).','.date('Y-m-d',$schedules->getDate()).'</b></td></tr>
						<tr><td><b>'.$time.'</b></td></tr>
						</table>
					</td> 
				</tr>
			</table>
		';
		//Send the message
		 $currentuser->sendMessage($this->getRequestParameter('studid'),$subject,$body);
		
			// $this->redirect('expertmanager/expertsapproves');		
			
		}
		if($this->getRequestParameter('reject'))
		{
			
				$c = new Criteria();
				$c->add(ExpertStudentSchedulesPeer::ID,$this->getRequestParameter('scheduledid'));
				$schedules = ExpertStudentSchedulesPeer::doSelectOne($c);
				
				$schedules->setAcceptReject(0);
				$schedules->save(); 
				
					
				
		 		$subject='Lesson Schedule has been rejected.';		
				$body='<table width="100%" >
				<tr>
					<td style="border-top:dotted thin; border-bottom:dotted thin; border-color:#666666;" colspan="3">
					<b>Lesson Schedule has been rejected. </b> <br>
					Expert has rejected the lesson schedule.
					</td>
				</tr>
	
				<tr>
				
					<td width="48%" style="border-top:dotted thin; border-color:#666666;">
						<table width="100%">
						<tr><td><font style=" font-size:12px; color:#CCCCCC;">subject,price</font></td></tr>
						<tr><td><b>'.$lesson->getTitle().'&nbsp;($'. $lesson->getPrice().'/hour)</b></td></tr>
						</table>
					</td>
					<td width="4%" align="left" style="border-right:dotted thin; border-color:#666666;">&nbsp;</td>
					
					<td width="48%" style="border-top:dotted thin; border-color:#666666;">
						<table width="100%">
						<tr><td width="100%"><font style=" font-size:12px; color:#CCCCCC;">Time</font></td></tr>
						<tr><td><b>'.date('l',$schedules->getDate()).','.date('Y-m-d',$schedules->getDate()).'</b></td></tr>
						<tr><td><b>'.$time.'</b></td></tr>
						</table>
					</td> 
				</tr>
			</table>
		';
		//Send the message
		 $currentuser->sendMessage($this->getRequestParameter('studid'),$subject,$body);
		
			$this->redirect('expertmanager/expertsreject');		
			
		}
		if($this->getRequestParameter('modify'))
		{
			
			$this->redirect('expertmanager/modify?id='.$this->getRequestParameter('scheduledid'));
		}
		
		
  }
  
  public function executeExpertsreject()
  {
  		
  }
  
  public function executeModify()
  {
  
  
  }
  
  public function executePromotext()
  {
  		
		$this->expertid= $this->getUser()->getRaykuUser()->getId();
				$this->expertusr= $this->getUser()->getRaykuUser()->getUsername();




		$c= new Criteria();
		$c->add(ExpertsPromoTextPeer::EXP_ID,$this->expertid);
		$this->promotext = ExpertsPromoTextPeer::doSelectOne($c);
		


		
		if($this->getRequestParameter('content') != NULL) 
		
		{

				$this->content = $this->getRequestParameter('content');
				
				$c= new Criteria();
				$c->add(ExpertsPromoTextPeer::EXP_ID,$this->expertid);
				$expertstext = ExpertsPromoTextPeer::doSelectOne($c);
				
				if($expertstext != NULL) { 
				
					$expertstext->setContent($this->content);
					$expertstext->save();
							
				}
				else {
					
					$promo = new ExpertsPromoText();
					$promo->setExpId($this->expertid);
					$promo->setContent($this->content);
					$promo->save();
				
				}
					 $a=new Criteria();
					 $a->add(UserPeer::ID,$this->expertid);
					 $users=UserPeer::doSelectOne($a);

				
				$this->redirect('/expertmanager/portfolio/'.$users->getUsername());


				
		}
  
  
  }
  
}
