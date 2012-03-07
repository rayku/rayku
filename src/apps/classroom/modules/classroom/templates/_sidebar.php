<?php
$teacher = $classroom->getUser();
?>
<div class="title" style="float:left">
	<img src="http://<?php echo RaykuCommon::getCurrentHttpDomain(); ?>/images/arrow-right.gif" alt="" />
	<p>Navigation</p>
</div>
<div class="spacer"></div>
<?php
  echo link_to( 'Class Homepage', 'classroom/index?id='.$classroom->getId() );
  echo link_to( 'Assignments', 'assignment/list' ); 
 
  $c =  new Criteria();
  $c->add(GalleryPeer::CLASSROOM_ID, $classroom->getId() );
  $gallery = GalleryPeer::doSelectOne($c);

  if( $gallery )
    echo link_to( 'Picture/Video Gallery', 'classroom_gallery/show?user_id='.$teacher->getId() );
  else
    echo link_to( 'Picture/Video Gallery', 'classroom_gallery/index?user_id='.$teacher->getId() );

  echo link_to( 'Student Voice', 'student_voice/index' );
  echo link_to( 'Classroom Blog', 'classroom_blog/index' );

  $c=new Criteria();
  $c->add(ClassroomForumPeer::CLASSROOM_ID,$classroom->getId());
  $forum=ClassroomForumPeer::doSelectOne($c);
  
  if( $forum )
    echo link_to( 'Classroom Forum', 'classroom_forum/forum?forum_id='.$forum->getId() );
  else
    echo link_to( 'Classroom Forum', 'classroom_forum/list' );
  
  echo link_to( 'Help from ' . $teacher->getUsername(), 'classroom/help' );

  $raykuUser = $sf_user->getRaykuUser();

  if( $raykuUser->getType() == UserPeer::getTypeFromValue( 'teacher' ) ) 
  {
    echo link_to( 'Create new page', 'content_page/index' ); 
	echo link_to( 'Reset your classroom Email', 'classroom/resetEmail' );
 }

  $c = new Criteria();
  $c->add(ContentPagePeer::CLASSROOM_ID, $classroom->getId());
  $content_pages = ContentPagePeer::doSelect($c);

  foreach($content_pages as $content_page)
    echo link_to( $content_page->getTitle(), 'content_page/show?id='.$content_page->getId() );
  
  if( $raykuUser->getType() == UserPeer::getTypeFromValue( 'teacher' ) )
  {
    echo '<div class="divider"></div>';
    echo link_to( 'Edit This Class', 'classmanager/edit?id='.$classroom->getId(), array( 'class' => 'edit' ) );
  }
  else if( $raykuUser->getType() == UserPeer::getTypeFromValue( 'user' ) )
  {
    echo link_to( 'Unrole from classroom', 'classroom/unRole' );
  }
?>
