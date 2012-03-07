<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php include_http_metas() ?>
	<?php include_metas() ?>
	<?php include_title() ?>
  <style type="text/css">
    @import "/styles/cs_global.css";
    @import "/styles/classroom.css";
  </style>
</head>

<!-- PRELOAD -->
<input type="hidden" style="background:url(images/classroom_acbg.gif)" />

<body>
<div id="top">
	<div id="logo">
  <?php
    $raykuUser = $sf_user->getRaykuUser();
    if( !$raykuUser )
    {
      echo link_to( image_tag( 'classroom_logo.jpg' ), "http://$_SERVER[HTTP_HOST]/" );
    }
    else if( $raykuUser->getType() == 2 )
    {
      echo link_to( image_tag( 'classroom_logo.jpg' ), 'classmanager/index' );
    }
  ?>
	</div>

  <?php
  $classroom = RaykuCommon::getCurrentClassroom( $sf_user );


  if( is_object( $classroom ) )
  {
    if($classroom)
    {
      if($classroom->getClassroomBanner() != "")
      {
        echo '<div id="classname">';
        echo image_tag( '/bannergenerator/stored/'.$classroom->getClassroomBanner(), array( 'border' => 0, 'width' => '728', 'height' => '92', 'alt' => '' ) );
        echo '  </div>';
      }
      else
      {
        echo '<div id="classname"  style="margin-top:24px;margin-right:auto;margin-bottom:auto;margin-left:27px;">';
        echo $classroom->getFullname();
        echo '  </div>';
      }
    }
  }
  ?>
</div>

<div id="main">
	<div id="nav">
    <?php if( $classroom ) include_partial('classroom/sidebar', array( 'classroom' => $classroom ) ); ?>
  </div>
  <div id="nblog">
    <?php  include_partial('global/messages') ?>
    <?php echo $sf_content ?>
  </div>
  <div class="spacer"></div>
</div><!-- enf of main -->

<div id="footer" style="background:none;">
  <div id="links">
    Copyright 2009 Rayku.com. All rights reserved.
    <br />
    Rayku is a subsidary of Kinkarso Tech, LLC.

    <div class="spacer"></div>
    <a href="#">legal</a>
    <a href="#">privacy</a>
    <a href="#">contact us</a>
  </div>
  <div id="partners">
    <?php
      echo image_tag( 'img-footer-logo-1.png' );
      echo image_tag( 'img-footer-logo-2.png' );
    ?>
  </div>
</div>

</body>
</html>