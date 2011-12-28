<?php
session_start();

error_reporting(0);
$w = (int)$_POST['width'];
$h = (int)$_POST['height'];
$img = imagecreatetruecolor($w, $h);
imagefill($img, 0, 0, 0xFFFFFF);
$rows = 0;
$cols = 0;
for($rows = 0; $rows < $h; $rows++){
	$c_row = explode(",", $_POST['px' . $rows]);
	for($cols = 0; $cols < $w; $cols++){
		$value = $c_row[$cols];
		if($value != ""){
			$hex = $value;
			while(strlen($hex) < 6){
				$hex = "0" . $hex;
			}
			$r = hexdec(substr($hex, 0, 2));
			$g = hexdec(substr($hex, 2, 2));
			$b = hexdec(substr($hex, 4, 2));
			$test = imagecolorallocate($img, $r, $g, $b);
			imagesetpixel($img, $cols, $rows, $test);
		}
	}
}


$time = time()+1;

$_SESSION['classroom_image']=$time.".jpg";

echo $_SESSION['classroom_image'];

$filename = "stored/".$time.".jpg";
imagejpeg($img, "$filename", 100);
imagedestroy($img);

//echo "The banner was saved at <a href=\"http://demo.turnkey-buddy.com/leaderboard_banner/stored/".$time.".jpg\">this location</a>";

echo "Your classroom banner has been Created successfully";

// the code below is for download usage - uncomment to use
//header("Content-type:image/jpeg");
//header('Content-Disposition: attachment; filename="banner.jpg"');
//imagejpeg($img, "", 100);
?>