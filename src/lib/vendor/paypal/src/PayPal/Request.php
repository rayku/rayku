<?php
/**
 * Class representing PayPal request
 *
 * @package    Rayku
 * @category   PayPal
 */
class PayPal_Request {

	const API_VERSION = '93';

	const ENVIRONMENT_LIVE         = 'live';
	const ENVIRONMENT_SANDBOX      = 'sandbox';
	const ENVIRONMENT_SANDBOX_BETA = 'sandbox-beta';

	const URL_LIVE         = 'https://api-3t.live.paypal.com/nvp';
	const URL_SANDBOX      = 'https://api-3t.sandbox.paypal.com/nvp';
	const URL_SANDBOX_BETA = 'https://api-3t.sandbox-beta.paypal.com/nvp';

	/**
	 * @var  string  API username
	 */
	protected $username;

	/**
	 * @var  string  API password
	 */
	protected $password;

	/**
	 * @var  string  API signature
	 */
	protected $signature;

	/**
	 * @var  string  Environment type
	 */
	protected $environment = 'live';

	/**
	 * Creates a new PayPal instance for the given username, password,
	 * and signature for the given environment.
	 *
	 * @param   string  API username
	 * @param   string  API password
	 * @param   string  API signature
	 * @param   string  environment (one of: live, sandbox, sandbox-beta)
	 * @return  void
	 */
	public function __construct($username, $password, $signature, $environment = 'live')
	{
		if ( ! in_array($environment, array(self::ENVIRONMENT_LIVE, self::ENVIRONMENT_SANDBOX, self::ENVIRONMENT_SANDBOX_BETA)))
			throw new InvalidArgumentException(sprintf('Invalid environment "%s"', $environment));

		$this->username    = $username;
		$this->password    = $password;
		$this->signature   = $signature;
		$this->environment = $environment;
	}

	/**
	 * Returns the NVP API URL for the current environment.
	 *
	 * @return  string
	 */
	public function api_url()
	{
		switch ($this->environment)
		{
			case self::ENVIRONMENT_LIVE:
				$url = self::URL_LIVE;
				break;

			case self::ENVIRONMENT_SANDBOX:
				$url = self::URL_SANDBOX;
				break;

			case self::ENVIRONMENT_SANDBOX_BETA:
				$url = self::URL_SANDBOX_BETA;

			default:
				throw new InvalidArgumentException('Invalid environment');
				break;
		}

		return $url;
	}

	/**
	 * Creates a new PayPal response
	 *
	 * @param   string  Response string from request
	 * @return  PayPal_Response
	 */
	public function createResponse($response)
	{
		return new PayPal_Response($response);
	}

	/**
	 * Executes request
	 *
	 * @throws  PayPal_Exception
	 * @param   string  Endpoint URL
	 * @param   array   NVP parameters
	 * @return  string
	 */
	public function execute($method, array $parameters)
	{
		// Add required params
		$parameters['METHOD']    = $method;
		$parameters['VERSION']   = self::API_VERSION;
		$parameters['USER']      = $this->username;
		$parameters['PWD']       = $this->password;
		$parameters['SIGNATURE'] = $this->signature;

		// Create a new curl instance
		$curl = curl_init();

		// Set curl options
		curl_setopt_array($curl, array(
			CURLOPT_URL            => $this->api_url(),
			CURLOPT_POST           => true,
			CURLOPT_POSTFIELDS     => http_build_query($parameters, null, '&'),
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_SSL_VERIFYHOST => false,
			CURLOPT_RETURNTRANSFER => true,
		));

		if (($response = curl_exec($curl)) === false) {
			// Get the error code and message
			$code  = curl_errno($curl);
			$error = curl_error($curl);

			// Close curl
			curl_close($curl);

			throw new PayPal_Exception(sprintf(
				'PayPal API request for %s failed: %s (%d)',
				$method,
				$error,
				$code
			));
		}

		// Close curl
		curl_close($curl);

		return $this->createResponse($response);
	}

	/**
	 * Returns environment
	 *
	 * @return  string
	 */
	public function getEnvironment()
	{
		return $this->environment;
	}
}
