Hey <?php echo $user->getName(); ?><br /><br />

Thanks for registering at Rayku! Please confirm your email address in order to activate your account.<br /><br />

To do that, simply go to the following link:<br />
<?php echo $activationLink; ?>

<?php include_partial( 'global/emailFooter' ); ?>