<?php

/**
 * This function is reponsible for detection of one of classroom application modules
 * If it detects one it returns 'classroom' string which means classroom application here
 */
function classroomAppDetector( $requestUri, $fallbackApp )
{
  $classroomModules = array( 'classroom',
                             'assignment',
                             'classroom_blog',
                             'classroom_gallery',
                             'classroom_forum',
                             'student_voice',
                             'content_page',
                             'submission');
  $app = $fallbackApp;
  foreach( $classroomModules as $classroomModule )
  {
    if( strpos($requestUri, $classroomModule, 1 ) === 1 ||
        strpos($requestUri, '/index.php/' . $classroomModule, 0 ) === 0 ||
        strpos($requestUri, '/frontend_dev.php/' . $classroomModule, 0 ) === 0
      )
    {
      $app = 'classroom';
    }
  }

  return $app;
}

?>
