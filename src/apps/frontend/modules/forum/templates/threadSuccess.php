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
  <div style="width:30px; float:left;"><img height="25" width="42" src="/images/green_arrow.jpg"/></div>
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

  <?php  echo link_to('Back to Forum', 'forum/'.$thread->getCategoryId().'',array('class' => 'navlink back')); ?>

  <div class="box">
    <div class="top"></div>
    <div class="content" style="position:relative; _top:-3px; _bottom:-3px;">
        <div class="text"><strong>Protip:</strong> Answering questions and posting on the forums will increase your tutor rank!</div>
    </div>
    <div class="bottom"></div>
  </div>

</div><!-- end of body-side -->

<br class="clear-both" />
