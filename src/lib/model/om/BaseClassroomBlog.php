<?php

/**
 * Base class that represents a row from the 'classroom_blog' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseClassroomBlog extends BaseObject  implements Persistent {


  const PEER = 'ClassroomBlogPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        ClassroomBlogPeer
	 */
	protected static $peer;

	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;

	/**
	 * The value for the title field.
	 * @var        string
	 */
	protected $title;

	/**
	 * The value for the message field.
	 * @var        string
	 */
	protected $message;

	/**
	 * The value for the classroom_id field.
	 * @var        int
	 */
	protected $classroom_id;

	/**
	 * The value for the created_at field.
	 * @var        string
	 */
	protected $created_at;

	/**
	 * The value for the updated_at field.
	 * @var        string
	 */
	protected $updated_at;

	/**
	 * @var        Classroom
	 */
	protected $aClassroom;

	/**
	 * @var        array BlogAttachments[] Collection to store aggregation of BlogAttachments objects.
	 */
	protected $collBlogAttachmentss;

	/**
	 * @var        Criteria The criteria used to select the current contents of collBlogAttachmentss.
	 */
	private $lastBlogAttachmentsCriteria = null;

	/**
	 * @var        array ClassroomComment[] Collection to store aggregation of ClassroomComment objects.
	 */
	protected $collClassroomComments;

	/**
	 * @var        Criteria The criteria used to select the current contents of collClassroomComments.
	 */
	private $lastClassroomCommentCriteria = null;

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
	 * Initializes internal state of BaseClassroomBlog object.
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
	 * Get the [title] column value.
	 * 
	 * @return     string
	 */
	public function getTitle()
	{
		return $this->title;
	}

	/**
	 * Get the [message] column value.
	 * 
	 * @return     string
	 */
	public function getMessage()
	{
		return $this->message;
	}

	/**
	 * Get the [classroom_id] column value.
	 * 
	 * @return     int
	 */
	public function getClassroomId()
	{
		return $this->classroom_id;
	}

	/**
	 * Get the [optionally formatted] temporal [created_at] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getCreatedAt($format = 'Y-m-d H:i:s')
	{
		if ($this->created_at === null) {
			return null;
		}


		if ($this->created_at === '0000-00-00 00:00:00') {
			// while technically this is not a default value of NULL,
			// this seems to be closest in meaning.
			return null;
		} else {
			try {
				$dt = new DateTime($this->created_at);
			} catch (Exception $x) {
				throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->created_at, true), $x);
			}
		}

		if ($format === null) {
			// Because propel.useDateTimeClass is TRUE, we return a DateTime object.
			return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	/**
	 * Get the [optionally formatted] temporal [updated_at] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getUpdatedAt($format = 'Y-m-d H:i:s')
	{
		if ($this->updated_at === null) {
			return null;
		}


		if ($this->updated_at === '0000-00-00 00:00:00') {
			// while technically this is not a default value of NULL,
			// this seems to be closest in meaning.
			return null;
		} else {
			try {
				$dt = new DateTime($this->updated_at);
			} catch (Exception $x) {
				throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->updated_at, true), $x);
			}
		}

		if ($format === null) {
			// Because propel.useDateTimeClass is TRUE, we return a DateTime object.
			return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	/**
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     ClassroomBlog The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = ClassroomBlogPeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [title] column.
	 * 
	 * @param      string $v new value
	 * @return     ClassroomBlog The current object (for fluent API support)
	 */
	public function setTitle($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->title !== $v) {
			$this->title = $v;
			$this->modifiedColumns[] = ClassroomBlogPeer::TITLE;
		}

		return $this;
	} // setTitle()

	/**
	 * Set the value of [message] column.
	 * 
	 * @param      string $v new value
	 * @return     ClassroomBlog The current object (for fluent API support)
	 */
	public function setMessage($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->message !== $v) {
			$this->message = $v;
			$this->modifiedColumns[] = ClassroomBlogPeer::MESSAGE;
		}

		return $this;
	} // setMessage()

	/**
	 * Set the value of [classroom_id] column.
	 * 
	 * @param      int $v new value
	 * @return     ClassroomBlog The current object (for fluent API support)
	 */
	public function setClassroomId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->classroom_id !== $v) {
			$this->classroom_id = $v;
			$this->modifiedColumns[] = ClassroomBlogPeer::CLASSROOM_ID;
		}

		if ($this->aClassroom !== null && $this->aClassroom->getId() !== $v) {
			$this->aClassroom = null;
		}

		return $this;
	} // setClassroomId()

	/**
	 * Sets the value of [created_at] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     ClassroomBlog The current object (for fluent API support)
	 */
	public function setCreatedAt($v)
	{
		// we treat '' as NULL for temporal objects because DateTime('') == DateTime('now')
		// -- which is unexpected, to say the least.
		if ($v === null || $v === '') {
			$dt = null;
		} elseif ($v instanceof DateTime) {
			$dt = $v;
		} else {
			// some string/numeric value passed; we normalize that so that we can
			// validate it.
			try {
				if (is_numeric($v)) { // if it's a unix timestamp
					$dt = new DateTime('@'.$v, new DateTimeZone('UTC'));
					// We have to explicitly specify and then change the time zone because of a
					// DateTime bug: http://bugs.php.net/bug.php?id=43003
					$dt->setTimeZone(new DateTimeZone(date_default_timezone_get()));
				} else {
					$dt = new DateTime($v);
				}
			} catch (Exception $x) {
				throw new PropelException('Error parsing date/time value: ' . var_export($v, true), $x);
			}
		}

		if ( $this->created_at !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->created_at !== null && $tmpDt = new DateTime($this->created_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d H:i:s') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->created_at = ($dt ? $dt->format('Y-m-d H:i:s') : null);
				$this->modifiedColumns[] = ClassroomBlogPeer::CREATED_AT;
			}
		} // if either are not null

		return $this;
	} // setCreatedAt()

	/**
	 * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     ClassroomBlog The current object (for fluent API support)
	 */
	public function setUpdatedAt($v)
	{
		// we treat '' as NULL for temporal objects because DateTime('') == DateTime('now')
		// -- which is unexpected, to say the least.
		if ($v === null || $v === '') {
			$dt = null;
		} elseif ($v instanceof DateTime) {
			$dt = $v;
		} else {
			// some string/numeric value passed; we normalize that so that we can
			// validate it.
			try {
				if (is_numeric($v)) { // if it's a unix timestamp
					$dt = new DateTime('@'.$v, new DateTimeZone('UTC'));
					// We have to explicitly specify and then change the time zone because of a
					// DateTime bug: http://bugs.php.net/bug.php?id=43003
					$dt->setTimeZone(new DateTimeZone(date_default_timezone_get()));
				} else {
					$dt = new DateTime($v);
				}
			} catch (Exception $x) {
				throw new PropelException('Error parsing date/time value: ' . var_export($v, true), $x);
			}
		}

		if ( $this->updated_at !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->updated_at !== null && $tmpDt = new DateTime($this->updated_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d H:i:s') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->updated_at = ($dt ? $dt->format('Y-m-d H:i:s') : null);
				$this->modifiedColumns[] = ClassroomBlogPeer::UPDATED_AT;
			}
		} // if either are not null

		return $this;
	} // setUpdatedAt()

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
			$this->title = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->message = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->classroom_id = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
			$this->created_at = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->updated_at = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 6; // 6 = ClassroomBlogPeer::NUM_COLUMNS - ClassroomBlogPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating ClassroomBlog object", $e);
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

		if ($this->aClassroom !== null && $this->classroom_id !== $this->aClassroom->getId()) {
			$this->aClassroom = null;
		}
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
			$con = Propel::getConnection(ClassroomBlogPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = ClassroomBlogPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aClassroom = null;
			$this->collBlogAttachmentss = null;
			$this->lastBlogAttachmentsCriteria = null;

			$this->collClassroomComments = null;
			$this->lastClassroomCommentCriteria = null;

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
			$con = Propel::getConnection(ClassroomBlogPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			ClassroomBlogPeer::doDelete($this, $con);
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
    if ($this->isNew() && !$this->isColumnModified(ClassroomBlogPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(ClassroomBlogPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ClassroomBlogPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			ClassroomBlogPeer::addInstanceToPool($this);
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

			// We call the save method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

			if ($this->aClassroom !== null) {
				if ($this->aClassroom->isModified() || $this->aClassroom->isNew()) {
					$affectedRows += $this->aClassroom->save($con);
				}
				$this->setClassroom($this->aClassroom);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = ClassroomBlogPeer::ID;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = ClassroomBlogPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += ClassroomBlogPeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collBlogAttachmentss !== null) {
				foreach ($this->collBlogAttachmentss as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collClassroomComments !== null) {
				foreach ($this->collClassroomComments as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
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


			// We call the validate method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

			if ($this->aClassroom !== null) {
				if (!$this->aClassroom->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aClassroom->getValidationFailures());
				}
			}


			if (($retval = ClassroomBlogPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collBlogAttachmentss !== null) {
					foreach ($this->collBlogAttachmentss as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collClassroomComments !== null) {
					foreach ($this->collClassroomComments as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
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
		$pos = ClassroomBlogPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getTitle();
				break;
			case 2:
				return $this->getMessage();
				break;
			case 3:
				return $this->getClassroomId();
				break;
			case 4:
				return $this->getCreatedAt();
				break;
			case 5:
				return $this->getUpdatedAt();
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
		$keys = ClassroomBlogPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getTitle(),
			$keys[2] => $this->getMessage(),
			$keys[3] => $this->getClassroomId(),
			$keys[4] => $this->getCreatedAt(),
			$keys[5] => $this->getUpdatedAt(),
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
		$pos = ClassroomBlogPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setTitle($value);
				break;
			case 2:
				$this->setMessage($value);
				break;
			case 3:
				$this->setClassroomId($value);
				break;
			case 4:
				$this->setCreatedAt($value);
				break;
			case 5:
				$this->setUpdatedAt($value);
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
		$keys = ClassroomBlogPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setTitle($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setMessage($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setClassroomId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCreatedAt($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setUpdatedAt($arr[$keys[5]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(ClassroomBlogPeer::DATABASE_NAME);

		if ($this->isColumnModified(ClassroomBlogPeer::ID)) $criteria->add(ClassroomBlogPeer::ID, $this->id);
		if ($this->isColumnModified(ClassroomBlogPeer::TITLE)) $criteria->add(ClassroomBlogPeer::TITLE, $this->title);
		if ($this->isColumnModified(ClassroomBlogPeer::MESSAGE)) $criteria->add(ClassroomBlogPeer::MESSAGE, $this->message);
		if ($this->isColumnModified(ClassroomBlogPeer::CLASSROOM_ID)) $criteria->add(ClassroomBlogPeer::CLASSROOM_ID, $this->classroom_id);
		if ($this->isColumnModified(ClassroomBlogPeer::CREATED_AT)) $criteria->add(ClassroomBlogPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(ClassroomBlogPeer::UPDATED_AT)) $criteria->add(ClassroomBlogPeer::UPDATED_AT, $this->updated_at);

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
		$criteria = new Criteria(ClassroomBlogPeer::DATABASE_NAME);

		$criteria->add(ClassroomBlogPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of ClassroomBlog (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setTitle($this->title);

		$copyObj->setMessage($this->message);

		$copyObj->setClassroomId($this->classroom_id);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getBlogAttachmentss() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addBlogAttachments($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getClassroomComments() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addClassroomComment($relObj->copy($deepCopy));
				}
			}

		} // if ($deepCopy)


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
	 * @return     ClassroomBlog Clone of current object.
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
	 * @return     ClassroomBlogPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new ClassroomBlogPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Classroom object.
	 *
	 * @param      Classroom $v
	 * @return     ClassroomBlog The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setClassroom(Classroom $v = null)
	{
		if ($v === null) {
			$this->setClassroomId(NULL);
		} else {
			$this->setClassroomId($v->getId());
		}

		$this->aClassroom = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Classroom object, it will not be re-added.
		if ($v !== null) {
			$v->addClassroomBlog($this);
		}

		return $this;
	}


	/**
	 * Get the associated Classroom object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Classroom The associated Classroom object.
	 * @throws     PropelException
	 */
	public function getClassroom(PropelPDO $con = null)
	{
		if ($this->aClassroom === null && ($this->classroom_id !== null)) {
			$c = new Criteria(ClassroomPeer::DATABASE_NAME);
			$c->add(ClassroomPeer::ID, $this->classroom_id);
			$this->aClassroom = ClassroomPeer::doSelectOne($c, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aClassroom->addClassroomBlogs($this);
			 */
		}
		return $this->aClassroom;
	}

	/**
	 * Clears out the collBlogAttachmentss collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addBlogAttachmentss()
	 */
	public function clearBlogAttachmentss()
	{
		$this->collBlogAttachmentss = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collBlogAttachmentss collection (array).
	 *
	 * By default this just sets the collBlogAttachmentss collection to an empty array (like clearcollBlogAttachmentss());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initBlogAttachmentss()
	{
		$this->collBlogAttachmentss = array();
	}

	/**
	 * Gets an array of BlogAttachments objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this ClassroomBlog has previously been saved, it will retrieve
	 * related BlogAttachmentss from storage. If this ClassroomBlog is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array BlogAttachments[]
	 * @throws     PropelException
	 */
	public function getBlogAttachmentss($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ClassroomBlogPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collBlogAttachmentss === null) {
			if ($this->isNew()) {
			   $this->collBlogAttachmentss = array();
			} else {

				$criteria->add(BlogAttachmentsPeer::CLASSROOM_BLOG_ID, $this->id);

				BlogAttachmentsPeer::addSelectColumns($criteria);
				$this->collBlogAttachmentss = BlogAttachmentsPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(BlogAttachmentsPeer::CLASSROOM_BLOG_ID, $this->id);

				BlogAttachmentsPeer::addSelectColumns($criteria);
				if (!isset($this->lastBlogAttachmentsCriteria) || !$this->lastBlogAttachmentsCriteria->equals($criteria)) {
					$this->collBlogAttachmentss = BlogAttachmentsPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastBlogAttachmentsCriteria = $criteria;
		return $this->collBlogAttachmentss;
	}

	/**
	 * Returns the number of related BlogAttachments objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related BlogAttachments objects.
	 * @throws     PropelException
	 */
	public function countBlogAttachmentss(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ClassroomBlogPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collBlogAttachmentss === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(BlogAttachmentsPeer::CLASSROOM_BLOG_ID, $this->id);

				$count = BlogAttachmentsPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(BlogAttachmentsPeer::CLASSROOM_BLOG_ID, $this->id);

				if (!isset($this->lastBlogAttachmentsCriteria) || !$this->lastBlogAttachmentsCriteria->equals($criteria)) {
					$count = BlogAttachmentsPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collBlogAttachmentss);
				}
			} else {
				$count = count($this->collBlogAttachmentss);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a BlogAttachments object to this object
	 * through the BlogAttachments foreign key attribute.
	 *
	 * @param      BlogAttachments $l BlogAttachments
	 * @return     void
	 * @throws     PropelException
	 */
	public function addBlogAttachments(BlogAttachments $l)
	{
		if ($this->collBlogAttachmentss === null) {
			$this->initBlogAttachmentss();
		}
		if (!in_array($l, $this->collBlogAttachmentss, true)) { // only add it if the **same** object is not already associated
			array_push($this->collBlogAttachmentss, $l);
			$l->setClassroomBlog($this);
		}
	}

	/**
	 * Clears out the collClassroomComments collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addClassroomComments()
	 */
	public function clearClassroomComments()
	{
		$this->collClassroomComments = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collClassroomComments collection (array).
	 *
	 * By default this just sets the collClassroomComments collection to an empty array (like clearcollClassroomComments());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initClassroomComments()
	{
		$this->collClassroomComments = array();
	}

	/**
	 * Gets an array of ClassroomComment objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this ClassroomBlog has previously been saved, it will retrieve
	 * related ClassroomComments from storage. If this ClassroomBlog is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array ClassroomComment[]
	 * @throws     PropelException
	 */
	public function getClassroomComments($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ClassroomBlogPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collClassroomComments === null) {
			if ($this->isNew()) {
			   $this->collClassroomComments = array();
			} else {

				$criteria->add(ClassroomCommentPeer::CLASSROOM_BLOG_ID, $this->id);

				ClassroomCommentPeer::addSelectColumns($criteria);
				$this->collClassroomComments = ClassroomCommentPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ClassroomCommentPeer::CLASSROOM_BLOG_ID, $this->id);

				ClassroomCommentPeer::addSelectColumns($criteria);
				if (!isset($this->lastClassroomCommentCriteria) || !$this->lastClassroomCommentCriteria->equals($criteria)) {
					$this->collClassroomComments = ClassroomCommentPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastClassroomCommentCriteria = $criteria;
		return $this->collClassroomComments;
	}

	/**
	 * Returns the number of related ClassroomComment objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related ClassroomComment objects.
	 * @throws     PropelException
	 */
	public function countClassroomComments(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ClassroomBlogPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collClassroomComments === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(ClassroomCommentPeer::CLASSROOM_BLOG_ID, $this->id);

				$count = ClassroomCommentPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(ClassroomCommentPeer::CLASSROOM_BLOG_ID, $this->id);

				if (!isset($this->lastClassroomCommentCriteria) || !$this->lastClassroomCommentCriteria->equals($criteria)) {
					$count = ClassroomCommentPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collClassroomComments);
				}
			} else {
				$count = count($this->collClassroomComments);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a ClassroomComment object to this object
	 * through the ClassroomComment foreign key attribute.
	 *
	 * @param      ClassroomComment $l ClassroomComment
	 * @return     void
	 * @throws     PropelException
	 */
	public function addClassroomComment(ClassroomComment $l)
	{
		if ($this->collClassroomComments === null) {
			$this->initClassroomComments();
		}
		if (!in_array($l, $this->collClassroomComments, true)) { // only add it if the **same** object is not already associated
			array_push($this->collClassroomComments, $l);
			$l->setClassroomBlog($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this ClassroomBlog is new, it will return
	 * an empty collection; or if this ClassroomBlog has previously
	 * been saved, it will retrieve related ClassroomComments from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in ClassroomBlog.
	 */
	public function getClassroomCommentsJoinUser($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ClassroomBlogPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collClassroomComments === null) {
			if ($this->isNew()) {
				$this->collClassroomComments = array();
			} else {

				$criteria->add(ClassroomCommentPeer::CLASSROOM_BLOG_ID, $this->id);

				$this->collClassroomComments = ClassroomCommentPeer::doSelectJoinUser($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ClassroomCommentPeer::CLASSROOM_BLOG_ID, $this->id);

			if (!isset($this->lastClassroomCommentCriteria) || !$this->lastClassroomCommentCriteria->equals($criteria)) {
				$this->collClassroomComments = ClassroomCommentPeer::doSelectJoinUser($criteria, $con, $join_behavior);
			}
		}
		$this->lastClassroomCommentCriteria = $criteria;

		return $this->collClassroomComments;
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
			if ($this->collBlogAttachmentss) {
				foreach ((array) $this->collBlogAttachmentss as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collClassroomComments) {
				foreach ((array) $this->collClassroomComments as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		$this->collBlogAttachmentss = null;
		$this->collClassroomComments = null;
			$this->aClassroom = null;
	}

} // BaseClassroomBlog
