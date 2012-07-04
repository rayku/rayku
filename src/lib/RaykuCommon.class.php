<?php
/*
 * This class will contain loose functions needed by rayku.com
 *
 * @author lukas
 */
class RaykuCommon
{
  /**
   * Sometimes we are using one of users as special user to send notification messages,
   * as a default friend when new user registers, etc, etc
   *
   * We are fetching him from database based on username and here this username is defined
   *
   * This user must be type of student or expert and can not be hidden
   *
   */
  const SITE_USER_USERNAME = 'rayku';

  /**
   * rayku.com is using array of year, month and day in forms
   * this function translates this array to string in correct for MySQL format
   */
  static function dateArrayToString( array $date )
  {
		return sprintf('%d-%d-%d',
			$date['year'],
			$date['month'],
			$date['day']
		);
  }

  static function formatDateForPost( $date )
  {
    $d1=explode(' ',$date);
    $d=explode('-',$d1[0]);
    $t=explode(':',$d1[1]);

    return date('F jS , Y  \a\t  h:i a',mktime($t[0],$t[1],$t[2],$d[1],$d[2],$d[0]));
  }

  static function getCurrentHttpDomain()
  {
    return $_SERVER['HTTP_HOST'];
  }

  static function writeAvatarImage($sourceFile, $userId)
  {
		$destinationDir = sfConfig::get('sf_upload_dir') . DIRECTORY_SEPARATOR . sfConfig::get('app_general_avatar_folder');

		if (!file_exists($destinationDir))
		{
			mkdir($destinationDir, 0700, true);
		}

		$destinationFile = $destinationDir . DIRECTORY_SEPARATOR . $userId;

		// create thumb
		$thumb = new sfThumbnail(sfConfig::get('app_general_avatar_max_width'), sfConfig::get('app_general_avatar_max_height'));
		$thumb->loadFile($sourceFile);
		$thumb->save($destinationFile, 'image/jpeg');

		$thumb = new sfThumbnail(sfConfig::get('app_general_avatar_max_width2'), sfConfig::get('app_general_avatar_max_height2'));
		$thumb->loadFile($sourceFile);
		$thumb->save($destinationFile."_2", 'image/jpeg');

		$thumb = new sfThumbnail(sfConfig::get('app_general_avatar_max_width3'), sfConfig::get('app_general_avatar_max_height3'));
		$thumb->loadFile($sourceFile);
		$thumb->save($destinationFile."_3", 'image/jpeg');

		$thumb = new sfThumbnail(sfConfig::get('app_general_avatar_max_width4'), sfConfig::get('app_general_avatar_max_height4'));
		$thumb->loadFile($sourceFile);
		$thumb->save($destinationFile."_4", 'image/jpeg');
  }

  // this is a temporary function to allow the safe removal of mysql_connect and
  // mysql_select_db across the codebase
  static function getDatabaseConnection() {
      $config = self::getDatabaseConfiguration();
      $connection = mysql_connect($config['host'], $config['username'], $config['password']);

      mysql_select_db($config['dbname'], $connection);
      return $connection;
  }

  private static $dbConfig = array();

  private static function getDatabaseConfiguration() {
      if (self::$dbConfig == null) {
          $config = sfYaml::load(dirname(__FILE__).'/../config/databases.yml');

          $propelConfiguration = $config['all']['propel']['param'];
          preg_match('/dbname=(.*);host=(.*)/', $propelConfiguration['dsn'], $matched);

          self::$dbConfig['host'] = $matched[2];
          self::$dbConfig['dbname'] = $matched[1];
          self::$dbConfig['username'] = $propelConfiguration['username'];
          self::$dbConfig['password'] = $propelConfiguration['password'];
      }

      return self::$dbConfig;
  }
  
  static function getTitlePre($role)
  {
        $verb = '';
        switch ($role) {
            case 'Freshman':
            case 'Sophomore':
            case 'Junior':
            case 'Senior':
            case 'Masters Student':
            case 'Phd Candidate':
                $verb = 'studying';
                break;

            case 'Masters Degree Holder':
            case 'Undergrad Degree Holder':
            case 'Phd Degree Holder':
                $verb = 'having studied';
                break;

            case 'Teaching Assistant':
            case 'Professor':
            case 'Middle School Teacher':
            case 'High School Teacher':
                $verb = 'teaching';
                break;
        }
        return $verb;
  }
}
?>
