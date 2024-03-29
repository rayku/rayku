<!-- ClickTale Top part -->
<script type="text/javascript">
var WRInitTime=(new Date()).getTime();
</script>
<!-- ClickTale end of Top part -->

<?php use_helper('Javascript', 'MyForm') ?>
<link href="/css/style-reg-table.css" rel="stylesheet" type="text/css" media="screen" />
<link href="<?php echo sfConfig::get('app_rayku_url') ?>/css/custom/register.css" rel="stylesheet" type="text/css" media="screen" />
<div class="body-main">
  <div id="top" style="margin:10px 0 15px 0"> <span style="background:url(/images/arrow-right.gif) no-repeat; padding-left:40px; color:#1C517C; font-size:20px; font-weight:bold">Create Tutor Account</span> </div>
  <div class="clear"></div>
  <div class="body-mains"> <?php echo form_tag('regtutor/index', array('name' => 'register')) ?> <?php echo input_hidden_tag('utype',$requestedUserType) ?>
    <div class="box">
      <div class="top"></div>
      <div class="content">
	  	<div class="entry" style="padding-bottom:15px;">
          <div class="ttle">Full Name:</div>
          <div style="float:left">
            <?php if($sf_request->hasError('realname')): ?>
            <div style="font-size:14px;color:#900;line-height:22px" align="center"><?php echo form_error('realname') ?></div>
            <?php endif; ?>
            <?php echo input_tag('realname') ?>
            <input type="hidden" name="username" id="username" value="hiddenname">
          </div>
          <div class="spacer"></div>
        </div>
        <div class="entry" style="padding-top:15px">
          <div class="ttle">Primary Email:</div>
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

		 <div class="entry">
          <div class="ttle">Where did you find us?</div>
          <div style="float:left">
            <?php if($sf_request->hasError('where_find_us')): ?>
            <div style="font-size:14px;color:#900;line-height:22px" align="center"><?php echo form_error('where_find_us') ?></div>
            <?php endif; ?>
            <?php echo input_tag('where_find_us', $wherefind, array('type' => 'text')) ?> </div>
          <div class="spacer"></div>
        </div>

      </div>
      <div class="bottom"></div>
      <div class="spacer"></div>
    </div>
    <div id="error" style="color:#FF0000; font-size:12px;padding-bottom:5px"></div>
    <div id="tos" style="font-size:12px;line-height:30px;width:300px;float:left">
      <label><strong>
        <input type="checkbox" name="terms" value="1"/>
        Agree to <a href="<?php echo sfConfig::get('app_rayku_url') ?>/tos.html" rel="popup standard 800 600 noicon">Terms &amp; Conditions</a></strong> </label>
    </div>
    <div style="float:right"><?php echo "<input type='submit' name='regtutor' value='Submit' style='padding:7px;width:100px;font-size:16px;font-weight:bold' onClick='return emailValidateNew()'>"; ?></div>
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

<!-- ClickTale Bottom part -->
<div id="ClickTaleDiv" style="display: none;"></div>
<script type="text/javascript">
if(document.location.protocol!='https:')
  document.write(unescape("%3Cscript%20src='http://s.clicktale.net/WRc9.js'%20type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
if(typeof ClickTale=='function') ClickTale(44004,1,"www");
</script>
<!-- ClickTale end of Bottom part -->