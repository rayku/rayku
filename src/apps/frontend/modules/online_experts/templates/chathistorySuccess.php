<style media="all" type="text/css">
	@import "/styles/ex_global.css";
	@import "/styles/ex_donny.css";
	@import "/styles/ex_supernote.css";
</style>

<div class="body-main">
	<div class="box">
		<div class="top"></div>
			<div class="content2" style="padding:0 18px 10px 18px; width:601px " >
			<h1>Chat History</h1>
			
				<table width="100%">
				 <tr><td>&nbsp;</td></tr>
				 <?php if($chathistoriesstudent !=NULL): ?>
				 
						 <?php foreach($chathistoriesstudent as $chathistorie ): ?>
								<tr style=" border-color:#676734; border-top:1px solid;">
									<td width="30%"> <?php echo link_to($chathistorie->getExpertName(),'online_experts/chatdeatils?id='.$chathistorie->getId().''); ?> </td>
									<td align="left" width="10%"> >> </td>
									<td> Chat with <?php echo link_to($chathistorie->getExpertName(),'online_experts/chatdeatils?id='.$chathistorie->getId().''); ?> </td>
								</tr>
						 <?php endforeach; ?>
				
				<?php endif; ?>		 
				
				<?php if($chathistoriesexpert !=NULL): ?>
						
						<?php foreach($chathistoriesexpert as $chathistorie ): ?>
								<tr style=" border-color:#676734; border-top:1px solid;">
									<td width="30%"> <?php echo link_to($chathistorie->getUserName(),'online_experts/chatdeatils?id='.$chathistorie->getId().''); ?> </td>
									<td align="left" width="10%"> >> </td>
									<td> Chat with <?php echo link_to($chathistorie->getUserName(),'online_experts/chatdeatils?id='.$chathistorie->getId().''); ?> </td>
								</tr>
						 <?php endforeach; ?>
				
				<?php endif; ?>	
				 
				 
				 		<tr style=" border-color:#676734; border-top:1px solid;">
						<td colspan="3">&nbsp;</td>
						</tr>
				</table>
			
			
			</div>
		<div class="bottom"></div>
	</div>
</div>