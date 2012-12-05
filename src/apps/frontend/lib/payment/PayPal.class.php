<?php
/**
 * PayPal payment
 *
 * @package   Rayku
 * @category  Payment
 */
class Payment_PayPal extends Payment_Common
{
	/**
	 * @var  PayPal
	 */
	protected $paypay;

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
	 * Implements [Payment::execute]
	 *
	 * @throws  PaymentException
	 * @param   float  Payment amount
	 * @return  void
	 */
	public function execute($amount)
	{
		throw new BadMethodCallException('"execute" method for PayPal payment not implemented');
	}
}
