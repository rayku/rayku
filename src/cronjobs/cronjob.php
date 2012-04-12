<?php
require_once dirname(dirname( __FILE__ )) . '/lib/vendor/symfony1/lib/autoload/sfCoreAutoload.class.php';
require_once dirname(dirname( __FILE__ )) . '/lib/RaykuCommon.class.php';
sfCoreAutoload::register();

RaykuCommon::getDatabaseConnection();

$time = time()-300;
mysql_query("delete from user_expert where time <= ".$time." ") or die("Expert Delete Error:--->".mysql_error());
mysql_query("delete from sendmessage where time <= ".$time." ") or die("Asker Delete Error:--->".mysql_error());
?>
