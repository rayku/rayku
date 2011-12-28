<form name="frm_vote<?php echo $voice->getId();?>" action="<?php echo url_for('student_voice/vote');?>" method="post" style="margin:0px; padding:0px;">
  <input type="hidden" name="id" value="<?php echo $voice->getId();?>" style="display:none;" />
  <div class="vote">
    <h1><?php echo $voice->getSumOfVotes(); ?></h1> votes
    <hr />
    <div>
      <?php
        $downTitle = 'Vote -1 for this voice';
        $upTitle = 'Vote -1 for this voice';
        echo link_to(
                 image_tag(
                         'thumbsdown.jpg',
                         array( 'alt' => $downTitle,
                                'title' => $downTitle ) ),
                 'student_voice/vote?value=-1&id=' . $voice->getId(),
                 array( 'class' => 'thumbs',
                        'alt' => $downTitle,
                        'title' => $downTitle )
             );
        echo '&nbsp;';
        echo link_to(
                 image_tag( 'thumbsup.jpg',
                            array( 'alt' => $upTitle,
                                   'title' => $upTitle) ),
                 'student_voice/vote?value=1&id=' . $voice->getId(),
                 array( 'class' => 'thumbs',
                        'alt' => $upTitle,
                        'title' => $upTitle)
             );
      ?>
    </div>
    <div style="clear:both;"></div>
  </div>
</form>
