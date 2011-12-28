<?php use_helper('MyAvatar') ?>

<div class="comments" style="margin-top:20px;">
  <h4><em>+</em> Comments </h4>
<?php $results = $raykuPager->getPager()->getResults();
$maxCount = count( $results ); 

?>

 <?php

$logedUserId = $_SESSION['symfony/user/sfUser/attributes']['symfony/user/sfUser/attributes']['user_id'];

  if($maxCount > 0)
  {
		  echo '<ul>';
	    foreach($results as $new)
	    {

		  echo '<li>';
				echo avatar_tag_for_user($new->getUserRelatedByPosterId(), 3);

				echo '<div class="commentator">';
				echo link_to( $new->getUserRelatedByPosterId()->getName(), '@profile?username=' . $new->getUserRelatedByPosterId()->getUsername());
				echo '</div>';
		?>

			<div class="comment-content"> <p> <?php echo $new->getContent();  ?> </p> </div>
			 <div class="comment-time"><?php echo $new->getCreatedAt( "l , F jS, Y - g:i A" ); 
echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";


			if($new->getPosterId() == $_COOKIE["newUser"] || $new->getPosterId() == $logedUserId || $new->getRecipientId() == $logedUserId)
			{

			echo link_to('Delete Post', 'profile/delete?id='.$new->getId(), array('class' => 'navlink delete', 'onclick' => "return confirm('Are you sure?');" )); 
			}
			?></div>
		</li>
		<?php
	    }
		 echo '</ul>';
   } else {
?>
	  <div>
    <p style="font-size:12px; font-weight:bold; color:#999999;"> No comment posted. </p>
  </div>
	<?php }
?>
</div>
<div style="padding-left: 10px;">
<?php include_partial('global/pager', array('raykuPager' => $raykuPager)) ?>
</div>

