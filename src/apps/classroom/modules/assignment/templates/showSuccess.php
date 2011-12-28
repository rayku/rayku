<div class="title" style="float:left">
	<img src="../../../images/newspaper.gif" alt="" />
	<p>Assignment Description</p>
</div>

<div class="spacer"></div>

<div class="entry">
	<div class="top"></div>
	<div class="content">
		<div style="border:1px solid #fff">
			<div class="titles" style="margin:0;">
				<a href="#" class="title02" style="float:left;"><?php echo $assignment->getTitle() ?></a>
			</div>

			<div style="float: right; font-size: 12px;">
				<div class="format" style="display: inline;">Format: <strong><?php echo $assignment->getFormat() ?></strong></div>
				<div class="date-due" style="display: inline; padding-left: 15px;">Due: <strong><?php echo $assignment->getDueDate() ?></strong></div>
			</div>
			<div class="clear-both"></div>
		</div>

		<div class="paragraph" style="margin:0;">
			<div id="bordersplitter"></div>
			<div class="text" style="border-bottom:0;">
			<?php echo $assignment->getDescription() ?>
			</div>	
			
		</div>			
		
		<div id="bordersplitter"></div>
		
		
			<div class="title" style="margin:20px 0px 9px 4px">
				<img src="../../../images/classroom_attach.gif" alt="" />
				<p style="font-size:15px">Attachments</p>
			</div>
					
			
			
			<div class="attachment" style="margin-bottom:auto; margin-left:50px;">
			
			
				<?php if($assignment->getAttachments() == NULL) : ?> 
				
					<a href="" style="text-decoration:none;">No attachments</a>
					
				<?php else: ?>
				<img src="../../../images/icon_doc.gif" alt="" />
				<?php echo link_to($assignment->getAttachments(),'http://'.RaykuCommon::getCurrentHttpDomain().'/uploads/teachers_assignments/'.$assignment->getAttachments().'') ; ?>
				
				<?php endif; ?>
			</div>
			
			<div class="clear"></div>

	</div>
	<div class="bottom"></div>
</div>


<?php

  $raykuUser = $sf_user->getRaykuUser();
  if( $raykuUser->getType() == UserPeer::getTypeFromValue('teacher') )
  {
	  echo link_to('Back', 'assignment/list', array('class' => 'blue', 'style' => 'float:left; margin-right:10px; line-height: 35px;'));
	  echo link_to('Modify', 'assignment/edit?id='.$assignment->getId(), array('class' => 'blue', 'style' => 'float:left; margin-right:10px; line-height: 35px;'));
  }

  if($raykuUser->getType() == UserPeer::getTypeFromValue('user') )
  {
    $submission = $assignment->getSubmissionOf( $sf_user->getRaykuUser() );
	  if(!$submission)
    {
		  echo link_to(
              'Submit Assignment',
              'submission/create?assignmentid=' . $assignment->getId(),
              array('style' => 'font-size:14px;
                          color: #257000;
                          width:200px;
                          font-weight:bold;
                          float:left'));
    }
    else
    {
    ?>
      <div class="title" style="float:left">
        <p style="padding-left:0; margin-left:0;">Submitted Assignment</p>
      </div>

      <div class="spacer"></div>

      <div class="entry">
        <div class="top"></div>
        <div class="content">
          <div style="border:1px solid #fff">
            <div class="titles" style="margin:0;">
              <a href="#" class="title02" style="float:left;"><?php echo $assignment->getTitle() ?></a>
            </div>

            <div style="float: right; font-size: 12px;">
              <div class="format" style="display: inline;"></div>
              <div class="date-due" style="display: inline; padding-left: 15px;">Created At: <strong><?php echo $submission->getCreatedAt() ?></strong></div>
            </div>
            <div class="clear-both"></div>
          </div>

          <div class="paragraph">
                    <div class="head"></div>
                      <div class="text">
                        <?php echo $submission->getData();?>
                      </div>
                  </div>

          <?php if($submission->getPath() != NULL):?>
                  <div class="attachments">
                    <div class="title" style="margin:0px 0px 9px 4px">
                        <img src="../../../images/classroom_attach.gif" alt="" />
                        <p style="font-size:15px">Attachments</p>
                      </div>
                      <div class="attachment">
                        <img src="../../../images/icon_doc.gif" alt="" />
                          <?php echo link_to($submission->getPath(),'submission/download?id='.$submission->getId()); ?>
                      </div>
                  </div>
          <?php endif;?>
          <?php
            if( $submission->canBeEditedBy( $raykuUser ) )
              echo link_to('Edit', 'submission/edit?id='.$submission->getId(), array('class' => 'blue', 'style' => 'line-height: 38px;'));
          ?>
          <div class="clear-both"></div>

        </div>
        <div class="bottom"></div>
      </div>
<?php
    }
  }
  else if( $raykuUser->getType() == UserPeer::getTypeFromValue('teacher') )
  {
    echo '<div class="clear"></div>';
    echo '<div class="assignment"><div class="paragraph">';
    $submissionsCount = $assignment->countSubmissions();
    echo link_to(
            "View $submissionsCount submitted assignments",
            'submission/list?assignmentid=' . $assignment->getId());
    echo '</div></div>';
  }


