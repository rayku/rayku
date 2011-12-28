<?php use_helper('MyAvatar') ?>

<?php if (count($friends) > 0): ?>
  <ul>
    <?php $count = 0 ?>
    <?php foreach ($friends as $friend): ?>
      <?php /* @var $friend User */ ?>
      <?php if (isset($maxCount) && is_numeric($maxCount) && ++$count > $maxCount): ?>
        <?php break ?>
      <?php endif ?>

        <li>
          <?php
            echo link_to(avatar_tag_for_user($friend), '@profile?username=' . $friend->getUsername());
            echo link_to($friend->getUsername(), '@profile?username=' . $friend->getUsername());
          ?>
        </li>

    <?php endforeach ?>
  </ul>
	<br style="clear: both;" />
<?php else: ?>
	<p style="padding-bottom:25px;color:#242424;font-family:Arial;font-size:1.2em;line-height:1.9;"><strong>This user has no friends</strong></p>
<?php endif ?>
