<div class="album">
  <div class="title"> <?php echo link_to(
            htmlentities($gallery->getTitle()),
            '@gallery_show?id=' . $gallery->getId(),
            array( 'style'=>'color:#2877B7;font-size:16px;text-decoration:underline' )
          );    ?> </div>
  <div class="subtitle"></div>
  <div class="albcount"> (contains <?php echo $gallery->countGalleryItems() . ' '
                    . pluralise($gallery->countGalleryItems(), 'file') ?>) </div>
  <div class="spacer"></div>
  <?php
    foreach ($gallery->getItems(4) as $image)
      echo link_to(
        '<img src="'
          . url_for('@gallery_image_show_thumb2?id=' . $image->getId())
          . '" alt="'. htmlentities($image->getFileName(), ENT_QUOTES)
          . '"/>',
        '@gallery_image_display?id=' . $image->getId()
      );
  ?>
</div>
