<?php
class mochigame
{
    public function saveDataToRemoting($userid, $points_count)

    {
		
		$link = mysql_connect('localhost', 'rayku_db', 'db_*$%$%');
		$msg='';
		if($link){
		$selected=mysql_select_db('rayku_db');
		if($selected){
// Performing SQL query
		$query = "update user set points=".$points_count." where username='".$userid."'";
		$msg=$query;
		
		mysql_query($query);
		}
		else
			$msg='no db connected';
		mysql_close($link);
		}
		else
			$msg='no connection';
		
		return 'mochigame call amfphp userid=: ' . $userid .' and chips=: '. $points_count;
    }
}

	//$mochigame = new mochigame;

?>

