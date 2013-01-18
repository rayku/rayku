<?php

/**
 * friends actions.
 *
 * @package    elifes
 * @subpackage friends
 * @author     Adam A Flynn <adamaflynn@criticaldevelopment.net>
 */
class tutorsActions extends sfActions
{
    public function executeAjaxidle()
    {
        RaykuCommon::getDatabaseConnection();
        
        if ($_GET['status'] == '1') {


            $selmisqry = mysql_query("SELECT * FROM popup_close WHERE user_id ='" . $_GET['userid'] . "'");
            $misqrys = mysql_fetch_array($selmisqry);
            if ($misqrys['user_id'] == "") {
                mysql_query("INSERT INTO `popup_close` (
					 `id` ,
					 `user_id`,
					 `ustatus`
					 )
					 VALUES (
					 NULL , '" . $_GET['userid'] . "','1' )");
            }
        } else if ($_GET['status'] == '2') {

            $selmisqry = mysql_query("SELECT * FROM popup_close WHERE user_id ='" . $_GET['userid'] . "' and ustatus='1' ");
            $misqrys = mysql_fetch_array($selmisqry);

            if ($misqrys['user_id'] != "") {
                $sel_misqry = mysql_query("DELETE FROM popup_close WHERE user_id='" . $_GET['userid'] . "'");
            }
        }
    }

    public function executeCheckoutpopup()
    {
        
    }
}
