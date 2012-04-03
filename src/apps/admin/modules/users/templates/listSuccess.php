<?php


$users = $raykuPager->getPager()->getResults();
$count_users = count( $users );
?>





<style type="text/css">

	@import '/sf/sf_admin/css/main.css' ;

</style> 


<div id="sf_admin_container">  

<h1>Users List</h1>

<div id="sf_admin_content"> 
<table class="sf_admin_list" cellspacing="0">
  <thead>
    <tr>
      <th>Name</th>
      <th>Email</th>
     <!-- <th>Type</th>
      <th>Top/Bootom</th>-->
    </tr>
  </thead>
  <tbody>
  
  	<?php $i=0; ?>
	
    <?php foreach ($users as $user): ?>
    
		<?php $row = $i%2 ; ?>
	
	<tr class="sf_admin_row_<?=$row?>">
      <td><a href="/expertmanager/portfolio/<?php echo $user->getUsername() ?>"><?php echo $user->getName() ?></a></td>
      <td><?php echo $user->getEmail() ?></td>
      
	 
	  
	  
	<!--  <td></td>
		  
      <td></td>-->
    </tr>
	
	<?php $i++; ?>
	
    <?php endforeach; ?>
  </tbody>
</table>

<ul class="sf_admin_actions">

</ul>

</div>

</div>




