<?php
/**
 * PayPal handler class
 *
 * @package   Rayku
 * @category  Payment
 */
class Payment_Handler_PayPalInitialize extends Payment_Handler_Common
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
		sfApplicationConfiguration::getActive()->loadHelpers(array('Url'));

		$payment->setSuccessUrl(url_for('@points_buy_paypal', true));
		$payment->setCancelUrl(url_for('@points_buy', true));

		try {
			$payment->execute($amount);

			$this->parameterHolder->set(
				Payment_PayPal::SESSION_TOKEN,
				$payment->getToken(),
				Payment_PayPal::SESSION_NAMESPACE
			);

			$this->parameterHolder->set(
				Payment_PayPal::SESSION_AMOUNT,
				$amount,
				Payment_PayPal::SESSION_NAMESPACE
			);

			$this->redirectUrl = $payment->getPayPal()->redirectUrl($payment->getToken());

		} catch (PaymentException $e) {
			// Re-throw
			throw $e;
		}
	}
}
