<?php
/**
 * Payment CC management controller
 *
 * @package   Rayku
 * @category  Controller
 */
class paymentActions extends sfActions
{
	/**
	 * Removes a payment
	 *
	 * @param   sfRequest
	 * @return  string
	 */
	public function executeRemove(sfRequest $request)
	{
		$user = $this->getUser()->getRaykuUser();
		$type = $request->getParameter('type');
		$id   = $request->getParameter('id');

		$type = PaymentFactory::resolve($type);

		// Find credit card
		$creditCard = CreditCardPeer::retrieveByPk($id);

		if ( ! $creditCard) {
			$this->forward404();
		}

		// Payment instance
		$paymentFactory = new PaymentFactory($type, $user);
		$payment = $paymentFactory->createPayment();
		$payment->setCreditCard($creditCard);

		try {
			$payment->remove();
			$creditCard->delete();
		} catch (Exception $e) {
			// Do nothing
			throw $e;
		}

		$this->redirect('@points_buy');
	}
}
