<div style="font-size:14px;color:#333;margin:0 100px">

<h1 style="font-size:18px;color:#900">Uh-oh... all experts are either busy or unavailable</h1>

<br /><br />Sometimes tutors are away from their computers and may have missed your question.<br /><br />

You can <a href="http://www.rayku.com/expertmanager/connectagain" name="Notify same tutor again">notify the same tutors again</a> or <a href="http://www.rayku.com/forum/newthread/<?php echo $_COOKIE['forumsub']; ?>" name="Post Question on Forum">ask the community forum</a>.<br />
<br /><br /><br /><br />
<a href="javascript:history.go(-2)">Go back</a>

<?php 
	
	//$_SESSION['dash_hidden'] = 1; 
	
	
	//$user = mysql_query("SELECT checked_id,source FROM student_questions WHERE user_id=".$userid."") or die(mysql_error());
	//$sourceval = mysql_fetch_array($user);
	//$source = $sourceval['source'];
	

	//if($source=='tutorlist') { ?>

	<!--<a href="http://www.rayku.com/tutors" name="Ask Again"><h2>Ask Again</h2></a>-->
	
<?php //} elseif($source=='expertmanager') { ?>
	
	<!--<a href="http://www.rayku.com/expertmanager/list" name="Ask Again"><h2>Ask Again</h2></a>-->

<?php //} elseif($source=='tutor') { 

	//$a=new Criteria();
	//$a->add(UserPeer::ID, $sourceval['checked_id']);
	//$tutor =UserPeer::doSelectOne($a);	?>
	
	<!--<a href="http://www.rayku.com/tutor/<?php //echo $tutor->getUsername(); ?>" name="Ask Again"><h2>Ask Again</h2></a>-->

<?php //} ?>

</div>
