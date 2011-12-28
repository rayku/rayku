<?php use_helper('Javascript') ?>

<p>Friendship removed</p>
<?php echo link_to_remote(
	'Re-add Friend',
	array(
		'url' => '@submit_friend_request?username=' . $user->getUsername(),
		'update' => 'friendActions[' . $user->getId() . ']',
	),
	array('href' => url_for('@submit_friend_request?username=' . $user->getUsername()))
) ?>