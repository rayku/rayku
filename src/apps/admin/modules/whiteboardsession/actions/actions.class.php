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
    public function executeIndex()
    {
        $connection = RaykuCommon::getDatabaseConnection();
        $_query = mysql_query("select * from whiteboard_chat", $connection) or die(mysql_error());
        $allChat = array();
        $i = 0;
        while($_row = mysql_fetch_array($_query)) {
            $allChat[$i] = array("id"=> $_row['id'], "Date" => $_row['started_at'], "Rating" => $_row['rating'], "Question"=> $_row['question'], "tutor" => $_row['expert_nickname'], "asker" => $_row['asker_nickname'],  "Duration" => $_row['timer'], "Amount" => $_row['amount']);
            $i++;
        }
        $this->allChat = $allChat;
    }
}
