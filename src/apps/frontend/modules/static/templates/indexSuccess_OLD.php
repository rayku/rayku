<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"

	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<?php if ($sf_user->isAuthenticated()){ 
	echo '<script type="text/javascript"> window.location = "http://www.rayku.com/dashboard" </script>';
	}
?>
<?php 
error_reporting(E_ALL);
ini_set('display_errors',1);
?>
<?php use_helper('Javascript'); ?>
<?php use_helper('Object') ?>
<head>
<?php include_http_metas() ?>
<?php include_metas() ?>
<?php include_title() ?>
<script type="text/javascript">
function validate()
{

	var email=document.getElementById('email').value;
	
	if(email == '')
	{
		document.getElementById('error_email').style.display = "block";
		document.getElementById('error_email').innerHTML = 'Email is empty';
		return false;
	}
	
	var patt1=new RegExp("^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$");

	if (patt1.test(email)==false)
	{

			document.getElementById('error_email').style.display = "block";
			document.getElementById('error_email').innerHTML = 'Email is not valid';
			return false;
	} 
	
	var email=document.getElementById('fullname').value;
	
	if(email == '')
	{
		document.getElementById('error_fullname').style.display = "block";
		document.getElementById('error_fullname').innerHTML = 'full name is empty';
		return false;
	}
	
	
	
		/*new Ajax.Request('/login/validateEmail?email='+email, {asynchronous:true, evalScripts:false, onComplete:function(request, json){
		
						if (200 == request.status) { 
						
							if(request.readyState==4) {  
							
							
								if(request.responseText == '1')
								{
									document.getElementById('error_email').style.display = "block";
									document.getElementById('error_email').innerHTML = 'Email is already exist, choose the different one.'; 
									
								}
								
												
							}
						}
					}
					
					}); */
	
	var username=document.getElementById('username').value;
	
	if(username == '')
	{
		document.getElementById('error_username').style.display = "block";
		document.getElementById('error_username').innerHTML = 'Your Username is empty';
		return false;
	}
	
	for(var j=0; j<username.length; j++)
	{
		  var alphaa = username.charAt(j);
		  var hh = alphaa.charCodeAt(0);
		  
		  if((hh > 47 && hh<58) || (hh > 64 && hh<91) || (hh > 96 && hh<123))
		  {
		  }
		  else	
		  {
                document.getElementById('error_username').style.display = "block";
				document.getElementById('error_username').innerHTML = 'Your username should only contain alphanumeric characters';
				return false;
		  }
 	}

	/*	new Ajax.Request('/login/validateUsername?username='+username, {asynchronous:true, evalScripts:false, onComplete:function(request, json){
	
					if (200 == request.status) { 
					
				  		if(request.readyState==4) {  
						
							alert(request.responseText);
							
							if(request.responseText == '2')
							{
								document.getElementById('error_username').style.display = "block";
								document.getElementById('error_username').innerHTML = 'Username is already exist, please choose the different one.'; 
								
							}
													
						}
					}
				}
				
				}); 
				*/
		
		
	
	var password=document.getElementById('password').value;
	
	if(password == '')
	{
		document.getElementById('error_password').style.display = "block";
		document.getElementById('error_password').innerHTML = 'Your Password is empty';
		return false;
	}
	
	if(password.length < 6)
	{
		document.getElementById('error_password').style.display = "block";
		document.getElementById('error_password').innerHTML = 'Your Password should be atleast 6 characters';
		return false;
	}
	
	
	if(document.getElementById('terms').checked == false)
	{
		document.getElementById('error_check').style.display = "block";
		document.getElementById('error_check').innerHTML = 'Please accept the terms and conditions.';
		return false;
	}


}
</script>
</head>

<div id="wrapper">
  <div class="left-knots"> <img src="../images/knot-1.png" class="knot-1" alt="knot"/> <img src="../images/knot-2.png" class="knot-2" style="top:453px;" alt="knot"/> </div>
  <div class="primary">
    <?php include_partial('global/topNav'); ?>
    <div id="body">
      <div class="body-main index"><!--want-->
        
        <div id="intro">
          <h2>Don't Just Know It, UNDERSTAND IT!</h2>
          <p style="font-size:14px">In our new tomorrow, information exchange is direct and personal. Through real people as real experts, Rayku uses new-decade technology to <em>show</em> you the information you're looking for, so you <u>understand</u>!</p>
          <a href="tourpage" class="learn-more" title="Learn More">Learn More</a> <a href="register" class="sign-up" title="Free Sign-up">Free Sign-up!</a> </div>
        <div id="what-is">
          <h2>What is Rayku?</h2>
          <p style="margin:0 20px 20px 10px"><strong>Rayku.com</strong> is a social network designed to connect avid learners, with  experts most qualified to teach them. Rayku provides online tools to simplify and 'bring home' online communication, so <strong>anyone</strong> <strong>anywhere</strong>, can access it at <strong>any time</strong>. Interested in learning more? Take the quick <a href="tourpage">Rayku Tour</a>!</p>
          <div class="brief social">
            <h3>Social Network Environment</h3>
            Rayku brings you a Facebook-like environment to take the 'yawn' out of learning. </div>
          <!--brief-->
          
          <div class="brief tech">
            <h3>Technology-Centric Learning</h3>
            Rayku brings you a 3-level learning system to connect your questions to step-by-step live, or pre-recorded video explanations. </div>
          <!--brief-->
          
          <div class="brief class">
            <h3>E-Classrooms (K-12 Beta)</h3>
            Rayku brings you teacher websites for each of your classes to allow student-to-class communication outside of school.</div>
          <!--brief--> 
          
        </div>
        <!-- end of what-is --> 
        
      </div>
      <!-- end of body-main -->
      
      <div id="sidebar">
        <h1 class="fb">Quick Register</h1>
        <div class="text">
          <p>Register your account in <em><strong>34 seconds</strong></em>, and immediately take advantage of Rayku today.</p>
          <form action="login/facebooklogin" method="post">
            <div id="error_email" style="display:none;color:#FF0000; font-size:12px;"></div>
            <input type="text" name="email" id="email" value="Email Address" onblur="if(this.value=='') this.value='Email Address';" onfocus="if(this.value=='Email Address') this.value='';" />
            <div id="error_fullname" style="display:none;color:#FF0000; font-size:12px;" ></div>
            <input type="text" name="fullname" id="fullname" value="Full Name" onblur="if(this.value=='') this.value='Full Name';" onfocus="if(this.value=='Full Name') this.value='';" />
            <div id="error_username" style="display:none;color:#FF0000; font-size:12px;" ></div>
            <input type="text" name="username" id="username" value="Profile Username" onblur="if(this.value=='') this.value='Profile Username';" onfocus="if(this.value=='Profile Username') this.value='';" />
            <div id="error_password" style="display:none;color:#FF0000; font-size:12px;"></div>
            <input name="password" type="password" id="password" value="Password" onblur="if(this.value=='') this.value='Password';" onfocus="if(this.value=='Password') this.value='';" />
            <label style="font-size:13px; font-weight:normal; color:#667">
              <input type="checkbox" value="1" name="terms" id="terms" />
              Agree to the <a href="#">Terms &amp; Conditions</a>.</label>
            <div id="error_check" style="display:none;color:#FF0000; font-size:12px;"></div>
            <input type="submit" name="submit" class="regg" value="" onclick="return validate();" />
            <a href="http://<?=$_SERVER['HTTP_HOST']?>/register" class="regb">&nbsp;</a>
            <div class="clear-both"></div>
          </form>
        </div>
        <!--text-->
        
        <h1 class="search">Find a Classmate / Friend</h1>
        <div class="text">
          <p>Quickly find some of your classmates and friends through our refined search.</p>
          <?php echo form_tag('search/index', array('method' => 'post')); ?>
          <label>Name, Email, Hobbies, or Interests:</label>
          <input type="text" name="criteria"/>
          <input type="submit" class="search" value=" " />
          <?php echo '</form>'; ?> </div>
        <!--text--> 
      </div>
      <!--sidebar--> 
      
      <br class="clear-both" />
      <?php echo form_tag('search/index', array('method' => 'post','id'=>'grand-search')) ?>
      <fieldset>
        <?php $options=array("people"=>"People","groups"=>"Groups","forums"=>"Forums"); ?>
        <span style="font-size:16px;margin-right:10px;font-weight:bold">Search Rayku:</span>
        <input type="text" name="criteria" class="text-box" value="<?php echo $sf_request->getParameter('criteria') ?>" />
        <?php echo select_tag("findfrom",options_for_select($options,$sf_request->getParameter('findfrom'))); ?>
        <input type="submit" value="Search" />
      </fieldset>
      </form>
    </div>
    <!--end of div#body -->
    
    <div id="footer">
      <div class="foo">
        <div class="partners"> <a href="http://www.kinkarso.com" target="_blank"><img src="../../../images/img-footer-logo-2.png" alt="kinkarso.com"/></a> <a href="http://www.rayku.com" target="_blank"><img src="../../../images/img-footer-logo-1.png" alt="rayku.com"/></a> </div>
        <p>Copyright 2010 Rayku.com.  All rights reserved.</p>
        <p>Rayku is a subsidary of Kinkarso Tech, LLC.</p>
        <ul>
          <li><a href="#">legal</a></li>
          <li><a href="#">privacy</a></li>
          <li class="nobg"><a href="#">contact us</a></li>
        </ul>
      </div>
    </div>
    <!-- end of footer --> 
    
  </div>
  <!-- end of primary --> 
</div>
<!-- end of wrapper -->

</body></html>