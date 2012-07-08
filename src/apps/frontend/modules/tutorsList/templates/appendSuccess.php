<?php
    $counter = 1;
    /* @var $user User */
    foreach($users as $user) {
?>

<div id="resultpage">
  <div class="cn-result">
    <div  class="cn-column-one" style="padding-right:15px;width:500px;">
      <p class="cn-title">
      <div class="cn-user-info" style="float:right;width:150px;line-height:14px" align="right"><strong style="color:#069"></strong>
        <?php if ($user->isOnline()) { ?>
        <a href="/tutor/<?php echo $user->getUsername()?>" target="_blank" style="color:#8FAFC8"><?php echo $user->getName()?> <span class="onlinenow">(online)</span></a>
        <?php } else { ?>
        <a href="/tutor/<?php echo $user->getUsername()?>" target="_blank" style="color:#8FAFC8"><?php echo $user->getName()?> <span class="offlinenow">(offline)</span></a>
        <?php } ?>
      </div>
      <div style="float:left;height:50px;line-height:20px;width:50px;border-right:1px solid #CFD0D2;" align="center"><strong>#<?php echo $counter++; ?></strong></div>
      <div style="padding-left:60px;"> <u><a href="javascript:void(0);" title="Click to Select"><?php echo $user->getName(); ?></a></u></div>
      </p>
    </div>
    <div class="cn-column-two" align="center">
      <p class="cn-expertscore" style="font-size:13px;color:#333"><?php echo $user->getRate(); ?> RP</p>
    </div>
    <div class="cn-column-four">
      <p class="cn-pricepermin" align="center" style="margin-top:10px">
<?php
        if ($user->isOnline()) {
            if ($user->isWBSessionActive()) {
?>
        <a href="/message/compose/<?php echo $user->getUsername(); ?>"><img alt="in session" src="<?php echo image_path('em-busy.jpg', false); ?>"></a>
<?php
            } else {
?>
        <input type="checkbox" name="checkbox[]" value="<?php echo $user->getId(); ?>" onclick="setvalue(this.id)" style="background-color:#DEF3FE;border:1px solid red;" />
<?php
            }
        } else {
?>
        <a href="/message/compose/<?php echo $user->getUsername(); ?>"><img height="18" width="59" alt="" src="<?php echo image_path('em-email.jpg', false); ?>"></a>
        <?php } ?>
    </div>
    <div> </div>
    <div class="clear-both"></div>
  </div>
<?php
    }
?>
</div>

<div style="width:100%;font-size:20px;line-height:35px;" align="right">
  <div id="bottomMoreButton"> <img src="<?php echo image_path('ajax-loader.gif', false); ?>" style="display:none" class="spinner" /> <a id="more_<?php echo @$next_records?>" class="more_records" name="2" href="javascript: void(0)">show more listings</a> </div>
</div>
