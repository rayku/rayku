<?php

/**
 * Base class that represents a row from the 'student_questions' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseStudentQuestion extends BaseObject  implements Persistent {


  const PEER = 'StudentQuestionPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        StudentQuestionPeer
	 */
	protected static $peer;

	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;

	/**
	 * The value for the user_id field.
	 * @var        int
	 */
	protected $user_id;

	/**
	 * The value for the checked_id field.
	 * @var        int
	 */
	protected $checked_id;

	/**
	 * The value for the category_id field.
	 * @var        int
	 */
	protected $category_id;

	/**
	 * The value for the course_id field.
	 * @var        int
	 */
	protected $course_id;

	/**
	 * The value for the question field.
	 * @var        string
	 */
	protected $question;

	/**
	 * The value for the exe_order field.
	 * @var        int
	 */
	protected $exe_order;

	/**
	 * The value for the time field.
	 * @var        int
	 */
	protected $time;

	/**
	 * The value for the course_code field.
	 * @var        string
	 */
	protected $course_code;

	/**
	 * The value for the year field.
	 * @var        string
	 */
	protected $year;

	/**
	 * The value for the school field.
	 * @var        string
	 */
	protected $school;

	/**
	 * The value for the status field.
	 * @var        int
	 */
	protected $status;

	/**
	 * The value for the close field.
	 * @var        int
	 */
	protected $close;

	/**
	 * The value for the cron field.
	 * @var        int
	 */
	protected $cron;

	/**
	 * The value for the source field.
	 * @var        string
	 */
	protected $source;

	/**
	 * @var        User
	 */
	protected $aUserRelatedByStudentId;

	/**
	 * @var        User
	 */
	protected $aUserRelatedByTutorId;

	/**
	 * @var        array WhiteboardSession[] Collection to store aggregation of WhiteboardSession objects.
	 */
	protected $collWhiteboardSessions;

	/**
	 * @var        Criteria The criteria used to select the current contents of collWhiteboardSessions.
	 */
	private $lastWhiteboardSessionCriteria = null;

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
	 * Initializes internal state of BaseStudentQuestion object.
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
	 * Get the [user_id] column value.
	 * 
	 * @return     int
	 */
	public function getStudentId()
	{
		return $this->user_id;
	}

	/**
	 * Get the [checked_id] column value.
	 * 
	 * @return     int
	 */
	public function getTutorId()
	{
		return $this->checked_id;
	}

	/**
	 * Get the [category_id] column value.
	 * 
	 * @return     int
	 */
	public function getCategoryId()
	{
		return $this->category_id;
	}

	/**
	 * Get the [course_id] column value.
	 * 
	 * @return     int
	 */
	public function getCourseId()
	{
		return $this->course_id;
	}

	/**
	 * Get the [question] column value.
	 * 
	 * @return     string
	 */
	public function getQuestion()
	{
		return $this->question;
	}

	/**
	 * Get the [exe_order] column value.
	 * 
	 * @return     int
	 */
	public function getExeOrder()
	{
		return $this->exe_order;
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
	 * Get the [course_code] column value.
	 * 
	 * @return     string
	 */
	public function getCourseCode()
	{
		return $this->course_code;
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
	 * Get the [school] column value.
	 * 
	 * @return     string
	 */
	public function getSchool()
	{
		return $this->school;
	}

	/**
	 * Get the [status] column value.
	 * 
	 * @return     int
	 */
	public function getStatus()
	{
		return $this->status;
	}

	/**
	 * Get the [close] column value.
	 * 
	 * @return     int
	 */
	public function getClose()
	{
		return $this->close;
	}

	/**
	 * Get the [cron] column value.
	 * 
	 * @return     int
	 */
	public function getCron()
	{
		return $this->cron;
	}

	/**
	 * Get the [source] column value.
	 * 
	 * @return     string
	 */
	public function getSource()
	{
		return $this->source;
	}

	/**
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     StudentQuestion The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = StudentQuestionPeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [user_id] column.
	 * 
	 * @param      int $v new value
	 * @return     StudentQuestion The current object (for fluent API support)
	 */
	public function setStudentId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->user_id !== $v) {
			$this->user_id = $v;
			$this->modifiedColumns[] = StudentQuestionPeer::USER_ID;
		}

		if ($this->aUserRelatedByStudentId !== null && $this->aUserRelatedByStudentId->getId() !== $v) {
			$this->aUserRelatedByStudentId = null;
		}

		return $this;
	} // setStudentId()

	/**
	 * Set the value of [checked_id] column.
	 * 
	 * @param      int $v new value
	 * @return     StudentQuestion The current object (for fluent API support)
	 */
	public function setTutorId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->checked_id !== $v) {
			$this->checked_id = $v;
			$this->modifiedColumns[] = StudentQuestionPeer::CHECKED_ID;
		}

		if ($this->aUserRelatedByTutorId !== null && $this->aUserRelatedByTutorId->getId() !== $v) {
			$this->aUserRelatedByTutorId = null;
		}

		return $this;
	} // setTutorId()

	/**
	 * Set the value of [category_id] column.
	 * 
	 * @param      int $v new value
	 * @return     StudentQuestion The current object (for fluent API support)
	 */
	public function setCategoryId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->category_id !== $v) {
			$this->category_id = $v;
			$this->modifiedColumns[] = StudentQuestionPeer::CATEGORY_ID;
		}

		return $this;
	} // setCategoryId()

	/**
	 * Set the value of [course_id] column.
	 * 
	 * @param      int $v new value
	 * @return     StudentQuestion The current object (for fluent API support)
	 */
	public function setCourseId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->course_id !== $v) {
			$this->course_id = $v;
			$this->modifiedColumns[] = StudentQuestionPeer::COURSE_ID;
		}

		return $this;
	} // setCourseId()

	/**
	 * Set the value of [question] column.
	 * 
	 * @param      string $v new value
	 * @return     StudentQuestion The current object (for fluent API support)
	 */
	public function setQuestion($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->question !== $v) {
			$this->question = $v;
			$this->modifiedColumns[] = StudentQuestionPeer::QUESTION;
		}

		return $this;
	} // setQuestion()

	/**
	 * Set the value of [exe_order] column.
	 * 
	 * @param      int $v new value
	 * @return     StudentQuestion The current object (for fluent API support)
	 */
	public function setExeOrder($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->exe_order !== $v) {
			$this->exe_order = $v;
			$this->modifiedColumns[] = StudentQuestionPeer::EXE_ORDER;
		}

		return $this;
	} // setExeOrder()

	/**
	 * Set the value of [time] column.
	 * 
	 * @param      int $v new value
	 * @return     StudentQuestion The current object (for fluent API support)
	 */
	public function setTime($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->time !== $v) {
			$this->time = $v;
			$this->modifiedColumns[] = StudentQuestionPeer::TIME;
		}

		return $this;
	} // setTime()

	/**
	 * Set the value of [course_code] column.
	 * 
	 * @param      string $v new value
	 * @return     StudentQuestion The current object (for fluent API support)
	 */
	public function setCourseCode($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->course_code !== $v) {
			$this->course_code = $v;
			$this->modifiedColumns[] = StudentQuestionPeer::COURSE_CODE;
		}

		return $this;
	} // setCourseCode()

	/**
	 * Set the value of [year] column.
	 * 
	 * @param      string $v new value
	 * @return     StudentQuestion The current object (for fluent API support)
	 */
	public function setYear($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->year !== $v) {
			$this->year = $v;
			$this->modifiedColumns[] = StudentQuestionPeer::YEAR;
		}

		return $this;
	} // setYear()

	/**
	 * Set the value of [school] column.
	 * 
	 * @param      string $v new value
	 * @return     StudentQuestion The current object (for fluent API support)
	 */
	public function setSchool($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->school !== $v) {
			$this->school = $v;
			$this->modifiedColumns[] = StudentQuestionPeer::SCHOOL;
		}

		return $this;
	} // setSchool()

	/**
	 * Set the value of [status] column.
	 * 
	 * @param      int $v new value
	 * @return     StudentQuestion The current object (for fluent API support)
	 */
	public function setStatus($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->status !== $v) {
			$this->status = $v;
			$this->modifiedColumns[] = StudentQuestionPeer::STATUS;
		}

		return $this;
	} // setStatus()

	/**
	 * Set the value of [close] column.
	 * 
	 * @param      int $v new value
	 * @return     StudentQuestion The current object (for fluent API support)
	 */
	public function setClose($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->close !== $v) {
			$this->close = $v;
			$this->modifiedColumns[] = StudentQuestionPeer::CLOSE;
		}

		return $this;
	} // setClose()

	/**
	 * Set the value of [cron] column.
	 * 
	 * @param      int $v new value
	 * @return     StudentQuestion The current object (for fluent API support)
	 */
	public function setCron($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->cron !== $v) {
			$this->cron = $v;
			$this->modifiedColumns[] = StudentQuestionPeer::CRON;
		}

		return $this;
	} // setCron()

	/**
	 * Set the value of [source] column.
	 * 
	 * @param      string $v new value
	 * @return     StudentQuestion The current object (for fluent API support)
	 */
	public function setSource($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->source !== $v) {
			$this->source = $v;
			$this->modifiedColumns[] = StudentQuestionPeer::SOURCE;
		}

		return $this;
	} // setSource()

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
			$this->user_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->checked_id = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->category_id = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
			$this->course_id = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
			$this->question = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->exe_order = ($row[$startcol + 6] !== null) ? (int) $row[$startcol + 6] : null;
			$this->time = ($row[$startcol + 7] !== null) ? (int) $row[$startcol + 7] : null;
			$this->course_code = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->year = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->school = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->status = ($row[$startcol + 11] !== null) ? (int) $row[$startcol + 11] : null;
			$this->close = ($row[$startcol + 12] !== null) ? (int) $row[$startcol + 12] : null;
			$this->cron = ($row[$startcol + 13] !== null) ? (int) $row[$startcol + 13] : null;
			$this->source = ($row[$startcol + 14] !== null) ? (string) $row[$startcol + 14] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 15; // 15 = StudentQuestionPeer::NUM_COLUMNS - StudentQuestionPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating StudentQuestion object", $e);
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

		if ($this->aUserRelatedByStudentId !== null && $this->user_id !== $this->aUserRelatedByStudentId->getId()) {
			$this->aUserRelatedByStudentId = null;
		}
		if ($this->aUserRelatedByTutorId !== null && $this->checked_id !== $this->aUserRelatedByTutorId->getId()) {
			$this->aUserRelatedByTutorId = null;
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
			$con = Propel::getConnection(StudentQuestionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = StudentQuestionPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aUserRelatedByStudentId = null;
			$this->aUserRelatedByTutorId = null;
			$this->collWhiteboardSessions = null;
			$this->lastWhiteboardSessionCriteria = null;

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
			$con = Propel::getConnection(StudentQuestionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			StudentQuestionPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(StudentQuestionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			StudentQuestionPeer::addInstanceToPool($this);
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

			if ($this->aUserRelatedByStudentId !== null) {
				if ($this->aUserRelatedByStudentId->isModified() || $this->aUserRelatedByStudentId->isNew()) {
					$affectedRows += $this->aUserRelatedByStudentId->save($con);
				}
				$this->setUserRelatedByStudentId($this->aUserRelatedByStudentId);
			}

			if ($this->aUserRelatedByTutorId !== null) {
				if ($this->aUserRelatedByTutorId->isModified() || $this->aUserRelatedByTutorId->isNew()) {
					$affectedRows += $this->aUserRelatedByTutorId->save($con);
				}
				$this->setUserRelatedByTutorId($this->aUserRelatedByTutorId);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = StudentQuestionPeer::ID;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = StudentQuestionPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += StudentQuestionPeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collWhiteboardSessions !== null) {
				foreach ($this->collWhiteboardSessions as $referrerFK) {
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

			if ($this->aUserRelatedByStudentId !== null) {
				if (!$this->aUserRelatedByStudentId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUserRelatedByStudentId->getValidationFailures());
				}
			}

			if ($this->aUserRelatedByTutorId !== null) {
				if (!$this->aUserRelatedByTutorId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUserRelatedByTutorId->getValidationFailures());
				}
			}


			if (($retval = StudentQuestionPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collWhiteboardSessions !== null) {
					foreach ($this->collWhiteboardSessions as $referrerFK) {
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
		$pos = StudentQuestionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getStudentId();
				break;
			case 2:
				return $this->getTutorId();
				break;
			case 3:
				return $this->getCategoryId();
				break;
			case 4:
				return $this->getCourseId();
				break;
			case 5:
				return $this->getQuestion();
				break;
			case 6:
				return $this->getExeOrder();
				break;
			case 7:
				return $this->getTime();
				break;
			case 8:
				return $this->getCourseCode();
				break;
			case 9:
				return $this->getYear();
				break;
			case 10:
				return $this->getSchool();
				break;
			case 11:
				return $this->getStatus();
				break;
			case 12:
				return $this->getClose();
				break;
			case 13:
				return $this->getCron();
				break;
			case 14:
				return $this->getSource();
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
		$keys = StudentQuestionPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getStudentId(),
			$keys[2] => $this->getTutorId(),
			$keys[3] => $this->getCategoryId(),
			$keys[4] => $this->getCourseId(),
			$keys[5] => $this->getQuestion(),
			$keys[6] => $this->getExeOrder(),
			$keys[7] => $this->getTime(),
			$keys[8] => $this->getCourseCode(),
			$keys[9] => $this->getYear(),
			$keys[10] => $this->getSchool(),
			$keys[11] => $this->getStatus(),
			$keys[12] => $this->getClose(),
			$keys[13] => $this->getCron(),
			$keys[14] => $this->getSource(),
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
		$pos = StudentQuestionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setStudentId($value);
				break;
			case 2:
				$this->setTutorId($value);
				break;
			case 3:
				$this->setCategoryId($value);
				break;
			case 4:
				$this->setCourseId($value);
				break;
			case 5:
				$this->setQuestion($value);
				break;
			case 6:
				$this->setExeOrder($value);
				break;
			case 7:
				$this->setTime($value);
				break;
			case 8:
				$this->setCourseCode($value);
				break;
			case 9:
				$this->setYear($value);
				break;
			case 10:
				$this->setSchool($value);
				break;
			case 11:
				$this->setStatus($value);
				break;
			case 12:
				$this->setClose($value);
				break;
			case 13:
				$this->setCron($value);
				break;
			case 14:
				$this->setSource($value);
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
		$keys = StudentQuestionPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setStudentId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setTutorId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCategoryId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCourseId($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setQuestion($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setExeOrder($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setTime($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCourseCode($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setYear($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setSchool($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setStatus($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setClose($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setCron($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setSource($arr[$keys[14]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(StudentQuestionPeer::DATABASE_NAME);

		if ($this->isColumnModified(StudentQuestionPeer::ID)) $criteria->add(StudentQuestionPeer::ID, $this->id);
		if ($this->isColumnModified(StudentQuestionPeer::USER_ID)) $criteria->add(StudentQuestionPeer::USER_ID, $this->user_id);
		if ($this->isColumnModified(StudentQuestionPeer::CHECKED_ID)) $criteria->add(StudentQuestionPeer::CHECKED_ID, $this->checked_id);
		if ($this->isColumnModified(StudentQuestionPeer::CATEGORY_ID)) $criteria->add(StudentQuestionPeer::CATEGORY_ID, $this->category_id);
		if ($this->isColumnModified(StudentQuestionPeer::COURSE_ID)) $criteria->add(StudentQuestionPeer::COURSE_ID, $this->course_id);
		if ($this->isColumnModified(StudentQuestionPeer::QUESTION)) $criteria->add(StudentQuestionPeer::QUESTION, $this->question);
		if ($this->isColumnModified(StudentQuestionPeer::EXE_ORDER)) $criteria->add(StudentQuestionPeer::EXE_ORDER, $this->exe_order);
		if ($this->isColumnModified(StudentQuestionPeer::TIME)) $criteria->add(StudentQuestionPeer::TIME, $this->time);
		if ($this->isColumnModified(StudentQuestionPeer::COURSE_CODE)) $criteria->add(StudentQuestionPeer::COURSE_CODE, $this->course_code);
		if ($this->isColumnModified(StudentQuestionPeer::YEAR)) $criteria->add(StudentQuestionPeer::YEAR, $this->year);
		if ($this->isColumnModified(StudentQuestionPeer::SCHOOL)) $criteria->add(StudentQuestionPeer::SCHOOL, $this->school);
		if ($this->isColumnModified(StudentQuestionPeer::STATUS)) $criteria->add(StudentQuestionPeer::STATUS, $this->status);
		if ($this->isColumnModified(StudentQuestionPeer::CLOSE)) $criteria->add(StudentQuestionPeer::CLOSE, $this->close);
		if ($this->isColumnModified(StudentQuestionPeer::CRON)) $criteria->add(StudentQuestionPeer::CRON, $this->cron);
		if ($this->isColumnModified(StudentQuestionPeer::SOURCE)) $criteria->add(StudentQuestionPeer::SOURCE, $this->source);

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
		$criteria = new Criteria(StudentQuestionPeer::DATABASE_NAME);

		$criteria->add(StudentQuestionPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of StudentQuestion (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setStudentId($this->user_id);

		$copyObj->setTutorId($this->checked_id);

		$copyObj->setCategoryId($this->category_id);

		$copyObj->setCourseId($this->course_id);

		$copyObj->setQuestion($this->question);

		$copyObj->setExeOrder($this->exe_order);

		$copyObj->setTime($this->time);

		$copyObj->setCourseCode($this->course_code);

		$copyObj->setYear($this->year);

		$copyObj->setSchool($this->school);

		$copyObj->setStatus($this->status);

		$copyObj->setClose($this->close);

		$copyObj->setCron($this->cron);

		$copyObj->setSource($this->source);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getWhiteboardSessions() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addWhiteboardSession($relObj->copy($deepCopy));
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
	 * @return     StudentQuestion Clone of current object.
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
	 * @return     StudentQuestionPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new StudentQuestionPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a User object.
	 *
	 * @param      User $v
	 * @return     StudentQuestion The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setUserRelatedByStudentId(User $v = null)
	{
		if ($v === null) {
			$this->setStudentId(NULL);
		} else {
			$this->setStudentId($v->getId());
		}

		$this->aUserRelatedByStudentId = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the User object, it will not be re-added.
		if ($v !== null) {
			$v->addStudentQuestionRelatedByStudentId($this);
		}

		return $this;
	}


	/**
	 * Get the associated User object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     User The associated User object.
	 * @throws     PropelException
	 */
	public function getUserRelatedByStudentId(PropelPDO $con = null)
	{
		if ($this->aUserRelatedByStudentId === null && ($this->user_id !== null)) {
			$c = new Criteria(UserPeer::DATABASE_NAME);
			$c->add(UserPeer::ID, $this->user_id);
			$this->aUserRelatedByStudentId = UserPeer::doSelectOne($c, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aUserRelatedByStudentId->addStudentQuestionsRelatedByStudentId($this);
			 */
		}
		return $this->aUserRelatedByStudentId;
	}

	/**
	 * Declares an association between this object and a User object.
	 *
	 * @param      User $v
	 * @return     StudentQuestion The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setUserRelatedByTutorId(User $v = null)
	{
		if ($v === null) {
			$this->setTutorId(NULL);
		} else {
			$this->setTutorId($v->getId());
		}

		$this->aUserRelatedByTutorId = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the User object, it will not be re-added.
		if ($v !== null) {
			$v->addStudentQuestionRelatedByTutorId($this);
		}

		return $this;
	}


	/**
	 * Get the associated User object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     User The associated User object.
	 * @throws     PropelException
	 */
	public function getUserRelatedByTutorId(PropelPDO $con = null)
	{
		if ($this->aUserRelatedByTutorId === null && ($this->checked_id !== null)) {
			$c = new Criteria(UserPeer::DATABASE_NAME);
			$c->add(UserPeer::ID, $this->checked_id);
			$this->aUserRelatedByTutorId = UserPeer::doSelectOne($c, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aUserRelatedByTutorId->addStudentQuestionsRelatedByTutorId($this);
			 */
		}
		return $this->aUserRelatedByTutorId;
	}

	/**
	 * Clears out the collWhiteboardSessions collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addWhiteboardSessions()
	 */
	public function clearWhiteboardSessions()
	{
		$this->collWhiteboardSessions = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collWhiteboardSessions collection (array).
	 *
	 * By default this just sets the collWhiteboardSessions collection to an empty array (like clearcollWhiteboardSessions());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initWhiteboardSessions()
	{
		$this->collWhiteboardSessions = array();
	}

	/**
	 * Gets an array of WhiteboardSession objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this StudentQuestion has previously been saved, it will retrieve
	 * related WhiteboardSessions from storage. If this StudentQuestion is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array WhiteboardSession[]
	 * @throws     PropelException
	 */
	public function getWhiteboardSessions($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(StudentQuestionPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collWhiteboardSessions === null) {
			if ($this->isNew()) {
			   $this->collWhiteboardSessions = array();
			} else {

				$criteria->add(WhiteboardSessionPeer::QUESTION_ID, $this->id);

				WhiteboardSessionPeer::addSelectColumns($criteria);
				$this->collWhiteboardSessions = WhiteboardSessionPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(WhiteboardSessionPeer::QUESTION_ID, $this->id);

				WhiteboardSessionPeer::addSelectColumns($criteria);
				if (!isset($this->lastWhiteboardSessionCriteria) || !$this->lastWhiteboardSessionCriteria->equals($criteria)) {
					$this->collWhiteboardSessions = WhiteboardSessionPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastWhiteboardSessionCriteria = $criteria;
		return $this->collWhiteboardSessions;
	}

	/**
	 * Returns the number of related WhiteboardSession objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related WhiteboardSession objects.
	 * @throws     PropelException
	 */
	public function countWhiteboardSessions(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(StudentQuestionPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collWhiteboardSessions === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(WhiteboardSessionPeer::QUESTION_ID, $this->id);

				$count = WhiteboardSessionPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(WhiteboardSessionPeer::QUESTION_ID, $this->id);

				if (!isset($this->lastWhiteboardSessionCriteria) || !$this->lastWhiteboardSessionCriteria->equals($criteria)) {
					$count = WhiteboardSessionPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collWhiteboardSessions);
				}
			} else {
				$count = count($this->collWhiteboardSessions);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a WhiteboardSession object to this object
	 * through the WhiteboardSession foreign key attribute.
	 *
	 * @param      WhiteboardSession $l WhiteboardSession
	 * @return     void
	 * @throws     PropelException
	 */
	public function addWhiteboardSession(WhiteboardSession $l)
	{
		if ($this->collWhiteboardSessions === null) {
			$this->initWhiteboardSessions();
		}
		if (!in_array($l, $this->collWhiteboardSessions, true)) { // only add it if the **same** object is not already associated
			array_push($this->collWhiteboardSessions, $l);
			$l->setStudentQuestion($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this StudentQuestion is new, it will return
	 * an empty collection; or if this StudentQuestion has previously
	 * been saved, it will retrieve related WhiteboardSessions from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in StudentQuestion.
	 */
	public function getWhiteboardSessionsJoinUser($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(StudentQuestionPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collWhiteboardSessions === null) {
			if ($this->isNew()) {
				$this->collWhiteboardSessions = array();
			} else {

				$criteria->add(WhiteboardSessionPeer::QUESTION_ID, $this->id);

				$this->collWhiteboardSessions = WhiteboardSessionPeer::doSelectJoinUser($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(WhiteboardSessionPeer::QUESTION_ID, $this->id);

			if (!isset($this->lastWhiteboardSessionCriteria) || !$this->lastWhiteboardSessionCriteria->equals($criteria)) {
				$this->collWhiteboardSessions = WhiteboardSessionPeer::doSelectJoinUser($criteria, $con, $join_behavior);
			}
		}
		$this->lastWhiteboardSessionCriteria = $criteria;

		return $this->collWhiteboardSessions;
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
			if ($this->collWhiteboardSessions) {
				foreach ((array) $this->collWhiteboardSessions as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		$this->collWhiteboardSessions = null;
			$this->aUserRelatedByStudentId = null;
			$this->aUserRelatedByTutorId = null;
	}

} // BaseStudentQuestion
