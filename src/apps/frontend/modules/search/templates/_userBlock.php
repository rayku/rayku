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
				<?php echo link_to('View Journal', '@journal_index?user_id=' . $user->getId(),array('class'=>'useraction')) ?>
        <?php //include_component('nudge', 'showNudges', array('user' => $user)) ?>
      <?php else: ?>
      <?php if ($sf_user->isAuthenticated()): ?>
        <p id="friendActions[<?php echo $user->getId() ?>]" style="float:left;">
        <?php if ($user->isFriendsWith($raykuUser)): ?>
          <?php if (isset($ajaxAdd) && $ajaxAdd): ?>
            <?php echo link_to_remote(
                'Remove Friend',
                array(
                    'url' => '@friend_remove?ajax=1&user_id=' . $user->getId(),
                    'update' => 'friendActions[' . $user->getId() . ']',
                ),
                array('href' => url_for('@friend_remove?user_id=' . $user->getId()),'class'=>'useraction')
                 );
            ?>
          <?php else: ?>
            <?php echo link_to('Remove as Friend', '@friend_remove?user_id=' . $user->getId(),array('class'=>'useraction')) ?>
          <?php endif ?>

        <?php elseif ($raykuUser->isRequestedBy($user)): ?>
          <?php if (isset($ajaxAdd) && $ajaxAdd): ?>
            <?php echo link_to_remote(
              'Accept Request',
              array(
                  'url' => '@friend_accept?user_id=' . $user->getId(),
                  'update' => 'friendActions[' . $user->getId() . ']',
              ),
              array('href' => url_for('@friend_accept?user_id=' . $user->getId() ), 'class'=>'useraction')
              );
            ?>
            <br />
            <?php echo link_to_remote(
              'Deny Request',
              array(
                  'url' => '@friend_deny?user_id=' . $user->getId(),
                  'update' => 'friendActions[' . $user->getId() . ']',
              ),
              array('href' => url_for('@friend_deny?user_id=' . $user->getId() ), 'class'=>'useraction')
              );
            ?>
          <?php else: ?>
            <?php echo link_to('Accept Request', '@friend_accept?user_id=' . $user->getId(), array('class'=>'useraction')) ?>
            <?php echo link_to('Refuse Request', '@friend_deny?user_id=' . $user->getId(), array('class'=>'useraction')) ?>
          <?php endif ?>
          
        <?php elseif ($user->isRequestedBy($raykuUser)): ?>
          <?php if (isset($ajaxAdd) && $ajaxAdd): ?>
            <?php echo 'Request not answered yet <br />'; ?>
          <!--  <?php echo link_to_remote(
              'Cancel Request',
              array(
                'url' => '@friend_remove?ajax=1&user_id=' . $user->getId(),
                'update' => 'friendActions[' . $user->getId() . ']',
              ),
              array('href' => url_for('@friend_remove?user_id=' . $user->getId()))
              );
            ?>-->
          <?php else: ?>
            <?php echo '<p>Request not answered yet</p>'; ?>
         <!--   <?php echo link_to('Cancel Request', '@friend_remove?user_id=' . $user->getId(),array('class'=>'useraction')) ?>-->
          <?php endif ?>

          
        <?php else: ?>
          <?php if (isset($ajaxAdd) && $ajaxAdd): ?>
            <?php echo link_to_remote(
              'Add as a friend',
              array(
                  'url' => '@submit_friend_request?username=' . $user->getUsername(),
                  'update' => 'friendActions[' . $user->getId() . ']',
              ),
              array('href' => url_for('@submit_friend_request?username=' . $user->getUsername()),'class'=>'addfriend')
              );
            ?>
          <?php else: ?>
            <?php echo link_to('Add as a friend', '@submit_friend_request?username=' . $user->getUsername(),array('class'=>'addfriend')) ?>
          <?php endif ?>
        <?php endif ?>
      </p>
      <?php endif ?>
      <div></div>

      <?php echo link_to('Send a message', '@compose_to?nickname=' . $user->getUsername(),array('class'=>'useraction')) ?>
      <?php echo link_to('View Galleries', '@gallery_index?user_id=' . $user->getId(),array('class'=>'useraction')) ?>
      <?php echo link_to('View Journal', '@journal_index?user_id=' . $user->getId(),array('class'=>'useraction')) ?>
      <?php echo link_to('Nudge', '@nudge?username=' . $user->getUsername(),array('class'=>'useraction')) ?>

      <?php endif ?>
    </div>
  </div>
  <div class="spacer"></div>
</div>
