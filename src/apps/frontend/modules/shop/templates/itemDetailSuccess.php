
<div class="body-main">
  <div id="what-is">
    <div style="width:30px; float:left;border:none"> <img src="<?php echo image_path('green_arrow.jpg', false); ?>" width="42" height="25" alt="" /> </div>
    <p style="font-size:16px; color:#1c517c; font-weight:bold; margin-left:45px;"><a href="/shop/index" style="color:#1C517C">RP Shop</a> > Product Information</p>
  </div>
  <div id="shop_left">
    <div class="box">
      <div class="t">
        <div class="b">
          <div class="cont">
            <div class="info">
              <div class="left">
                <?php $ext=substr($item->getImage(),strpos($item->getImage(),".")); $filename = str_replace($ext,'',$item->getimage()); ?>
                <div class="thumb"><?php echo image_tag( '/uploads'  . '/' . sfConfig::get('app_items_upload_folder').'/'.$filename."_l".$ext,array('alt'=>$item->getTitle())) ?></div>
                <div class="rating">
                  <div id="raters"></div>
                  <?php echo $countReviews; ?> ratings</div>
                <a href="#" onClick="window.open('<?php echo '/uploads'  . '/' . sfConfig::get('app_items_upload_folder').'/'.$filename.$ext; ?>', 'EIN', 'scrollbars,resizable,toolbar,width=600,height=550,left=50,top=50')" style="font-size:17px;color:#069;float:right">enlarge</a>
                <div class="clear"></div>
              </div>
              <!--left-->
              
              <div class="right">
                <h1><?php echo $item->getTitle() ?></h1>
                <div class="sep"></div>
                                <div class="stock">
                <table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-size:14px;">
                  <tr>
                    <td><strong>Quantity Available:</strong> <?php echo $item->getQuantity(); ?></td>
                    <td align="right"><strong>Price: </strong><?php echo $item->getPricePerUnit(); ?><strong> RP</strong></td>
                  </tr>
                  <tr>
                    <td><strong>Item Size:</strong> <?php echo ($item->getSize())?$item->getSize()->__toString():''; ?></td>
                    <td><div class="r"><a href="#" id="item_add" class="add">add</a></div></td>
                  </tr>
                </table>
                </div>
                
                <div class="sep"></div>
                <?php if(is_array($features)): ?>
                <?php $count_half = (int)(count($features)/2); $c =0; ?>
                <h3>Key Features</h3>
                <?php foreach($features as $feature): ?>
                <?php if($c == 0): ?>
                <ul class="left">
                  <?php elseif($c == $count_half): ?>
                  <ul class="right">
                    <?php endif; ?>
                    <li><?php echo $feature; ?></li>
                    <?php $c++; ?>
                    <?php if($c == $count_half): ?>
                  </ul>
                  <?php elseif($c==count($features)):?>
                </ul>
                <?php endif; ?>
                <?php endforeach; ?>
                <?php endif;?>
              </div>
              <!--right-->
              
              <div class="clear"></div>
              <div class="desc">
                <h3>Description:</h3>
                <?php echo $item->getDescription(); ?> </div>
            </div>
            <!--info--> 
            
          </div>
          <!--cont--> 
        </div>
        <!--b--> 
      </div>
      <!--t--> 
      
    </div>
    <!--box-->
    
    <div class="box">
      <div class="t">
        <div class="b">
          <div class="cont">
            <h1 style="line-height:20px;">Other items that you may be interested in:</h1>
            <?php $v = 0 ?>
            <?php foreach($other_items as $key=>$other_item): ?>
            <?php if($v < 4) : ?>
            <?php $ext=substr($other_item->getImage(),strpos($other_item->getImage(),".")); $filename = str_replace($ext,'',$other_item->getimage()); ?>
            <?php if($key != 0):?>
            <div class="sepv"></div>
            <?php elseif($key  == 4): ?>
            <?php  break;  ?>
            <?php endif; ?>
            <div class="it"> <a href="<?php echo url_for('/shop/itemDetail?id='.$other_item->getId()); ?>"><?php echo image_tag( '/uploads'  . '/' . sfConfig::get('app_items_upload_folder').'/'.$filename."_t".$ext,array('alt'=>$other_item->getTitle())) ?></a> <?php echo $other_item->getTitle(); ?> </div>
            <?php $v++; ?>
            <?php endif; ?>
            <?php endforeach; ?>
            <div class="clear"></div>
          </div>
          <!--cont--> 
        </div>
        <!--b--> 
      </div>
      <!--t--> 
      
    </div>
    <!--box--> 
    
  </div>
  <!--shop_left--> 
  
</div>
<div id="shop_right">
  <div class="header"> <a href="/shop/index">Shop Homepage</a> </div>
  <div id="shop_cart" style="font-size:18px; color:#C00">
    <?php include_component('shop','cartBox'); ?>
  </div>
</div>
<!--shop_right--> 

<script type="text/javascript">
				Event.observe(window,'load',function(){
				var rater1 = new Rater("raters");
				rater1.settings.maxValue=5;
				rater1.settings.initialValue=<?php echo $avgRating ?>;
				rater1.settings.reRate=false;
				rater1.draw(<?php echo $allowRate ?>);
				rater1.onRate=callOnRate;
				function callOnRate(value)
				{
					
					new Ajax.Request('/shop/rate',{method:'post',asynchronus:true, evalScripts:true, parameters: {it:<?php echo $item->getId() ?>, rating: value},
					onComplete: 		function(response){ 
														if(response.responseText == 'success') alert('Thank you for rating');
														if(response.responseText == 'already') alert('You cannot rate this again');
					 								}
					});
					
				}
				
				$$('.cart_remove').each(function(it){
				Event.observe(it,'click',function(ev){
				if(!confirm('If you remove an item, you will loose 1RP as a penalty. Do you want to remove it?',"Yes","No"))
					return false;
				var ele = ev.element();
				new Ajax.Updater('shop_cart','/shop/removeFromCart',{method:'post',asynchronus:true, evalScripts:true, parameters: {cit: ele.rel }, onComplete: function(){bindAll();}});
				});
				});

				Event.observe('item_add','click',function(ev){
					if(!confirm('If you later remove this item from your cart, you will loose 1RP as penalty. Do you still want to add it?',"Yes","No"))
						return false;
					new Ajax.Updater('shop_cart','/shop/addToCart',{method:'post',asynchronus:true, evalScripts:true, parameters: {it:<?php echo $item->getId() ?>}, onComplete: function(){bindAll();}});
				});
				});
				
				function bindAll()
				{
					window.location.reload();
				}
				</script> 
