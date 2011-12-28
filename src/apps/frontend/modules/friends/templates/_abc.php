<?php use_helper('Javascript') ?>

<div class="abc">
    <?php
      $aAbc = array( 'a','b','c','d','e','f','g','h','i','j','k','l',
                     'm','n','o','p','q','r','s','t','u','v', 'w','x','y','z' );

      foreach( $aAbc as $sLetter )
      {
        echo link_to_remote( $sLetter, array(  'url' => 'friends/index?l='.$sLetter,
                                               'update' => 'memberlist_ajax'
                                  )
        );
      }
    ?>
  
    <div class="clear-both"></div>
  </div><!--abc-->