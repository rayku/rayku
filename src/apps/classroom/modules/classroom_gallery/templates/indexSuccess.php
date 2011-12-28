<?php use_helper('MyText') ?>

<div class="title" style="float:left">

	<img src="../../../images/arrow-right.gif" alt="" />

	<p>Viewing Class Album</p>

</div>



<div class="spacer"></div>



<div class="entry picvidgal">

	<div class="top"></div>

	<div class="content" style="margin-bottom:auto;">

		<div class="info-box">

			<h3>Galleries in Classroom</h3>				

				<?php if (count($galleries) > 0): ?>

				<?php foreach ($galleries as $gallery): ?>

				<?php /* @var $gallery Gallery */ ?>				

					<?php echo link_to(htmlentities($gallery->getTitle()) .

					 ' (' . $gallery->countGalleryItems() . ' ' .

					  pluralise($gallery->countGalleryItems(), 'item') . ')', 'classroom_gallery/show?id=' .

					   $gallery->getId()) ?>				 

				<?php endforeach ?>

				<?php else: ?>

					No galleries found!

				<?php endif ?>										

		</div>

		<div class="clear-both"></div>			

	</div>

	<div class="bottom"></div>

</div>



<?php if ($sf_user->isAuthenticated() && $owner->equals($sf_user->getRaykuUser())): ?>

	<?php echo link_to('Create gallery', 'classroom_gallery/create', array('class'=>'blue','style'=>'float:left; line-height:35px;')) ?>

<?php endif; ?>