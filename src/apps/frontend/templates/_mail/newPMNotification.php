<?php
if( false ) $pm = new PrivateMessage();
$senderName = $pm->getSender()->getName();
$recipientName = $pm->getRecipient()->getName();
$subject = $pm->getSubject();

$content = trim($pm->getBody());

	$length = strlen($content);

	if($length > 200)
		{

			$content = substr($content, 0, 200);
			$content = $content."...";

		}

$pmLink = link_to( "$subject", 'message/read?id=' . $pm->getId(), array('absolute' => true) );
?>

<p>DO NOT REPLY TO THIS EMAIL!<br />
***************************<br /><br />

Hello <?php echo $recipientName; ?>,<br /><br />

You have received a private message at Rayku.com from <?php echo $senderName; ?>, titled: "<b><?php echo $pmLink; ?></b>".<br />

--------------------------<br />
<?php echo $content; ?><br />
--------------------------<br /><br />

To reply or delete this private message and others, please log in to your Rayku.com account here:<br />
<a href="http://www.rayku.com/message/inbox">http://www.rayku.com/message/inbox</a><br /><br />

-------------------<br />
Thanks!<br />
Rayku Administration<br />
http://www.rayku.com
</p>
