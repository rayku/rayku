<?php use_helper('Javascript'); ?> 
<?php use_helper('Object') ?> 
<script type="text/javascript" src="/sfProtoculousPlugin/js/prototype.js"></script> 
<script type="text/javascript" src="/sfProtoculousPlugin/js/prototype.js"></script> 

<script type="text/javascript">

function check() {

	var answer = confirm("Are you sure you want to reset your Classroom email !")
	if (answer){
		
			
		new Ajax.Request('/classroom/classroomemail', {asynchronous:true, evalScripts:false, onComplete:function(request, json){
					if (200 == request.status) { 
				  		if(request.readyState==4) {   
						
						window.location.reload();
												
						}
					}
				}
				
				}); 
		
	}
	else{
		alert("Thanks for sticking around!")
	} 
	
return false;

}

</script>

<div class="spacer"></div>
<div class="title" style="float:left">
	<img src="../../../images/newspaper.gif" alt="" />
	<p>Reset your classroom Email address</p>
</div>
<div class="spacer"></div> 


<div class="entry">
	<div class="top"></div>
	<div class="content">
		<div style="border:1px solid #fff">
			<div class="titles">
			  <a href="#" class="title02">  Classroom Emails</a>
			</div>
			<div class="spacer"></div>
		</div>

		<div class="paragraph">
			<div class="text"> 
			 
			 Publish blog contents to rayku classroom from  your personal email address just by sending a email to the address to the email below. <?php echo link_to('Click here for more information to send a mail','classroom/emailinfo'); ?>
			
			</div>
		</div> 
		
		<div style="color:#686D78;font-family:'Arial'; font-size:12px;font-weight:normal;line-height:24px;padding-bottom:11px;position:relative;text-align:left;top:16px;"> 
		
			
			<?php // echo form_tag('classroom/classroomemail'); ?>
			
					
			<?php if( $email != NULL) : ?>
						
			<table width="100%">
				<tr><td colspan="2">&nbsp;</td></tr>
				<tr><td width="30%" align="left"><b>Classroom Email</b></td><td width="70%" align="left"><b style="font-size:16px;"><?php echo $email; ?></b></td></tr>
				<tr><td>&nbsp;</td>
					<td>
						<table width="100%">
						<tr><td><i>Resetting your classroom email will permanently disable current classroom email.</i></td></tr>
						<tr><td> <a href="#" onclick="return check();">Reset your Classroom Email</a>
								
						<!--<input type="submit" name="reset" value="Reset your Classroom Email" onClick="return check();">--></td></tr>
						</table>
					</td>
				</tr>
			</table>  
			
			<?php else : ?>
			
				<b> you have not created a mail account for this classroom, Please go to classroom settings and edit the classroom with username and password(secrete code for a classroom) </b>
			
			<?php endif; ?>
			
			
		<!--	</form>-->
		
		</div>
		
		<div class="spacer"></div>  
		
	</div>
	<div class="bottom"></div>
</div>