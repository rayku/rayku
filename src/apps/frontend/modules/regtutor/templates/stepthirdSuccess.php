
 <?php use_helper('MyForm', 'Javascript', 'Enum','Validation') ?>
 
 

    <link rel="stylesheet" type="text/css" href="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/styles/registerStep3.css" />
	
	<div id="body">
        <div id="top" style="margin-left:22px;margin-bottom:10px;padding-top:2px">
           <div style="background:url(../images/arrow-right.gif) no-repeat; padding-left:49px; color:#1C517C; font-size:16px; font-weight:bold">
             <p style="line-height:24px;">Add / Edit Profile Information</p></div>
                       </div>

                
			<div class="body-main">
					  
					    <?php echo form_tag('@register_step3', 'multipart=true') ?>
                        
                        <div class="box">
                       	  <div class="top-green"></div>
                            <div class="content-green">
                            	<span id="referaltext">Profile Picture Upload:</span>
                          		<?php //echo input_file_tag('file', $sf_params->get('file'),array('id' => 'referalinput')) ?>
                               
							   <input type="file" name="file" id="photoupload" value="<?=$sf_params->get('file')?>"> 

							    <div class="spacer"></div>
                          </div>

                            <div class="bottom-green"></div>
                            <div class="spacer"></div>
                      </div>
                      
					  <div class="box">
                       	<div class="top"></div>
                        <div class="content">
                            	<div class="title">Misc Information</div>
                          <div class="subtitle">Further customize your profile by filling these out!</div>

          <div class="entry">
          <div class="ttle">Date of birth</div>
          <div style="clear:left"> <?php echo input_date_tag('birthdate', null, array('year_end' => date('Y'), 'year_start' => date('Y') - 100,'date_seperator'=>'')) ?> </div>
          <div class="spacer"></div>
        </div>

                          <div class="entry">
                                  <div class="ttle">Gender</div>
                                  <div style="clear:left">
                                    <?php echo enum_values_select_tag(get_class($user), 'Gender', $user->getGender()) ?>

                                  </div>
                  </div>
                                <!--<div class="entry">
                                  <div class="ttle">Relationship Status</div>
                                  <div style="clear:left">
                                    <?php echo enum_values_select_tag(get_class($user), 'RelationshipStatuse', $user->getRelationshipStatus()) ?>
                                  </div>
                                </div>-->
<div class="entry">
                               	  <div class="ttle">Home Phone Number</div>
                                   <?php echo input_tag('home_phone', $user->getHomePhone()) ?>

                                    <div class="spacer"></div>
                          </div>
                          <div class="entry">
                           	<div class="ttle">Mobile Phone Number</div>
                                    <?php echo input_tag('mobile_phone', $user->getMobilePhone()) ?>
                                    <div class="spacer"></div>
                          </div>
                          <div class="entry">

                                  <div class="ttle">Hometown</div>
                                  <div>
                                   <?php echo input_tag('hometown', $user->getHometown()) ?>
                                  </div>
                                  <div class="spacer"></div>
                          </div>
                          <div class="entry">
                                  <div class="ttle">Address</div>
                                  <?php echo input_tag('address', $user->getAddress(), array('cols' => 50, 'rows' => 5)) ?>
                                  <div class="spacer"></div>
                          </div>
                        </div>
                            <div class="bottom"></div>
                            <div class="spacer"></div>

              </div>
											
						<?php echo submit_tag('Save &amp; Continue', array('style' => 'width:200px;height:40px; font:Arial, Helvetica, sans-serif; font-size:16px; margin-bottom:40px; font-weight:bold')) ?>
                        <input name="skip" type="button" onClick="javascript:window.location='http://www.rayku.com/profile/<?php echo $user->getUsername() ?>';" value="Go to your Profile Page" style="height:40px; font:Arial, Helvetica, sans-serif; font-size:16px; margin-bottom:40px; float:right" />
                     <div class="spacer"></div>
				 </form> 
				 
    </div>
				 
					<div class="body-side">
						<div class="box">
                        	<div class="top"></div>
              <div class="content" style="position:relative; _top:-3px; _bottom:-3px; padding-right:20px; width:264px">
								<div class="title" style="margin-top:0px;">Not Required for Rayku</div>
                                <div class="text">
                                Everything asked in the sections on your left, are NOT REQUIRED to complete your Rayku.com registration. Click <a href="http://www.rayku.com/dashboard" style="color:#069">here</a> to skip.</div>
                            </div>
                            <div class="bottom"></div>
                        </div>
                        </div>
                        </div>
                    					
      <br class="clear-both" />
