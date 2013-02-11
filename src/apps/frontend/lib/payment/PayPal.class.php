<?php
/**
 * PayPal payment
 *
 * @package   Rayku
 * @category  Payment
 */
abstract class Payment_PayPal extends Payment_Common
{
	const SESSION_NAMESPACE = 'paypal';
	const SESSION_TOKEN     = 'token';
	const SESSION_AMOUNT    = 'amount';

	/**
	 * @var  string  Token from setExpressCheckout response
	 */
	protected $token;

	/**
	 * @var  PayPal_Feature
	 */
	protected $paypal;

	/**
	 * Implements [Payment::add]
	 *
	 * @throws  PaymentException
	 * @param   type
	 * @return  void
	 */
	public function add(array $data)
	{
		throw new BadMethodCallException('"add" method for PayPal payment not implemented');
	}

	/**
	 * Implements [Payment::remove]
	 *
	 * @param   type
	 * @return  void
	 */
	public function remove()
	{
		throw new BadMethodCallException('"remove" method for PayPal payment not implemented');
	}

	/**
	 * Sets token
	 *
	 * @param   string  PayPal token
	 * @return  void
	 */
	public function setToken($token)
	{
		$this->token = $token;
	}

	/**
	 * Returns token
	 *
	 * @return  string
	 */
	public function getToken()
	{
		return $this->token;
	}

	/**
	 * Sets PayPal gateway library
	 *
	 * @param   PayPal_Feature
	 * @return  void
	 */
	public function setPayPal(PayPal_Feature $paypal)
	{
		$this->paypal = $paypal;
	}

	/**
	 * Returns PayPal gateway library
	 *
	 * @return  PayPal_Feature
	 */
	public function getPayPal()
	{
		return $this->paypal;
	}
}
