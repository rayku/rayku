<?php if ($sf_user->hasFlash('notices')): ?>
	<p class="page-title">Site Notice</p>
	<div class="main-body site-notice">
		<?php foreach ($sf_user->getFlash('notices') as $message): ?>
			<p>
				<?php echo $message ?>
			</p>
		<?php endforeach ?>
	</div>
	<br />
<?php endif ?>

<?php if ($sf_user->hasFlash('errors')): ?>
	<p class="page-title">Site Error</p>
	<div class="main-body site-error">
		<?php foreach ($sf_user->getFlash('errors') as $message): ?>
			<p>
				<?php echo $message ?>
			</p>
		<?php endforeach ?>
	</div>
	<br />
<?php endif ?>