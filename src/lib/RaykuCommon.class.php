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
   * This user must be type of student, teacher or expert and can not be hidden
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

  /**
   * This is wrapper to store classroom object/id in a session
   *
   * @param sfUser $user
   * @return Classroom
   */
  static function getCurrentClassroom( sfUser $user )
  {
    return ClassroomPeer::retrieveByPK( $user->getAttribute( 'classroomId' ) );
  }
  static function getCurrentClassroomId( sfUser $user )
  {
    return $user->getAttribute( 'classroomId' );
  }

  static function setCurrentClassroomId( $classroomId, sfUser $user )
  {
    $classroom = ClassroomPeer::retrieveByPK( $classroomId );
    $raykuUser = $user->getRaykuUser();
    if( !$classroom || !$raykuUser || $classroom && $classroom->isUserOwnerOrMember( $raykuUser ) )
    {
      sfContext::getInstance()->getUser()->setAttribute( 'classroomId', $classroomId );
      return true;
    }
    else
      return false;
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
}
?>
