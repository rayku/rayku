<?php use_helper('MyAvatar', 'Javascript') ?>
<?php
  $post = PostPeer::retrieveByPk( $object['ID'] );
  $poster = UserPeer::retrieveByPK( $post->getPosterId() );
  $thread = $post->getThreadId();
?>

<div class="entry">
  <?php if($poster->getPicture()!=''): ?>
	  <?php echo avatar_tag_for_user($poster); ?>
  <?php else: ?>
    <img src="/images/dev/emptyprofile.gif" alt="" />
  <?php endif; ?>

  <div class="container">
   	<div>
   		<?php
        $sLink = 'Posted by: '.$poster->getName().' - Inside '.$object['NAME'];
        echo link_to( $sLink,
                'forum/thread?thread_id=' . $post->getThreadId(),
                array( 'class' => 'name' ) );
      ?>
      <div class="username"> - <?php echo $object['DESCRIPTION']; ?></div>
      <a href="#" class="searchbutton">Thread</a>
    </div>

    <div class="actions" style="background:none !important;border:0px !important ;float:none;width:auto;padding:0px;">
      <p class="extract">

      </p>
    </div>
  </div>
  <div class="spacer"></div>
</div>