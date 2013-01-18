<?php use_helper('Text'); ?>
<style type="text/css">
.message ol {
	list-style-type: decimal !important;
}
.message ul {
	list-style-type: disc !important;
}
</style>
<div class="body-main">
  <div class="box">
    <div class="top"></div>
    <div class="content">
      <div class="entry" style="border-top:none">
        <div class="information1">Threads</div>
        <div class="author1">Poster</div>
        <div class="replies1">Replies</div>
        <div class="spacer"></div>
      </div>
      <?php

        $threads = $raykuPager->getPager()->getResults();

$_StickieId = array(); 
 
        if (count( $threads ) > 0 )
        {
		$i = 1;
          foreach($threads as $thread)
          {

		if($thread->getStickie() == 1) :

			$_StickieId[$i] = $thread->getId();

		else :
			$_Non_StickieId[$i] = $thread->getId();
		endif;

		$i++;

	 }

         if (count( $_StickieId ) > 0 && count( $_Non_StickieId ) > 0)
         {
		$threads = array_merge($_StickieId, $_Non_StickieId);

	} else  if (count( $_StickieId ) > 0 && count( $_Non_StickieId ) == 0)
         {
		$threads = $_StickieId;

	} else  if (count( $_StickieId ) == 0 && count( $_Non_StickieId ) > 0)
         {
		$threads = $_Non_StickieId;

	}


          foreach($threads as $thread)
          {

$_class = '';

	  $thread = ThreadPeer::retrieveByPK($thread);
		
            $post = PostPeer::getFirstForThreadId( $thread->getId() );
            $user = UserPeer::retrieveByPK( $thread->getPosterId() );


if(!empty($_StickieId)) : 

	if(in_array($thread->getId(),$_StickieId)) :

		$_class = "background-color:#E6F8FF";

	endif;

endif;
            ?>
      <div class="entry" style="<?php echo $_class; ?>">
        <div class="information" >
          <?php
                  echo link_to($thread, '@view_thread?thread_id='.$thread->getId(),array('class' => 'threadttle'));
                ?>
          <div class="threadst">
            <?php 



				
				$string = strip_tags($post->getContent()) ;

				echo substr($string,0,50) ;

				/*$search_string = '<img';
				$pos = strpos($string, $search_string);

				if ($pos === false) {

					//echo "Inside";
					//echo strip_tags($string);
				} else {  
  					$text = '';
				
					$temp = explode('/>',$post->getContent());
					$text =  substr($temp[1],0,50);
					//echo strip_tags($text);
					
				}
				
				/*
				$string = $post->getContent() ;
				$search_string = '<img';
				$pos = strpos($string, $search_string); 

				if ($pos === false) {
					echo substr($post->getContent(),0,50);
				} else {  
				
					echo " ";
				}*/
			
				 ?>
          </div>
        </div>
        <?php
                echo link_to($user->getUsername(), '@profile?username=' . $user->getUsername(),array('class' => 'author'));
        ?>
        <?php 
			  		
					$c =new Criteria();
					$c->add(PostPeer::THREAD_ID,$thread->getId());
					$countofpost= PostPeer::doCount($c);
			  
			  ?>
        <div class="replies">
          <?php  echo ($countofpost - 1) ; ?>
          Replies</div>
        <div class="spacer"></div>
      </div>
      <?php
          }
        }//end if
       ?>
    </div>
    <div class="spacer"></div>
    <div class="bottom"></div>
  </div>
  <?php include_partial( 'global/pager', array( 'raykuPager' => $raykuPager ) ); ?>
</div>
<div class="body-side">
  <?php

$logedUserId = $_SESSION['symfony/user/sfUser/attributes']['symfony/user/sfUser/attributes']['user_id'];

if(!empty($logedUserId)) { ?>

	 <?php echo link_to('New Topic','@new_thread?forum_id='.$forumID, array('class'=> 'navlink add'));
}
  ?>
  <div class="spacer"></div>
  <div class="box">
    <div class="top"></div>
    <div class="content">
      <div class="title">Search for a topic:</div>
      <?php echo form_tag('@search_thread', array('method'=>'post')); ?>
      <input type="text" id="searchbox" name="threadsearch"/>
      <?php // echo input_hidden_tag('forum_id',$forum->getId()); ?>
      <div class="spacer"></div>
      <?php echo submit_tag('search',array('class' => 'blue')); ?>
      <div class="spacer"></div>
      </form>
    </div>
    <div class="spacer"></div>
    <div class="bottom"></div>
  </div>
  <div class="spacer"></div>
  <?php  $experts = UserPeer::getForExpertCategory( $category->getId() ); ?>
  <?php if( $experts != NULL): ?>
  <div class="box">
    <div class="top"></div>
    <div class="content">
      <div class="title" style="color:#1c517c; font-size:16px">Top 5 Experts In <?php echo $category->getName(); ?></div>
      <?php
      //  $experts = UserPeer::getForExpertCategory( $category->getId() );

        foreach($experts as $expert)
        {
          $best_resp_count = PostPeer::getCountOfBestResponseForExpert( $expert );

          echo '<div class="expert">';
            echo '<strong><a href="'.sfConfig::get('app_rayku_url').'/expertmanager/portfolio/'.$expert->getUsername().'" style="color:#6E6E6E">'.$expert->getName().'</a>: </strong>';
            echo $best_resp_count . ' Best Responses';
          echo '</div>';
        }
      ?>
    </div>
    <div class="spacer"></div>
    <div class="bottom"></div>
  </div>
  <?php endif; ?>
  <?php  echo link_to('Back to Public Forums', '@view_forums',array('class' => 'btmlnk')); ?>
</div>
