<div id="confirmationcontent">
<link href="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/css/confirmcode/jquery.selectbox.css" type="text/css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/css/confirmcode/popup-style.css" />
<!--filter popup-->
<div class="filter-popup"> 
  
  <!--filter popup inner-->
  <div class="filter-popup-inner"> 
  
    <form name="quick_registration" action="/quickreg/confirmuser" method="post">
    <!--row-1-->
    <div class="row-1">
     
        <p><img src="../images/confirmcode/warning.png" alt="Activation Code Warning" />
          <input type="text" name="confirmationcode" id="confirmationcode" value="Activation Code" onclick="if (this.value=='Activation Code') this.value='';" onblur="this.value = (this.value=='')? 'Activation Code' : this.value;">
          <?php if(isset($_SESSION['confirm_user_error'])): ?>
		  <span style="color:#FF0000;font-size:10px;"><?php echo $_SESSION['confirm_user_error']; ?></span> 	
		  <?php unset($_SESSION['confirm_user_error']);?>
		  <?php endif; ?>
		</p>
      
      <p>We have just sent you an email with an activation code. Please enter that code above before you continue.</p>
    </div>
    <!--row-1-->
    
    
      
      <!--row-2-->
      <div class="row-2 clearfix">
        <h3><span class="steps">Step 2 of 2:</span> Filter Relevant Tutors</h3>
        <p style="margin-bottom:15px;">Give us some more info about your question and we'll list the best tutors.</p>
        <select id="course_id" name="course_id">
        <option value="0">Choose question subject</option>
        <?php
        $catquery = mysql_query("SELECT s.id,c.id as catid,s.course_name,c.name FROM courses AS s JOIN category AS c ON c.id=s.category_id WHERE c.status=1");	
        while($cat = mysql_fetch_array($catquery))
        {
        ?>
          <option value="<?php echo $cat['id']; ?>"><?php echo $cat['course_name']; ?></option>          
        <?php } ?>  
        </select>
        
        <!--question form container-->
        <div id="personal-info" class="question-form-container">
          <p class="education">
            <label>
              <input type="radio" name="edu" class="university-info" value="1" checked="checked" />
              College / University</label>
            &nbsp;&nbsp;
            <label>
              <input type="radio" name="edu" class="highschool-info" value="2" />
              High School</label>
          
          <!--university info-->
          <div id="university-info" class="clearfix hide">
            <p class="info university-name">
              <input type="text" name="name" onblur="this.value = (this.value=='')? 'University Name' : this.value;" onclick="if (this.value=='University Name') this.value='';" value="University Name" />
              <?php //echo input_auto_complete_tag('name', '', 'quickreg/autocomplete', array('placeholder' => 'University Name'), array('use_style' => true)); ?>
            </p>
            <p class="info course-code">
              <input type="text" name="course_code" onblur="this.value = (this.value=='')? 'Course Code' : this.value;" onclick="if (this.value=='Course Code') this.value='';" value="Course Code" />
              <?php //echo input_auto_complete_tag('course_code', '', 'quickreg/autocourse', array('placeholder' => 'Course Code'), array('use_style' => true)); ?>
            </p>
            <p class="info year">
              <select name="asker_year" id="asker_year">
                <option value="Choose year" selected="selected">Choose year</option>
                <option value="1st Year">1st Year</option>
                <option value="2nd Year">2nd Year</option>
                <option value="3rd Year">3rd year</option>
                <option value="4th Year">4th Year+</option>
              </select>
            </p>
          </div>
          <!--university info--> 
          
          <!--highschool info-->
          <div id="highschool-info" class="clearfix hide">
            <p class="info grade">
              <select name="asker_grade" id="asker_grade">
                <option value="Choose grade" selected="selected">Choose grade</option>
                <option value="12th Grade">12th Grade</option>
                <option value="11th Grade">11th Grade</option>
                <option value="10th Grade">10th Grade</option>
                <option value="9th Grade">9th Grade</option>
                <option value="8th Grade">8th Grade</option>
              </select>
            </p>
            <input type="hidden" name="dash_hidden" value="1" />
          </div>
          <!--highschool info--> 
          
        </div>
        <!--question form container--> 
        
      </div>
      <!--row-2--> 
      
      <!--row-3-->
      <div class="row-3">
        <p>
          <input type="submit" id="filter" value="List Tutors" />
        </p>
      </div>
      <!--row-3-->
    
  </div>
  
  </form>
  <!--filter popup inner--> 
  
</div>
<!--filter popup--> 

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script> 
<script type="text/javascript" src="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/js/jquery.selectbox-0.1.3.min.js"></script>
<script type="text/javascript">
var ccp = jQuery.noConflict();			
ccp(".filter-popup").before("<div id='trans'></div>");

ccp(".filter-popup-close").click(function(){
		
		ccp(".filter-popup").fadeOut('slow');
		ccp("#trans").fadeOut('slow');
		return false;
});
	
ccp('#personal-info').hide();
ccp('.hide').hide();
ccp('#university-info').show();

ccp('.education input').click(function(){
		ccp('.hide').hide();
		var radioClass=ccp(this).attr('class');
		radioClass="#"+radioClass;
		ccp(radioClass).slideDown();
});


ccp('#course_id').selectbox();
ccp('#asker_year').selectbox();
ccp('#asker_grade').selectbox();

ccp('.sbHolder').bind('click', function() {

		if(ccp('.sbSelector').text()!="Choose question subjectChoose yearChoose grade")
			ccp('#personal-info').slideDown();
		else
		{
			ccp('#personal-info').hide();
		}
});	

ccp('.sbSelector').bind('click', function() {
		ccp(this).css({"border-color":"#bcbcbc"});
		
});	
ccp('.sbOptions a').bind('click', function() {
		ccp('.sbSelector').css({"border-color":"#d4d4d4"});
		
});
</script>
</div>
