<html>
<head>
<link rel="stylesheet" type="text/css" href="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/css/global.css" />
<link rel="stylesheet" type="text/css" media="screen" href="/styles/ex_donny.css" />
<link rel="stylesheet" type="text/css" media="screen" href="/styles/ex_tabcontent.css" />
<link rel="stylesheet" type="text/css" media="screen" href="/styles/ex_global.css" />
<script src="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/js/register_popup/popup.js" type="text/javascript"></script>
</head>
<body>
<div class="body-main">
  <div id="what-is">
    <div style="width:30px;float:left;"> <img height="25" width="42" alt="" src="/images/green_arrow.jpg"/> </div>
    <p style="font-size:16px;color:rgb(28, 81, 124);font-weight:bold;margin-left:45px;"> Invite  Friends, Get RP</p>
  </div>
  <div class="left-bg">
    <div class="left-top"></div>
    <div class="send-gift import-email">
      <?php if($flag != 1): ?>
      <h3 class="invite-friends">Generate Invite Coupons <span style="font-weight:normal">(limited)</span></h3>
      <p style="line-height:20px; font-size:14px;margin-left:10px">When you invite your friends to join Rayku, you earn <strong>0.50RP (plus bonuses)</strong> for each person who registers with your coupon code. Your friend gets <strong>11.00RP</strong> for registering.</p>
      <form action="" method="post">
        <p align="center">
          <input type="submit" name="invitation" value="Generate Coupon Codes"  id="invitation" style="padding:5px;font-size:14px" />
        </p>
      </form>
      <?php else : 

		$date = date("Y-m-d");
                                $connection = RaykuCommon::getDatabaseConnection();
				$query = mysql_query("select * from referral_code where user_id=".$user->getId()." and date='".$date."' order by id DESC limit 0,5", $connection) or die(mysql_error());


?>
      <h3 class="invite-friends">Generated Coupon Codes</h3>
      <p style="line-height:20px; font-size:14px;margin-left:10px">All Coupon codes are <strong>one-use</strong> only. Please only give one to each friend. Coupon codes must be entered prior to registration, and may expire or change in value at any time.</p>
      <table align="center" style="margin-bottom:20px;">
        <?php

while($row = mysql_fetch_assoc($query)) { ?>
        <tr>
          <td><?php echo $row["referral_code"]; ?></td>
        </tr>
        <?php }  ?>
      </table>
      <?php endif; ?>
      <hr style="border:0;color:#C1C1C1;height:2px;margin:20px 0 30px 0;">
      
      <p style="line-height:20px;font-size:18px;margin-left:10px;font-weight:bold;color:#060"><a href="http://www.rayku.com/register/step4"><img src="http://www.rayku.com/images/email.png" style="float:right;padding-left:10px;" border="0"></a>Want to Make Things Easier?</p>
      
      <p style="line-height:20px;font-size:14px;margin-left:10px">Use the Rayku Email Invite tool to automatically send a coupon code to each of your email contacts that you select.<br>
        <br>
        It's easy. <a href="http://www.rayku.com/register/step4">Click here to take a look!</a></span></p>
    </div>
    <div class="left-bottom"></div>
  </div>
</div>
<div class="body-side">
  <div class="box">
    <div class="top" style="margin-top:43px;"></div>
    <div class="content" style="position:relative; _top:-3px; _bottom:-3px;">
      <div class="title" style="margin-top:0px; font-size:16px">Buy Rayku Points (RP)</div>
      <div class="text"><span style="line-height:20px; font-size:14px">You may purchase RP directly. The current conversion rate is as follows:<br>
        <br>
         <strong>1RP = C$1</strong> (One Canadian Dollar)<br><br>
        <a href="http://www.rayku.com/shop/paypal"><img src="http://www.rayku.com/images/paypalsmall.png" border="0"><br>
        Click here</a> for instant purchase options.</span></div>
    </div>
    <div class="bottom"></div>
  </div>
</div>
</body>
