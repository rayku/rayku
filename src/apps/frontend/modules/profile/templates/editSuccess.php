
<link rel="stylesheet" type="text/css" href="/css/custom/upload-media.css"/>
<link rel="stylesheet" type="text/css" href="/css/custom/view-media.css"/>
<style type="text/css">
@import "/css/custom/edit-profile.css";
</style>
<?php if($sf_user->isAuthenticated()): ?>
<?php use_helper('MyForm', 'Javascript', 'Enum') ?>
<?php use_helper('Validation', 'MyForm') ?>
<?php $raykuUser = $sf_user->getRaykuUser(); ?>

<script type="text/javascript">
function loadImages() {
	document.getElementById('loading_images').style.display = "block"; 
}
function userNameCheck() {

var userName = document.getElementById('_username').value;

	
	if(userName == '' || userName == null) {

	document.getElementById('error_for_user_name').style.display = "block"; 

	document.getElementById('_username').focus();

		return false;

	}

return true;
}

</script>
<?php /* @var $user User */ ?>

<div id="top" style="margin-left:18px;padding-top:2px">
  <div class="title" style="float:left"> <img src="/images/arrow-right.gif" alt="" />
    <p style="font-size:16px; line-height:24px;color:#1C517C;font-weight:bold;margin-left:17px;">Edit your Profile</p>
  </div>
  <div class="spacer"></div>
</div>
<div class="body-main"> <?php echo form_tag('@profile_edit?username=' . $user->getUsername(), 'multipart=true') ?>

<div id="pictures" class="box"> 
    <div class="top"></div>
    <div class="content">
      <div class="mediacount">
        <p style="text-align:left;padding-top:5px">Profile Picture</p>
      </div>
      <div id="loading_images" style="display:none; margin-left:-350px;padding-bottom:15px; padding-top:15px;"> <img src="/images/loader.gif" border="0" alt="loader"/> </div>
      <div class="browse">
        <input type="text" id="picupload" disabled="disabled" />
        <!--<input type="file" size="71" onchange="document.getElementById('picupload').value=this.value" />--> 
        <?php echo input_file_tag('file',array('size'=>'71','onChange'=>'document.getElementById("picupload").value=this.value')) ?> </div>
      <div class="allowed" style="text-align:left;">JPG, GIF, PNG - Max <?php echo $maximum_upload_size = ini_get('upload_max_filesize'); ?>B size</div>
      <?php echo form_error('file'); ?>
    </div>
    <div class="spacer"></div>
    <div class="bottom"></div>

  </div>
  
  <div class="box">
    <div class="top"></div>
    <div class="content">
      <div class="entry" style="padding-top:0">
        <div class="ttle">Full Name</div>
        <div class="spacer"></div>
        <?php echo input_tag('realname', $user->getName()); ?> <?php echo form_error('realname'); ?> 
        <div class="spacer"></div>
      </div>
<div class="entry" style="">
        <div class="ttle">Username</div>
        <div class="spacer"></div>
        <?php echo input_tag('_username', $user->getUsername()); ?> <div id="error_for_user_name" class="form_error" style="display:none;"> ↓ You must specify a User Name  ↓</div>
        <div class="spacer"></div>
      </div>
      <div class="spacer"></div>
      <div class="entry">
        <div class="ttle">Email Address</div>
        <div class="spacer"></div>
        <?php echo input_tag('email', $user->getEmail()); ?> <?php echo form_error('email'); ?>
        <div class="text"><em>won't be displayed</em></div>
        <div class="spacer"></div>
      </div>
      <div class="spacer"></div>
      <div class="entry">
        <div class="ttle">Gender</div>
        <div class="spacer"></div>
        <div style="clear:left"> <?php echo enum_values_select_tag(get_class($user), 'Gender', $user->getGender(),array('style'=>'width:160px !important;')); ?> <?php echo form_error('gender'); ?> </div>
        <?php echo checkbox_tag('show_gender', '1', $user->getShowGender(),array('class'=>"chkbox")); ?>
        <div class="text" style="top:5px;">Make public</div>
        <div class="spacer"></div>
      </div>
      <div class="spacer"></div>
      <div class="entry">
        <div class="ttle">Birthday</div>
        <div class="spacer"></div>
	
<?php

 if($user->getBirthdate()) {

	$birth = explode("-", $user->getBirthdate());

	$birth_year = $birth[0]; $birth_month = $birth[1]; $birth_date = $birth[2];

 } else {

	$birth_year = 0; $birth_month = 0; $birth_date = 0;
 }


$date = date('Y')+1;
?>

       <div style="clear:left"> 
<select id="birthdate_year" name="birthdate[year]">
<option value="0">--- SELECT ---</option>
<?php for($i=1900; $i <= $date; $i++) { ?>
<option value="<?=$i;?>" <?php if($i == $birth_year): ?> selected="selected" <?php endif; ?> ><?=$i;?></option>
<?php } ?>
</select>

<select id="birthdate_month" name="birthdate[month]"><option value="0">--- SELECT ---</option><option value="1" <?php if($birth_month == "1"): ?> selected="selected" <?php endif; ?>>January</option><option value="2" <?php if($birth_month == "2"): ?> selected="selected" <?php endif; ?>>February</option><option value="3" <?php if($birth_month == "3"): ?> selected="selected" <?php endif; ?>>March</option><option value="4" <?php if($birth_month == "4"): ?> selected="selected" <?php endif; ?>>April</option><option value="5" <?php if($birth_month == "5"): ?> selected="selected" <?php endif; ?>>May</option><option value="6" <?php if($birth_month == "6"): ?> selected="selected" <?php endif; ?>>June</option> <option value="7" <?php if($birth_month == "7"): ?> selected="selected" <?php endif; ?>>July</option> <option value="8" <?php if($birth_month == "8"): ?> selected="selected" <?php endif; ?>>August</option><option value="9" <?php if($birth_month == "9"): ?> selected="selected" <?php endif; ?>>September</option><option value="10" <?php if($birth_month == "10"): ?> selected="selected" <?php endif; ?>>October</option><option value="11" <?php if($birth_month == "11"): ?> selected="selected" <?php endif; ?>>November</option><option value="12" <?php if($birth_month == "12"): ?> selected="selected" <?php endif; ?>>December</option></select>

<select id="birthdate_day" name="birthdate[day]">
<option value="0">--- SELECT ---</option>
<?php for($i=1; $i <= 31; $i++) { ?>
<option value="<?=$i;?>" <?php if($i == $birth_date): ?> selected="selected" <?php endif; ?>><?=$i;?></option>
<?php } ?>
</select> <?php echo form_error('birthdate'); ?> </div>
        <?php echo checkbox_tag('show_birthdate', '1', $user->getShowBirthdate(),array('class'=>"chkbox")); ?>
        <div class="text" style="top:5px;">Make public</div>
        <div class="spacer"></div>
      </div>
    </div>
    <div class="bottom"></div>
    <div class="spacer"></div>
  </div>
    <div class="spacer"></div>


    <div class="spacer"></div>
  <div class="box">
    <div class="top"></div>
    <div class="content">
      <p style="text-align:left;padding-top:5px;font-size:18px;color:#1C517C;font-weight:bold;margin:5px 0 0 10px;">Security</p>
      <div class="entry">
        <div class="ttle">Change Password</div>
        <div class="spacer"></div>
        <?php echo input_password_tag('password1'); ?> <?php echo form_error('password1'); ?>
        <div class="spacer"></div>
      </div>
      <div class="entry">
        <div class="ttle">Confirm New Password</div>
        <div class="spacer"></div>
        <?php echo input_password_tag('password2'); ?> <?php echo form_error('password2'); ?>
        <div class="spacer"></div>
      </div>
    </div>
    <div class="bottom"></div>
    <div class="spacer"></div>
  </div>
  <div class="spacer"></div>
  <div class="box">
    <div class="top"></div>
    <div class="content">
      <p style="text-align:left;padding-top:5px;font-size:18px;color:#1C517C;font-weight:bold;margin:5px 0 0 10px;">Contact Information</p>
      <div class="entry">
        <div class="ttle">Home Phone</div>
        <div class="spacer"></div>
        <?php echo input_tag('home_phone', $user->getHomePhone()); ?> <?php echo form_error('home_phone'); ?> <?php echo checkbox_tag('show_home_phone', '1', $user->getShowHomePhone(),array('class'=>"chkbox")); ?>
        <div class="text" style="top:5px;">Make public</div>
        <div class="spacer"></div>
      </div>
      <div class="entry">
        <div class="ttle">Mobile Phone</div>
        <div class="spacer"></div>
        <?php echo input_tag('mobile_phone', $user->getMobilePhone()); ?> <?php echo form_error('mobile_phone'); ?> <?php echo checkbox_tag('show_mobile_phone', '1', $user->getShowMobilePhone(),array('class'=>"chkbox"));?>
        <div class="text" style="top:5px;">Make public</div>
        <div class="spacer"></div>
      </div>
      <div class="entry">
        <div class="ttle">Address</div>
        <div class="spacer"></div>
        <div class="txtareabg" style="height:83px; background:url(/images/edit-profile-addbg.gif) no-repeat"></div>
        <?php echo textarea_tag('address', $user->getAddress(),array('style'=>'height:57px;')); ?> <?php echo form_error('address'); ?> <?php echo checkbox_tag('show_address', '1', $user->getShowAddress(),array('class'=>"chkbox",'style'=>'top:30px; left:-295px; !left:-284px;')); ?>
        <div class="text" style="top:30px; left:-295px; !left:-284px;">Make public</div>
        <div class="spacer"></div>
      </div>
      <div class="entry">
        <div class="ttle">Home Town</div>
        <div class="spacer"></div>
        <?php echo input_tag('hometown', $user->getHometown()); ?> <?php echo form_error('hometown'); ?>
		
		<?php echo checkbox_tag('show_hometown', '1', $user->getShowHometown(),array('class'=>"chkbox")); ?>
        <div class="text" style="top:5px;">Make public</div>
        <div class="spacer"></div>
      </div>
    </div>
    <div class="bottom"></div>
  </div>
  <div class="spacer"></div>
  <div class="box">
    <div class="top"></div>
    <div class="content">
      <p style="text-align:left;padding-top:5px;font-size:18px;color:#1C517C;font-weight:bold;margin:5px 0 0 10px;">Additional Information</p>
      <div class="entry">
        <div class="ttle">Write a little about yourself</div>
        <div class="spacer"></div>
        <div class="txtareabg"></div>
        <?php echo textarea_tag('about_me', $user->getAboutMe()); ?> <?php echo form_error('about_me'); ?> 
        
        <!--<input type="checkbox" class="chkbox" checked="checked" style="top:50px; left:-295px; !left:-284px;" />
                                    <div class="text" style="top:52px; left:-295px; !left:-284px;">Display "a little about yourself" on public profile</div>-->
        <div class="text" style="top:52px; left:-295px; !left:-284px;"><em>must be displayed</em></div>
        <div class="spacer"></div>
      </div>
      <div class="entry">
        <div class="ttle">What are your Hobbies?</div>
        <div class="spacer"></div>
        <div class="txtareabg"></div>
        <?php echo textarea_tag('hobbies', $user->getInterestsAsString()); ?> <?php echo form_error('hobbies'); ?> <?php echo checkbox_tag('show_hobbies', '1', $user->getShowHobbies(),array('class'=>"chkbox",'style'=>'top:50px; left:-295px; !left:-284px;')); ?>
        <div class="text" style="top:52px; left:-295px; !left:-284px;">Make public</div>
        <div class="spacer"></div>
      </div>
      <!--<div class="entry">
        <div class="ttle">Relationship Status</div>
        <div class="spacer"></div>
        <div style="clear:left"> <?php echo enum_values_select_tag(get_class($user), 'RelationshipStatuse', $user->getRelationshipStatus()); ?> <?php echo form_error('relationshipStatuse'); ?> </div>
        <?php echo checkbox_tag('show_relationship_status', '1', $user->getShowRelationshipStatus(),array('class'=>"chkbox")); ?>
        <div class="text">Display "Relationship Status" on public profile</div>
        <div class="spacer"></div>
      </div>-->
    </div>
    <div class="bottom"></div>
    <div class="spacer"></div>
  </div>
  <?php echo submit_tag('Save your profile changes',array('id'=>'save','onClick' => 'return userNameCheck();')); ?>

  </form>
</div>
<?php 
	else:
	header('Location:'." http://".$_SERVER['HTTP_HOST']);
endif; ?>
