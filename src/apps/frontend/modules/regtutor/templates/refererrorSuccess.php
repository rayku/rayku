<html>
<head>

<link rel="stylesheet" type="text/css" href="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/css/global.css" />

<link rel="stylesheet" type="text/css" media="screen" href="/styles/ex_donny.css" />
<link rel="stylesheet" type="text/css" media="screen" href="/styles/ex_tabcontent.css" />
<link rel="stylesheet" type="text/css" media="screen" href="/styles/ex_global.css" />
	<script src="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/js/register_popup/popup.js" type="text/javascript"></script>	


</head>
<body>
<div class="body-main">
  <div id="top" style="margin:10px 0 15px 0"> <span style="background:url(../../../images/arrow-right.gif) no-repeat; padding-left:40px; color:#1C517C; font-size:20px; font-weight:bold">Create your account</span> </div>
  <div class="clear"></div>
  <div class="body-main">
    <div class="box">
      <div class="top"></div>
      <div class="content">
        <div class="title">
	<p class="cn-pricepermin" style="color:#C30">
	Please enter a correct invitation code in order to continue.</p>

        </div>

      <div class="entry"> 
        <div class="ttle">Enter Invitation Code:</div> 
        <div class="spacer"></div> 

		<form  method='post' style="color:#000033;">
	
	  <table cellpadding="10" >
	 
		  	<tr>
			<td valign="top" style="color:#000033;">
       				 <input type="text" name='referral_code_quick' id='referral_code_quick' value="" style="padding-top:3px;height:37px;">
			</td>

			<td colspan="2" id="error_referral_quick" style="color:#FF0066">
			</td>
		</tr>	
	    </table>	
      </div> 
<p style="margin:15px 0">
<input type="button" name="register" value="Continue"  id="register" onClick='checkReferralcode_quick();' style="padding:5px;font-size:14px"/> </p>
	  </form>

      </div>
      <div class="bottom"></div>
    </div>
  </div>

</div>
</body>


