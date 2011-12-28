<?php
  $propelPager = $raykuPager->getPager();
  if (!$propelPager->haveToPaginate())
    return;
?>
<div class="<?php echo $raykuPager->getCssClass(); ?>">
<?php
  $page = $propelPager->getPage();
  $lastPage  = $propelPager->getLastPage();
  echo "<p>Page $page of $lastPage</p>";

  echo $raykuPager->generateLinkPreviousPage();

	foreach ($propelPager->getLinks() as $page)
		echo $raykuPager->generateLinkForPage( $page );

  echo $raykuPager->generateLinkNextPage();
?>
</div>
