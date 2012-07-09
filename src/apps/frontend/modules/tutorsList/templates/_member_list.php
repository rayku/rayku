<div id="tutorlist_ajax">

  <div class="body" >

    <div id="cn-body">
      <div class="body-connect-left">
        <div class="cn-left-bg" style="margin-top: 25px;">
          <div class="cn-left-top"></div>
          <h3 style="margin-bottom:8px;">Subject:</h3>
          <label>
          <form name="form1" id="form1" method="post">
            <select name="course" onchange="alert('TODO')">
              <option value="">--- SELECT ---</option>
              <?php
                /* @var $courses Courses[] */
                $courses = CoursesPeer::doSelect(new Criteria);
                foreach ($courses as $course) {
                    echo '<option value="' . $course->getId() . '" >' . $course->getCourseName() . ' </option>';
                }
              ?>
            </select>
          </form>
          </label>
          <div class="cn-spacer"></div>
          <h3>Filtering Options:</h3>
          <h4>Expert Status: <img src="../images/greyarrow-down.jpg" width="10" height="11" alt="" /></h4>
          <p><a href="" onClick="alert('TODO')">Online</a></p>
          <p><a href="" onClick="alert('TODO')">Offline</a></p>
          <h4>School: <img src="../images/greyarrow-down.jpg" width="10" height="11" alt="" /></h4>
          <select name="school" onchange="alert('TODO')" style="background:none;padding:4px;height:auto;border:1px solid #CCC">
            <option value="">---- SELECT ----</option>
            <option value="utoronto">University of Toronto</option>
            <option value="ubc">University of British Columbia</option>
          </select>
          <br/>
          <br />
          <p><a href="" onClick="alert('TODO')" style="color:darkred">Reset All Filter Settings</a></p>
        </div>
        <div class="cn-left-bottom"></div>
        <div id="popup_connect"> </div>
      </div>
      <div class="body-connect-right" style="margin-top:25px;">
        <form name='listform' id='listform' method='post' action="">
          <div style="width:700px;font-size:21px;color:#333;line-height:30px;margin-bottom:20px;font-weight:bold">Select the tutors that are relevant to your question:</div>
          <div class="cn-content">
              
          <div class="cn-right-top">
            <div class="cn-column-one" style="width:50px">Ranking</div>
            <div class="cn-column-one" style="width:445px">Rayku Experts</div>
            <!--<div class="cn-column-two" align="center"> <span id="ratesort" class="1" style="cursor:pointer;color:blue;">Rate /min. <span id="ratesymbol" style="display:none;">^</span> </span> </div>-->
			<div class="cn-column-two" align="center"> <span id="ratesort" class="1">Rate /min </span> </div>
            <div class="cn-column-four" align="center">Connect</div>
            <div class="clear-both"></div>
          </div>
          <div style="width:100%;text-align:center;margin-top:50px;" id="loadingimage"><img src="<?php echo image_path('loading1.gif', false); ?>"></div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
<!--memberlist--> 

<script type="text/javascript">
function loadingAjax()  
{ 
	var imagejsconflict = jQuery.noConflict();
	imagejsconflict(".cn-content").html('<div style="width:100%;text-align:center;margin-top:50px;"><img src="<?php echo image_path('loading1.gif', false); ?>"></div>');  
	return true;
}




function getSelectedTutors()
{
    var tutorsCheckboxes = jQuery("#listform input[type=checkbox]");
    var selectedTutors = [];
    var selectedTutorsIndex = 0;
    
    for (var i=0; i < tutorsCheckboxes.length; i++) {
        if (tutorsCheckboxes[i].checked) {
            selectedTutors[selectedTutorsIndex++] = tutorsCheckboxes[i].value;
        }
    }
    
    return selectedTutors;
}



function setvalue(event)
{
    var selectedTutors = getSelectedTutors();
    
    if (selectedTutors.length > <?php echo $maxTutorsCount; ?>) {
        event.preventDefault();
        alert("You are Limited To Select <?php echo $maxTutorsCount; ?> Expers At Once");
    } else {
        jQuery('#popup_connect').load('/tutorsList/popup', {'selectedTutorsIds': selectedTutors}, function(response) {
            jQuery("#popup_content").html(response);
        });
    }
}

function checkExpertCheckBoxes()
{
    var selectedTutors = getSelectedTutors();
    
    if (selectedTutors.length > 1) {
        return true;
    } else if (selectedTutors.length == 1) {
        var result = confirm("It's recommended to select 2 to <?php echo $maxTutorsCount; ?> experts for best results! Please click 'cancel' to do so, or 'ok' to continue anyways.");
        if (result == true) {
            return true;
        } else {
            return false;
        }
    } else {
        alert("Please select at least one expert for connect");
        return false;
    }
}





</script> 
