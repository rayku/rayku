<?php
  $raykuUser = $sf_user->getRaykuUser();
  $stats = $raykuUser->getStatisticsForDashboard();

  $c = new Criteria;
  $c->add(UserQuestionTagPeer::CATEGORY_ID, 1);
  $c->add(UserQuestionTagPeer::USER_ID, $raykuUser->getId());
  $userQuestionTags = UserQuestionTagPeer::doSelect($c);
  
  if(count($userQuestionTags) > 0) { ?>
				 <h3>Recent Question Filters:</h3>
				<input type="hidden" name="dummycount" id="dummycount" value="1" />
		<ul id="tags" >
			 <?php foreach($userQuestionTags as $userQuestionTag) { ?>

                                <li><img src="<?php echo image_path('tag.jpg', false); ?>" alt="tag" class="tag" />
	<!--<a href="#" style="a:hover{text-decoration:none;}" id="<?php echo $userQuestionTag->getId();?>" class="waste" > -->
<small style="a:hover{text-decoration:none;};cursor:pointer;" id="clicktag_<?php echo $userQuestionTag->getId();?>" class="clicktag waste" >
		 <?php
                    $course = CoursesPeer::retrieveByPK($userQuestionTag->getCourseId());
                ?>
    
                <span id="course_category_<?php echo $userQuestionTag->getId();?>" class="<?php echo $course->getId(); ?>" > <?php echo $course->getCourseName();?></span>

		<?php 
			if ($userQuestionTag->getYear() != 'Choose year' ) {
		if($userQuestionTag->getYear() != '' && ($userQuestionTag->getYear() > 4) ):  ?>

			<span id="grade_<?php echo $userQuestionTag->getId();?>" class="<?php echo $userQuestionTag->getYear(); ?>" ><?php echo $userQuestionTag->getYear(); ?></span>

		<?php elseif($userQuestionTag->getYear() != '' && ($userQuestionTag->getYear() <= 4) ) :  ?>

			<span id="year_<?php echo $userQuestionTag->getId();?>" class="<?php echo $userQuestionTag->getYear(); ?>"><?php echo $userQuestionTag->getYear(); ?></span>

		<?php endif; }?> 
		<?php 
		if ($userQuestionTag->getEducation() == 1)
		{
			?> <i style="display:none;" name='hidden_education_<?php echo $userQuestionTag->getId(); ?>' id='hidden_education_<?php echo $userQuestionTag->getId(); ?>'>1</i>
		<?php
		}
		else if($userQuestionTag->getEducation() == 2)
		{
		?><i style="display:none;" name='hidden_education_<?php echo $userQuestionTag->getId(); ?>' id='hidden_education_<?php echo $userQuestionTag->getId(); ?>'>2</i>
		<?php
		}
		?>
		<?php if($userQuestionTag->getSchool() != '' && ($userQuestionTag->getEducation() == 1)): ?>

			<span id="university_<?php echo $userQuestionTag->getId();?>" class="<?php echo $userQuestionTag->getEducation(); ?>"> <?php echo $userQuestionTag->getSchool(); ?></span>

		<?php elseif($userQuestionTag->getSchool() != '' && ($userQuestionTag->getEducation() == 2)) : ?>

			<span id="school_<?php echo $userQuestionTag->getId();?>" class="<?php echo $userQuestionTag->getEducation(); ?>" > <?php echo $userQuestionTag->getSchool(); ?></span>

		<?php endif;?> 

		<?php 
			if ($userQuestionTag->getCourseCode() != 'Course Code' ) {
		if($userQuestionTag->getCourseCode() != ''): ?>

			<span id="course_code_<?php echo $userQuestionTag->getId();?>" class="<?php echo $userQuestionTag->getCourseCode(); ?>" > <?php echo $userQuestionTag->getCourseCode(); ?></span>

		<?php endif; } ?> 

</small>
<span style="cursor:pointer;" id="delete_<?php echo $userQuestionTag->getId();?>" class="cross" >cross</span>
</li>


				 <?php } ?>   </ul> <?php } else { ?>
<input type="hidden" name="dummycount" id="dummycount" value="0" />
<?php } ?>

