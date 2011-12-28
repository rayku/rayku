<?php 
error_reporting(E_ALL);
ini_set('display_errors',1);

	function getInterval($num = 0)
	{
		switch($num)
		{
			case 0:
				return "00:00AM-01:00AM";
			break;
			case 1:
				return "01:00AM-02:00AM";			
			break;
			case 2:
				return "02:00AM-03:00AM";			
			break;
			case 3:
				return "03:00AM-04:00AM";			
			break;
			case 4:
				return "04:00AM-05:00AM";
			break;
			case 5:
				return "05:00AM-06:00AM";
			break;
			case 6:
				return "06:00AM-07:00AM";
			break;
			case 7:
				return "07:00AM-08:00AM";
			break;
			case 8:
				return "08:00AM-09:00AM";
			break;
			case 9:
				return "09:00AM-10:00AM";
			break;
			case 10:
				return "10:00AM-11:00AM";
			break;
			case 11:
				return "11:00AM-12:00PM";
			break;
			case 12:
				return "12:00PM-01:00PM";
			break;
			case 13:
				return "01:00PM-02:00PM";
			break;
			case 14:
				return "02:00PM-03:00PM";
			break;
			case 15:
				return "03:00PM-04:00PM";
			break;
			case 16:
				return "04:00PM-05:00PM";
			break;
			case 17:
				return "05:00PM-06:00PM";
			break;
			case 18:
				return "06:00PM-07:00PM";
			break;
			case 19:
				return "07:00PM-08:00PM";
			break;
			case 20:
				return "08:00PM-09:00PM";
			break;
			case 21:
				return "09:00PM-10:00PM";
			break;
			case 22:
				return "10:00PM-11:00PM";
			break;
			case 23:
				return "11:00PM-00:00PM";
			break;
		
		}
	}

?>
<?php 

		$c = new Criteria();
		$c->add(ExpertLessonSchedulePeer::DATE, $date);
		$c->add(ExpertLessonSchedulePeer::EXPERT_LESSON_ID, $sf_user->getAttribute('expert_lesson_id'));
		
		$check_date = ExpertLessonSchedulePeer::doSelectOne($c);
		
		$timings = array();
		
		if(count($check_date) > 0)
		{
			$timings = explode("|",$check_date->getTimings());
		}
		
		$s = array();
		
		foreach($timings as $t)
		{
			$s[] = "<input type=\"checkbox\" name=\"timings[]\" value=\"$t\" checked=\"checked\" />".getInterval($t);	
		}		
		
		//$timing = array_merge($timings, $timing);
?>





<?php echo "Date Selected : ".date("m-d-Y",$date)."<br />"; ?>
<input type="hidden" name="date" value="<?php echo $date; ?>" />
<?php echo "Timings Selected :<br />"; ?>

<table width="100%">
<?php if(count($s) > 0): ?>
	<?php foreach($s as $string): ?>
		<tr><font style="background-color:#009900; color:#FFFFFF; font-weight:bold;"><?php echo $string; ?></font></tr>
	<?php endforeach; ?>
<?php endif; ?>

<?php if(count($timing) > 0): ?>
	<?php foreach($timing as $time): ?>
		<tr><input type="checkbox" name="timings[]" value="<?php echo $time;?>"/><?php echo getInterval($time); ?></tr>
	<?php endforeach; ?>
<?php endif; ?>
</table>