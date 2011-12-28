<?php

		$conn = Propel::getConnection();

if($conn)
print_r($conn);
else
echo "Not Done";

?>