

<?php
$latestUser = UserPeer::getNewestUser();
?>

<?php
$connection = RaykuCommon::getDatabaseConnection();

$query = mysql_query("select * from user_score where score=(select max(score) from user_score)") or die(mysql_error());
$score = mysql_fetch_assoc($query);


$queryPoints = mysql_query("select * from user where points=(select max(points) from user)") or die(mysql_error());
$rowPoitns = mysql_fetch_assoc($queryPoints);


$query2 = mysql_query("select * from user where id=".$score['user_id']) or die(mysql_error());
$score2 = mysql_fetch_assoc($query2);

$c=new Criteria();
$c->add(UserPeer::ID,$score['user_id']);
$experts=UserPeer::doSelectOne($c);


?>

<h2> 

<?php

$a = array("score"=>"score","points"=>"points");

if(array_rand($a,1) == "score") {


?>


<span class="live-feed" style="font-size:16px;line-height:30px;"><strong>Top Expert: </strong></span> 

<span class="newest">
<a href="/expertmanager/portfolio/<?php echo $experts->getUsername() ?>"><strong><?php echo $score2['name'];?><?php //echo $score2['name'];?> </strong> with <strong ><?php echo $score['score']; ?>ES</strong>, from <strong>University of Toronto</strong></a>
  
  </span> 


<?php } else { ?>

<span class="live-feed" style="font-size:16px;line-height:30px;"><strong>Richest User: </strong></span> 

<span class="newest">

<a href="http://www.rayku.com/profile/<?php echo $rowPoitns['username']; ?>"><strong><?php echo $rowPoitns['name'];?></strong> with <strong><?php echo $rowPoitns['points']; ?>RP</strong>, from <strong>University of Toronto</strong></a>

  
  </span> 

<?php } ?>
  
  </h2>
  
  <?php
    $browser = get_browser();
    if($browser->browser == 'Firefox') {
    } else {
        echo'<!--<p>Rayku.com is best viewed with Firefox<img src="http://www.rayku.com/images/fficon.png" style="border:none;position:static;margin-left:5px;vertical-align:text-bottom"></p>-->';
    }
?>