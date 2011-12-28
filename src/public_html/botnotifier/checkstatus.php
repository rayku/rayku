<?php


if(!empty($_GET)) {

$status = $_GET['status'];

setcookie('veeradile', $status);
$_COOKIE['veeradile'] = $status;


echo $status;

}

?>
