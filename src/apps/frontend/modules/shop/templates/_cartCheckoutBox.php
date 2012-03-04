<div class="box">
    <div class="t">
        <div class="b">
            <div class="cont">
                
                <div class="ch">
                    <div class="obj"><h1>Item</h1></div>
                    <div class="price"><h1>Price</h1></div>
                    <div class="qtty"><h1>Quantity</h1></div>
                    <div class="clear"></div>
                    <div class="sep"></div>

                    <?php
                      $count = 0; $tot_price = 0; $tot_item_price = 0; $tot_shipping_price = 0;
                      $voucher_id = $sf_user->getAttribute('voucher_id');
                      $voucher = OfferVoucherPeer::retrieveByPK($voucher_id);

                   ?>
                    <?php foreach($cart_items as $key=>$cart_item): ?>
                    <?php if($item = $cart_item->getItem()): ?>
                        <div class="obj"><?php echo $item->getTitle() ?></div>
                        <div class="price"><?php echo $cart_item->getTotalPrice() ?> <strong>RP</strong></div>
                        <div class="qtty wr"><?php echo $cart_item->getQuantity() ?></div>
                        <a class="remove cart_remove" rel ="<?php echo $cart_item->getId() ?>" id="cart_remove_<?php echo $cart_item->getId() ?>"  href="javascript:;">remove</a>
                        <div class="clear"></div>
                          <?php $tot_price = $tot_price + $cart_item->getTotalPrice() + $cart_item->getTotalShippingCharge(); ?>
                          <?php $tot_item_price = $tot_item_price + $cart_item->getTotalPrice(); ?>
                          <?php $tot_shipping_price = $tot_shipping_price + $cart_item->getTotalShippingCharge(); ?>
                    <?php endif; ?>
                    <?php endforeach; ?>
                    
                    <div class="sep" style="margin-bottom:20px"></div>
                        <div class="ttl" align="left" style="text-align:left;font-size:16px">Your items come to a total of...</div>
                    
                    <div class="f" style="line-height:25px;">
                        <span style="color:#666">Items:</span> <?php echo $tot_item_price; ?> <strong>RP</strong><br />
                        <span style="color:#666">Shipping fee:</span> <?php echo $tot_shipping_price; ?> <strong>RP</strong><br /><br />
                        <div style="border-top:1px dotted #CCC; border-bottom:1px dotted #CCC"><?php
                          if($voucher instanceof OfferVoucher) {
                            $tot_price = $tot_price - $voucher->getPrice();
                          }
                        ?>
                        <?php
                          if($voucher instanceof OfferVoucher) {
                            echo '<span>Coupon Discount: </span>'.$voucher->getPrice().' <strong>RP</strong>';
                          }
                        ?></div>
                        <span>Total Cost:</span> <span style="color:#000"><?php echo $tot_price; ?> $<strong>RP</strong></span>
                        <br /><em>(You have <?php $logedUserId = $user->getID();

$connection = RaykuCommon::getDatabaseConnection();

						$query = mysql_query("select * from user where id=".$logedUserId." ", $connection) or die(mysql_error());
						$detailPoints = mysql_fetch_assoc($query); 
						echo $detailPoints['points']; ?>RP available)</em>
                    </div>
                    
                    <div class="r">
                        <span>Have a coupon?</span>
                        <?php echo form_tag('shop/voucherCode'); ?>
                           <?php
                              if($voucher instanceof OfferVoucher) {
                                echo '<input style="margin-right:5px;padding:5px;" type="text" name="coupon"  value="'.$voucher->getCode().'"/>';
                              } else {
                                echo '<input style="margin-right:5px;padding:5px;" type="text" name="coupon" />';
                              }
                            ?>
                            
                      <input type="submit" class="apply" value=" " name="apply" />
                            <div class="clear"></div>
                        </form>
                    </div>
                    
                    <div class="clear"></div>
                    
                </div><!--ch-->
                
            </div><!--cont-->
        </div><!--b-->
    </div><!--t-->

</div><!--end of box-->
