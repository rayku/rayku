<?php
/**
 * Rayku points model
 *
 * POPO of type RaykuPoints are not persisted in the database ATM.
 * However, this can  change in the future.
 *
 * @package    lib.model
 */
class RaykuPoints
{
	/**
	 * @var  float  Current Rayku point balance
	 */
	protected $balance = 0;

	/**
	 * @var  array  Available Rayku point (RP) packages
	 */
	public static $availablePointPackages = array(5, 10, 25, 50, 100);

	/**
	 * Creates a new RaykuPoints model
	 *
	 * @param   float   Current Rayku points balance
	 * @return  void
	 */
	public function __construct($balance)
	{
		$this->balance = $balance;
	}

	/**
	 * Calculates a new Rayku points estimate
	 *
	 * @param   float   Rayku points to be added
	 * @return  float
	 */
	public function newEstimate($points)
	{
		return $this->balance + $points;
	}

	/**
	 * Returns current Rayku points balance
	 *
	 * @return  float
	 */
	public function getBalance()
	{
		return $this->balance;
	}
}
