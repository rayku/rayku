<p class="page-title"><?php echo $page->getTitle(); ?></p>
<div class="main-body">
	<?php include_partial('pageMenu', array('group' => $page->getGroup())); ?>
	<?php echo $page->getContent(); ?><br /><br /><br />
	Page Last Updated: <?php echo $page->getUpdatedAt(); ?>
</div>