<div style="float: left; border: 1px solid black; margin: 5px; padding: 5px;">
	<b>Menu</b>
	<ul style="list-style-type: none;">
		<?php foreach($group->getGroupSitePagesInOrder() as $page): ?>
			<li><?php echo link_to($page->getTitle(), '@view_group_page?page_id='.$page->getId()); ?></li>
		<?php endforeach; ?>
	</ul><br />
	<?php echo link_to('Back to Group', '@group?id='.$page->getGroupId()); ?>
</div>