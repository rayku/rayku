<?php use_helper('MyAvatar', 'Javascript'); ?>

<div class="body-main">
  <div id="what-is">
    <div style="width: 30px; float: left;">
      <img height="25" width="42" alt="" src="/images/green_arrow.jpg"/>
    </div>
    <p style="font-size: 16px; color: rgb(28, 81, 124); font-weight: bold; margin-left: 55px;">
      Network Homepage
    </p>
  </div>


<div class="left-bg">
  <div class="left-top"></div>
    <div class="content">
      <div class="title"><?php echo $network->getName(); ?></div>
      <div class="spacer"></div>
      <div class="subtitle">
        <?php echo $network->getDescription(); ?>
      </div>
    </div>
  <div class="left-bottom"></div>
</div>
  
<div class="left-bg">
  <div class="left-top"></div>
  <div class="content">
    <div>
      <div class="title">People in this network</div>
    </div>

    <div class="spacer"></div>
    <?php foreach( $network->getMembers() as $member ) { ?>
    <div style="border: 0px solid rgb(0, 255, 0); margin: 18px 0px 0px -3px;">
      <div class="person">
        <?php echo link_to( avatar_tag_for_user($member, 2), '@profile?username='.$member->getUsername() ); ?>
        <div class="cred">
          <a class="name" href="<?php echo url_for('@profile?username='.$member->getUsername()); ?>"><?php echo $member->getName(); ?></a>
          <div class="info">
            <p></p>
          </div>
        </div>
      </div>
    </div>
    <?php } ?>
  </div>
  <div class="left-bottom"></div>
</div>

<div class="left-bg">
  <div class="left-top"></div>
  <div class="content">
    <div>
      <div class="title">Latest threads in this network</div>
    </div>


    <div class="spacer"></div>

    <div>
    <?php foreach( $network->getLatestThreads() as $thread ) { ?>
      <div class="thread">
        <div class="cred">
          <a class="threadtitle" href="<?php echo url_for('@view_thread?thread_id='.$thread->getId()); ?>">
            <?php
              $title = $thread->getTitle();
              if( strlen($title) > 35 )
                echo substr($title, 0, 35) . '...';
              else
                echo $title;
            ?>
          </a>
          <div class="post" style="width: auto">Posted by <a style="color: rgb(147, 190, 0);" href="<?php echo url_for('@profile?username='.$thread->getUser()->getUsername()); ?>"><?php echo $thread->getUser()->getName(); ?></a>.</div>
          <p></p>
        </div>
        <div class="replies"><?php echo $thread->getRepliesCount(); ?></div>
      </div>
      <?php } ?>
    </div>






    <div class="left-bottom"></div>
  </div>
</div>

</div>

<div class="body-side" style="margin-top: 30px;">
  
  <div id="pplinnet">
    <div id="count"><?php echo $network->getMemberCount(); ?></div>
    <p>People are in this network.</p>
  </div>
  
  <?php 
  
  		$c = new Criteria();
		$c->add(UsersNetworksPeer::NETWORK_ID,$network->getId());
		$c->add(UsersNetworksPeer::USER_ID,$sf_user->getRaykuUser()->getId());
		$networkusers = UsersNetworksPeer::doSelectOne($c);
		
	?>
		<?php if($networkusers != NULL):  ?>
		
			
			<?php echo  link_to('UnJoin from this network','/network/unjoin?id='.$network->getId().'', array('class' => 'navlink add')); ?>
			
		
		<?php else: ?>
  
		 <?php echo link_to('Join to this network','/network/join?id='.$network->getId().'', array('class' => 'navlink add')); ?>
			
  		<?php endif; ?>
  

</div>