<?php 
$confirmed = "confirmedtutors.txt";
$fh = fopen($confirmed, 'a') or die("can't open file");
$stringData = $_GET["confirm"]."\n";
fwrite($fh, $stringData);
fclose($fh);
?>

<div style="width:600px;margin:50px auto;font-size:20px;font-family:Tahoma;">
	<strong>Thank you!</strong> We have logged your tutor account as 'active'!<br><br>
	<a href="http://rayku.com">Click here</a> to go back to Rayku.com.
	</div>