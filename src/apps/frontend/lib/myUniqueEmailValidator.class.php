<?php
/**
 * Validate the email column, but allow the logged in user to keep the same (it's allowed to appear non-unique)
 *
 */
class myUniqueEmailValidator extends sfValidator
{
  public function execute(&$value, &$error)
  {
  	$c = new Criteria();
  	$c->add(UserPeer::EMAIL, $value);
  	$users = UserPeer::doSelect($c);
  	
  	// if it's unique
  	if (0 === count($users))
  	{
  		return true;
  	}
  	else if (count($users) > 1)		// > 1 shouldn't ever happen, but it'll mean it's certainly not unique to just us
  	{
		$error = $this->getParameter('unique_error');
		return false;
  	}
  	else
  	{
  		$user = array_pop($users);
  		/* @var $user User */

  		$loggedInUser = sfContext::getInstance()->getUser()->getRaykuUser();
  		
  		if ($loggedInUser instanceof User)
  		{
  			// if the logged in user matches the found user, then it's allowed to be the same email address 
  			if ($loggedInUser->equals($user))
  			{
  				return true;
  			}
  			else
  			{
				$error = $this->getParameter('unique_error');
				return false;
  			}
  		}
  		else
  		{
  			// we're not logged in, so die
  			throw new sfValidatorException('you need to be logged in to validate your email address');
  		}
  	}

	$error = $this->getParameter('unique_error');
	return false;
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
    $this->setParameter('unique_error', 'Uniqueness error');

    $this->getParameterHolder()->add($parameters);

    return true;
  }
}