<?php

class StudentQuestion extends BaseStudentQuestion
{
    public function setStudent(User $user = null)
    {
        parent::setUserRelatedByStudentId($user);
    }

    public function getStudent()
    {
        return $this->getUserRelatedByStudentId();
    }

    public function setTutor(User $user = null)
    {
        parent::setUserRelatedByTutorId($user);
    }

    public function getTutor()
    {
        return $this->getUserRelatedByTutorId();
    }

}
