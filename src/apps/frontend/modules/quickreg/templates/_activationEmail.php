<p>Hi <?php echo $user->getName(); ?>
<br /><br />
Congrats! You are almost ready to start using rayku.com!<br /><br />
As a final step, please confirm your email by clicking on the link below:<br/><br/>
<a href="<?php echo sfConfig::get('app_rayku_url') ?>/register/confirm/<?php echo $confirmationCode; ?>/temp"><?php echo sfConfig::get('app_rayku_url') ?>/register/confirm/<?php echo $confirmationCode; ?>/temp</a><br /><br />
Thanks!<br />
Rayku Administration</p>
