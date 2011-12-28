<link type="text/css" rel="stylesheet" href="/css/custom/forum-threads.css" />
<link type="text/css" rel="stylesheet" href="/styles/forum_global.css" />
<link type="text/css" rel="stylesheet" href="/styles/forum_donny.css" />


<div id="body">
		
<div class="body-main">
  <div class="box">
  <div class="top"></div>
    <div class="content">
      <div class="title">Forum Questions</div>

          <?php if (count( $threads ) > 0): ?>
            <?php foreach($threads as $thread): ?>

            <?php
                $c=new Criteria();
                $c->addAscendingOrderByColumn(PostPeer::ID);
                $c->add(PostPeer::THREAD_ID,$thread->getId());
                $c->setLimit(1);
                $post=PostPeer::doSelectOne($c);
            ?>


           <div class="entry">
                            <div class="status"><img src="/images/forum-threads-statuson.gif" alt="" /></div>
                              <div class="information">

              <?php echo link_to($thread, '@view_thread?thread_id='.$thread->getId(),array('class' => 'threadttle')); ?>

                                  <div class="threadst"><?php  echo substr($post->getContent(),0,50); ?> ....</div>
                              </div>



                <?php   $c=new Criteria();
                  $c->add(UserPeer::ID,$thread->getPosterId());
                  $user=UserPeer::doSelectOne($c);

              ?>

              <?php echo link_to($user->getUsername(), '@profile?username=' . $user->getUsername(),array('class' => 'author')); ?>

            <div class="replies"><?php echo ($thread->countPosts() - 1) ; ?> Replies</div>
                              <div class="spacer"></div>
                         </div>

           <?php endforeach; ?>
           <?php endif; ?>

                      </div>
                      <div class="spacer"></div>
                      <div class="bottom"></div>
                  </div>

    </div>

		
</div>