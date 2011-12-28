<style type="text/css">

	@import '/sf/sf_admin/css/main.css' ;

</style> 


<div id="sf_admin_container">  

<h1>Forums List</h1>

<div id="sf_admin_content"> 
<table class="sf_admin_list" cellspacing="0">
  <thead>
    <tr>
      <th>Name</th>
      <th>Description</th>
      <th>Type</th>
      <th>Top/Bootom</th>
    </tr>
  </thead>
  <tbody>
  
  	<?php $i=0; ?>
	
    <?php foreach ($forum_list as $forum): ?>
    
		<?php $row = $i%2 ; ?>
	
	<tr class="sf_admin_row_<?=$row?>">
      <td><a href="<?php echo url_for('forums/edit?id='.$forum->getId()) ?>"><?php echo $forum->getName() ?></a></td>
      <td><?php echo $forum->getDescription() ?></td>
      
	  <?php if($forum->getType() == 0): 
	  			$type = 'Public forum';
			elseif($forum->getType() == 1):
				$type = 'Staff only forum';
			elseif ($forum->getType() == 2):
				$type = 'User forum';
			else:
				$type = 'Group forum';
				
			endif;
	  ?>
	  
	  
	  <td><?php echo $type; ?></td>
		  
      <td><?php if($forum->getTopOrBottom() == '0')
	  			echo 'Top';
				else
				echo 'Bottom';
		?></td>
    </tr>
	
	<?php $i++; ?>
	
    <?php endforeach; ?>
  </tbody>
</table>

<ul class="sf_admin_actions">
<li>

	<input type="button" class="sf_admin_action_create" value="create" onclick="document.location.href='/admin.php/forums/new';"/>
</li>
</ul>

</div>

</div>
