<?php
/**
 * @subpackage session
 * @author     Diego Feitosa
 */
class sessionActions extends sfActions
{
    private $whiteboardSessionPeer;

    public function executeInfo(sfWebRequest $request)
    {
        $session = $this->loadSession($request);
        $info = $session->info();
        return $this->renderText(json_encode($info));
    }

    public function executeKeepAlive(sfWebRequest $request)
    {
        $session = $this->loadSession($request);
        $session->keepAlive();
        $session->save();

        return sfView::HEADER_ONLY;
    }

    public function executeAddChatId(sfWebRequest $request)
    {
        $session = $this->loadSession($request);
        $session->setChatId($this->getRequestParameter('chatId'));
        $session->save();

        return sfView::HEADER_ONLY;
    }

    /**
     * Allow the setup for a mocked WhiteboardSessionPeer.
     * Get rid of this ASAP after adding the DI component.
     */
    public function setWhiteboardSessionPeer($peer)
    {
        $this->whiteboardSessionPeer = $peer;
    }

    private function getWhiteboardSessionPeer()
    {
        if ($this->whiteboardSessionPeer === null) {
            $this->whiteboardSessionPeer = new WhiteboardSessionPeer();
        }
        return $this->whiteboardSessionPeer;
    }

    private function loadSession($request)
    {
        $peer = $this->getWhiteboardSessionPeer();

        return $peer->loadByToken($request->getParameter('token'));
    }

}
