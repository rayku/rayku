<?php

/**
 * offer_voucher actions.
 *
 * @package    elifes
 * @subpackage offer_voucher
 * @author     Your name here
 */
class offer_voucherActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->offer_voucher_list = OfferVoucherPeer::doSelect(new Criteria());
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new OfferVoucherForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post'));

    $this->form = new OfferVoucherForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($offer_voucher = OfferVoucherPeer::retrieveByPk($request->getParameter('id')), sprintf('Object offer_voucher does not exist (%s).', $request->getParameter('id')));
    $this->form = new OfferVoucherForm($offer_voucher);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post') || $request->isMethod('put'));
    $this->forward404Unless($offer_voucher = OfferVoucherPeer::retrieveByPk($request->getParameter('id')), sprintf('Object offer_voucher does not exist (%s).', $request->getParameter('id')));
    $this->form = new OfferVoucherForm($offer_voucher);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($offer_voucher = OfferVoucherPeer::retrieveByPk($request->getParameter('id')), sprintf('Object offer_voucher does not exist (%s).', $request->getParameter('id')));
    $offer_voucher->delete();

    $this->redirect('offer_voucher/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $offer_voucher = $form->save();

     // $this->redirect('offer_voucher/edit?id='.$offer_voucher->getId());
	 
	  $this->redirect('offer_voucher/index');
	  
    }
  }
}
