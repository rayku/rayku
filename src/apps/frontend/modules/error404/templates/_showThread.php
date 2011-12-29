<?php use_helper('Date') ?>
<?php use_helper('MyAvatar', 'Javascript') ?>
<style type="text/css">
.message ol {
	list-style-type: decimal !important;
}
.message ul {
	list-style-type: disc !important;
}
</style>
<?php

	$raykuUser = $sf_user->getRaykuUser();

 	$stats = $raykuUser->getStatisticsForDashboard();

?>
    <link rel="stylesheet" type="text/css" href="/css/custom/button.css"/>
<div class="body-main">
<?php if($_SESSION['edit_error']): unset($_SESSION['edit_error']); ?>

		<p style="font-size:14px;color:red;padding-top:15px;" align="center"><em>Your editing privilages for this post has expired, sorry!</em></p>

<?php endif; ?>
  <div class="box">
    <div class="top"></div>
    <div class="content">
<div class="userinfo">
        <?php $user = UserPeer::retrieveByPK($post->getPosterId());?>
        <div class="avatar-holder" style="float:none !important;"> <?php echo avatar_tag_for_user($user); ?> </div>
        <div class="spacer"></div>

<?php

		$connection = RaykuCommon::getDatabaseConnection();

					$query = mysql_query("select * from user_score where user_id=".$user->getId(), $connection) or die(mysql_error());
					$row = mysql_fetch_assoc($query);

?>

<?php if($user->getType() == 5) : ?>

<div style="width:125px;margin-bottom:5px;"><img src="/images/expert_saved.png" alt="Rayku Staff" title="Rayku Staff" style="border:none;margin:5px 3px 0 0;" />
<?php else: ?>
		<?php if($row['score'] >= 1000 && $row['score'] < 2000) { ?>

<div style="width:125px;" align="center"><img src="/images/beside1.gif" alt="Certified Tutor" title="Certified Tutor" /><br />

		<?php } else if($row['score'] >= 2000) { ?>
		<div>
		<img src="/images/beside1.gif" alt="Certified Tutor" />
		<?php } else { ?>
		<div>
		<?php }  ?>

<?php endif; ?>

<?php  echo link_to($user->getName(), 'http://'.RaykuCommon::getCurrentHttpDomain().'/tutor/' . $user->getUsername(),array('class' => 'username')) ?></div>

        <div class="points" style="font-weight:normal;color:#666">Posts: <strong><?php $logedUserId = $user->getID();
		$v = new Criteria();
		$v->add(PostPeer::POSTER_ID, $logedUserId);
		$_postCount = PostPeer::doCount($v) ;

		echo $_postCount; ?></strong> </div>

        <div class="points" style="font-weight:normal;color:#666;margin-top:4px;">RP: <strong><?php
		$query = mysql_query("select * from user where id=".$logedUserId." ", $connection) or die(mysql_error());
		$detailPoints = mysql_fetch_assoc($query);
		echo $detailPoints['points'];

		 ?></strong> </div>


            <?php

		 $query_es = mysql_query("select * from user_score where user_id=".$detailPoints[id]." ", $connection) or die(mysql_error());
		$es_score = mysql_fetch_assoc($query_es);
		//echo $detailPoints['points'];
		 	$stats = $user->getStatisticsForDashboard();

		 ?>
         <div class="points" style="font-weight:normal;color:#666;margin-top:4px;font-size:9px;"> <strong>Expert Score:</strong> <?php echo $es_score['score']<>''?$es_score['score']:'0'; ?> ES  </div>

                  <?php

				  	    $query_usr = mysql_query("select * from user where id=".$detailPoints[id]." ", $connection) or die(mysql_error());
		$user_details = mysql_fetch_assoc($query_usr);

		 if($user_details==5 || $user_details=4):


         $query = mysql_query("select * from thread where id = ".$thread->getId()."", $connection) or die(mysql_error());

					$fetch_row=mysql_fetch_assoc($query);
		 ?>
         <div class="points" style="font-weight:normal;color:#666;margin-top:4px; font-size:9px;">
         IP:<?php echo $fetch_row['user_ip']<>''?$fetch_row['user_ip']:'Not Available';?>
         </div>
         <?php endif;?>

         <?php

		 	 //////// follow me
		//	 echo "<pre>";
		 $current_user_id=$_SESSION['symfony/user/sfUser/attributes']['symfony/user/sfUser/attributes']['user_id'];
			  $detailPoints[id];
			 //echo "</pre>";
         if($current_user_id<>$detailPoints[id]):

		 $query_fm = mysql_query("select * from expert_subscribers where expert_id=".$detailPoints[id]." and 	user_id=".$current_user_id, $connection) or die(mysql_error());
		//$detailPoints = mysql_fetch_assoc($query);
					if(mysql_num_rows($query_fm)<=0):
				 ?>
					<div class="followme" style="font-weight:normal;color:#666;margin-top:4px;">
                     <a href="<?php echo $curr_url;?>?follow=true&user_id=<?php
					  echo $current_user_id;?>&expert_id=<?php
					   echo $detailPoints[id];?>">Follow Me</a>  </div>
		<?php
						else:
						echo "<div class='following'>Following</div>";
						endif;
		endif;
		 ////////end follow me
?>
		<?php if($thread->getSchoolGrade() != NULL): ?>
        <div class="points">School Grade: <?php echo $thread->getSchoolGrade() ; ?> </div>
        <?php endif; ?>
      </div>
      <div class="cmmt">
        <div class="info">
          <div> <img src="/images/forum-threads-statuson.gif" alt="" />
            <p><?php echo $thread->getTitle() ; ?></p>
          </div>
          <div class="postdate">
            <?php $date = RaykuCommon::formatDateForPost( $post->getUpdatedAt() ); ?>
            Posted on <?php echo $date; ?> </div>
          <?php



		$logedUserId = $_SESSION['symfony/user/sfUser/attributes']['symfony/user/sfUser/attributes']['user_id'];


            if($sf_user->getRaykuUserId() == $user->getId())
            {
              echo '<div class="btns">';
                if($thread->getVisible() == 1)
                  echo link_to('close','@thread_status?thread_id='.$thread->getId().'&status=close',array('class' => 'close'));
                else
                {
                  // echo link_to('Re-activate','@thread_status?thread_id='.$thread->getId().'&status=reactive',array('class' => 'reac'));
                  echo link_to('Closed','@view_thread?thread_id='.$thread->getId(),array('class' => 'closed'));
                }

                echo link_to('Cancel','@thread_status?thread_id='.$thread->getId().'&status=cancel',array('class' => 'cancel'));

				$_post_time = strtotime($thread->getCreatedAt());

				$_post_time += 300;

				$_now = time();


		if(!empty($logedUserId)) {

			   if($sf_user->getRaykuUser()->getType() == 5)
			   {

				echo '<a id="various1" href="#inline1" title="'.$thread->getId().'" class="edit">Edit</a>';

		  		echo link_to('Delete','@thread_status?thread_id='.$thread->getId().'&status=delete',array('class' => 'delete'));


			    } elseif($sf_user->getRaykuUserId() == $user->getId() && ($_now < $_post_time)) {

					echo '<a id="various1" href="#inline1" title="'.$thread->getId().'" class="edit">Edit</a>';


			    }
		}
              echo '</div>';
              echo '<div class="clear-both"></div>';

            }

	if(!empty($logedUserId)) {

		if($sf_user->getRaykuUser()->getType() == 5) {

					echo '<a id="various1" href="#inline1" title="'.$thread->getId().'" class="edit">Edit</a>';

			  		echo link_to('Delete','@thread_status?thread_id='.$thread->getId().'&status=delete',array('class' => 'delete'));

		   }

	}

          ?>
        </div>
        <!--end of info -->

        <div class="message"> </quote><?php echo $post->getContent(); ?> </div>
        <div class="numbers">
        <?php
		    if ( $thread->getTags() != null ) {
				echo '<p class="message" style="color:#056A9A;padding-top:0;padding-bottom:0;">';
                echo '<b>Tags: <span style="font-weight:normal">'. $thread->getTags();
              echo '</span></p>';
			}
        ?>
        </div>
<?php
$logedUserId = $_SESSION['symfony/user/sfUser/attributes']['symfony/user/sfUser/attributes']['user_id'];

if(!empty($logedUserId)) {

					$c=new Criteria();
					$c->add(UserPeer::ID, $logedUserId);
					$actionCheck =UserPeer::doSelectOne($c);

if($actionCheck->getType() == '5') :

	$_action  = "/forum/expertreplythread/".$thread->getCategoryId()."/".$thread->getId()."/";

else :

	$_action  = "/forum/userreplythread/".$thread->getCategoryId()."/".$thread->getId()."/";

endif;



 ?>

<div class="quick_reply">


					<form action="<?php echo $_action; ?>" method="post">



<?php

$_postId = "post_id[".$_SESSION['post_index']."]";

$_quick = "quick[".$post->getId()."]";


?>
<p align="right" style="color:#056A9A;padding:0 20px;"><label><input type="checkbox" name="<?php echo $_quick; ?>" id="<?php echo $_quick; ?>" onClick="return Cookieset(this.id);" >Quote in reply</label>
<br/>
<?php


					$query = mysql_query("select * from thread where
					 id = ".$thread->getId()." and reported=1", $connection) or die(mysql_error());

					if(mysql_num_rows($query) == 0):
?>
                     <a href="<?php echo $curr_url;?>?report=true&thread_id=<?php
					  echo $thread->getId();?>" style="margin-right:20px; margin-top:10px; color:#F00;">Report thread</a>
<?php
       endif;

?>
</p>

<input type="hidden" value="<?php echo $post->getId(); ?>" name="<?php echo $_postId; ?>" id="<?php echo $_postId; ?>"></input>
</div>

<?php } ?>


		<br />
      </div>

      <!-- end of cmmt -->

      <div class="spacer"></div>
    </div>
    <div class="spacer"></div>
    <div class="bottom"></div>
  </div>
  <!-- end of box -->



  <?php
    include_partial( 'expert_best_posts', array( 'expert_best_posts' => $expert_best_posts ) );
    include_partial( 'expert_others_posts', array( 'expert_others_posts' => $expert_others_posts ) );
    include_partial( 'other_best_posts', array( 'other_best_posts' => $other_best_posts ) );
    include_partial( 'other_others_posts', array( 'other_others_posts' => $other_others_posts ) );
  ?>

<br />
  <?php if(!empty($logedUserId)) { ?>
<p style="color:#056A9A;line-height:24px;font-size:16px;"><strong>Quick Reply:</strong></p>	<br />

<?php echo textarea_tag('post_body','',array('size' => '64x15', 'rich' => 'fck')); ?>



							<p align="right" style="padding-top:5px;"><input type="hidden" value="" name="final_id" id="final_id"></input>
                            <input type="submit" class="myButton" value="Reply" name="commit"></p>


  <?php } ?>
</form>

</div>
<!-- end of body-main -->

<script type="text/javascript" src="/fancybox/jquery-1.4.2.min.js"></script>
	<script type="text/javascript" src="/fancybox/jquery.fancybox-1.3.1.js"></script>
	<link rel="stylesheet" type="text/css" href="/fancybox/jquery.fancybox-1.3.1.css" media="screen" />
	<script type="text/javascript">
	var k = jQuery.noConflict();
		k(document).ready(function() {
			k("#various1").fancybox({
				'titlePosition'		: 'inside',
				'transitionIn'		: 'none',
				'transitionOut'		: 'none'
			});
		});
	</script>
	<style type='text/css'>
	th {
	     background-color: #8FB5DB;
		border-color: #DDDDDD ;
	    color: black;
	    font-weight: bold;
	    text-align: center;
	    	font-size: 17px;
	}

	td {
		border-color: #DDDDDD ;
	    	font-size: 15px;
		padding: 6px;
	}
	table {
	 	border: groove;
		border-color: #DDDDDD ;
	    	font-size: 15px;
		border-bottom-width : 20px;
	}


	</style>

<div style="display: none;">
		<div id="inline1" style="width:630px;height:650px;overflow:auto;padding:25px" align="left">


 <div class="body-main">
    <div class="qa">
      <div class="ta">
<?php

$_thread = explode("/",$_SERVER['REQUEST_URI']);

$_thread_id = $_thread[3];

		$thread = ThreadPeer::retrieveByPK($_thread_id);

		$c = new Criteria();
		$c->add(PostPeer::THREAD_ID,$thread->getId());
		$c->addAscendingOrderByColumn(PostPeer::ID);
		$post = PostPeer::doSelectOne($c) ;


$logedUserId = $_SESSION['symfony/user/sfUser/attributes']['symfony/user/sfUser/attributes']['user_id'];

if(!empty($logedUserId)) {

					$c=new Criteria();
					$c->add(UserPeer::ID, $logedUserId);
					$actionCheck =UserPeer::doSelectOne($c);

if($actionCheck->getType() == '5') :

	 echo form_tag('@expertreply_thread?forum_id='.$thread->getCategoryId().'&thread_id='.$thread->getId());

else :

	echo form_tag('@userreply_thread?forum_id='.$thread->getCategoryId().'&thread_id='.$thread->getId());

endif;

}

?>







<h1>
<input type="text" style="color: rgb(0, 0, 0); width:500px; height=30px;" size="30" value="<?php echo $thread->getTitle();?>" id="post_edit_title" name="post_edit_title"></h1>


        <div class="clear"></div>
        <div class="sep"></div>
      </div>
      <!--ta-->
      <div class="bg">  </div>
      <!--bg-->
      <div class="b"></div>
    </div>
    <!--qa--><!--qa--><!--qa-->

    <div class="qa">
      <div class="tb">
        <h1>Description</h1>
        <div class="clear"></div>
        <div class="sep"></div>
      </div>
      <!--tb-->
      <div class="answer_submit">

        <?php $content = $post->getContent(); ?>


        <?php echo textarea_tag('post_edit_content',$content,array('size' => '60x30', 'rich' => 'fck')); ?> </div>
      <!--bg-->
      <div class="b"></div>
    </div>
    <!--qa-->

    <!--     <a class="publish_response" href="#">Publish response</a>-->

    <input type="submit" name="Post" class="publish_response">
      </form>
  </div>



		</div>
        </div>

<script type="text/javascript">
var setValue = 1;

function Cookieset(id) {



	if (document.getElementById(id).checked == true && setValue == 1) {

		var newId = id.split('[');

		var lastOne = newId[1].split(']');

		setValue = 2;

		document.getElementById('final_id').value = lastOne[0];

		return true;

	} else if(document.getElementById(id).checked == false && setValue == 2) {

		document.getElementById('final_id').value = '';

		setValue = 1;

		return true;

	} else if (document.getElementById(id).checked == true && setValue == 2) {

		alert("Woah! You've already selected a post to quote!");

		document.getElementById(id).checked = false;

		return false;

	}

}
</script>
