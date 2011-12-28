<div id="memberlist_ajax">
  <?php

    include_partial( 'global/pager', array( 'raykuPager' => $raykuPager ) );
    if( $raykuPager->getPager()->haveToPaginate() )
      echo '<div class="spacer" style="margin-bottom: 5px"></div>';
  ?>
  <div class="top"></div>
  <div class="cont">
    <ul>
      <?php
        $users = $raykuPager->getPager()->getResults();
        $iUsersCount = count( $users );

        if( $iUsersCount > 0 )
        {
          $i = 1;
          foreach( $users as $user )
          {
            echo '<li '.($iUsersCount == $i++ ? 'class="last"' : ''). '>';
              echo include_partial( 'member', array( 'user' => $user ) );
            echo '</li>';
          }
        }
        else
        {
          echo '<li class="last" style="font-size:14px;color:#444444;margin-top:10px">There are no users to display.</li>';
        }
      ?>
      <div class="clear-both"></div>
    </ul>
  </div><!--cont-->
  <div class="bot"></div>
</div><!--memberlist-->
