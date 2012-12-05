<?php

require_once PROJROOT . 'lib/vendor/braintree/lib/Braintree.php';

/**
 * Payment_CreditCard test
 *
 * @group  payment
 *
 * @package   Rayku
 * @category  Tests
 */
class Payment_CreditCardTest extends PHPUnit_Framework_TestCase
{
	public static function setUpBeforeClass()
	{
		Braintree_Configuration::environment(sfConfig::get('app_braintree_environment'));
		Braintree_Configuration::merchantId(sfConfig::get('app_braintree_merchantId'));
		Braintree_Configuration::publicKey(sfConfig::get('app_braintree_publicKey'));
		Braintree_Configuration::privateKey(sfConfig::get('app_braintree_privateKey'));

		foreach (Braintree_Customer::all() as $customer) {
			try {
				// Clean up all sandbox data before running tests
				Braintree_Customer::delete($customer->id);
			} catch (Exception $e) {
				// Skip
			}
		}
	}

	public function testItImplementsPaymentInterface()
	{
		$this->assertInstanceOf('Payment', new Payment_CreditCard(new User));
	}

	/**
	 * @covers  Payment_CreditCard::createCustomer
	 *
	 * @return  User
	 */
	public function testItAddsANewCustomer()
	{
		$user = new User;

		$user->setName('John');
		$user->setEmail('john@example.com');

		$payment = new Payment_CreditCard($user);

		$payment->createCustomer();

		$this->assertNotNull($payment->getCustomerId());

		$user->setBraintreeCustomerId($payment->getCustomerId());

		return $user;
	}

	/**
	 * @covers   Payment_CreditCard::add
	 * @depends  testItAddsANewCustomer
	 *
	 * @param   User
	 * @return  CreditCard
	 */
	public function testItAddsANewCreditCard(User $user)
	{
		$data = array(
			'number' => '4111111111111111', // Visa
			'expiry' => '12/2015',
			'name'   => 'John',
		);

		$payment = new Payment_CreditCard($user);

		$payment->add($data);

		$this->assertNotNull($payment->getCreditCardToken());
		$this->assertSame('Visa', $payment->getCreditCardType());

		$creditCard = new CreditCard;
		$creditCard->setToken($payment->getCreditCardToken());
		$creditCard->setType($payment->getCreditCardType());
		$creditCard->setUser($user);

		return $creditCard;
	}

	/**
	 * @covers   Payment_CreditCard::execute
	 * @depends  testItAddsANewCreditCard
	 *
	 * @param   CreditCard
	 * @return  CreditCard
	 */
	public function testItExecutesAPayment(CreditCard $creditCard)
	{
		$payment = new Payment_CreditCard($creditCard->getUser());
		$payment->setCreditCard($creditCard);

		$payment->execute(5);

		return $creditCard;
	}

	/**
	 * @covers   Payment_CreditCard::remove
	 * @depends  testItExecutesAPayment
	 *
	 * @param   CreditCard
	 * @return  void
	 */
	public function testItRemovesCreditCard(CreditCard $creditCard)
	{
		$payment = new Payment_CreditCard($creditCard->getUser());
		$payment->setCreditCard($creditCard);

		$payment->remove();

		try {
			Braintree_CreditCard::find($creditCard->getToken());

			$this->fail('Credit card should be removed');
		} catch (Braintree_Exception_NotFound $e) {
			// This is good
		}
	}
}
