
<?php use_helper('MyText', 'Date') ?>

<?php $linkText = '' ?>

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
  <div style="font-size:16px; line-height:24px;color:#1C517C;font-weight:bold;margin-left:25px;float:left;width:600px;"><?php echo link_to('Q&A Boards','forum/index', 'style=color:#1c517c'); ?> > <?php echo link_to($category->getName(),'forum/'.$category->getId().'', 'style=color:#1c517c');?></div>

  <select id="jumpto"  onchange="return gotoforum();">
		<option value="">Quick forum selection</option>
				   
		<?php foreach($publicforums as $publicforum): ?>
	
		<?php if($publicforum->getTopOrBottom() == '0'): ?> 
		
	 		<option value="<?php echo '/forum/'.$publicforum->getID() ; ?>"><?php echo $publicforum->getName(); ?></option>
			
		<?php endif; ?>
		
	<?php endforeach; ?>
		
		<?php foreach($allcategories as $categorie): ?>
		  <option value="<?php echo '/forum/'.$categorie->getID() ; ?>"><?php echo $categorie->getName(); ?> </option>
		<?php endforeach; ?>   
		
		
	<?php foreach($publicforums as $publicforum): ?>
	
		<?php if($publicforum->getTopOrBottom() == '1'): ?> 
		
	 		<option value="<?php echo '/forum/'.$publicforum->getID() ; ?>"><?php echo $publicforum->getName(); ?></option>
			
		<?php endif; ?>
		
	<?php endforeach; ?>
	                     	  
  </select>
  <div class="spacer"></div>
</div>

<div class="spacer"></div>

<?php if($category->getId() != NULL): ?>

	<?php
	  include_component('forum', 'showForum', array( 'forumID' => $category->getId(),
													 'page' => $page,
													 'threadsPerPage' => $threadsPerPage));
	?>
	
<?php else: ?>

	<?php
	  include_component('forum', 'showForum', array( 'forumID' => $forum->getId(),
													 'page' => $page,
													 'threadsPerPage' => $threadsPerPage));
	?>
	
<?php endif; ?>
