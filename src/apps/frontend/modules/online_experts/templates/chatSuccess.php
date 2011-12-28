<?php 
error_reporting(E_ALL);
ini_set('display_errors',1);
?>

<?php use_helper('Javascript'); ?>
<?php use_helper('Object') ?>

<?php
	$closeurl = $_SERVER["REQUEST_URI"]."?end=1";
?>

<style type="text/css">
.ajax_link {
	font-size:14px; 
	color: #D70000; 
	font-weight:bold;
} 

.ask_an_expert {
	background-image: url(/images/back1.jpg);
}
.ask_an_expert_a {
	margin: auto;
	height: 40px;
	width: 450px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 16pt;
	color: #FFFFFF;
	text-align: center;
	font-weight: bold;
	vertical-align: middle; 
}


.ajax_link1 {
	margin: auto;
	height: 40px;
	width: 450px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 16pt;
	color: #FFFFFF;
	text-align: center;
	font-weight: bold;
	vertical-align: middle; 
	background-image: url(/images/back1.jpg);

}

#cd {
	display:none;
	margin: auto;
	height: 40px;
	width: 450px;
	font-family: "Courier New", Courier, mono;
	font-size: 24pt;
	color: #FFFFFF;
	text-align: center;
	font-weight: bold;
	background-image: url(/images/back1.jpg);
	vertical-align: middle; 
	
}

#exptimer {
margin: auto;
	display:none; 
	height: 40px;
	width: 450px;
	font-family: "Courier New", Courier, mono;
	font-size: 24pt;
	color: #FFFFFF;
	text-align: center;
	font-weight: bold;
	background-image: url(/images/back1.jpg);
	vertical-align: middle; 

}

</style>

<script type="text/javascript">

var smile_id = '';

function show_smile()
{
	document.getElementById('smile').style.display= 'block';
}

function show_exp_smile(id)
{
	smile_id = id;
	document.getElementById("smile_"+id).style.display= 'block';
}

function get_smile(val)
{ 
	document.getElementById("cht_txt_box").value = val;
	document.getElementById('smile').style.display= 'none';
}

function get_exp_smile(val)
{ 
	document.getElementById("cht_txt_box_"+smile_id).value = val;
	document.getElementById("smile_"+smile_id).style.display= 'none';
} 


function askAnExpert(student,experty)
{


	qns= document.getElementById('student_question').value;

	new Ajax.Request('/online_experts/askanexpert?student='+student+'&experty='+experty+'&qn='+qns, {asynchronous:true, evalScripts:false, onComplete:function(request, json){
					if (200 == request.status) { 
				  		if(request.readyState==4) {  
						
							   document.getElementById('ask_an_expert').style.display = 'none';  
								document.getElementById('wait').style.display = 'block';  
						
						}
					}
				}
				
				}); 

return false;
}
 
 
function disagree(request) 
{

	// alert(request.responseText);

document.getElementById("expert_agree").style.display = "none" ;
return false;

}

function check()
{

		<?php if( $type == '5' ) { ?> 
		
		//		alert(5);

				new Ajax.Request('/online_experts/checkagree', {asynchronous:true, evalScripts:false, onComplete:function(request, json){
					if (200 == request.status) { 
				 		if(request.readyState==4) { 
				 
									 text= request.responseText ;
																			
										 var sta = text.split("@qns@");
										 var student = sta[0]; 
										 var question = sta[1]; 
										
										
										 document.getElementById("expert_agree").style.display = "block";
										
										 document.getElementById("expert_agree").innerHTML ='<textarea name="student_question" id="student_question" rows="10" cols="100">'+question+'</textarea><br><br><div class="ajax_link1"><a class="ask_an_expert_a" href="#" onclick="new Ajax.Updater(\'feedback\', \'/frontend_dev.php/online_experts/expertagree/student/'+student+'\', {asynchronous:true, evalScripts:false, onComplete:function(request, json){startexpert(request)}});; return false;">Hire a "'+student+'" for chat</a></div><br><div class="ajax_link1"><a class="ask_an_expert_a" href="#" onclick="new Ajax.Updater(\'feedback\', \'/frontend_dev.php/online_experts/expertdisagree/student/'+student+'\', {asynchronous:true, evalScripts:false, onComplete:function(request, json){disagree(request)}});; return false;">Terminate "'+student+'" for chat</a></div>';   
									
								
				 		}
					}
					
					else
					{
														 
							// alert('1');
							check_chat() ;
							 
					  
					}
					
				}
			 }) ; 
			 
			 
		<?php } ?>		 
		
		
		<?php if( $type == '1' ) { ?>
		
			//	alert(1);
				
				new Ajax.Request('/online_experts/startchat', {asynchronous:true, evalScripts:false, onComplete:function(request, json){
					if (200 == request.status) { 
				  		if(request.readyState==4) { 
						
							  
						//	  alert(request.responseText );
							  
							    var status = request.responseText ; 
								
								if(status == 'agreed') {
								
									 document.getElementById("ask_an_expert").style.display = "none"; 
									 document.getElementById("wait").style.display = "none"; 
									 document.getElementById("main_student_chat").style.display = "block";  
									 
										check_chat() ;
									 
								}
								else if(status == 'disagreed')
								{
								
									 document.getElementById("ask_an_expert").style.display = "none"; 
									 document.getElementById("wait").style.display = "none"; 
									 document.getElementById("expert_dis_agreed").style.display = "block"; 
								}
								
						
						}
					}
				}
				
				}); 
				
			 
		<?php }  ?>		
		

  setTimeout('check()',1000);  
  
  
   return false; 
		
}

function startexpert(request)    
{
    
	//alert(request.responseText);
	
	text= request.responseText ;
	
	 var sta = text.split(":@&:");
	 var status = sta[0];  
	 
	 
//	alert('shree');
//	alert(status);
	 
	if(status == 'start') 
	{
		
		document.getElementById("expert_agree").style.display = "none";
		
	//	document.getElementById("main_expert_chat_"+user).style.display = "block";
	//	document.getElementById("main_"+user).style.display = "block";
	//	document.getElementById("main_cht_window_"+user).style.display = "block";  
		
		check_chat() ;
		
	} 
	
	return false ;
	
}

 <?php if($type == '1') { ?>
	
	var scheduled_date = new Date()
	scheduled_date.setMinutes(scheduled_date.getMinutes() + <?php echo $minutes; ?>) ; 
	
 <?php } ?> 
											
									 	
										
		
function check_chat() {      

	// alert('check_chat');
	
	var current_date = new Date();
	
		new Ajax.Request('/online_experts/onload', {asynchronous:true, evalScripts:false, onComplete:function(request, json){
				if (200 == request.status) { 
				 if(request.readyState==4) {
								  
							 text = request.responseText; 
								
							// alert(request.responseText);
						
							 var sta = text.split("$");
							 var status = sta[0]; 
						 				 						 
								 if(status == 1)
								 {  
									 var spt = sta[1].split("-@&");
									 var len = spt.length; //alert(len)
									 var i=0; var j=0;  
								 
									 while(i<len-1)
									 {
										  var new_cont = spt[i]; //alert(new_cont);
										  if(j!= len){i=0;}if(j== len){break;}
										  var new_spt = new_cont.split("|@&");
										  var len1 = new_spt.length; //alert(len1)
		
										  if(new_spt[i] != "")
										  {
												  
												  document.getElementById("main_expert_chat_"+new_spt[(i+1)]).style.display = "block";
												  document.getElementById("main_"+new_spt[(i+1)]).style.display = "block";
												  document.getElementById("main_cht_window_"+new_spt[(i+1)]).style.display = "block";
												  document.getElementById("main_cht_content_"+new_spt[(i+1)]).innerHTML = new_spt[i]; //alert("i--"+i);
												 
										  }
										  
										 i++;j++; 
									}
								}
							
								
								if(status == 0 && sta[1] != "fail")
								{
									  
									//  alert(current_date) ; 
									  
								  
									   if(current_date > scheduled_date)  
										{
												
											new Ajax.Request('/online_experts/close?type=main', {asynchronous:true, evalScripts:false, onComplete:function(request, json){ 
																							
												document.getElementById("main").style.display = "none";
												}
											}) ;
											
										}
										else
										{
											  document.getElementById("main").style.display = "block";
											  document.getElementById("main_cht_content").innerHTML = sta[1]; 
										 }
								} 	
								
							setTimeout('check_chat()',1000); 
				  }
			   }
		  }
	   });

	 return false; 
	
} 

</script>

<!--<body onLoad="check_chat()">  -->

<body onLoad="check()"> 

 <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr><td colspan="3">&nbsp;</td></tr>
      <tr>
        <td><font style="color:#056A9A; font-size:16px; font-weight:bold;"><?php echo link_to('Go to chat history','online_experts/chathistory'); ?></font></td>
        <td><div align="center" style=" font-size:16px; color:#056A9A; font-weight:bold;">Welcome to chat World</div></td>
        <td>&nbsp;</td>
      </tr>
      <tr><td colspan="3">&nbsp;</td></tr>
	<tr>
	<td>&nbsp;</td>
	<td height="300px" valign="top" align="center">
	
	<?php
				
		$c=new Criteria();
		$c->add(ChatUserPeer::USER_NAME,$sf_user->getRaykuUser()->getUsername());
		$chatuser=ChatUserPeer::doSelectOne($c);
		$status = $chatuser->getStatus();

		if($status == '0') { 
	
	 ?>
	 
	 			<div id="wait" style="display:none;" class="ajax_link1">Please wait for an expert reply.. </div> 
				<div id="expert_dis_agreed" style="display:none;" class="ajax_link1">Sorry, expert has disagreed to answer yourquestion.</div> 
				
								
				<div id="ask_an_expert" style="display:;" >	
				
					<textarea name="student_question" id="student_question" rows="10" cols="100"> Type your question here for an expert.</textarea>

						<br>
						<br>
						<div class="ajax_link1">
						
						<a href="" class="ask_an_expert_a" onClick="return askAnExpert('<?=$student?>','<?=$experty?>');">Click here to Hire an expert</a>
				
						</div>
				
					<?php // echo link_to('Click here to Ask an expert',' ',array('onClick' => 'askAnExpert()')); ?>
					
						<?php // echo link_to_remote('Click here to Ask an expert', array(
								//	'update' => 'feedback',
								//	'url'    => 'online_experts/askanexpert?student='.$student.'&experty='.$experty, 
								//	'complete' => 'openloading()',
								//	), array ( 'class' => 'ask_an_expert_a')
								//	) ?>	 
									
									
						<?php // echo javascript_tag("
								//	  function openloading()
								//	  {
								//			document.getElementById('ask_an_expert').style.display = 'none';  
								//			document.getElementById('wait').style.display = 'block';  
																			
								//	  }
								//	"); ?> 
									
									
									
														
				</div> 
				
		<div id="main_student_chat" style="display:none;">
 
		   <?php 
			
				$y=date('Y');
				$m=date('m');
				$d=date('d');
				$h=date('H');
				$i=date('i');
				$s=date('s');  
				
				$min = $i+$minutes; 
				
		
			?>

			<div id="cd"></div> 
			
			<?php echo javascript_tag(
					  remote_function(array(
						'update'  => 'cd',
						'url'     => 'online_experts/timer?countto='.$y.'-'.$m.'-'.$d.' '.$h.':'.$min.':'.$s.'',
						'complete' => 'testing(request)'
					  ))
			) ?> 
			
			<?php echo javascript_tag("
									  function testing(request)
									  {
																
										//	 alert(request.responseText);
											
											 countdown = request.responseText;
											 
											 do_cd();
 									 }
									 
										function do_cd()
										{
																								
													if(countdown > 0)
													{ 
														document.getElementById('cd').innerHTML = convert_to_time(countdown);
														setTimeout('do_cd()', 1000);
														countdown = countdown - 1;	 
													}
													else
													{
														document.getElementById('cd').innerHTML = 'Timed out';
																												
													}
																							
										}
										 function convert_to_time(secs)
									     {
																									
														secs = parseInt(secs);	
														hh = secs / 3600;	
														hh = parseInt(hh);	
														mmt = secs - (hh * 3600);	
														mm = mmt / 60;	
														mm = parseInt(mm);	
														ss = mmt - (mm * 60);	
															
														if (hh > 23)	
														{	
														   dd = hh / 24;	
														   dd = parseInt(dd);	
														   hh = hh - (dd * 24);	
														} else { dd = 0; }	
															
														if (ss < 10) { ss = '0'+ss; }	
														if (mm < 10) { mm = '0'+mm; }	
														if (hh < 10) { hh = '0'+hh; }	
														if (dd == 0) { return (hh+':'+mm+':'+ss); }	
														else {	
															if (dd > 1) { return (dd+' days '+hh+':'+mm+':'+ss); }
															else { return (dd+' day '+hh+':'+mm+':'+ss); }
														}	
											}		
																				
																	
									"); ?>
			
			
				<br><br>
			
			
			
			<div id="main" style="display:;">
			<div id="flashcontent">You need to upgrade your Flash Player</div>
			<script type="text/javascript" src="/whiteboard/swfobject.js"></script>
			<script>
				var so = new SWFObject("/whiteboard/whiteboard.swf", "db", "1152", "646", "7", "#E0E0E0");
				so.addVariable("app_path", "rtmp://209.188.92.237/raykuwb/X<?php $a = split('/',$_SERVER['REQUEST_URI']); echo $a[4]; ?>");
				so.addVariable("rayku_username", "<?php echo $sf_user->getRaykuUser()->getUsername(); ?>");
				so.addVariable("session_maxtime", 600);
				so.addVariable("expert", false);
				so.addVariable("close_url","<?= $closeurl ?>");
				so.useExpressInstall('expressinstall.swf');
				<?php if (!isset($_GET["end"])) echo "so.write(\"flashcontent\");"; ?>
			</script>

<?php
if (isset($_GET["end"]))
{
echo javascript_tag(
remote_function(array(
	'update'  => 'feedback',
	'url'    => 'online_experts/close?type=main',
        'complete' => 'document.location="/expertsconnect";'
        ))) ;
}
?>

		</div>
		
		</div>

	   
	<?php 
	
	} 
	else
	{
	?>			
			
					
			<div id="expert_agree" style="display:none;"></div> 
				
		  <?php 
			$c=new Criteria();
			$c->add(ChatDetailPeer::EXPERT,$sf_user->getRaykuUser()->getUsername());
			$fetchexperts=ChatDetailPeer::doSelect($c);
		
			?>
		  <table>
		  <tr>
			  <?php foreach($fetchexperts as $fetchexpert) :  ?> 
			   
			  <td valign="top"> 
										
			  <?php 
			
				$y=date('Y');
				$m=date('m');
				$d=date('d');
				$h=date('H');
				$i=date('i');
				$s=date('s');  
				
				$min = $i+$fetchexpert->getMinutes(); 
				
		
			?>

			<div id="main_expert_chat_<?php echo $fetchexpert->getUser() ;?>" style="display:none;">

			<div id="exptimer"></div> 
			
			<?php echo javascript_tag(
					  remote_function(array(
						'update'  => 'exptimer',
						'url'     => 'online_experts/timer?countto='.$y.'-'.$m.'-'.$d.' '.$h.':'.$min.':'.$s.'',
						'complete' => 'testing(request)'
					  ))
			) ?> 
			
			<?php echo javascript_tag("
									  function testing(request)
									  {
																
										//	 alert(request.responseText);
											
											 countdown = request.responseText;
											 
											 do_cd();
 									 }
									 
										function do_cd()
										{
																								
													if(countdown > 0)
													{ 
														document.getElementById('exptimer').innerHTML = convert_to_time(countdown);
														setTimeout('do_cd()', 1000);
														countdown = countdown - 1;	 
													}
													else
													{
														document.getElementById('exptimer').innerHTML = 'Timed out';
																												
													}
																							
										}
										 function convert_to_time(secs)
									     {
																									
														secs = parseInt(secs);	
														hh = secs / 3600;	
														hh = parseInt(hh);	
														mmt = secs - (hh * 3600);	
														mm = mmt / 60;	
														mm = parseInt(mm);	
														ss = mmt - (mm * 60);	
															
														if (hh > 23)	
														{	
														   dd = hh / 24;	
														   dd = parseInt(dd);	
														   hh = hh - (dd * 24);	
														} else { dd = 0; }	
															
														if (ss < 10) { ss = '0'+ss; }	
														if (mm < 10) { mm = '0'+mm; }	
														if (hh < 10) { hh = '0'+hh; }	
														if (dd == 0) { return (hh+':'+mm+':'+ss); }	
														else {	
															if (dd > 1) { return (dd+' days '+hh+':'+mm+':'+ss); }
															else { return (dd+' day '+hh+':'+mm+':'+ss); }
														}	
											}		
																				
																	
									"); ?>
			
			
				<br><br>
					
						<div  id="main_<?php echo $fetchexpert->getUser() ;?>" style="display:none;">
			<div id="flashcontent2">You need to upgrade your Flash Player</div>
                        <script type="text/javascript" src="/whiteboard/swfobject.js"></script>
                        <script>
                                var so = new SWFObject("/whiteboard/whiteboard.swf", "db", "1152", "646", "7", "#E0E0E0");
                                so.addVariable("app_path", "rtmp://209.188.92.237/raykuwb/X<?= $sf_user->getRaykuUserId() ?>");
                                so.addVariable("rayku_username", "<?php echo $sf_user->getRaykuUser()->getUsername(); ?>");
                                so.addVariable("session_maxtime", 600);
				so.addVariable("close_url","<?= $closeurl ?>");
                                so.addVariable("expert", "1");
                                so.useExpressInstall('expressinstall.swf');
				<?php if (!isset($_GET["end"])) echo "so.write(\"flashcontent2\");"; ?>
                        </script>
<?php
if (isset($_GET["end"]))
{
echo javascript_tag(
remote_function(array(
	'update'  => 'feedback',
	'url'    => 'online_experts/close?type=main_'.$fetchexpert->getUser(),
        'complete' => 'document.location="/expertsconnect";'
        ))) ;
}
?>


					</div>
					</td>
					
				<?php endforeach; ?>
	
			  </tr>
			</table>
			 	
			
	<?php
	  }
	?>     
	 
	 
	 <input name="hidden" id="hidden" type="hidden" value="0" />
	
	</td>
	</tr>
	
	  
</table>

<div id="feedback" style=" display:none;"></div>

</body>
