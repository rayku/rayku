<?php
/**
 * Abstract PayPal feature class
 *
 * @package    Rayku
 * @category   PayPal
 */
abstract class PayPal_Feature {

	/**
	 * @var  array  NVP parameters
	 */
	protected $params = array();

	/**
	 * @var  PayPal_Request
	 */
	protected $request;

	/**
	 * Creates a new PayPal feature object
	 *
	 * @param   PayPal_Request
	 * @return  void
	 */
	public function __construct(PayPal_Request $request)
	{
		$this->request = $request;
	}

	/**
	 * Sets NVP value
	 *
	 * @param   string|array
	 * @param   mixed
	 * @return  void
	 */
	public function param($key, $value = NULL)
	{
		if (is_array($key))
		{
			$this->params = array_merge($this->params, $key);
		}
		else
		{
			$this->params[$key] = $value;
		}
	}
}
