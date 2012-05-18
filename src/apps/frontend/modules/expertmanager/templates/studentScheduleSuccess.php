<link href="http://<?php echo RaykuCommon::getCurrentHttpDomain(); ?>/styles/ex_donny.css" type="text/css" rel="stylesheet" />

<div class="body-main">

	<div id="top">
	<div class="title" style="float:left"><img src="<?php echo image_path('arrow-right.gif', false); ?>" alt="" /><p>Schedules</p></div>
	<div class="spacer"></div>
	</div> 


<br />
<br />
 

		<?php echo form_tag('expertmanager/senttoexpert'); ?>
		<input type="hidden" name="expid" value="<?=$expid?>" />
		<input type="hidden" name="date" value="<?=$sdate?>" />
		<input type="hidden" name="lessid" value="<?=$lessid?>" />
		<div class="spacer"></div>
			
			<div class="box">
			<div class="top"></div>
			<div class="content2" style="padding:0 18px 10px 18px; width:601px " >
			
			<h1> Expert is available on <?php echo date('Y-m-d',$sdate); ?> </h1>
			
			<br />
			
			<h1>You can select any one of the below time for the above specified date.</h1>
			
			<br />
			
			
			<?php 

					$values=explode("|",$lessondates->getTimings()); 
					
					foreach($values as $value):
						
								
					if($value == '0') { echo '<label><input type="radio" name="time" value="0" />0am-1am</label>'.'<br>'; }
					if($value == '1') { echo '<label><input type="radio" name="time" value="1" />1am-2am</label>'.'<br>'; }
					if($value == '2') { echo '<label><input type="radio" name="time" value="2" />2am-3am</label>'.'<br>'; }
					if($value == '3') { echo '<label><input type="radio" name="time" value="3" />3am-4am</label>'.'<br>'; }
					if($value == '4') { echo '<label><input type="radio" name="time" value="4" />4am-5am</label>'.'<br>'; }
					if($value == '5') { echo '<label><input type="radio" name="time" value="5" />5am-6am</label>'.'<br>'; }
					if($value == '6') { echo '<label><input type="radio" name="time" value="6" />6am-7am</label>'.'<br>'; }
					if($value == '7') { echo '<label><input type="radio" name="time" value="7" />7am-8am</label>'.'<br>'; }
					if($value == '8') { echo '<label><input type="radio" name="time" value="8" />8am-9am</label>'.'<br>'; }
					if($value == '9') { echo '<label><input type="radio" name="time" value="9" />9am-10am</label>'.'<br>'; }
					if($value == '10') { echo '<label><input type="radio" name="time" value="10" />10am-11am</label>'.'<br>'; }
					if($value == '11') { echo '<label><input type="radio" name="time" value="11" />11am-12pm</label>'.'<br>'; }
					if($value == '12') { echo '<label><input type="radio" name="time" value="12" />12pm-1pm</label>'.'<br>'; }
					if($value == '13') { echo '<label><input type="radio" name="time" value="13" />1pm-2pm</label>'.'<br>'; }
					if($value == '14') { echo '<label><input type="radio" name="time" value="14" />2pm-3pm</label>'.'<br>'; }
					if($value == '15') { echo '<label><input type="radio" name="time" value="15" />3pm-4pm</label>'.'<br>'; }
					if($value == '16') { echo '<label><input type="radio" name="time" value="16" />4pm-5pm</label>'.'<br>'; }
					if($value == '17') { echo '<label><input type="radio" name="time" value="17" />5pm-6pm</label>'.'<br>'; }
					if($value == '18') { echo '<label><input type="radio" name="time" value="18" />6pm-7pm</label>'.'<br>'; }
					if($value == '19') { echo '<label><input type="radio" name="time" value="19" />7pm-8pm</label>'.'<br>'; }
					if($value == '20') { echo '<label><input type="radio" name="time" value="20" />8pm-9pm</label>'.'<br>'; }
					if($value == '21') { echo '<label><input type="radio" name="time" value="21" />9pm-10pm</label>'.'<br>'; }
					if($value == '22') { echo '<label><input type="radio" name="time" value="22" />10pm-11pm</label>'.'<br>'; }
					if($value == '23') { echo '<label><input type="radio" name="time" value="23" />11pm-12pm</label>'.'<br>'; }
			
					endforeach;
				
			
			?>
			
			<br />
			
			<h1>Message.</h1>
			
			<textarea name="message" rows="5" cols="50"></textarea>
			
			<br /><br />
			
			<input type="submit" value="send" name="send" />
			
			</div>
			<div class="bottom"></div>
			
			</div>
			
			
			</form>
					
					


</div>


