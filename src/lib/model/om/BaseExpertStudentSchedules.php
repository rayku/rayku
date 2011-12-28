<?php

/**
 * Base class that represents a row from the 'expert_student_schedules' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseExpertStudentSchedules extends BaseObject  implements Persistent {


  const PEER = 'ExpertStudentSchedulesPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        ExpertStudentSchedulesPeer
	 */
	protected static $peer;

	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;

	/**
	 * The value for the exp_id field.
	 * @var        int
	 */
	protected $exp_id;

	/**
	 * The value for the student_id field.
	 * @var        int
	 */
	protected $student_id;

	/**
	 * The value for the date field.
	 * @var        int
	 */
	protected $date;

	/**
	 * The value for the time field.
	 * @var        int
	 */
	protected $time;

	/**
	 * The value for the message field.
	 * @var        string
	 */
	protected $message;

	/**
	 * The value for the expert_lesson_id field.
	 * @var        int
	 */
	protected $expert_lesson_id;

	/**
	 * The value for the accept_reject field.
	 * @var        int
	 */
	protected $accept_reject;

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
	 * Initializes internal state of BaseExpertStudentSchedules object.
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
	 * Get the [exp_id] column value.
	 * 
	 * @return     int
	 */
	public function getExpId()
	{
		return $this->exp_id;
	}

	/**
	 * Get the [student_id] column value.
	 * 
	 * @return     int
	 */
	public function getStudentId()
	{
		return $this->student_id;
	}

	/**
	 * Get the [date] column value.
	 * 
	 * @return     int
	 */
	public function getDate()
	{
		return $this->date;
	}

	/**
	 * Get the [time] column value.
	 * 
	 * @return     int
	 */
	public function getTime()
	{
		return $this->time;
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
	 * Get the [expert_lesson_id] column value.
	 * 
	 * @return     int
	 */
	public function getExpertLessonId()
	{
		return $this->expert_lesson_id;
	}

	/**
	 * Get the [accept_reject] column value.
	 * 
	 * @return     int
	 */
	public function getAcceptReject()
	{
		return $this->accept_reject;
	}

	/**
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     ExpertStudentSchedules The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = ExpertStudentSchedulesPeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [exp_id] column.
	 * 
	 * @param      int $v new value
	 * @return     ExpertStudentSchedules The current object (for fluent API support)
	 */
	public function setExpId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->exp_id !== $v) {
			$this->exp_id = $v;
			$this->modifiedColumns[] = ExpertStudentSchedulesPeer::EXP_ID;
		}

		return $this;
	} // setExpId()

	/**
	 * Set the value of [student_id] column.
	 * 
	 * @param      int $v new value
	 * @return     ExpertStudentSchedules The current object (for fluent API support)
	 */
	public function setStudentId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->student_id !== $v) {
			$this->student_id = $v;
			$this->modifiedColumns[] = ExpertStudentSchedulesPeer::STUDENT_ID;
		}

		return $this;
	} // setStudentId()

	/**
	 * Set the value of [date] column.
	 * 
	 * @param      int $v new value
	 * @return     ExpertStudentSchedules The current object (for fluent API support)
	 */
	public function setDate($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->date !== $v) {
			$this->date = $v;
			$this->modifiedColumns[] = ExpertStudentSchedulesPeer::DATE;
		}

		return $this;
	} // setDate()

	/**
	 * Set the value of [time] column.
	 * 
	 * @param      int $v new value
	 * @return     ExpertStudentSchedules The current object (for fluent API support)
	 */
	public function setTime($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->time !== $v) {
			$this->time = $v;
			$this->modifiedColumns[] = ExpertStudentSchedulesPeer::TIME;
		}

		return $this;
	} // setTime()

	/**
	 * Set the value of [message] column.
	 * 
	 * @param      string $v new value
	 * @return     ExpertStudentSchedules The current object (for fluent API support)
	 */
	public function setMessage($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->message !== $v) {
			$this->message = $v;
			$this->modifiedColumns[] = ExpertStudentSchedulesPeer::MESSAGE;
		}

		return $this;
	} // setMessage()

	/**
	 * Set the value of [expert_lesson_id] column.
	 * 
	 * @param      int $v new value
	 * @return     ExpertStudentSchedules The current object (for fluent API support)
	 */
	public function setExpertLessonId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->expert_lesson_id !== $v) {
			$this->expert_lesson_id = $v;
			$this->modifiedColumns[] = ExpertStudentSchedulesPeer::EXPERT_LESSON_ID;
		}

		return $this;
	} // setExpertLessonId()

	/**
	 * Set the value of [accept_reject] column.
	 * 
	 * @param      int $v new value
	 * @return     ExpertStudentSchedules The current object (for fluent API support)
	 */
	public function setAcceptReject($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->accept_reject !== $v) {
			$this->accept_reject = $v;
			$this->modifiedColumns[] = ExpertStudentSchedulesPeer::ACCEPT_REJECT;
		}

		return $this;
	} // setAcceptReject()

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
			$this->exp_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->student_id = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->date = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
			$this->time = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
			$this->message = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->expert_lesson_id = ($row[$startcol + 6] !== null) ? (int) $row[$startcol + 6] : null;
			$this->accept_reject = ($row[$startcol + 7] !== null) ? (int) $row[$startcol + 7] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 8; // 8 = ExpertStudentSchedulesPeer::NUM_COLUMNS - ExpertStudentSchedulesPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating ExpertStudentSchedules object", $e);
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
			$con = Propel::getConnection(ExpertStudentSchedulesPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = ExpertStudentSchedulesPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
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
			$con = Propel::getConnection(ExpertStudentSchedulesPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			ExpertStudentSchedulesPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(ExpertStudentSchedulesPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			ExpertStudentSchedulesPeer::addInstanceToPool($this);
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
				$this->modifiedColumns[] = ExpertStudentSchedulesPeer::ID;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = ExpertStudentSchedulesPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += ExpertStudentSchedulesPeer::doUpdate($this, $con);
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


			if (($retval = ExpertStudentSchedulesPeer::doValidate($this, $columns)) !== true) {
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
		$pos = ExpertStudentSchedulesPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getExpId();
				break;
			case 2:
				return $this->getStudentId();
				break;
			case 3:
				return $this->getDate();
				break;
			case 4:
				return $this->getTime();
				break;
			case 5:
				return $this->getMessage();
				break;
			case 6:
				return $this->getExpertLessonId();
				break;
			case 7:
				return $this->getAcceptReject();
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
		$keys = ExpertStudentSchedulesPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getExpId(),
			$keys[2] => $this->getStudentId(),
			$keys[3] => $this->getDate(),
			$keys[4] => $this->getTime(),
			$keys[5] => $this->getMessage(),
			$keys[6] => $this->getExpertLessonId(),
			$keys[7] => $this->getAcceptReject(),
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
		$pos = ExpertStudentSchedulesPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setExpId($value);
				break;
			case 2:
				$this->setStudentId($value);
				break;
			case 3:
				$this->setDate($value);
				break;
			case 4:
				$this->setTime($value);
				break;
			case 5:
				$this->setMessage($value);
				break;
			case 6:
				$this->setExpertLessonId($value);
				break;
			case 7:
				$this->setAcceptReject($value);
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
		$keys = ExpertStudentSchedulesPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setExpId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setStudentId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setDate($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setTime($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setMessage($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setExpertLessonId($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setAcceptReject($arr[$keys[7]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(ExpertStudentSchedulesPeer::DATABASE_NAME);

		if ($this->isColumnModified(ExpertStudentSchedulesPeer::ID)) $criteria->add(ExpertStudentSchedulesPeer::ID, $this->id);
		if ($this->isColumnModified(ExpertStudentSchedulesPeer::EXP_ID)) $criteria->add(ExpertStudentSchedulesPeer::EXP_ID, $this->exp_id);
		if ($this->isColumnModified(ExpertStudentSchedulesPeer::STUDENT_ID)) $criteria->add(ExpertStudentSchedulesPeer::STUDENT_ID, $this->student_id);
		if ($this->isColumnModified(ExpertStudentSchedulesPeer::DATE)) $criteria->add(ExpertStudentSchedulesPeer::DATE, $this->date);
		if ($this->isColumnModified(ExpertStudentSchedulesPeer::TIME)) $criteria->add(ExpertStudentSchedulesPeer::TIME, $this->time);
		if ($this->isColumnModified(ExpertStudentSchedulesPeer::MESSAGE)) $criteria->add(ExpertStudentSchedulesPeer::MESSAGE, $this->message);
		if ($this->isColumnModified(ExpertStudentSchedulesPeer::EXPERT_LESSON_ID)) $criteria->add(ExpertStudentSchedulesPeer::EXPERT_LESSON_ID, $this->expert_lesson_id);
		if ($this->isColumnModified(ExpertStudentSchedulesPeer::ACCEPT_REJECT)) $criteria->add(ExpertStudentSchedulesPeer::ACCEPT_REJECT, $this->accept_reject);

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
		$criteria = new Criteria(ExpertStudentSchedulesPeer::DATABASE_NAME);

		$criteria->add(ExpertStudentSchedulesPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of ExpertStudentSchedules (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setExpId($this->exp_id);

		$copyObj->setStudentId($this->student_id);

		$copyObj->setDate($this->date);

		$copyObj->setTime($this->time);

		$copyObj->setMessage($this->message);

		$copyObj->setExpertLessonId($this->expert_lesson_id);

		$copyObj->setAcceptReject($this->accept_reject);


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
	 * @return     ExpertStudentSchedules Clone of current object.
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
	 * @return     ExpertStudentSchedulesPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new ExpertStudentSchedulesPeer();
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

} // BaseExpertStudentSchedules
