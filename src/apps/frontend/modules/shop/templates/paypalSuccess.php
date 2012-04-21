<?php 

$connection = RaykuCommon::getDatabaseConnection();

			$query = mysql_query("select * from user where id=".$userId." ", $connection) or die(mysql_error());
			$detailPoints = mysql_fetch_assoc($query);

	if(!empty($_POST)) :


			$item = $_POST['item'];

			$_show_value = "$".$item.".00";
			$_final_points = $detailPoints['points'] + $item;
			$_minutes = intval($_final_points / 0.40);
	

	else :

			$item = 5;

			$_final_points = $detailPoints['points'] + 5;
			$_minutes = $_final_points / 0.40;
			$_minutes = intval($_minutes);
	
			$_show_value = "$5.00";

	endif;

?>

<link rel="stylesheet" type="text/css" media="screen" href="/styles/global.css" />

<div class="body-main">
  <div id="what-is">
    <div style="width:30px; float:left;"> <img src="/images/green_arrow.jpg" width="42" height="25" alt="" /> </div>
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
              YOU HAVE<br>
              <span><?php echo $detailPoints['points']; ?></span><br>
              RAYKU POINTS
              </div>

<input type="hidden" id="_hidden" name="_hidden" value="<?php echo $detailPoints['points']; ?>" />

              <div class="rpcontent">
              <h3>What are Rayku Points (RP)?</h3>
              <p>
              Rayku Points are credits that you can use on Rayku to pay for live question sessions. In the future, you'll be able to use them in a Rayku Shop to buy cool stuff (like an iPad!).</p>
              </div>
              <div style="clear:both"></div>


                <div class="rpdivider"></div>

                <?php
                $con = mysql_connect("localhost", "rayku", "rayku") or die(mysql_error());
                $db = mysql_select_db("rayku_db", $con) or die(mysql_error());

                $query = mysql_query("Select * from points_paypal", $connection) or die(mysql_error());
                $i = 0;
//
                ?>

                <form name="form1" id="form1" method="post">
                <h1 id="buyrp">Buy <select name="item"  id="item" onchange="this.form.submit();" style="font-size:18px;width:50px;">
                  <?php
            while($row = mysql_fetch_assoc($query)) { ?>
                  <option value="<?php echo $row['price'];?>" <?php if($item == $row['price']): ?> selected="selected" <?php endif; ?>>
                  <?=$row['title'];?>
                  </option>
                <?php } ?>
                </select> Rayku Points for <span id="value" style="color:#060;font-weight:bold"><?php echo $_show_value; ?></span>(CAD)
                </h1>
                <span style="color:#666">This will give you a total of</span> <span id="final_points" style="color:#666"><?php echo $_final_points;?>RP</span><span style="color:#666">, which can account for</span> <span id="minutes" style="color:#666"><?php echo $_minutes; ?></span> <span style="color:#666"> minutes* of premium tutoring.</span>


              </form>
              </div>

              <?php 

              if(!empty($item)) :

              $queryOne = mysql_query("Select * from points_paypal where price=".$item, $connection) or die(mysql_error());

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
                <div class="price">$<?php echo $rowOne['price']; ?>.00 <strong>CAD</strong></div>
                <div class="clear"></div>
                <?php $tot_price = $rowOne['price'] + $rowOne['shipping_charge_per_unit']; ?>
                <?php $tot_item_price = $rowOne['price'] ?>
                <div class="sep"></div>
                <div class="f"><img src="../images/securepayment.jpg" title="Secure Payment via PayPal"></div>
                <div align="center">
                  <form name="paypal" id="paypal" method="post" action="http://www.rayku.com/paypal.php" >
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
              <div class="rpnote">*estimate is provided assuming an average tutoring rate of 0.40RP/minute.</div>

            </div>
              
              <div class="rpdivider"></div>
              
              <div class="cont">
                  
                  <?php
                    if (!empty($cardNum)){
                        echo 'You have registered a card: xxxxxxxxxxxx-' . $cardNum;
                        ?>
                        
                         <?php echo $error; ?>
                        
                        <?php echo form_tag('shop/paypal', array('name' => 'pay_balance')) ?>
                            <?php echo submit_tag('', array('id' => 'pay_balance','name' => 'pay_balance', 'value'=>'Pay the balance')) ?>
                  
                        </form>
                        
                        
                        <?php
                    }else{
                        
                  ?>
                  
                        <br/>
                        <?php echo $error; ?>
                        <?php echo form_tag('shop/paypal', array('name' => 'submit_card')) ?>
                        <div class="top"></div>
                            <div class="content">
                            <div class="entry">
                                <div class="ttle">Enter your credit card info for automatic payment</div>

                                <div class="spacer"></div>
                            </div>
                            <div class="entry">
                                <div class="ttle">Cardholder Name:</div>
                                <div style="float:left">
                                
                                <?php echo input_tag('card_name', '', array('type' => 'card_name')) ?> </div>
                                <div style="font-weight:normal;color:#666;width:200px;margin-left:240px;"></div>
                                <div class="spacer"></div>
                            </div>
                                
                            <div class="entry">
                                <div class="ttle">Credit Card Number:</div>
                                <div style="float:left">
                                
                                <?php echo input_tag('credit_card', '', array('type' => 'credit_card')) ?> </div>
                                <div style="font-weight:normal;color:#666;width:200px;margin-left:240px;"></div>
                                <div class="spacer"></div>
                            </div>          

                            <div class="entry">
                                <div class="ttle">CVV:</div>
                                <div style="float:left">
                                
                                <?php echo input_tag('cvv', '', array('type' => 'cvv')) ?> </div>
                                <div style="font-weight:normal;color:#666;width:200px;margin-left:240px;"></div>
                                <div class="spacer"></div>
                            </div>       

                            <div class="entry">
                                <div class="ttle">Expiry Date:</div>
                                <div style="float:left">
                                   
                                    <?php echo input_tag('expiry_date', '', array('type' => 'expiry_date')) ?> </div>
                                <div style="font-weight:normal;color:#666;width:200px;margin-left:240px;">Format: mmyy</div>
                                <div class="spacer"></div>
                                </div>
                                </div>
                            <div class="bottom"></div>
                            <div class="spacer"></div>

                        <?php echo submit_tag('', array('id' => 'submit_card','name' => 'submit_card', 'value'=>'Submit')) ?>
                        </form>
                <?php } ?>
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
  
  <p style="font-size:14px;color:#666;">You may cash out <?php echo $detailPoints['points']; ?>RP for <strong>$<?php echo $detailPoints['points']; ?>CAD</strong></p><br />
  <input type="submit" class="myButton" value="Cash Out" name="submit"/>
</div>
<div id="shop_right">  
  <div class="text">
  <h2 style="font-size:16px;line-height:20px;border-bottom:1px solid #CCC;color:#666;font-weight:bold;margin-top:10px;">Terms</h2>
  <p style="margin-top:20px;">All purchases are final.</p>
  <p style="margin-top:20px;">Rayku Points do not expire. They are yours to keep and use forever!</p>
  <p style="margin-top:20px;">We reserve the right to revoke a user's ability to use or purchase Rayku Points if we suspect abuse.</p>
  <p style="margin-top:20px;">We reserve the right to change the price of Rayku Points at any time without notice.</p>
  </div>
</div>
<!--shop_right--> 

<script type="text/javascript">
  var ray_jq = jQuery.noConflict();
  ray_jq(document).ready(function()
  {

 
		
	
		ray_jq('#item').change(function() {
			var str = ""; var rayku_points = ""; var final_points = "";  var minutes = "";
			str = parseInt(ray_jq("#item").val());

			rayku_points = parseFloat(ray_jq("#_hidden").val());

			final_points = str + rayku_points;
		
			minutes = parseInt(final_points / 0.40);

			str = "$"+str+".00";
			ray_jq("#value").text(str);

		         ray_jq("#final_points").text(final_points+"RP");

			 ray_jq("#minutes").text(minutes);

		});
	



  });

</script>
