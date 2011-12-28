<?php use_helper('Javascript'); ?>
<?php use_helper('Text'); ?>

<div class="body-main">
  <div id="what-is">
    <div style="width:30px; float:left;">
      <img src="/images/green_arrow.jpg" width="42" height="25" alt="" />
    </div>
    <p style="font-size:16px; color:#1c517c; font-weight:bold; margin-left:55px;">
      Student Classroom Manager
    </p>
  </div>

  <div class="clrm">
    <div class="clrm-top"></div>
    <div class="content">
      <h3>Teachers Classrooms:</h3>
      <?php
	  	if($lessons != NULL):
        foreach($classrooms as $classroom)
        {
          echo '<div class="class">';
            echo '<div class="title">';
              echo link_to($classroom->getFullname(),'classroom/index?id='.$classroom->getId());
            echo '</div>';
            echo '<div class="settings"></div>';
            echo '<div class="clear-both"></div>';
          echo '</div>';
        }
      ?>
      <?php else: ?>
        <div class="class">
          <div class="title">You have not joined any classrooms yet!</div>
          <div class="clear-both"></div>
        </div>
      <?php endif; ?>
    </div>
    <div class="clrm-bottom"></div>
  </div>
<!-- end of clrm -->


  <div class="left-bg" id="left-bg">
    <?php include_partial( 'recent' ); ?>
  </div>
  
  <?php
    echo link_to_remote( image_tag('view-more-activity.png'),
                         array( 'update' => 'left-bg',
                                'url'    => 'studentmanager/moreactivity',
                         ),
                         array( 'style'  => 'margin-bottom: 15px; display: block;')
    );
  ?>
</div><!-- end of body-main -->

<div class="body-side" style="margin-top:40px">
  <?php echo link_to('Join Teachers Classroom','studentaccess/join', array('class' => 'navlink add')); ?>
  <?php echo link_to ('Notifications', 'studentaccess/notifications?userid='.$sf_user->getRaykuUserId(), array('class' => 'navlink add')); ?>
  <?php echo link_to ('Send Email to teacher', 'studentaccess/writeMail', array('class' => 'navlink add')); ?>
  <?php echo link_to ('Search for classrooms', 'studentmanager/search', array('class' => 'navlink add')); ?>
</div>

<br class="clear-both" />
