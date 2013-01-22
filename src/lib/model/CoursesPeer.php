<?php

class CoursesPeer extends BaseCoursesPeer
{
    static function getAllForCategoryId($categoryId)
    {
        $c = new Criteria;
        $c->add(self::CATEGORY_ID, $categoryId);
        return self::doSelect($c);
    }

    public static function getAllForCategoryStatus($status)
    {
        $c = new Criteria;
        $c->add(CategoryPeer::STATUS, $status);
        return CoursesPeer::doSelectJoinCategory($c);
    }
}
