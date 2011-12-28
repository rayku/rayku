<?php
  $raykuUser = $sf_user->getRaykuUser();
  $lastQuestions = $raykuUser->getLastQuestionsForDashboard();
  $i = 1;
  $lastQuestionsCount = count( $lastQuestions );

  if( $lastQuestionsCount > 0 )
  {
    ?>

<div style="margin-top:10px;" class="right-bg">
  <div class="right-top"></div>
  <div style="padding-bottom: 0px;" class="right-inside">
    <h3 style="margin-bottom: 15px;color:#069">Question Board Listings</h3>
  </div>
  <?php
    
    foreach( $lastQuestions as $lastQuestion )
    {
		
      $class = '';

      if( $i%2 == 0 )
        $class = 'widep alternate';

      if( $i == $lastQuestionsCount )
        $class = ' last';

      ?>
  <div class="assignment-item <?php echo $class; ?>">
    <div class="num-item" style="height:16px;width:16px"></div>
    <p style="width:220px;padding:4px 0;"><?php echo link_to( $lastQuestion->getTitle(), '@view_thread?thread_id=' . $lastQuestion->getId()); ?></p>
    <div class="clear-both"></div>
  </div>
  <?php
      $i++;
    }
    ?>
</div>
<?php
  }
?>
