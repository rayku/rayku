<?php $gallery = $galleryItem->getGallery() ?>

<div class="title" style="float:left">

	<img src="images/arrow-right.gif" alt="" />

	<p>Viewing Class Album</p>

</div>



<div class="spacer"></div>



<div class="entry picvidgal">

	<div class="top"></div>

	<div class="content">

		<div class="info-box">

			<h3>Image</h3>

			<p>

				<img src="<?php echo url_for('@gallery_image_show?id=' . $galleryItem->getId()) ?>" alt="<?php echo $galleryItem->getFileName() ?>" style="height:auto; width:auto;" />

			</p>

			<?php if($galleryItem->getUserId()): ?>
			<p>			
				<?php
					$galleryuser = UserPeer::retrieveByPk($galleryItem->getUserId());
					if($galleryuser)
					echo "Submitted By : ".$galleryuser->getUsername();
				?>
			</p>			
			<?php endif; ?>


			<p>

				<?php echo link_to('Back to gallery..', 'classroom_gallery/show?id=' . $gallery->getId()) ?>

			</p>

		</div>		

		<div class="clear-both"></div>

	</div>

	<div class="bottom"></div>

</div>