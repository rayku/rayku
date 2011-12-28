<script type="text/javascript">

function gotoforum()
{
	if(document.getElementById('jumpto').value!="")
	{
		window.location=document.getElementById('jumpto').value ;	
	}
}
</script>

<div id="body">
  <div id="top">
  	<div style="width:30px; float:left;"><img height="25" width="42" src="/images/green_arrow.jpg"/></div>
    <div style="font-size:16px; line-height:22px; color:#1C517C; font-weight:bold; margin-left:25px;float:left; width:600px;">Replying to: "<?php echo $thread->getTitle();?>"</div>
    <select id="jumpto"  onchange="return gotoforum();">
      <option value="">Quick forum selection</option>
      <?php foreach($publicforums as $publicforum): ?>
      <?php if($publicforum->getTopOrBottom() == '0'): ?>
      <option value="<?php echo 'forum/'.$publicforum->getID() ; ?>"><?php echo $publicforum->getName(); ?></option>
      <?php endif; ?>
      <?php endforeach; ?>
      <?php foreach($allcategories as $categorie): ?>
      <option value="<?php echo '/forum/'.$categorie->getID() ; ?>"><?php echo $categorie->getName(); ?> </option>
      <?php endforeach; ?>
      <?php foreach($publicforums as $publicforum): ?>
      <?php if($publicforum->getTopOrBottom() == '1'): ?>
      <option value="<?php echo 'forum/'.$publicforum->getID() ; ?>"><?php echo $publicforum->getName(); ?></option>
      <?php endif; ?>
      <?php endforeach; ?>
    </select>
    <div class="spacer"></div>
  </div>
  <div class="body-main">
    <div class="qa">
      <div class="ta">
        <h1><?php echo $thread->getTitle();?></h1>
        <?php  
								
									$date= $thread->getCreatedAt(); 
									$d1 = explode(' ',$date);
									$d2 = explode('-',$d1[0]) ;
									
									$today= time(); 
									$threaddate=($today - mktime(0,0,0,$d2[1],$d2[2],$d2[0])) / 86400;  
								
								?>
        <div class="submitted">Submitted <?php echo (int)$threaddate ; ?> days ago!</div>
        <div class="clear"></div>
        <div class="sep"></div>
      </div>
      <!--ta-->
      <div class="bg"> <?php echo $post->getContent(); ?> </div>
      <!--bg-->
      <div class="b"></div>
    </div>
    <!--qa--><!--qa--><!--qa--> 
    
    <?php echo form_tag('@expertreply_thread?forum_id='.$thread->getCategoryId().'&thread_id='.$thread->getId()); ?>
    <div class="qa">
      <div class="tb">
        <h1>Your Response</h1>
        <div class="clear"></div>
        <div class="sep"></div>
      </div>
      <!--tb-->
      <div class="answer_submit">
        <?php /*echo textarea_tag('post_body', '', array (

									  'size' => '30x3', 'rich' => true, 'tinymce_options'=>'width: 590'
				
									))*/ ?>
        <?php echo textarea_tag('post_body','',array('size' => '54x40', 'rich' => 'fck')); ?> </div>
      <!--bg-->
      <div class="b"></div>
    </div>
    <!--qa--> 
    
    <!--     <a class="publish_response" href="#">Publish response</a>-->
    
    <input type="submit" name="Post" class="publish_response">
      </form>
  </div>
  <div id="boxes_right">
    <div class="box">
      <div class="t">
        <h1>Key info for question:</h1>
        <div class="div"></div>
      </div>
      <!--t-->
      <div class="bg">
        <ul>
          <li>How to use the pentool, basics of working it</li>
          <li>How to use the pentool, basics of working it</li>
          <li>How to use the pentool, basics of working it</li>
          <li>How to use the pentool, basics of working it</li>
        </ul>
      </div>
      <!--bg-->
      
      <div class="b"></div>
    </div>
    <!--box--> 
    
  </div>
  <!--boxes_right--> 
  
</div>
