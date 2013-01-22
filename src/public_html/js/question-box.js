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
