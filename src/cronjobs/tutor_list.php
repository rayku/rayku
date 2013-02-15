<?php
require_once dirname(dirname( __FILE__ )) . '/lib/vendor/symfony1/lib/autoload/sfCoreAutoload.class.php';
require_once dirname(dirname( __FILE__ )) . '/lib/RaykuCommon.class.php';
require_once dirname(dirname( __FILE__ )) . 'lib/service/UsersAvailabilityChecker.class.php';
sfCoreAutoload::register();
RaykuCommon::getDatabaseConnection();

$statusFinder=new UsersAvailabilityChecker();

$onlineUsers=$statusFinder->getOnlineUsers();
mysql_query("UPDATE tutor_profile SET online_status='0'");

foreach($onlineUsers as $onlineUser){
    if(mysql_num_rows(mysql_query("SELECT * FROM tutor_profile WHERE user_id='$onlineUser'"))>0){
        mysql_query("UPDATE tutor_profile SET online_status='0' WHERE user_id='$onlineUser'");
    }
}


