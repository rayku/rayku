<?php
/**
 * Creates a payment
 *
 * @package   Rayku
 * @category  Payment
 */
class PaymentFactory
{
	// Available payment types
	const PAYPAL      = 'PayPal';
	const CREDIT_CARD = 'CreditCard';

	/**
	 * @var  string  Payment type
	 */
	protected $type;

	/**
	 * @var  User
	 */
	protected $user;

	/**
	 * @var  sfNamespacedParameterHolder
	 */
	protected $parameterHolder;

	/**
	 * Creates a new payment factory
	 *
	 * @param   string  Payment type
	 * @param   User
	 * @param   sfNamespacedParameterHolder
	 * @return  void
	 */
	public function __construct(
		$type = null,
		User $user = null,
		sfNamespacedParameterHolder $parameterHolder = null
	)
	{
		$this->type = $type;
		$this->user = $user;
		$this->parameterHolder = $parameterHolder;
	}

	/**
	 * Resolve payment type by parameter
	 *
	 * @param   string  Parameter
	 * @return  string
	 */
	public static function resolve($parameter)
	{
		switch ($parameter) {
			case 'cc':
				return self::CREDIT_CARD;

			case 'paypal':
				return self::PAYPAL;

			default:
				throw new InvalidArgumentException(sprintf('"%s" payment type does not exists.', $parameter));
		}
	}

	/**
	 * Set payment type
	 *
	 * @param   string  Payment type
	 * @return  void
	 */
	public function setType($type)
	{
		$this->type = $type;
	}

	/**
	 * Set a user
	 *
	 * @param   User
	 * @return  void
	 */
	public function setUser(User $user)
	{
		$this->user = $user;
	}

	/**
	 * Sets a parameter holder
	 *
	 * @param   sfNamespacedParameterHolder
	 * @return  void
	 */
	public function setParameterHolder(sfNamespacedParameterHolder $parameterHolder)
	{
		$this->parameterHolder = $parameterHolder;
	}

	/**
	 * Creates a new payment
	 *
	 * @return  Payment
	 */
	public function createPayment()
	{
		switch ($this->type) {
			case self::PAYPAL:
				$execute = $this->parameterHolder->has(
					Payment_PayPal::SESSION_TOKEN,
					Payment_PayPal::SESSION_NAMESPACE
				);

				if ($execute) {
					$payment = new Payment_PayPalExecute($this->user);
				} else {
					$payment = new Payment_PayPalInitialize($this->user);
				}

				$paypal = new PayPal_Request(
					sfConfig::get('app_paypal_username'),
					sfConfig::get('app_paypal_password'),
					sfConfig::get('app_paypal_signature'),
					sfConfig::get('app_paypal_environment')
				);

				$payment->setPayPal(new PayPal_Feature_ExpressCheckout($paypal));
				break;

			case self::CREDIT_CARD;
				Braintree_Configuration::environment(sfConfig::get('app_braintree_environment'));
				Braintree_Configuration::merchantId(sfConfig::get('app_braintree_merchantId'));
				Braintree_Configuration::publicKey(sfConfig::get('app_braintree_publicKey'));
				Braintree_Configuration::privateKey(sfConfig::get('app_braintree_privateKey'));

				$payment = new Payment_CreditCard($this->user);
				break;

			default:
				throw new InvalidArgumentException(sprintf('"%s" payment type does not exists.', $this->type));
		}

		return $payment;
	}

	/**
	 * Creates a new payment handler
	 *
	 * @param   bool  Add a new credit card
	 * @return  void
	 */
	public function createHandler($new = false)
	{
		switch ($this->type)
		{
			case self::PAYPAL:
				$execute = $this->parameterHolder->has(
					Payment_PayPal::SESSION_TOKEN,
					Payment_PayPal::SESSION_NAMESPACE
				);

				if ($execute) {
					$handler = new Payment_Handler_PayPalExecute($this->user, $this->parameterHolder);
				} else {
					$handler = new Payment_Handler_PayPalInitialize($this->user, $this->parameterHolder);
				}
				break;

			case self::CREDIT_CARD:
				if ($new === true) {
					$handler = new Payment_Handler_CreditCardNew($this->user);
				} else {
					$handler = new Payment_Handler_CreditCardExisting($this->user);
				}
				break;

			default:
				throw new InvalidArgumentException(sprintf('"%s" payment type does not exists.', $this->type));
				break;
		}

		return $handler;
	}
}
