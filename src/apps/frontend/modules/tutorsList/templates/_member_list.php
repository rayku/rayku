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
          <input type="hidden" name="hidden" value="hidden" />
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






function setvalue(a)
{
    var form = jQuery("#listform input")[0];
    console.log(form);
    var selectedTutors = [];
    debugger;
    for (var i=0; i < tutorsCheckboxes; i++) {
        if (tutorsCheckboxes[i].checked) {
            selectedTutors.include(tutorsCheckboxes[i].value);
        }
    }
    
    console.log(selectedTutors);
    
    var expertcount = getCookie('expertscount');
    expertcount = parseInt(expertcount);

    if(expertcount == 4) {
        if (document.getElementById(a).checked == true)
        {
            document.getElementById(a).checked = false;
            alert("You are Limited To Select Four Expers At Once");
            return false;
        }
    }

    if (document.getElementById(a).checked == true)
    {

        var newId = a.split('_');

        var lastOne = newId[1];

        var tid = lastOne;

        document.getElementById("first"+tid).style.backgroundColor = '#DEF3FE';

        var expertcount = getCookie('expertscount');
        expertcount=parseInt(expertcount)+1;

        var cooktotal = getCookie('cooktotal');
        var icount=parseInt(cooktotal)+1;


        var tutname = "expert_"+icount;

        var maxcook = icount;

        setCookie(tutname, tid, 36000);

        setCookie("cooktotal", maxcook, 36000);

        setCookie("expertscount", expertcount, 36000);

        dv('#popup_connect').load('/expertmanager/checkoutpopup', '', function(response) {
            dv("#popup_content").html(response);

        });

    }

    if (document.getElementById(a).checked == false)
    {

        var newId = a.split('_');

        var lastOne = newId[1];

        var tid = lastOne;

        document.getElementById("first"+tid).style.backgroundColor = '';

        var b = 'checkbox_'+tid;

        document.getElementById(b).checked = false;

        var cooktotal = getCookie('cooktotal');

        if(cooktotal)
        {
                var icount=cooktotal;
        }

        for(j=1;j<=icount;j++)
        {
                var cookieval = getCookie("expert_"+j);

                if(cookieval == tid)
                {
                        var currcookie = "expert_"+j;
                }
        }

        var tcount = getCookie('expertscount');

        tcount=tcount-1;

        expertcount = tcount;

        setCookie("expertscount", expertcount, 36000);

        var cookie_date = new Date();  // current date & time

        cookie_date.setTime(cookie_date.getTime() - 1);

        document.cookie = currcookie += "=; expires=" + cookie_date.toGMTString();

        dv('#popup_connect').load('/expertmanager/checkoutpopup', '', function(response) {
            dv("#popup_content").html(response);

        });


    }



}








</script> 
