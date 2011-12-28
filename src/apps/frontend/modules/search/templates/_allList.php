<?php include_partial( 'global/pager', array( 'raykuPager' => $raykuPager ) ); ?>

<?php
  use_helper('Javascript');

  $objects = $raykuPager->getPager()->getResults();
  $search = $raykuPager->getPager()->getSearch();

  foreach( $objects as $object )
  {
    $partialTemplateName = $search->getPartialTemplateNameFor( $object );
    include_partial( $partialTemplateName, array( 'object' => $object ) );
  }
?>

<?php include_partial( 'global/pager', array( 'raykuPager' => $raykuPager ) ); ?>

