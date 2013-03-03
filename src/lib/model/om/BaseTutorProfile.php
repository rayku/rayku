<?php

/**
 * Base class that represents a row from the 'tutor_profile' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseTutorProfile extends BaseObject  implements Persistent {


  const PEER = 'TutorProfilePeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        TutorProfilePeer
	 */
	protected static $peer;

	/**
	 * The value for the tutor_profile_id field.
	 * @var        int
	 */
	protected $tutor_profile_id;

	/**
	 * The value for the user_id field.
	 * @var        int
	 */
	protected $user_id;

	/**
	 * The value for the category field.
	 * @var        int
	 */
	protected $category;

	/**
	 * The value for the course_id field.
	 * @var        string
	 */
	protected $course_id;

	/**
	 * The value for the school field.
	 * @var        string
	 */
	protected $school;

	/**
	 * The value for the year field.
	 * @var        string
	 */
	protected $year;

	/**
	 * The value for the tutor_role field.
	 * @var        string
	 */
	protected $tutor_role;

	/**
	 * The value for the study field.
	 * @var        string
	 */
	protected $study;

	/**
	 * The value for the course_code field.
	 * @var        string
	 */
	protected $course_code;

	/**
	 * The value for the online_status field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $online_status;

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
	 * Initializes internal state of BaseTutorProfile object.
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
		$this->online_status = 0;
	}

	/**
	 * Get the [tutor_profile_id] column value.
	 * 
	 * @return     int
	 */
	public function getTutorProfileId()
	{
		return $this->tutor_profile_id;
	}

	/**
	 * Get the [user_id] column value.
	 * 
	 * @return     int
	 */
	public function getUserId()
	{
		return $this->user_id;
	}

	/**
	 * Get the [category] column value.
	 * 
	 * @return     int
	 */
	public function getCategory()
	{
		return $this->category;
	}

	/**
	 * Get the [course_id] column value.
	 * 
	 * @return     string
	 */
	public function getCourseId()
	{
		return $this->course_id;
	}

	/**
	 * Get the [school] column value.
	 * 
	 * @return     string
	 */
	public function getSchool()
	{
		return $this->school;
	}

	/**
	 * Get the [year] column value.
	 * 
	 * @return     string
	 */
	public function getYear()
	{
		return $this->year;
	}

	/**
	 * Get the [tutor_role] column value.
	 * 
	 * @return     string
	 */
	public function getTutorRole()
	{
		return $this->tutor_role;
	}

	/**
	 * Get the [study] column value.
	 * 
	 * @return     string
	 */
	public function getStudy()
	{
		return $this->study;
	}

	/**
	 * Get the [course_code] column value.
	 * 
	 * @return     string
	 */
	public function getCourseCode()
	{
		return $this->course_code;
	}

	/**
	 * Get the [online_status] column value.
	 * 
	 * @return     int
	 */
	public function getOnlineStatus()
	{
		return $this->online_status;
	}

	/**
	 * Set the value of [tutor_profile_id] column.
	 * 
	 * @param      int $v new value
	 * @return     TutorProfile The current object (for fluent API support)
	 */
	public function setTutorProfileId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->tutor_profile_id !== $v) {
			$this->tutor_profile_id = $v;
			$this->modifiedColumns[] = TutorProfilePeer::TUTOR_PROFILE_ID;
		}

		return $this;
	} // setTutorProfileId()

	/**
	 * Set the value of [user_id] column.
	 * 
	 * @param      int $v new value
	 * @return     TutorProfile The current object (for fluent API support)
	 */
	public function setUserId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->user_id !== $v) {
			$this->user_id = $v;
			$this->modifiedColumns[] = TutorProfilePeer::USER_ID;
		}

		return $this;
	} // setUserId()

	/**
	 * Set the value of [category] column.
	 * 
	 * @param      int $v new value
	 * @return     TutorProfile The current object (for fluent API support)
	 */
	public function setCategory($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->category !== $v) {
			$this->category = $v;
			$this->modifiedColumns[] = TutorProfilePeer::CATEGORY;
		}

		return $this;
	} // setCategory()

	/**
	 * Set the value of [course_id] column.
	 * 
	 * @param      string $v new value
	 * @return     TutorProfile The current object (for fluent API support)
	 */
	public function setCourseId($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->course_id !== $v) {
			$this->course_id = $v;
			$this->modifiedColumns[] = TutorProfilePeer::COURSE_ID;
		}

		return $this;
	} // setCourseId()

	/**
	 * Set the value of [school] column.
	 * 
	 * @param      string $v new value
	 * @return     TutorProfile The current object (for fluent API support)
	 */
	public function setSchool($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->school !== $v) {
			$this->school = $v;
			$this->modifiedColumns[] = TutorProfilePeer::SCHOOL;
		}

		return $this;
	} // setSchool()

	/**
	 * Set the value of [year] column.
	 * 
	 * @param      string $v new value
	 * @return     TutorProfile The current object (for fluent API support)
	 */
	public function setYear($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->year !== $v) {
			$this->year = $v;
			$this->modifiedColumns[] = TutorProfilePeer::YEAR;
		}

		return $this;
	} // setYear()

	/**
	 * Set the value of [tutor_role] column.
	 * 
	 * @param      string $v new value
	 * @return     TutorProfile The current object (for fluent API support)
	 */
	public function setTutorRole($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->tutor_role !== $v) {
			$this->tutor_role = $v;
			$this->modifiedColumns[] = TutorProfilePeer::TUTOR_ROLE;
		}

		return $this;
	} // setTutorRole()

	/**
	 * Set the value of [study] column.
	 * 
	 * @param      string $v new value
	 * @return     TutorProfile The current object (for fluent API support)
	 */
	public function setStudy($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->study !== $v) {
			$this->study = $v;
			$this->modifiedColumns[] = TutorProfilePeer::STUDY;
		}

		return $this;
	} // setStudy()

	/**
	 * Set the value of [course_code] column.
	 * 
	 * @param      string $v new value
	 * @return     TutorProfile The current object (for fluent API support)
	 */
	public function setCourseCode($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->course_code !== $v) {
			$this->course_code = $v;
			$this->modifiedColumns[] = TutorProfilePeer::COURSE_CODE;
		}

		return $this;
	} // setCourseCode()

	/**
	 * Set the value of [online_status] column.
	 * 
	 * @param      int $v new value
	 * @return     TutorProfile The current object (for fluent API support)
	 */
	public function setOnlineStatus($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->online_status !== $v || $v === 0) {
			$this->online_status = $v;
			$this->modifiedColumns[] = TutorProfilePeer::ONLINE_STATUS;
		}

		return $this;
	} // setOnlineStatus()

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
			if (array_diff($this->modifiedColumns, array(TutorProfilePeer::ONLINE_STATUS))) {
				return false;
			}

			if ($this->online_status !== 0) {
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

			$this->tutor_profile_id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->user_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->category = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->course_id = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->school = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->year = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->tutor_role = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->study = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->course_code = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->online_status = ($row[$startcol + 9] !== null) ? (int) $row[$startcol + 9] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 10; // 10 = TutorProfilePeer::NUM_COLUMNS - TutorProfilePeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating TutorProfile object", $e);
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
			$con = Propel::getConnection(TutorProfilePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = TutorProfilePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
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
			$con = Propel::getConnection(TutorProfilePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			TutorProfilePeer::doDelete($this, $con);
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
			$con = Propel::getConnection(TutorProfilePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			TutorProfilePeer::addInstanceToPool($this);
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
				$this->modifiedColumns[] = TutorProfilePeer::TUTOR_PROFILE_ID;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = TutorProfilePeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setTutorProfileId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += TutorProfilePeer::doUpdate($this, $con);
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


			if (($retval = TutorProfilePeer::doValidate($this, $columns)) !== true) {
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
		$pos = TutorProfilePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getTutorProfileId();
				break;
			case 1:
				return $this->getUserId();
				break;
			case 2:
				return $this->getCategory();
				break;
			case 3:
				return $this->getCourseId();
				break;
			case 4:
				return $this->getSchool();
				break;
			case 5:
				return $this->getYear();
				break;
			case 6:
				return $this->getTutorRole();
				break;
			case 7:
				return $this->getStudy();
				break;
			case 8:
				return $this->getCourseCode();
				break;
			case 9:
				return $this->getOnlineStatus();
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
		$keys = TutorProfilePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getTutorProfileId(),
			$keys[1] => $this->getUserId(),
			$keys[2] => $this->getCategory(),
			$keys[3] => $this->getCourseId(),
			$keys[4] => $this->getSchool(),
			$keys[5] => $this->getYear(),
			$keys[6] => $this->getTutorRole(),
			$keys[7] => $this->getStudy(),
			$keys[8] => $this->getCourseCode(),
			$keys[9] => $this->getOnlineStatus(),
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
		$pos = TutorProfilePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setTutorProfileId($value);
				break;
			case 1:
				$this->setUserId($value);
				break;
			case 2:
				$this->setCategory($value);
				break;
			case 3:
				$this->setCourseId($value);
				break;
			case 4:
				$this->setSchool($value);
				break;
			case 5:
				$this->setYear($value);
				break;
			case 6:
				$this->setTutorRole($value);
				break;
			case 7:
				$this->setStudy($value);
				break;
			case 8:
				$this->setCourseCode($value);
				break;
			case 9:
				$this->setOnlineStatus($value);
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
		$keys = TutorProfilePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setTutorProfileId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setUserId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCategory($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCourseId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setSchool($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setYear($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setTutorRole($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setStudy($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCourseCode($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setOnlineStatus($arr[$keys[9]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(TutorProfilePeer::DATABASE_NAME);

		if ($this->isColumnModified(TutorProfilePeer::TUTOR_PROFILE_ID)) $criteria->add(TutorProfilePeer::TUTOR_PROFILE_ID, $this->tutor_profile_id);
		if ($this->isColumnModified(TutorProfilePeer::USER_ID)) $criteria->add(TutorProfilePeer::USER_ID, $this->user_id);
		if ($this->isColumnModified(TutorProfilePeer::CATEGORY)) $criteria->add(TutorProfilePeer::CATEGORY, $this->category);
		if ($this->isColumnModified(TutorProfilePeer::COURSE_ID)) $criteria->add(TutorProfilePeer::COURSE_ID, $this->course_id);
		if ($this->isColumnModified(TutorProfilePeer::SCHOOL)) $criteria->add(TutorProfilePeer::SCHOOL, $this->school);
		if ($this->isColumnModified(TutorProfilePeer::YEAR)) $criteria->add(TutorProfilePeer::YEAR, $this->year);
		if ($this->isColumnModified(TutorProfilePeer::TUTOR_ROLE)) $criteria->add(TutorProfilePeer::TUTOR_ROLE, $this->tutor_role);
		if ($this->isColumnModified(TutorProfilePeer::STUDY)) $criteria->add(TutorProfilePeer::STUDY, $this->study);
		if ($this->isColumnModified(TutorProfilePeer::COURSE_CODE)) $criteria->add(TutorProfilePeer::COURSE_CODE, $this->course_code);
		if ($this->isColumnModified(TutorProfilePeer::ONLINE_STATUS)) $criteria->add(TutorProfilePeer::ONLINE_STATUS, $this->online_status);

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
		$criteria = new Criteria(TutorProfilePeer::DATABASE_NAME);

		$criteria->add(TutorProfilePeer::TUTOR_PROFILE_ID, $this->tutor_profile_id);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getTutorProfileId();
	}

	/**
	 * Generic method to set the primary key (tutor_profile_id column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setTutorProfileId($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of TutorProfile (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setUserId($this->user_id);

		$copyObj->setCategory($this->category);

		$copyObj->setCourseId($this->course_id);

		$copyObj->setSchool($this->school);

		$copyObj->setYear($this->year);

		$copyObj->setTutorRole($this->tutor_role);

		$copyObj->setStudy($this->study);

		$copyObj->setCourseCode($this->course_code);

		$copyObj->setOnlineStatus($this->online_status);


		$copyObj->setNew(true);

		$copyObj->setTutorProfileId(NULL); // this is a auto-increment column, so set to default value

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
	 * @return     TutorProfile Clone of current object.
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
	 * @return     TutorProfilePeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new TutorProfilePeer();
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

} // BaseTutorProfile
