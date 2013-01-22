<?php


$values = array("0" => 'veera', "1" => "dile", "2" => "varman");

$limitation = "dile,veera";

$op = "!~";

$return = contextTarget($values, $limitation, $op);


echo $return;


function contextTarget($values, $limitation, $op)
{


$_final_result = false; $_matched_keyword = '';

foreach($values as $value) {



   $limitation = strtolower($limitation);

  $limitation = trim($limitation);

   $value = strtolower($value);
        
  $value = trim($value);


    if ($op == '==') {

        $result = $limitation == $value;
    } elseif ($op == '!=') {

        $result = $limitation != $value;
    } elseif ($op == '=~') {

        $result = MAX_stringContains($limitation, $value);

    } elseif ($op == '!~') {

        $result = !MAX_stringContains($limitation, $value);

    }


        if($result) {

			if(empty($_matched_keyword)) :
				$_matched_keyword = $value;
			else:
				$_matched_keyword .= ",".$value;
			endif;

                               $_final_result = true;
        }

}

return $_matched_keyword;

}

function _getSRegexpDelimited($sRawRegexp)
{
    return '#' . str_replace('#', '\\#', $sRawRegexp) . '#';
}


function MAX_stringContains($sString, $sToken)
{
    return strpos($sString, $sToken) !== false;
}


?>
