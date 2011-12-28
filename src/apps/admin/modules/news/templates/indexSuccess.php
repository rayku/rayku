<style type="text/css">

	@import '/sf/sf_admin/css/main.css' ;

</style> 


<div id="sf_admin_container">  

<h1>News List</h1>

<div id="sf_admin_content"> 
<table class="sf_admin_list" cellspacing="0">
  <thead>
    <tr>
      <th>Title</th>
      <th>Description</th>
    </tr>
  </thead>
  <tbody>
  
  	<?php $i=0; ?>
	
    <?php foreach ($allNews as $news): ?>
    
		<?php $row = $i%2 ; ?>
	
	<tr class="sf_admin_row_<?=$row?>">
      <td><a href="<?php echo url_for('news/edit?id='.$news['id']) ?>"><?php echo $news['title'] ?></a></td>
       
	  
	  <td><?php echo $news['description']; ?></td>

	
	<?php $i++; ?>
	
    <?php endforeach; ?>
  </tbody>
</table>

<ul class="sf_admin_actions">
<li>

	<input type="button" class="sf_admin_action_create" value="create" onclick="document.location.href='/admin.php/news/new';"/>
</li>
</ul>

</div>

</div>
