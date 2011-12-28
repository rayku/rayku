<div class="body-main">
    <div id="what-is">
        <div style="width:30px; float:left;">
            <img src="/images/green_arrow.jpg" width="42" height="25" alt="" />
        </div>
        <p style="font-size:16px; color:#1c517c; font-weight:bold; margin-left:45px;"><a href="/shop/index" style="color:#1C517C">RP Shop</a> > Profile Icons</p>
    </div>
    
    <div id="shop_left">
    
        <div style="width:620px; background-image:url(/images/profile_txtbg.jpg); background-repeat:no-repeat; font-family:Arial; font-size:12px; color:                         #7F8189; padding-top:15px; padding-left:15px; padding-right:15px; line-height:20px;">
                        <div class="rp_av">
                            <h1>YOU CURRENTLY HAVE <span><?php $logedUserId = $user->getID();
						$query = mysql_query("select * from user where id=".$logedUserId." ") or die(mysql_error());
						$detailPoints = mysql_fetch_assoc($query); 
						echo $detailPoints['points']; ?>RP</span> AVAILABLE.</h1>
                            <a class="earn" href="../register/invitation">Earn more</a>
                            <div class="clear"></div>
                        </div>  <!--rp_av-->
                        
                        <form method="post" action="/shop/awardPurchaseSave">
                            
                            
                            <label>Number of Profile Icons (2RP Each!)</label><br />
                           <select name="awardcount" class="field" style="width:296px; height:42px;">
                               <option value="1">1</option>
                               <option value="2">2</option>
                               <option value="3">3</option>
                           </select>
                           
                           <div class="hint"># of profile icons you'd like to purchase</div>
                            
                            <div class="clear"></div>
                            
                            <input type="submit" class="submit" value=" " name="submit" />
                        </form>

        
        </div><!--box-->
    
    </div><!--shop_left-->
    
</div>
<?php include_component('shop','rightBox') ?>