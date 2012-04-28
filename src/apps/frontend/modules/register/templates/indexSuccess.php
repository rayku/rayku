<?php use_helper('Javascript', 'MyForm') ?>
<link href="/css/style-reg-table.css" rel="stylesheet" type="text/css" media="screen" />
<div class="body-main">
  <div id="top" style="margin:10px 0 15px 0"> <span style="background:url(/images/arrow-right.gif) no-repeat; padding-left:40px; color:#1C517C; font-size:20px; font-weight:bold">Create Account</span> </div>
  <div class="clear"></div>
  <div class="body-mains"> <?php echo form_tag('register/index', array('name' => 'register')) ?> <?php echo input_hidden_tag('utype',$requestedUserType) ?>
    <div class="box">
      <div class="top"></div>
      <div class="content">
        <div class="entry" style="padding-bottom:15px;">
          <div class="ttle">Full Name:</div>
          <div style="float:left">
            <?php if ($sf_request->hasError('realname')): ?>
            <div style="font-size:14px;color:#900;line-height:22px" align="center"><?php echo form_error('realname') ?></div>
            <?php endif; ?>
            <?php echo input_tag('realname') ?>
            <input type="hidden" name="username" id="username" value="hiddenname">
          </div>
          <div class="spacer"></div>
        </div>
        <div class="entry" style="padding-top:15px">
          <div class="ttle">Email:</div>
          <div style="float:left">
            <?php if($sf_request->hasError('email')): ?>
            <div style="font-size:14px;color:#900;line-height:22px" align="center"><?php echo form_error('email') ?></div>
            <?php endif; ?>
            <?php echo input_tag('email') ?> </div>
          <div style="font-weight:normal;color:#666;width:280px;margin-left:240px;">A confirmation email will be sent to the address above</div>
          <div class="spacer"></div>
        </div>
        <div class="entry">
          <div class="ttle">Password:</div>
          <div style="float:left">
            <?php if($sf_request->hasError('password1')): ?>
            <div style="font-size:14px;color:#900;line-height:22px" align="center"><?php echo form_error('password1') ?></div>
            <?php endif; ?>
            <?php echo input_tag('password1', '', array('type' => 'password')) ?> </div>
          <div style="font-weight:normal;color:#666;width:200px;margin-left:240px;">6 characters or more</div>
          <div class="spacer"></div>
        </div>
      </div>
      <div class="bottom"></div>
      <div class="spacer"></div>
    </div>
    <div class="box">
        
      <div class="top"></div>
      <div class="content">
      <div class="entry">
        <div class="ttle">Enter your credit card info (Optional)</div>
        
        <div class="spacer"></div>
      </div>
      <div class="entry">
        <div class="ttle">Cardholder Name:</div>
        <div style="float:left">
        <?php if($sf_request->hasError('card_name')): ?>
        <div style="font-size:14px;color:#900;line-height:22px" align="center"><?php echo form_error('card_name') ?></div>
        <?php endif; ?>
        <?php echo input_tag('card_name', '', array('type' => 'card_name')) ?> </div>
        <div style="font-weight:normal;color:#666;width:200px;margin-left:240px;"></div>
        <div class="spacer"></div>
      </div>
          
      <div class="entry">
        <div class="ttle">Credit Card Number:</div>
        <div style="float:left">
        <?php if($sf_request->hasError('credit_card')): ?>
        <div style="font-size:14px;color:#900;line-height:22px" align="center"><?php echo form_error('credit_card') ?></div>
        <?php endif; ?>
        <?php echo input_tag('credit_card', '', array('type' => 'credit_card')) ?> </div>
        <div style="font-weight:normal;color:#666;width:200px;margin-left:240px;"></div>
        <div class="spacer"></div>
      </div>          
          
      <div class="entry">
        <div class="ttle">CVV:</div>
        <div style="float:left">
        <?php if($sf_request->hasError('cvv')): ?>
        <div style="font-size:14px;color:#900;line-height:22px" align="center"><?php echo form_error('cvv') ?></div>
        <?php endif; ?>
        <?php echo input_tag('cvv', '', array('type' => 'cvv')) ?> </div>
        <div style="font-weight:normal;color:#666;width:200px;margin-left:240px;"></div>
        <div class="spacer"></div>
      </div>       
      
      <div class="entry">
          <div class="ttle">Expiry Date:</div>
          <div style="float:left">
            <?php if($sf_request->hasError('expiry_date')): ?>
            <div style="font-size:14px;color:#900;line-height:22px" align="center"><?php echo form_error('expiry_date') ?></div>
            <?php endif; ?>
            <?php echo input_tag('expiry_date', '', array('type' => 'expiry_date')) ?> </div>
          <div style="font-weight:normal;color:#666;width:200px;margin-left:240px;">Format: mmyy</div>
          <div class="spacer"></div>
        </div>
          </div>
      <div class="bottom"></div>
      <div class="spacer"></div>
      
    </div>
      
    <div class="box">
      <div class="top"></div>
      <div class="content">
      <span id="referaltext">Referrer (optional):</span>
        <input style="background:url('/images/registerinputbg.gif') no-repeat scroll 0 0 transparent;border:0 none;
color:#7F8189;float:right;font:19px 'Arial';padding:9px;width:352px;"  type="text" name="coupon" id="coupon" />
          <div style="font-weight:normal;color:#666;width:200px;margin-left:240px;">Enter the username of your referrer</div>
        <div class="spacer"></div>
      </div>
      <div class="bottom"></div>
      <div class="spacer"></div>
    </div>

    <!-- for expert categories //-->
    <?php if($requestedUserType == UserPeer::getTypeFromValue( 'expert' ) ): ?>
    <div class="box">
      <div class="top"></div>
      <div class="content">
        <div class="title">Select Expert Categories</div>
        <div class="subtitle">Every expert needs to select atleast one category (You may select multiple categories using the shift button)</div>
        <div class="entry">
          <div class="ttle">Categories</div>
          <div style="clear:left;">
            <?php $options = array(); ?>
            <?php $categories = CategoryPeer::getAll(); ?>
            <?php foreach( $categories as $key=>$category): ?>
            <?php $options[$category->getId()] = $category->getName(); ?>
            <?php endforeach; ?>
            <?php echo select_tag('categories',
									   		options_for_select($options), array('style' => 'width: 300px; height: 80px;background: none', 'multiple' => true));
										?> </div>
          <div class="spacer"></div>
        </div>
      </div>
      <div class="bottom"></div>
      <div class="spacer"></div>
    </div>

    <!-- end of expert categories //-->
<?php endif; ?>

    <div id="error" style="color:#FF0000; font-size:12px;padding-bottom:5px"></div>
    <div id="tos" style="font-size:12px;line-height:30px;width:300px;float:left">
      <label><strong>
        <input type="checkbox" name="terms" value="1"/>
        Agree to <a href="http://www.rayku.com/tos.html" rel="popup standard 800 600 noicon">Terms &amp; Conditions</a></strong> </label>
    </div>
    <!--
<?php echo submit_tag('', array('id' => 'register','name' => 'register')) ?>-->
    <div style="float:right"><?php echo "<input type='submit' name='register' value='Finish' style='padding:7px;width:100px;font-size:16px;font-weight:bold' onClick='return emailValidateNew()'>"; ?></div>
    <div class="spacer"></div>
    </form>
  </div>
  <div class="body-side">
    <div class="box">
      <div class="top"></div>
      <div class="content" style="position:relative; _top:-3px; _bottom:-3px; padding-right:20px; width:264px">
        <div class="text">
          <p>Your password is immediately encrypted, so that only you know what it is - no one else. </p>
        </div>
      </div>
      <div class="bottom"></div>
    </div>
  </div>
</div>
