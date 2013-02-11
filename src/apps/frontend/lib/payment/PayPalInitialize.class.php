<?php
/**
 * PayPal payment initialization
 *
 * Set up payment info
 *
 * @package   Rayku
 * @category  Payment
 */
class Payment_PayPalInitialize extends Payment_PayPal
{
	/**
	 * @var  string  Success redirect URL
	 */
	protected $successUrl;

	/**
	 * @var  string  Cancel redirect URL
	 */
	protected $cancelUrl;

	/**
	 * Implements [Payment::execute]
	 *
	 * @throws  PaymentException
	 * @param   float  Payment amount
	 * @return  void
	 */
	public function execute($amount)
	{
		$response = $this->paypal->setExpressCheckout($amount, $this->successUrl, $this->cancelUrl);

		if ($response->isFailure())
			throw new PaymentException($response->getMessage());

		$this->token = $response->getToken();
	}

	/**
	 * Sets success redirect URL
	 *
	 * @param   string  Success redirect URL
	 * @return  void
	 */
	public function setSuccessUrl($url)
	{
		$this->successUrl = $url;
	}

	/**
	 * Sets cancel redirect URL
	 *
	 * @param   string  Cancel redirect URL
	 * @return  void
	 */
	public function setCancelUrl($url)
	{
		$this->cancelUrl = $url;
	}
}
