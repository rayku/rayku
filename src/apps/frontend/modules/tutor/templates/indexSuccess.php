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
<link rel="stylesheet" type="text/css" href="/css/tutorprofile.css"
<link rel="stylesheet" type="text/css" href="/styles/popup-window.css" />
<script type="text/javascript" src="/js/popup-window.js"></script>
<?php
$onlinecheck = '';
    
/* @var $expert User */
if($expert->isOnline()) {
    $web="Web";
} else {
    $web = null;
}
$userGtalk = $expert->getUserGtalk();

$googletalk=null;
if($userGtalk) {
    $onlinecheck = BotServiceProvider::createFor('http://www.rayku.com:8892/status/'.$userGtalk->getGtalkid())->getContent();
    if($onlinecheck == "online") {
        $googletalk=true;
    }
}

if(empty($onlinecheck) || ($onlinecheck != "online")) {
    $fb_query = mysql_query("select * from user_fb where userid=".$expert->getId(), $connection) or die(mysql_error());
    if(mysql_num_rows($fb_query) > 0) {
        $fbRow = mysql_fetch_assoc($fb_query);
        $fb_username = $fbRow['fb_username'];

        $details = BotServiceProvider::createFor("http://facebook.rayku.com/tutor")->getContent();
        $Users = json_decode($details, true);

        foreach($Users as $key => $user) {
            if($user['username'] == $fb_username){
                $onlinecheck = "online";
                break;
            }
        }
    }
}

$onlineTutorsByNotificationBot = BotServiceProvider::createFor("http://notification-bot.rayku.com/tutor")->getContent();
if((empty($onlinecheck) || ($onlinecheck != "online")) && is_array(@$_Users)) {
    $_Users = json_decode($onlineTutorsByNotificationBot, true);
    foreach($_Users as $key => $_user) {
        if($_user['email'] == $expert->getEmail()){
            $onlinecheck = 'online';
            break;
        }
    }
}

if($onlinecheck != "online") {
    $onlinecheck = 'offline';
}

// Facebook //
$facebookchat = null;
$fb_query = mysql_query("select * from user_fb where userid=".$expert->getId(), $connection) or die(mysql_error());
if(mysql_num_rows($fb_query) > 0) {
    $fbRow = mysql_fetch_assoc($fb_query);
    $fb_username = $fbRow['fb_username'];

    $details = BotServiceProvider::createFor("http://facebook.rayku.com/tutor")->getContent();
    $Users = json_decode($details, true);

    foreach($Users as $key => $user) {
        if($user['username'] == $fb_username){
            $onlinecheck = "online";
            $facebookchat="Facebook Chat";
            break;
        }
    }
}

$_Users = json_decode($onlineTutorsByNotificationBot, true);

$desktopapplication = null;
if (is_array(@$_Users)) {
    foreach($_Users as $key => $_user) {
        if($_user['email'] == $expert->getEmail()){
            $onlinecheck = 'online';
            $desktopapplication="Desktop Application";
            break;
        }
    }
}
?>
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
        <h2 class="avatar"> <?php echo $expert->getName(); ?></h2>
        <br>
        <!--Connect Button-->
<?php
if(!empty($currentUser)) {
    $_currentUserId = $currentUser->getId();
    if($expert->isTutorStatusEnabled()) {
        if(($expert->isOnline() || $onlinecheck == "online") && $expert->getId() != $_currentUserId ) {
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
    if(!empty($currentUser)) {
        $_currentUserId = $currentUser->getId();
        if($expert->getId() != $_currentUserId ) {
            $query = mysql_query("select * from expert_subscribers as es, user as u where es.expert_id=".$expert->getId()." and es.user_id =".$_currentUserId." and es.user_id = u.id ", $connection) or die("error1");
            if(mysql_num_rows($query) > 0) {
?>
      <a href="#" id="tutor-follow">Unfollow</a>
      <?php
            } else {
?>
      <a href="/tutor/<?php echo $expert->getUsername(); ?>?expert_id=<?php echo $expert->getId(); ?>" id="tutor-follow">Follow <?php echo $expert->getname(); ?></a>
            }
        }
    }
?>
      
      <!--row 1 begins-->
      
      <div class="row row-bg">
        <div class="left" style="width:550px;"><em>Sophomore</em> at <em>University of Toronto</em> studying <em>Astronomy and Physics</em></div>
        <div class="clear-both"></div>
      </div>
      
      <div class="row row-bg">
        <div class="left">Connected via: </div>
        <div class="right"><span style="color:#CFCFCF;"> <span <?php if($web!="") { ?> style="color:#069; font-weight:bold;" <?php } ?>>web</span> | <span <?php if($googletalk) { ?> style="color:#069;font-weight:bold;" <?php } ?>>gtalk</span> | <span <?php if($facebookchat!="") { ?> style="color:#069;font-weight:bold;" <?php } ?>>fb chat</span> | <span <?php if($desktopapplication!="") { ?> style="color:#069;font-weight:bold;" <?php } ?>>desktop app</span> </span> </div>
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
        <div class="right">
          <?=$expertscore_result['score']?>
        </div>
        <div class="clear-both"></div>
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
