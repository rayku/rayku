<?php
/**
 * Rayku points processing controller
 *
 * Buy Raiku points using a specified payment type.
 *
 * @package   Rayku
 * @category  Controller
 */
class pointsActions extends sfActions
{
	/**
	 * Displays buy page and handles points buying
	 *
	 * @param   sfRequest
	 * @return  string
	 */
	public function executeBuy(sfRequest $request)
	{
		$user = $this->getUser()->getRaykuUser();

		$points       = new RaykuPoints($user->getPoints());
		$tutoringTime = new TutoringTime;

		$estimatedPoints = $points->newEstimate(reset(RaykuPoints::$availablePointPackages));

		$data['user']['points']       = $user->getPoints();
		$data['user']['credit_cards'] = $user->getCreditCards();
		$data['points']['packages']   = RaykuPoints::$availablePointPackages;
		$data['points']['estimate']   = $estimatedPoints;
		$data['points']['amount']     =
		$data['points']['price']      = reset(RaykuPoints::$availablePointPackages);
		$data['tutoring']['price']    = TutoringTime::PRICE;
		$data['tutoring']['estimate'] = $tutoringTime->calculateForRaykuPoints($estimatedPoints);

		if ($request->getMethod() === sfRequest::POST) {
			// Get params from request
			$extra = $request->getParameter('payment', array());

			// Extract values
			$id    = Arr::path($extra, 'data.id');
			$type  = PaymentFactory::resolve(Arr::get($extra, 'type'));

			$paymentFactory = new PaymentFactory($type, $user);
			$payment = $paymentFactory->createPayment();
			$handler = $paymentFactory->createHandler(empty($id));

			try {
				$handler->handle($payment, Arr::get($extra, 'rp'), $extra);

				$user->addNewPoints(Arr::get($extra, 'rp'));
				$user->save();

				$this->redirect('@points_buy');
			} catch (PaymentException $e) {
				// TODO handle exception
				throw $e;
			} catch (Exception $e) {
				// TODO handle exception
				throw $e;
			}
		}

		$this->data = $data;

		return sfView::SUCCESS;
	}
}
