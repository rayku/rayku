<link rel="stylesheet" type="text/css" href="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/styles/classroom.css" />

<div class="body-main">

  <div class="title" style="float:left; margin-left:20px; margin-top:20px;">
          <img src="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/images/newspaper.gif" alt="" />
          <p>Email to Teachers</p>
  </div>

  <div class="spacer"></div>

  <form action="writeMail" name="testform" method="post">

    <div class="entry" style="margin-bottom:11px; margin-top:80px;">
      <div class="top"></div>
      <div class="content">
        <div class="hand-in">
          <div class="email-st">
            <label>Select Classroom:</label>
            <select id="classroom" name="classroom" class="dropdown" onchange="document.testform.submit();">
              <option value="">SELECT CLASSROOM</option>
              <?php
                foreach($allclassroom as $classroom)
                {
                  echo '<option value="'.$classroom->getId().'" '.( $sf_request->getParameter('classroom')  == $classroom->getId() ? 'selected="selected"' : '' ) .' >';
                    echo $classroom->getFullName();
                  echo '</option>';
                }
              ?>
            </select>

            <label style="margin-top: 15px;">Select teacher:</label>
            <select id="teacher" class="dropdown" name="teacher" >
              <option value="">SELECT TEACHER</option>
              <?php if( isset( $user ) ) { ?>
                <option value="<?php  echo $user->getId(); ?>" ><?php echo $user->getName(); ?></option>
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
            <?php echo input_tag('subject', $sf_request->getParameter('subject'),array( 'size'=>90 ) ); ?>
            <label style="margin-top: 15px;">Message:</label>
            <?php //echo textarea_tag('bodycontent', $sf_request->getParameter('bodycontent'), array ('size' => '60x2','rich' => true,'tinymce_options' => 'width:590' ));
			
				echo textarea_tag('bodycontent', $sf_request->getParameter('bodycontent'),array('size' => '54x40', 'rich' => 'fck'));
			 ?>

            <label style="margin-bottom:30px; margin-top:15px;">
              <?php echo submit_tag('Send',array('class' => 'blue')); ?>
            </label>
          </div>
        </div>

      </div>
      <div class="bottom"></div>

      <div class="clear-both"></div>
    </div><!-- end of entry -->



  </form>

</div><!-- end of body-main -->
