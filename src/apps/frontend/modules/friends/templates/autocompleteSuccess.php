<ul>
	<?php foreach($users as $user): ?>
		<li style="font-size:16px"><?php echo $user->getUsername(); ?></li>
	<?php endforeach; ?>
</ul>