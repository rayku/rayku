Hello <?php echo $user->getName(); ?>

You are almost ready to start using rayku.com! All that is left is for you to confirm your email address.
To do that, simply to go the link below.
<?php echo $activationLink; ?>

<?php include_partial( 'global/emailFooter' ); ?>