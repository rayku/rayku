<?php
/**
 * This is factory class
 * Mailman main responsibility is creating instances of preconfigured sfMail object
 *
 * @author lukas
 */
class Mailman
{
  /**
   * This one is clean
   * Nothing is set in it
   *
   * @return sfMail
   */
  static function createCleanMailer()
  {
    $mail = new sfMail;
		$mail->setCharset('utf-8');
    return $mail;
  }

  /**
   * This one represents typical email sended as rayku.com administrator
   *
   * @return sfMail
   */
  static function createMailer()
  {
    $mail = self::createCleanMailer();
		$mail->setFrom('Rayku Administration <'.sfConfig::get('app_general_admin_email').'>');

    return $mail;
  }
}
?>
