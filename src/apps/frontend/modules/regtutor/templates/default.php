 <?php use_helper('MyForm', 'Javascript', 'Enum','Validation') ?>

    <link rel="stylesheet" type="text/css" href="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/styles/registerStep3.css" />
	
	<div id="body">
        <div id="top" style="margin-top:40px">
         
               
                
			<div class="body-main">
					  
                      
					 	<div class="box">
					    <div class="top"></div>
					    <div class="content">
					      <div class="title"> Add Other Information </div>

					   <!--   <div class="subtitle">Fill out as much info as you can below, and show off your true colors on your profile, while making it easier for your friends to find you on Rayku.com! The information below will be displayed on your public profile.</div>-->

                        </div>
					    <div class="bottom"></div>
				      </div>
					  
					  
                                               
<div class="entry">
                               	  <div class="ttle">Course Subject</div>
                                   <?php echo input_tag('home_phone', $user->getHomePhone()) ?>

                                    <div class="spacer"></div>
                          </div>
                          <div class="entry">
                           	<div class="ttle">Course Name</div>
                                    <?php echo input_tag('mobile_phone', $user->getMobilePhone()) ?>
                                    <div class="spacer"></div>
                          </div>
                          <div class="entry">

                                  <div class="ttle">Year taken</div>
                                  <div>
                                   <?php echo input_tag('hometown', $user->getHometown()) ?>
                                  </div>
                                  <div class="spacer"></div>
                          </div>
                          <div class="entry">
                                  <div class="ttle">Performance</div>
                                  <?php echo input_tag('address', $user->getAddress(), array('cols' => 50, 'rows' => 5)) ?>
                                  <div class="spacer"></div>
                          </div>
                        </div>
                            <div class="bottom"></div>
                            <div class="spacer"></div>

              </div>
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
											
						<?php echo submit_tag('Save &amp; Continue', array('style' => 'width:200px;height:40px; font:Arial, Helvetica, sans-serif; font-size:16px; margin-bottom:40px; font-weight:bold')) ?>
                        <input name="skip" type="button" onClick="javascript:window.location='http://www.rayku.com/dashboard';" value="Skip (Don't Save)" style="height:40px; font:Arial, Helvetica, sans-serif; font-size:16px; margin-bottom:40px; float:right" />
                        <div class="spacer"></div>
				 </form> 
				 
    </div>
				 
				
