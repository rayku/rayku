<?php
   $con = mysql_connect("localhost", "rayku_db", "db_*$%$%");
   $db = mysql_select_db("rayku_db", $con);
?>
<ul>
	 <?php $_queryCode = mysql_query("select * from course_sub where category_id = 1 and course_id=1") or die("Error-->4".mysql_error());

		  if(mysql_num_rows($_queryCode)) { 
			while($_rowCode = mysql_fetch_assoc($_queryCode)) { ?>
			
   <li style="font-size:16px;"><?php echo $_rowCode['course_code'];?></li>
	<?php } }?>
</ul>
