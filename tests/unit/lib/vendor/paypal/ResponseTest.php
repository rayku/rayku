<?php
/**
 * PayPal_Response test
 *
 * @group  paypal
 *
 * @package    Rayku
 * @category   Tests
 */
class PayPal_ResponseTest extends PHPUnit_Framework_TestCase {

	private $response_success = 'TOKEN=EC%2dASDF123&CHECKOUTSTATUS=PaymentActionNotInitiated&ACK=Success&VERSION=93&BUILD=4181146&EMAIL=foo%40example%2ecom&PAYERID=A1B2&PAYERSTATUS=verified&FIRSTNAME=John&LASTNAME=Doe&COUNTRYCODE=US&CURRENCYCODE=USD&AMT=22%2e00';
	private $response_failure = 'TIMESTAMP=2012%2d12%2d12T22%3a22%3a22Z&ACK=Failure&VERSION=93&BUILD=4181146&L_ERRORCODE0=10406&L_SHORTMESSAGE0=Transaction%20refused%20because%20of%20an%20invalid%20argument%2e%20See%20additional%20error%20messages%20for%20details%2e&L_LONGMESSAGE0=The%20PayerID%20value%20is%20invalid%2e&L_SEVERITYCODE0=Error';

	/**
	 * @covers  PayPal_Response::__construct
	 * @covers  PayPal::getParameters
	 */
	public function testItParsesResponse()
	{
		$parsed_success = array(
			'TOKEN'          => 'EC-ASDF123',
			'CHECKOUTSTATUS' => 'PaymentActionNotInitiated',
			'ACK'            => 'Success',
		);

		$parsed_failure = array(
			'TIMESTAMP' => '2012-12-12T22:22:22Z',
			'ACK'       => 'Failure',
			'VERSION'   => '93',
		);

		$response_success = new PayPal_Response('TOKEN=EC%2dASDF123&CHECKOUTSTATUS=PaymentActionNotInitiated&ACK=Success');
		$response_failure = new PayPal_Response('TIMESTAMP=2012%2d12%2d12T22%3a22%3a22Z&ACK=Failure&VERSION=93');

		$this->assertSame($parsed_success, $response_success->getParameters(), 'Parsed success parameters');
		$this->assertSame($parsed_failure, $response_failure->getParameters(), 'Parsed failure parameters');
	}

	/**
	 * @covers  PayPal_Response::isSuccess
	 */
	public function testItTellsIfResponseIsSuccess()
	{
		$response_success = new PayPal_Response($this->response_success);
		$response_failure = new PayPal_Response($this->response_failure);

		$this->assertTrue($response_success->isSuccess(), 'Testing against SUCCESS response');
		$this->assertFalse($response_failure->isSuccess(), 'Testing against FAILURE response');
	}

	/**
	 * @covers  PayPal_Response::isFailure
	 */
	public function testItTellIfResponseIsFailure()
	{
		$response_success = new PayPal_Response($this->response_success);
		$response_failure = new PayPal_Response($this->response_failure);

		$this->assertFalse($response_success->isFailure(), 'Testing against SUCCESS response');
		$this->assertTrue($response_failure->isFailure(), 'Testing against FAILURE response');
	}

	/**
	 * @covers  PayPal_Response::getParameter
	 */
	public function testItReturnsParameterByName()
	{
		$response = new PayPal_Response($this->response_success);

		$this->assertSame('foo@example.com', $response->getParameter('email'), 'Lowercase parameter name');
		$this->assertSame('foo@example.com', $response->getParameter('EMAIL'), 'Uppercase parameter name');
	}

	/**
	 * Data provider for [testGetters]
	 *
	 * @return  array
	 */
	public function providerTestGetters()
	{
		return array(
			array($this->response_failure, 'getMessage', 'The PayerID value is invalid.'),
			array($this->response_failure, 'getCode', '10406'),
			array($this->response_success, 'getToken', 'EC-ASDF123'),
			array($this->response_success, 'getPayerId', 'A1B2'),
			array($this->response_success, 'getAmount', 22.00),
		);
	}

	/**
	 * @covers  PayPal_Response::getMessage
	 * @covers  PayPal_Response::getCode
	 * @covers  PayPal_Response::getToken
	 * @covers  PayPal_Response::getPayerId
	 * @covers  PayPal_Response::getAmount
	 *
	 * @dataProvider  providerTestGetters
	 */
	public function testGetters($response_str, $method, $expected)
	{
		$response = new PayPal_Response($response_str);

		$actual = call_user_func(array($response, $method));

		$this->assertSame($expected, $actual);
	}
}
