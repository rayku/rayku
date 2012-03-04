<link rel="stylesheet" href="/css/datepicker/jquery.ui.all.css">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"></script>

<script src="/js/datepicker/jquery-1.5.1.js"></script>
<script src="/js/datepicker/jquery.ui.core.js"></script>
<script src="/js/datepicker/jquery.ui.widget.js"></script>
<script src="/js/datepicker/jquery.ui.datepicker.js"></script>
<link rel="stylesheet" href="/css/datepicker/demos.css">
<script type="text/javascript">
	
	var dj = jQuery.noConflict();

        dj(function() {
	dj( "#selectdate" ).datepicker({
		showOn: "button",
		maxDate: '+0D', 
		buttonImage: "/images/calendar.gif",
		buttonImageOnly: true
	});
	});

	function filterStatistics()
	{
		var date = document.getElementById('selectdate').value;
		//alert(date);
		
		$.ajax({ 
				type: "POST",
				url: 'http://www.rayku.com/admin.php/statistics/ajaxstatistics?selectdate='+date,
				success: function(msg){
				//alert(msg);
					$("#logdisplay").html(msg);
				}
			}); 
			
		
	}

    </script>
<style type="text/css">

	@import '/sf/sf_admin/css/main.css' ;

	@import '/sf/sf_admin/css/pagination.css' ;


</style> 

<link rel="stylesheet" type="text/css" media="screen" href="http://www.rayku.com/css/pagination.css" />


<div id="sf_admin_container">  

<h1>Log Statistics List</h1>

<div id="sf_admin_content" style="font-size:12px;color:#444;vertical-align:middle;"> 
 
<div style="font-size:12px; color:#555A74; padding-bottom:20px;" >
Select the  Date: <input name="selectdate" type="text" style="width:80px;" id="selectdate" value="" onchange="javascript:filterStatistics();" />
</div>

<?php 

    $start25=date("Y-m-d")."  "."14:00:00";
	$end25=date("Y-m-d")."  "."17:00:00";
		    
	$start58=date("Y-m-d")."  "."17:00:00";
	$end58=date("Y-m-d")."  "."20:00:00";
    
	$start811=date("Y-m-d")."  "."20:00:00";
	$end811=date("Y-m-d")."  "."23:00:00";
	
	$start112=date("Y-m-d")."  "."23:00:00";
	$end112=date("Y-m-d")."  "."02:00:00";

	//2pm to 5pm	//
  				
						
    $tutoronline=mysql_num_rows(mysql_query("select * from log_user_login  
						 LEFT JOIN `user_profile` ON `user_profile`.`user_id` = `log_user_login`.`user_id` 
	 					 WHERE `log_user_login`.`login_date_time` BETWEEN '".$start25."' AND '".$end25."' 
	 					 AND `log_user_login`.`login_status`='1' "));
						 
	$studentonline=mysql_num_rows(mysql_query("select * from log_user_login  
						 LEFT JOIN `user_profile` ON `user_profile`.`user_id` != `log_user_login`.`user_id` 
	 					 WHERE `log_user_login`.`login_date_time` BETWEEN '".$start25."' AND '".$end25."' 
	 					 AND `log_user_login`.`login_status`='1' "));					 
						
	$tutorswentonline=mysql_num_rows(mysql_query("select * from log_user_on_off  
						 LEFT JOIN `user_profile` ON `user_profile`.`user_id` = `log_user_on_off`.`user_id` 
	 					 WHERE `log_user_on_off`.`off_date_time` BETWEEN '".$start25."' AND '".$end25."' 
	 					 AND `log_user_on_off`.`off_status`='1' "));	
						 
	$studentswentonline=mysql_num_rows(mysql_query("select * from log_user_on_off  
						 LEFT JOIN `user_profile` ON `user_profile`.`user_id` != `log_user_on_off`.`user_id` 
	 					 WHERE `log_user_on_off`.`off_date_time` BETWEEN '".$start25."' AND '".$end25."' 
	 					 AND `log_user_on_off`.`off_status`='1' "));	
						 
	$tutorswentoffline=mysql_num_rows(mysql_query("select * from log_user_on_off  
						 LEFT JOIN `user_profile` ON `user_profile`.`user_id` = `log_user_on_off`.`user_id` 
	 					 WHERE `log_user_on_off`.`off_date_time` BETWEEN '".$start25."' AND '".$end25."' 
	 					 AND `log_user_on_off`.`off_status`='0' "));	
						 
	$studentswentoffline=mysql_num_rows(mysql_query("select * from log_user_on_off  
						 LEFT JOIN `user_profile` ON `user_profile`.`user_id` != `log_user_on_off`.`user_id` 
	 					 WHERE `log_user_on_off`.`off_date_time` BETWEEN '".$start25."' AND '".$end25."' 
	 					 AND `log_user_on_off`.`off_status`='0' "));					 					 	
						 
	$connections_attempted_total=mysql_num_rows(mysql_query("select * from log_user_whiteboard 
						 WHERE `log_user_whiteboard`.`whiteboard_date_time` BETWEEN '".$start25."' AND '".$end25."' 
	 					 "));	
	$went_whiteboard=mysql_num_rows(mysql_query("select * from log_user_connect_whiteboard 
						 WHERE `log_user_connect_whiteboard`.`connect_date_time` BETWEEN '".$start25."' AND '".$end25."' 
						 AND `log_user_connect_whiteboard`.`connect_status`='1'
	 					 "));			
	$connections_failed=mysql_num_rows(mysql_query("select * from log_user_connect_whiteboard 
						 WHERE `log_user_connect_whiteboard`.`connect_date_time` BETWEEN '".$start25."' AND '".$end25."' 
						 AND `log_user_connect_whiteboard`.`connect_status`='0'
	 					 "));							 		 
	//2pm to 5pm	//
	
	
	//5pm to 8pm	//
					
    $tutoronline58=mysql_num_rows(mysql_query("select * from log_user_login  
						 LEFT JOIN `user_profile` ON `user_profile`.`user_id` = `log_user_login`.`user_id` 
	 					 WHERE `log_user_login`.`login_date_time` BETWEEN '".$start58."' AND '".$end58."' 
	 					 AND `log_user_login`.`login_status`='1' "));
						 
	$studentonline58=mysql_num_rows(mysql_query("select * from log_user_login  
						 LEFT JOIN `user_profile` ON `user_profile`.`user_id` != `log_user_login`.`user_id` 
	 					 WHERE `log_user_login`.`login_date_time` BETWEEN '".$start58."' AND '".$end58."' 
	 					 AND `log_user_login`.`login_status`='1' "));					 
						
	$tutorswentonline58=mysql_num_rows(mysql_query("select * from log_user_on_off  
						 LEFT JOIN `user_profile` ON `user_profile`.`user_id` = `log_user_on_off`.`user_id` 
	 					 WHERE `log_user_on_off`.`off_date_time` BETWEEN '".$start58."' AND '".$end58."' 
	 					 AND `log_user_on_off`.`off_status`='1' "));	
						 
	$studentswentonline58=mysql_num_rows(mysql_query("select * from log_user_on_off  
						 LEFT JOIN `user_profile` ON `user_profile`.`user_id` != `log_user_on_off`.`user_id` 
	 					 WHERE `log_user_on_off`.`off_date_time` BETWEEN '".$start58."' AND '".$end58."' 
	 					 AND `log_user_on_off`.`off_status`='1' "));	
						 
	$tutorswentoffline58=mysql_num_rows(mysql_query("select * from log_user_on_off  
						 LEFT JOIN `user_profile` ON `user_profile`.`user_id` = `log_user_on_off`.`user_id` 
	 					 WHERE `log_user_on_off`.`off_date_time` BETWEEN '".$start58."' AND '".$end58."' 
	 					 AND `log_user_on_off`.`off_status`='0' "));	
						 
	$studentswentoffline58=mysql_num_rows(mysql_query("select * from log_user_on_off  
						 LEFT JOIN `user_profile` ON `user_profile`.`user_id` != `log_user_on_off`.`user_id` 
	 					 WHERE `log_user_on_off`.`off_date_time` BETWEEN '".$start58."' AND '".$end58."' 
	 					 AND `log_user_on_off`.`off_status`='0' "));					 					 	
						 
	$connections_attempted_total58=mysql_num_rows(mysql_query("select * from log_user_whiteboard 
						 WHERE `log_user_whiteboard`.`whiteboard_date_time` BETWEEN '".$start58."' AND '".$end58."' 
	 					 "));	
	$went_whiteboard58=mysql_num_rows(mysql_query("select * from log_user_connect_whiteboard 
						 WHERE `log_user_connect_whiteboard`.`connect_date_time` BETWEEN '".$start58."' AND '".$end58."' 
						 AND `log_user_connect_whiteboard`.`connect_status`='1'
	 					 "));			
	$connections_failed58=mysql_num_rows(mysql_query("select * from log_user_connect_whiteboard 
						 WHERE `log_user_connect_whiteboard`.`connect_date_time` BETWEEN '".$start58."' AND '".$end58."' 
						 AND `log_user_connect_whiteboard`.`connect_status`='0'
	 					 "));							 		 
	//5pm to 8pm	//
	
	
	//8pm to 11pm	//
						
    $tutoronline811=mysql_num_rows(mysql_query("select * from log_user_login  
						 LEFT JOIN `user_profile` ON `user_profile`.`user_id` = `log_user_login`.`user_id` 
	 					 WHERE `log_user_login`.`login_date_time` BETWEEN '".$start811."' AND '".$end811."' 
	 					 AND `log_user_login`.`login_status`='1' "));
						 
	$studentonline811=mysql_num_rows(mysql_query("select * from log_user_login  
						 LEFT JOIN `user_profile` ON `user_profile`.`user_id` != `log_user_login`.`user_id` 
	 					 WHERE `log_user_login`.`login_date_time` BETWEEN '".$start811."' AND '".$end811."' 
	 					 AND `log_user_login`.`login_status`='1' "));					 
						
	$tutorswentonline811=mysql_num_rows(mysql_query("select * from log_user_on_off  
						 LEFT JOIN `user_profile` ON `user_profile`.`user_id` = `log_user_on_off`.`user_id` 
	 					 WHERE `log_user_on_off`.`off_date_time` BETWEEN '".$start811."' AND '".$end811."' 
	 					 AND `log_user_on_off`.`off_status`='1' "));	
						 
	$studentswentonline811=mysql_num_rows(mysql_query("select * from log_user_on_off  
						 LEFT JOIN `user_profile` ON `user_profile`.`user_id` != `log_user_on_off`.`user_id` 
	 					 WHERE `log_user_on_off`.`off_date_time` BETWEEN '".$start811."' AND '".$end811."' 
	 					 AND `log_user_on_off`.`off_status`='1' "));	
						 
	$tutorswentoffline811=mysql_num_rows(mysql_query("select * from log_user_on_off  
						 LEFT JOIN `user_profile` ON `user_profile`.`user_id` = `log_user_on_off`.`user_id` 
	 					 WHERE `log_user_on_off`.`off_date_time` BETWEEN '".$start811."' AND '".$end811."' 
	 					 AND `log_user_on_off`.`off_status`='0' "));	
						 
	$studentswentoffline811=mysql_num_rows(mysql_query("select * from log_user_on_off  
						 LEFT JOIN `user_profile` ON `user_profile`.`user_id` != `log_user_on_off`.`user_id` 
	 					 WHERE `log_user_on_off`.`off_date_time` BETWEEN '".$start811."' AND '".$end811."' 
	 					 AND `log_user_on_off`.`off_status`='0' "));					 					 	
						 
	$connections_attempted_total811=mysql_num_rows(mysql_query("select * from log_user_whiteboard 
						 WHERE `log_user_whiteboard`.`whiteboard_date_time` BETWEEN '".$start811."' AND '".$end811."' 
	 					 "));	
	$went_whiteboard811=mysql_num_rows(mysql_query("select * from log_user_connect_whiteboard 
						 WHERE `log_user_connect_whiteboard`.`connect_date_time` BETWEEN '".$start811."' AND '".$end811."' 
						 AND `log_user_connect_whiteboard`.`connect_status`='1'
	 					 "));			
	$connections_failed811=mysql_num_rows(mysql_query("select * from log_user_connect_whiteboard 
						 WHERE `log_user_connect_whiteboard`.`connect_date_time` BETWEEN '".$start811."' AND '".$end811."' 
						 AND `log_user_connect_whiteboard`.`connect_status`='0'
	 					 "));							 		 
	//8pm to 11pm	//

    //11pm to 2am	//
	
    $tutoronline112=mysql_num_rows(mysql_query("select * from log_user_login  
						 LEFT JOIN `user_profile` ON `user_profile`.`user_id` = `log_user_login`.`user_id` 
	 					 WHERE `log_user_login`.`login_date_time` BETWEEN '".$start112."' AND '".$end112."' 
	 					 AND `log_user_login`.`login_status`='1' "));
						 
	$studentonline112=mysql_num_rows(mysql_query("select * from log_user_login  
						 LEFT JOIN `user_profile` ON `user_profile`.`user_id` != `log_user_login`.`user_id` 
	 					 WHERE `log_user_login`.`login_date_time` BETWEEN '".$start112."' AND '".$end112."' 
	 					 AND `log_user_login`.`login_status`='1' "));					 
						
	$tutorswentonline112=mysql_num_rows(mysql_query("select * from log_user_on_off  
						 LEFT JOIN `user_profile` ON `user_profile`.`user_id` = `log_user_on_off`.`user_id` 
	 					 WHERE `log_user_on_off`.`off_date_time` BETWEEN '".$start112."' AND '".$end112."' 
	 					 AND `log_user_on_off`.`off_status`='1' "));	
						 
	$studentswentonline112=mysql_num_rows(mysql_query("select * from log_user_on_off  
						 LEFT JOIN `user_profile` ON `user_profile`.`user_id` != `log_user_on_off`.`user_id` 
	 					 WHERE `log_user_on_off`.`off_date_time` BETWEEN '".$start112."' AND '".$end112."' 
	 					 AND `log_user_on_off`.`off_status`='1' "));	
						 
	$tutorswentoffline112=mysql_num_rows(mysql_query("select * from log_user_on_off  
						 LEFT JOIN `user_profile` ON `user_profile`.`user_id` = `log_user_on_off`.`user_id` 
	 					 WHERE `log_user_on_off`.`off_date_time` BETWEEN '".$start112."' AND '".$end112."' 
	 					 AND `log_user_on_off`.`off_status`='0' "));	
						 
	$studentswentoffline112=mysql_num_rows(mysql_query("select * from log_user_on_off  
						 LEFT JOIN `user_profile` ON `user_profile`.`user_id` != `log_user_on_off`.`user_id` 
	 					 WHERE `log_user_on_off`.`off_date_time` BETWEEN '".$start112."' AND '".$end112."' 
	 					 AND `log_user_on_off`.`off_status`='0' "));					 					 	
						 
	$connections_attempted_total112=mysql_num_rows(mysql_query("select * from log_user_whiteboard 
						 WHERE `log_user_whiteboard`.`whiteboard_date_time` BETWEEN '".$start112."' AND '".$end112."' 
	 					 "));	
	$went_whiteboard112=mysql_num_rows(mysql_query("select * from log_user_connect_whiteboard 
						 WHERE `log_user_connect_whiteboard`.`connect_date_time` BETWEEN '".$start112."' AND '".$end112."' 
						 AND `log_user_connect_whiteboard`.`connect_status`='1'
	 					 "));			
	$connections_failed112=mysql_num_rows(mysql_query("select * from log_user_connect_whiteboard 
						 WHERE `log_user_connect_whiteboard`.`connect_date_time` BETWEEN '".$start112."' AND '".$end112."' 
						 AND `log_user_connect_whiteboard`.`connect_status`='0'
	 					 "));							 		 
	//11pm to 2am	//


?>


<div id="logdisplay">
<h1 style="font:Arial, Helvetica, sans-serif; color:#990000;"><?php echo date("F j, Y");?></h1>
<table class="sf_admin_list" cellspacing="0">
  <thead>
    <tr>
      <th>&nbsp;</th>
      <th>Tutors Online</th>
      <th>Students Online</th>
	  <th>Tutors went Online</th>
	  <th>Students went Online</th>
	  <th>Tutors went Offline</th>
	  <th>Student went Offline</th>
	  <th>Connections Attempted Total</th>
	  <th>Went to Whiteboard</th>
      <th>Connections Failed</th>
    </tr>
  </thead>
  <tbody>

	 <tr class="sf_admin_row">
     <td>2pm to 5pm</td>
	  <td><?php echo $tutoronline;?></td>
	  <td><?php echo $studentonline;?></td>
	  <td><?php echo $tutorswentonline;?></td>
	  <td><?php echo $studentswentonline;?></td>
	  <td><?php echo $tutorswentoffline;?></td>
	  <td><?php echo $studentswentoffline;?></td>
	  <td><?php echo $connections_attempted_total;?></td>
	  <td><?php echo $went_whiteboard;?></td>
	  <td><?php echo $connections_failed;?></td>
	  </tr>
	  
	  <tr class="sf_admin_row">
     <td>5pm to 8pm</td>
	  <td><?php echo $tutoronline58;?></td>
	  <td><?php echo $studentonline58;?></td>
	  <td><?php echo $tutorswentonline58;?></td>
	  <td><?php echo $studentswentonline58;?></td>
	  <td><?php echo $tutorswentoffline58;?></td>
	  <td><?php echo $studentswentoffline58;?></td>
	  <td><?php echo $connections_attempted_total58;?></td>
	  <td><?php echo $went_whiteboard58;?></td>
	  <td><?php echo $connections_failed58;?></td>
	  </tr>
	  
	  <tr class="sf_admin_row">
     <td>8pm to 11pm</td>
	   <td><?php echo $tutoronline811;?></td>
	  <td><?php echo $studentonline811;?></td>
	  <td><?php echo $tutorswentonline811;?></td>
	  <td><?php echo $studentswentonline811;?></td>
	  <td><?php echo $tutorswentoffline811;?></td>
	  <td><?php echo $studentswentoffline811;?></td>
	  <td><?php echo $connections_attempted_total811;?></td>
	  <td><?php echo $went_whiteboard811;?></td>
	  <td><?php echo $connections_failed811;?></td>
	  </tr>
	  
	  <tr class="sf_admin_row">
      <td>11pm to 2am</td>
	  <td><?php echo $tutoronline112;?></td>
	  <td><?php echo $studentonline112;?></td>
	  <td><?php echo $tutorswentonline112;?></td>
	  <td><?php echo $studentswentonline112;?></td>
	  <td><?php echo $tutorswentoffline112;?></td>
	  <td><?php echo $studentswentoffline112;?></td>
	  <td><?php echo $connections_attempted_total112;?></td>
	  <td><?php echo $went_whiteboard112;?></td>
	  <td><?php echo $connections_failed112;?></td>
	  </tr>


  </tbody>

<tfoot>

<tr><div class="float-right">
<th colspan="10"><?php //echo $pagination; ?> </th></div></tr>
</tfoot>
</table>

</div>

<ul class="sf_admin_actions">

</ul>

</div>

</div>

