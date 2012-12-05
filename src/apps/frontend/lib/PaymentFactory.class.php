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
	 * Creates a new payment factory
	 *
	 * @param   string  Payment type
	 * @param   User
	 * @return  void
	 */
	public function __construct($type = NULL, User $user = NULL)
	{
		$this->type = $type;
		$this->user = $user;
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
	 * Creates a new payment
	 *
	 * @return  Payment
	 */
	public function createPayment()
	{
		switch ($this->type) {
			case self::PAYPAL:
				return new Payment_PayPal($this->user);
				break;

			case self::CREDIT_CARD;
				Braintree_Configuration::environment(sfConfig::get('app_braintree_environment'));
				Braintree_Configuration::merchantId(sfConfig::get('app_braintree_merchantId'));
				Braintree_Configuration::publicKey(sfConfig::get('app_braintree_publicKey'));
				Braintree_Configuration::privateKey(sfConfig::get('app_braintree_privateKey'));

				return new Payment_CreditCard($this->user);
				break;

			default:
				throw new InvalidArgumentException(sprintf('"%s" payment type does not exists.', $this->type));
		}
	}

	/**
	 * Creates a new payment handler
	 *
	 * @param   bool  Add a new credit card
	 * @return  void
	 */
	public function createHandler($new = false)
	{
		if ($this->type === self::PAYPAL) {
			return new Payment_Handler_PayPal($this->user);
		} elseif ($this->type === self::CREDIT_CARD && $new === true) {
			return new Payment_Handler_NewCreditCard($this->user);
		} elseif ($this->type === self::CREDIT_CARD && $new === false) {
			return new Payment_Handler_ExistingCreditCard($this->user);
		} else {
			throw new InvalidArgumentException(sprintf('"%s" payment type does not exists.', $this->type));
		}
	}
}
