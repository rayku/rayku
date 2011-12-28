<div class="body-main">

<?php if($searchresult): ?>
	Search Result :
<div id="searchresult">
	<?php foreach($resultids as $id): ?>
		<?php echo	$id->getTitle()."<br />"; ?> 
	<?php endforeach; ?>
</div>
<?php endif; ?>

</div><!-- end of body-main -->