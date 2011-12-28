<?php

/**
 * Subclass for representing a row from the 'forum' table.
 *
 * 
 *
 * @package lib.model
 */ 
class Forum extends BaseForum
{
  const TYPE_PUBLIC_FORUM = 0;
  const TYPE_PUBLIC_FORUM_LABEL = 'Public forum';
  const TYPE_STAFF_ONLY_FORUM = 1;
  const TYPE_STAFF_ONLY_FORUM_LABEL = 'Staff only forum';
  const TYPE_USER_FORUM = 2;
  const TYPE_USER_FORUM_LABEL = 'User forum';
  const TYPE_GROUP_FORUM = 3;
  const TYPE_GROUP_FORUM_LABEL = 'Group forum';

  static function getTypes()
  {
    return array(
      self::TYPE_PUBLIC_FORUM => self::TYPE_GROUP_FORUM_LABEL,
      self::TYPE_PUBLIC_FORUM => self::TYPE_PUBLIC_FORUM_LABEL,
      self::TYPE_STAFF_ONLY_FORUM => self::TYPE_STAFF_ONLY_FORUM_LABEL,
      self::TYPE_USER_FORUM => self::TYPE_USER_FORUM_LABEL
    );

  }
}
