<div class="avatar">
  <img alt="img" src="/images/memberlist_avatar.png"/>
</div>

<div class="username">
  <?php
    echo '<h1>';
      echo link_to( $user->getName(). ' <span>('.$user->getUsername().')</span>',
                    '@profile?username=' . $user->getUsername() );
    echo '</h1>';
  ?>
  <div class="desc">
    <?php echo $user->getAboutMe(); ?>
  </div>
</div>

<div class="contact">
  <?php
    if( $sf_user->getRaykuUser()->canRequestForFriendship( $user ) )
       echo link_to('Add as a friend', '@submit_friend_request?username=' . $user->getUsername(),array('class'=>'add') );

    echo link_to(
            'Send message',
            '@compose_to?nickname=' . $user->getUsername(),
            array( 'class' => 'msg' ) );
    // echo link_to('Send a gift', 'gifts/index?username=' . $user->getUsername(), array( 'class' => 'gift' ) );
    echo link_to(
            'See galleries',
            '@gallery_index?user_id=' . $user->getId(),
            array( 'class' => 'gallery' ) );
    echo link_to(
            'Read journal',
            '@journal_index?user_id=' . $user->getId(),
            array( 'class' => 'journal' ) );
  ?>
</div>
