<?php use_helper('Javascript') ?>
<div class="body-main">
    <div id="what-is">
        <div style="width:30px; float:left;">
            <img src="/images/green_arrow.jpg" width="42" height="25" alt="" />
        </div>
        <p style="font-size:16px; color:#1c517c; font-weight:bold; margin-left:45px;"><a href="/shop/index" style="color:#1C517C">RP Shop</a> > Donate RP to Another Member</p>
    </div>
    
    <div id="shop_left">
    
        <div style="width:620px; background-image:url(/images/profile_txtbg.jpg); background-repeat:no-repeat; font-family:Arial; font-size:12px; color:                         #7F8189; padding-top:15px; padding-left:15px; padding-right:15px; line-height:20px;">
                        
                        <form method="post" action="/shop/donate">
                            <label>Send To</label><br />
                              <?php echo input_auto_complete_tag('name', '', 'user/autocomplete', array('id'=>'referalinput', 'class'=>'field'), array('use_style' => true, 'id'=>'referalinput')) ?>
                            
                          <div class="hint">Type the USERNAME of receipent here.</div>
                            
                            <div class="clear"></div>
                            
                            <label>Donation amount</label><br />
                            <input class="field" type="text" value=" " name="points" /><div class="hint">Choose an amount very carefully.</div>
                            
                            <div class="clear"></div>
                            
                            <label>Comment</label><br />
                            <textarea class="message" name="comment"></textarea>
                            
                            <input type="submit" class="submit" value=" " name="submit" />
                        </form>

        
        </div><!--box-->
    
    </div><!--shop_left-->
    
</div>
<?php include_component('shop','rightBox') ?>