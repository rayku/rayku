<?php

/**
 * Base class that represents a row from the 'thread' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseThread extends BaseObject  implements Persistent {


  const PEER = 'ThreadPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        ThreadPeer
	 */
	protected static $peer;

	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;

	/**
	 * The value for the poster_id field.
	 * @var        int
	 */
	protected $poster_id;

	/**
	 * The value for the forum_id field.
	 * @var        int
	 */
	protected $forum_id;

	/**
	 * The value for the title field.
	 * @var        string
	 */
	protected $title;

	/**
	 * The value for the tags field.
	 * @var        string
	 */
	protected $tags;

	/**
	 * The value for the visible field.
	 * @var        int
	 */
	protected $visible;

	/**
	 * The value for the cancel field.
	 * @var        int
	 */
	protected $cancel;

	/**
	 * The value for the category_id field.
	 * @var        int
	 */
	protected $category_id;

	/**
	 * The value for the notify_email field.
	 * @var        int
	 */
	protected $notify_email;

	/**
	 * The value for the notify_pm field.
	 * @var        int
	 */
	protected $notify_pm;

	/**
	 * The value for the notify_sms field.
	 * @var        int
	 */
	protected $notify_sms;

	/**
	 * The value for the cell_number field.
	 * @var        int
	 */
	protected $cell_number;

	/**
	 * The value for the school_grade field.
	 * @var        string
	 */
	protected $school_grade;

	/**
	 * The value for the created_at field.
	 * @var        string
	 */
	protected $created_at;

	/**
	 * The value for the lastpost_at field.
	 * @var        string
	 */
	protected $lastpost_at;

	protected $stickie;


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
	 * Initializes internal state of BaseThread object.
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
	 * Get the [poster_id] column value.
	 * 
	 * @return     int
	 */
	public function getPosterId()
	{
		return $this->poster_id;
	}

	/**
	 * Get the [forum_id] column value.
	 * 
	 * @return     int
	 */
	public function getForumId()
	{
		return $this->forum_id;
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
	 * Get the [tags] column value.
	 * 
	 * @return     string
	 */
	public function getTags()
	{
		return $this->tags;
	}

	/**
	 * Get the [visible] column value.
	 * 
	 * @return     int
	 */
	public function getVisible()
	{
		return $this->visible;
	}

	/**
	 * Get the [cancel] column value.
	 * 
	 * @return     int
	 */
	public function getCancel()
	{
		return $this->cancel;
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
	 * Get the [notify_email] column value.
	 * 
	 * @return     int
	 */
	public function getNotifyEmail()
	{
		return $this->notify_email;
	}

	/**
	 * Get the [notify_pm] column value.
	 * 
	 * @return     int
	 */
	public function getNotifyPm()
	{
		return $this->notify_pm;
	}

	/**
	 * Get the [notify_sms] column value.
	 * 
	 * @return     int
	 */
	public function getNotifySms()
	{
		return $this->notify_sms;
	}

	/**
	 * Get the [cell_number] column value.
	 * 
	 * @return     int
	 */
	public function getCellNumber()
	{
		return $this->cell_number;
	}

	/**
	 * Get the [school_grade] column value.
	 * 
	 * @return     string
	 */
	public function getSchoolGrade()
	{
		return $this->school_grade;
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
	 * Get the [optionally formatted] temporal [lastpost_at] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getLastpostAt($format = 'Y-m-d H:i:s')
	{
		if ($this->lastpost_at === null) {
			return null;
		}


		if ($this->lastpost_at === '0000-00-00 00:00:00') {
			// while technically this is not a default value of NULL,
			// this seems to be closest in meaning.
			return null;
		} else {
			try {
				$dt = new DateTime($this->lastpost_at);
			} catch (Exception $x) {
				throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->lastpost_at, true), $x);
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

	public function getStickie()
	{
		return $this->stickie;
	}

	/**
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     Thread The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = ThreadPeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [poster_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Thread The current object (for fluent API support)
	 */
	public function setPosterId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->poster_id !== $v) {
			$this->poster_id = $v;
			$this->modifiedColumns[] = ThreadPeer::POSTER_ID;
		}

		return $this;
	} // setPosterId()

	/**
	 * Set the value of [forum_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Thread The current object (for fluent API support)
	 */
	public function setForumId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->forum_id !== $v) {
			$this->forum_id = $v;
			$this->modifiedColumns[] = ThreadPeer::FORUM_ID;
		}

		return $this;
	} // setForumId()

	/**
	 * Set the value of [title] column.
	 * 
	 * @param      string $v new value
	 * @return     Thread The current object (for fluent API support)
	 */
	public function setTitle($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->title !== $v) {
			$this->title = $v;
			$this->modifiedColumns[] = ThreadPeer::TITLE;
		}

		return $this;
	} // setTitle()

	/**
	 * Set the value of [tags] column.
	 * 
	 * @param      string $v new value
	 * @return     Thread The current object (for fluent API support)
	 */
	public function setTags($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->tags !== $v) {
			$this->tags = $v;
			$this->modifiedColumns[] = ThreadPeer::TAGS;
		}

		return $this;
	} // setTags()

	/**
	 * Set the value of [visible] column.
	 * 
	 * @param      int $v new value
	 * @return     Thread The current object (for fluent API support)
	 */
	public function setVisible($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->visible !== $v) {
			$this->visible = $v;
			$this->modifiedColumns[] = ThreadPeer::VISIBLE;
		}

		return $this;
	} // setVisible()

	/**
	 * Set the value of [cancel] column.
	 * 
	 * @param      int $v new value
	 * @return     Thread The current object (for fluent API support)
	 */
	public function setCancel($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->cancel !== $v) {
			$this->cancel = $v;
			$this->modifiedColumns[] = ThreadPeer::CANCEL;
		}

		return $this;
	} // setCancel()

	/**
	 * Set the value of [category_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Thread The current object (for fluent API support)
	 */
	public function setCategoryId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->category_id !== $v) {
			$this->category_id = $v;
			$this->modifiedColumns[] = ThreadPeer::CATEGORY_ID;
		}

		return $this;
	} // setCategoryId()

	/**
	 * Set the value of [notify_email] column.
	 * 
	 * @param      int $v new value
	 * @return     Thread The current object (for fluent API support)
	 */
	public function setNotifyEmail($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->notify_email !== $v) {
			$this->notify_email = $v;
			$this->modifiedColumns[] = ThreadPeer::NOTIFY_EMAIL;
		}

		return $this;
	} // setNotifyEmail()

	/**
	 * Set the value of [notify_pm] column.
	 * 
	 * @param      int $v new value
	 * @return     Thread The current object (for fluent API support)
	 */
	public function setNotifyPm($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->notify_pm !== $v) {
			$this->notify_pm = $v;
			$this->modifiedColumns[] = ThreadPeer::NOTIFY_PM;
		}

		return $this;
	} // setNotifyPm()

	/**
	 * Set the value of [notify_sms] column.
	 * 
	 * @param      int $v new value
	 * @return     Thread The current object (for fluent API support)
	 */
	public function setNotifySms($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->notify_sms !== $v) {
			$this->notify_sms = $v;
			$this->modifiedColumns[] = ThreadPeer::NOTIFY_SMS;
		}

		return $this;
	} // setNotifySms()

	/**
	 * Set the value of [cell_number] column.
	 * 
	 * @param      int $v new value
	 * @return     Thread The current object (for fluent API support)
	 */
	public function setCellNumber($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->cell_number !== $v) {
			$this->cell_number = $v;
			$this->modifiedColumns[] = ThreadPeer::CELL_NUMBER;
		}

		return $this;
	} // setCellNumber()

	/**
	 * Set the value of [school_grade] column.
	 * 
	 * @param      string $v new value
	 * @return     Thread The current object (for fluent API support)
	 */
	public function setSchoolGrade($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->school_grade !== $v) {
			$this->school_grade = $v;
			$this->modifiedColumns[] = ThreadPeer::SCHOOL_GRADE;
		}

		return $this;
	} // setSchoolGrade()

	/**
	 * Sets the value of [created_at] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     Thread The current object (for fluent API support)
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
				$this->modifiedColumns[] = ThreadPeer::CREATED_AT;
			}
		} // if either are not null

		return $this;
	} // setCreatedAt()

	/**
	 * Sets the value of [lastpost_at] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     Thread The current object (for fluent API support)
	 */
	public function setLastpostAt($v)
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

		if ( $this->lastpost_at !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->lastpost_at !== null && $tmpDt = new DateTime($this->lastpost_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d H:i:s') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->lastpost_at = ($dt ? $dt->format('Y-m-d H:i:s') : null);
				$this->modifiedColumns[] = ThreadPeer::LASTPOST_AT;
			}
		} // if either are not null

		return $this;
	} // setLastpostAt()

	public function setStickie($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->stickie !== $v) {
			$this->stickie = $v;
			$this->modifiedColumns[] = ThreadPeer::STICKIE;
		}

		return $this;
	} 

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
			$this->poster_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->forum_id = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->title = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->tags = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->visible = ($row[$startcol + 5] !== null) ? (int) $row[$startcol + 5] : null;
			$this->cancel = ($row[$startcol + 6] !== null) ? (int) $row[$startcol + 6] : null;
			$this->category_id = ($row[$startcol + 7] !== null) ? (int) $row[$startcol + 7] : null;
			$this->notify_email = ($row[$startcol + 8] !== null) ? (int) $row[$startcol + 8] : null;
			$this->notify_pm = ($row[$startcol + 9] !== null) ? (int) $row[$startcol + 9] : null;
			$this->notify_sms = ($row[$startcol + 10] !== null) ? (int) $row[$startcol + 10] : null;
			$this->cell_number = ($row[$startcol + 11] !== null) ? (int) $row[$startcol + 11] : null;
			$this->school_grade = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
			$this->created_at = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
			$this->lastpost_at = ($row[$startcol + 14] !== null) ? (string) $row[$startcol + 14] : null;
			$this->stickie = ($row[$startcol + 15] !== null) ? (string) $row[$startcol + 15] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 15; // 15 = ThreadPeer::NUM_COLUMNS - ThreadPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating Thread object", $e);
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
			$con = Propel::getConnection(ThreadPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = ThreadPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
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
			$con = Propel::getConnection(ThreadPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			ThreadPeer::doDelete($this, $con);
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
    if ($this->isNew() && !$this->isColumnModified(ThreadPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ThreadPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			ThreadPeer::addInstanceToPool($this);
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
				$this->modifiedColumns[] = ThreadPeer::ID;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = ThreadPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += ThreadPeer::doUpdate($this, $con);
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


			if (($retval = ThreadPeer::doValidate($this, $columns)) !== true) {
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
		$pos = ThreadPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getPosterId();
				break;
			case 2:
				return $this->getForumId();
				break;
			case 3:
				return $this->getTitle();
				break;
			case 4:
				return $this->getTags();
				break;
			case 5:
				return $this->getVisible();
				break;
			case 6:
				return $this->getCancel();
				break;
			case 7:
				return $this->getCategoryId();
				break;
			case 8:
				return $this->getNotifyEmail();
				break;
			case 9:
				return $this->getNotifyPm();
				break;
			case 10:
				return $this->getNotifySms();
				break;
			case 11:
				return $this->getCellNumber();
				break;
			case 12:
				return $this->getSchoolGrade();
				break;
			case 13:
				return $this->getCreatedAt();
				break;
			case 14:
				return $this->getLastpostAt();
				break;

			case 15:
				return $this->getStickie();
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
		$keys = ThreadPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getPosterId(),
			$keys[2] => $this->getForumId(),
			$keys[3] => $this->getTitle(),
			$keys[4] => $this->getTags(),
			$keys[5] => $this->getVisible(),
			$keys[6] => $this->getCancel(),
			$keys[7] => $this->getCategoryId(),
			$keys[8] => $this->getNotifyEmail(),
			$keys[9] => $this->getNotifyPm(),
			$keys[10] => $this->getNotifySms(),
			$keys[11] => $this->getCellNumber(),
			$keys[12] => $this->getSchoolGrade(),
			$keys[13] => $this->getCreatedAt(),
			$keys[14] => $this->getLastpostAt(),
			$keys[15] => $this->getStickie(),
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
		$pos = ThreadPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setPosterId($value);
				break;
			case 2:
				$this->setForumId($value);
				break;
			case 3:
				$this->setTitle($value);
				break;
			case 4:
				$this->setTags($value);
				break;
			case 5:
				$this->setVisible($value);
				break;
			case 6:
				$this->setCancel($value);
				break;
			case 7:
				$this->setCategoryId($value);
				break;
			case 8:
				$this->setNotifyEmail($value);
				break;
			case 9:
				$this->setNotifyPm($value);
				break;
			case 10:
				$this->setNotifySms($value);
				break;
			case 11:
				$this->setCellNumber($value);
				break;
			case 12:
				$this->setSchoolGrade($value);
				break;
			case 13:
				$this->setCreatedAt($value);
				break;
			case 14:
				$this->setLastpostAt($value);
				break;

			case 15:
				$this->setStickie($value);
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
		$keys = ThreadPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setPosterId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setForumId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setTitle($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setTags($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setVisible($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCancel($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCategoryId($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setNotifyEmail($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setNotifyPm($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setNotifySms($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCellNumber($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setSchoolGrade($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setCreatedAt($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setLastpostAt($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setStickie($arr[$keys[15]]);

	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(ThreadPeer::DATABASE_NAME);

		if ($this->isColumnModified(ThreadPeer::ID)) $criteria->add(ThreadPeer::ID, $this->id);
		if ($this->isColumnModified(ThreadPeer::POSTER_ID)) $criteria->add(ThreadPeer::POSTER_ID, $this->poster_id);
		if ($this->isColumnModified(ThreadPeer::FORUM_ID)) $criteria->add(ThreadPeer::FORUM_ID, $this->forum_id);
		if ($this->isColumnModified(ThreadPeer::TITLE)) $criteria->add(ThreadPeer::TITLE, $this->title);
		if ($this->isColumnModified(ThreadPeer::TAGS)) $criteria->add(ThreadPeer::TAGS, $this->tags);
		if ($this->isColumnModified(ThreadPeer::VISIBLE)) $criteria->add(ThreadPeer::VISIBLE, $this->visible);
		if ($this->isColumnModified(ThreadPeer::CANCEL)) $criteria->add(ThreadPeer::CANCEL, $this->cancel);
		if ($this->isColumnModified(ThreadPeer::CATEGORY_ID)) $criteria->add(ThreadPeer::CATEGORY_ID, $this->category_id);
		if ($this->isColumnModified(ThreadPeer::NOTIFY_EMAIL)) $criteria->add(ThreadPeer::NOTIFY_EMAIL, $this->notify_email);
		if ($this->isColumnModified(ThreadPeer::NOTIFY_PM)) $criteria->add(ThreadPeer::NOTIFY_PM, $this->notify_pm);
		if ($this->isColumnModified(ThreadPeer::NOTIFY_SMS)) $criteria->add(ThreadPeer::NOTIFY_SMS, $this->notify_sms);
		if ($this->isColumnModified(ThreadPeer::CELL_NUMBER)) $criteria->add(ThreadPeer::CELL_NUMBER, $this->cell_number);
		if ($this->isColumnModified(ThreadPeer::SCHOOL_GRADE)) $criteria->add(ThreadPeer::SCHOOL_GRADE, $this->school_grade);
		if ($this->isColumnModified(ThreadPeer::CREATED_AT)) $criteria->add(ThreadPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(ThreadPeer::LASTPOST_AT)) $criteria->add(ThreadPeer::LASTPOST_AT, $this->lastpost_at);
		if ($this->isColumnModified(ThreadPeer::STICKIE)) $criteria->add(ThreadPeer::STICKIE, $this->stickie);

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
		$criteria = new Criteria(ThreadPeer::DATABASE_NAME);

		$criteria->add(ThreadPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of Thread (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setPosterId($this->poster_id);

		$copyObj->setForumId($this->forum_id);

		$copyObj->setTitle($this->title);

		$copyObj->setTags($this->tags);

		$copyObj->setVisible($this->visible);

		$copyObj->setCancel($this->cancel);

		$copyObj->setCategoryId($this->category_id);

		$copyObj->setNotifyEmail($this->notify_email);

		$copyObj->setNotifyPm($this->notify_pm);

		$copyObj->setNotifySms($this->notify_sms);

		$copyObj->setCellNumber($this->cell_number);

		$copyObj->setSchoolGrade($this->school_grade);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setLastpostAt($this->lastpost_at);

		$copyObj->setStickie($this->stickie);

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
	 * @return     Thread Clone of current object.
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
	 * @return     ThreadPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new ThreadPeer();
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

} // BaseThread
