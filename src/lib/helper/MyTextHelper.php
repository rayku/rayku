<?php
function pluralise($count, $singular, $plural = null)
{
	if (1 == $count)
	{
		return $singular;
	}
	else if (null !== $plural)
	{
		return $plural;
	}
	else
	{
		return $singular . 's';
	}
}