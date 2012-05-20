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
