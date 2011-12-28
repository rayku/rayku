<?php use_helper('Javascript') ?>

<p>Friendship requested</p>
<!--
<?php echo link_to_remote(
	'Cancel Request',
	array(
		'url' => '@friend_remove?ajax=1&user_id=' . $user->getId(),
		'update' => 'friendActions[' . $user->getId() . ']',
	),
	array('href' => url_for('@friend_remove?user_id=' . $user->getId()))
) ?>-->
