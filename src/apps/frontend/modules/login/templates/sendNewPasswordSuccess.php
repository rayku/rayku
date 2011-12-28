Hello <?php echo $name ?>,

You have requested to reset your password on Rayku.com.

Your new password is as follows:
<?php echo $password ?>

You are encouraged to login immediately and change your password.

You may login using your new password by clicking on the following link:
<?php echo url_for('@login', true) ?>

<?php include_partial( 'global/emailFooter' ); ?>