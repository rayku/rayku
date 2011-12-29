<?php
class mochigame
{
    public function saveDataToRemoting($userid, $points_count)
    {

		$connection = RaykuCommon::getDatabaseConnection();
        $msg='';
        if($selected){
            // Performing SQL query
            $query = "update user set points=".$points_count." where username='".$userid."'";
            $msg=$query;

            mysql_query($query, $connection);
        }

        return 'mochigame call amfphp userid=: ' . $userid .' and chips=: '. $points_count;
    }
}

//$mochigame = new mochigame;

?>

