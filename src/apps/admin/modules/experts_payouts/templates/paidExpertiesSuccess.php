<table width="60%" align="left">
<tr>
<td width="20%">
	
	<table width="100%" align="left">
	<tr><td>&nbsp;</td></tr>
	<tr><td><a href="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/admin.php/experts_payouts/unpaidExperties"><b>List of Unpaid experts</b></a></td></tr>
	<tr><td><a href="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/admin.php/experts_payouts/paidExperties"><b>List of paid experts</b></a></td></tr>
	</table>

</td>

<td width="40%">

<div class="sf_admin_container">  
		<h1>Experts payout list</h1>

		<div class="sf_admin_content"> 
		
			<table class="sf_admin_list">
			<tr>
				<th><h3>Expert Name</h3></td>
				<td width="5%"></td>
				<th><h3>Amount<h3></td>
				<td width="5%"></td>
				<th><h3>PayPal ID</h3></td>
				<td width="5%"></td>
				<td></td>
			</tr> 
			<?php foreach($expertspayouts as $expertspayout): ?>
			
					    <?php 
							
							$c= new Criteria();
							$c->add(UserPeer::ID,$expertspayout->getExpertId());
							$expert=UserPeer::doSelectOne($c);
							
						?>
			
						<tr>
								<td> <?php echo $expert->getUsername(); ?></td>
								<td width="5%"></td>
								<td>$<?php echo $expertspayout->getAmount(); ?></td>
								<td width="5%"></td>
								<td><?php echo $expertspayout->getPaypalId(); ?></td>
								<td width="5%"></td>
								<td><b>PAID</b></td>
						</tr> 
						
			<?php endforeach; ?>

			</table> 
		</div>
</div>


</td>
</tr>
</table>