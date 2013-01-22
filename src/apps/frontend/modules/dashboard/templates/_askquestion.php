<?php
  $raykuUser = $sf_user->getRaykuUser();
  $stats = $raykuUser->getStatisticsForDashboard();

?>
<?php use_helper('Javascript', 'MyForm') ?>
<div id="askqu">
  
  <!--form-->
  <form action="expertmanager/list" id="form-for-questions" name="form-for-questions" method="post">
    <input type="hidden" name="dash_hidden"  id="dash_hidden" value="1" />
    
    <!--question form-->
    <div id="question-form" style="background:#F5F5F5"> 
      
      <!--question form container-->
      <div class="question-form-container">
        <p id="error" align="center" style="display:none;" class="cn-pricepermin"><em style="font-size:14px;color:red;line-height:20px;">Oops, you missed something!</em></p>
        <p class="question"><img src="<?php echo image_path('question-icon.png', false); ?>" alt="Question" style="z-index:5;position:relative" width="45" height="44" /><input type="text" placeholder="Describe question in one sentence" id="question" value="<?php echo $sf_params->get('question') ?>" name="question"/></p>
        
        <!--recent questions-->
            <?php
                $c = new Criteria;
                $c->add(UserQuestionTagPeer::CATEGORY_ID, 1);
                $c->add(UserQuestionTagPeer::USER_ID, $raykuUser->getId());
                $userQuestionTags = UserQuestionTagPeer::doSelect($c);
                if(count($userQuestionTags) > 0) { ?>
             <div id="dumpquestionrecent">
          <div id="recent-questions">
			  <h3>Recent Question Filters (<a href="#">?</a>):</h3>
			<input type="hidden" name="dummycount" id="dummycount" value="1" />
            <ul id="tags" >
              <?php foreach($userQuestionTags as $userQuestionTag) { ?>
              <li><img src="<?php echo image_path('tag.jpg', false); ?>" alt="tag" class="tag" width="10" height="10" /> 
                <!--<a href="#" style="a:hover{text-decoration:none;}" id="<?php echo $userQuestionTag->getId();?>" class="waste" > --> 
                <small style="a:hover{text-decoration:none;};cursor:pointer;" onclick="return clicktagclick(this.id);" id="clicktag_<?php echo $userQuestionTag->getId();?>" class="clicktag waste" >
				
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
			?>
                <i style="display:none;" name='hidden_education_<?php echo $userQuestionTag->getId(); ?>' id='hidden_education_<?php echo $userQuestionTag->getId(); ?>'>1</i>
                <?php
		}
		else if($userQuestionTag->getEducation() == 2)
		{
		?>
                <i style="display:none;" name='hidden_education_<?php echo $userQuestionTag->getId(); ?>' id='hidden_education_<?php echo $userQuestionTag->getId(); ?>'>2</i>
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
                </small> <span style="cursor:pointer;" id="delete_<?php echo $userQuestionTag->getId();?>" class="cross" onclick="return crossclick(this.id);">cross</span> </li>
              <?php } ?>
            </ul>
			 </div>
        </div>
		 <!--recent questions-->
            <?php } else { ?>
            <input type="hidden" name="dummycount" id="dummycount" value="0" />
            <?php } ?>
       
        
        <div id="hideload_course_category">
          <select id="course_category" name="course_category">
            <option value="0">Choose subject category</option>
            <?php
                $courses = CoursesPeer::getAllForCategoryId(1);

		if($courses) {
                    foreach ($courses as $course) {
                        echo '<option value="'.$course->getId().'">'.$course->getCourseName().'</option>';
                    }
                }
            ?>
          </select>
        </div>
        <input type="hidden" name="course_category_hidden" id="course_category_hidden" value="" />
      </div>
      <!--question form container--> 
      
      <!--question form container-->
      <div id="personal-info" class="question-form-container">
        <p class="education">
          <label>
            <input type="radio" name="edu" class="university-info" value="1" checked="checked" />
            College / University</label>
          <label>
            <input type="radio" name="edu" class="highschool-info" value="2" style="margin-left:10px;"/>
            High School </label>
        </p>
        
        <!--university info-->
        <div id="university-info" class="clearfix hide">
          <p class="info university-name" id="autocompleschool">
            <?php $to = ''; echo input_auto_complete_tag('name', '', 'dashboard/autocomplete', array('placeholder' => 'School Name'), array('use_style' => false)); ?>
          </p>
          <p class="info course" id="autocomplecourse"> <?php echo input_auto_complete_tag('autocourse', '', 'dashboard/autocourse', array('placeholder' => 'Course Code'), array('use_style' => false)); ?>
          </p>
          <input type="hidden" name="course_code_hidden" id="course_code_hidden" value="" />
          <p class="info year">
            <select id='year' name='year'>
              <option value='0'>Choose year</option>
              <option value='1'>1st Year</option>
              <option value='2' >2nd Year</option>
              <option value='3' >3rd Year</option>
              <option value='4'>4th Year+</option>
            </select>
            <input type="hidden" name="year_hidden" id="year_hidden" value="" />
            <span>optional</span></p>
        </div>
        <!--university info--> 
        
        <!--highschool info-->
        <div id="highschool-info" class="clearfix hide">
          <p class="info grade">
            <select id='grade' name='grade'>
              <option value='0' >Choose grade</option>
              <option value='12' >12th Grade</option>
              <option value='11' >11th Grade</option>
              <option value='10'>10th Grade</option>
              <option value='9' >9th Grade</option>
              <option value="8" >8th Grade</option>
            </select>
            <input type="hidden" name="grade_hidden" id="grade_hidden" value="" />
            <span>optional</span></p>
        </div>
        <!--highschool info--> 
        
      </div>
      <!--question form container--> 
      
    </div>
    <!--question form-->
    
    <input type="submit" value="Ask Now" onClick="return CheckMsg();" />
  </form>
  <!--form--> 
  
</div>
