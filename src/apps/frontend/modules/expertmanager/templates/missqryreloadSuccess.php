<div id="popup_data">
<?php 
$sel_misqry = mysql_query("SELECT * FROM missed_question_info WHERE send_user='".$raykuUser->getUsername()."' ORDER BY question_id desc");
$misqry = mysql_fetch_array($sel_misqry);
if($misqry['send_user'])
{
	echo $misqry['question']; ?><?php echo ' | '.$misqry['send_user']; ?><br/>
	
	<?php echo ' | '.$misqry['category'];  ?><?php echo ' |  Year: '.$misqry['year']; ?><br/>
	<?php echo ' | '.$misqry['course']; ?><?php echo ' | '.$misqry['school']; ?><br/>
	<a href="../../message/compose/<?php echo $misqry['ask_user']; ?>"><img height="18" width="59" alt="" src="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/images/em-email.jpg"></a>
	<input type="hidden" name="qid" id="qid" value="<?php echo $misqry['question_id']; ?>" />
	
<?php } ?>
</div>
