<?php
/**
 * PayPal payment execution
 *
 * Capture payment
 *
 * @package   Rayku
 * @category  Payment
 */
class Payment_PayPalExecute extends Payment_PayPal
{
	/**
	 * Implements [Payment::execute]
	 *
	 * @throws  PaymentException
	 * @param   float  Payment amount
	 * @return  void
	 */
	public function execute($amount)
	{
		$response = $this->paypal->getExpressCheckoutDetails($this->token);

		if ($response->isFailure())
			throw new PaymentException($response->getMessage());

		$response = $this->paypal->doExpressCheckoutPayment($amount, $response->getToken(), $response->getPayerId());

		if ($response->isFailure())
			throw new PaymentException($response->getMessage());
	}

}
