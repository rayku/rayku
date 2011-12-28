<?php
  $raykuUser = $sf_user->getRaykuUser();
  $assignments = $raykuUser->getAssignmentsForDashboard();
  $i = 1;
  $iAssignmentCount = count( $assignments );

  if( $iAssignmentCount > 0 )
  {
    ?>

<div style="margin-top: 10px;" class="right-bg">
<div class="right-top"></div>
<div style="padding-bottom: 0px;" class="right-inside">
  <h3 style="margin-bottom: 15px;">Classroom assignments:</h3>
</div>
<?php
    foreach( $assignments as $assignment )
    {
      $sClass = '';
      $todayData = time();
      $dueData = strtotime( $assignment->getDueDate() );

      $submissions = $assignment->getSubmissions();

      if( count($submissions) > 0 )
        $submissionPosted = true;
      else
        $submissionPosted = false;

      if( $submissionPosted )
      {
        $sClass .= ' expired';
        $sDeadline = 'submitted';
      }
      else if( $todayData > $dueData )
      {
        $sClass .= ' expired not_submitted';
        $sDeadline = 'not submitted';
      }
      else
        $sDeadline = 'Due on <span>'.$assignment->getDueDate('d/m/Y').'</span>';

      if( $iAssignmentCount == $i )
        $sClass .= ' last';
      else
        $sClass .= ' alternate';

      echo "<div class='assignment-item $sClass'>";
      echo "<div class='num-item'>$i</div>";
      echo '<p>';
      echo link_to($assignment->getTitle(),'assignment/show?id='.$assignment->getId());
      echo '</p>';
      echo "<div class='deadline'>$sDeadline</div>";
      echo '<div class="clear-both"></div>';
      echo '</div>';
      $i++;
    }
    echo '</div>';
  }
?>
