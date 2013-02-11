<?php
/**
 * PayPal handler class
 *
 * @package   Rayku
 * @category  Payment
 */
class Payment_Handler_PayPalExecute extends Payment_Handler_Common
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
		$token = $this->parameterHolder->get(
			Payment_PayPal::SESSION_TOKEN,
			null,
			Payment_PayPal::SESSION_NAMESPACE
		);

		$amount = $this->parameterHolder->get(
			Payment_PayPal::SESSION_AMOUNT,
			null,
			Payment_PayPal::SESSION_NAMESPACE
		);

		$payment->setToken($token);

		try {
			$payment->execute($amount);

			$this->user->addNewPoints($amount);
			$this->user->save();

			$this->parameterHolder->removeNamespace(Payment_PayPal::SESSION_NAMESPACE);
		} catch(PaymentException $e) {
			$this->parameterHolder->removeNamespace(Payment_PayPal::SESSION_NAMESPACE);

			// Re-throw
			throw $e;
		}
	}
}
