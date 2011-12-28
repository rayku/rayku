<!--<style type="text/css">

	@import '/sf/sf_admin/css/main.css' ;

</style> 


<div id="sf_admin_container">  

<h1>Mass Mail :</h1>

<div id="sf_admin_content"> 

<ul class="sf_admin_actions">

      <li class="float-left">

	<?php if($_SESSION['mailsent']) : ?>

			<b>Mail Has Sent Successfully.</b>
			
	<?php unset($_SESSION['mailsent']); ?>

	<?php endif; ?>

     </li>

 </ul>


<br/>



<ul class="sf_admin_actions">


      <li class="float-left">
	  <form method="post" class="button_to" action="/admin.php/massmail/sendmail">
	  <div>

		Click Here To Send Mass Mail For All Rayku Users : 
	  	<input value="Send Mail" type="submit">
	  </div>
	  </form>
	 </li>

 </ul>



</div>

</div>--->


<style type="text/css">

	@import '/sf/sf_admin/css/main.css' ;

</style> 


<div id="sf_admin_container">  

<div id="sf_admin_content"> 

<h1>Mass Mail :</h1>

<ul>

      <li class="float-left">

	<?php if($flag) : ?>

			<b>Mail Has Sent Successfully</b>


	<?php endif; ?>

     </li>

 </ul>


<br/><br/><br/>



<form name="massmail" class="button_to" action="/admin.php/massmail/sendmail" onsubmit="return validateForm()" method="post">
  
  <fieldset id="sf_fieldset_none">

	  
<fieldset id="sf_fieldset_none" class="">





<div class="form-row">
  <label for="category_name" class="required"><label for="massmail_subject">Subject</label></label>  

  <div class="content">
   <input type="text" size='50' name="massmail_subject" id="massmail_subject" /> 
    <div id="error1" style="color:#FF0000; font-size:12px;padding-bottom:5px" align="right"></div> 
 </div>



</div>

 
 <div class="form-row">
  <label for="category_name" class="required"><label for="massmail_content">Content</label></label>  
   
  <div class="content">
   <textarea rows="5" cols="75" name="massmail_content" id="massmail_content"></textarea>  
      <div id="error2" style="color:#FF0000; font-size:12px;padding-bottom:5px" align="right"></div> 
 </div>

</div>

</fieldset>




<ul class="sf_admin_actions">


      <li class="float-right">
		<!--Click Here To Send Mass Mail For All Rayku Users : -->
	  	<input value="Send Mail" type="submit">

	  </form>
	 </li>

 </ul>

</form>

  
</div>

<script type="text/javascript">

function validateForm() {


var subject =document.forms["massmail"]["massmail_subject"].value;
var content =document.forms["massmail"]["massmail_content"].value;


if (subject==null || subject=="")
  {
			document.getElementById('error1').style.display = "block";
			document.getElementById('error1').innerHTML = 'Please enter Subject.';

			if (content==null || content=="")
			  {
						document.getElementById('error2').style.display = "block";
						document.getElementById('error2').innerHTML = 'Please enter Content.';
			  }

			return false;

  }

if (content==null || content=="")
  {
			document.getElementById('error2').style.display = "block";
			document.getElementById('error2').innerHTML = 'Please enter Content.';
			return false;

  }



}

</script>

