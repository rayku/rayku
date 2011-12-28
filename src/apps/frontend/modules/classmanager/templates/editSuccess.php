<?php use_helper('Javascript'); ?>
<script type="text/javascript" src="http://<?php echo RaykuCommon::getCurrentHttpDomain(); ?>/classwizard/jquery-1.3.2.js"></script>
<script type="text/javascript" src="http://<?php echo RaykuCommon::getCurrentHttpDomain(); ?>/classwizard/jquery.history.js"></script>
<script type="text/javascript" src="http://<?php echo RaykuCommon::getCurrentHttpDomain(); ?>/classwizard/jquery.form.js"></script>
<script type="text/javascript" src="http://<?php echo RaykuCommon::getCurrentHttpDomain(); ?>/classwizard/jquery.validate.js"></script>
<script type="text/javascript" src="http://<?php echo RaykuCommon::getCurrentHttpDomain(); ?>/classwizard/jquery.form.wizard-0.9.7.js"></script>
<script type="text/javascript">
  $(function(){
	$("#theForm").formwizard({ 
	  //form wizard settings
	  historyEnabled : true, 
	  formPluginEnabled: true, 
	  validationEnabled : true},
	 {
	   //validation settings
	 },
	 {
	   // form plugin settings
	 }
	);
  });
  
</script>
<link href="http://<?php echo RaykuCommon::getCurrentHttpDomain(); ?>/styles/classroom.css" type="text/css" rel="stylesheet" />

<div class="body-main">
  
<div class="title" style="float:left;margin-left:20px; margin-bottom:20px;">

   	<img src="http://<?php echo RaykuCommon::getCurrentHttpDomain(); ?>/images/newspaper.gif" alt="" />

    

	<?php if ($classroom->getId()): ?>

		<p>Edit classroom</p>

	<?php else: ?>

		<p>Create classroom</p>

	<?php endif; ?>

</div>



 <div class="spacer"></div>



<?php use_helper('Object') ?>


<?php echo form_tag('classmanager/update',array('id' => 'theForm')) ?>



<?php echo object_input_hidden_tag($classroom, 'getId') ?>



<?php echo object_input_hidden_tag($classroom, 'getShortname') ?>



<?php echo object_input_hidden_tag($classroom, 'getIdnumber') ?>



<?php echo object_input_hidden_tag($classroom, 'getUserId') ?>





<div class="entry" style="margin-bottom:11px;margin-top:50px;">

    <div class="top"></div>

       <div class="content">

       	<div class="hand-in">

        	<div class="email-st">

	       		  
				 <div class="step">
				 
				  <label><?php // echo $msg; ?></label>
				  
				  <label>Select Category: </label>

                  <?php echo select_tag('category_id', 

					objects_for_select(CategoryPeer::doSelect(new Criteria()), 

					'getId', 'getName',$classroom->getCategoryId()),array('class' => 'dropdown')) ?>

					
					
					<label for="class_username" style="margin-top: 15px;">Class Username:</label>

					<?php echo object_input_tag($classroom, 'getClassUsername', array (
					  'size' => 80,	  
					  'onchange' => remote_function( array(

									'update' => 'item_suggestion',
									'url' => 'classmanager/test',
									'with' => "'cuser=' + this.value",
									'script'	=> true,
									
									))
									  
					)) ?>
					
					
					<div id="item_suggestion" style="float:left; width:200px;"> </div>
					
					
					 <?php /* echo observe_field('class_username', array(
					  'update'   => 'item_suggestion',
					  'url'      => 'classmanager/test',
					  'with' 	 => "'class_username='+$('class_username').value+ '&updateid=item_suggestion'",
					  'script'   => true
						
				  	));*/ ?>
					
					<?php /*echo javascript_tag("
						 function fetchHelp(val){
						   ".remote_function(array(
						   'update' => 'item_suggestion',
						   'url'  => 'classmanager/test',
						   'with' => "'cuser='+val",
						   'script'	=> true,

						   ))."
						 }"
					   ); */?>
					
					
										
					<label style="margin-top: 15px;">Email password code(Class secret code):</label>

					<?php echo object_input_tag($classroom, 'getEmailPasscode', array (

					  'size' => 80,
					  
					)) ?>
					
					<label style="margin-top: 15px;">Classname:</label>

					<?php echo object_input_tag($classroom, 'getFullname', array (

					  'size' => 80,
					  
					)) ?>
					
					<label style="margin-top: 15px; margin-bottom:15px;">Description:</label>

					<?php /* echo object_textarea_tag($classroom, 'getSummary', array (

					  'size' => '30x3', 'rich' => true, 'tinymce_options'=>'width: 590'

					))*/ 
					
					echo object_textarea_tag($classroom, 'getSummary', array('size' => '54x40', 'rich' => 'fck'))
					
					?>
					
					<label style="margin-top: 15px;"></label>
				</div>
				<div class="step">
					
					<label style="margin-top: 15px;">School Name:</label>
					
					<?php echo object_input_tag($classroom, 'getSchoolName', array (

					  'size' => 80,
					)) ?>
					
					<label style="margin-top: 15px;">Location:</label>
					
					<?php echo object_input_tag($classroom, 'getLocation', array (

					  'size' => 80,

					)) ?>
					
					
					<label style="margin-top: 15px;"><?php echo checkbox_tag('webcam','1',$classroom->getLiveWebcam()); ?>Accept live webcam help option</label>
					
					<label style="margin-top: 15px;"><?php echo checkbox_tag('blog_update','1',$classroom->getEmailUpdateblog()); ?>Blog update email option</label>
					
					<label style="margin-top: 15px;"></label>
				</div>
				
				<div class="step">
					
					<label>Generate Banner(Optional)</label>
										
					<iframe src="http://<?php echo RaykuCommon::getCurrentHttpDomain(); ?>/bannergenerator/index.php" width="600" height="440"></iframe>
					
									
					<input disabled="disabled" type="hidden" class="link" name="name9" value="submit_step" />
					<label style="margin-top: 15px;"></label>
				
				
				</div>
				
				
				
					 <input type="reset" value="Reset" class="blue" style="float:left;" />		

					<?php echo submit_tag('save',array('class' => 'blue', 'style'=>'margin-left:10px;')) ?>



					<?php if ($classroom->getId()): ?>

					

					  <?php echo link_to('delete', 'classmanager/delete?id='.$classroom->getId(), array('class' => 'blue', 'style'=>'margin-left:10px; line-height: 38px;'), 'post=true&confirm=Are you sure?') ?>

					

					  <?php echo link_to('cancel', 'classroom/index?id='.$classroom->getId() , array('class' => 'blue','style'=>'line-height: 38px;')) ?>

					

					<?php else: ?>

					

					  <?php echo link_to('cancel', 'classmanager/list', array('class' => 'blue', 'style' => 'margin-right: 10px; line-height: 38px;')) ?>

					

					<?php endif; ?>

					

					<div class="clear-both"></div>

					

				  </div>
				  
				  

                </div>

            </div>

            <div class="bottom"></div>

        </div>
</form>

</div><!-- end of body-main -->