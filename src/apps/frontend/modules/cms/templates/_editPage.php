<?php use_helper('Javascript'); ?>
<?php echo form_remote_tag(array('url' => 'cms/editPage', 'complete' => evaluate_remote_response())); ?>
	<?php echo input_hidden_tag('page_id', @$page->getId()); ?>
	Title: <?php echo input_tag('title', $page->getTitle()); ?><br /><br />
	<?php echo textarea_tag('content', $page->getContent(), 'rich=true size=60x30'); ?><br />
	<?php echo submit_tag('Save Page'); ?>
</form>