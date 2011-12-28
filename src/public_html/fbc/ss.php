<?php
$user = $this->getUser()->getRaykuUser();
$id=$user->getId();
if($id=='')
echo "null id";
else
echo $id;
?>