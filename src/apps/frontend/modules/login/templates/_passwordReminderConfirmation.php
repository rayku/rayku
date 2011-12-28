Hello <?php echo $name ?>,

Yourself or someone else has requested to change your password on Rayku.com. If you would like to reset your password, click on the link below and a newly generated password will be sent back to you!

<?php echo url_for('@reset_password?key=' . $key, true) ?>

<?php include_partial( 'global/emailFooter' ); ?>