<?php
$connection = RaykuCommon::getDatabaseConnection();

  $raykuUser = $sf_user->getRaykuUser();
  $stats = $raykuUser->getStatisticsForDashboard();

?>
<?php use_helper('Javascript', 'MyForm') ?>
<div id="askqu">
  <link rel="stylesheet" type="text/css" href="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/css/form.css" />
  <link href="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/css/jquery.selectbox.css" type="text/css" rel="stylesheet" />
  
  <!--form-->
  <form action="expertmanager/list" id="form-for-questions" name="form-for-questions" method="post">
    <input type="hidden" name="dash_hidden"  id="dash_hidden" value="1" />
    
    <!--question form-->
    <div id="question-form" style="background:#F5F5F5"> 
      
      <!--question form container-->
      <div class="question-form-container">
        <p id="error" align="center" style="display:none;" class="cn-pricepermin"><em style="font-size:14px;color:red;line-height:20px;">Oops, you missed something!</em></p>
        <p class="question"><img src="<?php echo image_path('question-icon.png', false); ?>" alt="Question" style="z-index:5;position:relative" /><input type="text" placeholder="Describe question in one sentence" id="question" name="question"/></p>
        
        <!--recent questions-->
            <?php $_queryTag = mysql_query("select * from user_question_tag where category_id = 1 and user_id=".$raykuUser->getId(), $connection) or die("Error-->1".mysql_error());
		  if(mysql_num_rows($_queryTag)) { ?>
             <div id="dumpquestionrecent">
          <div id="recent-questions">
			  <h3>Recent Question Filters (<a href="#">?</a>):</h3>
			<input type="hidden" name="dummycount" id="dummycount" value="1" />
            <ul id="tags" >
              <?php while($_rowTag = mysql_fetch_assoc($_queryTag)) { ?>
              <li><img src="<?php echo image_path('tag.jpg', false); ?>" alt="tag" class="tag" /> 
                <!--<a href="#" style="a:hover{text-decoration:none;}" id="<?php echo $_rowTag['id'];?>" class="waste" > --> 
                <small style="a:hover{text-decoration:none;};cursor:pointer;" onclick="return clicktagclick(this.id);" id="clicktag_<?php echo $_rowTag['id'];?>" class="clicktag waste" >
				
				<?php $_queryCourse = mysql_query("select * from courses where id =".$_rowTag['course_id'], $connection) or die("Error-->2".mysql_error());

	          $_rowCourse = mysql_fetch_assoc($_queryCourse); ?>
                <span id="course_category_<?php echo $_rowTag['id'];?>" class="<?php echo $_rowCourse['id']; ?>" > <?php echo $_rowCourse['course_name'];?></span>
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
			?>
                <i style="display:none;" name='hidden_education_<?php echo $_rowTag['id']; ?>' id='hidden_education_<?php echo $_rowTag['id']; ?>'>1</i>
                <?php
		}
		else if($_rowTag['education'] == 2)
		{
		?>
                <i style="display:none;" name='hidden_education_<?php echo $_rowTag['id']; ?>' id='hidden_education_<?php echo $_rowTag['id']; ?>'>2</i>
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
                </small> <span style="cursor:pointer;" id="delete_<?php echo $_rowTag['id'];?>" class="cross" onclick="return crossclick(this.id);">cross</span> </li>
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
            <?php $_queryCourses = mysql_query("select * from courses where category_id = 1", $connection) or die("Error-->3".mysql_error());

		  if(mysql_num_rows($_queryCourses)) { 
			while($_rowCourses = mysql_fetch_assoc($_queryCourses)) { ?>
            <option value="<?php echo $_rowCourses['id'];?>"><?php echo $_rowCourses['course_name'];?></option>
            <?php } }?>
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
            <?php $to = ''; echo input_auto_complete_tag('name', '', 'dashboard/autocomplete', array('placeholder' => 'School Name'), array('use_style' => true)); ?>
          </p>
          <p class="info course" id="autocomplecourse"> <?php echo input_auto_complete_tag('autocourse', '', 'dashboard/autocourse', array('placeholder' => 'Course Code'), array('use_style' => true)); ?>
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
  
  <script type="text/javascript" src="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/js/jquery.selectbox-0.1.3.min.js"></script>
  <script type="text/javascript" src="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/js/jquery.placeholders.js"></script> 
  <script type="text/javascript">
        var dummy_count_jque = jQuery.noConflict();
		dummy_count_jque(window).load(function() {
			var optionaldata = "<span>optional</span>";
			dummy_count_jque('#autocomplecourse').append(optionaldata);
			dummy_count_jque('#autocompleschool').append(optionaldata);
		});
		if(dummy_count_jque("#dummycount"))
		{
			if(dummy_count_jque("#dummycount").val() == 1)
			{
				dummy_count_jque("#recent-questions").slideDown();
				//dummy_count_jque("#hideload_course_category").slideDown();
				
			}
			else if(dummy_count_jque("#dummycount").val() == 0)
			{
				dummy_count_jque("#recent-questions").hide();
				//dummy_count_jque("#hideload_course_category").hide();
			}
			
		}
function CheckMsg() {
var rayku_as = jQuery.noConflict();

var question = document.getElementById('question').value;
//var subject = document.getElementById('courses').value;
var subject = rayku_as(".sbSelector").html();

var error = '<p class="cn-pricepermin"><em style="font-size:14px;color:red;line-height:20px;">Oops, you missed something!</em></p>';
if(question == "Describe question in one sentence") {

	document.getElementById('error').style.display = "block";

	return false;
}
if(question == "") {

	document.getElementById('error').style.display = "block";

	return false;
}
if(subject == 'Choose subject category') {
	
	document.getElementById('error').style.display = "block";
	return false;
}
document.getElementById('error').style.display = "none";

var course_category_hidden = rayku_ask("#course_category").attr("sb");
//var course_code_hidden = rayku_ask("#course_code").attr("sb");
var year_hidden = rayku_ask("#year").attr("sb");
var grade_hidden = rayku_ask("#grade").attr("sb");

rayku_ask("#course_category_hidden").val(rayku_ask("#sbSelector_"+course_category_hidden).html());
rayku_ask("#course_code_hidden").val(rayku_ask("#autocourse").val());
rayku_ask("#year_hidden").val(rayku_ask("#sbSelector_"+year_hidden).html());
rayku_ask("#grade_hidden").val(rayku_ask("#sbSelector_"+grade_hidden).html());

return true;

}
function crossclick(id)
{
var rayku_ask = jQuery.noConflict();
//rayku_ask(".cross").click(function () {
	//alert('coming');
	//var originaldeleteid = rayku_ask("#delete_ac").attr("sbb");
	
	var deleteids = id;
	var originaldeleteid = deleteids.split("delete_");
	rayku_ask.post("http://www.rayku.com/dashboard/tag", { id: originaldeleteid },
   function(data) {
	rayku_ask("#dumpquestionrecent").load("http://www.rayku.com/dashboard #recent-questions");
	//rayku_ask('#recent-questions').load('http://www.rayku.com/dashboard');
	
	if(data == 0)
	{
		rayku_ask('#recent-questions').hide();
	}

	var course_category = rayku_ask("#course_category").attr("sb");
	var year = rayku_ask("#year").attr("sb");
	var grade = rayku_ask("#grade").attr("sb");
	rayku_ask("#sbSelector_"+course_category).text("Choose subject category");
	rayku_ask("#sbSelector_"+year).text("Choose year");
	rayku_ask("#name").val("");
	rayku_ask("#autocourse").val("");
	rayku_ask('#personal-info').hide();

   });
   
	//});
}
function clicktagclick(id)
{
var rayku_ask = jQuery.noConflict();
//rayku_ask('.clicktag').click(function() {
	
	rayku_ask('#tags li small').removeClass('selected');
	
var course_category = rayku_ask("#course_category").attr("sb");
//var course_code = rayku_ask("#course_code").attr("sb");
var year = rayku_ask("#year").attr("sb");
var grade = rayku_ask("#grade").attr("sb");
var ids = id;
var originalid = ids.split("clicktag_");
var atags = rayku_ask("#clicktag_"+originalid[1]).attr("class");
var school = "";
var unicheck = "";
if (rayku_ask("#university_"+originalid[1]).html())
{
	school = rayku_ask("#university_"+originalid[1]).html();
	unicheck = 1;
}
else if (rayku_ask("#school_"+originalid[1]).html())
{
	school = rayku_ask("#school_"+originalid[1]).html();
	unicheck = 2;
}
else
{
	unicheck = 3;
}


if(atags.indexOf("selected") == 6)
{
	rayku_ask("#clicktag_"+originalid[1]).removeClass('selected');
	//rayku_ask(".sbSelector").html() = "Prealgebra";//rayku_ask("#course_category_"+originalid[1]).html();
	rayku_ask("#sbSelector_"+course_category).text("Choose subject category");
	//rayku_ask("#sbSelector_"+course_code).text("Course Code");
	rayku_ask("#sbSelector_"+year).text("Choose year");
	rayku_ask("#name").val("");
	rayku_ask("#autocourse").val("");
	rayku_ask('#personal-info').hide();
	
}
else if(atags.indexOf("selected") == -1)
{

	rayku_ask("#clicktag_"+originalid[1]).addClass('selected');
	if(unicheck == 2)
	{
		rayku_ask(".highschool-info").attr("checked","checked");
		rayku_ask('.hide').hide();
		rayku_ask("#highschool-info").slideDown();
		rayku_ask("#sbSelector_"+course_category).text(rayku_ask("#course_category_"+originalid[1]).html());
		rayku_ask(".highschool-info").attr("checked","checked");
		
		if(rayku_ask("#grade_"+originalid[1]).html())
		{
			rayku_ask("#sbSelector_"+grade).text(rayku_ask("#grade_"+originalid[1]).html());
		}
		else
		{
			rayku_ask("#sbSelector_"+grade).text("Choose grade");
		}
		

	}
	else if(unicheck == 1)
	{
		rayku_ask(".university-info").attr("checked","checked");
		rayku_ask('.hide').hide();
		rayku_ask("#university-info").slideDown();
		rayku_ask("#sbSelector_"+course_category).text(rayku_ask("#course_category_"+originalid[1]).html());
		if(rayku_ask("#course_code_"+originalid[1]).html())
		{
			//rayku_ask("#sbSelector_"+course_code).text(rayku_ask("#course_code_"+originalid[1]).html());
			rayku_ask("#autocourse").val(rayku_ask("#course_code_"+originalid[1]).html());
		}
		else
		{
			//rayku_ask("#sbSelector_"+course_code).text("Choose Code");
			rayku_ask("#autocourse").val('');
		}
		if(rayku_ask("#year_"+originalid[1]).html())
		{
			rayku_ask("#sbSelector_"+year).text(rayku_ask("#year_"+originalid[1]).html());
			rayku_ask("#sbSelector_"+grade).text("Choose grade");
		}
		else
		{
			rayku_ask("#sbSelector_"+year).text("Choose Year");
			rayku_ask("#sbSelector_"+grade).text("Choose grade");
		}
		if(school)
		{
			rayku_ask("#name").val(school);
		}
		else
		{
			rayku_ask("#name").val('');
		}

		/*var course_category_select = rayku_ask("#course_category_"+originalid[1]).attr("class");
		var course_code_select = rayku_ask("#course_code_"+originalid[1]).attr("class");
		var year_select = rayku_ask("#year_"+originalid[1]).attr("class");
		alert(course_category_select);
		*/
		
	}
	else if(unicheck == 3)
	{
		//rayku_ask("#clicktag_"+originalid[1]).addClass('selected');
		rayku_ask("#sbSelector_"+course_category).text(rayku_ask("#course_category_"+originalid[1]).html());

		if(rayku_ask("#hidden_education_"+originalid[1]).html() == 1) 
		{
			if(school)
			{
				rayku_ask("#name").val(school);
			}
			else
			{
				rayku_ask("#name").val('');
			}
			rayku_ask(".university-info").attr("checked","checked");
			rayku_ask('.hide').hide();
			rayku_ask("#university-info").slideDown();
		}
		else if(rayku_ask("#hidden_education_"+originalid[1]).html() == 2) 
		{
			if(school)
			{
				rayku_ask("#name").val(school);
			}
			else
			{
				rayku_ask("#name").val('');
			}
			rayku_ask("#autocourse").val('');
			rayku_ask("#sbSelector_"+year).text("Choose year");
			
			rayku_ask(".highschool-info").attr("checked","checked");
			rayku_ask('.hide').hide();
			rayku_ask("#sbSelector_"+grade).text("Choose grade");
			rayku_ask("#highschool-info").slideDown();
			if(rayku_ask("#grade_"+originalid[1]).html())
			{
				rayku_ask("#sbSelector_"+grade).text(rayku_ask("#grade_"+originalid[1]).html());
			}
			else
			{
				rayku_ask("#sbSelector_"+grade).text("Choose grade");
			}
		
		}
		

	}
	
	rayku_ask('#personal-info').slideDown();
}
  
//});

				
}
				//rayku_ask('#tags li a').click(function(){
					/*rayku_ask('.waste').click(function(){
						if(rayku_ask(this).attr('class') == 'selected')
							
						else if(rayku_ask(this).attr('class') != 'selected')
							rayku_ask(this).addClass('selected');
						
				});
				*/
				var rayku_ask = jQuery.noConflict();
				rayku_ask('#personal-info').hide();
				rayku_ask('.hide').hide();
				rayku_ask('#university-info').show();
				
				rayku_ask('.education input').click(function(){
					//var course_code = rayku_ask("#course_code").attr("sb");
					var year = rayku_ask("#year").attr("sb");
					var grade = rayku_ask("#grade").attr("sb");
						rayku_ask('.hide').hide();
						var radioClass=rayku_ask(this).attr('class');
						radioClass="#"+radioClass;
						if(radioClass == "#highschool-info")
						{
							rayku_ask("#name").val('');
							rayku_ask("#sbSelector_"+year).text("Choose Year");
							//rayku_ask("#sbSelector_"+course_code).text("Choose Code");
							rayku_ask("#autocourse").val('');
						}
						else
						{
							rayku_ask("#sbSelector_"+grade).text("Choose grade");
						}
						rayku_ask(radioClass).slideDown();
				});
				
				
				rayku_ask("select").selectbox();
				
				rayku_ask('.sbHolder').bind('click', function() {
						//alert(rayku_ask('.sbSelector').text());
						if(rayku_ask('.sbSelector').text() != "Choose subject categoryChoose yearChoose grade")
						{
							rayku_ask('#personal-info').slideDown();
						}
						else
						{
							rayku_ask('#personal-info').hide();
						}
				});	
				
				rayku_ask('.sbSelector').bind('click', function() {
						rayku_ask(this).css({"border-color":"#bcbcbc"});
						
				});	
				rayku_ask('.sbOptions a').bind('click', function() {
					
						rayku_ask('.sbSelector').css({"border-color":"#d4d4d4"});
						
				});
				
				rayku_ask(document).ready(placeholders());
				
		</script> 
</div>
