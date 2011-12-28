<?php use_helper('Javascript', 'MyForm') ?>
<link href="../css/style-reg-table.css" rel="stylesheet" type="text/css" media="screen" />

<div class="body-main">
  <div id="top" style="margin:10px 0 15px 0"> <span style="background:url(../../../images/arrow-right.gif) no-repeat; padding-left:40px; color:#1C517C; font-size:20px; font-weight:bold">Create your account</span> </div>
  <div class="clear"></div>
  <div style="font-size:16px;color:#333;padding-left:40px">Sorry! We are currently in a closed private beta. Want to take a look inside? Sign up for our early-bird list:<br />
  <form method=post action="https://app.icontact.com/icp/signup.php" name="icpsignup" id="icpsignup128" accept-charset="UTF-8" onsubmit="return verifyRequired128();" >
<input type=hidden name=redirect value="http://www.icontact.com/www/signup/thanks.html" />
<input type=hidden name=errorredirect value="http://www.icontact.com/www/signup/error.html" />

<div id="SignUp" style="margin-top:25px">
<div style="float:left;margin-right:20px">
        <input type=text name="fields_email" value="Email Address" style="padding:7px;width:200px;font-size:14px" onblur="if(this.value=='') this.value='Email Address';" onfocus="if(this.value=='Email Address') this.value='';">
        </div>
        <div>
        <input type="submit" name="Submit" value="Secure Spot!" style="font-size:14px; padding:4px"></div>


    <input type=hidden name="listid" value="1755">
    <input type=hidden name="specialid:1755" value="Y93F">

    <input type=hidden name=clientid value="907989">
    <input type=hidden name=formid value="128">
    <input type=hidden name=reallistid value="1">
    <input type=hidden name=doubleopt value="0">


</div>
</form>
<script type="text/javascript">

var icpForm128 = document.getElementById('icpsignup128');

if (document.location.protocol === "https:")

	icpForm128.action = "https://app.icontact.com/icp/signup.php";
function verifyRequired128() {
  if (icpForm128["fields_email"].value == "") {
    icpForm128["fields_email"].focus();
    alert("The Email Address field is required.");
    return false;
  }


return true;
}
</script>
</div>
</div>
<script type="text/javascript">

function emailValidateNew()
{
var email = document.getElementById('email').value;

var mailadd = email.split("@");

		var finalsplit = mailadd[1].split(".");

		if(mailadd[1] == "utoronto.ca")
		{
			
		}
		else if(mailadd[1] == "alumni.utoronto.ca")
		{
			
		}
		else if(mailadd[1] == "toronto.edu")
		{
		
		}
		else
		{
			document.getElementById('error').style.display = "block";
			document.getElementById('error').innerHTML = 'Error: Rayku is currently available for certain schools only. Please a your @utoronto.ca or @toronto.edu email address.';
			return false;
		} 


var subject = document.getElementById('course_subject[]').value;

var course = document.getElementById('course_name[]').value;

var year = document.getElementById('course_year').value;

var grade = document.getElementById('grade[0]').value;



	if(subject == '')
	{
			document.getElementById('error').style.display = "block";
			document.getElementById('error').innerHTML = 'Please enter at least one course entry.';
			return false;

	} else if(course == '') {

			document.getElementById('error').style.display = "block";
			document.getElementById('error').innerHTML = 'Please enter at least one course entry.';
			return false;
		
	}else if(year == '') {

			document.getElementById('error').style.display = "block";
			document.getElementById('error').innerHTML = 'Please enter at least one course entry.';
			return false;
		
	} else if(grade == '') {

			document.getElementById('error').style.display = "block";
			document.getElementById('error').innerHTML = 'Please enter at least one course entry.';
			return false;
		
	}

}
</script> 
<script type="text/javascript">
	        function addRow(tableID) {


	 
	            var table = document.getElementById(tableID);
	            var rowCount = table.rows.length;
	            var row = table.insertRow(rowCount);


	
		   var newCount =  rowCount - 1;

	            var colCount = table.rows[2].cells.length;
	 
	            for(var i=0; i<colCount; i++) {
 
	                var newcell = row.insertCell(i);


			if(i == '2')
			{
				
			 table.rows[rowCount].cells[i].innerHTML = "<table width='100%' border='0' cellspacing='0' cellpadding='0' style='margin-right:10px'><tr><td align='center' style='border:0;padding:0'><label class='d'><input type='radio' name= grade[" + newCount + "] value='D'></label></td><td align='center' style='border:0;padding:0'><label class='c'><input type='radio' name= grade[" + newCount + "] value='C'></label></td><td align='center' style='border:0;padding:0'><label class='b'><input type='radio' name= grade[" + newCount + "] value='B'></label></td><td align='center' style='border:0;padding:0'><label class='a'><input  type='radio' name= grade[" + newCount + "] value='A'></label></td></tr></table>";

				newcell.innerHTML = table.rows[rowCount].cells[i].innerHTML;

			} else {
	                	newcell.innerHTML = table.rows[2].cells[i].innerHTML;
			}


	            }
        }
</script> 
