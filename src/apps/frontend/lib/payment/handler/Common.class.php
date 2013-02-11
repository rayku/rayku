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
	 * @var  string  Default redirect URL
	 */
	protected $redirectUrl = '@points_buy';

	/**
	 * @var  sfNamespacedParameterHolder
	 */
	protected $parameterHolder;

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
	public function __construct(User $user, sfNamespacedParameterHolder $parameterHolder = null)
	{
		$this->user = $user;
		$this->parameterHolder = $parameterHolder;
	}

	/**
	 * Implements [Payment_Handler::getRedirectUrl]
	 *
	 * @return  string|null
	 */
	public function getRedirectUrl()
	{
		return $this->redirectUrl;
	}
}
