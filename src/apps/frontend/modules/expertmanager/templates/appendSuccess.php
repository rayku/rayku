<div id="resultpage">
<?php
$logedUserId = $_SESSION['symfony/user/sfUser/attributes']['symfony/user/sfUser/attributes']['user_id'];
usort($rankCheckUsers, "cmp");
function cmp($a, $b)
{
    if ($a["score"] == $b["score"]) {
        return strcmp($a["createdat"], $b["createdat"]);
    }
    return ($a["score"] < $b["score"]) ? 1 : -1;
}
if ($cat != NULL) {
    if (count($expert_cats) >= 1 ) {
        $_SESSION['temp1'] = array();
        $i =0;  $j =0;  $k =0;
        $_l = 1; $_h = 1; $_Tutor = array(); 	$_NonTutor = array();
        if (empty($_COOKIE["onoff"])) {
            $_all_users = $newOnlineUser;
        } else {
            $_all_users = $expert_cats;
        }
        foreach ($_all_users as $key => $user) {
            $_user = UserPeer::retrieveByPk($user['userid']);
            if ($_user->getType() == 5) {
                $_Tutor[$_l] = array("score" => $user['score'], "userid" => $user['userid'], "category" => $user['category']);
                $_l++;
            } else {
                $_NonTutor[$_h] = array("score" => $user['score'], "userid" => $user['userid'], "category" => $user['category']);
                $_h++;
            }
        }
        asort($_Tutor);  arsort($_Tutor); asort($_NonTutor);   arsort($_NonTutor);
        $_dv = 1;  $_vd = 1;
        foreach ($_NonTutor as $key => $user) {
            $query = mysql_query("select * from user_rate where userid=".$user['userid']." and (rate = 0.00 || rate = 0) ") or die("Error In rate".mysql_error());
            if (mysql_num_rows($query) > 0) {
                $_emptyRateUsers[$_dv] = array("score" => $user['score'], "userid" => $user['userid'], "category" => $user['category']);
                $_dv++;
            } else {
                $_rateUsers[$_vd] = array("score" => $user['score'], "userid" => $user['userid'], "category" => $user['category']);
                $_vd++;
            }
        }
        $finalusers = array(); $fianl_users = array(); $_fianl_users = array(); $_dd =1;  $_vx = 1;
        $rateUsersCount = @count($_rateUsers);
        if ($rateUsersCount > 3) {
            foreach ($_rateUsers as $key => $user) {
                if ($_dd%4==0 && $_vx <= 3 && !empty($_emptyRateUsers)) {
                    $fianl_users[$_dd] = $_emptyRateUsers[$_vx];
                    unset($_emptyRateUsers[$_vx]);
                    $_vx++; $_dd++;
                } elseif ($_dd%4==0 && $_vx > 3 && !empty($_emptyRateUsers)) {
                    $fianl_users[$_dd] = $_emptyRateUsers[$_vx];
                    unset($_emptyRateUsers[$_vx]);
                    $_vx++; $_dd++;
                }
                $fianl_users[$_dd] = array("score" => $user['score'], "userid" => $user['userid'], "category" => $user['category']);
                $_dd++;
            }
            if (!empty($_emptyRateUsers)) {
                $finalusers = array_merge($fianl_users,$_emptyRateUsers);
            } else {
                $finalusers = $fianl_users;
            }
        } else {
            if (!empty($_emptyRateUsers) && !empty($_rateUsers)) {
                $finalusers = array_merge($_rateUsers,$_emptyRateUsers);
            } else if (empty($_emptyRateUsers) && !empty($_rateUsers)) {
                $finalusers = $_rateUsers;
            } else if (!empty($_emptyRateUsers) && empty($_rateUsers)) {
                $finalusers = $_emptyRateUsers;
            }
        }
        if (empty($_COOKIE["onoff"])) {
            asort($newOfflineUser);
            arsort($newOfflineUser);
            $newUser = array();
            if (!empty($_Tutor) && !empty($finalusers)) {
                $newUser = array_merge($_Tutor,$finalusers,$newOfflineUser);
            } else if (!empty($_Tutor) && empty($finalusers)) {
                $newUser = array_merge($_Tutor,$newOfflineUser);
            } else if (empty($_Tutor) && !empty($finalusers)) {
                $newUser = array_merge($finalusers,$newOfflineUser);
            } else if (empty($_Tutor) && empty($finalusers)) {
                $newUser = $newOfflineUser;
            }
        } else {
            $newUser = array();
            if (!empty($_Tutor) && !empty($finalusers)) {
                $newUser = array_merge($_Tutor,$finalusers);
            } else if (!empty($_Tutor) && empty($finalusers)) {
                $newUser = $_Tutor;
            } else if (empty($_Tutor) && !empty($finalusers)) {
                $newUser = $finalusers;
            }
        }

        $rankUsers = $newUser;
        asort($rankUsers); arsort($rankUsers);

        /*	$_total = $_pageNavigation * 15;
        $_start = $_total - 15;  $_end = $_total - 1; */
        if (!empty($_REQUEST['show_more_post'])) {
            $next_records=$_REQUEST['show_more_post'];
        } else {
            $next_records=15;
        }
        $sample = array_slice($newUser,0,$next_records);
        $_finalUsers = $sample;

        $_count_online_user = 0;
        $_count_check = count($_finalUsers);
        $_v = 1;
        /* Automatic Tutor Select - Start */
        $iq = 0;
        $icount = $iq;
        $expertscount = 0;

        /* Automatic Tutor Select -End */
        foreach ($_finalUsers as $newOne) {
            $xy =  $newOne['userid'];
            $sfcategory = $newOne['category'];
            $c=new Criteria();
            $c->add(UserPeer::ID,$newOne['userid']);
            $experts=UserPeer::doSelectOne($c);

            if ($sfcategory == 5) {
                $allsub = "General Student";
            } else {
                $titSQL = "SELECT `tutor_role`,`school`,`study` FROM `tutor_profile` WHERE `user_id` = ".$newOne['userid']."";
                $titRes = mysql_query($titSQL);
                $allsub		= "";

                if (mysql_num_rows($titRes)) {
                    $tutData 	= mysql_fetch_assoc($titRes);
                    $allsub		= @$tutData['tutor_title'];
                    if ($tutData['tutor_role'] != '') {
                        $allsub		.= $tutData['tutor_role'];
                        if ($tutData['school'] != '') {
                            $allsub		.= " at ".$tutData['school'];
                        }

                        if ($tutData['study'] != '') {
                            $allsub		.= " ".RaykuCommon::getTitlePre($tutData['tutor_role'])." ".$tutData['study'];
                        }
                    }
                }

                if ($allsub=="") {
                    $allsub = "Student";
                }
            }

            $query5 = mysql_query("select * from user_rate where userid=".$newOne['userid']." ") or die(mysql_error());
            if (mysql_num_rows($query5) > 0) {
                $rowValues = mysql_fetch_assoc($query5);
                $rate = $rowValues['rate']."RP";
            } else {
                $rate = "0RP";
            }
?>
<?php
            $curr_user_rank=''; $ij =1;
            foreach ($rankCheckUsers as $_expert) {
                if ($_expert['userid'] == $experts->getId()) {
                    $curr_user_rank=$ij;
                    break;
                }
                $ij++;
            }
?>
<?php
            if (strlen($allsub) > 100) {
                $allsub = substr($allsub,0,100);
                $allsub =  $allsub."&nbsp;&nbsp;...";
            }
?>
<?php
            $onlinecheck = '';
            if (in_array($experts->getId(),$_checkOnlineUsers)) {
                $onlinecheck = "online";
                if (count($sample)==15)
                {
                    if ($iq<5)
                    {
                        $busyquery = mysql_query("select * from popup_close where user_id=".$newOne['userid']) or die(mysql_error());
                        $busyuser = mysql_num_rows($busyquery);
                        if ($busyuser==0 || empty($busyuser))
                        {
                            $iq++;
                            $icount++;
                            $expertscount++;
                        }
                    }	}
            }

            $onoff = isset($_COOKIE['onoff']) ? $_COOKIE['onoff'] : null;
            if ($onoff == 1) {
                $onlinecheck = "online";
            } elseif ($onoff == 2) {
                $onlinecheck = "";
            }
?>
<div class="cn-result"  id="<?php echo 'first'.$xy; ?>">
  <div  id="<?php echo $xy.'.1'; ?>" class="cn-column-one"  onclick="rowCheck(this.id)" style="padding-right:15px;width:500px;">
    <p id="<?php echo $xy.'.2'; ?>"  class="cn-title"  onclick="rowCheck(this.id)">
    <div id="<?php echo $xy.'.3'; ?>"  class="cn-user-info" onclick="rowCheck(this.id)" style="float:right;width:150px;line-height:14px" align="right"><strong style="color:#069"></strong>

<?php if ($onlinecheck == "online") {
    /* Automatic Tutor Select - Start */
    if (count($sample)==15) {
        if ($iq>0 && $iq<5) {
            $busyquery = mysql_query("select * from popup_close where user_id=".$newOne['userid']) or die(mysql_error());
            $busyuser = mysql_num_rows($busyquery);
            if ($busyuser==0 || empty($busyuser)) {
?>
                 <input type="hidden" name="oncheckstatuser" id="oncheckstatuser<?php echo $iq; ?>" value="<?php echo $newOne['userid']; ?>" />
<?php
                $tutname = "expert_".$icount;
                $maxcook = $icount;
                setcookie($tutname, $newOne['userid'], time()+3600, '/', sfConfig::get('app_cookies_domain'));
                setcookie("cooktotal", $maxcook, time()+3600, '/', sfConfig::get('app_cookies_domain'));
                setcookie("expertscount", $expertscount, time()+3600, '/', sfConfig::get('app_cookies_domain'));

?>
                <script type="text/javascript">
                var tcount = getCookie('expertscount');
                for(g=1;g<=tcount;g++) {

                    var chkuserid = document.getElementById('oncheckstatuser'+g).value;
                    var chktrue = 'checkbox_'+chkuserid;

                    if (document.getElementById(chktrue)!= null && document.getElementById(chktrue).checked == false)
                    {
                        document.getElementById(chktrue).checked = true;
                        document.getElementById("first"+chkuserid).style.backgroundColor = '#DEF3FE';
                    }
                }
                </script>
<?php
            }
        }
    }
    /* Automatic Tutor Select - End */
    if ($experts->getType() == 5) { ?>
      <img src="<?php echo image_path('expert_saved.png', false); ?>" alt="Rayku Staff" />
      <?php } ?>
      <a href="/tutor/<?php echo $experts->getUsername()?>" target="_blank" style="color:#8FAFC8"><?php echo $experts->getName()?> <span class="onlinenow">(online)</span></a>
      <?php } else { ?>
      <?php if ($experts->getType() == 5) { ?>
      <img src="<?php echo image_path('expert_saved.png', false); ?>" alt="Rayku Staff" />
      <?php } ?>
      <a href="/tutor/<?php echo $experts->getUsername()?>" target="_blank" style="color:#8FAFC8"><?php echo $experts->getName()?> <span class="offlinenow">(offline)</span></a>
      <?php } ?>
    </div>
    <div> <u><a href="#" title="Click to Select"><?php echo $allsub;?></a></u></div>
    </p>
  </div>
  <div id="<?php echo $xy.'.4'; ?>"  class="cn-column-two" align="center">
    <p class="cn-expertscore" style="font-size:13px;color:#333"> <?php echo $rate; ?></p>
  </div>
  <div class="cn-column-four">
    <p class="cn-pricepermin" align="center" style="margin-top:10px">
<?php
        $query = mysql_query("select * from popup_close where user_id=".$newOne['userid']) or die(mysql_error());
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
      <a href="/message/compose/<?php echo $experts->getUsername(); ?>"><img alt="in session" src="<?php echo image_path('em-busy.jpg', false); ?>"></a>
<?php
        } else {
            $_count_online_user += 1;
            $totcook = @$_COOKIE['cooktotal'];
            $w=1;
            for($u=1;$u<=$totcook;$u++) {
                $cookval = @$_COOKIE['expert_'.$u];
                $cookvalue = $cookval;
                if ($cookvalue) {
                    if ($cookvalue == $xy) {
                        $cookiy = $cookvalue;
                    } else {
                        $w++;
                    }
                }
            }
?>
      <input type="checkbox" name="checkbox[]" id="checkbox_<?php echo $xy?>" value="<?php echo $newOne['userid']; ?>" onclick="setvalue(this.id)" style="background-color:#DEF3FE;border:1px solid red;" <?php echo (@$cookiy==$newOne['userid'])?"checked='checked'":""; ?> />
            <script type='text/javascript'>setCheckboxColor(<?php echo $newOne['userid']; ?>);</script>
<?php
        }
    } else {
?>
      <a href="/message/compose/<?php echo $experts->getUsername(); ?>"><img height="18" width="59" alt="" src="<?php echo image_path('em-email.jpg', false); ?>"></a>
<?php
    }
?>
  </div>
  <div> </div>
  <div class="clear-both"></div>
</div>

<?php $_SESSION['temp1'][$newOne['userid']]=1;
if ($_count_check == $_v) {
    echo "<input type='hidden' name='online_user' id='online_user' value='".$_count_online_user."' >";
}
$_v++;
        } ?>
<?php } else { ?>
<?php
            if ($_COOKIE["onoff"] == 1) {
                if (!empty($_COOKIE["school"])) {?>
<p class="cn-pricepermin" align="center" style="margin-top:10px"> No online tutors found for this category with the criteria of School level.... </p>
<?php } else {?>
<p class="cn-pricepermin" align="center" style="margin-top:10px"> No online tutors found for this category.... . </p>
<?php }
            } else if ($_COOKIE["onoff"] == 2) {
                if (!empty($_COOKIE["school"])) { ?>
<p class="cn-pricepermin" align="center" style="margin-top:10px"> No offline tutors found for this category with the criteria of School level.... </p>
<?php } else { ?>
<p class="cn-pricepermin" align="center" style="margin-top:10px"> No offline tutors found for this category.... </p>
<?php }
            } else {
                if (!empty($_COOKIE["school"])) { ?>
<p class="cn-pricepermin" align="center" style="margin-top:10px"> No tutors found for this category with the criteria of School Level.... </p>
<?php }
            } ?>
<div class="clear-both"></div>
<? } ?>
<?php } else { ?>
<p class="cn-pricepermin" align="center" style="margin-top:10px"> No tutors found..... </p>
<p class="cn-pricepermin" align="center" style="margin-top:10px; color:#C30"> Please select a category from the category list </p>
<div class="clear-both"></div>
<?php } ?>
<?php
            if (!empty($_REQUEST['show_more_post'])) {
                $next_records = $_REQUEST['show_more_post'] + 10;
            } else {
                $next_records = 15;
            }

        if (count($newUser)>15) {
            if (count($sample)!=count($newUser)) {
?>
<div style="width:100%;font-size:20px;line-height:35px;" align="right">
  <div id="bottomMoreButton"> <img src="<?php echo image_path('ajax-loader.gif', false); ?>" style="display:none" class="spinner" /> <a id="more_<?php echo @$next_records?>" class="more_records" name="2" href="javascript: void(0)">show more listings</a> </div>
</div>
<?php
            }
        }
?>
        <script type="text/javascript">
        dv('#popup_connect').load('/expertmanager/checkoutpopup', '', function(response) {
            dv("#popup_content").html(response);
        });
        </script>
