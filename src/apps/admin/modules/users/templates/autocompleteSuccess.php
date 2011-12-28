<ul>
	<?php foreach($users as $user): ?>
		<li><?php echo $user->getUsername(); ?></li>
	<?php endforeach; ?>
</ul>