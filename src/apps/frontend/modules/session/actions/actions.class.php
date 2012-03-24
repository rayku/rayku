<?php
/**
 * @subpackage session
 * @author     Diego Feitosa
 */
class sessionActions extends sfActions
{
    public function executeInfo()
    {
        $session = $this->loadSession();

        $info = $session->info();
        return $this->renderText(json_encode($info));
    }

    public function executeKeepAlive()
    {
        $session = $this->loadSession();
        $session->keepAlive();
        $session->save();

        return sfView::HEADER_ONLY;
    }

    public function executeAddChatId()
    {
        $session = $this->loadSession();
        $session->setChatId($this->getRequestParameter('chatId'));
        $session->save();

        return sfView::HEADER_ONLY;
    }

    private function loadSession()
    {
        $criteria = new Criteria();
        $criteria->add(WhiteboardSessionPeer::TOKEN, $this->getRequestParameter('token'));

        return WhiteboardSessionPeer::doSelectOne($criteria);
    }

}
