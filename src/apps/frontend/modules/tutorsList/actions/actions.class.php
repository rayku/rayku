<?php

/**
 * Module responsible for displaying list of tutors and other list related "things"
 */
class tutorsListActions extends sfActions
{
    public function executeIndex()
    {
        
    }
    
    
    public function executePopup()
    {
        $tutorsIds = $this->getUser()->getAttribute('selectedTutorsIds');
        
        if (count($tutorsIds) < 1) {
            return sfView::NONE;
        }
        
        $this->users = UserPeer::retrieveByPKs($tutorsIds);
        
        if (count($this->users) < 1) {
            return sfView::NONE;
        }
    }
}