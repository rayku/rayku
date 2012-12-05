<?php
/**
 * Common payment class
 *
 * @package   Rayku
 * @category  Payment
 */
abstract class Payment_Common implements Payment
{
	/**
	 * @var  User
	 */
	protected $user;

	/**
	 * Sets a user for payment
	 *
	 * @param   User
	 * @return  void
	 */
	public function __construct(User $user)
	{
		$this->user = $user;
	}
}
