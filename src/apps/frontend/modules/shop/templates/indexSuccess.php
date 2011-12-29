
<div class="body-main">
  <div id="what-is">
    <div style="width:30px; float:left;"> <img src="/images/green_arrow.jpg" width="42" height="25" alt="" /> </div>
    <p style="font-size:16px; color:#1c517c; font-weight:bold; margin-left:45px;">RP Shop</p>
  </div>
  <div id="shop_left">
    <div class="box">
      <div class="t">
        <div class="b">
          <div class="cont">

            <!--rp_av-->

            <?php  $remainingItems = array(); $j = 0; ?>
            <?php foreach($items as $item): ?>
            <?php

		$connection = RaykuCommon::getDatabaseConnection();
		$query = mysql_query("select * from item_featured where item_id =".$item->getId()." and status=1", $connection) or die(mysql_error());


		if(mysql_num_rows($query) > 0) { ?>
            <div class="item">
              <div class="left">
                <?php $ext=substr($item->getImage(),strpos($item->getImage(),".")); $filename = str_replace($ext,'',$item->getImage()); ?>
                <div class="thumb" style="border:none"><?php echo image_tag( '/uploads'  . '/' . sfConfig::get('app_items_upload_folder').'/'.$filename."_t".$ext,array('alt'=>$item->getTitle())) ?></div>
                <input type="button" onClick="parent.location='shop/itemDetail?id=<?php echo $item->getId(); ?>'" class="myButton" value="More Info" style="padding:3px;font-size:13px;"> </div>
              <!--left-->

              <div class="right">
                <h1><?php echo link_to($item->getTitle(),'shop/itemDetail?id='.$item->getId(),array('class'=>'stitle')) ?></h1>
                <?php echo substr($item->getDescription(),0,120).'...'; ?>
                <div class="prices" style="margin-top:30px;"> <span>Price:</span> <?php echo $item->getPricePerUnit(); ?>RP &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>Actual Value:</span> $<?php echo $item->getActualValue()." ". $item->getActualValueCurrency(); ?> </div>
                <!--prices-->
              </div>
              <!--right-->

              <div class="clear"></div>
            </div>
            <!--item-->

            <?php } else {


 $remainingItems[$j] = $item->getId();

$j++;

				} ?>
            <?php endforeach; ?>
            <?php foreach($remainingItems as $newitem): ?>
            <?php


	 $c= new Criteria();
	 $c->add(ItemPeer::IS_ACTIVE,true);
	 $c->add(ItemPeer::ID,$newitem);
	 $item = ItemPeer::doSelectOne($c); ?>
            <div class="item">
              <div class="left">
                <?php $ext=substr($item->getImage(),strpos($item->getImage(),".")); $filename = str_replace($ext,'',$item->getImage()); ?>
                <div class="thumb" style="border:none"><?php echo image_tag( '/uploads'  . '/' . sfConfig::get('app_items_upload_folder').'/'.$filename."_t".$ext,array('alt'=>$item->getTitle())) ?></div>
                <input type="button" onClick="parent.location='shop/itemDetail?id=<?php echo $item->getId(); ?>'" class="myButton" value="More Info" style="padding:3px;font-size:13px;"> </div>
              <!--left-->

              <div class="right">
                <h1><?php echo link_to($item->getTitle(),'shop/itemDetail?id='.$item->getId(),array('class'=>'stitle')) ?></h1>
                <?php echo substr($item->getDescription(),0,120).'...'; ?>
                <div class="prices" style="margin-top:30px;"> <span>Price:</span> <?php echo $item->getPricePerUnit(); ?>RP &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>Actual Value:</span> $<?php echo $item->getActualValue()." ". $item->getActualValueCurrency(); ?> </div>
                <!--prices-->
              </div>
              <!--right-->

              <div class="clear"></div>
            </div>
            <!--item-->

            <?php endforeach; ?>
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
<?php include_component('shop','rightBox') ?>
