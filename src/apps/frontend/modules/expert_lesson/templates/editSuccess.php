<?php use_helper('Javascript'); ?>

<script type="text/javascript">
function checkrange(val)
{
	if(!((val >= 8) && (val <= 25)))
	{
		alert("Value should be inbetween 8 and 25.");
		document.frmLesson.price.value = '';
		document.frmLesson.price.focus();
		return false;
	}else
	{
		return true;
	}
}
</script>
		<div id="top">
			<a id="create-account">Create a Lesson</a>
			<div class="clear-both"></div>
		</div>
	
	
		<div class="body-main">
						
			<?php use_helper('Object') ?>
			
				<?php echo form_tag('expert_lesson/update',array('name' => 'frmLesson', 'onsubmit' => 'javascript: return checkrange(document.frmLesson.price.value);')) ?>
			
			  			
		<div class="box">
				<div class="top"></div>
				
				<?php echo object_input_hidden_tag($expert_lesson, 'getId') ?>
				<?php echo object_input_hidden_tag($expert_lesson, 'getUserId') ?>
				
				
				<div class="content">
					<div class="entry">
						<div class="ttle">Title</div>
						<div>
							<?php echo object_input_tag($expert_lesson, 'getTitle', array ('size' => 80,)) ?>
							<div class="information">
								Please make sure this is correct. This is <br /><span style="position:relative; top:2px">where we will send your confirmation email!</span>
							</div>
						</div>
						<div class="spacer"></div>
					</div>
					<div class="entry">
						<div class="ttle">Description</div>
						<div class="clear-both"></div>
						<div>
							<?php echo object_textarea_tag($expert_lesson, 'getContent', array ('size' => '30x3',)) ?>
							<div class="information">
								Please make sure this is correct. This is <br /><span style="position:relative; top:2px">where we will send your confirmation email!</span>
							</div>
						</div>
						<div class="spacer"></div>
					</div>
			  <div class="entry">
						<div class="ttle">Rate</div>
						
						<div style="clear:left">
							<?php echo object_input_tag($expert_lesson, 'getPrice', array ('class' => 'price', 'name' => 'price', 'id' => 'rate', 'onchange' => 'javascript: return checkrange(this.value);')) ?>
							<!--<input type="text" class="price" name="price" value="" onchange="" />-->
							<div class="per">$&nbsp;PER</div>
						   <select style=" background:#FFFFFF url(/images/rate.gif) no-repeat scroll 0 0; width:100px;" name="method">
							<option value="" selected="selected">Hour</option>
								<!--<option value="01">Day</option>
								<option value="02">Week</option>
								<option value="03">Month</option>-->
							</select>
							<div class="information">
								Please make sure this is correct. This is <br /><span style="position:relative; top:2px">where we will send your confirmation email!</span>
							</div>
							
							<div style="clear: both;">
						
						<?php if ($expert_lesson->getId()): ?>
							
							<?php //  echo submit_tag('update') ?>
							
							<input class="blue1" type="submit" name="commit" value="update" />
							
							&nbsp;<?php echo link_to('delete', 'expert_lesson/delete?id='.$expert_lesson->getId(),array('class' => 'blue1'),'post=true&confirm=Are you sure?') ?>
							&nbsp;<?php echo link_to('cancel', 'expert_lesson/show?id='.$expert_lesson->getId(),array('class' => 'blue1')) ?>
						
						<?php else: ?>
							<input type="submit" name="submit" value="submit" class="createlesson" />
							<!--<a class="createlesson" href="#" onclick="return checkrange(document.frmLesson.price.value); document.frmLesson.submit();">Create</a>-->
  							&nbsp;<?php echo link_to('cancel', 'expert_lesson/list',array('class' => 'blue1')) ?>
  						<?php endif; ?>
						
						</div>
							
				</div>
						<div class="spacer"></div>
						
						
						 
				  </div>
				</div>
							
				
				</form>
				<div class="bottom"></div>
			</div>
		   
			</div>
		<div class="body-side">
			<div class="box">
				<div class="top"></div>
				<div class="content" style="position:relative; _top:-3px; _bottom:-3px;">
					<div class="title" style="margin-top:0px;">About the process</div>
					<div class="text">First we do this, then we do that and then we do this. First we do this, then we do that and then we do this. First we do this, then we do that and then we do this. First we do this, then we do that and then we do this. First we do this, then we do that and then we do this. First we do this, then we do that and then we do this. First we do this, then we do that and then we do this. First we do this, then we do that and then we do this. </div>
				</div>
				<div class="bottom"></div>
			</div>
		</div>
