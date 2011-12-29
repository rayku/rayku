<?php

if(!empty($_POST)) :

$item = $_POST['item'];

endif;

?>
<link rel="stylesheet" type="text/css" media="screen" href="/styles/global.css" />

<div class="body-main">
  <div id="what-is">
    <div style="width:30px; float:left;"> <img src="/images/green_arrow.jpg" width="42" height="25" alt="" /> </div>
    <p style="font-size:16px; color:#1c517c; font-weight:bold; margin-left:45px;">Purchase Rayku Points (RP)</p>
  </div>
  <div id="shop_left">
    <div id="shop_cart">
      <div class="box">
        <div class="t">
          <div class="b">
            <div class="cont">
              <div class="obj" style="font-size:14px;color:#444;line-height:20px;">
                <p>Rayku Points are credits that you can use on Rayku to pay for live question sessions.</p>
                <p>&nbsp;</p>
                <?php

		$connection = RaykuCommon::getDatabaseConnection();

$query = mysql_query("Select * from points_paypal", $connection) or die(mysql_error());

$i = 0; ?>
                <form name="form1" id="form1" method="post">
                <h1 style="font-weight:normal;font-size:20px;color:#444">Buy <select name="item" onchange="this.form.submit();" style="font-size:18px;width:45px">
                  <option value="">--</option>
                  <?php
            while($row = mysql_fetch_assoc($query)) { ?>
                  <option value="<?php echo $row['id'];?>" <?php if($item == $row['id']): ?> selected="selected" <?php endif; ?> >
                  <?=$row['title'];?>
                  </option>
                <?php } ?>
                </select> Rayku Points for <span style="color:#060"><strong>$--.00</strong>(CAD)</span>
                </h1>
                <span style="color:#999">This will give you a total of 35.67RP, which can account for 43 minutes* of premium tutoring.</span>
              </form>
              </div>
              <img src="/images/paypal.png" style="margin-bottom:10px;" />
              <?php

if(!empty($item)) :

$queryOne = mysql_query("Select * from points_paypal where id=".$item, $connection) or die(mysql_error());

$rowOne = mysql_fetch_assoc($queryOne);


 ?>
              <div class="ch">
                <div class="obj">
                  <h1>Item</h1>
                </div>
                <div class="price">
                  <h1>Price</h1>
                </div>
                <div class="qtty">
                  <h1>Quantity</h1>
                </div>
                <div class="clear"></div>
                <div class="sep"></div>
                <div class="obj"><?php echo $rowOne['title']; ?> Rayku Points (RP)</div>
                <div class="price">$<?php echo $rowOne['price']; ?>.00 <strong>CAD</strong></div>
                <div class="qtty wr">1</div>
                <div class="clear"></div>
                <?php $tot_price = $rowOne['price'] + $rowOne['shipping_charge_per_unit']; ?>
                <?php $tot_item_price = $rowOne['price'] ?>
                <div class="sep" style="margin-bottom:20px"></div>
                <div class="f"><span>Total Cost:</span> <span style="color:#000">$<?php echo $tot_price; ?>.00 <strong>CAD</strong></span> </div>
                <div align="center">
                <form name="paypal" id="paypal" method="post" action="http://<?php echo RaykuCommon::getCurrentHttpDomain(); ?>/paypal.php" >
                    <input type="hidden" name="loginid" id="loginid" value="<?php echo $user->getId(); ?>">
                    <input type="hidden" name="amount" id="amount" value="<?php echo $tot_price; ?>">
                    <input type="hidden" name="quantity" id="quantity" value="1">
                    <input type="hidden" name="points" id="points" value="<?php echo $rowOne['points']; ?>">
                    <input type="hidden" name="pack" id="pack" value="<?php echo $rowOne['title']; ?>">
                    <input type="submit" value="Buy Now" name="submit" style="font-size:14px;padding:4px;"/>
                  </form>
                </div>
                <div class="clear"></div>
              </div>
              <!--ch-->

              <?php endif; ?>
            </div>
            <!--cont-->
          </div>
          <!--b-->
        </div>
        <!--t-->

      </div>
      <!--end of box-->
    </div>
  </div>
</div>
<div id="shop_right">
  <div class="header"> <a href="/shop/index">Shop Homepage</a> </div>
  <!--cart-->

  <div class="text">Thank you for your interest. Go ahead and fill out the forms on your left. Once you are ready, click on the 'Submit' button. You may <a href="mailto:support@rayku.com" class="link">email us</a> if you have any problems.<br />
    <br />
  </div>
</div>
<!--shop_right-->

