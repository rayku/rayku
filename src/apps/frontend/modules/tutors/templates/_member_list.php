<div id="tutorlist_ajax">

<?php
$connection = RaykuCommon::getDatabaseConnection();
$_pageNavigation = !empty($_GET['page']) ? $_GET['page'] : 1; $_value = 1; $loopCount = 5;
$_Max_Count = intval($tutorsCount / 15) + 1;  $loopCount = $_Max_Count; if($loopCount > 5) : $loopCount = 5; endif;
?>
  <?php $_rateCookie = '';  $_classRate  = '';
if(empty($_SESSION["rateDisplay"])) :
	$_rateCookie = 1;
elseif(!empty($_SESSION["rateDisplay"])) :
	$_rateCookie = 2;
	 $_classRate  = '^';
endif; ?>
  <div class="body" >

    <?php $sfuser=$sf_user->getRaykuUser()->getID();?>
    <div id="cn-body">
      <div class="body-connect-left">
        <div class="cn-left-bg" style="margin-top: 25px;">
          <div class="cn-left-top"></div>
          <h3 style="margin-bottom:8px;">Subject:</h3>
          <label>
          <form name="form1" id="form1" method="post">
            <select name="course" onchange="this.form.submit();">
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
          <p><a href="" onClick="return setStatus(1)">Online</a></p>
          <p><a href="" onClick="return setStatus(2)">Offline</a></p>
          <h4>School: <img src="../images/greyarrow-down.jpg" width="10" height="11" alt="" /></h4>
          <select name="school" onchange="return setSchool(this.value)" style="background:none;padding:4px;height:auto;border:1px solid #CCC">
            <option value="">---- SELECT ----</option>
            <option value="utoronto" <?php if($_COOKIE["school"] == "utoronto"): ?> selected="selected" <?php endif; ?> >University of Toronto</option>
            <option value="ubc" <?php if($_COOKIE["school"] == "ubc"): ?> selected="selected" <?php endif; ?> >University of British Columbia</option>
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

		var cookcount = getCookie('cookcount');

		if(cookcount)
		{
			var icount=cookcount;
		}
		else
		{
			var icount = 0;		
		}
		
		/* var tutorcount = getCookie('tutorcount');
		if(tutorcount)
		{
			var expertcount=tutorcount;
		}
		else
		{
			var expertcount = 0;		
		} */ 
		var expertcount = 0;
		var tutorcount = expertcount;
		
		function callSetSession(checkboxid, type) {
									

			dv.ajax({ cache: false,
				type : "POST",
				url: "/tutors/checkbox?id="+checkboxid+"&type="+type

				});

			}
		
		dv("#tutorlist").ready(function() 
		{			
			/* dv('#popup_connect').load('/tutors/checkoutpopup', '', function(response) 
			{
				dv("#popup_content").html(response);
		    
			});
			set_background(); */

			var icount = getCookie('cookcount');

			for(j=1;j<=icount;j++)
			{
				var cookieval = getCookie("tutor_"+j);
				
				var currcookie = "tutor_"+j;	
				var chkCook = getCookie(currcookie);
				if(chkCook!='')
				{			
					var cookie_date = new Date();  // current date & time
		
					cookie_date.setTime(cookie_date.getTime() - 1);
		
					document.cookie = currcookie += "=; expires=" + cookie_date.toGMTString()+";path=/;domain="+window.globalConfig.cookies_domain;;
			
					
					

					/* dv('#popup_connect').load('/tutors/checkoutpopup', '', function(response) {
		
					   dv("#popup_content").html(response);			   
					    
					http://www.rayku.com});
		
					var chkbox = "checkbox_"+cookieval;
		
					if(document.getElementById(chkbox).checked==true)
					{
						document.getElementById(chkbox).checked = false;
					}  */
				}							
				
			}

			var tcook = "tutorcount";
			var ccook = "cookcount";
			var cookie_date = new Date();  // current date & time

			cookie_date.setTime(cookie_date.getTime() - 1);

			document.cookie = tcook += "=; expires=" + cookie_date.toGMTString()+";path=/;domain="+window.globalConfig.cookies_domain;;
			
			document.cookie = ccook += "=; expires=" + cookie_date.toGMTString()+";path=/;domain="+window.globalConfig.cookies_domain;;
			
			
			/* var remaintcount = getCookie('tutorcount');			

			var cookie_date = new Date();  // current date & time
			
			cookie_date.setTime(cookie_date.getTime() - 1);

			document.cookie = remaintcount += "=; expires=" + cookie_date.toGMTString();

			

			var cookie_date = new Date();  // current date & time
			
			cookie_date.setTime(cookie_date.getTime() - 1);

			document.cookie = icount += "=; expires=" + cookie_date.toGMTString();
			*/
			
			
			
		});
		
		
		function set_background()
		{
			var icount = getCookie('cookcount');
			for(j=1;j<=icount;j++)
			{
				var cookieval = getCookie("tutor_"+j);
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
			
			for(j=1;j<=icount;j++)
			{
				var cookieval = getCookie("tutor_"+j);
				
				if(cookieval == tid)
				{
					var currcookie = "tutor_"+j;								
				}
			}
			
			var chkCook = getCookie(currcookie);
			if(chkCook!='')
			{			
				var tcount = getCookie('tutorcount');
			
				tcount=tcount-1;
			
				expertcount = tcount;
			
				setCookie("tutorcount", tcount, 1)	
			
				var cookie_date = new Date();  // current date & time
			
				cookie_date.setTime(cookie_date.getTime() - 1);
			
				document.cookie = currcookie += "=; expires=" + cookie_date.toGMTString()+";path=/;domain="+window.globalConfig.cookies_domain;;
				
				dv('#popup_connect').load('/tutors/checkoutpopup', '', function(response) {
			
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
			if(expertcount == 4) {

				if(document.getElementById(a).checked == true)
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
			
				expertcount=parseInt(expertcount)+1;
			
				icount = parseInt(icount)+1;
		
			var tutname = "tutor_"+icount;
			
			var maxcook = icount;
			
			setCookie(tutname, tid, 1);
			
			setCookie("cookcount", maxcook, 1);
												
			setCookie("tutorcount", expertcount, 1);
			

			dv('#popup_connect').load('/tutors/checkoutpopup', '', function(response) {
			
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
			
			for(j=1;j<=icount;j++)
			{
				var cookieval = getCookie("tutor_"+j);
				if(cookieval == tid)
				{
					var currcookie = "tutor_"+j;			
				}
			}
						
			expertcount=expertcount-1;

			setCookie("tutorcount", expertcount, 1);
			
			var cookie_date = new Date();  // current date & time
			
			cookie_date.setTime(cookie_date.getTime() - 1);
			
			document.cookie = currcookie += "=; expires=" + cookie_date.toGMTString()+";path=/;domain="+window.globalConfig.cookies_domain;;

			dv('#popup_connect').load('/tutors/checkoutpopup', '', function(response) {
			
			    dv("#popup_content").html(response);
			    
			});


			}



		}
		
		
		function rowCheck(a)
		{	
			var newvalue = a.split('.');					
			var b = "checkbox_"+newvalue[0];

			if(document.getElementById(b).checked==false)
			{	
				if(expertcount == 4) 
				{
					alert("You are limited to select four expers at once");
					return false;
				}
				else
				{
					if(!document.getElementById(b).checked)
					{

						document.getElementById(b).checked=true;

						document.getElementById("first"+newvalue[0]).style.backgroundColor = '#DEF3FE';
				
						expertcount=parseInt(expertcount)+1;
			
						icount = parseInt(icount)+1;
								
						var tid = newvalue[0];
						var tutname = "tutor_"+icount;
						var maxcook = icount;
						setCookie(tutname, tid, 1);
						setCookie("cookcount", maxcook, 1);
						setCookie("tutorcount", expertcount, 1);
				
							dv('#popup_connect').load('/tutors/checkoutpopup', '', function(response) {
			
						    		dv("#popup_content").html(response);
						    
							});
				
						//icount = icount+1;
					}
				}
			}		
			else
			{

				document.getElementById(b).checked=false;

				document.getElementById("first"+newvalue[0]).style.backgroundColor = '';
				expertcount=expertcount-1;
			
				setCookie("tutorcount", expertcount, 1);
			
				var tid = newvalue[0];
			
		
				for(m=1;m<=icount;m++)
				{
					var cookieval = getCookie("tutor_"+m);
			
					if(cookieval == tid)
					{
						var currcookie = "tutor_"+m;			
					}
				}	
			
				var cookie_date = new Date(); 
		
				cookie_date.setTime(cookie_date.getTime() - 1);
		
				document.cookie = currcookie += "=; expires=" + cookie_date.toGMTString()+";path=/;domain="+window.globalConfig.cookies_domain;;
			
					dv('#popup_connect').load('/tutors/checkoutpopup', '', function(response) {
		
				    		dv("#popup_content").html(response);
				    
					});
			
				 
			
			}
		}
		

		function checkExpertCheckBoxes()
		{ 


			var online_user = document.getElementById("online_user").value;

			
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
          <br/>
          <br />
          <p><a href="" onClick="return reSet(0)" style="color:darkred">Reset All Filter Settings</a></p>
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
</script> 
