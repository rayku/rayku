<div class="cart">
    <div class="t"><h1>Your cart:</h1></div>
    <div class="bg">
    <?php $count = 0; $tot_price = 0; ?>
        <ol>
        	<?php foreach($cart_items as $key=>$cart_item): ?>
            	<?php if($item = $cart_item->getItem()): ?>
            <li>
                <div class="number"><?php echo $key+1; ?></div>
                <div class="article"><?php echo $item->getTitle() ?></div>
                <div class="price"><?php echo $item->getPricePerUnit() ?> RP</div>
                <a class="remove cart_remove" rel ="<?php echo $cart_item->getId() ?>" id="cart_remove_<?php echo $cart_item->getId() ?>"  href="javascript:;">remove</a>
         		
            </li>
            <?php $count++; ?>
            <?php $tot_price = $tot_price + $cart_item->getTotalPrice(); ?>
            	<?php endif; ?>
            <?php endforeach; ?>
        </ol>
    </div><!--bg-->
    <div class="b">
        <div class="ammount"><?php echo $count ?> items</div>
        <div class="price"><?php echo $tot_price ?>RP</div>
    </div><!--b-->
    <input type="button" onClick="parent.location='/shop/checkoutPage'" class="myButton" value="Checkout" style="float:right;margin-top:10px;">
    <div class="clear"></div>
</div>
