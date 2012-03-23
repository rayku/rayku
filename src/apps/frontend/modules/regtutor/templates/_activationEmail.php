Hi <?php echo $user->getName(); ?>

You are almost ready to start using rayku.com! All that is left is for you to confirm your email address.<br />
To do that, simply go to the link below.<br />
<?php echo $activationLink; ?>

<?php include_partial( 'global/emailFooter' ); ?>