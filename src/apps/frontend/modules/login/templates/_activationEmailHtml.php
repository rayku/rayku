<p>Hi <?php echo $user->getName(); ?><br /><br />
You are almost ready to start using rayku.com! All that is left is for you to confirm your email address.<br />
To do that, simply go to the link below.<br />
<a href="<?php echo $activationLink; ?>"><?php echo $activationLink; ?></a><br /><br /></p>
<?php include_partial( 'global/emailFooterHtml' ); ?>
