<div class="title" style="float:left">

	<img src="../../../images/arrow-right.gif" alt="" />

	<p>Viewing Class Album</p>

</div>

<div class="spacer"></div>

<div class="entry picvidgal">

	<div class="top"></div>

	<div class="content">

		<div class="info-box">

			<h3><?php echo htmlentities($gallery->getTitle()) ?></h3>

      <?php $raykuUser = $sf_user->getRaykuUser(); ?>

			<p>The album description should go here, check out these awesome party photos I took last night, seriously they&quot;re so awesome that it&quot;s unbelievable!!! They include every single member of rayku getting crazy! Probably THE best album on teh interwebs.</p>

		</div>

		<div class="album-actions">

			<a href="<?php echo url_for('classroom_gallery/upload?id=' . $gallery->getId());?>">

				<img src="../../../images/add-to-album.png" alt="Add to Gallery" />

			</a><br />
			
			<?php if ($sf_user->isAuthenticated() && $gallery->isOwnedBy($raykuUser)): ?>
			
			<a href="<?php echo url_for('classroom_gallery/edit?id=' . $gallery->getId())?>">

				<img src="../../../images/edit-album.png" alt="Edit Gallery" />

			</a><br />

			<?php echo link_to('<img src="../../../images/delete-album.png" alt="Delete Gallery" />', 'classroom_gallery/delete?id=' . $gallery->getId(), 'confirm=Are you sure?') ?>			
			
			<?php endif;?>
		</div>

		

		<div class="clear-both"></div>

	</div>

	<div class="bottom"></div>

</div>



<div class="entry pic-box">

	<div class="top"></div>

	<div class="content">

		<h3><?php echo count($images);?> Pictures</h3>

		<?php if (count($images) > 0): ?>

			<?php foreach ($images as $image): ?>
				
				<div style="float:left; width: 100px; height:100px; text-align:center;">	
					
					<?php echo link_to('<img src="' . url_for('classroom_gallery/itemShow?id='.$image->getId().'&thumb=true') . '" alt="' . htmlentities($image->getFileName(), ENT_QUOTES) . '" />', 'classroom_gallery/itemDisplay?id=' . $image->getId(), array('class' => 'pic-item', )) ?>

					<br style="clear:both;" />

					<?php 
						$imageowner = UserPeer::retrieveByPk($image->getUserId());
						if($imageowner)
						echo "Submitted by : ".$imageowner->getUsername();
					?>

					<br style="clear:both;" />
					
					<?php if ($sf_user->isAuthenticated() && $gallery->isOwnedBy($raykuUser)): ?>

						<?php echo link_to('Delete', 'classroom_gallery/itemDelete?id=' . $image->getId()) ?>

					<?php endif ?>
					
				</div>
			<?php endforeach ?>

		<?php else: ?>

			No images

		<?php endif ?>

<div class="clear-both"></div>

	</div>

	<div class="bottom"></div>

</div>



<div class="entry video-box">

	<div class="top"></div>

	<div class="content">

		<h3><?php echo count($videos);?> Videos</h3>

		

		<?php if (count($videos) > 0): ?>

			<?php foreach ($videos as $video): ?>
				
				<div style="float:left; width: 100px; height:100px; text-align:center;">	
				<?php /* @var $video GalleryItem */ ?>
				<br style="clear:both;" />

					<?php 
						$videoowner = UserPeer::retrieveByPk($video->getUserId());
						if($videoowner)
						echo "Submitted by : ".$videoowner->getUsername();
					?>
				
				<p>

					<?php echo htmlentities($video->getFileName()) ?> -

					<?php echo link_to('Download', 'classroom_gallery/itemDownload?id=' . $video->getId()) ?>

					<?php if ($sf_user->isAuthenticated() && $gallery->isOwnedBy($raykuUser)): ?>

						/ <?php echo link_to('Delete', 'classroom_gallery/itemDelete?id=' . $video->getId()) ?>

					<?php endif ?>

				</p>
				</div>
			<?php endforeach ?>

		<?php else: ?>

			No videos

		<?php endif ?>

	</div>

	<div class="bottom"></div>

</div>
