<?php use_helper('Javascript'); ?>
<ul id="order" style="list-style-type: none;">
	<?php foreach($group->getGroupSitePagesInOrder() as $page): ?>
		<li id="page_<?php echo $page->getId(); ?>"><?php echo $page->getTitle().' ['.link_to_remote('e', array('url' => 'cms/editPageDisplay?page_id='.$page->getId(), 'update' => 'CMS')).'] ['.link_to_remote('x', array('url' => 'cms/deletePage?page_id='.$page->getId(), 'complete' => evaluate_remote_response())).']'; ?></li>
	<?php endforeach; ?>
</ul>
<?php echo sortable_element('order', array('url' => 'cms/reorder')); ?><br />
<?php echo link_to_remote('New Page', array('update' => 'orderContainer', 'url' => 'cms/newPage?group_id='.$group->getId())); ?>