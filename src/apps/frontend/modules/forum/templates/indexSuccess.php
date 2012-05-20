<script type="text/javascript">

function gotoforum()
{
	if(document.getElementById('jumpto').value!="")
	{
		window.location=document.getElementById('jumpto').value ;
	}
}

</script>
<div id="top" style="margin-left:16px;padding-top:2px">
  <div style="width:30px; float:left;"><img height="25" width="42" src="<?php echo image_path('green_arrow.jpg', false); ?>"/></div>
  <div style="font-size:16px; line-height:24px;color:#1C517C;font-weight:bold;margin-left:25px;float:left;width:600px;"><?php echo link_to('Q&A Boards','forum/index', 'style=color:#1c517c'); ?></div>

 
  <select id="jumpto" onchange="return gotoforum();">
    <option value="">Quick forum selection</option>
    <?php foreach($publicforums as $publicforum): ?>
    <?php if($publicforum->getTopOrBottom() == '0'): ?>
    <option value="<?php echo '/forum/'.$publicforum->getID() ; ?>"><?php echo $publicforum->getName(); ?></option>
    <?php endif; ?>
    <?php endforeach; ?>

<!--
    <?php foreach($categories as $categorie): ?>
    <option value="<?php echo 'forum/'.$categorie->getID() ; ?>"><?php echo $categorie->getName(); ?></option>
    <?php endforeach; ?>
    <?php foreach($publicforums as $publicforum): ?>
    <?php if($publicforum->getTopOrBottom() == '1'): ?>
    <option value="<?php echo '/forum/'.$publicforum->getID() ; ?>"><?php echo $publicforum->getName(); ?></option>
    <?php endif; ?>

-->

    <?php endforeach; ?>
  </select>
  <div class="spacer"></div>

		
</div>

<div class="spacer"></div>
<div class="spacer"></div>
<div class="body-main">
<div style="width:605px;height:87px;background:url(../images/forum-header-bg.jpg);margin-bottom:20px;padding:25px">
<h3 style="color:#1C517C;font-size:28px;font-weight:bold;line-height:28px;">Ask Questions, Get Answers!</h3>
<p style="font-size:14px;color:#666;line-height:20px;margin-top:15px">
    Ask a question to tap into our community of experts free. <br />
    Answer them and get RP!</p>
</div>
  <div class="forum">
    
    <div class="top"></div>

    <div class="bg">
      <?php foreach($publicforums as $publicforum): ?>
      <?php if($publicforum->getTopOrBottom() == '0'): ?>
      <div class="cat">
        <div class="iconnew2"><img src="../images/forum-icon-new2.png" /></div>
        <div class="desc">
		
		
          <h1><a href="#"><?php echo link_to($publicforum->getName(), 'forum/'.$publicforum->getID()); ?></a></h1>
          <?php echo $publicforum->getDescription(); ?> </div>
        <?php
						$t=new Criteria();
						$t->add(ThreadPeer::CATEGORY_ID,$publicforum->getID());
						$t->add(ThreadPeer::CANCEL,0);
						$forumcount=ThreadPeer::doCount($t);
					  ?>
        <div class="threads"><?php echo $forumcount; ?> Topics<br />
          <?php
					  $p=new Criteria();
					  $p->addJoin(ThreadPeer::ID,PostPeer::THREAD_ID,Criteria::JOIN);
					  $p->add(ThreadPeer::CATEGORY_ID,$publicforum->getID());
					$p->add(ThreadPeer::CANCEL,0);
					  $postcount=PostPeer::doCount($p);
					  ?>
          <?php echo ($postcount-$forumcount); ?> Replies </div>
        <div class="clear-both"></div>
      </div>
      <?php endif; ?>
      <?php endforeach; ?>

<!--
      <?php foreach($categories as $categorie): ?>
      <div class="cat">
        <div class="iconnew"><img src="../images/forum-icon-new.png" /></div>
        <div class="desc">
          <h1><a href="#"><?php echo link_to('Help With: '.$categorie->getName(), 'forum/'.$categorie->getID()); ?></a></h1>
          <?php echo $categorie->getDescription(); ?> </div>
        <?php
            $t=new Criteria();
            $t->add(ThreadPeer::CATEGORY_ID,$categorie->getID());
	   $t->add(ThreadPeer::CANCEL,0);
            $forumcount=ThreadPeer::doCount($t);

          ?>
        <div class="threads"><?php echo $forumcount; ?> Qu's<br />
          <?php
          $p=new Criteria();
          $p->addJoin(ThreadPeer::ID,PostPeer::THREAD_ID,Criteria::JOIN);
          $p->add(ThreadPeer::CATEGORY_ID,$categorie->getID());
         $p->add(ThreadPeer::CANCEL,0);
          $postcount=PostPeer::doCount($p);
          ?>
          <?php echo ($postcount-$forumcount); ?> Replies </div>
        <div class="clear-both"></div>
      </div>
      <?php endforeach; ?>
-->

      <?php foreach($publicforums as $publicforum): ?>
      <?php if($publicforum->getTopOrBottom() == '1'): ?>
      <div class="cat">
        <div class="iconnew2"><img src="../images/forum-icon-new2.png" /></div>
        <div class="desc">
          <h1><a href="#"><?php echo link_to($publicforum->getName(), 'forum/'.$publicforum->getID()); ?></a></h1>
          <?php echo $publicforum->getDescription(); ?> </div>
        <?php
						$t=new Criteria();
						$t->add(ThreadPeer::CATEGORY_ID,$publicforum->getID());
						 $t->add(ThreadPeer::CANCEL,0);
						$forumcount=ThreadPeer::doCount($t);
					  ?>
        <div class="threads"><?php echo $forumcount; ?> Topics<br />
          <?php
					  $p=new Criteria();
					  $p->addJoin(ThreadPeer::ID,PostPeer::THREAD_ID,Criteria::JOIN);
					  $p->add(ThreadPeer::CATEGORY_ID,$publicforum->getID());
					 $p->add(ThreadPeer::CANCEL,0);
					  $postcount=PostPeer::doCount($p);
					  ?>
          <?php echo ($postcount-$forumcount); ?> Replies </div>
        <div class="clear-both"></div>
      </div>
      <?php endif; ?>
      <?php endforeach; ?>
    </div>
    <!--bg-->
    <div class="bot"></div>
  </div>
  <!--forum-->

</div>
<div class="body-side">
  <div class="forumside">
    <div class="top"></div>
    <div class="bg">
      <h1 style="padding:7px 2px">Latest Questions</h1>
      <?php foreach($latest as $latestqn) : ?>
      <?php /*$c=new Criteria();
										  $c->add(PostPeer::THREAD_ID,$latestqn->getId());
										  $post=PostPeer::doSelectOne($c); */
									?>
      <?php echo link_to($latestqn->getTitle(), '@view_thread?thread_id='.$latestqn->getId().'&page=1', array('class' => 'question','style' => 'background-repeat:no-repeat')); ?>
      <?php $co=new Criteria();
										  $co->add(PostPeer::THREAD_ID,$latestqn->getId());
								
										  $replycount=PostPeer::doCount($co);
									?>
      <?php
										  $fo=new Criteria();
										  $fo->add(CategoryPeer::ID,$latestqn->getCategoryId());
										  $categorie=CategoryPeer::doSelectOne($fo);

									?>
      <?php
										  $u=new Criteria();
										  $u->add(UserPeer::ID,$latestqn->getPosterId());
										  $user=UserPeer::doSelectOne($u);

									?>
      <div class="det"> <span> <?php echo ($replycount-1); ?> Responses </span><br />
        Question Asked by <?php echo link_to($user->getName(), 'http://www.rayku.com/expertmanager/portfolio/' . $user->getUsername() ); ?> </div>
      <?php endforeach; ?>
    </div>
    <div class="bot"></div>
  </div>
  <!--forumside-->

  <!--<div class="clear-both"></div>
  <div class="forumside">
    <div class="top"></div>
    <div class="bg">
      <h1>Top Experts (Overall)</h1>
      <?php

											$c=new Criteria();
											$c->add(UserPeer::TYPE, '5');
											$c->addDescendingOrderByColumn(UserPeer::POINTS);
											$c->setLimit(10);
											$experts=UserPeer::doSelect($c);

									 ?>
      <ul class="experts">
        <?php foreach($experts as $expert): ?>
        <?php

													$c=new Criteria();
													$c->add(PostPeer::POSTER_ID,$expert->getId());
													$c->add(PostPeer::BEST_RESPONSE, '1');
													$best_resp=PostPeer::doCount($c);

											?>
        <li><?php echo link_to($expert->getName(), 'http://www.rayku.com/expertmanager/portfolio/' . $expert->getUsername()); ?>: <?php echo $best_resp; ?> Best Responses</li>
        <?php endforeach; ?>
      </ul>
    </div>
    <div class="bot"></div>
  </div>-->
</div>
