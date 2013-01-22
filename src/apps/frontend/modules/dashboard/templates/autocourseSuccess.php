<?php
$connection = RaykuCommon::getDatabaseConnection();
?>
<ul>
	 <?php $_queryCode = mysql_query("select * from course_sub where category_id = 1 and course_id=1", $connection) or die("Error-->4".mysql_error());

		  if(mysql_num_rows($_queryCode)) { 
			while($_rowCode = mysql_fetch_assoc($_queryCode)) { ?>
			
   <li style="font-size:16px;"><?php echo $_rowCode['course_code'];?></li>
	<?php } }?>
</ul>
