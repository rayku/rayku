<link href="http://<?php echo RaykuCommon::getCurrentHttpDomain(); ?>/styles/classroom.css" type="text/css" rel="stylesheet" />

<div class="body-main">

<div class="title" style="float:left; margin-left:20px; margin-bottom:20px;">
   	<img src="http://<?php echo RaykuCommon::getCurrentHttpDomain(); ?>/images/newspaper.gif" alt="" />
    <p>Email Students</p>
</div>

 <div class="spacer"></div>
 
 
 

<?php //echo form_tag('classmanager/writeMail',array('name=testform')); ?>

<form action="writeMail" name="testform" method="post">


<div class="entry" style="margin-bottom:11px; margin-top:50px;">
        	<div class="top"></div>
            <div class="content">
            	<div class="hand-in">
                	<div class="email-st">
                    <label>Select Classroom:</label>
                   <select id="classroom" name="classroom" class="dropdown" onchange="document.testform.submit();">
					 <option value=""> SELECT CLASSROOM </option>
					<?php foreach($allclassroom as $classroom) { ?>
					<option value="<?php echo $classroom->getId(); ?>" 
						<?php if(isset($_POST['classroom'])) :
						
								if($_POST['classroom']==$classroom->getId()) : ?> 
					
									selected="selected" 
						<?php 	endif;
						
							  endif;
						 ?> >
						
						<?php echo $classroom->getFullName(); ?></option>
					<?php } ?>
					</select>

                    <label style="margin-top: 15px;">Select students :</label>
                   <select id="user[]" name="user[]" class="dropdown" multiple="multiple">
					<option value=""> SELECT MULTIPLE STUDENTS</option>
					<?php foreach($allstudents as $student) { ?>
						<option value="<?php echo $student->getId(); ?>" ><?php echo $student->getName(); ?></option>
					<?php } ?>
					</select>
			
                    </div>
                </div>
            </div>
            <div class="bottom"></div>
        </div>
		
		
		 <div class="entry">
        	<div class="top"></div>
            <div class="content">
            	<div class="hand-in">
                	<div class="email-st">
                    <label>Subject:</label>
                    <?php echo input_tag('subject','',array('size'=>90,)); ?>
                    <label style="margin-top: 15px;">Message:</label>
                    <?php // echo textarea_tag('bodycontent','', array ('size' => '60x2','rich' => true, 'tinymce_options' => 'width:590'));
					
					echo textarea_tag('bodycontent','', array('size' => '54x40', 'rich' => 'fck'));
					
					
					 ?>
					 <br />
                    
					<?php echo submit_tag('Send','classmanager/writeMail', array('class' => 'blue')); ?>
					</div>
                </div>

            </div>
            <div class="bottom"></div>
            <div class="clear-both"></div>
        </div>

</form>

</div><!-- end of body-main -->