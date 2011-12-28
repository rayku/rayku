<?php use_helper('Javascript') ?>

<div class="body-main">
  <div id="msgnav" style="float: left; margin-bottom: 0px; margin-left: 7px;">
    <?php
//============================================================Modified By DAC021===============================================================================//
	$a = new Criteria();
	$newValue = explode("/", $_SERVER['REQUEST_URI']);
	 $a->add(UserPeer::USERNAME,$newValue[4]);
	 $newuser = UserPeer::doSelectOne($a); 

      echo link_to_remote( content_tag('span', 'Friends'),
                           array( 'url'      => 'friends/members?username='.$newuser->getUsername(),
                                  'update'   => 'tcontent',
                                  'complete' => 'switchTab(\'members-details-tabs01\');'
                           ),
                           array( 'id'     => 'members-details-tabs01',
                                  'class'  => 'tabmenu'
                           )
      );
//============================================================Modified By DAC021===============================================================================//
    ?>
    <?php
      echo link_to_remote( content_tag('span', 'Your Requests'),
                           array( 'url'      => 'friends/members?type=2',
                                  'update'   => 'tcontent',
                                  'complete' => 'switchTab(\'members-details-tabs02\');'
                           ),
                           array( 'id'     => 'members-details-tabs02',
                                  'class'  => 'tabmenu'
                           )
      );
    ?>
    <?php
      echo link_to_remote( content_tag('span', 'Requests for You'),
                           array( 'url'      => 'friends/members?type=3',
                                  'update'   => 'tcontent',
                                  'complete' => 'switchTab(\'members-details-tabs03\');'
                           ),
                           array( 'id'     => 'members-details-tabs03',
                                  'class'  => 'tabmenu'
                           )
      );
    ?>
  </div>
  <div style="float: left;" class="box">
    <div class="top"></div>
    <div id="tcontent" class="content">
      <?php include_partial( 'allList', array( 'raykuPager' => $raykuPager ) ); ?>
    </div>
  </div>
</div>
