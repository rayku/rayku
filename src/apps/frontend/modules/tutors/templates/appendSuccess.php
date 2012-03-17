<script type="text/javascript">
set_background();
</script>
<?php
$connection = RaykuCommon::getDatabaseConnection();
$logedUserId = $_SESSION['symfony/user/sfUser/attributes']['symfony/user/sfUser/attributes']['user_id'];

usort($rankCheckUsers, "cmp");

function cmp($a, $b)
{
    if ($a["score"] == $b["score"]) {
        return strcmp($a["createdat"], $b["createdat"]);
    }
    return ($a["score"] < $b["score"]) ? 1 : -1;

} ?>
<?php if ($cat != NULL) { ?>
<?php if (count($expert_cats) >= 1 ) {

    $_SESSION['temp1'] = array();

    $i =0;
    $j =0;
    $k =0;

    usort($expert_cats, "cmp");
    $_dv = 0;  $_vd = 0; $_ddv = 0; $_vdd = 0; $finalOnlineusers = ''; $finalOfflineusers  = ''; $_FinalUsers = '';
    $_dvk = 0; $_vkd = 0;
    if (empty($_COOKIE["onoff"]) && !empty($_SESSION["rateDisplay"]) ) {
        foreach($newOnlineUser as $key => $user) {
            $query = mysql_query("select * from user_rate where userid=".$user['userid']." and (rate = 0.00 || rate = 0) ", $connection) or die("Error In rate".mysql_error());
            if (mysql_num_rows($query) > 0) {
                $_emptyOnlineUsers[$_dv] = array("score" => $user['score'], "userid" => $user['userid'], "category" => $user['category']);
                $_dv++;
            } else {
                $_rateOnlineUsers[$_vd] = array("score" => $user['score'], "userid" => $user['userid'], "category" => $user['category']);
                $_vd++;
            }
        }
        if (@$_emptyOnlineUsers) {
            asort($_emptyOnlineUsers);
        }
        if (@$_emptyOnlineUsers) {
            arsort($_emptyOnlineUsers);
        }
        if (@$_rateOnlineUsers) {
            asort($_rateOnlineUsers);
        }
        if (@$_rateOnlineUsers) {
            arsort($_rateOnlineUsers);
        }

        if (!empty($_emptyOnlineUsers) && !empty($_rateOnlineUsers)) {
            $finalOnlineusers = array_merge($_emptyOnlineUsers,$_rateOnlineUsers);
        } else if (empty($_emptyOnlineUsers) && !empty($_rateOnlineUsers)) {
            $finalOnlineusers = $_rateOnlineUsers;
        } else if (!empty($_emptyOnlineUsers) && empty($_rateOnlineUsers)) {
            $finalOnlineusers = $_emptyOnlineUsers;
        }
        foreach($newOfflineUser as $key => $user) {
            $query = mysql_query("select * from user_rate where userid=".$user['userid']." and (rate = 0.00 || rate = 0) ", $connection) or die("Error In rate".mysql_error());
            if (mysql_num_rows($query) > 0) {
                $_emptyOfflineUsers[$_ddv] = array("score" => $user['score'], "userid" => $user['userid'], "category" => $user['category']);
                $_ddv++;
            } else {
                $_rateOfflineUsers[$_vdd] = array("score" => $user['score'], "userid" => $user['userid'], "category" => $user['category']);
                $_vdd++;
            }
        }
        if (@$_emptyOfflineUsers) {
            asort($_emptyOfflineUsers);
        }
        if (@$_emptyOfflineUsers) {
            arsort($_emptyOfflineUsers);
        }
        if (@$_rateOfflineUsers) {
            asort($_rateOfflineUsers);
        }
        if (@$_rateOfflineUsers) {
            arsort($_rateOfflineUsers);
        }

        if (!empty($_emptyOfflineUsers) && !empty($_rateOfflineUsers)) {
            $finalOfflineusers = array_merge($_emptyOfflineUsers,$_rateOfflineUsers);
        } else if (empty($_emptyOfflineUsers) && !empty($_rateOfflineUsers)) {
            $finalOfflineusers = $_rateOfflineUsers;
        } else if (!empty($_emptyOfflineUsers) && empty($_rateOfflineUsers)) {
            $finalOfflineusers = $_emptyOfflineUsers;
        }
        if (!empty($finalOnlineusers) && !empty($finalOfflineusers)) {
            $_FinalUsers = array_merge($finalOnlineusers,$finalOfflineusers);
        } else if (empty($finalOnlineusers) && !empty($finalOfflineusers)) {
            $_FinalUsers = $finalOfflineusers;
        } else if (!empty($finalOnlineusers) && empty($finalOfflineusers)) {
            $_FinalUsers = $finalOnlineusers;
        }
    } elseif (!empty($_COOKIE["onoff"]) && !empty($_SESSION["rateDisplay"]) ) {
        foreach($expert_cats as $key => $user) {
            $query = mysql_query("select * from user_rate where userid=".$user['userid']." and (rate = 0.00 || rate = 0) ", $connection) or die("Error In rate".mysql_error());
            if (mysql_num_rows($query) > 0) {
                $_emptyNormalUsers[$_dvk] = array("score" => $user['score'], "userid" => $user['userid'], "category" => $user['category']);
                $_dvk++;
            } else {
                $_rateNormalUsers[$_vkd] = array("score" => $user['score'], "userid" => $user['userid'], "category" => $user['category']);
                $_vkd++;
            }
        }
        asort($_emptyNormalUsers);
        arsort($_emptyNormalUsers);
        asort($_rateNormalUsers);
        arsort($_rateNormalUsers);
        if (!empty($_emptyNormalUsers) && !empty($_rateNormalUsers)) {
            $_FinalUsers = array_merge($_emptyNormalUsers,$_rateNormalUsers);
        } else if (empty($_emptyNormalUsers) && !empty($_rateNormalUsers)) {
            $_FinalUsers = $_rateNormalUsers;
        } else if (!empty($_emptyNormalUsers) && empty($_rateNormalUsers)) {
            $_FinalUsers = $_emptyNormalUsers;
        }
    } else {
        $_FinalUsers = $expert_cats;
    }
    if (!empty($_REQUEST['show_more_post'])) {
        $next_records=$_REQUEST['show_more_post'];
    } else {
        $next_records=15;
    }

    $_count_online_user = 0;
    $_count_check = is_array(@$_finalUsers) ? count($_finalUsers) : 0;
    $_v = 1;

    $sample = array_slice($_FinalUsers,0,$next_records);
    $_finalUsers = $sample;
    function getTitlePre($role)
    {
        $verb = '';
        switch ($role) {
        case 'Freshman':
        case 'Sophomore':
        case 'Junior':
        case 'Senior':
        case 'Masters Student':
        case 'Phd Candidate':
            $verb = 'studying';
            break;

        case 'Masters Degree Holder':
        case 'Undergrad Degree Holder':
        case 'Phd Degree Holder':
            $verb = 'having studied';
            break;

        case 'Teaching Assistant':
        case 'Professor':
        case 'Middle School Teacher':
        case 'High School Teacher':
            $verb = 'teaching';
            break;
        }
        return $verb;
    }


    foreach($_finalUsers as $newOne) {
        $xy =  $newOne['userid'];

        $sfcategory = $newOne['category'];
        $c=new Criteria();
        $c->add(UserPeer::ID,$newOne['userid']);
        $experts=UserPeer::doSelectOne($c);

        if ($sfcategory == 5) {

            $query3 = mysql_query("select * from user_course where user_id=".$newOne['userid']." ", $connection) or die(mysql_error());
            $detail3=mysql_fetch_assoc($query3);


            $allsub = "General"." Student (Year: ".$detail3['course_year'].")";

        } else {
            $query3 = mysql_query("select * from user_course where user_id=".$newOne['userid']." AND course_subject=".$sfcategory, $connection) or die(mysql_error());
            $detail3  =mysql_fetch_assoc($query3);

            $titSQL = "SELECT `tutor_role`,`school`,`study` FROM `tutor_profile` WHERE `user_id` = ".$newOne['userid']."";
            $titRes = mysql_query($titSQL, $connection);
            $allsub		= "";
            if (mysql_num_rows($titRes)){
                $tutData 	= mysql_fetch_assoc($titRes);
                $allsub		= @$tutData['tutor_title'];
                if ($tutData['tutor_role'] != ''){
                    $allsub		.= $tutData['tutor_role'];
                    if ($tutData['school'] != ''){
                        $allsub		.= " at ".$tutData['school'];
                    }
                    if ($tutData['study'] != ''){
                        $allsub		.= " ".getTitlePre($tutData['tutor_role'])." ".$tutData['study'];
                    }
                }
            }

            if ($allsub==""){
                $query4 = mysql_query("select * from user_course where user_id=".$newOne['userid']." AND course_subject=".$sfcategory, $connection) or die(mysql_error());
                $allsub=" ";
                while ($row = mysql_fetch_array($query4, MYSQL_NUM)) {
                    if ($allsub==" ") {
                        $allsub=$row[3];
                    } else {
                        $allsub=$allsub." | ".$row[3];
                    }
                }
                $allsub = $allsub." Student (Year: ".$detail3['course_year'].")";
            }
        }
        $query5 = mysql_query("select * from user_rate where userid=".$newOne['userid']." ", $connection) or die(mysql_error());
        if (mysql_num_rows($query5) > 0) {
            $rowValues = mysql_fetch_assoc($query5);
            $rate = $rowValues['rate']."RP";
        } else {
            $rate = "0.00RP";
        }

        $curr_user_rank=''; $ij =1;
        foreach ($_finalUsers as $_expert) {
            if ($_expert['userid'] == $experts->getId()) {
                $curr_user_rank=$ij;
                break;
            }
            $ij++;
        }

        if (strlen($allsub) > 100) {
            $allsub = substr($allsub,0,100);
            $allsub =  $allsub." ...";
        }

        $onlinecheck = '';
        if (in_array($experts->getId(),$_checkOnlineUsers)) {
            $onlinecheck = "online";
        }

        if (isset($_COOKIE["onoff"]) && $_COOKIE["onoff"] == 1) {
            $onlinecheck = "online";
        } elseif (isset($_COOKIE["onoff"]) && $_COOKIE["onoff"] == 2) {
            $onlinecheck = "";
        }
?>

<div id="resultpage">
  <div class="cn-result"  id="<?php echo 'first'.$xy; ?>">
    <div  id="<?php echo $xy.'.1'; ?>" class="cn-column-one"  onclick="rowCheck(this.id)" style="padding-right:15px;width:500px;">
      <p id="<?php echo $xy.'.2'; ?>"  class="cn-title"  onclick="rowCheck(this.id)">
      <div id="<?php echo $xy.'.3'; ?>"  class="cn-user-info" onclick="rowCheck(this.id)" style="float:right;width:150px;line-height:14px" align="right"><strong style="color:#069"></strong>
        <?php if ($onlinecheck == "online") { ?>
        <?php if ($experts->getType() == 5) { ?>
        <img src="http://www.rayku.com/images/expert_saved.png" alt="Rayku Staff" />
        <?php } ?>
        <a href="/tutor/<?php echo $experts->getUsername()?>" target="_blank" style="color:#8FAFC8"><?php echo $experts->getName()?> <span class="onlinenow">(online)</span></a>
        <?php } else { ?>
        <?php if ($experts->getType() == 5) { ?>
        <img src="http://www.rayku.com/images/expert_saved.png" alt="Rayku Staff" />
        <?php } ?>
        <a href="/tutor/<?php echo $experts->getUsername()?>" target="_blank" style="color:#8FAFC8"><?php echo $experts->getName()?> <span class="offlinenow">(offline)</span></a>
        <?php } ?>
      </div>
      <?php if (($experts->getType() == 5)) : ?>
      <div style="float:left;height:50px;line-height:20px;width:50px;border-right:1px solid #CFD0D2;" align="center"><strong>#<?php echo $curr_user_rank; ?></strong></div>
      <?php elseif ($curr_user_rank <= 10) : ?>
      <div style='float:left;height:50px;line-height:20px;width:50px;border-right:1px solid #CFD0D2;' align="center"><strong>#<?php echo $curr_user_rank; ?></strong></div>
      <?php elseif ($curr_user_rank > 10) : ?>
      <div style='float:left;height:50px;line-height:20px;width:50px;border-right:1px solid #CFD0D2;' align="center">#<?php echo $curr_user_rank; ?></div>
      <?php endif; ?>
      <div style="padding-left:60px;"> <u><a href="javascript:void(0);" title="Click to Select"><?php echo $allsub;?></a></u></div>
      </p>
    </div>
    <div id="<?php echo $xy.'.4'; ?>"  class="cn-column-two" align="center">
      <p class="cn-expertscore" style="font-size:13px;color:#333"> <?php echo $rate; ?></p>
    </div>
    <div class="cn-column-four">
      <p class="cn-pricepermin" align="center" style="margin-top:10px">
<?php
        $query = mysql_query("select * from popup_close where user_id=".$newOne['userid'], $connection) or die(mysql_error());
        $newFlag = '';
        if (mysql_num_rows($query) > 0) {
            $newFlag = 1;
        } else {
            $newFlag = 2;
        }
        if ($onlinecheck == "online") {
            $criteria = new Criteria();
            $criteria->add(WhiteboardSessionPeer::USER_ID, $newOne['userid']);
            $criteria->addDescendingOrderByColumn(WhiteboardSessionPeer::LAST_ACTIVITY);
            $lastSession = WhiteboardSessionPeer::doSelectOne($criteria);

            if ($lastSession != null && $lastSession->stillActive()) {
?>
        <a href="/message/compose/<?php echo $experts->getUsername(); ?>"><img alt="in session" src="/images/em-busy.jpg"></a>
<?php
            } else {
                $_count_online_user += 1;
                $totcook = @$_COOKIE['cookcount'];
                $w=1;
                for($u=1;$u<=$totcook;$u++) {
                    $cookval.$w = @$_COOKIE['tutor_'.$u];
                    $cookvalue = $cookval.$w;
                    if ($cookvalue) {
                        if ($cookvalue == $xy) {
                            $cookiy = $cookvalue;
                        } else {
                            $w++;
                        }
                    }
                }

                $isfound=$_SESSION['symfony/user/sfUser/attributes']['symfony/user/sfUser/attributes']['user_id'];
                if ($isfound!=$newOne['userid']) {
?>
        <input type="checkbox" name="checkbox[]" id="checkbox_<?php echo $xy?>" value="<?php echo $newOne['userid']; ?>" onclick="setvalue(this.id)" style="background-color:#DEF3FE;border:1px solid red;" <?php echo (@$cookiy==$newOne['userid'])?"checked='checked'":""; ?> />

<?php
                }
            }
        } else {
?>
        <a href="/message/compose/<?php echo $experts->getUsername(); ?>"><img height="18" width="59" alt="" src="/images/em-email.jpg"></a>
        <?php } ?>
    </div>
    <div> </div>
    <div class="clear-both"></div>
  </div>
<?php $_SESSION['temp1'][$newOne['userid']]=1;

if ($_count_check == $_v) {
    echo "<input type='hidden' name='online_user' id='online_user' value='".$_count_online_user."' >";
}

$_v++;
    }
?>
  <?php } else { ?>
<?php

    if ($_COOKIE["onoff"] == 1) {

        if (!empty($_COOKIE["school"])) {?>
  <p class="cn-pricepermin" align="center" style="margin-top:10px"> No online tutors found for this category with the criteria of School level.... </p>
  <?php } else {?>
  <p class="cn-pricepermin" align="center" style="margin-top:10px"> No online tutors found for this category.... </p>
<?php }
    }  else if ($_COOKIE["onoff"] == 2) {

        if (!empty($_COOKIE["school"])) { ?>
  <p class="cn-pricepermin" align="center" style="margin-top:10px"> No offline tutors found for this category with the criteria of School level.... </p>
  <?php } else { ?>
  <p class="cn-pricepermin" align="center" style="margin-top:10px"> No offline tutors found for this category.... </p>
<?php }

    } else {
        if (!empty($_COOKIE["school"])) { ?>
  <p class="cn-pricepermin" align="center" style="margin-top:10px"> No tutors found for this category with the criteria of School Level.... </p>
  <?php }   else {  ?>
      <p class="cn-pricepermin" align="center" style="margin-top:10px"> No offline tutors found for this category.... </p>
      <?php } ?>

<?php } ?>
  <div class="clear-both"></div>
  <? } ?>
  <?php } else { ?>
  <p class="cn-pricepermin" align="center" style="margin-top:10px"> No tutors found </p>
  <p class="cn-pricepermin" align="center" style="margin-top:10px; color:#C30"> Please select a category from the category list </p>
  <div class="clear-both"></div>
  <?php } ?>
</div>
<?php
            if (!empty($_REQUEST['show_more_post'])) {
                $next_records = $_REQUEST['show_more_post'] + 10;
            } else {
                $next_records = 15;
            }

        if (count($_FinalUsers)>15) {
            if (count($sample)!=count($_FinalUsers)) {
?>
<div style="width:100%;font-size:20px;line-height:35px;" align="right">
  <div id="bottomMoreButton"> <img src="/images/ajax-loader.gif" style="display:none" class="spinner" /> <a id="more_<?php echo @$next_records?>" class="more_records" name="2" href="javascript: void(0)">show more listings</a> </div>
</div>
<?php 	}
        }
?>
        <script type="text/javascript">
        reSet(0);
        </script>
