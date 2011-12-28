<style type="text/css">

	@import '/sf/sf_admin/css/main.css' ;

</style> 


<div id="sf_admin_container">  

<h1>Item List</h1>

<div id="sf_admin_content"> 
<table class="sf_admin_list" cellspacing="0">
  <thead>
    <tr>
      <th>No.</th>
      <th>Title</th>
<th>Featured Items</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
  
  	<?php $i=0; $j=1; ?>
	
    <?php foreach ($allItem as $item): ?>

   
		<?php $row = $i%2 ; ?>
	
	<tr class="sf_admin_row_<?=$row?>">

	<td><?php echo $j; ?></td>

      <td><a href="#"><?php echo $item['title'] ?></a></td>
   	<?php $con = mysql_connect("localhost", "rayku_db", "db_*$%$%");
        $db = mysql_select_db("rayku_db", $con);

	$query = mysql_query("select * from item_featured where item_id =".$item['id']." and status = 1" ) or die(mysql_error());    

	if(mysql_num_rows($query) > 0) { ?>

	<td>Yes</td>

	<?php } else { ?>

	<td>No</td>

	<?php } ?> 
	  
	  <td><a href="/admin.php/featured/update/id/<?php echo $item['id']; ?>">Set As Featured Items</a></td>

	
	<?php $i++;  $j++; ?>
	
    <?php endforeach; ?>
  </tbody>
</table>


</div>

</div>
