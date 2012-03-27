<?php

/**
 * forums actions.
 *
 * @package    elifes
 * @subpackage forums
 * @author     Your name here
 */
class whiteboardsessionActions extends sfActions
{
    public function preExecute() {
        RaykuCommon::getDatabaseConnection();
    }
    public function executeIndex($request)
    {
        $_query = mysql_query("select * from whiteboard_chat", $connection) or die(mysql_error());
        $allChat = array();
        $i = 0;
        while($_row = mysql_fetch_array($_query)) {
            $allChat[$i] = array("id"=> $_row['id'], "Date" => $_row['started_at'], "Rating" => $_row['rating'], "Question"=> $_row['question'], "tutor" => $_row['expert_nickname'], "asker" => $_row['asker_nickname'],  "Duration" => $_row['timer'], "Amount" => $_row['amount']);
            $i++;
        }
        $this->allChat = $allChat;
		$this->expertId = $request->getParameter('id');
    }

  public function executeVerify()
  {
	$_query = mysql_query("select * from user_score where status = 1 and score <= 80", $connection) or die(mysql_error());

	$userDetails = array();
	$i = 0;

	while($_row = mysql_fetch_array($_query)) {
		$userDetails[$i] = array("user_id"=> $_row['user_id']);
	$i++;
	}

	$this->userDetails = $userDetails;

  } 

	public function executeTutor()
	{
    }
}