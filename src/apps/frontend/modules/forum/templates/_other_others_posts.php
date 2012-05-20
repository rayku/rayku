<?php
$connection = RaykuCommon::getDatabaseConnection();


$result = explode("/", $_SERVER['REDIRECT_URL']);


$queryBest = mysql_query("select * from post where thread_id = " . $result[3] . " order by created_at ASC limit 0,1 ", $connection) or die(mysql_error());
$rowBest = mysql_fetch_array($queryBest);



foreach ($other_others_posts as $post) {

    $c = new Criteria();
    $c->add(UserPeer::ID, $post->getPosterId());
    $user = UserPeer::doSelectOne($c);
    ?>

    <div class="box">
        <div class="top"></div>
        <div class="content">
            <div class="userinfo">
                <div class="avatar-holder" style="float:none !important;"> <?php echo avatar_tag_for_user($user); ?> </div>
                <div class="spacer"></div>
                <?php
                $query = mysql_query("select * from user_score where user_id=" . $user->getId(), $connection) or die(mysql_error());
                $row = mysql_fetch_assoc($query);
                ?>
                <?php if ($user->getType() == 5) { ?>
                    <div style="width:125px;margin-bottom:5px;"><img src="<?php echo image_path('expert_saved.png', false); ?>" alt="Rayku Staff" title="Rayku Staff" style="border:none;margin:5px 3px 0 0;" />
                    <?php } else { ?>
                        <?php if ($row['score'] >= 1000 && $row['score'] < 2000) { ?>
                            <div style="width:125px;" align="center"><img src="<?php echo image_path('beside1.gif', false); ?>" alt="Certified Tutor" title="Certified Tutor" /><br />
                            <?php } else if ($row['score'] >= 2000) { ?>
                                <div> <img src="<?php echo image_path('beside1.gif', false); ?>" alt="Certified Tutor" />
                                <?php } else { ?>
                                    <div>
                                    <?php } ?>
                                <?php } ?>
                                <?php echo link_to($user->getName(), 'http://rayku.com/tutor/' . $user->getUsername(), array('class' => 'username')) ?>
                            </div>
                            <div class="points" style="font-weight:normal;color:#666">Posts: <strong>
                                    <?php
                                    $logedUserId = $user->getID();
                                    $v = new Criteria();
                                    $v->add(PostPeer::POSTER_ID, $logedUserId);
                                    $_postCount = PostPeer::doCount($v);

                                    echo $_postCount;
                                    ?>
                                </strong> </div>
                            <div class="points" style="font-weight:normal;color:#666;margin-top:4px;">RP: <strong>
                                    <?php
                                    $query = mysql_query("select * from user where id=" . $logedUserId . " ", $connection) or die(mysql_error());
                                    $detailPoints = mysql_fetch_assoc($query);
                                    echo $detailPoints['points'];
                                    ?>
                                </strong> </div>

                            <!-- Expert Rank -->

                            <?php
                            $c = new Criteria();

                            $rankexperts = ExpertCategoryPeer::doSelect($c);

                            $rankUsers = array();
                            $ji = 0;
                            $newUserLimit = array();

                            foreach ($rankexperts as $exp) {


                                if (!in_array($exp->getUserId(), $newUserLimit)) {

                                    $newUserLimit[] = $exp->getUserId();

                                    $_query = mysql_query("select * from user_tutor where userid =" . $exp->getUserId() . " ", $connection) or die(mysql_error());
                                    if (mysql_num_rows($_query) > 0) {

                                        $query = mysql_query("select * from user_score where user_id=" . $exp->getUserId(), $connection) or die(mysql_error());
                                        $score = mysql_fetch_assoc($query);

                                        if ($score['score'] != 0) {

                                            $rankUsers[$ji] = array("score" => $score['score'], "userid" => $exp->getUserId());

                                            $ji++;
                                        }
                                    }
                                }
                            }

                            asort($rankUsers);


                            arsort($rankUsers);
                            $ij = 1;
                            $curr_user_rank = '';

                            if (count($rankUsers) > 0) {

                                foreach ($rankUsers as $_expert) {

                                    if ($_expert['userid'] == $logedUserId) {

                                        $curr_user_rank = $ij;
                                        $curr_user_score = $_expert['score'];
                                        break;
                                    }

                                    $ij++;
                                }
                            }
                            ?>
                            <?php if ($curr_user_rank <= 10 and $curr_user_rank <> '') { ?>
                                <div class="points" style="font-weight:normal;color:#666;margin-top:4px;"> Tutor Rank: <strong>#<?php echo $curr_user_rank ?></strong>
                                </div>
                            <?php } ?>

                            <!-- Expert Rank --> 

                            <!-- Expert IP Showing -->

    <?php
    $query_usr = mysql_query("select * from user where id=" . $logedUserId . " ", $connection) or die(mysql_error());
    $user_details = mysql_fetch_assoc($query_usr);

    $_logedUserId = $_SESSION['symfony/user/sfUser/attributes']['symfony/user/sfUser/attributes']['user_id'];

    if (!empty($_logedUserId)) {

        if ($sf_user->getRaykuUser()->getType() == 5 || $sf_user->getRaykuUser()->getType() == 4) {

            $query = mysql_query("select * from post where id = " . $post->getId() . "", $connection) or die(mysql_error());

            $fetch_row = mysql_fetch_assoc($query);
            ?>
                                    <div class="points" style="font-weight:normal;color:#666;margin-top:4px;padding-top:5px;border-top:1px dotted #CCC"> IP: <?php echo $fetch_row['user_ip'] <> '' ? $fetch_row['user_ip'] : 'Not Available'; ?> </div>
                                <?php } ?>
                            <?php } ?>

                            <!-- Expert IP Showing --> 

                            <!-- Expert Follow Me -->

    <?php
    if (!empty($_logedUserId)) {


        if ($_logedUserId <> $logedUserId) {

            $query_fm = mysql_query("select * from expert_subscribers where expert_id=" . $logedUserId . " and user_id=" . $_logedUserId, $connection) or die(mysql_error());

            if (mysql_num_rows($query_fm) <= 0) {
                ?>
                                        <div class="followme" style="margin-top:5px;"> <a href="<?php echo @$curr_url; ?>?follow=true&user_id=<?php echo $_logedUserId; ?>&expert_id=<?php echo $logedUserId; ?>" style="font-size:12px;">Follow Me</a> </div>
                                        <?php
                                    } else {
                                        echo "<div class='following' style='font-size:12px;margin-top:5px;color:#666'><em>Already Following</em></div>";
                                    }
                                }
                            }
                            ?>

                            <!-- Expert Follow Me --> 

                        </div>
                        <div class="cmmt">
                            <div class="info">
    <?php $date = RaykuCommon::formatDateForPost($post->getUpdatedAt()); ?>
                                <div class="postdate">Posted on <?php echo $date; ?></div>
    <?php
    $thread = ThreadPeer::retrieveByPK($post->getThreadId());




    if ($rowBest["poster_id"] != $user->getId()) {

        if ($sf_user->getRaykuUserId() == $thread->getPosterId()) {
            $best_resp_count = PostPeer::getCountOfBestResponseForThread($thread);

            if ($best_resp_count < 1) {
                echo link_to('Set as best', 'forum/bestresponse?post_id=' . $post->getId() . '&temp=' . $post->getUpdatedAt(), array('class' => 'setbest'));
            }
        }
    }
    ?>
                            </div>
                            <!--      <p class="message"><?php // echo nl2br(htmlentities($post))  ?> </p> -->

                                <?php //$_post = explode("",$post);?>
                            <div class="message" style="font-weight:normal"><?php echo str_replace("*^-", "", $post); ?> </div>
                            <br/>
                                <?php
                                $logedUserId = $_SESSION['symfony/user/sfUser/attributes']['symfony/user/sfUser/attributes']['user_id'];

                                if (!empty($logedUserId)) {

                                    $c = new Criteria();
                                    $c->add(UserPeer::ID, $logedUserId);
                                    $actionCheck = UserPeer::doSelectOne($c);

                                    if ($actionCheck->getType() == '5') {

                                        $_action = "/forum/expertreplythread/" . $thread->getCategoryId() . "/" . $thread->getId() . "/";
                                    } else {

                                        $_action = "/forum/userreplythread/" . $thread->getCategoryId() . "/" . $thread->getId() . "/";
                                    }

                                    $_quick = "quick[" . $post->getId() . "]";
                                    ?>
                                <div class="quick_reply">
                                    <div style="float:left;width:200px;color:#056A9A;padding:0 20px;font-size:14px" align="left"><label><input type="checkbox" name="<?php echo $_quick; ?>" id="<?php echo $_quick; ?>" onClick="return Cookieset(this.id);" >
                                            Quote in reply</label></div>
                                <?php
                                $query = mysql_query("select * from post where
	id = " . $post->getId() . " and reported=1", $connection) or die(mysql_error());
                                if (mysql_num_rows($query) == 0) {
                                    ?>
                                        <div style="float:right;width:200px;padding-right:20px;" align="right"><a href="<?php echo @$curr_url; ?>?report=true&post_id=<?php echo $post->getId(); ?>" style="color:#999;font-size:12px;line-height:18px;">Report this post</a></div>
                                        <div style="clear:both"></div>
        <?php } ?>

                                    <?php
                                    $_SESSION['post_index'] += 1;


                                    $_postId = "post_id[" . $_SESSION['post_index'] . "]";
                                    ?>
                                    <input type="hidden" value="<?php echo $post->getId(); ?>" name="<?php echo $_postId; ?>" id="<?php echo $_postId; ?>">
                                    </input>
                                    <br />
                                    <br />
                                </div>
                                <?php } ?>
                        </div>
                        <div class="spacer"></div>
                    </div>
                    <div class="spacer"></div>
                    <div class="bottom"></div>
                </div>
                <!-- end of box -->
                            <?php
                        }