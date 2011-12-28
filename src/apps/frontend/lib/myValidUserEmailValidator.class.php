<?php
/**
 * Validate the email column, make sure we can find a user that matches the email address
 *
 */
class myValidUserEmailValidator extends sfValidator
{
  public function execute(&$value, &$error)
  {
  	$c = new Criteria();
  	$c->add(UserPeer::EMAIL, $value);
  	$users = UserPeer::doSelect($c);
  	
  	// if it's not found
  	if (0 === count($users))
  	{
		$error = $this->getParameter('invalid_error');
		return false;
  	}

	return true;
  }

  /**
   * Initialize this validator.
   *
   * @param sfContext The current application context.
   * @param array   An associative array of initialization parameters.
   *
   * @return bool true, if initialization completes successfully, otherwise false.
   */
  public function initialize($context, $parameters = null)
  {
    // initialize parent
    parent::initialize($context);

    // set defaults
    $this->setParameter('invalid_error', 'Invalid emai');

    $this->getParameterHolder()->add($parameters);

    return true;
  }
}