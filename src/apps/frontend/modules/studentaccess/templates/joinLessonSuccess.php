<link rel="stylesheet" type="text/css" href="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/styles/classroom.css" />

<div class="body-main">

<div class="title" style="float:left; margin-top:20px; margin-left:20px;">
       	<img src="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/images/newspaper.gif" alt="" />
        <p>Join to expert's lesson</p>
</div>

<div class="spacer"  style="margin-top:60px;"></div>

<form name="testform" method="post">

 <div class="entry" style="margin-bottom:11px;">
        	<div class="top"></div>
            <div class="content">
            	<div class="hand-in">
                	<div class="email-st">
                    <label>In order to join to expert's lesson, please do the following procedure. <br /><br />
                            1) Select the category <br />
                            2) Then select expert<br />
                            3) Then select the lesson.<br />
                            4) Finally join to that lesson.<br />
                            </label>
					 
					 <label style="margin-top: 30px;">Select category:</label>
					 
					 <select id="category" name="category" class="dropdown" onchange="document.testform.submit();">
					 <option value="" selected="selected">SELECT CATEGORY</option>
					<?php foreach($categories as $category) { ?>
							<option value="<?php echo $category->getId();?>" 
							<?php if( $catid == $category->getId()): ?> selected="selected" <?php endif ?> >
							 <?php echo $category->getname(); ?></option>
					<?php } ?>
					</select>
					
					 <label style="margin-top: 15px;">Select expert:</label>
					
					<select id="teacher" name="expert" class="dropdown" onchange="document.testform.submit();">
					<option value="">SELECT EXPERT</option>
					<?php foreach($alluser as $user) { ?>
					<option value="<?php echo $user->getId(); ?>" <?php if($userid==$user->getId()) { ?> selected="selected"<?php } ?>><?php echo $user->getName(); ?></option>
					<?php } ?>
					</select>

					 <label style="margin-top: 15px;">Select lesson:</label>
					
					<select id="classroom" name="lesson" class="dropdown" onchange="document.testform.submit();">
					<option value="">SELECT LESSON</option>
					<?php foreach($allclassroom as $classroom) { ?>
					<option value="<?php echo $classroom->getId(); ?>" <?php if($lessid==$classroom->getId()) { ?> selected="selected"<?php } ?>  ><?php echo $classroom->getTitle(); ?></option>
					<?php } ?>
					</select> 
					 
					<?php if($lessid != "") :?>
					
					 <label style="margin-top: 15px; margin-bottom:30px;"><a href="<?php echo url_for('studentaccess/sendMail?userid='.$userid.'&catid='.$catid.'&lessid='.$lessid.'');?>" class="blue" style="line-height:35px; float:left;"><span>JOIN</span></a></label>
					
			  		<?php endif;?>
			  
			  </div>
              </div>
            </div>
			
            <div class="bottom"></div>
			
        </div>	
				
	</form>

</div><!-- end of body-main -->
