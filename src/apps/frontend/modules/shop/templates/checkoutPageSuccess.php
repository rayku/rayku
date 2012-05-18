<div class="body-main">
  <div id="what-is">
  <div style="width:30px; float:left;">
    <img src="<?php echo image_path('green_arrow.jpg', false); ?>" width="42" height="25" alt="" />
  </div>
    <p style="font-size:16px; color:#1c517c; font-weight:bold; margin-left:45px;">RP Shop > Cart Checkout</p>
  </div>

  <div id="shop_left">
    <div id="shop_cart">
     <?php include_component('shop','cartCheckoutBox') ?>
    </div>
    <?php echo form_tag('shop/checkout'); ?>
      <div class="fill">
        <h1>Fill out your purchase details!</h1>
          <div class="holder">
            <div class="t"></div>
              <div class="cont">
                <h3>Full name:</h3>
                  <input name="purchase[name]" type="text" class="data" value="<?php echo $user->getName() ?>" />
                  <div class="clear"></div>

                  <h3>E-Mail Address:</h3>
                  <input name="purchase[email]" type="text" class="data" value="<?php echo $user->getEmail() ?>" />
                  <div class="clear"></div>
              </div><!--cont-->
          </div><!--holder-->
      </div><!--fill-->

      <div class="fill">
        <h1>Additional Information</h1>
          <div class="holder">
            <div class="t"></div>
              <div class="cont">
                    <h3>Address Line 1:</h3>
                      <input type="text" class="data" name="purchase[address_1]" />
                      <div class="clear"></div>

                      <h3>Address Line 2:</h3>
                      <input type="text" class="data" name="purchase[address_2]" />
                      <div class="clear"></div>

                      <h3>City:</h3>
                      <input type="text" class="data" name="purchase[city]" />
                      <div class="clear"></div>

                      <h3>State/Province:</h3>
                      <input type="text" class="data" name="purchase[state]" />
                      <div class="clear"></div>
                      <div class="clear"></div>

                      <h3>Zip/Postal Code:</h3>
                      <input type="text" class="data" name="purchase[zip]" />
                      <div class="clear"></div>

                      <h3>Country:</h3>
                      <input type="text" class="data" name="purchase[country]" />
                      <div class="clear"></div>

                      <h3>Telephone Number:</h3>
                      <input type="text" class="data" name="purchase[tel]" />
                      <div class="clear"></div>
              </div><!--cont-->

          </div><!--holder-->

          <input type="submit" value=" " class="send"  style="margin-top:20px; margin-bottom:40px;" />
      </div><!--fill-->
    </form>
  </div><!--shop_left-->

</div><!-- end of body-main -->

<div id="shop_right">
  <div class="header">
    <a href="/shop/index">Shop Homepage</a>
  </div><!--cart-->

  <div class="text">Thank you for your interest. Go ahead and fill out the forms on your left. Once you are ready, click on the 'Submit' button. You may <a href="mailto:support@rayku.com" class="link">email us</a> if you have any problems.<br />
<br />
The RP will be automatically deducted from your account, and an administrator will be notified immediately. Please note it may take <strong>2-4 business days</strong> for your order to be processed. You will be emailed once it is complete.</div>
</div><!--shop_right-->

                    
<script type="text/javascript">
Event.observe(window,'load',function(){
				$$('.cart_remove').each(function(it){
				Event.observe(it,'click',function(ev){
				if(!confirm('If you remove an item you will loose 1RP as penalty. Do you want to remove it?',"Yes","No"))
					return false;
				ele = ev.element();
				new Ajax.Updater('shop_cart','/shop/removeItemFromCart',{method:'post',asynchronus:true, evalScripts:true, parameters: {cit: ele.rel }, onComplete: function(){bindAll();}});
				});
				
				});
});

function bindAll()
				{
					window.location.reload();
				}

</script>
