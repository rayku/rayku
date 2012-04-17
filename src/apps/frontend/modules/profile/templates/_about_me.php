<?php $raykuUser = $sf_user->getRaykuUser(); ?>
<div class="about">
  <h4 style="font-size:14px;">About <strong><?php echo $user ?></strong> <?php if ($sf_user->isAuthenticated() && $user->equals($raykuUser)): ?>(<a href="http://www.rayku.com/register/step3" style="font-size:14px">edit</a>)<?php endif ?></h4>
  <div class="about-row">
    <div class="about-row-label">
      Name:
    </div>
    <div class="about-row-content">
      <?php echo $user->getName() ?>
    </div>
  </div>
    <div class="about-row">
    <div class="about-row-label">
      Rayku Points:
    </div>
    <div class="about-row-content">
      <?php $logedUserId = $user->getID();
		$query = mysql_query("select * from user where id=".$logedUserId." ") or die(mysql_error());
		$detailPoints = mysql_fetch_assoc($query);
		echo $detailPoints['points']; ?>RP
    </div>
  </div>
  <div style="height:20px"></div>
  <?php if($sf_user->isAuthenticated()): ?>
    <?php if ($user->getShowGender() && UserPeer::getGenderFromIndex($user->getGender()) != ''): ?>
    <div class="about-row">
      <div class="about-row-label">
        Gender:
      </div>
      <div class="about-row-content">
        <?php echo ucfirst(UserPeer::getGenderFromIndex($user->getGender())) ?>
      </div>
    </div>
    <?php endif ?>
    <?php if ($user->getShowBirthdate() && $user->hasValidBirthDate()): ?>
    <div class="about-row">
      <div class="about-row-label">
        Birthday:
      </div>
      <div class="about-row-content">
        <?php echo date(sfConfig::get('app_general_date_format'), strtotime($user->getBirthdate())) ?>
      </div>
    </div>
    <?php endif; ?>
    <?php if ($user->getShowHometown() && $user->getHometown() != ''): ?>
    <div class="about-row">
      <div class="about-row-label">
        HomeTown:
      </div>
      <div class="about-row-content">
        <?php echo $user->getHometown() ?>
      </div>
    </div>
    <?php endif ?>
    <?php if ($user->getShowHomePhone() && $user->getHomePhone() != ''): ?>
    <div class="about-row">
      <div class="about-row-label">
        Home Phone:
      </div>
      <div class="about-row-content">
        <?php echo $user->getHomePhone() ?>
      </div>
    </div>
    <?php endif; ?>
    <?php if ($user->getShowMobilePhone() && $user->getMobilePhone() != ''): ?>
    <div class="about-row">
      <div class="about-row-label">
        Mobile Phone:
      </div>
      <div class="about-row-content">
        <?php echo $user->getMobilePhone() ?>
      </div>
    </div>
    <?php endif; ?>
    <?php if ($user->getShowAddress() && $user->getAddress() != ''): ?>
    <div class="about-row">
      <div class="about-row-label">
        Address:
      </div>
      <div class="about-row-content">
        <?php echo $user->getAddress() ?>
      </div>
    </div>
    <?php endif; ?>

    <?php if ($user->getShowRelationshipStatus() && $user->getRelationshipStatus() != 0): ?>
    <div class="about-row"> 
      <div class="about-row-label">
        Relationship:
      </div>
      <div class="about-row-content">
       <?php echo ucfirst(UserPeer::getRelationshipStatusFromIndex($user->getRelationshipStatus())) ?>
      </div>
    </div>
    <?php endif; ?>
    <?php if ($user->hasAboutMe()): ?>
    <div class="spacer-row">&nbsp;</div>
    <div class="about-row about-me">
      <div class="about-row-label">
        About Me:
      </div>
      <div class="about-row-content">
        <?php echo $user->getAboutMe() ?>
      </div>
    </div>
    <?php endif; ?>
  <?php endif; ?>
  <br class="clear-both" />
</div>
