<?php

/**
 * Base class that represents a row from the 'report_entity' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseReportEntity extends BaseObject  implements Persistent {


  const PEER = 'ReportEntityPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        ReportEntityPeer
	 */
	protected static $peer;

	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;

	/**
	 * The value for the report_count field.
	 * @var        int
	 */
	protected $report_count;

	/**
	 * The value for the thread_id field.
	 * @var        int
	 */
	protected $thread_id;

	/**
	 * The value for the post_id field.
	 * @var        int
	 */
	protected $post_id;

	/**
	 * The value for the group_id field.
	 * @var        int
	 */
	protected $group_id;

	/**
	 * The value for the bulletin_id field.
	 * @var        int
	 */
	protected $bulletin_id;

	/**
	 * The value for the group_site_page_id field.
	 * @var        int
	 */
	protected $group_site_page_id;

	/**
	 * The value for the comment_id field.
	 * @var        int
	 */
	protected $comment_id;

	/**
	 * The value for the picture_id field.
	 * @var        int
	 */
	protected $picture_id;

	/**
	 * The value for the video_id field.
	 * @var        int
	 */
	protected $video_id;

	/**
	 * The value for the shout_id field.
	 * @var        int
	 */
	protected $shout_id;

	/**
	 * Flag to prevent endless save loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInSave = false;

	/**
	 * Flag to prevent endless validation loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInValidation = false;

	/**
	 * Initializes internal state of BaseReportEntity object.
	 * @see        applyDefaults()
	 */
	public function __construct()
	{
		parent::__construct();
		$this->applyDefaultValues();
	}

	/**
	 * Applies default values to this object.
	 * This method should be called from the object's constructor (or
	 * equivalent initialization method).
	 * @see        __construct()
	 */
	public function applyDefaultValues()
	{
	}

	/**
	 * Get the [id] column value.
	 * 
	 * @return     int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Get the [report_count] column value.
	 * 
	 * @return     int
	 */
	public function getReportCount()
	{
		return $this->report_count;
	}

	/**
	 * Get the [thread_id] column value.
	 * 
	 * @return     int
	 */
	public function getThreadId()
	{
		return $this->thread_id;
	}

	/**
	 * Get the [post_id] column value.
	 * 
	 * @return     int
	 */
	public function getPostId()
	{
		return $this->post_id;
	}

	/**
	 * Get the [group_id] column value.
	 * 
	 * @return     int
	 */
	public function getGroupId()
	{
		return $this->group_id;
	}

	/**
	 * Get the [bulletin_id] column value.
	 * 
	 * @return     int
	 */
	public function getBulletinId()
	{
		return $this->bulletin_id;
	}

	/**
	 * Get the [group_site_page_id] column value.
	 * 
	 * @return     int
	 */
	public function getGroupSitePageId()
	{
		return $this->group_site_page_id;
	}

	/**
	 * Get the [comment_id] column value.
	 * 
	 * @return     int
	 */
	public function getCommentId()
	{
		return $this->comment_id;
	}

	/**
	 * Get the [picture_id] column value.
	 * 
	 * @return     int
	 */
	public function getPictureId()
	{
		return $this->picture_id;
	}

	/**
	 * Get the [video_id] column value.
	 * 
	 * @return     int
	 */
	public function getVideoId()
	{
		return $this->video_id;
	}

	/**
	 * Get the [shout_id] column value.
	 * 
	 * @return     int
	 */
	public function getShoutId()
	{
		return $this->shout_id;
	}

	/**
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     ReportEntity The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = ReportEntityPeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [report_count] column.
	 * 
	 * @param      int $v new value
	 * @return     ReportEntity The current object (for fluent API support)
	 */
	public function setReportCount($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->report_count !== $v) {
			$this->report_count = $v;
			$this->modifiedColumns[] = ReportEntityPeer::REPORT_COUNT;
		}

		return $this;
	} // setReportCount()

	/**
	 * Set the value of [thread_id] column.
	 * 
	 * @param      int $v new value
	 * @return     ReportEntity The current object (for fluent API support)
	 */
	public function setThreadId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->thread_id !== $v) {
			$this->thread_id = $v;
			$this->modifiedColumns[] = ReportEntityPeer::THREAD_ID;
		}

		return $this;
	} // setThreadId()

	/**
	 * Set the value of [post_id] column.
	 * 
	 * @param      int $v new value
	 * @return     ReportEntity The current object (for fluent API support)
	 */
	public function setPostId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->post_id !== $v) {
			$this->post_id = $v;
			$this->modifiedColumns[] = ReportEntityPeer::POST_ID;
		}

		return $this;
	} // setPostId()

	/**
	 * Set the value of [group_id] column.
	 * 
	 * @param      int $v new value
	 * @return     ReportEntity The current object (for fluent API support)
	 */
	public function setGroupId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->group_id !== $v) {
			$this->group_id = $v;
			$this->modifiedColumns[] = ReportEntityPeer::GROUP_ID;
		}

		return $this;
	} // setGroupId()

	/**
	 * Set the value of [bulletin_id] column.
	 * 
	 * @param      int $v new value
	 * @return     ReportEntity The current object (for fluent API support)
	 */
	public function setBulletinId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->bulletin_id !== $v) {
			$this->bulletin_id = $v;
			$this->modifiedColumns[] = ReportEntityPeer::BULLETIN_ID;
		}

		return $this;
	} // setBulletinId()

	/**
	 * Set the value of [group_site_page_id] column.
	 * 
	 * @param      int $v new value
	 * @return     ReportEntity The current object (for fluent API support)
	 */
	public function setGroupSitePageId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->group_site_page_id !== $v) {
			$this->group_site_page_id = $v;
			$this->modifiedColumns[] = ReportEntityPeer::GROUP_SITE_PAGE_ID;
		}

		return $this;
	} // setGroupSitePageId()

	/**
	 * Set the value of [comment_id] column.
	 * 
	 * @param      int $v new value
	 * @return     ReportEntity The current object (for fluent API support)
	 */
	public function setCommentId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->comment_id !== $v) {
			$this->comment_id = $v;
			$this->modifiedColumns[] = ReportEntityPeer::COMMENT_ID;
		}

		return $this;
	} // setCommentId()

	/**
	 * Set the value of [picture_id] column.
	 * 
	 * @param      int $v new value
	 * @return     ReportEntity The current object (for fluent API support)
	 */
	public function setPictureId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->picture_id !== $v) {
			$this->picture_id = $v;
			$this->modifiedColumns[] = ReportEntityPeer::PICTURE_ID;
		}

		return $this;
	} // setPictureId()

	/**
	 * Set the value of [video_id] column.
	 * 
	 * @param      int $v new value
	 * @return     ReportEntity The current object (for fluent API support)
	 */
	public function setVideoId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->video_id !== $v) {
			$this->video_id = $v;
			$this->modifiedColumns[] = ReportEntityPeer::VIDEO_ID;
		}

		return $this;
	} // setVideoId()

	/**
	 * Set the value of [shout_id] column.
	 * 
	 * @param      int $v new value
	 * @return     ReportEntity The current object (for fluent API support)
	 */
	public function setShoutId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->shout_id !== $v) {
			$this->shout_id = $v;
			$this->modifiedColumns[] = ReportEntityPeer::SHOUT_ID;
		}

		return $this;
	} // setShoutId()

	/**
	 * Indicates whether the columns in this object are only set to default values.
	 *
	 * This method can be used in conjunction with isModified() to indicate whether an object is both
	 * modified _and_ has some values set which are non-default.
	 *
	 * @return     boolean Whether the columns in this object are only been set with default values.
	 */
	public function hasOnlyDefaultValues()
	{
			// First, ensure that we don't have any columns that have been modified which aren't default columns.
			if (array_diff($this->modifiedColumns, array())) {
				return false;
			}

		// otherwise, everything was equal, so return TRUE
		return true;
	} // hasOnlyDefaultValues()

	/**
	 * Hydrates (populates) the object variables with values from the database resultset.
	 *
	 * An offset (0-based "start column") is specified so that objects can be hydrated
	 * with a subset of the columns in the resultset rows.  This is needed, for example,
	 * for results of JOIN queries where the resultset row includes columns from two or
	 * more tables.
	 *
	 * @param      array $row The row returned by PDOStatement->fetch(PDO::FETCH_NUM)
	 * @param      int $startcol 0-based offset column which indicates which restultset column to start with.
	 * @param      boolean $rehydrate Whether this object is being re-hydrated from the database.
	 * @return     int next starting column
	 * @throws     PropelException  - Any caught Exception will be rewrapped as a PropelException.
	 */
	public function hydrate($row, $startcol = 0, $rehydrate = false)
	{
		try {

			$this->id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->report_count = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->thread_id = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->post_id = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
			$this->group_id = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
			$this->bulletin_id = ($row[$startcol + 5] !== null) ? (int) $row[$startcol + 5] : null;
			$this->group_site_page_id = ($row[$startcol + 6] !== null) ? (int) $row[$startcol + 6] : null;
			$this->comment_id = ($row[$startcol + 7] !== null) ? (int) $row[$startcol + 7] : null;
			$this->picture_id = ($row[$startcol + 8] !== null) ? (int) $row[$startcol + 8] : null;
			$this->video_id = ($row[$startcol + 9] !== null) ? (int) $row[$startcol + 9] : null;
			$this->shout_id = ($row[$startcol + 10] !== null) ? (int) $row[$startcol + 10] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 11; // 11 = ReportEntityPeer::NUM_COLUMNS - ReportEntityPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating ReportEntity object", $e);
		}
	}

	/**
	 * Checks and repairs the internal consistency of the object.
	 *
	 * This method is executed after an already-instantiated object is re-hydrated
	 * from the database.  It exists to check any foreign keys to make sure that
	 * the objects related to the current object are correct based on foreign key.
	 *
	 * You can override this method in the stub class, but you should always invoke
	 * the base method from the overridden method (i.e. parent::ensureConsistency()),
	 * in case your model changes.
	 *
	 * @throws     PropelException
	 */
	public function ensureConsistency()
	{

	} // ensureConsistency

	/**
	 * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
	 *
	 * This will only work if the object has been saved and has a valid primary key set.
	 *
	 * @param      boolean $deep (optional) Whether to also de-associated any related objects.
	 * @param      PropelPDO $con (optional) The PropelPDO connection to use.
	 * @return     void
	 * @throws     PropelException - if this object is deleted, unsaved or doesn't have pk match in db
	 */
	public function reload($deep = false, PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("Cannot reload a deleted object.");
		}

		if ($this->isNew()) {
			throw new PropelException("Cannot reload an unsaved object.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ReportEntityPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = ReportEntityPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

		} // if (deep)
	}

	/**
	 * Removes this object from datastore and sets delete attribute.
	 *
	 * @param      PropelPDO $con
	 * @return     void
	 * @throws     PropelException
	 * @see        BaseObject::setDeleted()
	 * @see        BaseObject::isDeleted()
	 */
	public function delete(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ReportEntityPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			ReportEntityPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Persists this object to the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All modified related objects will also be persisted in the doSave()
	 * method.  This method wraps all precipitate database operations in a
	 * single transaction.
	 *
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        doSave()
	 */
	public function save(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ReportEntityPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			ReportEntityPeer::addInstanceToPool($this);
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Performs the work of inserting or updating the row in the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All related objects are also updated in this method.
	 *
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        save()
	 */
	protected function doSave(PropelPDO $con)
	{
		$affectedRows = 0; // initialize var to track total num of affected rows
		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;

			if ($this->isNew() ) {
				$this->modifiedColumns[] = ReportEntityPeer::ID;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = ReportEntityPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += ReportEntityPeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			$this->alreadyInSave = false;

		}
		return $affectedRows;
	} // doSave()

	/**
	 * Array of ValidationFailed objects.
	 * @var        array ValidationFailed[]
	 */
	protected $validationFailures = array();

	/**
	 * Gets any ValidationFailed objects that resulted from last call to validate().
	 *
	 *
	 * @return     array ValidationFailed[]
	 * @see        validate()
	 */
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	/**
	 * Validates the objects modified field values and all objects related to this table.
	 *
	 * If $columns is either a column name or an array of column names
	 * only those columns are validated.
	 *
	 * @param      mixed $columns Column name or an array of column names.
	 * @return     boolean Whether all columns pass validation.
	 * @see        doValidate()
	 * @see        getValidationFailures()
	 */
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	/**
	 * This function performs the validation work for complex object models.
	 *
	 * In addition to checking the current object, all related objects will
	 * also be validated.  If all pass then <code>true</code> is returned; otherwise
	 * an aggreagated array of ValidationFailed objects will be returned.
	 *
	 * @param      array $columns Array of column names to validate.
	 * @return     mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objets otherwise.
	 */
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


			if (($retval = ReportEntityPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	/**
	 * Retrieves a field from the object by name passed in as a string.
	 *
	 * @param      string $name name
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     mixed Value of field.
	 */
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ReportEntityPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	/**
	 * Retrieves a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @return     mixed Value of field at $pos
	 */
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getReportCount();
				break;
			case 2:
				return $this->getThreadId();
				break;
			case 3:
				return $this->getPostId();
				break;
			case 4:
				return $this->getGroupId();
				break;
			case 5:
				return $this->getBulletinId();
				break;
			case 6:
				return $this->getGroupSitePageId();
				break;
			case 7:
				return $this->getCommentId();
				break;
			case 8:
				return $this->getPictureId();
				break;
			case 9:
				return $this->getVideoId();
				break;
			case 10:
				return $this->getShoutId();
				break;
			default:
				return null;
				break;
		} // switch()
	}

	/**
	 * Exports the object as an array.
	 *
	 * You can specify the key type of the array by passing one of the class
	 * type constants.
	 *
	 * @param      string $keyType (optional) One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                        BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. Defaults to BasePeer::TYPE_PHPNAME.
	 * @param      boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns.  Defaults to TRUE.
	 * @return     an associative array containing the field names (as keys) and field values
	 */
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = ReportEntityPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getReportCount(),
			$keys[2] => $this->getThreadId(),
			$keys[3] => $this->getPostId(),
			$keys[4] => $this->getGroupId(),
			$keys[5] => $this->getBulletinId(),
			$keys[6] => $this->getGroupSitePageId(),
			$keys[7] => $this->getCommentId(),
			$keys[8] => $this->getPictureId(),
			$keys[9] => $this->getVideoId(),
			$keys[10] => $this->getShoutId(),
		);
		return $result;
	}

	/**
	 * Sets a field from the object by name passed in as a string.
	 *
	 * @param      string $name peer name
	 * @param      mixed $value field value
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     void
	 */
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ReportEntityPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	/**
	 * Sets a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @param      mixed $value field value
	 * @return     void
	 */
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setReportCount($value);
				break;
			case 2:
				$this->setThreadId($value);
				break;
			case 3:
				$this->setPostId($value);
				break;
			case 4:
				$this->setGroupId($value);
				break;
			case 5:
				$this->setBulletinId($value);
				break;
			case 6:
				$this->setGroupSitePageId($value);
				break;
			case 7:
				$this->setCommentId($value);
				break;
			case 8:
				$this->setPictureId($value);
				break;
			case 9:
				$this->setVideoId($value);
				break;
			case 10:
				$this->setShoutId($value);
				break;
		} // switch()
	}

	/**
	 * Populates the object using an array.
	 *
	 * This is particularly useful when populating an object from one of the
	 * request arrays (e.g. $_POST).  This method goes through the column
	 * names, checking to see whether a matching key exists in populated
	 * array. If so the setByName() method is called for that column.
	 *
	 * You can specify the key type of the array by additionally passing one
	 * of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
	 * BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
	 * The default key type is the column's phpname (e.g. 'AuthorId')
	 *
	 * @param      array  $arr     An array to populate the object from.
	 * @param      string $keyType The type of keys the array uses.
	 * @return     void
	 */
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ReportEntityPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setReportCount($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setThreadId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setPostId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setGroupId($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setBulletinId($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setGroupSitePageId($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCommentId($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setPictureId($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setVideoId($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setShoutId($arr[$keys[10]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(ReportEntityPeer::DATABASE_NAME);

		if ($this->isColumnModified(ReportEntityPeer::ID)) $criteria->add(ReportEntityPeer::ID, $this->id);
		if ($this->isColumnModified(ReportEntityPeer::REPORT_COUNT)) $criteria->add(ReportEntityPeer::REPORT_COUNT, $this->report_count);
		if ($this->isColumnModified(ReportEntityPeer::THREAD_ID)) $criteria->add(ReportEntityPeer::THREAD_ID, $this->thread_id);
		if ($this->isColumnModified(ReportEntityPeer::POST_ID)) $criteria->add(ReportEntityPeer::POST_ID, $this->post_id);
		if ($this->isColumnModified(ReportEntityPeer::GROUP_ID)) $criteria->add(ReportEntityPeer::GROUP_ID, $this->group_id);
		if ($this->isColumnModified(ReportEntityPeer::BULLETIN_ID)) $criteria->add(ReportEntityPeer::BULLETIN_ID, $this->bulletin_id);
		if ($this->isColumnModified(ReportEntityPeer::GROUP_SITE_PAGE_ID)) $criteria->add(ReportEntityPeer::GROUP_SITE_PAGE_ID, $this->group_site_page_id);
		if ($this->isColumnModified(ReportEntityPeer::COMMENT_ID)) $criteria->add(ReportEntityPeer::COMMENT_ID, $this->comment_id);
		if ($this->isColumnModified(ReportEntityPeer::PICTURE_ID)) $criteria->add(ReportEntityPeer::PICTURE_ID, $this->picture_id);
		if ($this->isColumnModified(ReportEntityPeer::VIDEO_ID)) $criteria->add(ReportEntityPeer::VIDEO_ID, $this->video_id);
		if ($this->isColumnModified(ReportEntityPeer::SHOUT_ID)) $criteria->add(ReportEntityPeer::SHOUT_ID, $this->shout_id);

		return $criteria;
	}

	/**
	 * Builds a Criteria object containing the primary key for this object.
	 *
	 * Unlike buildCriteria() this method includes the primary key values regardless
	 * of whether or not they have been modified.
	 *
	 * @return     Criteria The Criteria object containing value(s) for primary key(s).
	 */
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(ReportEntityPeer::DATABASE_NAME);

		$criteria->add(ReportEntityPeer::ID, $this->id);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getId();
	}

	/**
	 * Generic method to set the primary key (id column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setId($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of ReportEntity (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setReportCount($this->report_count);

		$copyObj->setThreadId($this->thread_id);

		$copyObj->setPostId($this->post_id);

		$copyObj->setGroupId($this->group_id);

		$copyObj->setBulletinId($this->bulletin_id);

		$copyObj->setGroupSitePageId($this->group_site_page_id);

		$copyObj->setCommentId($this->comment_id);

		$copyObj->setPictureId($this->picture_id);

		$copyObj->setVideoId($this->video_id);

		$copyObj->setShoutId($this->shout_id);


		$copyObj->setNew(true);

		$copyObj->setId(NULL); // this is a auto-increment column, so set to default value

	}

	/**
	 * Makes a copy of this object that will be inserted as a new row in table when saved.
	 * It creates a new object filling in the simple attributes, but skipping any primary
	 * keys that are defined for the table.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @return     ReportEntity Clone of current object.
	 * @throws     PropelException
	 */
	public function copy($deepCopy = false)
	{
		// we use get_class(), because this might be a subclass
		$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	/**
	 * Returns a peer instance associated with this om.
	 *
	 * Since Peer classes are not to have any instance attributes, this method returns the
	 * same instance for all member of this class. The method could therefore
	 * be static, but this would prevent one from overriding the behavior.
	 *
	 * @return     ReportEntityPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new ReportEntityPeer();
		}
		return self::$peer;
	}

	/**
	 * Resets all collections of referencing foreign keys.
	 *
	 * This method is a user-space workaround for PHP's inability to garbage collect objects
	 * with circular references.  This is currently necessary when using Propel in certain
	 * daemon or large-volumne/high-memory operations.
	 *
	 * @param      boolean $deep Whether to also clear the references on all associated objects.
	 */
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
		} // if ($deep)

	}

} // BaseReportEntity
