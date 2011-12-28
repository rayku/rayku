Title:<?php echo $sf_request->getParameter('title'); ?>
Description:<?php echo str_replace('&nbsp;', '', strip_tags( $sf_request->getParameter('description'))); ?>
Regards, <?php echo $sf_user->getRaykuUser()->getName(); ?>