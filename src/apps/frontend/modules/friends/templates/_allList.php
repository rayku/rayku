<?php use_helper('MyAvatar') ?>
<div style="padding-right: 10px;">
<?php  include_partial('global/pager', array('raykuPager' => $raykuPager)) ?>
</div>
<div class="clear"></div>
<div class="show-members">
  <?php
    $members = $raykuPager->getPager()->getResults();
    if( count($members) > 0 )
    {
      foreach( $members as $user)
      {
        include_partial('search/userBlock', array('user' => $user, 'ajaxAdd' => true) );
      }
    }
    else
    {
      echo '<div style="padding:50px;font-size:16px;border-bottom:1px dashed #CCCCCC">The database returned no records - there are no members to show here.</div>';
    }
  ?>
</div>
<div class="clear"></div>
<div style="padding-right: 10px;">
<?php include_partial('global/pager', array('raykuPager' => $raykuPager)) ?>
</div>
