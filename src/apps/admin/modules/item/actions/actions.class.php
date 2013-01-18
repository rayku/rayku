<?php

/**
 * item actions.
 *
 * @package    elifes
 * @subpackage item
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2288 2006-10-02 15:22:13Z fabien $
 */
class itemActions extends autoitemActions
{

  public function updateItemFromRequest()
  {
  		if($this->getRequest()->getFileSize('item[image]')){
		$image= $this->getRequestParameter('item[image]');
		$filename = md5($this->getRequest()->getFileName('item[image]').time().rand(0, 99999));
        $ext = substr($this->getRequest()->getFileName('item[image]'),strpos($this->getRequest()->getFileName('item[image]'),"."));
		//var_dump(sfConfig::get('app_items_upload_folder'));die;
		$uploaddir=  sfConfig::get('sf_upload_dir')  . DIRECTORY_SEPARATOR . sfConfig::get('app_items_upload_folder');
		$this->getRequest()->moveFile('item[image]', $uploaddir . DIRECTORY_SEPARATOR .$filename.$ext);
		
		MyTools::resample($uploaddir . DIRECTORY_SEPARATOR .$filename.$ext,$uploaddir . DIRECTORY_SEPARATOR .$filename."_l".$ext,sfConfig::get('app_items_image_large_width'),sfConfig::get('app_items_image_large_height'));
		
		MyTools::resample($uploaddir . DIRECTORY_SEPARATOR .$filename.$ext,$uploaddir . DIRECTORY_SEPARATOR .$filename."_t".$ext,sfConfig::get('app_items_image_thumb_width'),sfConfig::get('app_items_image_thumb_height'));
		}
		
  		parent::updateItemFromRequest();
		if($this->getRequest()->getFileSize('item[image]')){
		$this->item->setImage($filename.$ext);
		$this->item->save();
		}
  }
  
}