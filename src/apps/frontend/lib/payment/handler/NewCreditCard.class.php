<?php
/**
 * Handles a payment with a new credit card
 *
 * @package   Rayku
 * @category  Payment
 */
class Payment_Handler_NewCreditCard extends Payment_Handler_Common
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
		if ($this->user->getBraintreeCustomerId() === NULL) {
			try {
				$payment->createCustomer();

				$this->user->setBraintreeCustomerId($payment->getCustomerId());
				$this->user->save();
			} catch (Exception $e) {
				// Re-throw
				throw $e;
			}
		}

		try {
			$data = Arr::get($extra, 'data', array());

			$token = $payment->add($data);

			$creditCard = new CreditCard;

			$creditCard->setToken($payment->getCreditCardToken());
			$creditCard->setType($payment->getCreditCardType());
			$creditCard->setNumber(substr(Arr::get($data, 'number', ''), -4));
			$creditCard->setUser($this->user);

			$creditCard->save();
		} catch (Exception $e) {
			// Re-throw
			throw $e;
		}

		$payment->setCreditCard($creditCard);
		$payment->execute($amount);
	}
}
