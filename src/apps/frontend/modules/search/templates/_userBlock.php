<?php use_helper('MyAvatar', 'Javascript') ?>
<?php $raykuUser = $sf_user->getRaykuUser(); ?>

<div class="entry">
  <?php if($user->getPicture()!=''): ?>
	  <?php echo avatar_tag_for_user($user); ?>
  <?php else: ?>
    <img src="/images/dev/emptyprofile.gif" alt="" />
  <?php endif; ?>
									
  <div class="container">
   	<div>
   		<?php echo link_to($user, '@profile?username='.$user->getUsername(),array('class'=>'name')); ?>                                            
      <div class="username">(<?php echo $user->getUsername(); ?>)</div>
      <a href="#" class="searchbutton">Member</a>
    </div>

    <div class="actions" style="background:none !important;border:0px !important ;float:none;width:auto;padding:0px;">
      <?php if ($sf_user->isAuthenticated() && $user->equals($raykuUser)): ?>
        <?php echo link_to('Edit Your Profile', '@profile_edit?username=' . $user->getUsername(),array('class'=>'useraction')) ?>
			  <?php echo link_to('View Galleries', '@gallery_index?user_id=' . $user->getId(),array('class'=>'useraction')) ?>
        <?php //include_component('nudge', 'showNudges', array('user' => $user)) ?>
      <?php else: ?>
      <div></div>

      <?php echo link_to('Send a message', '@compose_to?nickname=' . $user->getUsername(),array('class'=>'useraction')) ?>
      <?php echo link_to('View Galleries', '@gallery_index?user_id=' . $user->getId(),array('class'=>'useraction')) ?>
      <?php echo link_to('Nudge', '@nudge?username=' . $user->getUsername(),array('class'=>'useraction')) ?>

      <?php endif ?>
    </div>
  </div>
  <div class="spacer"></div>
</div>
