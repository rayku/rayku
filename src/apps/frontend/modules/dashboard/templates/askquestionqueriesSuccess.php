<?php
$connection = RaykuCommon::getDatabaseConnection();

  $raykuUser = $sf_user->getRaykuUser();
  $stats = $raykuUser->getStatisticsForDashboard();

?>
   	 <?php $_queryTag = mysql_query("select * from user_question_tag where category_id = 1 and user_id=".$raykuUser->getId(), $connection) or die("Error-->1".mysql_error());
		  if(mysql_num_rows($_queryTag)) { ?>
				 <h3>Recent Question Filters:</h3>
				<input type="hidden" name="dummycount" id="dummycount" value="1" />
		<ul id="tags" >
			 <?php while($_rowTag = mysql_fetch_assoc($_queryTag)) { ?>

                                <li><img src="<?php echo image_path('tag.jpg', false); ?>" alt="tag" class="tag" />
	<!--<a href="#" style="a:hover{text-decoration:none;}" id="<?php echo $_rowTag['id'];?>" class="waste" > -->
<small style="a:hover{text-decoration:none;};cursor:pointer;" id="clicktag_<?php echo $_rowTag['id'];?>" class="clicktag waste" >
		 <?php $_queryCourse = mysql_query("select * from courses where id =".$_rowTag['course_id'], $connection) or die("Error-->2".mysql_error());

	          $_rowCourse = mysql_fetch_assoc($_queryCourse); ?> <span id="course_category_<?php echo $_rowTag['id'];?>" class="<?php echo $_rowCourse['id']; ?>" > <?php echo $_rowCourse['course_name'];?></span>

		<?php 
			if ($_rowTag['year'] != 'Choose year' ) {
		if(!empty($_rowTag['year']) && ($_rowTag['year'] > 4) ):  ?>

			<span id="grade_<?php echo $_rowTag['id'];?>" class="<?php echo $_rowTag['year']; ?>" ><?php echo $_rowTag['year']; ?></span>

		<?php elseif(!empty($_rowTag['year']) && ($_rowTag['year'] <= 4) ) :  ?>

			<span id="year_<?php echo $_rowTag['id'];?>" class="<?php echo $_rowTag['year']; ?>"><?php echo $_rowTag['year']; ?></span>

		<?php endif; }?> 
		<?php 
		if ($_rowTag['education'] == 1)
		{
			?> <i style="display:none;" name='hidden_education_<?php echo $_rowTag['id']; ?>' id='hidden_education_<?php echo $_rowTag['id']; ?>'>1</i>
		<?php
		}
		else if($_rowTag['education'] == 2)
		{
		?><i style="display:none;" name='hidden_education_<?php echo $_rowTag['id']; ?>' id='hidden_education_<?php echo $_rowTag['id']; ?>'>2</i>
		<?php
		}
		?>
		<?php if(!empty($_rowTag['school']) && ($_rowTag['education'] == 1)): ?>

			<span id="university_<?php echo $_rowTag['id'];?>" class="<?php echo $_rowTag['education']; ?>"> <?php echo $_rowTag['school']; ?></span>

		<?php elseif(!empty($_rowTag['school']) && ($_rowTag['education'] == 2)) : ?>

			<span id="school_<?php echo $_rowTag['id'];?>" class="<?php echo $_rowTag['education']; ?>" > <?php echo $_rowTag['school']; ?></span>

		<?php endif;?> 

		<?php 
			if ($_rowTag['course_code'] != 'Course Code' ) {
		if(!empty($_rowTag['course_code'])): ?>

			<span id="course_code_<?php echo $_rowTag['id'];?>" class="<?php echo $_rowTag['course_code']; ?>" > <?php echo $_rowTag['course_code']; ?></span>

		<?php endif; } ?> 

</small>
<span style="cursor:pointer;" id="delete_<?php echo $_rowTag['id'];?>" class="cross" >cross</span>
</li>


				 <?php } ?>   </ul> <?php } else { ?>
<input type="hidden" name="dummycount" id="dummycount" value="0" />
<?php } ?>

