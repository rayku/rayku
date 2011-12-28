<?

/////////////////////////////////////////////////////////////////////////////////////////
//                                                                                     //
//                                                                                     //
//                                                                                     //
//                        HOTMAIL  LIVE CONTACT IMPORTING SCRIPT                       //
//                             COPYRIGHT RESERVED                                      //
//                                                                                     //
//            You may not distribute this software without prior permission            //
//                                                                                     //
//                                                                                     //
//                           WWW.GETMYCONTACTS.COM                                     //
//                                                                                     //
/////////////////////////////////////////////////////////////////////////////////////////

$service = 'live';

//--------------------------------------------end of service------------------------------------------------\\
class mylive {

function mylivefun($matches,$result,$myFile)
{
	
	// CHECKING IF ANY CONTACTS EXIST
	$checkarray = $matches[1][1];
	if (empty($checkarray)) {
	
		$show = 1;
		$error_message = "No contacts found - check your login details and try again";
	
	}
	else {
	
		//*********************** | START OF HTML | ***********************************\\
	
		$i = 0;
		while (isset($matches[$i])):
	
			//  [RESULTS - START OF CONTACTS LIST]
	
			$name = $matches[$i][2];
			$dataname = $name;
			$dataname = str_replace('&#32','',$dataname);
			$dataname = str_replace('&#64','',$dataname);
	
			if (empty($dataname)) {
				$dataname = str_replace('x40','@',($matches[$i][1]));
				$dataname = str_replace('&#32','',$dataname);
				$dataname = str_replace('&#64','',$dataname);
	
				list($name,$domains) = split('@',$longname);
			}
			$email = str_replace('x40','@',($matches[$i][1]));
	
						//remove none characters
						$email1 = preg_replace("/[^a-z0-9A-Z_-\s@\.]/","",$email);
						$dataname1 = preg_replace("/[^a-z0-9A-Z_-\s@\.]/","",$dataname);
	
			$result = array('contacts_email' => $email1,'contacts_name' => $dataname1);
			$display_array[] = $result;
	
			$i++;
		endwhile;
		$poweredby_bottom = $footer;//powered by
		$show_result = 1;//show results table
	    @unlink($myFile);//deleting csv file
	}
	$table = 1;//show table in main template (email or cvs upload)
	$service = 'myhotmail';
	@unlink($myFile);//deleting csv file
	return $display_array;
}
}
?>