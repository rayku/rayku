<?php
/**
 * Credit card payment
 *
 * @package   Rayku
 * @category  Payment
 */
class Payment_CreditCard extends Payment_Common
{
	/**
	 * @var  string  ID assigned to the customer
	 */
	protected $customerId;

	/**
	 * @var  string  Credit card token (result from Brainstree)
	 */
	protected $creditCardToken;

	/**
	 * @var  string  Credit card type (result from Brainstree)
	 */
	protected $creditCardType;

	/**
	 * @var  CreditCard
	 */
	protected $creditCard;

	public function setCreditCard(CreditCard $creditCard)
	{
		$this->creditCard = $creditCard;
	}

	/**
	 * Returns credit card token
	 *
	 * @return  string
	 */
	public function getCreditCardToken()
	{
		return $this->creditCardToken;
	}

	/**
	 * Returns credit card type
	 *
	 * @return  string
	 */
	public function getCreditCardType()
	{
		return $this->creditCardType;
	}

	/**
	 * Returns ID assigned to the customer
	 *
	 * @return  string
	 */
	public function getCustomerId()
	{
		return $this->customerId;
	}

	/**
	 * Creates a new customer
	 *
	 * @throws  PaymentException
	 * @return  void
	 */
	public function createCustomer()
	{
		$result = Braintree_Customer::create(array(
			'firstName' => $this->user->getName(),
			'email'     => $this->user->getEmail(),
		));

		if ( ! $result->success)
			throw new PaymentException($result->message);

		$this->customerId = $result->customer->id;
	}

	/**
	 * Implements [Payment::add]
	 *
	 * @throws  PaymentException
	 * @param   array
	 * @return  void
	 */
	public function add(array $data)
	{
		$result = Braintree_CreditCard::create(array(
			'customerId'     => $this->user->getBraintreeCustomerId(),
			'number'         => Arr::get($data, 'number'),
			'expirationDate' => Arr::get($data, 'expiry'),
			'cardholderName' => Arr::get($data, 'name'),
			'options' => array(
				'failOnDuplicatePaymentMethod' => true,
			)
		));

		if ( ! $result->success)
			throw new PaymentException($result->message);

		$this->creditCardToken = $result->creditCard->token;
		$this->creditCardType  = $result->creditCard->cardType;
	}

	/**
	 * Implements [Payment::remove]
	 *
	 * @return  void
	 */
	public function remove()
	{
		Braintree_CreditCard::delete($this->creditCard->getToken());
	}

	/**
	 * Implements [Payment::execute]
	 *
	 * @throws  PaymentException
	 * @param   float  Payment amount
	 * @return  void
	 */
	public function execute($amount)
	{
		$result = Braintree_Transaction::sale(array(
			'amount'             => $amount,
			'customerId'         => $this->user->getBraintreeCustomerId(),
			'paymentMethodToken' => $this->creditCard->getToken(),
			'options' => array(
				'submitForSettlement' => true,
			)
		));

		if ( ! $result->success)
			throw new PaymentException($result->message);
	}
}
