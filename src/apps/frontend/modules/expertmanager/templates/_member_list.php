<?php

$_pageNavigation = !empty($_GET['page']) ? $_GET['page'] : 1; $_value = 1; $loopCount = 5;
$_Max_Count = intval($tutorsCount / 15) + 1;  $loopCount = $_Max_Count; if($loopCount > 5) : $loopCount = 5; endif;

?>

<div class="body">

  <?php $sfuser=$sf_user->getRaykuUser()->getID();?>
  <div id="cn-body">
    <div class="body-connect-left">
      <div class="cn-left-bg" style="margin-top: 25px;">
        <div class="cn-left-top"></div>
        <h3 style="margin-bottom:8px;">Subject:</h3>

       <?php $_queryCourse = mysql_query("select * from courses") or die("Error-->2".mysql_error()); ?>


        <label>
        <form name="form1" id="form1" method="post">
          <select name="course" onchange="this.form.submit();">
            <option value="">--- SELECT ---</option>
            <?php while($_rowCourse = mysql_fetch_assoc($_queryCourse)) { ?>

			    <option value="<?php echo $_rowCourse['id'];?>" <?php if($course_id == $_rowCourse['id']): ?> selected="selected" <?php endif; ?> >
			    <?php echo $_rowCourse['course_name'];?>
			    </option>

            <?php } ?>
          </select>
        </form>
        </label>
        <div class="cn-spacer"></div>
        <h3>Filtering Options:</h3>

        <h4>Tutor Status: <img src="../images/greyarrow-down.jpg" width="10" height="11" alt="" /></h4>
        <p><a href="" onClick="return setStatus(1)">Online</a></p>
        <p><a href="" onClick="return setStatus(2)">Offline</a></p>

        <h4>School: <img src="../images/greyarrow-down.jpg" width="10" height="11" alt="" /></h4>
        <select name="school" onchange="return setSchool(this.value)" style="background:none;padding:4px;height:auto;border:1px solid #CCC">
          <option value="">---- SELECT ----</option>
          <option value="utoronto" <?php if(@$_COOKIE["school"] == "utoronto"): ?> selected="selected" <?php endif; ?> >University of Toronto</option>
          <option value="ubc" <?php if(@$_COOKIE["school"] == "ubc"): ?> selected="selected" <?php endif; ?> >University of British Columbia</option>
        </select>

<script language="javascript">

function setStatus(value)
{
		 var onoff;
		 document.cookie = "onoff"+ "=" +value;

}

function setSchool(value)
{

var school;
document.cookie = "school"+ "=" +value;
window.location.reload();
}


function reSet(value)
{
	     var onoff;
		 var ss;
		 var school;
		 document.cookie = "onoff"+ "=" +value;
	     document.cookie = "ss"+ "=" +value;
	     document.cookie = "school"+ "=" +value;

}

</script>

        <script lang="text/javascript">

		var count_checkboxclicks=0;
	    	//var expertcount=0;
	    	var expertIds=new Array();
		var origMouseX = 0;
		var currentSliderValue = 0;
		var maxSliderValue = 168;
		var minSliderValue = 0;
		var dv = jQuery.noConflict();
		//var icount = 1;

		var cooktotal = getCookie('cooktotal');

		if(cooktotal)
		{
			var icount=cooktotal;
		}
		else
		{
			var icount = 0;
		}

		var expertscount = getCookie('expertscount');

		if(expertscount)
		{
			var expertcount=expertscount;
		}
		else
		{
			var expertcount = 0;
		}

    function callSetSession(checkboxid, type) {
      dv.ajax({ cache: false,
        type : "POST",
        url: "/expertmanager/checkbox?id="+checkboxid+"&type="+type
      });
    }

		function setCheckboxColor(id)
		{
			if (document.getElementById("checkbox_"+id).checked == true)
			{
				document.getElementById("first"+id).style.backgroundColor = '#DEF3FE';

			}

		}

		function set_background()
		{
			var icount = getCookie('cooktotal');
			for(j=1;j<=icount;j++)
			{
				var cookieval = getCookie("expert_"+j);

				if(cookieval)
				{
					document.getElementById("first"+cookieval).style.backgroundColor = '#DEF3FE';
				}

			}
		}

		function deletecookie(a)
		{
			var tid = parseInt(a);

			document.getElementById("first"+tid).style.backgroundColor = '';

			/* Delete Cookie */
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

			//alert(currcookie);

			var chkCook = getCookie(currcookie);

			if(chkCook!='')
			{

				var tcount = getCookie('expertscount');

				tcount=tcount-1;

				expertcount = tcount;

				setCookie("expertscount", tcount, 36000)

				var cookie_date = new Date();  // current date & time

				cookie_date.setTime(cookie_date.getTime() - 1);

				document.cookie = currcookie += "=; expires=" + cookie_date.toGMTString();
				dv('#popup_connect').load('/expertmanager/checkoutpopup', '', function(response) {
				   dv("#popup_content").html(response);

				});

				var chkbox = "checkbox_"+tid;

				if(document.getElementById(chkbox).checked==true)
				{
					document.getElementById(chkbox).checked = false;
				}
		    	}
		}

		function setvalue(a)
		{
			//alert(a);
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


		function rowCheck(a){


			var newvalue = a.split('.');

			var b = "checkbox_"+newvalue[0];

			if(!document.getElementById(b).checked)
			{
				var expertcount = getCookie('expertscount');
				expertcount = parseInt(expertcount);
				if(expertcount == 4)
				{
					alert("You are Limited To Select Four Expers At Once");
					return false;
				}
				else
				{
					document.getElementById(b).checked=true;

					document.getElementById("first"+newvalue[0]).style.backgroundColor = '#DEF3FE';

					var expertcount = getCookie('expertscount');
					expertcount = parseInt(expertcount)+1;

					var icount = getCookie('cooktotal');
					icount = parseInt(icount)+1;

					var tid = newvalue[0];
					var tutname = "expert_"+icount;
					var maxcook = icount;
					setCookie(tutname, tid, 36000);
					setCookie("cooktotal", maxcook, 36000);
					setCookie("expertscount", expertcount, 36000);
						dv('#popup_connect').load('/expertmanager/checkoutpopup', '', function(response) {
					    		dv("#popup_content").html(response);

						});

					//icount = icount+1;
				}
			}
			else
			{
				document.getElementById(b).checked=false;

				document.getElementById("first"+newvalue[0]).style.backgroundColor = '';

				var tid = newvalue[0];

				var cooktotal = getCookie('cooktotal');
				var expertcount = getCookie('expertscount');


				if(cooktotal)
				{
					var icount=cooktotal;
				}

				for(m=1;m<=icount;m++)
				{
					var cookieval = getCookie("expert_"+m);

					if(cookieval == tid)
					{
						var currcookie = "expert_"+m;

					}
				}
				expertcount=expertcount-1;

				setCookie("expertscount", expertcount, 36000);

				var cookie_date = new Date();

				cookie_date.setTime(cookie_date.getTime() - 1);

				document.cookie = currcookie += "=; expires=" + cookie_date.toGMTString();
					dv('#popup_connect').load('/expertmanager/checkoutpopup', '', function(response) {
				    		dv("#popup_content").html(response);

					});



			}



		}


		function checkExpertCheckBoxes()
		{

			var online_user = document.getElementById("online_user").value;
			var expertcount = getCookie('expertscount');

			if(expertcount > 1)
			{
				return true;

			} else if(expertcount == 1 && online_user == 1) {

				return true;

			}

			if(expertcount == 1)
			{

				var result = confirm("It's recommended to select 2 to 4 experts for best results! Please click 'cancel' to do so, or 'ok' to continue anyways.");
				if (result == true)
				  {
				  	return true;
				  }
				else
				  {
				 	 return false;
				  }


			}

			if(expertcount == 0) {

				alert("Please select at least one expert for connect");
				return false;

			}
		}


        </script>

        <br/><br />
        <p><a href="" onClick="return reSet(0)" style="color:darkred">Reset All Filter Settings</a></p>

      </div>
      <div class="cn-left-bottom"></div>

	<div id="popup_connect">

	</div>
    </div>
    <div class="body-connect-right" style="margin-top: 25px;">
      <form name='listform' id='listform' method='post' action="">
      <div style="width:680px;font-size:21px;color:#333;line-height:30px;margin-bottom:20px;font-weight:bold;">Select the tutors that are relevant to your question:
		</div>
        <input type="hidden" name="hidden" value="hidden" />
        <div class="cn-content">
			<div class="cn-right-top">
				<div class="cn-column-one" style="width:510px">Rayku Experts</div>
				<div class="cn-column-two" align="center">Rate /min.</div>
				<div class="cn-column-four" align="center">Connect</div>
				<div class="clear-both"></div>
	        </div>
      <!--<a href="whiteboard">-->
          <div style="width:100%;text-align:center;margin-top:50px;" id="loadingimage"><img src="<?php echo image_path('loading1.gif', false); ?>"></div>
		<!-- new page -->

			      </form>
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
</script>

