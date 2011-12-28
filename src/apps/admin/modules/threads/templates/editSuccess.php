<div id="admin-main-content">
		  <h1>Edit News</h1>

<style type="text/css">

	@import '/sf/sf_admin/css/main.css' ;

</style> 



<div id="sf_admin_container">  

<div id="sf_admin_content"> 

<form id="sf_admin_edit_form" action="/admin.php/news/update/id/<?php echo $allNews['id']; ?>" method="post">

  
  
  <fieldset id="sf_fieldset_none">
  
		

		
      	  
<fieldset id="sf_fieldset_none" class="">

<div class="form-row">

  <label for="category_name" class="required"></label><label for="forum_name">News Title</label>  
  <div class="content">
  
    <input name="news[title]" id="news_name" type="text" value="<?php echo $allNews['title']; ?>">  
 </div>
</div>

<div class="form-row">
  <label for="category_name" class="required"></label><label for="forum_description">Description</label>  
  <div class="content">
           <textarea rows="4" cols="30" name="news[description]" id="news_description" ><?php echo $allNews['description']; ?> </textarea>  
 </div>

</div>


</fieldset>


<ul class="sf_admin_actions">
  <li>
  	 <input name="news[id]" value="<?php echo $allNews['id']; ?>" id="news[id]" type="hidden">
 <input class="sf_admin_action_list" value="Cancel" onclick="document.location.href='/admin.php/news/index';" type="button"></li>

 <li><input value="Save" type="submit"></li>
</ul>

</form>
 
<ul class="sf_admin_actions">
      <li class="float-left">

	  <form method="post" class="button_to" action="/admin.php/news/delete">

	  <div>
		 <input name="news[id]" value="<?php echo $allNews['id']; ?>" id="news[id]" type="hidden">
	  	<input class="sf_admin_action_delete" value="delete" onclick="return confirm('Are you sure?');" type="submit">
	  </div>

	  </form>
	 </li>

 </ul>
 
   
</fieldset></div>		</div>
    
    
	</div>
