<?php use_helper('Javascript', 'MyForm') ?>
<link href="../css/style-reg-table.css" rel="stylesheet" type="text/css" media="screen" />

<div class="body-main">
  <div id="top" style="margin:10px 0 15px 0"> <span style="background:url(../../../images/arrow-right.gif) no-repeat; padding-left:40px; color:#1C517C; font-size:20px; font-weight:bold">Create Account</span> </div>
  <div class="clear"></div>
  <div class="body-mains"> <?php echo form_tag('register/index', array('name' => 'register')) ?> <?php echo input_hidden_tag('utype',$requestedUserType) ?>
    <?php if($requestedUserType == UserPeer::getTypeFromValue( 'teacher' ) ): ?>
    <!--
    <div class="box">
      <div class="top"></div>
      <div class="content">
        <div class="entry">
          <div class="ttle">Confirmation code</div>
          <div> <?php echo input_tag('confirmationcode') ?>
            <div class="available" id="avail">Enter confirmation code has been received by Rayku.</div>
          </div>
          <div class="spacer"></div>
        </div>
      </div>
      <div class="bottom"></div>
      <div class="spacer"></div>
    </div>
    -->
    <?php endif; ?>
    <div class="box">
      <div class="top"></div>
      <div class="content">
        <div class="entry" style="padding-top:15px">
          <div class="ttle">Email:</div>
          <div style="float:left">
            <?php if($sf_request->hasError('email')): ?>
            <div style="font-size:14px;color:#900;line-height:22px" align="center"><?php echo form_error('email') ?></div>
            <?php endif; ?>
            <?php echo input_tag('email') ?> </div>
          <div style="font-weight:normal;color:#666;width:200px;margin-left:240px;">end with utoronto.ca or toronto.edu</div>
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
        <div class="entry" style="padding-bottom:15px;">
          <div class="ttle">Display Username:</div>
          <div style="float:left">
            <?php if($sf_request->hasError('username')): ?>
            <div style="font-size:14px;color:#900;line-height:22px" align="center"><?php echo form_error('username') ?></div>
            <?php endif; ?>
            <?php echo input_tag('username') ?>
            <input type="hidden" name="realname" id="realname" value="hiddenname">
          </div>
          <div style="font-weight:normal;color:#666;width:200px;margin-left:240px;">used for profile identification</div>
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
          <div class="ttle">Year of study:</div>
          <div style="float:left">
            <select name="course_year" id="course_year" style="margin:10px 0 20px 0;">
              <option value="" >----- Select -----</option>
              <option value="1">1st</option>
              <option value="2" >2nd</option>
              <option value="3" >3rd</option>
              <option value="4+" >4th+</option>
              <option value="graduated">graduated</option>
            </select>
          </div>
          <div class="spacer"></div>
        </div>
        <br/>
        <div style="font-size:16px;color:#069;padding:0 0 20px 10px"><strong>Courses you are taking or last taken:</strong></div>
        <div class="spacer"></div>
        <div id="root" class="table-a">
          <table id="dataTable" summary="Course Selection Table" style="border-bottom:1px solid #A5BED1">
            <tr>
              <th bgcolor="#F8F8F8" class="first" style="color:#666" scope="col">Subject</th>
              <th bgcolor="#F8F8F8" style="color:#666" scope="col">Course Name</th>
              <th bgcolor="#F8F8F8" style="color:#666" scope="col">Performance (Estimated)</th>
            </tr>
            <tr>
              <td class="first"><select name="course_subject[]" id="course_subject[]" style="padding:5px;border:1px solid #CCC">
                  <?php $categories = CategoryPeer::doSelect(new Criteria()); ?>
                  <option value="">--- Select ---</option>
                  <?php foreach( $categories as $category): ?>
                  <?php if($category->getId() != 5): ?>
                  <option value="<?=$category->getId();?>" >
                  <?=$category->getName();?>
                  </option>
                  <?php endif; ?>
                  <?php endforeach; ?>
                </select></td>
              <td><p>
                  <input name="course_name[]" type="text" id="course_name[]" value="e.g. Calculus for Commerce..." size="30" maxlength="50" style="padding:5px" onBlur="if(this.value=='') this.value='e.g. Calculus for Commerce...';" onFocus="if(this.value=='e.g. Calculus for Commerce...') this.value='';"/>
                </p></td>
              <td><table width='100%' border='0' cellspacing='0' cellpadding='0' style='margin-right:10px'>
                  <tr>
                    <td align='center' style='border:0;padding:0'><label class="d"><span>D</span>
                        <input type="radio" name="grade[0]" id="grade[0]" value = "D"/>
                      </label></td>
                    <td align='center' style='border:0;padding:0'><label class="c"><span>C</span>
                        <input type="radio" name="grade[0]" id="grade[0]" value = "C" />
                      </label></td>
                    <td align='center' style='border:0;padding:0'><label class="b"><span>B</span>
                        <input type="radio" name="grade[0]" id="grade[0]" value = "B" />
                      </label></td>
                    <td align='center' style='border:0;padding:0'><label class="a"><span>A</span>
                        <input type="radio" name="grade[0]" id="grade[0]" value = "A" />
                      </label></td>
                  </tr>
                </table></td>
            </tr>
            <tr>
              <td class="first"><select name="course_subject[]" id="course_subject[]" style="padding:5px;border:1px solid #CCC">
                  <?php $categories = CategoryPeer::doSelect(new Criteria()); ?>
                  <option value="">--- Select ---</option>
                  <?php foreach( $categories as $category): ?>
                  <?php if($category->getId() != 5): ?>
                  <option value="<?=$category->getId();?>" >
                  <?=$category->getName();?>
                  </option>
                  <?php endif; ?>
                  <?php endforeach; ?>
                </select></td>
              <td><p>
                  <input name="course_name[]" type="text" id="course_name[]" size="30" maxlength="50" style="padding:5px"/>
                </p></td>
              <td><table width='100%' border='0' cellspacing='0' cellpadding='0' style='margin-right:10px'>
                  <tr>
                    <td align='center' style='border:0;padding:0'><label class="d"><span>D</span>
                        <input type="radio" name="grade[1]" id="grade[1]" value = "D"/>
                      </label></td>
                    <td align='center' style='border:0;padding:0'><label class="c"><span>C</span>
                        <input type="radio" name="grade[1]" id="grade[1]" value = "C" />
                      </label></td>
                    <td align='center' style='border:0;padding:0'><label class="b"><span>B</span>
                        <input type="radio" name="grade[1]" id="grade[1]" value = "B" />
                      </label></td>
                    <td align='center' style='border:0;padding:0'><label class="a"><span>A</span>
                        <input type="radio" name="grade[1]" id="grade[1]" value = "A" />
                      </label></td>
                  </tr>
                </table></td>
            </tr>
            <tr>
              <td class="first"><select name="course_subject[]" id="course_subject[]" style="padding:5px;border:1px solid #CCC">
                  <?php $categories = CategoryPeer::doSelect(new Criteria()); ?>
                  <option value="">--- Select ---</option>
                  <?php foreach( $categories as $category): ?>
                  <?php if($category->getId() != 5): ?>
                  <option value="<?=$category->getId();?>" >
                  <?=$category->getName();?>
                  </option>
                  <?php endif; ?>
                  <?php endforeach; ?>
                </select></td>
              <td><p>
                  <input name="course_name[]" type="text" id="course_name[]" size="30" maxlength="50" style="padding:5px"/>
                </p></td>
              <td><table width='100%' border='0' cellspacing='0' cellpadding='0' style='margin-right:10px'>
                  <tr>
                    <td align='center' style='border:0;padding:0'><label class="d"><span>D</span>
                        <input type="radio" name="grade[2]" id="grade[2]" value = "D"/>
                      </label></td>
                    <td align='center' style='border:0;padding:0'><label class="c"><span>C</span>
                        <input type="radio" name="grade[2]" id="grade[2]" value = "C" />
                      </label></td>
                    <td align='center' style='border:0;padding:0'><label class="b"><span>B</span>
                        <input type="radio" name="grade[2]" id="grade[2]" value = "B" />
                      </label></td>
                    <td align='center' style='border:0;padding:0'><label class="a"><span>A</span>
                        <input type="radio" name="grade[2]" id="grade[2]" value = "A" />
                      </label></td>
                  </tr>
                </table></td>
            </tr>
          </table>
        </div>
        <div id="errortable" style="color:#FF0000; font-size:12px; padding:5px 0 0 5px"></div>
        <div style="float:left">
          <input type="button" name="button2" id="button2" value="Add More Fields" style="padding:5px;font-size:13px;margin-top:5px" onclick="addRow('dataTable')" />
        </div>
        <div class="spacer"></div>
      </div>
      <div class="bottom"></div>
    </div>
    <div class="box">
      <div class="top"></div>
      <div class="content">
      <span id="referaltext">Referral (optional):</span>
        <input style="background:url('/images/registerinputbg.gif') no-repeat scroll 0 0 transparent;border:0 none;
color:#7F8189;float:right;font:19px 'Arial';padding:9px;width:400px;"  type="text" name="coupon" id="coupon" />
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

var mailadd = email.split("@");

		var finalsplit = mailadd[1].split(".");

		if(mailadd[1] == "utoronto.ca")
		{
			
		}
		else if(mailadd[1] == "alumni.utoronto.ca")
		{
			
		}
		else if(mailadd[1] == "toronto.edu")
		{
		
		}
		else
		{
			document.getElementById('error').style.display = "block";
			document.getElementById('error').innerHTML = 'Rayku is currently available for certain schools only. Enter a @utoronto.ca or @toronto.edu email.';
			return false;
		} 


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
