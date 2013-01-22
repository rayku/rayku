<?php
require_once dirname(dirname( __FILE__ )) . '/lib/vendor/symfony1/lib/autoload/sfCoreAutoload.class.php';
require_once dirname(dirname( __FILE__ )) . '/lib/RaykuCommon.class.php';
sfCoreAutoload::register();

$connection = RaykuCommon::getDatabaseConnection();
$time = time();

mysql_query("INSERT INTO `sendmessage` (`expert_id`, `asker_id`, `chat_id`, `time`) VALUES('".$_REQUEST['loginId']."', '".$_REQUEST['askerid']."', '".$_REQUEST['newchatid']."', '".$time."')", $connection) or die(mysql_error());
mysql_query("insert into popup_close(user_id) values(".$_REQUEST['loginId'].")", $connection) or die(mysql_error());
?>
