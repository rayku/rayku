<?php 
$count = $_COOKIE['tutorcount'];
$connection = RaykuCommon::getDatabaseConnection();

//echo "Cook Count--->".$_COOKIE['tutorcount'];
if($count>0)
{
?>	
<div id="popup_content"> 
<div id="tutors-popup">    
    <div id="tutors-popup-inner" class="clearfix">
        <form name='listform1' id='listform1' method='post' action="">
		
            <h3>Tutors you’ve Selected (<a href="#" style="color:#069">?</a>):</h3>
             <ul id="tutor-list">            		
            	    <?php
            	    	$max_count = 4;
			$remain_count = $max_count-$count;
            	    	$cookcount = $_COOKIE['cookcount'];
            	    	$k=1;
            	    	for($i=1;$i<=$cookcount;$i++)
            	    	{
            	    		if(isset($_COOKIE['tutor_'.$i]) && !empty($_COOKIE['tutor_'.$i]))
            	    		{
		    	    		/* User Online Check - Start */
					$a=new Criteria();
					$a->add(UserPeer::ID,$_COOKIE['tutor_'.$i]);
					$users_online=UserPeer::doSelectOne($a);

					$onlinecheck = '';

					if($users_online->isOnline()) 
					{
						$onlinecheck = "online";
					} 
					if(empty($onlinecheck)) 
					{
					$gtalkquery = mysql_query("select * from user_gtalk where userid=".$_COOKIE['tutor_'.$i], $connection) or die(mysql_error());

					if(mysql_num_rows($gtalkquery) > 0) {

						$status = mysql_fetch_assoc($gtalkquery);

						$gtalkmail = $status['gtalkid'];

						 $onlinecheck = file_get_contents('http://www.rayku.com:8892/status/'.$gtalkmail);
					} 

					}

					if(empty($onlinecheck) || ($onlinecheck != "online")) {


					$fb_query = mysql_query("select * from user_fb where userid=".$_COOKIE['tutor_'.$i], $connection) or die(mysql_error());

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
					/* User Online Check - End */
					if($onlinecheck=="online")
		    	    		{
		    	    		?>				
					    <!--list item-->
					    <li class="clearfix">
						                		
					    <div class="tutor-number">
					    		<?php echo $k; ?>
					    </div>

					<?php 
						$school = ''; $Year = '';
						 $c=new Criteria();
						 $c->add(UserPeer::ID,$_COOKIE['tutor_'.$i]);
						 $user = UserPeer::doSelectOne($c);
						   $mail = explode("@", $user->getEmail());	     
						   $newMail = explode(".", $mail[1]);
					
						   if($newMail[0] == "utoronto") { 
							 
							   $school = "University of Toronto";
						   
						   } else if($newMail[1] == "ubc") {
							 
							   $school = "UBC";
							 
						   }
					
					
				
					  
					
						$query = mysql_query("select * from user_course where user_id=".$user->getId()." AND course_subject=1", $connection) or die(mysql_error());
	
						$allsub=" "; $Year = "";
						while ($row = mysql_fetch_array($query, MYSQL_NUM)) 
						 {
							 if($allsub==" ")
							 {
								 $allsub= "<span>".$row[3]."</span>";
							 }
							 else
							 {
							 	$allsub=$allsub."<span>".$row[3]."</span>";
							 }

							 if($Year=="")
							 {
								 								 										if($row[4] == "graduated") {

									$Year = "Graduated";
								} else {

									$Year = intval($row[4]);

								} 
							 }
							 else
							 {
								
							 	if($Year < $row[4]) {

									$Year =  $row[4];

								} elseif($row[4] == "graduated") {

									$Year = "Graduated";
								}
							 }

					
                          				}
							  //3rd Year UBC Student

						$_year = $Year."  Year ".$school." Student:";
					
?>
						    
					    <div class="tutor-info">
					    	<p class="year"><?php echo $_year; ?></p>
						<p class="name"><?php echo $user->getName(); ?></p>
						<p class="subjects"><?php echo $allsub; ?></p>
						<input type="hidden"  value="<?php echo $user->getId();?>" id="checkbox[<?php echo $user->getId();?>]" name="checkbox[]">
					    </div>
					    
					    <a href="javascript:deletecookie(<?php echo $_COOKIE['tutor_'.$i]; ?>);" class="cross">cross</a>
					    
				    </li>
				<!--list item-->
		    	    <?php
					
		    	    		}
		    	    		else if($onlinecheck=="offline")
		    	    		{
		    	    			/* Delete Offline Users */
		    	    			$delCook = $_COOKIE["tutor_".$i];
		    	    			?>
		    	    			<script type="text/javascript">
		    	    				deletecookie(<?php echo $delCook; ?>);
		    	    			</script>
		    	    			<?php		    	    			
		    	    		}
		    	    		$k = $k+1;
		    	    	}		
            	    }	
            	    ?>		
            </ul>
            <p class="limit">you may select up to <strong><?php echo $remain_count; ?></strong> more</p>
            
	<a href="javascript: document.listform1.submit()" onclick="return checkExpertCheckBoxes();" type="submit" id="submit_connect" class="connect-now">Connect Now</a>
	<input type="hidden"  value="7" id="hidden" name="hidden">
        </form>
    </div>
</div> 
</div> 	
<?php
}
?>