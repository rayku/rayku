<?php use_helper('Text') ?>
<?php use_helper('Javascript') ?>

<div id="myzone"></div>
<div style="border:1px; width:50%; height:50px; margin:10px; padding:10px;">
  <?php
    foreach($voicechatlist as $voicechat)
    {
		  echo '<p>';
      $receiver = UserPeer::retrieveByPk($voicechat->getReceiverId());
      echo $receiver->getUsername()." has send you voice live chat request.";
      echo '</p>';
      echo '<p>';
			echo link_to_remote('Accept',array(
				'update'	=>	'myzone',
				'url'	=>	'classroom/acceptchat?receiver_id='.$voicechat->getReceiverId(),
				));
      echo link_to_remote('Decline',array(
				'update'	=>	'myzone',
				'url'	=>	'classroom/declinechat?receiver_id='.$voicechat->getReceiverId(),
				));
      echo '</p>';
    }
  ?>
</div>