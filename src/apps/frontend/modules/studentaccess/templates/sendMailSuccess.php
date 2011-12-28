<link rel="stylesheet" type="text/css" href="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/styles/classroom.css" />

<div class="body-main">

  <div class="entry" style="margin-bottom:100px;">
    <div class="top" style="margin-top:100px;"></div>
    <div class="content">
      <div class="hand-in">
        <div class="email-st">
          <label>
            <?php if($classroom != NULL): ?>

              Mail sent successfully to the teacher "<?php echo $user->getName(); ?>",
              they will  accept your request to join to classroom
              "<?php echo $classroom->getFullName();?>".<br />
              Then you will become a member of this classroom.!
              
            <?php else: ?>
              You have successfully joined to expert <?php echo $user->getName(); ?> 's lesson '<?php echo $lesson->getTitle(); ?>'
            <?php endif; ?>
          </label>
          <label><?php echo link_to('Go back','studentmanager/index',array('class' => 'blue')); ?></label>
        </div><!-- end of email-st -->
      </div>
    </div>
    <div class="bottom"></div>
  </div><!-- end of entry -->

</div><!-- end of body-main -->
