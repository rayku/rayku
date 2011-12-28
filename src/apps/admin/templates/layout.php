<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php include_http_metas() ?>
	<?php include_metas() ?>
	<?php include_title() ?>
</head>
<body>
  <div id="wrapper" style="padding:20px;">
    <!-- Sidebar -->
    <?php
      if( $sf_user->isAuthenticated() )
        include_partial( 'global/menu' );
    ?>

		<div id="admin-main-content">
		  <?php echo $sf_content ?>
		</div>
    
    
	</div><!-- end of #admin-wrapper -->
</body>
</html>
