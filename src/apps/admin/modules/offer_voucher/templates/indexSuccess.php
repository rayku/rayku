<style type="text/css">

	@import '/sf/sf_admin/css/main.css' ;

</style> 


<div id="sf_admin_container">  

<h1>Offer voucher List</h1>

<div id="sf_admin_content"> 
<table class="sf_admin_list" cellspacing="0">

  <thead>
    <tr>
      <th>Id</th>
      <th>Code</th>
      <th>Valid till date</th>
      <th>Is used</th>
      <th>Created at</th>
      <th>Is active</th>
      <th>Price</th>
    </tr>
  </thead>
  <tbody>
  
  	<?php $i=0; ?>
    <?php foreach ($offer_voucher_list as $offer_voucher): ?> 
	
	<?php $row = $i%2 ; ?>
	
    <tr>
      <td><a href="<?php echo url_for('offer_voucher/edit?id='.$offer_voucher->getId()) ?>"><?php echo $offer_voucher->getId() ?></a></td>
      <td><?php echo $offer_voucher->getCode() ?></td>
      <td><?php echo $offer_voucher->getValidTillDate() ?></td>
      <td><?php echo $offer_voucher->getIsUsed() ?></td>
      <td><?php echo $offer_voucher->getCreatedAt() ?></td>
      <td><?php echo $offer_voucher->getIsActive() ?></td>
      <td><?php echo $offer_voucher->getPrice() ?></td>
    </tr>
	
	<?php $i++; ?>
	
    <?php endforeach; ?>
  </tbody>
</table>

<ul class="sf_admin_actions">
<li>

	<input type="button" class="sf_admin_action_create" value="create" onclick="document.location.href='/admin.php/offer_voucher/new';"/>
</li>
</ul>

</div>

</div>

