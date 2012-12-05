<?php
/**
 * Tutoring time model
 *
 * @package    lib.model
 */
class TutoringTime
{
	// Default price in RPs for a minut of tutoring time
	const PRICE = 0.4;

	/**
	 * Calculates tutoring time in minutes for the given Rayku points.
	 *
	 * @param   float   Rayku points
	 * @return  int
	 */
	public function calculateForRaykuPoints($points)
	{
		return (int) $points / TutoringTime::PRICE;
	}
}
