<?php

/**
 * Base class that represents a row from the 'whiteboard_chat' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseWhiteboardChat extends BaseObject  implements Persistent {


  const PEER = 'WhiteboardChatPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        WhiteboardChatPeer
	 */
	protected static $peer;

	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;

	/**
	 * The value for the is_public field.
	 * @var        int
	 */
	protected $is_public;

	/**
	 * The value for the expert_id field.
	 * @var        int
	 */
	protected $expert_id;

	/**
	 * The value for the asker_id field.
	 * @var        int
	 */
	protected $asker_id;

	/**
	 * The value for the expert_nickname field.
	 * @var        string
	 */
	protected $expert_nickname;

	/**
	 * The value for the asker_nickname field.
	 * @var        string
	 */
	protected $asker_nickname;

	/**
	 * The value for the question field.
	 * @var        string
	 */
	protected $question;

	/**
	 * The value for the started_at field.
	 * @var        string
	 */
	protected $started_at;

	/**
	 * The value for the ended_at field.
	 * @var        string
	 */
	protected $ended_at;

	/**
	 * The value for the directory field.
	 * @var        string
	 */
	protected $directory;

	/**
	 * The value for the created_at field.
	 * @var        string
	 */
	protected $created_at;

	/**
	 * The value for the timer field.
	 * @var        string
	 */
	protected $timer;

	/**
	 * The value for the rating field.
	 * @var        int
	 */
	protected $rating;

	/**
	 * The value for the amount field.
	 * @var        double
	 */
	protected $amount;

	/**
	 * The value for the comments field.
	 * @var        string
	 */
	protected $comments;

	/**
	 * @var        array WhiteboardMessage[] Collection to store aggregation of WhiteboardMessage objects.
	 */
	protected $collWhiteboardMessages;

	/**
	 * @var        Criteria The criteria used to select the current contents of collWhiteboardMessages.
	 */
	private $lastWhiteboardMessageCriteria = null;

	/**
	 * @var        array WhiteboardSnapshot[] Collection to store aggregation of WhiteboardSnapshot objects.
	 */
	protected $collWhiteboardSnapshots;

	/**
	 * @var        Criteria The criteria used to select the current contents of collWhiteboardSnapshots.
	 */
	private $lastWhiteboardSnapshotCriteria = null;

	/**
	 * @var        array WhiteboardTutorFeedback[] Collection to store aggregation of WhiteboardTutorFeedback objects.
	 */
	protected $collWhiteboardTutorFeedbacks;

	/**
	 * @var        Criteria The criteria used to select the current contents of collWhiteboardTutorFeedbacks.
	 */
	private $lastWhiteboardTutorFeedbackCriteria = null;

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
	 * Initializes internal state of BaseWhiteboardChat object.
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
	 * Get the [is_public] column value.
	 * 
	 * @return     int
	 */
	public function getIsPublic()
	{
		return $this->is_public;
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
	 * Get the [asker_id] column value.
	 * 
	 * @return     int
	 */
	public function getAskerId()
	{
		return $this->asker_id;
	}

	/**
	 * Get the [expert_nickname] column value.
	 * 
	 * @return     string
	 */
	public function getExpertNickname()
	{
		return $this->expert_nickname;
	}

	/**
	 * Get the [asker_nickname] column value.
	 * 
	 * @return     string
	 */
	public function getAskerNickname()
	{
		return $this->asker_nickname;
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
	 * Get the [optionally formatted] temporal [started_at] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getStartedAt($format = 'Y-m-d H:i:s')
	{
		if ($this->started_at === null) {
			return null;
		}


		if ($this->started_at === '0000-00-00 00:00:00') {
			// while technically this is not a default value of NULL,
			// this seems to be closest in meaning.
			return null;
		} else {
			try {
				$dt = new DateTime($this->started_at);
			} catch (Exception $x) {
				throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->started_at, true), $x);
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
	 * Get the [optionally formatted] temporal [ended_at] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getEndedAt($format = 'Y-m-d H:i:s')
	{
		if ($this->ended_at === null) {
			return null;
		}


		if ($this->ended_at === '0000-00-00 00:00:00') {
			// while technically this is not a default value of NULL,
			// this seems to be closest in meaning.
			return null;
		} else {
			try {
				$dt = new DateTime($this->ended_at);
			} catch (Exception $x) {
				throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ended_at, true), $x);
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
	 * Get the [directory] column value.
	 * 
	 * @return     string
	 */
	public function getDirectory()
	{
		return $this->directory;
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
	 * Get the [timer] column value.
	 * 
	 * @return     string
	 */
	public function getTimer()
	{
		return $this->timer;
	}

	/**
	 * Get the [rating] column value.
	 * 
	 * @return     int
	 */
	public function getRating()
	{
		return $this->rating;
	}

	/**
	 * Get the [amount] column value.
	 * 
	 * @return     double
	 */
	public function getAmount()
	{
		return $this->amount;
	}

	/**
	 * Get the [comments] column value.
	 * 
	 * @return     string
	 */
	public function getComments()
	{
		return $this->comments;
	}

	/**
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     WhiteboardChat The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = WhiteboardChatPeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [is_public] column.
	 * 
	 * @param      int $v new value
	 * @return     WhiteboardChat The current object (for fluent API support)
	 */
	public function setIsPublic($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->is_public !== $v) {
			$this->is_public = $v;
			$this->modifiedColumns[] = WhiteboardChatPeer::IS_PUBLIC;
		}

		return $this;
	} // setIsPublic()

	/**
	 * Set the value of [expert_id] column.
	 * 
	 * @param      int $v new value
	 * @return     WhiteboardChat The current object (for fluent API support)
	 */
	public function setExpertId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->expert_id !== $v) {
			$this->expert_id = $v;
			$this->modifiedColumns[] = WhiteboardChatPeer::EXPERT_ID;
		}

		return $this;
	} // setExpertId()

	/**
	 * Set the value of [asker_id] column.
	 * 
	 * @param      int $v new value
	 * @return     WhiteboardChat The current object (for fluent API support)
	 */
	public function setAskerId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->asker_id !== $v) {
			$this->asker_id = $v;
			$this->modifiedColumns[] = WhiteboardChatPeer::ASKER_ID;
		}

		return $this;
	} // setAskerId()

	/**
	 * Set the value of [expert_nickname] column.
	 * 
	 * @param      string $v new value
	 * @return     WhiteboardChat The current object (for fluent API support)
	 */
	public function setExpertNickname($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->expert_nickname !== $v) {
			$this->expert_nickname = $v;
			$this->modifiedColumns[] = WhiteboardChatPeer::EXPERT_NICKNAME;
		}

		return $this;
	} // setExpertNickname()

	/**
	 * Set the value of [asker_nickname] column.
	 * 
	 * @param      string $v new value
	 * @return     WhiteboardChat The current object (for fluent API support)
	 */
	public function setAskerNickname($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->asker_nickname !== $v) {
			$this->asker_nickname = $v;
			$this->modifiedColumns[] = WhiteboardChatPeer::ASKER_NICKNAME;
		}

		return $this;
	} // setAskerNickname()

	/**
	 * Set the value of [question] column.
	 * 
	 * @param      string $v new value
	 * @return     WhiteboardChat The current object (for fluent API support)
	 */
	public function setQuestion($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->question !== $v) {
			$this->question = $v;
			$this->modifiedColumns[] = WhiteboardChatPeer::QUESTION;
		}

		return $this;
	} // setQuestion()

	/**
	 * Sets the value of [started_at] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     WhiteboardChat The current object (for fluent API support)
	 */
	public function setStartedAt($v)
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

		if ( $this->started_at !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->started_at !== null && $tmpDt = new DateTime($this->started_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d H:i:s') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->started_at = ($dt ? $dt->format('Y-m-d H:i:s') : null);
				$this->modifiedColumns[] = WhiteboardChatPeer::STARTED_AT;
			}
		} // if either are not null

		return $this;
	} // setStartedAt()

	/**
	 * Sets the value of [ended_at] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     WhiteboardChat The current object (for fluent API support)
	 */
	public function setEndedAt($v)
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

		if ( $this->ended_at !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->ended_at !== null && $tmpDt = new DateTime($this->ended_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d H:i:s') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->ended_at = ($dt ? $dt->format('Y-m-d H:i:s') : null);
				$this->modifiedColumns[] = WhiteboardChatPeer::ENDED_AT;
			}
		} // if either are not null

		return $this;
	} // setEndedAt()

	/**
	 * Set the value of [directory] column.
	 * 
	 * @param      string $v new value
	 * @return     WhiteboardChat The current object (for fluent API support)
	 */
	public function setDirectory($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->directory !== $v) {
			$this->directory = $v;
			$this->modifiedColumns[] = WhiteboardChatPeer::DIRECTORY;
		}

		return $this;
	} // setDirectory()

	/**
	 * Sets the value of [created_at] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     WhiteboardChat The current object (for fluent API support)
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
				$this->modifiedColumns[] = WhiteboardChatPeer::CREATED_AT;
			}
		} // if either are not null

		return $this;
	} // setCreatedAt()

	/**
	 * Set the value of [timer] column.
	 * 
	 * @param      string $v new value
	 * @return     WhiteboardChat The current object (for fluent API support)
	 */
	public function setTimer($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->timer !== $v) {
			$this->timer = $v;
			$this->modifiedColumns[] = WhiteboardChatPeer::TIMER;
		}

		return $this;
	} // setTimer()

	/**
	 * Set the value of [rating] column.
	 * 
	 * @param      int $v new value
	 * @return     WhiteboardChat The current object (for fluent API support)
	 */
	public function setRating($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->rating !== $v) {
			$this->rating = $v;
			$this->modifiedColumns[] = WhiteboardChatPeer::RATING;
		}

		return $this;
	} // setRating()

	/**
	 * Set the value of [amount] column.
	 * 
	 * @param      double $v new value
	 * @return     WhiteboardChat The current object (for fluent API support)
	 */
	public function setAmount($v)
	{
		if ($v !== null) {
			$v = (double) $v;
		}

		if ($this->amount !== $v) {
			$this->amount = $v;
			$this->modifiedColumns[] = WhiteboardChatPeer::AMOUNT;
		}

		return $this;
	} // setAmount()

	/**
	 * Set the value of [comments] column.
	 * 
	 * @param      string $v new value
	 * @return     WhiteboardChat The current object (for fluent API support)
	 */
	public function setComments($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->comments !== $v) {
			$this->comments = $v;
			$this->modifiedColumns[] = WhiteboardChatPeer::COMMENTS;
		}

		return $this;
	} // setComments()

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
			$this->is_public = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->expert_id = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->asker_id = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
			$this->expert_nickname = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->asker_nickname = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->question = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->started_at = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->ended_at = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->directory = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->created_at = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->timer = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
			$this->rating = ($row[$startcol + 12] !== null) ? (int) $row[$startcol + 12] : null;
			$this->amount = ($row[$startcol + 13] !== null) ? (double) $row[$startcol + 13] : null;
			$this->comments = ($row[$startcol + 14] !== null) ? (string) $row[$startcol + 14] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 15; // 15 = WhiteboardChatPeer::NUM_COLUMNS - WhiteboardChatPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating WhiteboardChat object", $e);
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
			$con = Propel::getConnection(WhiteboardChatPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = WhiteboardChatPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->collWhiteboardMessages = null;
			$this->lastWhiteboardMessageCriteria = null;

			$this->collWhiteboardSnapshots = null;
			$this->lastWhiteboardSnapshotCriteria = null;

			$this->collWhiteboardTutorFeedbacks = null;
			$this->lastWhiteboardTutorFeedbackCriteria = null;

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
			$con = Propel::getConnection(WhiteboardChatPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			WhiteboardChatPeer::doDelete($this, $con);
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
    if ($this->isNew() && !$this->isColumnModified(WhiteboardChatPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(WhiteboardChatPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			WhiteboardChatPeer::addInstanceToPool($this);
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
				$this->modifiedColumns[] = WhiteboardChatPeer::ID;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = WhiteboardChatPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += WhiteboardChatPeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collWhiteboardMessages !== null) {
				foreach ($this->collWhiteboardMessages as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collWhiteboardSnapshots !== null) {
				foreach ($this->collWhiteboardSnapshots as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collWhiteboardTutorFeedbacks !== null) {
				foreach ($this->collWhiteboardTutorFeedbacks as $referrerFK) {
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


			if (($retval = WhiteboardChatPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collWhiteboardMessages !== null) {
					foreach ($this->collWhiteboardMessages as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collWhiteboardSnapshots !== null) {
					foreach ($this->collWhiteboardSnapshots as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collWhiteboardTutorFeedbacks !== null) {
					foreach ($this->collWhiteboardTutorFeedbacks as $referrerFK) {
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
		$pos = WhiteboardChatPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getIsPublic();
				break;
			case 2:
				return $this->getExpertId();
				break;
			case 3:
				return $this->getAskerId();
				break;
			case 4:
				return $this->getExpertNickname();
				break;
			case 5:
				return $this->getAskerNickname();
				break;
			case 6:
				return $this->getQuestion();
				break;
			case 7:
				return $this->getStartedAt();
				break;
			case 8:
				return $this->getEndedAt();
				break;
			case 9:
				return $this->getDirectory();
				break;
			case 10:
				return $this->getCreatedAt();
				break;
			case 11:
				return $this->getTimer();
				break;
			case 12:
				return $this->getRating();
				break;
			case 13:
				return $this->getAmount();
				break;
			case 14:
				return $this->getComments();
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
		$keys = WhiteboardChatPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getIsPublic(),
			$keys[2] => $this->getExpertId(),
			$keys[3] => $this->getAskerId(),
			$keys[4] => $this->getExpertNickname(),
			$keys[5] => $this->getAskerNickname(),
			$keys[6] => $this->getQuestion(),
			$keys[7] => $this->getStartedAt(),
			$keys[8] => $this->getEndedAt(),
			$keys[9] => $this->getDirectory(),
			$keys[10] => $this->getCreatedAt(),
			$keys[11] => $this->getTimer(),
			$keys[12] => $this->getRating(),
			$keys[13] => $this->getAmount(),
			$keys[14] => $this->getComments(),
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
		$pos = WhiteboardChatPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setIsPublic($value);
				break;
			case 2:
				$this->setExpertId($value);
				break;
			case 3:
				$this->setAskerId($value);
				break;
			case 4:
				$this->setExpertNickname($value);
				break;
			case 5:
				$this->setAskerNickname($value);
				break;
			case 6:
				$this->setQuestion($value);
				break;
			case 7:
				$this->setStartedAt($value);
				break;
			case 8:
				$this->setEndedAt($value);
				break;
			case 9:
				$this->setDirectory($value);
				break;
			case 10:
				$this->setCreatedAt($value);
				break;
			case 11:
				$this->setTimer($value);
				break;
			case 12:
				$this->setRating($value);
				break;
			case 13:
				$this->setAmount($value);
				break;
			case 14:
				$this->setComments($value);
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
		$keys = WhiteboardChatPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setIsPublic($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setExpertId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setAskerId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setExpertNickname($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setAskerNickname($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setQuestion($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setStartedAt($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setEndedAt($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setDirectory($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCreatedAt($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setTimer($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setRating($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setAmount($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setComments($arr[$keys[14]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(WhiteboardChatPeer::DATABASE_NAME);

		if ($this->isColumnModified(WhiteboardChatPeer::ID)) $criteria->add(WhiteboardChatPeer::ID, $this->id);
		if ($this->isColumnModified(WhiteboardChatPeer::IS_PUBLIC)) $criteria->add(WhiteboardChatPeer::IS_PUBLIC, $this->is_public);
		if ($this->isColumnModified(WhiteboardChatPeer::EXPERT_ID)) $criteria->add(WhiteboardChatPeer::EXPERT_ID, $this->expert_id);
		if ($this->isColumnModified(WhiteboardChatPeer::ASKER_ID)) $criteria->add(WhiteboardChatPeer::ASKER_ID, $this->asker_id);
		if ($this->isColumnModified(WhiteboardChatPeer::EXPERT_NICKNAME)) $criteria->add(WhiteboardChatPeer::EXPERT_NICKNAME, $this->expert_nickname);
		if ($this->isColumnModified(WhiteboardChatPeer::ASKER_NICKNAME)) $criteria->add(WhiteboardChatPeer::ASKER_NICKNAME, $this->asker_nickname);
		if ($this->isColumnModified(WhiteboardChatPeer::QUESTION)) $criteria->add(WhiteboardChatPeer::QUESTION, $this->question);
		if ($this->isColumnModified(WhiteboardChatPeer::STARTED_AT)) $criteria->add(WhiteboardChatPeer::STARTED_AT, $this->started_at);
		if ($this->isColumnModified(WhiteboardChatPeer::ENDED_AT)) $criteria->add(WhiteboardChatPeer::ENDED_AT, $this->ended_at);
		if ($this->isColumnModified(WhiteboardChatPeer::DIRECTORY)) $criteria->add(WhiteboardChatPeer::DIRECTORY, $this->directory);
		if ($this->isColumnModified(WhiteboardChatPeer::CREATED_AT)) $criteria->add(WhiteboardChatPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(WhiteboardChatPeer::TIMER)) $criteria->add(WhiteboardChatPeer::TIMER, $this->timer);
		if ($this->isColumnModified(WhiteboardChatPeer::RATING)) $criteria->add(WhiteboardChatPeer::RATING, $this->rating);
		if ($this->isColumnModified(WhiteboardChatPeer::AMOUNT)) $criteria->add(WhiteboardChatPeer::AMOUNT, $this->amount);
		if ($this->isColumnModified(WhiteboardChatPeer::COMMENTS)) $criteria->add(WhiteboardChatPeer::COMMENTS, $this->comments);

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
		$criteria = new Criteria(WhiteboardChatPeer::DATABASE_NAME);

		$criteria->add(WhiteboardChatPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of WhiteboardChat (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setIsPublic($this->is_public);

		$copyObj->setExpertId($this->expert_id);

		$copyObj->setAskerId($this->asker_id);

		$copyObj->setExpertNickname($this->expert_nickname);

		$copyObj->setAskerNickname($this->asker_nickname);

		$copyObj->setQuestion($this->question);

		$copyObj->setStartedAt($this->started_at);

		$copyObj->setEndedAt($this->ended_at);

		$copyObj->setDirectory($this->directory);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setTimer($this->timer);

		$copyObj->setRating($this->rating);

		$copyObj->setAmount($this->amount);

		$copyObj->setComments($this->comments);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getWhiteboardMessages() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addWhiteboardMessage($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getWhiteboardSnapshots() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addWhiteboardSnapshot($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getWhiteboardTutorFeedbacks() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addWhiteboardTutorFeedback($relObj->copy($deepCopy));
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
	 * @return     WhiteboardChat Clone of current object.
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
	 * @return     WhiteboardChatPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new WhiteboardChatPeer();
		}
		return self::$peer;
	}

	/**
	 * Clears out the collWhiteboardMessages collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addWhiteboardMessages()
	 */
	public function clearWhiteboardMessages()
	{
		$this->collWhiteboardMessages = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collWhiteboardMessages collection (array).
	 *
	 * By default this just sets the collWhiteboardMessages collection to an empty array (like clearcollWhiteboardMessages());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initWhiteboardMessages()
	{
		$this->collWhiteboardMessages = array();
	}

	/**
	 * Gets an array of WhiteboardMessage objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this WhiteboardChat has previously been saved, it will retrieve
	 * related WhiteboardMessages from storage. If this WhiteboardChat is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array WhiteboardMessage[]
	 * @throws     PropelException
	 */
	public function getWhiteboardMessages($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(WhiteboardChatPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collWhiteboardMessages === null) {
			if ($this->isNew()) {
			   $this->collWhiteboardMessages = array();
			} else {

				$criteria->add(WhiteboardMessagePeer::WHITEBOARD_CHAT_ID, $this->id);

				WhiteboardMessagePeer::addSelectColumns($criteria);
				$this->collWhiteboardMessages = WhiteboardMessagePeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(WhiteboardMessagePeer::WHITEBOARD_CHAT_ID, $this->id);

				WhiteboardMessagePeer::addSelectColumns($criteria);
				if (!isset($this->lastWhiteboardMessageCriteria) || !$this->lastWhiteboardMessageCriteria->equals($criteria)) {
					$this->collWhiteboardMessages = WhiteboardMessagePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastWhiteboardMessageCriteria = $criteria;
		return $this->collWhiteboardMessages;
	}

	/**
	 * Returns the number of related WhiteboardMessage objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related WhiteboardMessage objects.
	 * @throws     PropelException
	 */
	public function countWhiteboardMessages(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(WhiteboardChatPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collWhiteboardMessages === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(WhiteboardMessagePeer::WHITEBOARD_CHAT_ID, $this->id);

				$count = WhiteboardMessagePeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(WhiteboardMessagePeer::WHITEBOARD_CHAT_ID, $this->id);

				if (!isset($this->lastWhiteboardMessageCriteria) || !$this->lastWhiteboardMessageCriteria->equals($criteria)) {
					$count = WhiteboardMessagePeer::doCount($criteria, $con);
				} else {
					$count = count($this->collWhiteboardMessages);
				}
			} else {
				$count = count($this->collWhiteboardMessages);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a WhiteboardMessage object to this object
	 * through the WhiteboardMessage foreign key attribute.
	 *
	 * @param      WhiteboardMessage $l WhiteboardMessage
	 * @return     void
	 * @throws     PropelException
	 */
	public function addWhiteboardMessage(WhiteboardMessage $l)
	{
		if ($this->collWhiteboardMessages === null) {
			$this->initWhiteboardMessages();
		}
		if (!in_array($l, $this->collWhiteboardMessages, true)) { // only add it if the **same** object is not already associated
			array_push($this->collWhiteboardMessages, $l);
			$l->setWhiteboardChat($this);
		}
	}

	/**
	 * Clears out the collWhiteboardSnapshots collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addWhiteboardSnapshots()
	 */
	public function clearWhiteboardSnapshots()
	{
		$this->collWhiteboardSnapshots = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collWhiteboardSnapshots collection (array).
	 *
	 * By default this just sets the collWhiteboardSnapshots collection to an empty array (like clearcollWhiteboardSnapshots());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initWhiteboardSnapshots()
	{
		$this->collWhiteboardSnapshots = array();
	}

	/**
	 * Gets an array of WhiteboardSnapshot objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this WhiteboardChat has previously been saved, it will retrieve
	 * related WhiteboardSnapshots from storage. If this WhiteboardChat is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array WhiteboardSnapshot[]
	 * @throws     PropelException
	 */
	public function getWhiteboardSnapshots($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(WhiteboardChatPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collWhiteboardSnapshots === null) {
			if ($this->isNew()) {
			   $this->collWhiteboardSnapshots = array();
			} else {

				$criteria->add(WhiteboardSnapshotPeer::WHITEBOARD_CHAT_ID, $this->id);

				WhiteboardSnapshotPeer::addSelectColumns($criteria);
				$this->collWhiteboardSnapshots = WhiteboardSnapshotPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(WhiteboardSnapshotPeer::WHITEBOARD_CHAT_ID, $this->id);

				WhiteboardSnapshotPeer::addSelectColumns($criteria);
				if (!isset($this->lastWhiteboardSnapshotCriteria) || !$this->lastWhiteboardSnapshotCriteria->equals($criteria)) {
					$this->collWhiteboardSnapshots = WhiteboardSnapshotPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastWhiteboardSnapshotCriteria = $criteria;
		return $this->collWhiteboardSnapshots;
	}

	/**
	 * Returns the number of related WhiteboardSnapshot objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related WhiteboardSnapshot objects.
	 * @throws     PropelException
	 */
	public function countWhiteboardSnapshots(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(WhiteboardChatPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collWhiteboardSnapshots === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(WhiteboardSnapshotPeer::WHITEBOARD_CHAT_ID, $this->id);

				$count = WhiteboardSnapshotPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(WhiteboardSnapshotPeer::WHITEBOARD_CHAT_ID, $this->id);

				if (!isset($this->lastWhiteboardSnapshotCriteria) || !$this->lastWhiteboardSnapshotCriteria->equals($criteria)) {
					$count = WhiteboardSnapshotPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collWhiteboardSnapshots);
				}
			} else {
				$count = count($this->collWhiteboardSnapshots);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a WhiteboardSnapshot object to this object
	 * through the WhiteboardSnapshot foreign key attribute.
	 *
	 * @param      WhiteboardSnapshot $l WhiteboardSnapshot
	 * @return     void
	 * @throws     PropelException
	 */
	public function addWhiteboardSnapshot(WhiteboardSnapshot $l)
	{
		if ($this->collWhiteboardSnapshots === null) {
			$this->initWhiteboardSnapshots();
		}
		if (!in_array($l, $this->collWhiteboardSnapshots, true)) { // only add it if the **same** object is not already associated
			array_push($this->collWhiteboardSnapshots, $l);
			$l->setWhiteboardChat($this);
		}
	}

	/**
	 * Clears out the collWhiteboardTutorFeedbacks collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addWhiteboardTutorFeedbacks()
	 */
	public function clearWhiteboardTutorFeedbacks()
	{
		$this->collWhiteboardTutorFeedbacks = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collWhiteboardTutorFeedbacks collection (array).
	 *
	 * By default this just sets the collWhiteboardTutorFeedbacks collection to an empty array (like clearcollWhiteboardTutorFeedbacks());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initWhiteboardTutorFeedbacks()
	{
		$this->collWhiteboardTutorFeedbacks = array();
	}

	/**
	 * Gets an array of WhiteboardTutorFeedback objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this WhiteboardChat has previously been saved, it will retrieve
	 * related WhiteboardTutorFeedbacks from storage. If this WhiteboardChat is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array WhiteboardTutorFeedback[]
	 * @throws     PropelException
	 */
	public function getWhiteboardTutorFeedbacks($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(WhiteboardChatPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collWhiteboardTutorFeedbacks === null) {
			if ($this->isNew()) {
			   $this->collWhiteboardTutorFeedbacks = array();
			} else {

				$criteria->add(WhiteboardTutorFeedbackPeer::WHITEBOARD_CHAT_ID, $this->id);

				WhiteboardTutorFeedbackPeer::addSelectColumns($criteria);
				$this->collWhiteboardTutorFeedbacks = WhiteboardTutorFeedbackPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(WhiteboardTutorFeedbackPeer::WHITEBOARD_CHAT_ID, $this->id);

				WhiteboardTutorFeedbackPeer::addSelectColumns($criteria);
				if (!isset($this->lastWhiteboardTutorFeedbackCriteria) || !$this->lastWhiteboardTutorFeedbackCriteria->equals($criteria)) {
					$this->collWhiteboardTutorFeedbacks = WhiteboardTutorFeedbackPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastWhiteboardTutorFeedbackCriteria = $criteria;
		return $this->collWhiteboardTutorFeedbacks;
	}

	/**
	 * Returns the number of related WhiteboardTutorFeedback objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related WhiteboardTutorFeedback objects.
	 * @throws     PropelException
	 */
	public function countWhiteboardTutorFeedbacks(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(WhiteboardChatPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collWhiteboardTutorFeedbacks === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(WhiteboardTutorFeedbackPeer::WHITEBOARD_CHAT_ID, $this->id);

				$count = WhiteboardTutorFeedbackPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(WhiteboardTutorFeedbackPeer::WHITEBOARD_CHAT_ID, $this->id);

				if (!isset($this->lastWhiteboardTutorFeedbackCriteria) || !$this->lastWhiteboardTutorFeedbackCriteria->equals($criteria)) {
					$count = WhiteboardTutorFeedbackPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collWhiteboardTutorFeedbacks);
				}
			} else {
				$count = count($this->collWhiteboardTutorFeedbacks);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a WhiteboardTutorFeedback object to this object
	 * through the WhiteboardTutorFeedback foreign key attribute.
	 *
	 * @param      WhiteboardTutorFeedback $l WhiteboardTutorFeedback
	 * @return     void
	 * @throws     PropelException
	 */
	public function addWhiteboardTutorFeedback(WhiteboardTutorFeedback $l)
	{
		if ($this->collWhiteboardTutorFeedbacks === null) {
			$this->initWhiteboardTutorFeedbacks();
		}
		if (!in_array($l, $this->collWhiteboardTutorFeedbacks, true)) { // only add it if the **same** object is not already associated
			array_push($this->collWhiteboardTutorFeedbacks, $l);
			$l->setWhiteboardChat($this);
		}
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
			if ($this->collWhiteboardMessages) {
				foreach ((array) $this->collWhiteboardMessages as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collWhiteboardSnapshots) {
				foreach ((array) $this->collWhiteboardSnapshots as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collWhiteboardTutorFeedbacks) {
				foreach ((array) $this->collWhiteboardTutorFeedbacks as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		$this->collWhiteboardMessages = null;
		$this->collWhiteboardSnapshots = null;
		$this->collWhiteboardTutorFeedbacks = null;
	}

} // BaseWhiteboardChat
