<html>
<head>
<script type="text/javascript">
<!--
function delayer(){
    window.location = "../dashboard"
}
//-->
</script>

	<script type="text/javascript" src="/slider/js/jquery-ui-1.7.1.custom.min.js"></script>
	<script type="text/javascript" src="/slider/js/selectToUISlider.jQuery.js"></script>
	<link rel="stylesheet" href="/slider/css/redmond/jquery-ui-1.7.1.custom.css" type="text/css" />
	<link rel="Stylesheet" href="/slider/css/ui.slider.extras.css" type="text/css" />
	<style type="text/css">
		
		._fieldset { border:0; margin: 2em 2em 5em 100px; height: 12em;margin-left:100px;}	
		label {font-weight: normal; float: left; margin-right: .5em;  font-size: 2.1em;}
		select {margin-right: 1em; float: left;}
		.ui-slider {clear: both; top: 2em;}
		.option { color:#056AA4; font-size:18px; font-weight:bold; line-height:28px; }	

		.feedback { font-size:14px; font-weight:normal; padding:5px; width:610px; }

		.myButton{ background-color:#EDEDED;border:1px solid #7A7A7A;color:#777777;cursor:pointer;display:inline-block;font-family:arial;font-size:15px;font-weight:bold;line-height:18px;margin:4px 100px;text-decoration:none;text-shadow:1px 1px 0 #FFFFFF; }

	</style>
	<script type="text/javascript">
  var rayku_jquery = jQuery.noConflict();
		rayku_jquery(function(){
			//demo 1
			var abc = rayku_jquery('select#audio').selectToUISlider().next();

			var abcd = rayku_jquery('select#use').selectToUISlider().next();
	
			var abcf = rayku_jquery('select#overall').selectToUISlider().next();
					
		});

	</script>
</head>
<body>
<br/><br/><br/>
<label for="speed" style="color:#006699">Please describe the tutoring experience</label><br/><br/><br/>
<form action="/dashboard/thank" method="post">

		<!-- demo 1 -->
		
		<fieldset class="_fieldset">
	<label for="audio" style="color:#333;font-size:16px;font-weight:normal">How was the audio/video quality? </label>
			<select name="audio" id="audio" style="visibility:hidden;">
				<option value="1">Not Sure</option><option value="2">Excellent</option><option value="3">Good</option><option value="4">Fair</option><option value="5">Poor</option><option value="6">Bad</option>
			</select>
		</fieldset>

		<!-- demo 1 -->
			
		<fieldset class="_fieldset">
				<label for="use" style="color:#333;font-size:16px;font-weight:normal">How easy is it to use the whiteboard and the whiteboard functions?</label>
			<select name="use" id="use" style="visibility:hidden;">
				<option value="1">Not Sure</option><option value="2">Excellent</option><option value="3">Good</option><option value="4">Fair</option><option value="5">Poor</option><option value="6">Bad</option>
			</select>
		</fieldset>

		<!-- demo 1 -->

		<fieldset class="_fieldset">
				<label for="overall" style="color:#333;font-size:16px;font-weight:normal">How was the overall session experience?</label>
			<select name="overall" id="overall" style="visibility:hidden;">
				<option value="1">Not Sure</option><option value="2">Excellent</option><option value="3">Good</option><option value="4">Fair</option><option value="5">Poor</option><option value="6">Bad</option>
			</select>
		</fieldset>

		<fieldset class="_fieldset">
	<span class="option" style="color:#333;font-size:16px;font-weight:normal">Additional feedback:</span>
		     <p>
		       <textarea name="feedback" cols="145" rows="5" id="txtbox" class="feedback"></textarea>
		     </p>
		</fieldset>

	<input type="submit" value="Submit Feedback" style="font-size:16px;padding:4px;margin-left:80px;">
		
	</form>
</body>
</html>
