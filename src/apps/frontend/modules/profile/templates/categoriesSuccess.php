<link rel="stylesheet" type="text/css" href="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/styles/ex_global.css" />
<link rel="stylesheet" type="text/css" href="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/styles/ex_donny.css" />
<style media="all" type="text/css">
	.entry select {
		width:295px; height:40px;
		background:#fff url(../../../images/add-journal-view.gif) no-repeat;
		float:left;
		margin-right:5px;
		color:#3d3d3d;
		font:14px "Arial";
		border:0px;
		padding:11px 10px 10px 12px;
		}
</style>
<div id="top">
	<div class="title" style="float:left">
		<img src="../../../images/arrow-right.gif" alt="" />
		<p>Categories</p>
	</div>

	<div class="spacer"></div>
</div>


<div class="body-main">
	<div class="box">
		<div class="top"></div>
		<div class="content">
			<h1 class="jc">Unjoin from categories</h1>

			<div class="entry" style="margin-top:10px">
				<ul class="cats">
					<?php foreach($usercategories as $category) : ?>
						<li><?php echo $category->getName(); ?>(<?php echo $category->getPrefix(); ?>) <?php echo link_to('Unjoin','profile/unjoinExpert?catid='.$category->getId().'&user='.$user.'','post=true&confirm=Are you sure you want to unjoin?&class=unjoin');?></li>						
					<?php endforeach; ?>
				</ul>
			</div>

			<div class="spacer"></div>
		</div>
		<div class="bottom"></div>
		<div class="spacer"></div>
	</div>
	<div class="box">
		<div class="top"></div>
		<div class="content">
			<h1 class="jc">Join to new categories</h1>

			<div class="entry" style="margin-top:10px">
				<?php echo form_tag('profile/joinCategory?userid='.$user.'', array('name' => 'frmJoin')); ?>
				<select name="category[]" id="category" multiple="multiple" class="dropdown">
					<?php foreach($unjoinedcategories as $categories):?>
						<option value="<?php echo $categories->getId(); ?>">
							<?php echo $categories->getName(); ?>
						</option>
					<?php endforeach; ?>									
				</select>				
				<a class="join" href="#" onclick="javascript: document.frmJoin.submit();">asd</a>
				</form>
				<div class="clear-both"></div>
				
				<div class="jt">
					Donny wants some text here, and guess what? Donny will get some text here! Donny wants some text here, and guess what? Donny will get some text here! Donny wants some text here, and guess what? Donny will get some text here!
				</div>

				<div class="spacer"></div>
			</div>
		</div>
		<div class="bottom"></div>
	</div>
	
	

	<div class="spacer"></div>
</div>
<div class="body-side">
	<div class="box">
		<div class="top"></div>
		<div class="content" style="position:relative; _top:-3px; _bottom:-3px;">
			<div class="title" style="margin-top:0px">About the process</div>
			<div class="text">
				You can transfer the money you-ve earned from tuition here. This is where you can choose to convert the cash you made into rayku points, or into your very own paypal account so you can buy some nifty stuff at home. GET PAID FOR BEING AN AT HOME TEACHER!</div>
		</div>
		<div class="bottom"></div>
	</div>
</div>



<!--<div class="title" style="float:left; margin-left:20px; margin-top:20px;">
   	<img src="http://www.rayku.com/images/newspaper.gif" alt="" />
    <p>Unjoin from categories</p>
</div>

<div class="spacer"></div>

<div class="entry" style="margin-bottom:11px;">
        	<div class="top"></div>
            <div class="content">
            	<div class="hand-in">
                	<div class="email-st">
					
						<label style="margin-top:50px;"></label>
                   		<?php foreach($usercategories as $category) : ?>
						
							<label style="margin-top:20px;"><?php echo $category->getName(); ?>(<?php echo $category->getPrefix(); ?>)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo link_to('Unjoin','profile/unjoinExpert?catid='.$category->getId().'&user='.$user.'','post=true&confirm=Are you sure you want to unjoin?');?></label>
						
						<?php endforeach; ?>
				   	


					
                    </div>
                </div>
            </div>
            <div class="bottom"></div>
 </div>
 
 <div class="title" style="float:left; margin-left:20px; margin-top:20px;">
   	<img src="http://www.rayku.com/images/newspaper.gif" alt="" />
    <p>Join to new categories</p>
</div>

<div class="spacer"></div>

<div class="entry" style="margin-bottom:11px;">
        	<div class="top"></div>
            <div class="content">
            	<div class="hand-in">
                	<div class="email-st">
					
						<label style="margin-top:50px;"></label>
						<label style="margin-top:20px;">Select categories:</label>
						
						<?php echo form_tag('profile/joinCategory?userid='.$user.''); ?>
						
						<label style="margin-top:20px;"></label>
						
						<select name="category[]" id="category" multiple="multiple" class="dropdown">
						<?php foreach($unjoinedcategories as $categories):?>
							
							<option value="<?php echo $categories->getId(); ?>"><?php echo $categories->getName(); ?></option>

						<?php endforeach; ?>									

						</select>
						
						</label>
						
						<label  style="margin-top:20px; margin-bottom:70px;"><?php echo submit_tag('JOIN',array('class' => 'blue')); ?></label>
					</form>
                    </div>
                </div>
            </div>
            <div class="bottom"></div>
 </div>-->
		