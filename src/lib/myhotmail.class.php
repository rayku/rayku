<?

/////////////////////////////////////////////////////////////////////////////////////////
//                                                                                     //
//                                                                                     //
//                                                                                     //
//                        HOTMAIL CONTACT IMPORTING SCRIPT                             //
//                             COPYRIGHT RESERVED                                      //
//                                                                                     //
//            You may not distribute this software without prior permission            //
//                                                                                     //
//                                                                                     //
//                           WWW.GETMYCONTACTS.COM                                     //
//                                                                                     //
/////////////////////////////////////////////////////////////////////////////////////////


//******************************* | SETTING VARIABLES | ***********************************\\

$service = 'hotmail';

//--------------------------------------------end of service------------------------------------------------\\
class myhotmail {

function myhotmailfun($matches,$result,$myFile)
{
	$arraycount= count($matches);
	$checkarray = $matches[1][1];
	
	//If no results, try livemail
	/*IF (empty($checkarray)){
	require 'mylive.php';  //************ This get mylive.php file and runs it instead.
	}ELSE*/{
	
	
	
	//*********************** | START OF HTML | ***********************************\\
	
			$i = 0;
			while (isset($matches[$i])):
			
			//  [RESULTS - START OF CONTACTS LIST]
			$email = $matches[$i][1];
			$dataname = $matches[$i][2];
	
						//remove none characters
						$email1 = preg_replace("/[^a-z0-9A-Z_-\s@\.]/","",$email);
						$dataname1 = preg_replace("/[^a-z0-9A-Z_-\s@\.]/","",$dataname);
	
			$result = array('contacts_email' => $email1,'contacts_name' => $dataname1);
			$display_array[] = $result;
	
			$i++;
		endwhile;
		$poweredby_bottom = $footer;//powered by
		$show_result = 1;//show results table
	    @unlink($myfile);//deleting csv file
	}
	$table = 1;//show table in main template (email or cvs upload)
	$service = 'myhotmail';
	@unlink($myfile);//deleting csv file
	return $display_array;
}
}
?>
