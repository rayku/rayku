<div id="shop_right">
  <div class="header"> <a href="/shop/paypal">Deposit Money (get RP)</a> </div>
  <div class="header"> <a href="/register/invitation">Invite Friends (get RP)</a> </div>
  <div class="text"> 
    
    <!--<h1>Rayku On-Site Products</h1>
                            <ul>--> 
    <!-- <li><a href="/shop/awardPurchase">Profile Icons</a></li> --> 
    <!-- <li><a href="/friends/games/">Play Games</a></li> --> 
    <!--<li><a href="/shop/donatePage">Donate to friends</a></li>--> 
    <!--</ul>-->
    
    <h1>Shop Categories</h1>
    <ul style="font-size:14px;color:#333">
      <?php foreach($itemTypes as $item_type): ?>
      <li><?php echo link_to($item_type->getName(),'/shop/index?category='.$item_type->getId()); ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
  <!--text-->
  
  <div id="shop_cart">
    <?php include_component('shop','cartBox'); ?>
  </div>
  <!--cart--> 
  
</div>
<!--shop_right--> 
<script type="text/javascript">
				Event.observe(window,'load',function(){
				$$('.cart_remove').each(function(it){
				Event.observe(it,'click',function(ev){
				if(!confirm('If you remove an item you will loose 1RP as penalty. Do you want to remove it?',"Yes","No"))
					return false;
				var ele = ev.element();
				new Ajax.Updater('shop_cart','/shop/removeFromCart',{method:'post',asynchronus:true, evalScripts:true, parameters: {cit: ele.rel }, onComplete: function(){bindAll();}});
				});
				});
					});
</script> 
