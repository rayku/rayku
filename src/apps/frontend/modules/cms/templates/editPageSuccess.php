<?php use_helper('Javascript'); ?>
<?php echo update_element_function('page_'.$page->getId(), array('content' => $page->getTitle().' ['.link_to_remote('e', array('url' => 'cms/editPageDisplay?page_id='.$page->getId(), 'update' => 'CMS')).'] ['.link_to_remote('x', array('url' => 'cms/deletePage?page_id='.$page->getId(), 'complete' => evaluate_remote_response())).']')); ?>
<?php echo update_element_function('CMS', array('content' => 'The page was successfully edited.')); ?>
