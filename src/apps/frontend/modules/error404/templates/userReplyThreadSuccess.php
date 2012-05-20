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
					  <div class="title">
						<img src="<?php echo image_path('arrow-right.gif', false); ?>" alt="" />
						<p><?php echo $thread->getTitle();?></p>
					  </div>
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
                            </div><!--ta-->
                            <div class="bg">
                            	<?php echo $post->getContent(); ?> 
                            </div><!--bg-->
                            <div class="b"></div>
                        
                        </div><!--qa-->
                        
                    	<?php echo form_tag('@userreply_thread?forum_id='.$thread->getCategoryId().'&thread_id='.$thread->getId()); ?> 
						    
                        <div class="qa">

                        
                        	<div class="tb">
                            	<h1>Submit an answer</h1>
                                <div class="clear"></div>
                                <div class="sep"></div>
                            </div><!--tb-->
                            <div class="answer_submit">
                            	<?php /*echo textarea_tag('post_body', '', array (

									  'size' => '30x3', 'rich' => true, 'tinymce_options'=>'width: 590'
				
									))*/ ?> 
									
									
								<?php echo textarea_tag('post_body','',array('size' => '58x40', 'rich' => 'fck')); ?>			
									
                            </div><!--bg-->

                            <div class="b"></div>
                        
                        </div><!--qa-->
                        
                       <!-- <a class="submit_answer" href="#">Submit answer</a> -->
						
						 <input type="submit" name="Post" class="submit_answer">
                        
					</div>  
					
					</form>
					
					<div id="boxes_right">
                    
                    	<div class="box">
                        	<div class="t">
                            	<h1>Get Expert Score for Helping!</h1>

                                <div class="div"></div>
                            </div><!--t-->
                            <div class="bg">By sharing your expertise with this member, you are may increase your expert score. When a member selects one of your responses as the 'best response', your expert score will <strong>increase by 20</strong>.<br />
                              <br />
                              This will allow you to rank higher in listings and earn more Rayku Points!
                              <br /><br />
                              Please note that the boards are moderated for malicious activity. Tampering with our system will result in an <strong>immediate ban</strong>. <br />
                          </div><!--bg-->
                            <div class="b"></div>
                    	</div>
                    	<!--box-->
                    
                    </div><!--boxes_right--> 
					
				</div>
                    