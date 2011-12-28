<?php

/**
 * Subclass for representing a row from the 'gallery' table.
 *
 * 
 *
 * @package lib.model
 */ 
class Gallery extends BaseGallery
{
  const TYPE_PUBLIC = 0;
  const TYPE_PUBLIC_LABEL = 'Everyone';
  const TYPE_FRIENDS_AND_FAMILY = 1;
  const TYPE_FRIENDS_AND_FAMILY_LABEL = 'Friends Only';
  const TYPE_FAMILY_ONLY = 2;
  const TYPE_FAMILY_ONLY_LABEL = 'Family Only';
  const TYPE_SPECIFIC_PEOPLE_ONLY = 3;
  const TYPE_SPECIFIC_PEOPLE_ONLY_LABEL = 'Specific People (Select)';

  public function save(PropelPDO $con = null)
	{
    $this->setUserId( sfContext::getInstance()->getUser()->getRaykuUserId() );

    return parent::save($con);
	}

	/**
	 * Get whether the ACL is using a specific list of people
	 *
	 * @return boolean
	 */
	public function isSpecifiedList()
	{
		return ($this->getShowEntity() === Gallery::TYPE_SPECIFIC_PEOPLE_ONLY);
	}

	/**
	 * Checks to see if the parameter's user is the owner of this gallery 
	 *
	 * @param User $user
	 * @return boolean
	 */
	public function isOwnedBy(User $user)
	{
		return (
			$user->equals($this->getUser())
		);
	}

  static function getTypes()
  {
    return array(
      self::TYPE_PUBLIC => self::TYPE_PUBLIC_LABEL,
      self::TYPE_FRIENDS_AND_FAMILY => self::TYPE_FRIENDS_AND_FAMILY_LABEL,
      self::TYPE_SPECIFIC_PEOPLE_ONLY => self::TYPE_SPECIFIC_PEOPLE_ONLY_LABEL
    );
  }

  function getItems( $count = null )
  {
    $c = new Criteria;

    if( $count > 0 ) {
      $c->setLimit($count);
    }

    return $this->getGalleryItems($c);
  }
}
