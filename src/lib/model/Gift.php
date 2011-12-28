<?php

/**
 * Subclass for representing a row from the 'gift' table.
 *
 * 
 *
 * @package lib.model
 */ 
class Gift extends BaseGift
{
	/**
	* Returns the number of times that this gift was given.
	*/
	public function getTimesGiven()
	{
		$c = new Criteria();
		$c->add(UserGiftPeer::GIFT_ID, $this->getId());
		
		return UserGiftPeer::doCount($c);
	}
	
	/**
	* Takes the URL to an image as a parameter, generates a thumbnail of it,
	* and deletes the original image.
	* 
	* @param string $imageURL
	*/
	public function setImage($path)
	{
			
		//Setup a sfThumbnail object, with max dimensions specified in config
		$thumbnail = new sfThumbnail(73,73);
		
		//Load the uploaded file
		$thumbnail->loadFile(sfConfig::get('sf_upload_dir').'/'.$path);
		
		//Set the new path
		$newPath = sfConfig::get('sf_web_dir').'/images/gifts/'.$path;
		
		//Save the thumbnail at the new path
		$thumbnail->save($newPath);
		
		//Delete the uploaded image
	//	delete(sfConfig::get('sf_upload_dir').'/'.$path);
		
		//Save the thumbnail's path in the DB
		parent::setImage('gifts/'.$path);
	}

	/**
	* Overwrites the delete method for Gift so that calling delete actually just
	* makes it hidden
	*/
	public function delete(PropelPDO $con = null)
	{
		parent::setHidden(true);
		return parent::save($con);
	}

	/**
	* Forcibly deletes a gift from the DB, taking with it all foreign references
	* to it (all users who had one of these Gifts will suddenly see it vanish).
	*/
	public function forceDelete(PropelPDO $con = null)
	{
		return parent::delete($con);
	}
	
	/**
	* Returns the gift's name
	*/
	public function __toString()
	{
		return $this->getName();
	}
}
