<?php
/**
 * PayPal handler class
 *
 * @package   Rayku
 * @category  Payment
 */
class Payment_Handler_PayPal extends Payment_Handler_Common
{
	/**
	 * Implements [Paymeent_Handler::handle]
	 *
	 * @param   Payment
	 * @param   float    Payment amount
	 * @param   array    Extra parameters
	 * @return  void
	 */
	public function handle(Payment $payment, $amount, array $extra = NULL)
	{
		$payment->execute($amount);
	}
}
