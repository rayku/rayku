<?php use_helper('MyForm') ?>
<?php
/*echo "<pre>";
print_r($_SERVER);
echo "</pre>";*/
?>

<div id="top">
  <div style="width:30px; float:left;"><img height="25" width="42" src="/images/green_arrow.jpg"/></div>
  <div style="font-size:16px; color:#1C517C; font-weight:bold; margin-left:25px; padding-top:3px;float:left">Login</div>
  <div class="spacer"></div>
</div>
<div class="spacer"></div>
<div class="body-main">
  <div class="box">
    <div class="top"></div>
    <div class="content"> <?php echo form_tag('login/loginCheck', array('method' => 'post')) ?>
      <div class="entry">
      <div style="font-size:14px; color:#F00;" >
      <?php
		if($_SESSION['loginErrorMsg']<>''): 
			 echo $_SESSION['loginErrorMsg'];
			 $_SESSION['loginErrorMsg']='';
		endif;
		?>
      </div>
        <div class="ttle">Email address</div>

			<?php $_Username  = ($_COOKIE['rEmail']) ? $_COOKIE['rEmail'] : "Username" ;

			$_Password  = ($_COOKIE['rPassword']) ? $_COOKIE['rPassword'] : "Password" ; ?>


        <div> <?php echo input_tag('name',$_Username, array('id'=>'email') ); ?> 
          
          <!--<div class="availableb">An onFocus field message</div>--> 
          
        </div>
        <div class="spacer"></div>
      </div>
      <div class="entry">
        <div class="ttle">Password</div>
          <?php
              echo input_password_tag('pass',$_Password, array('id'=>'password'));
            ?>
        <div class="spacer"></div>
        
      </div>
      
      <?php 
	 /////start recaptcha
	  ///////if user has entered 5 times wrong password recaptcha will enable
	 
	  		if($_SESSION['loginWrongPass']>=5):
		//	echo $_SERVER['DOCUMENT_ROOT'].'/recaptcha/recaptchalib.php';
			require_once($_SERVER['DOCUMENT_ROOT'].'/recaptcha/recaptchalib.php');
			
			// Get a key from https://www.google.com/recaptcha/admin/create
			$publickey = "6Lc_mscSAAAAAE0Bxon37XRl56V_l3Ba0sqib2Zm";
			$privatekey = "6Lc_mscSAAAAAKG3YnU2l3uHYqcBDB6R31XlVTW8";
			
			# the response from reCAPTCHA
			$resp = null;
			# the error code from reCAPTCHA, if any
			$error = null;
			?>
			
      <div style="margin-left:10px; font-weight:bold; font-size:13px">
       
       <?php
	   
	   $error=$_SESSION['recaptchaError']<>''?$_SESSION['recaptchaError']:'';
       echo recaptcha_get_html($publickey, $error);
	    $_SESSION['recaptchaError']='';
	   ?>
      </div>
      <?php
			  endif;
			  
			   /////ends recaptcha
	  ?>
      <div style="margin-left:10px; padding-top:10px; font-weight:bold; font-size:13px">
        <label><?php echo checkbox_tag('remember', '1', true); ?> Remember me</label>
      </div>
      <div style="margin-left:10px; font-weight:bold; font-size:13px">
        <label><?php echo checkbox_tag('invisible', '1', false); ?> Login as invisible</label>
      </div>
      

      <?php echo input_hidden_tag('referer', $sf_request->getAttribute('referer')) ?> <?php echo submit_tag( 'Login to your account now!', array( 'class' => 'button' )) ?>
      </form>
    </div>
    <div class="spacer"></div>
    <div class="bottom"></div>
  </div>
  <a name="forgot" id="forgot"></a>
  <div class="box">
    <div class="top-green"></div>
    <div class="content-green">
      <div id="forgottext">Forgot your password?</div>
      <?php echo form_tag('@recover_password') ?> <?php echo input_tag( 'email', "Enter your email and we'll send it along...",
                                array( 'id' => 'forgotinput',
                                       'onblur' => 'if(this.value==\'\') this.value="Enter your email and we\'ll send it along...";', 'onfocus' => 'if(this.value=="Enter your email and we\'ll send it along...") this.value=\'\';'
                                     ) );
          ?> <?php echo submit_tag('Send my password!', array( 'class' => 'button-sm' ) ); ?>
      </form>
      <div class="spacer"></div>
    </div>
    <div class="spacer"></div>
    <div class="bottom-green"></div>
  </div>
</div>
<!-- end of body-main -->

<div class="body-side">
  <div class="box">
    <div class="top"></div>
    <div style="position: relative;" class="content">
      <div style="margin-top: 0px; margin-left:0" class="title">Don't have an account?</div>
      <div class="text"> Registration is quick and easy. It takes less than 1 minute to get started! </div>
      <?php echo link_to('Sign up now', 'register/index', array( 'id' => 'signup' ) ); ?> </div>
    <div class="spacer"></div>
    <div class="bottom"></div>
  </div>
</div>
