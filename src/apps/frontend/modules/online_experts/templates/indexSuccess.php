<link rel="stylesheet" type="text/css" href="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/styles/classroom.css" />

<div class="body-main">

<div class="title" style="float:left; margin-top:20px; margin-left:20px;">
       	<img src="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/images/newspaper.gif" alt="" />
        <p>Online experts</p>
</div>
<div style="clear:both"></div>



 <div class="entry" style="margin-bottom:20px; margin-top:15px;">
        	<div class="top"></div>
            <div class="content">
            	<div class="hand-in">
                	                   					 
					<table width="100%">
					<tr>
					<td align="left" width="30%"> <label style="margin-top: 30px;">Select category:</label> </td>
					<td align="left">
					
					 <form name="testform" method="post">
				
					 <select id="category" name="category" class="dropdown" onchange="document.testform.submit();">
					 <option value="" selected="selected">SELECT CATEGORY</option>
					<?php foreach($categories as $category) { ?>
							<option value="<?php echo $category->getId();?>" 
							<?php if($cat==$category->getId()): ?> selected="selected" <?php endif ?> >
							 <?php echo $category->getname(); ?></option>
					<?php } ?>
					</select>
					</form>
					</td></tr>
					
						
					<?php 
					
						$userids = array(); 
					 	if($alluser != NULL): 
					 	foreach($alluser as $user)
						{ 
							 if($user->isOnline()): 
								$userids[] = $user->getId() ;
							 endif;
						}  
						endif; 
						  
						if($userids != NULL) : 
						
					?>
						
						<tr><td>
						
								<form action="online_experts/lessons" method="post">
								
								<table width="100%">
								<tr><td align="left" colspan="2"><label style="margin-top: 15px;">Select online Experts:</label></td></tr>
								<tr><td>&nbsp;</td></tr>
						
										
								<?php foreach($userids as $userids) { ?>
									
									<?php 
									
											$c = new Criteria();
											$c->add(UserPeer::ID,$userids);
											$user = USerPeer::doSelectOne($c);
									
									?>
									
										<tr>
										<td colspan="2"><input type="radio" name="expert_id" value="<?php echo $user->getId(); ?>" />&nbsp;&nbsp;&nbsp;&nbsp;<label style="font-size:14px; color:#056A9A"><b><?php echo $user->getName(); ?></b></label> </td>
										</tr>
											
								<?php } ?>
								
								
								<tr><td>&nbsp;</td></tr>
								<tr><td><input type="submit" value="GO" name="go" class="blue" /> </td></tr>
								
								</table>
						
								</form>
					
							</td></tr>
					
					<!--<?php // else : ?>
					
					<tr><td><label style="margin-top: 15px;">No experts are online.</label></td></tr>-->
					
					
					<?php endif; ?>
					
					</table>
					
 				
              </div>
            </div>
			
           <div class="bottom"></div>
			
        </div>	
				

</div><!-- end of body-main -->
