<?php
/**
 * PayPal express checkout feature
 *
 * @package    Rayku
 * @category   PayPal
 */
class PayPal_Feature_ExpressCheckout extends PayPal_Feature {

	const METHOD_SET_EXPRESS_CHECKOUT         = 'SetExpressCheckout';
	const METHOD_GET_EXPRESS_CHECKOUT_DETAILS = 'GetExpressCheckoutDetails';
	const METHOD_DO_EXPRESS_CHECKOUT_PAYMENT  = 'DoExpressCheckoutPayment';

	const URL_LIVE    = 'https://www.paypal.com/webscr';
	const URL_SANDBOX = 'https://www.sandbox.paypal.com/webscr';

	/**
	 * Returns redirect URL
	 *
	 * @param   string  A TOKEN value from the [setExpressCheckout] method
	 * @return  string
	 */
	public function redirectUrl($token)
	{
		switch ($this->request->getEnvironment())
		{
			case PayPal_Request::ENVIRONMENT_LIVE:
				$url = self::URL_LIVE;
				break;

			case PayPal_Request::ENVIRONMENT_SANDBOX:
				$url = self::URL_SANDBOX;
				break;

			default:
				throw new InvalidArgumentException('Invalid environment');
				break;
		}

		$parameters = array(
			'cmd'   => '_express-checkout',
			'token' => $token,
		);

		$url .= '?'.http_build_query($parameters, NULL, '&');

		return $url;
	}

	/**
	 * Initializes express checkout
	 *
	 * @param   float   Payment amount
	 * @param   string  Return URL (success)
	 * @param   string  Return URL (cancel)
	 * @return  PayPal_Response
	 */
	public function setExpressCheckout($amount, $returnUrl, $cancelUrl)
	{
		$this->param('AMT', $amount);
		$this->param('RETURNURL', $returnUrl);
		$this->param('CANCELURL', $cancelUrl);

		return $this->request->execute(self::METHOD_SET_EXPRESS_CHECKOUT, $this->params);
	}

	/**
	 * Returns express checkout data
	 *
	 * @param   string  Token
	 * @return  PayPal_Response
	 */
	public function getExpressCheckoutDetails($token)
	{
		$this->param('TOKEN', $token);

		return $this->request->execute(self::METHOD_GET_EXPRESS_CHECKOUT_DETAILS, $this->params);
	}

	/**
	 * Completes PayPal express checkout
	 *
	 * @param   float   Payment amount
	 * @param   string  Token
	 * @param   string  Payer ID
	 * @return  PayPal_Response
	 */
	public function doExpressCheckoutPayment($amount, $token, $payerId)
	{
		$this->param('AMT', $amount);
		$this->param('PAYMENTACTION', 'Sale');
		$this->param('TOKEN', $token);
		$this->param('PAYERID', $payerId);

		return $this->request->execute(self::METHOD_DO_EXPRESS_CHECKOUT_PAYMENT, $this->params);
	}
}
