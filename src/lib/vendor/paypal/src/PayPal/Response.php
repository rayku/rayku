<?php
/**
 * Class representing PayPal response
 *
 * @package    Rayku
 * @category   PayPal
 */
class PayPal_Response {

	/**
	 * @var  array  Response parameters
	 */
	protected $parameters;

	/**
	 * Creates a new PayPal response
	 *
	 * @param   string  Response string from request
	 * @return  void
	 */
	public function __construct($response)
	{
		// Parse the response
		parse_str($response, $parameters);

		$this->parameters = $parameters;
	}

	/**
	 * Tells whether response is successful
	 *
	 * @return  bool
	 */
	public function isSuccess()
	{
		return (isset($this->parameters['ACK']) && strpos($this->parameters['ACK'], 'Success') !== FALSE);
	}

	/**
	 * Tells whether response is failure
	 *
	 * @return  bool
	 */
	public function isFailure()
	{
		return ( ! isset($this->parameters['ACK']) || strpos($this->parameters['ACK'], 'Failure') !== FALSE);
	}

	/**
	 * Returns parameter by name
	 *
	 * @param   string  Parameter name
	 * @return  string
	 */
	public function getParameter($name)
	{
		$name = strtoupper($name);

		return isset($this->parameters[$name])
			? $this->parameters[$name]
			: null;
	}

	/**
	 * Returns all parameters
	 *
	 * @return  array
	 */
	public function getParameters()
	{
		return $this->parameters;
	}

	/**
	 * Returns message
	 *
	 * @return  string
	 */
	public function getMessage()
	{
		return $this->getParameter('L_LONGMESSAGE0');
	}

	/**
	 * Returns code
	 *
	 * @return  string
	 */
	public function getCode()
	{
		return $this->getParameter('L_ERRORCODE0');
	}

	/**
	 * Returns token
	 *
	 * @return  string
	 */
	public function getToken()
	{
		return $this->getParameter('TOKEN');
	}

	/**
	 * Returns payer ID
	 *
	 * @return  string
	 */
	public function getPayerId()
	{
		return $this->getParameter('PAYERID');
	}

	/**
	 * Returns transaction amount
	 *
	 * @return  float
	 */
	public function getAmount()
	{
		return (float) $this->getParameter('AMT');
	}
}
