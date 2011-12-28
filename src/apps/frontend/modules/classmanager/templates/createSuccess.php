<link href="http://<?php echo RaykuCommon::getCurrentHttpDomain(); ?>/styles/classroom.css" type="text/css" rel="stylesheet" />
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
<?php if ($sf_user->hasFlash('register_success')): ?>

		<div class="success">
			You have been successfully registered.
		</div>

	<?php else: ?>

		<?php if ($form->hasErrors()): ?>

			<div class="error">
				Sorry, but there are some errors. Chceck your form again.
			</div>

		<?php endif; ?>

		<form action="<?php echo url_for('multiPageForm/index') ?>" method="POST" > 

		<table>

			<?php if(isset($confirmStep)): ?> 

				<?php echo $form->renderHiddenFields(); ?>

				<?php foreach($form as $field): ?>

					<?php if(!$field->isHidden()): ?>
						<tr>
							<th><?php echo $field->renderLabel() ?></th>
							<td><?php echo $field->getValue() ?></td>
						</tr>
					<?php endif; ?>

				<?php endforeach; ?>

			<?php else: ?>

				<?php echo $form; ?>

			<?php endif; ?>

		</table>

		<?php if ($form['step']->getValue() != 1): ?>

			<input type="submit" name="_back" value="Back">

		<?php endif;  ?>

		<input type="submit" name="_next" value="Next">

		</form>

	<?php endif; ?>