<?php
/* @var $gallery Gallery */

$raykuUser = $sf_user->getRaykuUser();
?> 


<div id="top" style="margin-left:16px;padding-top:2px">
  <div style="width:30px; float:left;"><img height="25" width="42" src="<?php echo image_path('green_arrow.jpg', false); ?>"/></div>
    <div style="font-size:16px; color:#1C517C; font-weight:bold; margin-left:25px; padding-top:3px;float:left"><a href="/gallery/list/<?php echo $sf_user->getRaykuUser()->getId() ?>">Gallery Home</a> > Album "<?php echo htmlentities($gallery->getTitle()) ?>"</div>
  <div class="spacer"></div>
</div>

<div class="body-main">
  <?php if (count($images) > 0): ?>
    <div class="box">
      <div class="top-green"></div>
      <div class="content-green">
        <div class="mediacount">
          <img src="<?php echo image_path('ico/album-homepage-pic.gif', false); ?>" alt="" />
          <p><?php echo count($images) . ' Picture' . (count($images) > 1 ? 's':'') ; ?></p>
        </div>

        <div class="spacer"></div>
        
        <?php foreach ($images as $image): ?>
          <div class="row" style="float:left;width:50%;">
            <?php /* @var $image GalleryItem */ ?>

            <?php echo link_to('<img src="' . url_for('@gallery_image_show_thumb2?id=' . $image->getId()) . '" alt="' . htmlentities($image->getFileName(), ENT_QUOTES) . '" />', '@gallery_image_display?id=' . $image->getId()) ?>
            <br />
            <?php if ($sf_user->isAuthenticated() && $gallery->isOwnedBy($raykuUser)): ?>
              <?php echo link_to('Delete', '@gallery_item_delete?id=' . $image->getId(),array('class'=>'deleteImage')) ?> /
            <?php endif ?>
            <?php  if ($sf_user->isAuthenticated() && $image->getUserId()==$sf_user->getRaykuUserId()): ?>
              <?php echo link_to('Set as profile pic', '@gallery_item_set_as_avatar?id=' . $image->getId(),array('class'=>'setAsAvatar')) ?>
            <?php endif ?>
          </div>
        <?php endforeach ?>
      </div>
      <div class="spacer"></div>
      <div class="bottom-green"></div>
    </div>

			<?php //foreach ($images as $image): ?>
				<?php /* @var $image GalleryItem */ ?>
				<!--<p>
					<?php //echo link_to('<img src="' . url_for('@gallery_image_show_thumb?id=' . $image->getId()) . '" alt="' . htmlentities($image->getFileName(), ENT_QUOTES) . '" />', '@gallery_image_display?id=' . $image->getId()) ?>
					
					<?php //if ($sf_user->isAuthenticated() && $gallery->isOwnedBy($raykuUser)): ?>
						<?php //echo link_to('Delete', '@gallery_item_delete?id=' . $image->getId()) ?> /
					<?php //endif ?>
					<?php //if ($sf_user->isAuthenticated()): ?>
						<?php //echo link_to('Set as avatar', '@gallery_item_set_as_avatar?id=' . $image->getId()) ?>
					<?php //endif ?>
				</p>-->
			<?php //endforeach ?>
		<?php else: ?>

    <div class="box">
      <div class="top-green"></div>
        <div class="content-green">
          <div class="mediacount">
              <img src="<?php echo image_path('ico/album-homepage-pic.gif', false); ?>" alt="" />
                <p>0 Pictures</p>
            </div>
          
            <div class="spacer"></div>
            <div class="row">No Pictures to Show.</div>
        </div>
        <div class="spacer"></div>
        <div class="bottom-green"></div>
    </div>
		<?php endif //end of count(images) ?>
 
    <div class="spacer"></div>
    
		<?php if (count($videos) > 0): ?>
       <div class="box">
        <div class="top-green"></div>
          <div class="content-green">
            <div class="mediacount">
                <img src="<?php echo image_path('ico/album-homepage-vid.gif', false); ?>" alt="" />
                  <p>
  <?php if(count($videos)==1): ?>
                  <?php echo count($videos); ?> Video
  <?php else: ?>
                  <?php echo count($videos); ?> Videos
                  <?php endif; ?>
                  </p>
              </div>


              <div class="spacer"></div>
  <?php foreach ($videos as $video): ?>
              <div style="text-align:center;vertical-align:top;width:274px;float:left;padding:5px;">

                      <div id="<?php echo $video->getId()."_vd"; ?>">
                           <a   href="/uploads/gallery/<?php echo $video->getFileSystemPath().".flv"; ?>"
                              style="display:block;width:274px;height:230px;"
                              id="<?php echo $video->getId(); ?>">
                            </a>

                            <!-- this will install flowplayer inside previous A- tag. -->
                            <script>
                              if(flowplayer("<?php echo $video->getId(); ?>")!=null)
                               flowplayer("<?php echo $video->getId(); ?>").unload();
                              flowplayer("<?php echo $video->getId(); ?>", "/js/flowplayer-3.1.4.swf",{  
								clip: {  
									url: '/uploads/gallery/<?php echo $video->getFileSystemPath().".flv"; ?>',  
									// when this is false playback does not start until play button is pressed  
									autoPlay: false  
								}   
							});
                            </script> 
							
                          </div> 

                      <p>
                          <?php //echo htmlentities($video->getFileName()) ?>
                          <?php echo link_to('Download', '@gallery_item_download?id=' . $video->getId(),array('class'=>'setAsAvatar')) ?>
                          <?php if ($sf_user->isAuthenticated() && $gallery->isOwnedBy($raykuUser)): ?>
                              / <?php echo link_to('Delete', '@gallery_item_delete?id=' . $video->getId(),array('class'=>'deleteImage')) ?>
                          <?php endif ?>
                      </p>
            </div>
            <?php endforeach ?>
          </div>
		 	  
          <div class="spacer"></div>
          <div class="bottom-green"></div>
      </div>

		<?php else: ?>			      
      <div class="box">
        <div class="top-green"></div>
          <div class="content-green">
            <div class="mediacount">
                <img src="<?php echo image_path('ico/album-homepage-vid.gif', false); ?>" alt="" />
                  <p>0 Videos</p>
              </div>

              <div class="spacer"></div>
            <div class="row">No Videos to Show.</div>
        </div>
        <div class="spacer"></div>
        <div class="bottom-green"></div>
    </div>
    <?php endif ?>
    
  <br class="clearBlock" />
</div><!-- end of body-main -->
<div class="body-side">
<?php if ($sf_user->isAuthenticated() && $gallery->isOwnedBy($raykuUser)): ?>
    <?php
      echo link_to('Add photos or videos to album', 'gallery/upload?id='.$gallery->getId(), array('class' => 'navlink add'));
      echo link_to('Edit album', 'gallery/edit?id='.$gallery->getId(), array('class' => 'navlink edit'));
      echo link_to('Delete album', 'gallery/delete?id='.$gallery->getId(),
                   array('class' => 'navlink delete', 'onclick' => "return confirm('Are you sure?');" ));
    ?>
<?php else: ?>
  <div class="box">
    <div class="top"></div>
    <div class="content" style="position:relative; _top:-3px; _bottom:-3px;">
      <div class="title" align="left" style="margin-top:0px; font-size:16px; text-align:left">Report Inappropriate Content</div>
      <div class="text" align="left"><span style="font-weight:normal; font-size:14px; line-height:20px">We want to preserve a friendly and respectable environment for all users.<br />
        <br />
        If you see anything overly offensive or inappropriate, please let us know: <a href="mailto:support@rayku.com">support@rayku.com</a> </span></div>
    </div>
    <div class="bottom"></div>
  </div>
<?php endif ?>

<a href="/gallery/list/<?php echo $sf_user->getRaykuUser()->getId() ?>" class="navlink back">Back to Gallery</a>

  </div>
