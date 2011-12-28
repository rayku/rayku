<?php
  use_helper('MyAvatar');

  if (count($members) > 0)
  {
    $count = 0;
    
    foreach ($members as $member)
    {
      if( isset($maxCount) && is_numeric($maxCount) && ++$count > $maxCount )
        break;
    ?>
		<div style="float: left; margin-right: 5px; margin-bottom: 5px;">
		<?php echo link_to(avatar_tag_for_user($member), '@profile?username=' . $member->getUsername()) ?><br />
		<span style="color:#242424;font:1.2em/1.9 Arial;margin:3px 15px 20px 15px;">
		<?php echo link_to($member->getUsername(), '@profile?username=' . $member->getUsername()) ?>
		</span>
					
		</div>
	  <?php
    }
    ?>
	<br style="clear: both;" />
<?php  } else { ?>
	<strong>This class has no students</strong>
<?php } ?>