<link rel="stylesheet" type="text/css" href="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/css/global.css" />
<?php
  $raykuUser = $sf_user->getRaykuUser();

?>

<link rel="stylesheet" type="text/css" href="/css/custom/button.css"/>
<div id="body" style="padding-top:10px">
<div class="body-left" style="margin-top:30px;">
<div class="quick-help" style="background:url(../images/body-left-quickhelp-bg2.png);margin-bottom:25px">
  <div class="top" style="background-image:url(../images/body-left-quickhelp-top2.png)">
    <div class="bot" style="background-image:url(../images/body-left-quickhelp-bot2.png)">
<?php if($_SESSION['reason']):  ?>
  <div style="font-size:14px;color:red;border-top:1px solid #F2250E;background:#F9DED9;padding:6px;width:500px;margin:0 auto;line-height:18px" align="center">
    <strong>Fill the Reason Return Money Back...</strong>
  </div>
<?php unset($_SESSION['reason']); ?>
<?php endif; ?>
      <form action="moneystore" method="post" name="moneybackfrm">
        <div class="left" style="width:600px"><div style="margin:10px 0 7px 4px;">Ask Your Money Back:</div>
          <textarea class="textarea" onblur="if(this.value=='') this.value='Reason For Asking Money Back...';" onfocus="if(this.value=='Reason For Asking Money Back...') this.value='';" name="reason" rows="20" cols="20">Reason For Asking Money Back...</textarea>

       </div>
        <div style="float:left;width:250px;">

        </div>
        <div style="float:right;width:200px;margin:20px 10px 0 0;" align="right">
          <input type="submit" name="submit" value="Submit" class="myButton">
        </div>
      </form>
      <div class="clear-both"></div>
    </div>
  </div>
</div>
</div>
</div>


