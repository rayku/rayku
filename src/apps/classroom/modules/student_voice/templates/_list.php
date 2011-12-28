			<div class="content tabs-box">
				<?php foreach ($voices as $voice) {  ?>
					<h3><?php echo $voice->getTitle();?></h3>
				<div class="author">Submitted by: <span><?php echo $voice->getUser()->getUsername();  ?></span></div>
				<div class="votes">Votes: <span><?php echo $voice->getSumOfVotes(); ?></span></div>
				<div class="item-divider"></div>
        <?php include_partial( 'list_voting_form', array( 'voice' => $voice ) ); ?>
              <p><?php echo $voice->getDescription() ?></p>
			  <div style="clear:both;"></div>

        <?php if( $sf_user->hasCredential( 'student_voice_management' ) ) { ?>
        <div class="actionbuttons" align="right">
          <?php
            if( $voice->getStatus() == StudentVoice::STATUS_NOT_ACCEPTED )
              echo link_to(image_tag('acceptbutton.jpg'), 'student_voice/acceptvote?id='.$voice->getId());
          ?>
          <?php echo link_to(image_tag('deletebutton.jpg'), 'student_voice/deletevote?id='.$voice->getId()) ?>
        </div>
        <?php } ?>

  <div class="block-divider"></div>
				<?php  } ?>
			</div>
