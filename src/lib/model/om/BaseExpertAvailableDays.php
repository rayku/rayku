<?php

/**
 * Base class that represents a row from the 'expert_available_days' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseExpertAvailableDays extends BaseObject  implements Persistent {


  const PEER = 'ExpertAvailableDaysPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        ExpertAvailableDaysPeer
	 */
	protected static $peer;

	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;

	/**
	 * The value for the expert_id field.
	 * @var        int
	 */
	protected $expert_id;

	/**
	 * The value for the monday field.
	 * @var        int
	 */
	protected $monday;

	/**
	 * The value for the tuesday field.
	 * @var        int
	 */
	protected $tuesday;

	/**
	 * The value for the wednesday field.
	 * @var        int
	 */
	protected $wednesday;

	/**
	 * The value for the thursday field.
	 * @var        int
	 */
	protected $thursday;

	/**
	 * The value for the friday field.
	 * @var        int
	 */
	protected $friday;

	/**
	 * The value for the saturday field.
	 * @var        int
	 */
	protected $saturday;

	/**
	 * The value for the sunday field.
	 * @var        int
	 */
	protected $sunday;

	/**
	 * The value for the timings field.
	 * @var        string
	 */
	protected $timings;

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
	 * Initializes internal state of BaseExpertAvailableDays object.
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
	 * Get the [expert_id] column value.
	 * 
	 * @return     int
	 */
	public function getExpertId()
	{
		return $this->expert_id;
	}

	/**
	 * Get the [monday] column value.
	 * 
	 * @return     int
	 */
	public function getMonday()
	{
		return $this->monday;
	}

	/**
	 * Get the [tuesday] column value.
	 * 
	 * @return     int
	 */
	public function getTuesday()
	{
		return $this->tuesday;
	}

	/**
	 * Get the [wednesday] column value.
	 * 
	 * @return     int
	 */
	public function getWednesday()
	{
		return $this->wednesday;
	}

	/**
	 * Get the [thursday] column value.
	 * 
	 * @return     int
	 */
	public function getThursday()
	{
		return $this->thursday;
	}

	/**
	 * Get the [friday] column value.
	 * 
	 * @return     int
	 */
	public function getFriday()
	{
		return $this->friday;
	}

	/**
	 * Get the [saturday] column value.
	 * 
	 * @return     int
	 */
	public function getSaturday()
	{
		return $this->saturday;
	}

	/**
	 * Get the [sunday] column value.
	 * 
	 * @return     int
	 */
	public function getSunday()
	{
		return $this->sunday;
	}

	/**
	 * Get the [timings] column value.
	 * 
	 * @return     string
	 */
	public function getTimings()
	{
		return $this->timings;
	}

	/**
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     ExpertAvailableDays The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = ExpertAvailableDaysPeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [expert_id] column.
	 * 
	 * @param      int $v new value
	 * @return     ExpertAvailableDays The current object (for fluent API support)
	 */
	public function setExpertId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->expert_id !== $v) {
			$this->expert_id = $v;
			$this->modifiedColumns[] = ExpertAvailableDaysPeer::EXPERT_ID;
		}

		return $this;
	} // setExpertId()

	/**
	 * Set the value of [monday] column.
	 * 
	 * @param      int $v new value
	 * @return     ExpertAvailableDays The current object (for fluent API support)
	 */
	public function setMonday($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->monday !== $v) {
			$this->monday = $v;
			$this->modifiedColumns[] = ExpertAvailableDaysPeer::MONDAY;
		}

		return $this;
	} // setMonday()

	/**
	 * Set the value of [tuesday] column.
	 * 
	 * @param      int $v new value
	 * @return     ExpertAvailableDays The current object (for fluent API support)
	 */
	public function setTuesday($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->tuesday !== $v) {
			$this->tuesday = $v;
			$this->modifiedColumns[] = ExpertAvailableDaysPeer::TUESDAY;
		}

		return $this;
	} // setTuesday()

	/**
	 * Set the value of [wednesday] column.
	 * 
	 * @param      int $v new value
	 * @return     ExpertAvailableDays The current object (for fluent API support)
	 */
	public function setWednesday($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->wednesday !== $v) {
			$this->wednesday = $v;
			$this->modifiedColumns[] = ExpertAvailableDaysPeer::WEDNESDAY;
		}

		return $this;
	} // setWednesday()

	/**
	 * Set the value of [thursday] column.
	 * 
	 * @param      int $v new value
	 * @return     ExpertAvailableDays The current object (for fluent API support)
	 */
	public function setThursday($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->thursday !== $v) {
			$this->thursday = $v;
			$this->modifiedColumns[] = ExpertAvailableDaysPeer::THURSDAY;
		}

		return $this;
	} // setThursday()

	/**
	 * Set the value of [friday] column.
	 * 
	 * @param      int $v new value
	 * @return     ExpertAvailableDays The current object (for fluent API support)
	 */
	public function setFriday($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->friday !== $v) {
			$this->friday = $v;
			$this->modifiedColumns[] = ExpertAvailableDaysPeer::FRIDAY;
		}

		return $this;
	} // setFriday()

	/**
	 * Set the value of [saturday] column.
	 * 
	 * @param      int $v new value
	 * @return     ExpertAvailableDays The current object (for fluent API support)
	 */
	public function setSaturday($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->saturday !== $v) {
			$this->saturday = $v;
			$this->modifiedColumns[] = ExpertAvailableDaysPeer::SATURDAY;
		}

		return $this;
	} // setSaturday()

	/**
	 * Set the value of [sunday] column.
	 * 
	 * @param      int $v new value
	 * @return     ExpertAvailableDays The current object (for fluent API support)
	 */
	public function setSunday($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->sunday !== $v) {
			$this->sunday = $v;
			$this->modifiedColumns[] = ExpertAvailableDaysPeer::SUNDAY;
		}

		return $this;
	} // setSunday()

	/**
	 * Set the value of [timings] column.
	 * 
	 * @param      string $v new value
	 * @return     ExpertAvailableDays The current object (for fluent API support)
	 */
	public function setTimings($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->timings !== $v) {
			$this->timings = $v;
			$this->modifiedColumns[] = ExpertAvailableDaysPeer::TIMINGS;
		}

		return $this;
	} // setTimings()

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
			$this->expert_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->monday = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->tuesday = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
			$this->wednesday = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
			$this->thursday = ($row[$startcol + 5] !== null) ? (int) $row[$startcol + 5] : null;
			$this->friday = ($row[$startcol + 6] !== null) ? (int) $row[$startcol + 6] : null;
			$this->saturday = ($row[$startcol + 7] !== null) ? (int) $row[$startcol + 7] : null;
			$this->sunday = ($row[$startcol + 8] !== null) ? (int) $row[$startcol + 8] : null;
			$this->timings = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 10; // 10 = ExpertAvailableDaysPeer::NUM_COLUMNS - ExpertAvailableDaysPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating ExpertAvailableDays object", $e);
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
			$con = Propel::getConnection(ExpertAvailableDaysPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = ExpertAvailableDaysPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
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
			$con = Propel::getConnection(ExpertAvailableDaysPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			ExpertAvailableDaysPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(ExpertAvailableDaysPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			ExpertAvailableDaysPeer::addInstanceToPool($this);
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
				$this->modifiedColumns[] = ExpertAvailableDaysPeer::ID;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = ExpertAvailableDaysPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += ExpertAvailableDaysPeer::doUpdate($this, $con);
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


			if (($retval = ExpertAvailableDaysPeer::doValidate($this, $columns)) !== true) {
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
		$pos = ExpertAvailableDaysPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getExpertId();
				break;
			case 2:
				return $this->getMonday();
				break;
			case 3:
				return $this->getTuesday();
				break;
			case 4:
				return $this->getWednesday();
				break;
			case 5:
				return $this->getThursday();
				break;
			case 6:
				return $this->getFriday();
				break;
			case 7:
				return $this->getSaturday();
				break;
			case 8:
				return $this->getSunday();
				break;
			case 9:
				return $this->getTimings();
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
		$keys = ExpertAvailableDaysPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getExpertId(),
			$keys[2] => $this->getMonday(),
			$keys[3] => $this->getTuesday(),
			$keys[4] => $this->getWednesday(),
			$keys[5] => $this->getThursday(),
			$keys[6] => $this->getFriday(),
			$keys[7] => $this->getSaturday(),
			$keys[8] => $this->getSunday(),
			$keys[9] => $this->getTimings(),
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
		$pos = ExpertAvailableDaysPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setExpertId($value);
				break;
			case 2:
				$this->setMonday($value);
				break;
			case 3:
				$this->setTuesday($value);
				break;
			case 4:
				$this->setWednesday($value);
				break;
			case 5:
				$this->setThursday($value);
				break;
			case 6:
				$this->setFriday($value);
				break;
			case 7:
				$this->setSaturday($value);
				break;
			case 8:
				$this->setSunday($value);
				break;
			case 9:
				$this->setTimings($value);
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
		$keys = ExpertAvailableDaysPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setExpertId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setMonday($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setTuesday($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setWednesday($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setThursday($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setFriday($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setSaturday($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setSunday($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setTimings($arr[$keys[9]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(ExpertAvailableDaysPeer::DATABASE_NAME);

		if ($this->isColumnModified(ExpertAvailableDaysPeer::ID)) $criteria->add(ExpertAvailableDaysPeer::ID, $this->id);
		if ($this->isColumnModified(ExpertAvailableDaysPeer::EXPERT_ID)) $criteria->add(ExpertAvailableDaysPeer::EXPERT_ID, $this->expert_id);
		if ($this->isColumnModified(ExpertAvailableDaysPeer::MONDAY)) $criteria->add(ExpertAvailableDaysPeer::MONDAY, $this->monday);
		if ($this->isColumnModified(ExpertAvailableDaysPeer::TUESDAY)) $criteria->add(ExpertAvailableDaysPeer::TUESDAY, $this->tuesday);
		if ($this->isColumnModified(ExpertAvailableDaysPeer::WEDNESDAY)) $criteria->add(ExpertAvailableDaysPeer::WEDNESDAY, $this->wednesday);
		if ($this->isColumnModified(ExpertAvailableDaysPeer::THURSDAY)) $criteria->add(ExpertAvailableDaysPeer::THURSDAY, $this->thursday);
		if ($this->isColumnModified(ExpertAvailableDaysPeer::FRIDAY)) $criteria->add(ExpertAvailableDaysPeer::FRIDAY, $this->friday);
		if ($this->isColumnModified(ExpertAvailableDaysPeer::SATURDAY)) $criteria->add(ExpertAvailableDaysPeer::SATURDAY, $this->saturday);
		if ($this->isColumnModified(ExpertAvailableDaysPeer::SUNDAY)) $criteria->add(ExpertAvailableDaysPeer::SUNDAY, $this->sunday);
		if ($this->isColumnModified(ExpertAvailableDaysPeer::TIMINGS)) $criteria->add(ExpertAvailableDaysPeer::TIMINGS, $this->timings);

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
		$criteria = new Criteria(ExpertAvailableDaysPeer::DATABASE_NAME);

		$criteria->add(ExpertAvailableDaysPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of ExpertAvailableDays (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setExpertId($this->expert_id);

		$copyObj->setMonday($this->monday);

		$copyObj->setTuesday($this->tuesday);

		$copyObj->setWednesday($this->wednesday);

		$copyObj->setThursday($this->thursday);

		$copyObj->setFriday($this->friday);

		$copyObj->setSaturday($this->saturday);

		$copyObj->setSunday($this->sunday);

		$copyObj->setTimings($this->timings);


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
	 * @return     ExpertAvailableDays Clone of current object.
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
	 * @return     ExpertAvailableDaysPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new ExpertAvailableDaysPeer();
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

} // BaseExpertAvailableDays
