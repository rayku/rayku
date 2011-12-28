<?php use_helper('MyAvatar') ?>
<?php $allfrndsids = array(); ?>
<?php if (count($friends) > 0): ?>
<?php if(count($friends) == 1): ?>
<?php $maxCount = 1;?>

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
		echo link_to($friend->getName(), '@profile?username=' . $friend->getUsername());
	?>
  </li>
  <?php endforeach ?>
</ul>
<?php else: ?>
<?php foreach ($friends as $friend): ?>
<?php $allfrndsids[] = $friend->getId(); ?>
<?php endforeach ?>
<?php if(count($allfrndsids) >=6): ?>
<?php $sixfrnds = array_rand($allfrndsids,6); ?>
<?php elseif(count($allfrndsids) >=5):  ?>
<?php $sixfrnds = array_rand($allfrndsids,5); ?>
<?php elseif(count($allfrndsids) >=4):  ?>
<?php $sixfrnds = array_rand($allfrndsids,4); ?>
<?php elseif(count($allfrndsids) >=3):  ?>
<?php $sixfrnds = array_rand($allfrndsids,3); ?>
<?php elseif(count($allfrndsids) >=2):  ?>
<?php $sixfrnds = array_rand($allfrndsids,2); ?>
<?php endif; ?>





<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin:0">
  <tr>
    <td align="center" style="padding:2px"><?php if($allfrndsids[$sixfrnds[0]] != '') : ?>
      <?php $c = new Criteria();
								   $c->add(UserPeer::ID, $allfrndsids[$sixfrnds[0]]);
								   $user0 = UserPeer::doSelectOne($c);
							 ?>
      <ul>
        <li>
          <?php
											echo link_to(avatar_tag_for_user($user0), '@profile?username=' . $user0->getUsername());
											echo link_to($user0->getName(), '@profile?username=' . $user0->getUsername());
										  ?>
        </li>
      </ul>
      <?php endif; ?></td>
    <td align="center" style="padding:2px"><?php if($allfrndsids[$sixfrnds[1]] != '') : ?>
      <?php $c = new Criteria();
							   $c->add(UserPeer::ID, $allfrndsids[$sixfrnds[1]]);
							   $user1 = UserPeer::doSelectOne($c);
						   ?>
      <ul>
        <li>
          <?php
										echo link_to(avatar_tag_for_user($user1), '@profile?username=' . $user1->getUsername());
										echo link_to($user1->getName(), '@profile?username=' . $user1->getUsername());
									  ?>
        </li>
      </ul>
      <?php endif; ?></td>
    <td align="center" style="padding:2px"><?php if($allfrndsids[$sixfrnds[2]] != '') : ?>
      <?php $c = new Criteria();
								   $c->add(UserPeer::ID, $allfrndsids[$sixfrnds[2]]);
								   $user2 = UserPeer::doSelectOne($c);
							 ?>
      <ul>
        <li>
          <?php
											echo link_to(avatar_tag_for_user($user2), '@profile?username=' . $user2->getUsername());
											echo link_to($user2->getName(), '@profile?username=' . $user2->getUsername());
										  ?>
        </li>
      </ul>
      <?php endif; ?></td>
  </tr>
  <tr>
    <td align="center" style="padding:2px"><?php if($allfrndsids[$sixfrnds[3]] != '') : ?>
      <?php $c = new Criteria();
								   $c->add(UserPeer::ID, $allfrndsids[$sixfrnds[3]]);
								   $user3 = UserPeer::doSelectOne($c);
							 ?>
      <ul>
        <li>
          <?php
											echo link_to(avatar_tag_for_user($user3), '@profile?username=' . $user3->getUsername());
											echo link_to($user3->getName(), '@profile?username=' . $user3->getUsername());
										  ?>
        </li>
      </ul>
      <?php endif; ?></td>
    <td align="center" style="padding:2px"><?php if($allfrndsids[$sixfrnds[4]] != '') : ?>
      <?php $c = new Criteria();
								   $c->add(UserPeer::ID, $allfrndsids[$sixfrnds[4]]);
								   $user4 = UserPeer::doSelectOne($c);
							 ?>
      <ul>
        <li>
          <?php
											echo link_to(avatar_tag_for_user($user4), '@profile?username=' . $user4->getUsername());
											echo link_to($user4->getName(), '@profile?username=' . $user4->getUsername());
										  ?>
        </li>
      </ul>
      <?php endif;?></td>
    <td align="center" style="padding:2px"><?php if($allfrndsids[$sixfrnds[5]] != '') : ?>
      <?php $c = new Criteria();
								   $c->add(UserPeer::ID, $allfrndsids[$sixfrnds[5]]);
								   $user5 = UserPeer::doSelectOne($c);
							 ?>
      <ul>
        <li>
          <?php
											echo link_to(avatar_tag_for_user($user5), '@profile?username=' . $user5->getUsername());
											echo link_to($user5->getName(), '@profile?username=' . $user5->getUsername());
										  ?>
        </li>
      </ul>
      <?php endif; ?></td>
  </tr>
</table>
<?php endif; ?>
<br style="clear: both;" />
<?php else: ?>
<p style="padding-bottom:25px;color:#242424;font-family:Arial;font-size:1.2em;line-height:1.9;"><strong>This user has no friends on Rayku</strong></p>
<?php endif ?>
