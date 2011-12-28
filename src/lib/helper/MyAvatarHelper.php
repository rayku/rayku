<?php
/**
 * Creates the IMG element string for a user's avatar
 *
 * @param User $user
 * @return string
 */
 
function avatar_tag_for_user(User $user, $size = 1)
{



	return sprintf(
		'<img src="%s" alt="%s" />',
		url_for('@avatar?user_id=' . $user->getId().'&size=' . $size),
		$user->getName()
	);
}


/**
 * Creates the profile image with border
 *
 * @param User $user
 * @return string
 */
function user_link(User $user)
{
	$str= sprintf(
		'<div class="profile-image"><img src="%s" alt="%s" /></div>',
		url_for('@avatar?user_id=' . $user->getId()),
		$user->getName()
	);
	
	$str.='<div class="link">'.link_to($user->getName(),'/profile/'.$user->getUsername()).'</div>';
	if($user->getCountUserAward() > 0)
		$str.='<div class="award_img_main">';
	for($i = 0; $i<$user->getCountUserAward(); $i++)
	{
		$str.='<div class="award_img"><img src="/images/award.gif"/></div>';
	}
	if($user->getCountUserAward() > 0)
		$str.='</div>';	
	return $str;
}
