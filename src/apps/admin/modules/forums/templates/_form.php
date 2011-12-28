<style type="text/css">

	@import '/sf/sf_admin/css/main.css' ;

</style> 


<?php include_stylesheets_for_form($form) ?>
<?php include_javascripts_for_form($form) ?>

<div id="sf_admin_container">  

<div id="sf_admin_content"> 

<form id="sf_admin_edit_form" action="<?php echo url_for('forums/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  
  
  <fieldset id="sf_fieldset_none">
  
		
      <?php echo $form->renderGlobalErrors() ?>
	  
<fieldset id="sf_fieldset_none" class="">

<div class="form-row">
  <label for="category_name" class="required"><?php echo $form['name']->renderLabel() ?></label>  
  <div class="content">
  
  <?php echo $form['name']->renderError() ?>
  <?php echo $form['name'] ?>
  
 </div>
</div>

<div class="form-row">
  <label for="category_name" class="required"><?php echo $form['description']->renderLabel() ?></label>  
  <div class="content">
 <?php echo $form['description']->renderError() ?>
          <?php echo $form['description'] ?>
  
 </div>
</div>


<div class="form-row">
  <label for="category_name" class="required"><?php echo $form['type']->renderLabel() ?></label>  
  <div class="content">
<?php echo $form['type']->renderError() ?>
		  
		  <select name="forum[type]" id="forum_type">
				<option value="0" <?php if($form['type']->getValue() == '0' ){ ?> selected="selected" <?php } ?>>Public forum</option>
				<option value="1" <?php if($form['type']->getValue() == '1' ){ ?> selected="selected" <?php } ?>>Staff only forum</option>
				<option value="2" <?php if($form['type']->getValue() == '2' ){ ?> selected="selected" <?php } ?>>User forum</option> 
				<option value="3" <?php if($form['type']->getValue() == '3' ){ ?> selected="selected" <?php } ?>>Group forum</option>
			</select>
			
          <?php // echo $form['type'] ?>
  
 </div>
</div>

 
 <div class="form-row">
  <label for="category_name" class="required"><?php echo $form['top_or_bottom']->renderLabel() ?></label>  
  <div class="content">
		  <?php echo $form['top_or_bottom']->renderError() ?>
		  
		  <select name="forum[top_or_bottom]" id="forum_top_or_bottom">
				
				 <option value="0" <?php if($form['top_or_bottom']->getValue() == '0' ){ ?> selected="selected" <?php } ?>>Top</option>
				<option value="1" <?php if($form['top_or_bottom']->getValue() == '1' ){ ?> selected="selected" <?php } ?>>Bottom</option>
				
			</select>
  
 </div>
</div>

</fieldset>


<ul class="sf_admin_actions">
  <li>
  	 <?php echo $form->renderHiddenFields() ?>
	  <input class="sf_admin_action_list" value="Cancel" onclick="document.location.href='/admin.php/forums/index';" type="button"></li>
 <li><input type="submit" value="Save" /></li>
</ul>
</form>

 <?php if (!$form->getObject()->isNew()): ?>

<ul class="sf_admin_actions">
      <li class="float-left">
	  <form method="post" class="button_to" action="/admin.php/forums/delete?id=<?php echo $form->getObject()->getId() ?> ">
	  <div>
	  	<input class="sf_admin_action_delete" value="delete" onclick="return confirm('Are you sure?');" type="submit">
	  </div>
	  </form>
	 </li>

 </ul>
 
 <?php endif; ?>
  
</div>