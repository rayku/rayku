<?php
$connection = RaykuCommon::getDatabaseConnection();
use_helper('MyAvatar', 'Javascript');
usort($rankUsers, "cmp");
$curr_user_rank=''; $ij =1; $curr_user_score='';
if(count($rankUsers) > 0) {
    foreach($rankUsers as $_expert){
        if($_expert['userid'] == $tutor_id){
            $curr_user_rank = $ij;
            $curr_user_score=$_expert['score'];
            break;
        }
        $ij++;
    }
}
function cmp($a, $b)
{
    if ($a["score"] == $b["score"]) {
        return strcmp($a["createdat"], $b["createdat"]);
    }
    return ($a["score"] < $b["score"]) ? 1 : -1;
}
?>
<script type="text/javascript" src="/fancybox/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="/fancybox/jquery.fancybox-1.3.1.js"></script>
<link rel="stylesheet" type="text/css" href="/fancybox/jquery.fancybox-1.3.1.css" media="screen" />
<style type='text/css'>
th {
    background-color: #8FB5DB;
    border-color: #DDDDDD;
    color: black;
    font-weight: bold;
    text-align: center;
    font-size: 17px;
}
td {
    border-color: #DDDDDD;
    font-size: 15px;
    padding: 6px;
}
table {
    border: groove;
    border-color: #DDDDDD;
    font-size: 15px;
    border-bottom-width : 20px;
}
.entry select {
    width:295px;
    height:40px;
    background:#fff url(images/add-journal-view.gif) no-repeat;
    float:left;
    margin-right:5px;
    color:#3d3d3d;
    font:14px "Arial";
    border:0px;
    padding:11px 10px 10px 12px;
}
#main {
    background:white;
}
/*Content*/

#content {
    width:630px;
    float:left;
    padding-left:20px;
}
#content h2 {
    font-family:Cambria, Arial, Helvetica, sans-serif;
    font-size:34px;
    font-weight:bold;
    color:#1c517c;
    /*display:inline-block;
    *display:inline;
    zoom:1;*/
}
#avatar-connect {
    position:relative;
    margin-bottom:20px;
    padding-left:3px;
}
h2.avatar {
    padding-top:10px;
    margin-left:8px;
}
.avatar {
    margin-top:22px;
    float:left;
}
#connect {
    padding-left:10px;
    padding-top:7px;
}
#facts {
    width:100%;
    border:1px solid #8daec7;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
    margin-bottom:30px;
    position:relative;
    color:#5d5f60;
    padding-top:10px;
    padding-bottom:20px;
}
#certified {
    position:absolute;
    right:16px;
    top:9px;
}
#facts .row {
    border-bottom:1px dashed #e7e7e7;
    padding:10px 0;
    width:500px;
    position:relative;
}
#facts .row:last-child {
    border:none;
}
#tutor-link {
    position:absolute;
    right:18px;
    top:145px;
    font-size:12px;
    color:#1c517c;
    text-decoration:underline;
    font-weight:bold;
    z-index: 1;
}
#tutor-follow {
    color:#1C517C;
    font-size:15px;
    font-weight:bold;
    position:absolute;
    right:19px;
    text-decoration:underline;
    top:-34px;
}
#facts .left {
    float:left;
    width:190px;
    font-size:16px;
    padding-left:16px;
}
#facts .right {
    float:right;
    width:278px;
    padding-left:12px;
    font-size:16px;
    border-left:1px solid #CCC;
}
#facts .right img {
    margin-left: -10px;
}
#facts .row-bg {
    background:#f8fbfe;
}
#facts .rate-color {
    font-weight:bold;
    color:#006600;
}
#add-value {
    padding-bottom:20px;
    margin-bottom:20px;
    color:#575757;
    border-bottom:4px solid #eaeaea;
}
#add-value h3 {
    font-size:18px;
    font-weight:bold
}
#add-value p {
    margin:20px 0 5px 0;
    font-size:14px;
    line-height:20px;
}
#followers h4 {
    color:#575757;
    font-size:12px;
    font-weight:bold;
    padding-left:5px;
}
#followers h4 span.foll-no {
    color:#006600 !important;
}
#followers-images {
    margin-left:-5px;
    margin-top: 10px;
}
/*Sidebar*/
#sidebar {
    width:265px;
    margin:0 24px;
    float:right;
    padding-top:28px;
    text-align:left;
}
#sidebar a {
    color: #87A8C3;
}
#thumbnail-wrap {
    margin-bottom:45px;
    padding-left:6px;
}
#thumbnail-wrap a {
    margin-top:0;
    display:block;
    font-size:12px;
    margin-left:8px;
}
.thumbnail {
    width:253px;
    height:105px;
    background:url(../images/portfolio/thumbnail-bg.png) no-repeat;
    margin-bottom:20px;
    text-align:center;
    padding-top:7px;
    position:relative;
}
.thumbnail p {
    text-align:left;
    background:url(../images/portfolio/thumbnail-text-bg.png) repeat;
    font-size:11px;
    font-family:Calibri, Arial, Helvetica, sans-serif;
    color:#fff;
    padding:6px;
    margin:0 9px;
    position:absolute;
    bottom:5px;
    width:223px;
    *left:0;
}
#ratings {
    color:#676767;
    font-size:12px;
    border-bottom:4px solid #eaeaea;
    padding-bottom:14px;
    padding-left:15px;
    margin-bottom:16px;
}
#ratings p {
    line-height:16px;
    color:#999;
}
.ratings-wrap {
    margin-bottom:16px;
}
.ratings-wrap a {
    text-decoration:underline;
    color:#1c517c !important;
}
.ratings-wrap img {
    vertical-align:text-top;
}
#latest-posts {
    font-size:12px;
    margin-bottom:25px;
}
#latest-posts p {
    line-height:16px;
    color:#999;
}
#latest-posts h4 {
    font-weight:bold;
    color:#575757;
    padding-bottom:8px;
    padding-left:15px;
}
#latest-posts li {
    width: 235px;
    padding-left:15px;
    margin-top:10px;
    padding-bottom:4px;
    border-bottom:1px dashed #e7e7e7;
}
#latest-posts li a {
    color:#5981ae;
}
.more-posts {
    display:block;
    margin-top:15px;
    margin-left:15px;
}
</style>
<link rel="stylesheet" type="text/css" href="/styles/popup-window.css" />
<script type="text/javascript" src="/js/popup-window.js"></script>
<div id="main">
  <!--content begins-->
    <div id="content">
    <!--avatar, name and connect begins-->
    <div id="avatar-connect">
      <!--avatar-->
      <div class="avatar">
        <div class="displaypic"><?php echo link_to( avatar_tag_for_user($expert), '@profile?username=' . $expert->getUsername() ); ?></div>
      </div>
      <!--Name-->
      <div style="float: left;">
        <h2 class="avatar"> <?php echo $expert->getName(); ?></h2><br>
        <!--Connect Button-->
<?php

    /* @var $expert User */
    $CCS = new Rayku\CommunicationChannel\Service();
    $onlineCCs = $CCS->getUserOnlineCCs($expert);

    if(!empty($currentUser)) {
        $_currentUserId = $currentUser->getId();
        if($expert->isTutorStatusEnabled()) {
            if( count($onlineCCs) > 0 && $expert->getId() != $_currentUserId ) {
                echo '<a href="/expertmanager/direct?id='.$expert->getId().'"><img id="connect" src="/images/portfolio/connect.png" alt="Connect" /></a>';
            } else if($expert->getId() != $_currentUserId ) {
                echo '<img id="connect" src="/images/portfolio/offline.png" alt="Offline" />';
            }
        } else {
            echo '<img id="connect" src="/images/portfolio/tutor-2.png" alt="tutor" />';
        }
    }
?>
      </div>
    </div>
    <!--avatar,name and connect ends-->
    <div class="clear-both"></div>
    <!--facts box begins-->
    <div id="facts">
<?php	$_query_scrore = mysql_query("select score from user_score where user_id=".$expert->getId()." ", $connection) or die(mysql_error());
$chat_rating = 0; $rating_count = 0; $avg_rating = 0;

$rating_score = mysql_fetch_row($_query_scrore);

if($expert->getType() == 5) {
?>
      <img src="/images/portfolio/certified.png" alt="Certified" id="certified" />
      <? } ?>
      <a href="/tutor/<?php echo $expert->getusername(); ?>" id="tutor-link">http://rayku.com/tutor/<?php echo $expert->getusername(); ?></a>
<?php
    if(!empty($currentUser)) {
        $_currentUserId = $currentUser->getId();
        if($expert->getId() != $_currentUserId ) {
            $query = mysql_query("select * from expert_subscribers as es, user as u where es.expert_id=".$expert->getId()." and es.user_id =".$_currentUserId." and es.user_id = u.id ", $connection) or die("error1");
            if(mysql_num_rows($query) > 0) {
?>
      <span id="tutor-follow" style="text-decoration:none;">Currently Following</span>
<?php
            } else {
?>
      <a href="/tutor/<?php echo $expert->getUsername(); ?>?expert_id=<?php echo $expert->getId(); ?>" id="tutor-follow">Follow <?php echo $expert->getname(); ?></a>
<?php
            }
        }
    }
?>

      <!--row 1 begins-->

      <div class="row row-bg">
        <div class="left">Connected via: </div>
        <div class="right">
            <span style="color:#CFCFCF;">
                <span <?php if(in_array('web', $onlineCCs)) { ?> style="color:#069; font-weight:bold;" <?php } ?>>
                    web
                </span>
                |
                <span <?php if(in_array('gtalk', $onlineCCs)) { ?> style="color:#069;font-weight:bold;" <?php } ?>>
                    gtalk
                </span>
                |
                <span <?php if(in_array('fb', $onlineCCs)) { ?> style="color:#069;font-weight:bold;" <?php } ?>>
                    fb chat
                </span>
                |
                <span <?php if(in_array('desktop', $onlineCCs)) { ?> style="color:#069;font-weight:bold;" <?php } ?>>
                    desktop app
                </span>
            </span>
        </div>
        <div class="clear-both"></div>
      </div>

      <!--row 2 begins-->

      <div class="row row-bg">
<?php	$_query = mysql_query("select * from user_rate where userid =".$expert->getId()." ", $connection) or die(mysql_error());
$chat_rating = 0;
if(mysql_num_rows($_query) > 0) {
    $_row = mysql_fetch_array($_query);
    $chat_rating = $_row['rate'];
}
?>
        <div class="left">Rate:</div>
        <?php /*?><div class="right rate-color"><a id="various1" href="#inline1" style="color:rgb(255, 102, 0);"><?php echo number_format($avg_rating, 2); ?></a></div><?php */?>
        <div class="right rate-color"><?php echo number_format($chat_rating, 2); ?>RP/minute</div>
        <div class="clear-both"></div>
      </div>
      <!--row 2 ends-->

      <!--row 4 begins-->

<?php
if($curr_user_rank<=10 and $curr_user_rank<>''){
?>
      <div class="row row-bg">
        <div class="left">Tutor Rank:</div>
        <div class="right">#
          <?=$curr_user_rank?>
        </div>
        <div class="clear-both"></div>
      </div>
<?php
}
?>

      <!--row 4 ends-->

      <!--row 5 begins-->

      <div class="row row-bg">
        <div class="left">Tutored Sessions:</div>
        <div class="right">
          <?=count($totalSessions)?>
        </div>
        <div class="clear-both"></div>
      </div>
      <!--row 5 ends-->

      <!--row 6 begins-->

      <div class="row">
<?php
$logedUserId = $_SESSION['symfony/user/sfUser/attributes']['symfony/user/sfUser/attributes']['user_id'];

$query = mysql_query("select * from expert_subscribers as es, user as u where es.expert_id=".$expert->getId()." and es.user_id = u.id", $connection) or die("error1");
$num_followers=mysql_num_rows($query);
?>
        <div class="left">Followers:</div>
        <div class="right">
          <?=$num_followers?>
        </div>

        <div class="clear-both"></div>
      </div>

      <!-- Expert count -->
<?php if(!empty($currentUser)) {
    $_currentUserType = $currentUser->getType();
    if($_currentUserType == 5) { ?>

<?php
        $expertscor_qry = mysql_query("select score from user_score where user_id =".$expert->getId()." ", $connection) or die("error1");
    $expertscore_result = mysql_fetch_array($expertscor_qry);
?>
      <div class="row">
        <div class="left">Expert Score:</div>
        <div class="right"><?=$expertscore_result['score']?></div>
      </div>
      <?php } ?>
      <!--row 6 ends-->

    </div>
    <!--facts box ends-->


    <!--how i add value box begins-->

    <script type="text/javascript">
    var k = jQuery.noConflict();
    k(document).ready(function() {
        k("#promotionalText").fancybox({
            "titlePosition"		: "inside",
                "transitionIn"		: "none",
                "transitionOut"		: "none"
        });
    });
    </script>


    <div id="add-value">
      <h3>How I add value?
<?php $_currentUserId = $currentUser->getId();
if($expert->getId() == $_currentUserId ) { ?>

    <a id="promotionalText" href="#promotionalMsg" >[edit]</a>

        <?php } ?>
        <?php } ?>
      </h3>
<?php
    $c= new Criteria();
$c->add(ExpertsPromoTextPeer::EXP_ID,$expert->getId());
$promotext = ExpertsPromoTextPeer::doSelectOne($c);
?>
      <?php if($promotext != NULL){ ?>
      <?php echo $promotext->getContent(); ?>
      <?php } else { ?>
      <p>Welcome to my portfolio profile. I am a new expert at Rayku so you may not be able to see much on this page. Though, if you have a question that's within my field, I'm sure I can help you out!<br />
        <br />
        If I'm online, connect with me! If not, feel free to leave me a message and I'll get back to you. </p>
      <?php } ?>
    </div>
    <!--add value box ends-->



    <div style="display: none;">
        <div id="promotionalMsg" style="width:550px;height:480px;overflow:auto;padding:25px" align="left">
<?php if(!empty($promotext)) {
    $content = $promotext->getContent();
}  ?>
            <?php echo form_tag('tutor/'.$expert->getUserName()) ?>
            <p style="padding:10px 0;font-weight:bold;font-size:16px;color:#333">Describe how you add value: </p>
            <?php echo textarea_tag('content',$content,array('size' => '54x40', 'rich' => 'fck')); ?> <br />
            <?php echo submit_tag('Edit Description',array('style' => 'padding:5px;font-size:13px;')) ?>
            </form>
        </div>
        </div>

    <!--followers begins-->

    <div id="followers">
      <h4><span class="foll-no">
        <?=$num_followers?>
        </span> Followers</h4>
      <div  id="followers-images">
<?php
    $logedUserId = $_SESSION['symfony/user/sfUser/attributes']['symfony/user/sfUser/attributes']['user_id'];

$query = mysql_query("select * from expert_subscribers as es, user as u where es.expert_id=".$expert->getId()." and es.user_id = u.id ", $connection) or die("error1");

if(mysql_num_rows($query) > 0) {
    while($row = mysql_fetch_array($query)) {
        $_followers = UserPeer::retrieveByPK($row['user_id']);

        echo link_to( avatar_tag_for_user($_followers), '@tutor?username='.$_followers->getUsername() );
    }
}
?>
      </div>
      <!--followers images ends-->

    </div>
    <!--followers ends-->

  </div>
  <!--content ends-->

  <!--sidebar-begins-->

  <div id="sidebar">
    <div id="thumbnail-wrap">
<?php
if(count($lastSessions)>0) {
    $count_session=count($lastSessions)>3?3:count($lastSessions);
    for($ls=0;$ls<$count_session;$ls++){
?>
      <!--thumbnail wrap begins-->
      <div class="thumbnail"> <img src="<?php echo image_path('portfolio/thumbnail.png', false); ?>" alt="Sidebar thumbnail" />
        <p>
          <?php if ($lastSessions[$ls]->getQuestion() <> '') { ?>
          <a href="#<?php //echo url_for('whiteboard/show?id=' . $lastSessions[$ls]->getId()) ?>" style="color:#FFF"> <?php echo urldecode($lastSessions[$ls]->getQuestion()) ?> </a>
<?php
          }
?>
        </p>
      </div>
<?php
    }
}
?>
      <br />
<?php
if(count($lastSessions)>0) {
?>
      <a href="<?php echo url_for('whiteboard/sessions/') . '/' . $expert->getUsername() ?>" >More Sessions</a>
      <?php }?>
    </div>
    <!--thumbnail wrap ends-->
    <div id="ratings">
      <h4 style="margin-bottom:20px; font-weight:bold; color: #575757;">Latest Ratings</h4>
<?php
    $rating_count = 0;
    $_query = mysql_query("select * from whiteboard_chat where expert_id =".$expert->getId()." and rating !='' order by started_at desc limit 0,5 ", $connection) or die(mysql_error());

    if(mysql_num_rows($_query) > 0) {
        $rating_count = mysql_num_rows($_query);
        while($_row = mysql_fetch_array($_query)) {
            echo '<script type="text/javascript">
                var k = jQuery.noConflict();
            k(document).ready(function() {
                k("#various'.$_row['id'].'").fancybox({
                    "titlePosition"		: "inside",
                        "transitionIn"		: "none",
                        "transitionOut"		: "none"
        });
        });
                </script>';
                echo '<!--ratings-wrap begins-->
                          <div class="ratings-wrap">';
                     $total_stars=$_row['rating'];
                     $total_nostars=5-$_row['rating'];
                    echo '<table style="border:none;">';
                    for($i=0;$i<$total_stars;$i++) {
                        echo "<td style='background:url(/images/portfolio/rating-star.png) no-repeat;' valign='top'>&nbsp;</td>";
                    }
                    for($i=0;$i<$total_nostars;$i++) {
                        echo "<td style='background:url(/images/portfolio/rating-star-gray.png) no-repeat;' valign='top'>&nbsp;</td>";
                    }
                            echo'<td style="font-size:12px;">'.date("Y-m-d",strtotime($_row['started_at'])).'&nbsp;&nbsp;&nbsp;<a id="various'.$_row['id'].'" href="#inline'.$_row['id'].'" >info</a></td>';
                            echo "</tr></table></div>";
                            echo '
        <div style="display: none;">
        <div id="inline'.$_row['id'].'" style="width:500px;height:100px;overflow:auto;padding:25px" align="left">
            <table>
            <tr ><th width="130px">Session Question</th><th width="130px">Rating</th><th width="130px">Comments</th><th width="130px">Date</th></tr>

            <tr align="center">'.
            '<td>'.urldecode($_row['question']).'</td>'.'
            '.'<td>'.$_row['rating'].'</td>'.'
            '.'<td>'.$_row['comments'].'</td>'.'
            '.'<td>'.$_row['started_at'].'</td>'.'
            </tr>
            </table>
        </div>
        </div>';
                }
            }
        ?>

      <!--ratings begins-->
    <script type="text/javascript">
    var k = jQuery.noConflict();
    k(document).ready(function() {
        k("#various_moreratings").fancybox({
            "titlePosition"		: "inside",
                "transitionIn"		: "none",
                "transitionOut"		: "none"
        });
    });
    </script>
<?php
    if($rating_count>0){
?>
      <a id="various_moreratings" href="#inline_moreratings">More </a>
<?php } else {
    echo "<p>There are no sessions available to display.</p>";
}?>
      <div style="display: none;">
        <div id="inline_moreratings" style="width:650px;height:500px;overflow:auto;padding:25px" align="left">
          <h4 style="font-size:20px;color:#069;font-weight:bold;line-height:30px;">All Sessions Ratings :</h4>
          <br/>
          <br/>
          <table width="650"  border='2px' align='center' style = "'border-bottom-width : 4px';">
            <tr >
              <th width="130px">Session Question</th>
              <th width="130px">Rating</th>
              <th width="130px">Comments</th>
              <th width="130px">Date</th>
            </tr>
<?php	$_query = mysql_query("select * from whiteboard_chat where expert_id =".$expert->getId()." and rating !='' ", $connection) or die(mysql_error());

if(mysql_num_rows($_query) > 0) {
    $rating_count = mysql_num_rows($_query);
    while($_row = mysql_fetch_array($_query)) {
        echo '<tr align="center">';
        echo '<td>'.urldecode($_row['question']).'</td>';
        echo '<td>'.$_row['rating'].'</td>';
        echo '<td>'.$_row['comments'].'</td>';
        echo '<td>'.$_row['started_at'].'</td>';
        echo '</tr>';
    }
}
?>
          </table>
        </div>
      </div>
    </div>
    <!--ratings ends-->

    <!--Latest Posts Begins-->

    <div id="latest-posts">
      <h4>Latest  Q&amp;A Responses</h4>

      <!--Forum Post links-->
      <ul>
        <?php if($best_responses != NULL){ ?>
        <?php foreach($best_responses as $best_response){ ?>
        <li> <strong>
<?php $a = new Criteria();
$a->add(ThreadPeer::ID,$best_response->getThreadId());
$threads = ThreadPeer::doSelectOne($a);

if($threads != NULL){
    echo link_to($threads->getTitle(), '@view_thread?thread_id='.$threads->getId(),array('class' => 'threadttle'));
}
?>
        </strong></li>
        <?php } ?>
        <a id="various_moreposts" href="#inline_moreposts" class="more-posts">More </a>
        <?php } else { ?>
        <li>
          <p>This tutor does not have any 'best response' answers yet.</p>
        </li>
        <?php } ?>
      </ul>
    </div>
    <!--latest posts ends-->

  </div>
  <!--sidebar ends-->

  <div class="clear-both"></div>
</div>
<script type="text/javascript">
var k = jQuery.noConflict();
k(document).ready(function() {
    k("#various_moreposts").fancybox({
        "titlePosition"		: "inside",
            "transitionIn"		: "none",
            "transitionOut"		: "none"
    });
});
</script>
<div style="display: none;">
  <div id="inline_moreposts" style="width:650px;height:500px;overflow:auto;padding:25px" align="left">
    <h4 style="font-size:20px;color:#069;font-weight:bold;line-height:30px;">More recent posts</h4>
    <br/>
    <br/>
    <table width="650"  border='2px' align='center' style = "'border-bottom-width : 4px';">
      <tr >
        <th width="130px">Post</th>
        <th width="130px">Created</th>
        <th width="130px">Last post</th>
      </tr>
<?php
if($bestResponses != NULL) {
    foreach($bestResponses as $response){
        $a = new Criteria();
        $a->add(ThreadPeer::ID,$best_response->getThreadId());
        $threads = ThreadPeer::doSelectOne($a);

        if ($threads != NULL){
            echo '<tr align="center">';
            echo '<td>'.link_to($threads->getTitle(), '@view_thread?thread_id='.$threads->getId(),array('class' => 'threadttle')).'</td>';
            echo '<td>'.$threads->getCreatedAt().'</td>';
            echo '<td>'.$threads->getLastpostAt().'</td>';
            echo '</tr>';
        }
    }
}
?>
    </table>
  </div>
</div>
