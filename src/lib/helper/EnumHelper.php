<?php
/**
* Determines the possible index/value pairs for the given table/field from their
* Peer objects. Sets the selected index to the value in $selected. Returns the
* HTML for a <select> field accordingly.
*/
function enum_values_select_tag($table, $field, $selected = null)
{
	//Load the options
	$options = call_user_func(array($table.'Peer', 'get'.$field.'s'));
	
	//Return the select area
	return select_tag(strtolower($table).'['.strtolower($field).']', options_for_select($options, $selected), array('style' => 'width: 125px'));
}
?>