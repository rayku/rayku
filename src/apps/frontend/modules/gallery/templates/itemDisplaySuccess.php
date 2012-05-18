<?php /* @var $galleryItem GalleryItem */ ?>

<?php $gallery = $galleryItem->getGallery() ?>
<?php /* @var $gallery Gallery */ ?>

<div id="top" style="margin-left:16px;padding-top:2px">
  <div style="width:30px; float:left;"><img height="25" width="42" src="<?php echo image_path('green_arrow.jpg', false); ?>"/></div>
    <div style="font-size:16px; color:#1C517C; font-weight:bold; margin-left:25px; padding-top:3px;float:left"><a href="/gallery/list/<?php echo $sf_user->getRaykuUser()->getId() ?>">Gallery Home</a> > <a href="/gallery/show/<?php echo htmlentities($gallery->getId()) ?>">Album "<?php echo htmlentities($gallery->getTitle()) ?>"</a> > View</div>

                        <div class="spacer"></div>
                    </div>
<div class="body-main">

<div class="box">
                        	<div class="top"></div>
                            <div class="content">
                          
                          <img src="<?php echo url_for('@gallery_image_show?id=' . $galleryItem->getId()) ?>" alt="<?php echo $galleryItem->getFileName() ?>"  style="max-width:600px"  />

                                <div class="postdate">Posted on: <strong><?php echo $galleryItem->getCreatedAt('jS')." of ".$galleryItem->getCreatedAt('F')." ,".$galleryItem->getCreatedAt('Y');?></strong></div>

                            </div>
                            <div class="spacer"></div>
                            <div class="bottom"></div>
                        </div>	

</div>
<div class="body-side">

                                <a href="/gallery/nextPhoto/id/<?php echo $galleryItem->getId(); ?>" class="navlink next">View next photo</a>

                                <a href="/gallery/previousPhoto/id/<?php echo $galleryItem->getId(); ?>" class="navlink back">View previous photo</a>

								<div class="divider"></div>
								<?php echo link_to('Back to album', '@gallery_show?id=' . $gallery->getId(),array("class"=>"navlink gback")) ?>	
                                <!--<a href="#" class="navlink gback">Back to album</a>-->

                                <div class="divider"></div>

                                <?php if ($sf_user->isAuthenticated() && $gallery->isOwnedBy($sf_user->getRaykuUser())): ?>
									<?php echo link_to('Delete this photo', '@gallery_item_delete?id='.$galleryItem->getId(),array('class' => 'navlink delete', 'onclick' => "return confirm('Are you sure?');" )); ?>
								<?php endif ?>
                                <!--<a href="#" class="navlink delete">Delete this photo</a>-->

					</div>
