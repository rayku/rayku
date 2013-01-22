<?php

$raykuUser = $sf_user->getRaykuUser();

$num_of_row = 0;

$IP = $_SERVER['REMOTE_ADDR'];

$_query = mysql_query("select * from thread  where user_ip='" . $IP . "' and banned=1");
$num_of_row = mysql_num_rows($_query);
if ($num_of_row > 0) {
    echo "
        <script type='text/javascript'>
     document.location='http://" . RaykuCommon::getCurrentHttpDomain() . "/error';
		</script>";
}

$_query = mysql_query("select * from banned_ips  where ip like '%" . $IP . "%' ");
$num_of_row = mysql_num_rows($_query);
if ($num_of_row > 0) {
    echo "
        <script type='text/javascript'>
     document.location='http://" . RaykuCommon::getCurrentHttpDomain() . "/error';
		</script>";
}

$logedUserId = @$_SESSION['symfony/user/sfUser/attributes']['symfony/user/sfUser/attributes']['user_id'];
if ($logedUserId <> '') {
    $user_id = $raykuUser->getId();
    $num_of_row = 0;
    $_query = mysql_query("select * from thread  where 	poster_id='" . $user_id . "' and banned=1");
    $num_of_row = mysql_num_rows($_query);
    if ($num_of_row > 0) {
        echo "
				<script type='text/javascript'>
     document.location='http://" . RaykuCommon::getCurrentHttpDomain() . "/error';
				</script>";
    }
}
?>