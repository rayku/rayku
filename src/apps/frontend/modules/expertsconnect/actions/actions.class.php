<?php

/**
 * expertsconnect actions.
 *
 * @package    elifes
 * @subpackage expertsconnect
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class expertsconnectActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex()
  {

	if(empty($_COOKIE["popupopen"])) :
			$this->redirect("dashboard/popuperror");
	endif;
    
		$c = new Criteria();
		$c->add(UserPeer::TYPE,5);
		$c->setLimit(5);
		$c->addDescendingOrderByColumn(UserPeer::POINTS);
		$this->experts= UserPeer::doSelect($c);

//============================================================Modified By DAC021===============================================================================//
			$con = mysql_connect("localhost", "rayku_db", "db_*$%$%") or die(mysql_error());

			$db = mysql_select_db("rayku_db", $con) or die(mysql_error());

$logedUserId = $_SESSION['symfony/user/sfUser/attributes']['symfony/user/sfUser/attributes']['user_id'];

$query = mysql_query("select * from user where id=".$logedUserId." ") or die(mysql_error());
$row = mysql_fetch_assoc($query);

$name = $row['username']."_last";

if(isset($_SESSION[$name]))
{
		$finalEnd = $_SESSION[$row['username']] * 18000;

		$newStart = $_SESSION[$name] + 1800;

		$end =  time();	

		if(($newStart <= $end) && ($finalEnd > $end))
		{
		
			$query = mysql_query("select * from user_score where user_id=".$logedUserId) or die(mysql_error());

			$row = mysql_fetch_array($query);

			$newScore = $row['score'] + 2;
		
			mysql_query("update user_score set score=".$newScore." where user_id=".$logedUserId) or die(mysql_error());
			
			$_SESSION[$name] = $_SESSION[$name] + 1800;
			
		}	
	
} else {

		$start = $_SESSION[$row['username']] + 1800;

		$newStart = $start + 1800;

		$end =  time();	

		if(($start <= $end) && ($newStart > $end))
		{
			$query = mysql_query("select * from user_score where user_id=".$logedUserId) or die(mysql_error());

			$row = mysql_fetch_array($query);

			$newScore = $row['score'] + 2;
		
			mysql_query("update user_score set score=".$newScore." where user_id=".$logedUserId) or die(mysql_error());
			
			$_SESSION[$name] = time();
			
		}


}

//============================================================Modified By DAC021===============================================================================//

		
  }
  
  public function executeSaveanexpert()
  {

	if(empty($_COOKIE["popupopen"])) :
			$this->redirect("dashboard/popuperror");
	endif;


  
  		$c = new SavedExperts();
		$c->setUserId($this->getUser()->getRaykuUser()->getId());
		$c->setExpertId($this->getRequestParameter('expid'));
		$c->save();
		
		$c = new Criteria();
		$c->add(UserPeer::ID,$this->getRequestParameter('expid'));
		$user = UserPeer::doSelectOne($c);
				
		$this->redirect('@profile?username='.$user->getUsername());
  }
  
  public function executeSearchexpert()
  {
  		

	if(empty($_COOKIE["popupopen"])) :
			$this->redirect("dashboard/popuperror");
	endif;



			$this->expertname = $this->getRequestParameter('criteria');
		
			$c = new Criteria();
			
			$s = $c->getNewCriterion(UserPeer::USERNAME, "%$this->expertname%", Criteria::LIKE );
			$s->addOr( $c->getNewCriterion(UserPeer::NAME, "%$this->expertname%", Criteria::LIKE ) );
			
			$c->add($s);

			//$c->add(UserPeer::TYPE,5);
			
			// $this->searchresults= UserPeer::doSelect($c); 
			
			
			$pager = new sfPropelPager('User', 5);
			$pager->setCriteria($c);
			$pager->setPage($this->getRequestParameter('page', 1));
			$pager->init();
			
			$raykuPager = new RaykuPagerRenderer( $pager );
			$raykuPager->setBaseUrl('expertsconnect/searchexpert');
			$this->raykuPager = $raykuPager;


		
			
  
  }
  
  
}
