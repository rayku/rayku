<?php
/**
 * Payment interface
 *
 * Handles payment through a gateway
 *
 * @package   Rayku
 * @category  Payment
 */
interface Payment
{
	/**
	 * Adds a payment
	 *
	 * @throws  PaymentException
	 * @param   array
	 * @return  void
	 */
	public function add(array $data);

	/**
	 * Removes a payment
	 *
	 * @return  void
	 */
	public function remove();

	/**
	 * Executes payment
	 *
	 * @throws  PaymentException
	 * @param   float  Payment amount
	 * @return  void
	 */
	public function execute($amount);
}
