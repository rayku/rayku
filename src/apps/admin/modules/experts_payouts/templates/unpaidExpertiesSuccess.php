<?php  use_helper('MyForm') ?>

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
		
		<?php if($expertspayouts != NULL): ?>

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
			
						<form name="paypalfrm" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
						
						<input type="hidden" id="return" name="return" value="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/admin.php/experts_payouts/unpaidExperties/e_id/<?php echo $expertspayout->getExpertId();?>/id/<?php echo $expertspayout->getId(); ?>">
						<input type="hidden" name="cmd" value="_xclick">
						<input type="hidden" name="item_name" value="testing">
						<input type="hidden" name="item_number" value="1">
						<input type="hidden" name="business" value="<?php echo $expertspayout->getPaypalId(); ?>">
						<input type="hidden" name="currency_code" value="USD">
						<input type="hidden" name=amount value=<?php echo $expertspayout->getAmount(); ?>> 
						
						<tr>
								<td> <?php echo $expert->getUsername(); ?></td>
								<td width="5%"></td>
								<td>$<?php echo $expertspayout->getAmount(); ?></td>
								<td width="5%"></td>
								<td><?php echo $expertspayout->getPaypalId(); ?></td>
								<td width="5%"></td>
								<td><input type="submit" value="PAY" name="pay" /></td>
						</tr> 
						
						</form>
						
			<?php endforeach; ?>

			</table> 
		</div> 
		
		<?php else: ?>
		
				<h3>There is no list of experts payout.</h3>
		
		<?php endif; ?>
		
</div> 

</td>
</tr>
</table>
