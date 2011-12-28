<style media="all" type="text/css">
	@import "/styles/ex_global.css";
	@import "/styles/ex_donny.css";
	@import "/styles/ex_supernote.css";
</style>

<div class="body-main">
	<div class="box">
		<div class="top"></div>
			<div class="content2" style="padding:0 18px 10px 18px; width:601px " >
			<h1><?php echo link_to('Back to chat','online_experts/chathistory'); ?></h1>
			
				<table width="100%">
				 <tr><td>&nbsp;</td></tr>
				 
				 <?php 	$lines= explode(" /n ",$chatdetails->getText());  ?>
						
				 <?php   foreach($lines as $k=>$value) : ?>
						
						 <?php 	 $u = explode(" :u: ",$value);
								 $dd = explode(" :d: ",$u[1]);  
									
								 $temp=explode(' ',$dd[1]);
								 $d = explode('-',$temp[0]);
								 $t= explode(':',$temp[1]);
										 
								 $time = date('h:i:s A', mktime($t[0],$t[1],$t[2],$d[1],$d[2],$d[0]));
								 $user =  $u[0] ;
								 $data =   $dd[0] ;
						?>	 
							 
							 
							 <tr><td width="17%"> <?php echo $time; ?> </td> 
							 	 <td><label style="color:#000000"><strong><?php echo $user; ?></strong></label> <label style="color:#000000">: <?php echo $data; ?></label></td>
							 </tr>
							 
							
						 
				<?php endforeach; ?>
				 
				 
				</table>
			
			
			</div>
		<div class="bottom"></div>
	</div>
</div>