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
            <?php if ($sf_request->hasError('username')): ?>
            <div style="font-size:14px;color:#900;line-height:22px" align="center"><?php echo form_error('username') ?></div>
            <?php endif; ?>
            <?php echo input_tag('username') ?>
            <input type="hidden" name="realname" id="realname" value="hiddenname">
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

    <!-- notifications -->

    <div class="box">
      <div class="top"></div>
      <div class="content">
        <div class="title">Notification options</div>
        <div class="subtitle">once student asks question within expert's subject of expertise</div>
        <input type="checkbox" name="notify_email" value="email" />
        <label style="font-size:13px; font-family: Arial; color:#056A9A; font-weight:bold;">Email</label>
        <br />
        <input type="checkbox" name="notify_sms" value="sms" />
        <label style="font-size:13px; font-family: Arial; color:#056A9A; font-weight:bold;">SMS &nbsp;&nbsp;&nbsp; Enter Phone Number</label>
        <input type="text" name="phone_number" value="" />
      </div>
      <div class="bottom"></div>
      <div class="spacer"></div>
    </div>
    <?php endif; ?>

    <!--  end -->

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
          <p>Your password is immediately MD5 encrypted, so that only you know what it is - no one else. </p>
        </div>
      </div>
      <div class="bottom"></div>
    </div>
  </div>
</div>
<script type="text/javascript">

function emailValidateNew()
{
var email = document.getElementById('email').value;

var subject = document.getElementById('course_subject[]').value;

var course = document.getElementById('course_name[]').value;

var year = document.getElementById('course_year').value;

var grade = document.getElementById('grade[0]').value;



	if(subject == '')
	{
			document.getElementById('error').style.display = "block";
			document.getElementById('error').innerHTML = 'Please enter at least one course entry.';
			return false;

	} else if(course == '') {

			document.getElementById('error').style.display = "block";
			document.getElementById('error').innerHTML = 'Please enter at least one course entry.';
			return false;

	}else if(year == '') {

			document.getElementById('error').style.display = "block";
			document.getElementById('error').innerHTML = 'Please enter at least one course entry.';
			return false;

	} else if(grade == '') {

			document.getElementById('error').style.display = "block";
			document.getElementById('error').innerHTML = 'Please enter at least one course entry.';
			return false;

	}

}
</script>
<script type="text/javascript">
	        function addRow(tableID) {



	            var table = document.getElementById(tableID);
	            var rowCount = table.rows.length;
	            var row = table.insertRow(rowCount);



		   var newCount =  rowCount - 1;

	            var colCount = table.rows[2].cells.length;

	            for(var i=0; i<colCount; i++) {

	                var newcell = row.insertCell(i);


			if(i == '2')
			{

			 table.rows[rowCount].cells[i].innerHTML = "<table width='100%' border='0' cellspacing='0' cellpadding='0' style='margin-right:10px'><tr><td align='center' style='border:0;padding:0'><label class='d'><input type='radio' name= grade[" + newCount + "] value='D'></label></td><td align='center' style='border:0;padding:0'><label class='c'><input type='radio' name= grade[" + newCount + "] value='C'></label></td><td align='center' style='border:0;padding:0'><label class='b'><input type='radio' name= grade[" + newCount + "] value='B'></label></td><td align='center' style='border:0;padding:0'><label class='a'><input  type='radio' name= grade[" + newCount + "] value='A'></label></td></tr></table>";

				newcell.innerHTML = table.rows[rowCount].cells[i].innerHTML;

			} else {
	                	newcell.innerHTML = table.rows[2].cells[i].innerHTML;
			}


	            }
        }
</script>
