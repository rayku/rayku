<?php
/**
 * Hanldes a payment with an existing credit card
 *
 * @package   Rayku
 * @category  Payment
 */
class Payment_Handler_ExistingCreditCard extends Payment_Handler_Common
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
		$c = new Criteria();
		$c->add(CreditCardPeer::ID, Arr::path($extra, 'data.id'));
		$c->addJoin(CreditCardPeer::USER_ID, UserPeer::ID);

		$creditCard = CreditCardPeer::doSelectOne($c);

		$payment->setCreditCard($creditCard);
		$payment->execute($amount);
	}
}
