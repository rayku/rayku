<?php
  $user = UserPeer::retrieveByPk( $object['ID'] );
  include_partial('userBlock', array('user' => $user, 'ajaxAdd' => true) );
?>
