<?php
/**
 * classroom_gallery actions.
 *
 * @package    elifes
 * @subpackage classroom_gallery
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class classroom_galleryActions extends sfActions
{
  /**
	 * helper method to delete gallery items
	 *
	 * @param GalleryItem $galleryItem
	 */
	private function deleteGalleryItem(GalleryItem $galleryItem)
	{
		$uploadDir = sfConfig::get('sf_upload_dir') . DIRECTORY_SEPARATOR . sfConfig::get('app_gallery_upload_folder');
		$file = $uploadDir . DIRECTORY_SEPARATOR . $galleryItem->getFileSystemPath();

		@unlink($file);

		if ($galleryItem->getIsImage())
		{
			@unlink($file . 'thumb');
		}

		$galleryItem->delete();
	}

	public function executeCreate()
	{
		if (sfWebRequest::POST === $this->getRequest()->getMethod())
		{
			// add gallery
			$gallery = new Gallery();
			$gallery->setTitle($this->getRequestParameter('title'));
			$gallery->setShowEntity($this->getRequestParameter('gallery[type]'));
      $gallery->setClassroom( RaykuCommon::getCurrentClassroom( $this->getUser() ) );
			$gallery->save();

			// if the gallery is ACL restricted...
			if ($this->getRequestParameter('gallery[type]') == Gallery::TYPE_SPECIFIC_PEOPLE_ONLY)
			{
				// for each gallery ACL member...
				foreach ($this->getRequestParameter('friend') as $user => $one)
				{
					// setup an ACL entry
					$galleryAcl = new GalleryAcl();
					$galleryAcl->setGalleryId($gallery->getId());
					$galleryAcl->setUserId($user);
					$galleryAcl->save();
				}
			}

			// show the gallery
			$this->redirect('classroom_gallery/show?user_id=' . $gallery->getUserId() );
		}

		$friends = $this->getUser()->getRaykuUser()->getAllFriends();

		// assign to view
		$this->friends = $friends;
	}

	public function handleErrorCreate()
	{
		return sfView::SUCCESS;
	}

	public function executeIndex()
	{
		$user = UserPeer::retrieveByPk($this->getRequestParameter('user_id'));



		$this->forward404Unless($user instanceof User);
		/* @var $user User */

		$tmpGalleries = GalleryPeer::findGalleriesForUser($user);

		$galleries = array();

		// get the available galleries for this current user
		foreach ($tmpGalleries as $gallery)
		{
			if (
					(
						(
							$this->getUser()->isAuthenticated() && $this->getUser()->getRaykuUser()->canViewGallery($gallery)
						)
						|| $gallery->getShowEntity() == Gallery::TYPE_PUBLIC
					)
					&& (RaykuCommon::getCurrentClassroom( $this->getUser() )->getId() == $gallery->getClassroomId())
				)
			{
				$galleries[] = $gallery;
			}
		}

		// assign variables to view
		$this->galleries = $galleries;
		$this->owner = $user;
	}

	public function executeEdit()
	{
		$gallery = GalleryPeer::retrieveByPk($this->getRequestParameter('id'));
		
		$this->forward404Unless($gallery instanceof Gallery);
		/* @var $gallery Gallery */

		if (sfWebRequest::POST === $this->getRequest()->getMethod())
		{
			// clear the gallery's ACL
			$c = new Criteria();
			$c->add(GalleryAclPeer::GALLERY_ID, $this->getRequestParameter('id'));
			GalleryAclPeer::doDelete($c);

			// persist the changes
			$gallery->setTitle($this->getRequestParameter('title'));

			$gallery->setShowEntity($this->getRequestParameter('gallery[type]'));
			$gallery->setClassroomId(RaykuCommon::getCurrentClassroom( $this->getUser() )->getId());

			$gallery->save();

			// if the gallery is ACL restricted...
			if ($this->getRequestParameter('gallery[type]') == Gallery::TYPE_SPECIFIC_PEOPLE_ONLY)
			{
				// for each gallery ACL member...
				foreach ($this->getRequestParameter('friend', array()) as $user => $one)
				{
					// setup an ACL entry
					$galleryAcl = new GalleryAcl();
					$galleryAcl->setGalleryId($gallery->getId());
					$galleryAcl->setUserId($user);
					$galleryAcl->save();
				}
			}

			// show the gallery
			$this->redirect('classroom_gallery/show?user_id=' . $this->getUser()->getRaykuUserId() );
		}

		$friends = $this->getUser()->getRaykuUser()->getAllFriends();
		$selectedFriendAcls = $gallery->getGalleryAcls();
		$selectedFriends = array();
		foreach ($selectedFriendAcls as $acl)
		{
			/* @var $acl GalleryAcl */
			$selectedFriends[] = $acl->getUserId();
		}

		// assign to view
		$this->friends = $friends;
		$this->selectedFriends = $selectedFriends;
		$this->gallery = $gallery;
	}

	public function handleErrorEdit()
	{
		$gallery = GalleryPeer::retrieveByPk($this->getRequestParameter('id'));

		$this->forward404Unless($gallery instanceof Gallery);

		$friends = $this->getUser()->getRaykuUser()->getAllFriends();

		// assign to view
		$this->friends = $friends;
		$this->gallery = $gallery;

		return sfView::SUCCESS;
	}

	public function executeShow()
	{
		$gallery = RaykuCommon::getCurrentClassroom($this->getUser())->getOwnerGallery();

		$this->forward404Unless($gallery instanceof Gallery);

		$user = $this->getUser()->getRaykuUser();

		// if the user is logged in
		if ($user instanceof User)
		{
			// confirm that the user can view this gallery
			if (!$user->canViewGallery($gallery))
			{
				return sfView::ERROR;
			}
		}
		else
		{
			// if the user isn't logged in, check if it's public
			if ($gallery->getShowEntity() != Gallery::TYPE_PUBLIC)
			{
				return sfView::ERROR;
			}
		}

		$c = new Criteria();
		$c->add(GalleryItemPeer::IS_IMAGE, true);
		$images = $gallery->getGalleryItems($c);

		$c = new Criteria();
		$c->add(GalleryItemPeer::IS_IMAGE, false);
		$videos = $gallery->getGalleryItems($c);

		// assign variables to view
		$this->gallery = $gallery;
		$this->videos = $videos;
		$this->images = $images;
		
		
		
		/*$gallery = GalleryPeer::retrieveByPk($this->getRequestParameter('id'));

		$this->forward404Unless($gallery instanceof Gallery);

		$user = UserPeer::retrieveByPK($this->getUser()->getRaykuUserId());

		// if the user is logged in
		if ($user instanceof User)
		{
			// confirm that the user can view this gallery
			if (!$user->canViewGallery($gallery))
			{
				return sfView::ERROR;
			}
		}
		else
		{
			// if the user isn't logged in, check if it's public
			if ($gallery->getShowEntity() != Gallery::TYPE_PUBLIC)
			{
				return sfView::ERROR;
			}
		}

		$c = new Criteria();
		$c->add(GalleryItemPeer::IS_IMAGE, true);
		$images = $gallery->getGalleryItems($c);

		$c = new Criteria();
		$c->add(GalleryItemPeer::IS_IMAGE, false);
		$videos = $gallery->getGalleryItems($c);

		// assign variables to view
		$this->gallery = $gallery;
		$this->videos = $videos;
		$this->images = $images;*/
	}

	public function executeDelete()
	{
		$gallery = GalleryPeer::retrieveByPk($this->getRequestParameter('id'));

		$this->forward404Unless($gallery instanceof Gallery);
		/* @var $gallery Gallery */

		// ensure logged in user is the gallery owner
		if ($gallery->getUserId() !== $this->getUser()->getRaykuUserId() )
		{
			$this->forward404();
		}

		$con = Propel::getConnection();

		try
		{
			$con->beginTransaction();

			foreach ($gallery->getGalleryItems() as $galleryItem)
			{
				$this->deleteGalleryItem($galleryItem);
			}

			$gallery->delete();

			$con->commit();
		}
		catch (Exception $e)
		{
			$con->rollback();
		}

		$this->redirect('@homepage');
	}

	public function executeUpload()
	{
		$gallery = GalleryPeer::retrieveByPk($this->getRequestParameter('id'));

		$this->forward404Unless($gallery instanceof Gallery);

		if (sfWebRequest::POST === $this->getRequest()->getMethod())
		{
			$con = Propel::getConnection();

			try
			{
				$con->beginTransaction();

				$mimeType = $this->getRequest()->getFileType('file');
				$validMimeTypes = sfConfig::get('app_gallery_valid_mime_types');

				// add gallery item
				$galleryItem = new GalleryItem();
				$galleryItem->setGallery($gallery);
				$galleryItem->setFileName($this->getRequest()->getFileName('file'));
				$galleryItem->setMimeType($mimeType);
				$galleryItem->setIsImage(in_array($mimeType, $validMimeTypes['image']));

				$galleryItem->save();

				// move to uploads
				$uploadDir = sfConfig::get('sf_upload_dir') . DIRECTORY_SEPARATOR . sfConfig::get('app_gallery_upload_folder');

				if (!file_exists($uploadDir))
				{
					mkdir($uploadDir, 0700, true);
				}

				$filename = $galleryItem->getId();
				$target = $uploadDir . DIRECTORY_SEPARATOR . $filename;

				$successfullyMoved = $this->getRequest()->moveFile('file', $target);

				if (!$successfullyMoved)
				{
					throw new Exception('Could not move uploaded file');
				}

				// set filename to the id
				$galleryItem->setFileSystemPath($galleryItem->getId());
				$galleryItem->save();

				if ($galleryItem->getIsImage())
				{
					// resize image
					$thumb = new sfThumbnail(sfConfig::get('app_gallery_image_max_width'), sfConfig::get('app_gallery_image_max_height'));
					$thumb->loadFile($target);
					$thumb->save($target);

					// create thumb
					$thumb = new sfThumbnail(sfConfig::get('app_gallery_thumbnail_max_width'), sfConfig::get('app_gallery_thumbnail_max_height'));
					$thumb->loadFile($target);
					$thumb->save($target . 'thumb');
				}

				$con->commit();
			}
			catch (Exception $e)
			{
				$con->rollback();

				$this->getRequest()->setError('file', 'An error occurred during upload');
				$this->gallery = $gallery;

				return sfView::SUCCESS;
			}

			// go back to the gallery
			$this->redirect('classroom_gallery/show?user_id=' . $gallery->getUserId());
		}

		// assign variables to view
		$this->gallery = $gallery;
		$this->maximum_upload_size = ini_get('upload_max_filesize');
	}

	public function handleErrorUpload()
	{
		$gallery = GalleryPeer::retrieveByPk($this->getRequestParameter('id'));

		$this->forward404Unless($gallery instanceof Gallery);

		// assign variables to view
		$this->gallery = $gallery;
		$this->maximum_upload_size = ini_get('upload_max_filesize');

		return sfView::SUCCESS;
	}

	public function validateUpload()
	{
		// if it's a post (as in, we're submitting the form)
		if (sfWebRequest::POST === $this->getRequest()->getMethod())
		{
			// set the default error message
			$this->getRequest()->setError('file', 'An error occurred during upload');

			// if the file was attached to the POST
			if ($this->getRequest()->hasFile('file'))
			{
				// if the file was uploaded successfully
				if (!$this->getRequest()->hasFileError('file'))
				{
					$mimeType = $this->getRequest()->getFileType('file');
					$validMimeTypes = sfConfig::get('app_gallery_valid_mime_types');

					$this->logMessage('Received MIME type of: ' . $mimeType);

					if (in_array($mimeType, $validMimeTypes['image']))
					{
						$this->logMessage('MIME type seems to be of an image');
						return true;
					}
					else if (in_array($mimeType, $validMimeTypes['video']))
					{
						$this->logMessage('MIME type seems to be of a video');
						return true;
					}

					$this->logMessage('MIME type seems to be neither an image or a video!');
					$this->getRequest()->setError('file', 'Uploaded file does not appear to be an image or a video');
					return false;
				}
				else
				{
					switch ($this->getRequest()->hasFileError('file'))
					{
						case 1:
							$this->getRequest()->setError('file', 'The file uploaded is bigger than the maximum allowed size');
							break;

					}
				}
			}

			return false;
		}

		return true;
	}

	public function executeItemShow()
	{
		$galleryItem = GalleryItemPeer::retrieveByPk($this->getRequestParameter('id'));

		$this->forward404Unless($galleryItem instanceof GalleryItem);
		/* @var $galleryItem GalleryItem */

		$user = $this->getUser()->getRaykuUser();
		$gallery = $galleryItem->getGallery();

		// if the user is logged in
		if ($user instanceof User)
		{
			// confirm that the user can view this gallery
			if (!$user->canViewGallery($gallery))
			{
				return sfView::ERROR;
			}
		}
		else
		{
			// if the user isn't logged in, check if it's public
			if ($gallery->getShowEntity() != Gallery::TYPE_PUBLIC)
			{
				return sfView::ERROR;
			}
		}

		$uploadDir = sfConfig::get('sf_upload_dir') . DIRECTORY_SEPARATOR . sfConfig::get('app_gallery_upload_folder');
		$file = $uploadDir . DIRECTORY_SEPARATOR . $galleryItem->getFileSystemPath();

		if (true == $this->getRequestParameter('thumb'))
		{
			$file .= 'thumb';
		}

		$this->getResponse()->clearHttpHeaders();
		$this->getResponse()->setHttpHeader('Content-Length', (string)(filesize($file)), true);
        $this->getResponse()->setHttpHeader('Content-Transfer-Encoding', 'binary', true);
		$this->getResponse()->setContentType($galleryItem->getMimeType());
		$this->getResponse()->sendHttpHeaders();

		readfile($file);

		return sfView::NONE;
	}

	public function executeItemDisplay()
	{
		$galleryItem = GalleryItemPeer::retrieveByPk($this->getRequestParameter('id'));

		$this->forward404Unless($galleryItem instanceof GalleryItem);
		/* @var $galleryItem GalleryItem */

		$this->galleryItem = $galleryItem;
	}

	public function executeItemDelete()
	{
		$galleryItem = GalleryItemPeer::retrieveByPk($this->getRequestParameter('id'));

		$this->forward404Unless($galleryItem instanceof GalleryItem);
		/* @var $galleryItem GalleryItem */

		$gallery = $galleryItem->getGallery();
		/* @var $gallery Gallery */

		// ensure logged in user is the gallery owner
		if ($gallery->getUserId() !== $this->getUser()->getRaykuUserId() )
		{
			$this->forward404();
		}

		$con = Propel::getConnection();

		try
		{
			$con->beginTransaction();

			$this->deleteGalleryItem($galleryItem);

			$con->commit();
		}
		catch (Exception $e)
		{
			$con->rollback();
		}

		// go back to the gallery
		$this->redirect('classroom_gallery/show?user_id=' . $gallery->getUserId());
	}

	public function executeItemDownload()
	{
		$galleryItem = GalleryItemPeer::retrieveByPk($this->getRequestParameter('id'));

		$this->forward404Unless($galleryItem instanceof GalleryItem);
		/* @var $galleryItem GalleryItem */

		$user = $this->getUser()->getRaykuUser();
		$gallery = $galleryItem->getGallery();

		// if the user is logged in
		if ($user instanceof User)
		{
			// confirm that the user can view this gallery
			if (!$user->canViewGallery($gallery))
			{
				return sfView::ERROR;
			}
		}
		else
		{
			// if the user isn't logged in, check if it's public
			if ($gallery->getShowEntity() != Gallery::TYPE_PUBLIC)
			{
				return sfView::ERROR;
			}
		}

		$uploadDir = sfConfig::get('sf_upload_dir') . DIRECTORY_SEPARATOR . sfConfig::get('app_gallery_upload_folder');
		$file = $uploadDir . DIRECTORY_SEPARATOR . $galleryItem->getFileSystemPath();

		if (!is_file($file))
			$this->forward404();

		$this->getResponse()->clearHttpHeaders();
		$this->getResponse()->setHttpHeader('Date', date('D M j G:i:s T Y'), true);
		$this->getResponse()->setHttpHeader('Last-Modified', date('D M j G:i:s T Y'), true);
		$this->getResponse()->setHttpHeader('Content-Length', (string)(filesize($file)), true);
		$this->getResponse()->setHttpHeader('Content-Transfer-Encoding', 'binary', true);
		$this->getResponse()->setHttpHeader('Content-Disposition', 'attachment;filename=' . $galleryItem->getFileName(), true);
		$this->getResponse()->setContentType('application/octet-stream');
		$this->getResponse()->sendHttpHeaders();

		readfile($file);

		return sfView::NONE;
	}

	public function executeSetAsAvatar()
	{
		$galleryItem = GalleryItemPeer::retrieveByPk($this->getRequestParameter('id'));

		$this->forward404Unless($galleryItem instanceof GalleryItem);
		/* @var $galleryItem GalleryItem */

		$user = $this->getUser()->getRaykuUser();
		$gallery = $galleryItem->getGallery();

		// if the user is logged in
		if ($user instanceof User)
		{
			// confirm that the user can view this gallery
			if (!$user->canViewGallery($gallery))
			{
				return sfView::ERROR;
			}
		}
		else
		{
			// if the user isn't logged in, check if it's public
			if ($gallery->getShowEntity() != Gallery::TYPE_PUBLIC)
			{
				return sfView::ERROR;
			}
		}

		$uploadDir = sfConfig::get('sf_upload_dir') . DIRECTORY_SEPARATOR . sfConfig::get('app_gallery_upload_folder');
		$sourceFile = $uploadDir . DIRECTORY_SEPARATOR . $galleryItem->getFileSystemPath();

    RaykuCommon::writeAvatarImage($sourceFile, $user->getId());

		$this->redirect('classroom_gallery/show?user_id=' . $user->getId());
	}
}
