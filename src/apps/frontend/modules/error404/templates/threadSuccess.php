<script type="text/javascript">

function gotoforum()
{
	if(document.getElementById('jumpto').value!="")
	{
		window.location=document.getElementById('jumpto').value ;
	}
}
</script>

<style type="text/css">
.message ol {
list-style-type: decimal !important;
}

.message ul {
list-style-type: disc !important;
}

</style>


<div id="top" style="margin-left:16px;padding-top:2px">
  <div style="width:30px; float:left;"><img height="25" width="42" src="<?php echo image_path('green_arrow.jpg', false); ?>"/></div>
  <div style="font-size:16px; line-height:24px;color:#1C517C;font-weight:bold;margin-left:25px;float:left;width:600px;"><?php echo link_to('Q&A Boards','forum/index'); ?> > <?php echo link_to($category->getName(),'forum/'.$category->getId().'');?> > <?php echo $thread->getTitle() ; ?></div>

  <select id="jumpto"  onchange="return gotoforum();">
    <option value="">Quick forum selection</option>
		<?php foreach($publicforums as $publicforum): ?>

		<?php if($publicforum->getTopOrBottom() == '0'): ?>

	 		<option value="<?php echo '/forum/'.$publicforum->getID() ; ?>"><?php echo $publicforum->getName(); ?></option>

		<?php endif; ?>

		<?php endforeach; ?>

		<?php foreach($allcategories as $categorie): ?>
		  <option value="<?php echo '/forum/'.$categorie->getID() ; ?>"><?php echo $categorie->getName(); ?></option>
		<?php endforeach; ?>

		<?php foreach($publicforums as $publicforum): ?>

		<?php if($publicforum->getTopOrBottom() == '1'): ?>

	 		<option value="<?php echo '/forum/'.$publicforum->getID() ; ?>"><?php echo $publicforum->getName(); ?></option>

		<?php endif; ?>

		<?php endforeach; ?>


    </select>

    <div class="spacer"></div>
</div>

<?php include_component('forum', 'showThread', array( 'threadID' => $thread->getId(),
                                                      'page' => $page,
                                                      'postsPerPage' => $postsPerPage)); ?>

<div class="body-side">
  <?php
    if( $sf_user->isAuthenticated() )
    {
      $best_resp_count = PostPeer::getCountOfBestResponseForThread($thread);

      if( $best_resp_count < 1 && $thread->getVisible() == '1' )
      {


	   // include_partial('makePostForm', array( 'forum' => $thread->getCategoryId(),
                                     //  'threadID' => $thread->getId(),
                                    //   'class' => 'Reply to this thread'));


		if($sf_user->getRaykuUser()->getType()!= 5)

		{
			echo link_to('Respond to this Topic','@userreply_thread?forum_id='.$thread->getCategoryId().'&thread_id='.$thread->getId(), array('class'=> 'navlink add'));

		}

		else
		{
			echo link_to('Respond to this Topic','@expertreply_thread?forum_id='.$thread->getCategoryId().'&thread_id='.$thread->getId(), array('class'=> 'navlink add'));

		}

      }
    }
  ?>

  <?php  echo link_to('Back to Forum', 'forum/'.$thread->getCategoryId().'',array('class' => 'navlink back')); ?>

  <div class="box">
    <div class="top"></div>
    <div class="content" style="position:relative; _top:-3px; _bottom:-3px;">
      <div class="title" style="margin-top:0px">Increase Your Expert Score</div>
        <div class="text">
          Build your expert score by answering questions on the Rayku Question Boards. If your answer is selected as the 'Best Response' by the asker, you get a bonus!<br />
          <br />
          Please make sure your responses are thoroughly-analyzed before posting - there is no edit function!
        </div>
    </div>
    <div class="bottom"></div>
  </div>

</div><!-- end of body-side -->

<br class="clear-both" />
