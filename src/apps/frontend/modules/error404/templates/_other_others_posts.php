<?php


					$con = mysql_connect("localhost", "rayku_db", "db_*$%$%");
		                        $db = mysql_select_db("rayku_db", $con);


$result = explode("/",$_SERVER['REDIRECT_URL']);


$queryBest = mysql_query("select * from post where thread_id = ".$result[3]." order by created_at ASC limit 0,1 ") or die(mysql_error());
$rowBest = mysql_fetch_array($queryBest);




foreach($other_others_posts as $post)
{ 
		 
		 	$c =new Criteria();
			$c->add(UserPeer::ID,$post->getPosterId());
			$user = UserPeer::doSelectOne($c);
			
		?>

<div class="box">
  <div class="top"></div>
  <div class="content">
    <div class="userinfo">
      <div class="avatar-holder" style="float:none !important;"> <?php echo avatar_tag_for_user($user); ?> </div>
      <div class="spacer"></div>

<?php 



					$query = mysql_query("select * from user_score where user_id=".$user->getId()) or die(mysql_error());
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

<?php  echo link_to($user->getName(), 'http://rayku.com/tutor/' . $user->getUsername(),array('class' => 'username')) ?></div>
<div class="points" style="font-weight:normal;color:#666">Posts: <strong><?php $logedUserId = $user->getID();
		$v = new Criteria();
		$v->add(PostPeer::POSTER_ID, $logedUserId);
		$_postCount = PostPeer::doCount($v) ;  

		echo $_postCount; ?></strong> </div>
        
        <div class="points" style="font-weight:normal;color:#666;margin-top:4px;">RP: <strong><?php 
		$query = mysql_query("select * from user where id=".$logedUserId." ") or die(mysql_error());
		$detailPoints = mysql_fetch_assoc($query);
		echo $detailPoints['points'];
		?>
        </strong> </div>
   
        <?php
		 
		 $query_es = mysql_query("select * from user_score where user_id=".$detailPoints[id]." ") or die(mysql_error());
		$es_score = mysql_fetch_assoc($query_es);
		//echo $detailPoints['points'];
		 
		 
		 ?>
         <div class="points" style="font-weight:normal;color:#666;margin-top:4px;font-size:9px;"> <strong>Expert Score:</strong> <?php echo $es_score['score']; ?> ES  </div>
            <?php
				  
				    $query_usr = mysql_query("select * from user where id=".$detailPoints[id]." ") or die(mysql_error());
		$user_details = mysql_fetch_assoc($query_usr);
		 if($user_details==5 || $user_details=4):
		 
		 
         $query = mysql_query("select * from post where
					 id = ".$post->getId()."") or die(mysql_error());
					
					$fetch_row=mysql_fetch_assoc($query);
		 ?>
         <div class="points"  style="font-weight:normal;color:#666;margin-top:4px; font-size:9px;">
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
		 
		 $query_fm = mysql_query("select * from expert_subscribers where expert_id=".$detailPoints[id]." and 	user_id=".$current_user_id) or die(mysql_error());
		//$detailPoints = mysql_fetch_assoc($query);
					if(mysql_num_rows($query_fm)<=0): 
				 ?>
					<div class="points" style="font-weight:normal;color:#666;margin-top:4px;">
                     <a href="<?php echo $curr_url;?>?follow=true&user_id=<?php
					  echo $current_user_id;?>&expert_id=<?php
					   echo $detailPoints[id];?>">Follow Me</a>  </div>
		<?php
						else:			
						echo "Following";
						endif;
		endif;
		 ////////end follow me
?>
</div>
    <div class="cmmt">
      <div class="info">
        <?php $date = RaykuCommon::formatDateForPost( $post->getUpdatedAt() ); ?>
        <div class="postdate">Posted on <?php echo $date; ?></div>
        <?php
            $thread = ThreadPeer::retrieveByPK( $post->getThreadId() );




	if($rowBest["poster_id"] != $user->getId()) :

            if($sf_user->getRaykuUserId() == $thread->getPosterId() )
            {
              $best_resp_count = PostPeer::getCountOfBestResponseForThread(  $thread );

              if( $best_resp_count < 1)
              {
                echo link_to( 'Set as best',
                              'forum/bestresponse?post_id='.$post->getId().'&temp='.$post->getUpdatedAt(),
                              array('class' => 'setbest') );
              }
            }

	endif;





          ?>
      </div>
      <!--      <p class="message"><?php // echo nl2br(htmlentities($post)) ?> </p> -->

<?php //$_post = explode("",$post);?>
      <div class="message" style="font-weight:normal"><?php echo str_replace("*^-", "",$post); ?> </div>

<br/>
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

<?php $_quick = "quick[".$post->getId()."]";  ?>

	<p align="right" style="color:#056A9A;padding:0 20px;"><label><input type="checkbox" name="<?php echo $_quick; ?>" id="<?php echo $_quick; ?>" onClick="return Cookieset(this.id);" >Quote in reply</label>
    <br/>
<?php

	$con = mysql_connect("localhost", "rayku_db", "db_*$%$%");
		                        $db = mysql_select_db("rayku_db", $con);
					
					
					$query = mysql_query("select * from post where
					 id = ".$post->getId()." and reported=1") or die(mysql_error());
					
					if(mysql_num_rows($query) == 0):
?>
                     <a href="<?php echo $curr_url;?>?report=true&post_id=<?php
					  echo $post->getId();?>" style="margin-right:30px; margin-top:10px; color:#F00;">Report post</a>
<?php        endif; ?>
    </p>
	
<?php

$_SESSION['post_index'] +=  1;


$_postId = "post_id[".$_SESSION['post_index']."]"; 
?>

<input type="hidden" value="<?php echo $post->getId(); ?>" name="<?php echo $_postId; ?>" id="<?php echo $_postId; ?>"></input>




						
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
?>
