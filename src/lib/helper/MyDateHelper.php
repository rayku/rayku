<?php

use_helper('MyText');

/**
 * Converts minutes to human readable format
 *
 * Example:
 *     // Displays: 1 hour, 3 minutes
 *     echo date_min_to_human(63);
 *
 * @param   int     Input minutes
 * @return  string
 */
function date_min_to_human($minutes)
{
	$units = array(
		'week'   => 7 * 24 * 60,
		'day'    =>     24 * 60,
		'hour'   =>          60,
		'minute' =>           1,
	);

	$output = array();

	foreach ($units as $name => $divisor)
	{
		if ($quot = intval($minutes / $divisor)) {
			$output[] = $quot.' '.pluralise($quot, $name);

			$minutes -= $quot * $divisor;
		}
	}

	return empty($output) ? '0 minutes' : implode(', ', $output);
}
