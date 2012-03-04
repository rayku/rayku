<?php

/**
 * profile actions.
 *
 * @package    elifes
 * @subpackage profile
 * @author     Adam A Flynn <adamaflynn@criticaldevelopment.net>
 */
 
class profileActions extends sfActions
{
	/**
	* Executes index action
	*
	*/
	public function executeIndex()
	{

 $userId = $this->getUser()->getRaykuUserId();

	if(empty($userId)) {
		
		$this->redirect('/login');

	}
  
 if(!empty($_COOKIE["timer"])) : 


	$this->redirect('/dashboard/rating');

 endif; 


	 
	 $c = new Criteria();
	 $c->add(UserPeer::USERNAME,$this->getRequestParameter('username'));
	 $user = UserPeer::doSelectOne($c);
   	 $this->user = $user;

//Paginaton Code For Shout//

	 $v = ShoutPeer::getShoutCriteria( $user );
	 $pagernew = new sfPropelPager('Shout', 5);
		$pagernew->setCriteria($v);
		$pagernew->setPage($this->getRequestParameter('page', 1));
		$pagernew->init();

    $raykuPagerNew = new RaykuPagerRenderer( $pagernew );
    $raykuPagerNew->setBaseUrl( '/profile?username=' . $this->user->getUsername() );
    $raykuPagerNew->setLinkToRemoteElementId('newone');

    $this->raykuPagerNew = $raykuPagerNew;

//============================================================Modified By DAC021===============================================================================//

    $this->current = $this->getUser()->getRaykuUser();
		
		if (sfWebRequest::POST === $this->getRequest()->getMethod())
		{
			$comment = $this->getRequestParameter('content');
			if($this->getRequestParameter('action_comment') && $comment != '')
			{			
				$poster = $this->getUser()->getRaykuUser();

      		  $poster->createShoutFor($this->user, $comment);

	
        $this->redirect('@profile?username=' . $this->user->getUsername());
			}
		}
//============================================================Modified By DAC021===============================================================================//
   if( $this->getRequest()->isXmlHttpRequest() )
    {
	     sfProjectConfiguration::getActive()->loadHelpers('Partial');
	     return $this->renderText( get_partial( 'shoutbox', array( 'raykuPager' => $raykuPagerNew) ) );  
    }
//========================================================Modified By  DAC021================================================================//			
		
	}

	public function executeEdit()
	{



		$user = UserPeer::getByUsername($this->getRequestParameter('username'));
		
		// make sure it's a valid user, and that we're editing our own profile
		if (!$user instanceof User)
		{
			$this->error = 'No such user exists.';
			$this->setTemplate('_error');
			return sfView::SUCCESS;
		}
		else if (!$this->getUser()->getRaykuUser()->equals($user))
		{
			$this->error = 'You do not have permission to edit this user\'s profile.';
			$this->setTemplate('_error');
			return sfView::SUCCESS;
		}







		// if form is submitted, persist the data
		if (sfWebRequest::POST === $this->getRequest()->getMethod())
		{


			$_username = preg_replace("/^[^a-z0-9]?(.*?)[^a-z0-9]?$/i", "$1", $this->getRequestParameter('_username'));

			$user->setName($this->getRequestParameter('realname'));
			$user->setUsername($_username);
			$user->setEmail($this->getRequestParameter('email'));
			$user->setGender($this->getRequestParameter('user[gender]'));
			$user->setHometown($this->getRequestParameter('hometown'));
			$user->setHomePhone($this->getRequestParameter('home_phone'));
			$user->setMobilePhone($this->getRequestParameter('mobile_phone'));
		
      			$birthdate = RaykuCommon::dateArrayToString( $this->getRequestParameter('birthdate') );
  			$user->setBirthdate( $birthdate );
      
			$user->setAddress($this->getRequestParameter('address'));
			$user->setRelationshipStatus($this->getRequestParameter('user[relationshipstatuse]'));
			$user->setAboutMe($this->getRequestParameter('about_me'));
			$user->setUserInterestsFromString($this->getRequestParameter('hobbies'));
			
			// if the password is set
			if ('' !== $this->getRequestParameter('password1'))
			{
				$user->setPassword($this->getRequestParameter('password1'));
			}
			
			// set the 'show xxx' params..
			$user->setShowEmail($this->getRequestParameter('show_email', 0));
			$user->setShowGender($this->getRequestParameter('show_gender', 0));
			$user->setShowHometown($this->getRequestParameter('show_hometown', 0));
			$user->setShowHomePhone($this->getRequestParameter('show_home_phone', 0));
			$user->setShowMobilePhone($this->getRequestParameter('show_mobile_phone', 0));
			$user->setShowBirthdate($this->getRequestParameter('show_birthdate', 0));
			$user->setShowAddress($this->getRequestParameter('show_address', 0));
			$user->setShowRelationshipStatus($this->getRequestParameter('show_relationship_status', 0));
			$user->setShowHobbies($this->getRequestParameter('show_hobbies', 0));

			$user->save();



			if(!empty($_FILES['file']['name'])) {

                                        $connection = RaykuCommon::getDatabaseConnection();
					$user = $this->getUser()->getRaykuUser();


							$fileName = $_FILES['file']['name'];
							$created_at = date("Y-m-d H:i:s");


						        $contentType = '';

						        $ext = substr($fileName, strrpos($fileName, '.') + 1);
						        switch (strtolower($ext)) {
							   case 'jpeg': $contentType = 'jpeg'; break;
							   case 'jpg':  $contentType = 'jpeg'; break;
							   case 'png':  $contentType = 'png';  break;
							   case 'gif':  $contentType = 'gif';  break;
							   case 'pjpeg':   $contentType = 'pjpeg';  break;

						        }

						        $checkcontentType = array('1' => 'jpeg','2' => 'png','3' => 'gif', '4' => 'pjpeg');

							// move to uploads
							$uploadDir = sfConfig::get('sf_upload_dir') . DIRECTORY_SEPARATOR . 'profile';
			
							if(in_array($contentType, $checkcontentType)) {

								 $query = mysql_query("insert into user_profile(`user_id`, `file_name`,  `created_at`) VALUES (".$user->getId().", '".$fileName."', '".$created_at."')", $connection) or die(mysql_error());

							} 

						if($query) {


							$filename = mysql_insert_id();

							$_query = mysql_query("select * from user_profile where user_id=".$user->getId()." and id != ".$filename."", $connection); 

							if(mysql_num_rows($_query)) {

							$_row = mysql_fetch_assoc($_query);

							mysql_query("delete from user_profile where user_id=".$user->getId()." and id = ".$_row['id']." ", $connection); 

							$remove = $uploadDir . DIRECTORY_SEPARATOR . $_row['id'];

							$remove = $uploadDir . DIRECTORY_SEPARATOR . $_row['id']."thumb2";

							unlink($remove);
								

							}



							if (!file_exists($uploadDir))
							{
								mkdir($uploadDir, 0700, true);
							}


							$target = $uploadDir . DIRECTORY_SEPARATOR . $filename;


							$successfullyMoved = move_uploaded_file($_FILES['file']['tmp_name'], $target);

					
							if ($successfullyMoved)
							{

    							RaykuCommon::writeAvatarImage($target, $user->getId());

							}


								// create thumb
								$thumb = new sfThumbnail(sfConfig::get('app_gallery_thumbnail2_max_width'), sfConfig::get('app_gallery_thumbnail2_max_height'));
								$thumb->loadFile($target);
								$thumb->save($target . 'thumb2');

					 	}

			}
			$this->redirect('http://rayku.com/dashboard');
		}
		
		// passing to view
		$this->user = $user;
	}
	


	public function handleErrorEdit()
	{
		$user = UserPeer::getByUsername($this->getRequestParameter('username'));
		
		// make sure it's a valid user, and that we're editing our own profile
		if (!$user instanceof User)
		{
			$this->error = 'No such user exists.';
			$this->setTemplate('_error');
			return sfView::SUCCESS;
		}
		else if (!$this->getUser()->getRaykuUser()->equals($user))
		{
			$this->error = 'You do not have permission to edit this user\'s profile.';
			$this->setTemplate('_error');
			return sfView::SUCCESS;
		}
		
		// passing to view
		$this->user = $user;
		
		return sfView::SUCCESS;
	}

	public function executeCategories()
	{


		$this->user=$this->getRequestParameter('userid');
		
		$c=new Criteria();
		$c->addJoin(CategoryPeer::ID,ExpertCategoryPeer::CATEGORY_ID,Criteria::JOIN);
		$c->add(ExpertCategoryPeer::USER_ID,$this->getRequestParameter('userid'));
		$this->usercategories=CategoryPeer::doSelect($c);
		
		
		$cat = new Criteria();
		$subSelect = "category.id NOT IN (
			SELECT
				  category_id
			FROM
				  expert_category
			WHERE
				 expert_category.user_id = ".$this->getRequestParameter('userid')."
			)";
			
		$cat->add(CategoryPeer::ID, $subSelect, Criteria::CUSTOM);
		$this->unjoinedcategories = CategoryPeer::doSelect($cat);
		
	}
	
	public function executeJoinCategory()
	{

	
				$this->user=$this->getRequestParameter('userid');
				
				$selcategories=$this->getRequestParameter('category');
			
				foreach($selcategories as $categoryid) {
				
				$this->expertcat=new ExpertCategory();
				$this->expertcat->setUserId($this->user);
				$this->expertcat->setCategoryId($categoryid);
				$this->expertcat->save();
				
				}
			
	
	}
	
	public function executeUnjoinExpert()
	{

	
		$this->catid=$this->getRequestParameter('catid');
		$this->user=$this->getRequestParameter('user');
		
		
		$c=new Criteria();
		$c->add(ExpertCategoryPeer::USER_ID,$this->getRequestParameter('user'));
		$c->add(ExpertCategoryPeer::CATEGORY_ID,$this->getRequestParameter('catid'));
		$category=ExpertCategoryPeer::doSelectOne($c);
		
		$category->delete();
		
	
	}
	public function executeShowAvatar()
	{

		$user = UserPeer::retrieveByPK($this->getRequestParameter('user_id'));
		
		$this->forward404Unless($user instanceof User);

    $allowedSizes = array(1, 2, 3, 4);
    if( !in_array( $this->getRequestParameter('size'), $allowedSizes ) )
      $size = 1;
    else
      $size = $this->getRequestParameter('size');


    switch( $size )
    {
      case 1:
          $fileSuffix = '';
        break;
      default:
          $fileSuffix = "_$size";
        break;
    }
		
		$uploadDir = sfConfig::get('sf_upload_dir') . DIRECTORY_SEPARATOR . sfConfig::get('app_general_avatar_folder');
		$file = $uploadDir . DIRECTORY_SEPARATOR . $user->getId() . $fileSuffix;
		
		if (!is_file($file))
		{
			$file = sfConfig::get('sf_web_dir') . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR
        . sfConfig::get('app_general_avatar_default_image') . $fileSuffix
        . '.' . sfConfig::get('app_general_avatar_default_image_type');
		}

		$this->getResponse()->clearHttpHeaders();
		$this->getResponse()->setHttpHeader('Content-Length', (string)(filesize($file)), true);
        $this->getResponse()->setHttpHeader('Content-Transfer-Encoding', 'binary', true);
		$this->getResponse()->setContentType('image/jpeg');
		$this->getResponse()->sendHttpHeaders();
		
		readfile($file);
		exit;	// for some reason, this fixed some bugs with sfWebResponse trying to output again later (despite sfView::NONE returned)
		
		return sfView::NONE;
	}
	
	public function executeEmailNotify()
	{
	
		$c = new Criteria();		
		$c->add(NotificationEmailsPeer::USER_ID,$this->getRequestParameter('user_id'));
		$notifies = NotificationEmailsPeer::doSelectOne($c);
		
		if($notifies != NULL)
		{
			$notifies->setOnOff($this->getRequestParameter('st'));
			$notifies->save();
		
		}
		else
		{
			$c = new NotificationEmails();
			$c->setUserId($this->getRequestParameter('user_id'));
			$c->setOnOff($this->getRequestParameter('st'));
			$c->save();
			
		
		}
		
		$c = new Criteria();
		$c->add(UserPeer::ID, $this->getRequestParameter('user_id'));
		$user = UserPeer::doSelectOne($c);
		
		$this->redirect('@profile?username='.$user->getUsername());
		
		
		
	}
//============================================================Modified By DAC021===============================================================================//

	public function executeCourse()
		{

		}

		public function executeShow()
		{
			$userName = explode("/", $_SERVER['REDIRECT_URL']);

                        $connection = RaykuCommon::getDatabaseConnection();

		$logedUserId = $_SESSION['symfony/user/sfUser/attributes']['symfony/user/sfUser/attributes']['user_id'];




  if(!empty($_POST['course_new_sub']))
     {

	$count = count($_POST['course_new_sub']);

	for($i=0; $i < $count; $i++)
	{


		mysql_query("update user_course set course_name = '".$_POST['course_name'][$i]."',course_year = '".$_POST['course_year']."',course_performance = '".$_POST['grade'][$i]."' where user_id=".$logedUserId." and course_subject = '".$_POST['course_new_sub'][$i]."' and id=".$_POST['courseid'][$i], $connection) or die(mysql_error());


	}
   }

  if(!empty($_POST['course_new_subject']))
     {

			mysql_query("insert into user_course(user_id,course_subject,course_name,course_year,course_performance) values(".$logedUserId.",'".$_POST['course_new_subject']."','".$_POST['course_new_name']."','".$_POST['course_year']."','".$_POST['new_grade']."')", $connection) or die(mysql_error());

					$queryCategory = mysql_query("select * from expert_category where user_id=".$logedUserId, $connection) or die(mysql_error());
					$expertNewCategory = array();

					$l = 0;

					while($row = mysql_fetch_array($query))
						{
							$expertNewCategory[$l] = $row['category_id'];
							$l++;
						}

					if(!in_array($_POST['course_new_subject'], $expertNewCategory)) {

						mysql_query("insert into expert_category(user_id,category_id) values(".$logedUserId.",".$_POST['course_new_subject'].")", $connection) or die(mysql_error());

						}

   }

  if(!empty($_POST['subject']))
     {

		$newSubject = array();
		$newName = array();
		$newGrade = array();

		$z=0;

		foreach($_POST['subject'] as $key => $value)
		{
		$key = $z;
		$newSubject[$key] = $value;
		$z++;
		}

		$y=0;

		foreach($_POST['name'] as $key => $value)
		{
		$key = $y;
		$newName[$key] = $value;
		$y++;
		}

		$x=0;

		foreach($_POST['newgrade'] as $key => $value)
		{
		$key = $x;
		$newGrade[$key] = $value;
		$x++;
		}

		$countNew = count($newSubject);

		for($j=0; $j < $countNew; $j++)
		{
			  if(!empty($newSubject[$j]))
			     {
					mysql_query("insert into user_course(user_id,course_subject,course_name,course_year,course_performance) values(".$logedUserId.",'".$newSubject[$j]."','".$newName[$j]."','".$_POST['course_year']."','".$newGrade[$j]."')", $connection) or die(mysql_error());

					$query = mysql_query("select * from expert_category where user_id=".$logedUserId, $connection) or die(mysql_error());
					$expertCategory = array();

					$k = 0;

					while($row = mysql_fetch_array($query))
						{
							$expertCategory[$k] = $row['category_id'];
							$k++;
						}

					if(!in_array($newSubject[$j], $expertCategory)) {

						mysql_query("insert into expert_category(user_id,category_id) values(".$logedUserId.",".$newSubject[$j].")", $connection) or die(mysql_error());

						}
					
			   }
		}
    }

			$this->redirect('@profile?username=' .$userName[4]);
		}
//Delete function For delete the post//
	public function executeRowdelete()
		{
                        $connection = RaykuCommon::getDatabaseConnection();
			//To delete selected row
			$newId = explode("/", $_SERVER['REDIRECT_URL']);
			$logedUserId = $_SESSION['symfony/user/sfUser/attributes']['symfony/user/sfUser/attributes']['user_id'];

			$queryNew = mysql_query("select * from user_course where id=".$newId[4], $connection) or die(mysql_error());
			$rowNew = mysql_fetch_assoc($queryNew);

			$queryDelete = mysql_query("select * from user_course where course_subject=".$rowNew['course_subject']." and user_id=".$logedUserId, $connection) or die(mysql_error());


			if(mysql_num_rows($queryDelete) == 1)
			{
				mysql_query("delete from expert_category where category_id=".$rowNew['course_subject']." and user_id=".$logedUserId, $connection) or die(mysql_error());	
			}
		

			mysql_query("delete from user_course where id=".$newId[4]." ", $connection) or die(mysql_error());

			//To Select Profile User
			
			$query = mysql_query("select * from user where id=".$logedUserId, $connection) or die(mysql_error());
			$row = mysql_fetch_assoc($query);

			$this->redirect('/profile/course/name/'.$row['username']);
			//$this->redirect('@homepage');
		}
	public function executeDelete()
		{
                        $connection = RaykuCommon::getDatabaseConnection();

			$newCommentId = explode("/", $_SERVER['REDIRECT_URL']);
			//To Select Profile User
			$logedUserId = $_SESSION['symfony/user/sfUser/attributes']['symfony/user/sfUser/attributes']['user_id'];
			$query = mysql_query("select * from user where id=".$logedUserId, $connection) or die(mysql_error());
			$row = mysql_fetch_assoc($query);

			// For delete Shout
			$querynew = mysql_query("delete from shout where id=".$newCommentId[4]." ", $connection) or die(mysql_error());

			$this->redirect('@profile?username=' .$row['username']);
			//$this->redirect('@homepage');
		}
//============================================================Modified By DAC021===============================================================================//

	
}
