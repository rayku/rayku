<?php
/**
 * Handles a payment logic
 *
 * @package   Rayku
 * @category  Payment
 */
interface Payment_Handler
{
	/**
	 * Returns redirect URL
	 *
	 * @return  string|null  URL to redirect to or null if no redirection required
	 */
	public function getRedirectUrl();

	/**
	 * Handles a payment logic
	 *
	 * @param   Payment
	 * @param   float    Payment amount
	 * @param   array    Extra parameters
	 * @return  void
	 */
	public function handle(Payment $payment, $amount, array $extra = NULL);
}
