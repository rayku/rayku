<style type="text/css">
	@import '/sf/sf_admin/css/main.css' ;
	
	@import '/sf/calendar/skins/aqua/theme.css';
</style> 

<script type="text/javascript" src="/sf/calendar/calendar.js"></script>

<script type="text/javascript" src="/sf/calendar/lang/calendar-en.js"></script>
<script type="text/javascript" src="/sf/calendar/calendar-setup.js"></script>


<?php include_stylesheets_for_form($form) ?>
<?php include_javascripts_for_form($form) ?>

<div id="sf_admin_container">  

<div id="sf_admin_content"> 

<form action="<?php echo url_for('offer_voucher/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>

<fieldset id="sf_fieldset_none">
  
		
      <?php echo $form->renderGlobalErrors() ?>
	  
	  <fieldset id="sf_fieldset_none" class="">

  
	  <div class="form-row">
	  <label for="category_name" class="required"><?php echo $form['code']->renderLabel() ?></label>  
	  <div class="content">
	  
	  <?php echo $form['code']->renderError() ?>
          <?php echo $form['code'] ?>
	  
	 </div>
	</div>
	  
  	
	<div class="form-row">
	  <label for="category_name" class="required"><?php echo $form['valid_till_date']->renderLabel() ?></label>  
  
  <div class="content">
  
  <input name="offer_voucher[valid_till_date]" id="category_updated_at" value="<?=$form['valid_till_date']->getValue();?>" size="12" type="text"><img id="trigger_category_updated_at" style="cursor: pointer; vertical-align: middle;" src="/sf/sf_admin/images/date.png" alt="Date"><script type="text/javascript">
    document.getElementById("trigger_category_updated_at").disabled = false;
    Calendar.setup({
      inputField : "category_updated_at",
      ifFormat : "%Y-%m-%d",
      daFormat : "%Y-%m-%d",
      button : "trigger_category_updated_at"
    });
  </script>    </div>

</div>

	  
	  <div class="form-row">
	  <label for="category_name" class="required"><?php echo $form['is_used']->renderLabel() ?></label>  
	  <div class="content">
	  
	   <?php echo $form['is_used']->renderError() ?>
          <?php echo $form['is_used'] ?>
	  
	 </div>
	</div>
	
	 <div class="form-row">
	  <label for="category_name" class="required"><?php echo $form['created_at']->renderLabel() ?></label>  
	  <div class="content">
	  
		 <input name="offer_voucher[created_at]" id="category_updated_at1" value="<?=$form['created_at']->getValue();?>" size="12" type="text"><img id="trigger_category_updated_at1" style="cursor: pointer; vertical-align: middle;" src="/sf/sf_admin/images/date.png" alt="Date"><script type="text/javascript">
    document.getElementById("trigger_category_updated_at1").disabled = false;
    Calendar.setup({
      inputField : "category_updated_at1",
      ifFormat : "%Y-%m-%d",
      daFormat : "%Y-%m-%d",
      button : "trigger_category_updated_at1"
    });
  </script>    
	  
	 </div>
	</div>
	 
	 <div class="form-row">
	  <label for="category_name" class="required"><?php echo $form['is_active']->renderLabel() ?></label>  
	  <div class="content">
	  
	    <?php echo $form['is_active']->renderError() ?>
          <?php echo $form['is_active'] ?>
	  
	 </div>
	</div>
	 
	 
	  <div class="form-row">
	  <label for="category_name" class="required"><?php echo $form['price']->renderLabel() ?></label>  
	  <div class="content">
	  
	    <?php echo $form['price']->renderError() ?>
          <?php echo $form['price'] ?>
	  
	 </div>
	</div>
 </fieldset>
 
 
 <ul class="sf_admin_actions">
  <li>
  	 <?php echo $form->renderHiddenFields() ?>
	 
	  <input class="sf_admin_action_list" value="Cancel" onclick="document.location.href='/admin.php/offer_voucher/index';" type="button"></li>
 <li><input type="submit" value="Save" /></li>
</ul>
 
</form>

<?php if (!$form->getObject()->isNew()): ?>

<ul class="sf_admin_actions">
      <li class="float-left">
	  <form method="post" class="button_to" action="/admin.php/offer_voucher/delete?id=<?php echo $form->getObject()->getId() ?> ">
	  <div>
	  	<input class="sf_admin_action_delete" value="delete" onclick="return confirm('Are you sure?');" type="submit">
	  </div>
	  </form>
	 </li>

 </ul>
 
 <?php endif; ?>
  
</div>
