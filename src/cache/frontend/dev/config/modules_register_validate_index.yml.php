<?php
// auto-generated by sfValidatorConfigHandler
// date: 2013/03/04 08:55:10

if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
  $validators = array();
  $this->context->getRequest()->setAttribute('symfony.fillin', array (
  'enabled' => true,
  'param' => 
  array (
    'name' => 'register',
    'skip_fields' => 
    array (
      0 => 'password1',
    ),
  ),
));
}
else if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  $validators = array();
  $validators['sfRegexValidator_realname'] = new sfRegexValidator($this->context, array (
  'match' => true,
  'match_error' => 'Your name should only contain alphanumeric characters and spaces',
  'pattern' => '/^[\\w\\d ]+$/',
));

  $validators['sfStringValidator_password1'] = new sfStringValidator($this->context, array (
  'min' => 6,
  'min_error' => 'Your password should be at least 6 characters long',
));

  $validators['sfEmailValidator_email'] = new sfEmailValidator($this->context, array (
  'email_error' => 'Please make sure this is a correct email',
));

  $validators['sfPropelUniqueValidator_email'] = new sfPropelUniqueValidator($this->context, array (
  'class' => 'User',
  'column' => 'email',
  'unique_error' => 'This email address is already in use',
));

  $validators['sfRegexValidator_username'] = new sfRegexValidator($this->context, array (
  'match' => true,
  'match_error' => 'Your username should only contain alphanumeric characters',
  'pattern' => '/^[\\w\\d]+$/',
));

  $validators['sfRegexValidator_credit_card'] = new sfRegexValidator($this->context, array (
  'match' => true,
  'match_error' => 'Your credit card should only contain numeric characters',
  'pattern' => '/^[\\d]+$/',
));

  $validators['sfRegexValidator_expiry_date'] = new sfRegexValidator($this->context, array (
  'match' => true,
  'match_error' => 'Your expiry date should only contain alphanumeric characters',
  'pattern' => '/^[\\w\\d]+$/',
));

  $validators['sfRegexValidator_cvv'] = new sfRegexValidator($this->context, array (
  'match' => true,
  'match_error' => 'Your cvv should only contain alphanumeric characters',
  'pattern' => '/^[\\d]+$/',
));

  $validators['sfRegexValidator_card_name'] = new sfRegexValidator($this->context, array (
  'match' => true,
  'match_error' => 'Your name should only contain alphanumeric characters and spaces',
  'pattern' => '/^[\\w\\d ]+$/',
));

  $validatorManager->registerName('realname', 1, 'Please specify a full name', null, null, false);
  $validatorManager->registerValidator('realname', $validators['sfRegexValidator_realname'], null);
  $validatorManager->registerName('password1', 1, 'Please specify a password', null, null, false);
  $validatorManager->registerValidator('password1', $validators['sfStringValidator_password1'], null);
  $validatorManager->registerName('email', 1, 'Please specify an email', null, null, false);
  $validatorManager->registerValidator('email', $validators['sfEmailValidator_email'], null);
  $validatorManager->registerValidator('email', $validators['sfPropelUniqueValidator_email'], null);
  $validatorManager->registerName('username', 1, 'Please specify a username', null, null, false);
  $validatorManager->registerValidator('username', $validators['sfRegexValidator_username'], null);
  $validatorManager->registerName('credit_card', 0, 'Required', null, null, false);
  $validatorManager->registerValidator('credit_card', $validators['sfRegexValidator_credit_card'], null);
  $validatorManager->registerName('expiry_date', 0, 'Required', null, null, false);
  $validatorManager->registerValidator('expiry_date', $validators['sfRegexValidator_expiry_date'], null);
  $validatorManager->registerName('cvv', 0, 'Required', null, null, false);
  $validatorManager->registerValidator('cvv', $validators['sfRegexValidator_cvv'], null);
  $validatorManager->registerName('card_name', 0, 'Required', null, null, false);
  $validatorManager->registerValidator('card_name', $validators['sfRegexValidator_card_name'], null);
  $this->context->getRequest()->setAttribute('symfony.fillin', array (
  'enabled' => true,
  'param' => 
  array (
    'name' => 'register',
    'skip_fields' => 
    array (
      0 => 'password1',
    ),
  ),
));
}
