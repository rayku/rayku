<?php
$costPerMinute=40;

RaykuCommon::getDatabaseConnection();

			$query = mysql_query("select * from user where id=".$userId." ") or die(mysql_error());
			$detailPoints = mysql_fetch_assoc($query);

	if(!empty($_POST)) :


			$item = $_POST['item'];

			$_show_value = "$".($item/100).".00";
			$_final_points = $detailPoints['points'] + $item;
			$_minutes = intval($_final_points / $costPerMinute);
	

	else :

			$item = 500;

			$_final_points = $detailPoints['points'] + 500;
			$_minutes = $_final_points / $costPerMinute;
			$_minutes = intval($_minutes);
	
			$_show_value = "$5.00";

	endif;



?>


<link rel="stylesheet" type="text/css" media="screen" href="/styles/global.css" />

<div class="body-main" style="margin-bottom:40px">
  <div id="what-is">
    <div style="width:30px; float:left;"> <img src="<?php echo image_path('green_arrow.jpg', false); ?>" width="42" height="25" alt="" /> </div>
    <p style="font-size:16px; color:#1c517c; font-weight:bold; margin-left:45px;">Purchase Rayku Points</p>
  </div>
  <div id="shop_left">
    <div id="shop_cart">
      <div class="box">
        <div class="t">
          <div class="b">
            <div class="cont">
              <div class="obj" style="font-size:14px;color:#444;line-height:20px;">

              <div class="raykupoints" align="center">
              YOUR RAYKU POINTS<br>
              <span><?php echo $detailPoints['points']; ?></span></div>

<input type="hidden" id="_hidden" name="_hidden" value="<?php echo $detailPoints['points']; ?>" />

              <div class="rpcontent">
              <p>Rayku Points are tutoring credits that you can use on the site to pay for premium live tutoring sessions.</p>
              </div>
              <div style="clear:both"></div>


                <div class="rpdivider"></div>

                <?php
                $query = mysql_query("Select * from points_paypal") or die(mysql_error());
                $i = 0;

                ?>
                <form name="form1" id="form1" method="post">
                <h1 id="buyrp">Buy <select name="item"  id="item" onchange="this.form.submit();" style="font-size:18px;">
                  <?php
            while($row = mysql_fetch_assoc($query)) { ?>
                  <option value="<?php echo $row['points'];?>" <?php if($item == $row['points']): ?> selected="selected" <?php endif; ?>>
                  <?=$row['title'];?>
                  </option>
                <?php } ?>
                </select> 
                Rayku Points for <span id="value" style="color:#060;font-weight:bold"><?php echo $_show_value; ?></span></h1>
                <span style="color:#666">This will give you a total of</span> <span id="final_points" style="color:#666"><?php echo $_final_points;?>RP</span><span style="color:#666">, which can account for</span> <span id="minutes" style="color:#666"><?php echo $_minutes; ?></span> <span style="color:#666"> minutes* of premium tutoring.</span>


              </form>
              </div>

              <?php 

              if(!empty($item)) :

              $queryOne = mysql_query("Select * from points_paypal where points=".$item) or die(mysql_error());

              $rowOne = mysql_fetch_assoc($queryOne);
              
              ?>
              
              <div class="ch">
                <div class="obj">
                  <h1>Item</h1>
                </div>
                <div class="price">
                  <h1>Price</h1>
                </div>
                <div class="clear"></div>
                <div class="sep"></div>
                <div class="obj"><?php echo $rowOne['title']; ?> Rayku Points (RP)</div>
                <div class="price">$<?php echo $rowOne['price']; ?>.00</div>
                <div class="clear"></div>
                <?php $tot_price = $rowOne['price'] + $rowOne['shipping_charge_per_unit']; ?>
                <?php $tot_item_price = $rowOne['price'] ?>
                <div class="sep"></div>
                <div class="f"><img src="../images/securepayment.jpg" title="Secure Payment via PayPal"></div>
                <div align="center">
                  <form name="paypal" id="paypal" method="post" action="<?php echo sfConfig::get('app_rayku_url') ?>/paypal.php" >
                    <input type="hidden" name="loginid" id="loginid" value="<?php echo $user->getId(); ?>">
                    <input type="hidden" name="amount" id="amount" value="<?php echo $tot_price; ?>">
                    <input type="hidden" name="quantity" id="quantity" value="1">
                    <input type="hidden" name="points" id="points" value="<?php echo $rowOne['points']; ?>">
                    <input type="hidden" name="pack" id="pack" value="<?php echo $rowOne['title']; ?>">
                    <div align="right"><input type="submit" class="myButton" value="Purchase Now" name="submit"/></div>
                  </form>
                </div>
                <div class="clear"></div>
              </div>
              <!--ch-->
              
              
              
              
              
              <?php endif; ?>
              <div class="rpnote">*estimate is provided assuming an average tutoring rate of <?php echo $costPerMinute;?>RP/minute.</div>

            </div>
              
              
          </div>
          <!--b--> 
        </div>
        <!--t-->
      </div>
      <!--end of box--> 
    </div>
  </div>
  <?php if ($detailPoints['points'] < '500'): ?>
  <p style="font-size:14px;color:#666;">You need to accumulate at least 500RP in order to request a cash out</p>
  <?php else: ?>
  <p style="font-size:14px;color:#666;">You may cash out <?php echo $detailPoints['points']; ?>RP for <strong>$<?php echo ($detailPoints['points'])/100; ?></strong></p><br />
  <input type="submit" class="myButton" value="Cash Out" name="submit" onClick="window.location.href='mailto:cs@mail.rayku.com?subject=Cash Out <?php echo $detailPoints['points']; ?> from userID<?php echo $user->getId(); ?>'"/>
  <?php endif; ?>
</div>
<div id="shop_right">  
  <div class="text">
  <h2 style="font-size:16px;line-height:20px;border-bottom:1px solid #CCC;color:#666;font-weight:bold;margin-top:10px;">Why?  </h2>
  <p style="margin-top:20px;">Full-length, on-demand sessions with the top-rated Rayku tutors.</p>
  <p style="margin-top:20px;">Premium sessions are charged by-the-minute. Only pay for what you use. </p>
  <p style="margin-top:20px;">Rayku Points do not expire. They are yours to keep and use forever!</p>
  </div>
</div>
<!--shop_right--> 

<script type="text/javascript">
  var ray_jq = jQuery.noConflict();
  ray_jq(document).ready(function()
  {

 
		
	
		ray_jq('#item').change(function() {
			var str = ""; var rayku_points = ""; var final_points = "";  var minutes = ""; var str1="";
			str = parseInt(ray_jq("#item").val()/100);
            str1=parseInt(ray_jq("#item").val());
			rayku_points = parseFloat(ray_jq("#_hidden").val());

			final_points = str1 + rayku_points;
		
			minutes = parseInt(final_points / $costPerMinute);

			str = "$"+str+".00";
			ray_jq("#value").text(str);

		         ray_jq("#final_points").text(final_points+"RP");

			 ray_jq("#minutes").text(minutes);

		});
	



  });

</script>
