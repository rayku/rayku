<?php
if($_SESSION['loginWrongPass']<=5):
?>	
    		<form id="log-in" action="login/loginCheck" method="post">
                      <div style="width:690px; clear:both">
                        <div style="float:left; width:195px; margin-left:5px; margin-top:8px;">


			<?php $_Username  = ($_COOKIE['rEmail']) ? $_COOKIE['rEmail'] : "Username" ;

			$_Password  = ($_COOKIE['rPassword']) ? $_COOKIE['rPassword'] : "Password" ; ?>

                          <input type="text" id="userid" name="userid" class="text-box" value="<?php echo $_Username; ?>" onblur="if(this.value=='') this.value='Username';" onfocus="if(this.value=='Username') this.value='';" />
                        </div>
                        <div style="float:left; width:180px; margin-top:8px;">
                          <input type="password" id="password" name="password" class="text-box" value="<?php echo $_Password; ?>" onblur="if(this.value=='') this.value='Password';" onfocus="if(this.value=='Password') this.value='';" />
                        </div>
                        <div style="float:left; width:85px; margin-left:15px; ">
                          <input type="image" src="images/login_btn.png" class="image-button" />
                        </div>
                        <div style="float:left; width:200px; margin-left:5px;font-size:12px; color:#6b6e77;">
                         <?php echo checkbox_tag('remember', '1', true, array('class' => 'checkbox')); ?>
                          <p style="color:#fff; font-size:12px; padding-top:3px; padding-bottom:8px;">Remember Login Information</p>
						  <?php echo checkbox_tag('invisible', '1', false, array('class' => 'checkbox')); ?>  <p style="color:#fff; font-size:12px; padding-top:3px; padding-bottom:8px;">Login as Invisible</p>
                          <p style="padding-left:20px; line-height:13px;"><a href="#" style="color:#fff; font-size:12px; text-decoration:underline;">Forgot Your Password?</a></p>
                        </div>
                      </div>
				  </form>
                  
      <?php
      endif;
	  ?>         
