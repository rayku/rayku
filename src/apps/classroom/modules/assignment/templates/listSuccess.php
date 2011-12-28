<div class="title" style="float:left">
  <?php echo image_tag( 'newspaper.gif' ); ?>
	<p>Assignments</p>
</div>

<div class="spacer" style=" margin-bottom:10px;"></div>
<?php
  /* @var $assignment Assignment */

  $raykuUser = $sf_user->getRaykuUser();

  if( $raykuUser->getType() == UserPeer::getTypeFromValue('teacher') )
    echo link_to( '<span>Create</span>', 'assignment/create', array( 'class' => 'blue left-btn_30' ) );

  echo '<div class="spacer" style="margin-top:70px;"></div>';

  foreach ($assignments as $assignment)
  {
?>
  
<div class="entry assignment" style="margin-bottom:11px;">
	<div class="top"></div>
	<div class="content">
		<div>
			<div class="titles">
				<?php echo link_to($assignment->getTitle(),'assignment/show?id='.$assignment->getId(),
				array('class'=>'title02')); ?>
			</div>

			<div style="float: right;">
				<div class="format">Format: <strong><?php echo $assignment->getFormat() ?></strong></div>
				<div class="date-due">Due: <strong><?php echo $assignment->getDueDate() ?></strong></div>
			</div>
			<div class="clear-both"></div>
		</div>

		<div class="paragraph" style="margin:0;">
			<div id="bordersplitter"></div>
			<div class="text" style="border-bottom:0;">
			<?php echo substr($assignment->getDescription(),0,100); ?>
			<div style="margin-top:10px;">
        <?php
          if( $raykuUser->getType() == UserPeer::getTypeFromValue('teacher') )
          {
            $submissionsCount = $assignment->countSubmissions();
					  echo link_to(
                    "View $submissionsCount submitted assignments",
                    'submission/list?assignmentid=' . $assignment->getId());
          }
          else if( $raykuUser->getType() == UserPeer::getTypeFromValue('user') )
          {
            $userSubmission = $assignment->getSubmissionOf( $raykuUser );

            if( $userSubmission )
            {
              echo link_to(
                      "Show My submission",
                      'submission/show?id=' . $userSubmission->getId() );

            }
            else
            {
              echo link_to(
                      "Post My submission",
                      'submission/create?assignmentid=' . $assignment->getId());
            }
          }

        ?>
			</div>
			<div class="clear-both"></div>
			</div>
		</div>

	</div>
	<div class="bottom"></div>
</div>
<?php } ?>
