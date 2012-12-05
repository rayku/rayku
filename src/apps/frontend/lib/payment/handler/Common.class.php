<?php
/**
 * Common payment handler class
 *
 * @package   Rayku
 * @category  Payment
 */
abstract class Payment_Handler_Common implements Payment_Handler
{
	/**
	 * @var  User
	 */
	protected $user;

	/**
	 * Sets a user
	 *
	 * @param   User
	 * @return  void
	 */
	public function __construct(User $user)
	{
		$this->user = $user;
	}
}
