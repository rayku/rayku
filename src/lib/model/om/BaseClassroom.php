<?php

/**
 * Base class that represents a row from the 'classroom' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseClassroom extends BaseObject  implements Persistent {


  const PEER = 'ClassroomPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        ClassroomPeer
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
	 * The value for the category_id field.
	 * @var        int
	 */
	protected $category_id;

	/**
	 * The value for the classroom_banner field.
	 * @var        string
	 */
	protected $classroom_banner;

	/**
	 * The value for the fullname field.
	 * @var        string
	 */
	protected $fullname;

	/**
	 * The value for the shortname field.
	 * @var        string
	 */
	protected $shortname;

	/**
	 * The value for the class_username field.
	 * @var        string
	 */
	protected $class_username;

	/**
	 * The value for the email_passcode field.
	 * @var        string
	 */
	protected $email_passcode;

	/**
	 * The value for the classroom_email field.
	 * @var        string
	 */
	protected $classroom_email;

	/**
	 * The value for the live_webcam field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $live_webcam;

	/**
	 * The value for the email_updateblog field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $email_updateblog;

	/**
	 * The value for the school_name field.
	 * @var        string
	 */
	protected $school_name;

	/**
	 * The value for the location field.
	 * @var        string
	 */
	protected $location;

	/**
	 * The value for the idnumber field.
	 * @var        string
	 */
	protected $idnumber;

	/**
	 * The value for the summary field.
	 * @var        string
	 */
	protected $summary;

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
	 * @var        User
	 */
	protected $aUser;

	/**
	 * @var        array Assignment[] Collection to store aggregation of Assignment objects.
	 */
	protected $collAssignments;

	/**
	 * @var        Criteria The criteria used to select the current contents of collAssignments.
	 */
	private $lastAssignmentCriteria = null;

	/**
	 * @var        array ClassroomBlog[] Collection to store aggregation of ClassroomBlog objects.
	 */
	protected $collClassroomBlogs;

	/**
	 * @var        Criteria The criteria used to select the current contents of collClassroomBlogs.
	 */
	private $lastClassroomBlogCriteria = null;

	/**
	 * @var        array ClassroomMembers[] Collection to store aggregation of ClassroomMembers objects.
	 */
	protected $collClassroomMemberss;

	/**
	 * @var        Criteria The criteria used to select the current contents of collClassroomMemberss.
	 */
	private $lastClassroomMembersCriteria = null;

	/**
	 * @var        array Gallery[] Collection to store aggregation of Gallery objects.
	 */
	protected $collGallerys;

	/**
	 * @var        Criteria The criteria used to select the current contents of collGallerys.
	 */
	private $lastGalleryCriteria = null;

	/**
	 * @var        array StudentVoice[] Collection to store aggregation of StudentVoice objects.
	 */
	protected $collStudentVoices;

	/**
	 * @var        Criteria The criteria used to select the current contents of collStudentVoices.
	 */
	private $lastStudentVoiceCriteria = null;

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
	 * Initializes internal state of BaseClassroom object.
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
		$this->live_webcam = 0;
		$this->email_updateblog = 0;
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
	public function getUserId()
	{
		return $this->user_id;
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
	 * Get the [classroom_banner] column value.
	 * 
	 * @return     string
	 */
	public function getClassroomBanner()
	{
		return $this->classroom_banner;
	}

	/**
	 * Get the [fullname] column value.
	 * 
	 * @return     string
	 */
	public function getFullname()
	{
		return $this->fullname;
	}

	/**
	 * Get the [shortname] column value.
	 * 
	 * @return     string
	 */
	public function getShortname()
	{
		return $this->shortname;
	}

	/**
	 * Get the [class_username] column value.
	 * 
	 * @return     string
	 */
	public function getClassUsername()
	{
		return $this->class_username;
	}

	/**
	 * Get the [email_passcode] column value.
	 * 
	 * @return     string
	 */
	public function getEmailPasscode()
	{
		return $this->email_passcode;
	}

	/**
	 * Get the [classroom_email] column value.
	 * 
	 * @return     string
	 */
	public function getClassroomEmail()
	{
		return $this->classroom_email;
	}

	/**
	 * Get the [live_webcam] column value.
	 * 
	 * @return     int
	 */
	public function getLiveWebcam()
	{
		return $this->live_webcam;
	}

	/**
	 * Get the [email_updateblog] column value.
	 * 
	 * @return     int
	 */
	public function getEmailUpdateblog()
	{
		return $this->email_updateblog;
	}

	/**
	 * Get the [school_name] column value.
	 * 
	 * @return     string
	 */
	public function getSchoolName()
	{
		return $this->school_name;
	}

	/**
	 * Get the [location] column value.
	 * 
	 * @return     string
	 */
	public function getLocation()
	{
		return $this->location;
	}

	/**
	 * Get the [idnumber] column value.
	 * 
	 * @return     string
	 */
	public function getIdnumber()
	{
		return $this->idnumber;
	}

	/**
	 * Get the [summary] column value.
	 * 
	 * @return     string
	 */
	public function getSummary()
	{
		return $this->summary;
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
	 * @return     Classroom The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = ClassroomPeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [user_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Classroom The current object (for fluent API support)
	 */
	public function setUserId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->user_id !== $v) {
			$this->user_id = $v;
			$this->modifiedColumns[] = ClassroomPeer::USER_ID;
		}

		if ($this->aUser !== null && $this->aUser->getId() !== $v) {
			$this->aUser = null;
		}

		return $this;
	} // setUserId()

	/**
	 * Set the value of [category_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Classroom The current object (for fluent API support)
	 */
	public function setCategoryId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->category_id !== $v) {
			$this->category_id = $v;
			$this->modifiedColumns[] = ClassroomPeer::CATEGORY_ID;
		}

		return $this;
	} // setCategoryId()

	/**
	 * Set the value of [classroom_banner] column.
	 * 
	 * @param      string $v new value
	 * @return     Classroom The current object (for fluent API support)
	 */
	public function setClassroomBanner($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->classroom_banner !== $v) {
			$this->classroom_banner = $v;
			$this->modifiedColumns[] = ClassroomPeer::CLASSROOM_BANNER;
		}

		return $this;
	} // setClassroomBanner()

	/**
	 * Set the value of [fullname] column.
	 * 
	 * @param      string $v new value
	 * @return     Classroom The current object (for fluent API support)
	 */
	public function setFullname($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->fullname !== $v) {
			$this->fullname = $v;
			$this->modifiedColumns[] = ClassroomPeer::FULLNAME;
		}

		return $this;
	} // setFullname()

	/**
	 * Set the value of [shortname] column.
	 * 
	 * @param      string $v new value
	 * @return     Classroom The current object (for fluent API support)
	 */
	public function setShortname($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->shortname !== $v) {
			$this->shortname = $v;
			$this->modifiedColumns[] = ClassroomPeer::SHORTNAME;
		}

		return $this;
	} // setShortname()

	/**
	 * Set the value of [class_username] column.
	 * 
	 * @param      string $v new value
	 * @return     Classroom The current object (for fluent API support)
	 */
	public function setClassUsername($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->class_username !== $v) {
			$this->class_username = $v;
			$this->modifiedColumns[] = ClassroomPeer::CLASS_USERNAME;
		}

		return $this;
	} // setClassUsername()

	/**
	 * Set the value of [email_passcode] column.
	 * 
	 * @param      string $v new value
	 * @return     Classroom The current object (for fluent API support)
	 */
	public function setEmailPasscode($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->email_passcode !== $v) {
			$this->email_passcode = $v;
			$this->modifiedColumns[] = ClassroomPeer::EMAIL_PASSCODE;
		}

		return $this;
	} // setEmailPasscode()

	/**
	 * Set the value of [classroom_email] column.
	 * 
	 * @param      string $v new value
	 * @return     Classroom The current object (for fluent API support)
	 */
	public function setClassroomEmail($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->classroom_email !== $v) {
			$this->classroom_email = $v;
			$this->modifiedColumns[] = ClassroomPeer::CLASSROOM_EMAIL;
		}

		return $this;
	} // setClassroomEmail()

	/**
	 * Set the value of [live_webcam] column.
	 * 
	 * @param      int $v new value
	 * @return     Classroom The current object (for fluent API support)
	 */
	public function setLiveWebcam($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->live_webcam !== $v || $v === 0) {
			$this->live_webcam = $v;
			$this->modifiedColumns[] = ClassroomPeer::LIVE_WEBCAM;
		}

		return $this;
	} // setLiveWebcam()

	/**
	 * Set the value of [email_updateblog] column.
	 * 
	 * @param      int $v new value
	 * @return     Classroom The current object (for fluent API support)
	 */
	public function setEmailUpdateblog($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->email_updateblog !== $v || $v === 0) {
			$this->email_updateblog = $v;
			$this->modifiedColumns[] = ClassroomPeer::EMAIL_UPDATEBLOG;
		}

		return $this;
	} // setEmailUpdateblog()

	/**
	 * Set the value of [school_name] column.
	 * 
	 * @param      string $v new value
	 * @return     Classroom The current object (for fluent API support)
	 */
	public function setSchoolName($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->school_name !== $v) {
			$this->school_name = $v;
			$this->modifiedColumns[] = ClassroomPeer::SCHOOL_NAME;
		}

		return $this;
	} // setSchoolName()

	/**
	 * Set the value of [location] column.
	 * 
	 * @param      string $v new value
	 * @return     Classroom The current object (for fluent API support)
	 */
	public function setLocation($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->location !== $v) {
			$this->location = $v;
			$this->modifiedColumns[] = ClassroomPeer::LOCATION;
		}

		return $this;
	} // setLocation()

	/**
	 * Set the value of [idnumber] column.
	 * 
	 * @param      string $v new value
	 * @return     Classroom The current object (for fluent API support)
	 */
	public function setIdnumber($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->idnumber !== $v) {
			$this->idnumber = $v;
			$this->modifiedColumns[] = ClassroomPeer::IDNUMBER;
		}

		return $this;
	} // setIdnumber()

	/**
	 * Set the value of [summary] column.
	 * 
	 * @param      string $v new value
	 * @return     Classroom The current object (for fluent API support)
	 */
	public function setSummary($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->summary !== $v) {
			$this->summary = $v;
			$this->modifiedColumns[] = ClassroomPeer::SUMMARY;
		}

		return $this;
	} // setSummary()

	/**
	 * Sets the value of [created_at] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     Classroom The current object (for fluent API support)
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
				$this->modifiedColumns[] = ClassroomPeer::CREATED_AT;
			}
		} // if either are not null

		return $this;
	} // setCreatedAt()

	/**
	 * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     Classroom The current object (for fluent API support)
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
				$this->modifiedColumns[] = ClassroomPeer::UPDATED_AT;
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
			if (array_diff($this->modifiedColumns, array(ClassroomPeer::LIVE_WEBCAM,ClassroomPeer::EMAIL_UPDATEBLOG))) {
				return false;
			}

			if ($this->live_webcam !== 0) {
				return false;
			}

			if ($this->email_updateblog !== 0) {
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
			$this->category_id = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->classroom_banner = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->fullname = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->shortname = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->class_username = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->email_passcode = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->classroom_email = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->live_webcam = ($row[$startcol + 9] !== null) ? (int) $row[$startcol + 9] : null;
			$this->email_updateblog = ($row[$startcol + 10] !== null) ? (int) $row[$startcol + 10] : null;
			$this->school_name = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
			$this->location = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
			$this->idnumber = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
			$this->summary = ($row[$startcol + 14] !== null) ? (string) $row[$startcol + 14] : null;
			$this->created_at = ($row[$startcol + 15] !== null) ? (string) $row[$startcol + 15] : null;
			$this->updated_at = ($row[$startcol + 16] !== null) ? (string) $row[$startcol + 16] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 17; // 17 = ClassroomPeer::NUM_COLUMNS - ClassroomPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating Classroom object", $e);
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

		if ($this->aUser !== null && $this->user_id !== $this->aUser->getId()) {
			$this->aUser = null;
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
			$con = Propel::getConnection(ClassroomPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = ClassroomPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aUser = null;
			$this->collAssignments = null;
			$this->lastAssignmentCriteria = null;

			$this->collClassroomBlogs = null;
			$this->lastClassroomBlogCriteria = null;

			$this->collClassroomMemberss = null;
			$this->lastClassroomMembersCriteria = null;

			$this->collGallerys = null;
			$this->lastGalleryCriteria = null;

			$this->collStudentVoices = null;
			$this->lastStudentVoiceCriteria = null;

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
			$con = Propel::getConnection(ClassroomPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			ClassroomPeer::doDelete($this, $con);
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
    if ($this->isNew() && !$this->isColumnModified(ClassroomPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(ClassroomPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ClassroomPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			ClassroomPeer::addInstanceToPool($this);
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

			if ($this->aUser !== null) {
				if ($this->aUser->isModified() || $this->aUser->isNew()) {
					$affectedRows += $this->aUser->save($con);
				}
				$this->setUser($this->aUser);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = ClassroomPeer::ID;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = ClassroomPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += ClassroomPeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collAssignments !== null) {
				foreach ($this->collAssignments as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collClassroomBlogs !== null) {
				foreach ($this->collClassroomBlogs as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collClassroomMemberss !== null) {
				foreach ($this->collClassroomMemberss as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collGallerys !== null) {
				foreach ($this->collGallerys as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collStudentVoices !== null) {
				foreach ($this->collStudentVoices as $referrerFK) {
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

			if ($this->aUser !== null) {
				if (!$this->aUser->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUser->getValidationFailures());
				}
			}


			if (($retval = ClassroomPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collAssignments !== null) {
					foreach ($this->collAssignments as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collClassroomBlogs !== null) {
					foreach ($this->collClassroomBlogs as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collClassroomMemberss !== null) {
					foreach ($this->collClassroomMemberss as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collGallerys !== null) {
					foreach ($this->collGallerys as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collStudentVoices !== null) {
					foreach ($this->collStudentVoices as $referrerFK) {
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
		$pos = ClassroomPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getUserId();
				break;
			case 2:
				return $this->getCategoryId();
				break;
			case 3:
				return $this->getClassroomBanner();
				break;
			case 4:
				return $this->getFullname();
				break;
			case 5:
				return $this->getShortname();
				break;
			case 6:
				return $this->getClassUsername();
				break;
			case 7:
				return $this->getEmailPasscode();
				break;
			case 8:
				return $this->getClassroomEmail();
				break;
			case 9:
				return $this->getLiveWebcam();
				break;
			case 10:
				return $this->getEmailUpdateblog();
				break;
			case 11:
				return $this->getSchoolName();
				break;
			case 12:
				return $this->getLocation();
				break;
			case 13:
				return $this->getIdnumber();
				break;
			case 14:
				return $this->getSummary();
				break;
			case 15:
				return $this->getCreatedAt();
				break;
			case 16:
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
		$keys = ClassroomPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getUserId(),
			$keys[2] => $this->getCategoryId(),
			$keys[3] => $this->getClassroomBanner(),
			$keys[4] => $this->getFullname(),
			$keys[5] => $this->getShortname(),
			$keys[6] => $this->getClassUsername(),
			$keys[7] => $this->getEmailPasscode(),
			$keys[8] => $this->getClassroomEmail(),
			$keys[9] => $this->getLiveWebcam(),
			$keys[10] => $this->getEmailUpdateblog(),
			$keys[11] => $this->getSchoolName(),
			$keys[12] => $this->getLocation(),
			$keys[13] => $this->getIdnumber(),
			$keys[14] => $this->getSummary(),
			$keys[15] => $this->getCreatedAt(),
			$keys[16] => $this->getUpdatedAt(),
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
		$pos = ClassroomPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setUserId($value);
				break;
			case 2:
				$this->setCategoryId($value);
				break;
			case 3:
				$this->setClassroomBanner($value);
				break;
			case 4:
				$this->setFullname($value);
				break;
			case 5:
				$this->setShortname($value);
				break;
			case 6:
				$this->setClassUsername($value);
				break;
			case 7:
				$this->setEmailPasscode($value);
				break;
			case 8:
				$this->setClassroomEmail($value);
				break;
			case 9:
				$this->setLiveWebcam($value);
				break;
			case 10:
				$this->setEmailUpdateblog($value);
				break;
			case 11:
				$this->setSchoolName($value);
				break;
			case 12:
				$this->setLocation($value);
				break;
			case 13:
				$this->setIdnumber($value);
				break;
			case 14:
				$this->setSummary($value);
				break;
			case 15:
				$this->setCreatedAt($value);
				break;
			case 16:
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
		$keys = ClassroomPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setUserId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCategoryId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setClassroomBanner($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setFullname($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setShortname($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setClassUsername($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setEmailPasscode($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setClassroomEmail($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setLiveWebcam($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setEmailUpdateblog($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setSchoolName($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setLocation($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setIdnumber($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setSummary($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setCreatedAt($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setUpdatedAt($arr[$keys[16]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(ClassroomPeer::DATABASE_NAME);

		if ($this->isColumnModified(ClassroomPeer::ID)) $criteria->add(ClassroomPeer::ID, $this->id);
		if ($this->isColumnModified(ClassroomPeer::USER_ID)) $criteria->add(ClassroomPeer::USER_ID, $this->user_id);
		if ($this->isColumnModified(ClassroomPeer::CATEGORY_ID)) $criteria->add(ClassroomPeer::CATEGORY_ID, $this->category_id);
		if ($this->isColumnModified(ClassroomPeer::CLASSROOM_BANNER)) $criteria->add(ClassroomPeer::CLASSROOM_BANNER, $this->classroom_banner);
		if ($this->isColumnModified(ClassroomPeer::FULLNAME)) $criteria->add(ClassroomPeer::FULLNAME, $this->fullname);
		if ($this->isColumnModified(ClassroomPeer::SHORTNAME)) $criteria->add(ClassroomPeer::SHORTNAME, $this->shortname);
		if ($this->isColumnModified(ClassroomPeer::CLASS_USERNAME)) $criteria->add(ClassroomPeer::CLASS_USERNAME, $this->class_username);
		if ($this->isColumnModified(ClassroomPeer::EMAIL_PASSCODE)) $criteria->add(ClassroomPeer::EMAIL_PASSCODE, $this->email_passcode);
		if ($this->isColumnModified(ClassroomPeer::CLASSROOM_EMAIL)) $criteria->add(ClassroomPeer::CLASSROOM_EMAIL, $this->classroom_email);
		if ($this->isColumnModified(ClassroomPeer::LIVE_WEBCAM)) $criteria->add(ClassroomPeer::LIVE_WEBCAM, $this->live_webcam);
		if ($this->isColumnModified(ClassroomPeer::EMAIL_UPDATEBLOG)) $criteria->add(ClassroomPeer::EMAIL_UPDATEBLOG, $this->email_updateblog);
		if ($this->isColumnModified(ClassroomPeer::SCHOOL_NAME)) $criteria->add(ClassroomPeer::SCHOOL_NAME, $this->school_name);
		if ($this->isColumnModified(ClassroomPeer::LOCATION)) $criteria->add(ClassroomPeer::LOCATION, $this->location);
		if ($this->isColumnModified(ClassroomPeer::IDNUMBER)) $criteria->add(ClassroomPeer::IDNUMBER, $this->idnumber);
		if ($this->isColumnModified(ClassroomPeer::SUMMARY)) $criteria->add(ClassroomPeer::SUMMARY, $this->summary);
		if ($this->isColumnModified(ClassroomPeer::CREATED_AT)) $criteria->add(ClassroomPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(ClassroomPeer::UPDATED_AT)) $criteria->add(ClassroomPeer::UPDATED_AT, $this->updated_at);

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
		$criteria = new Criteria(ClassroomPeer::DATABASE_NAME);

		$criteria->add(ClassroomPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of Classroom (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setUserId($this->user_id);

		$copyObj->setCategoryId($this->category_id);

		$copyObj->setClassroomBanner($this->classroom_banner);

		$copyObj->setFullname($this->fullname);

		$copyObj->setShortname($this->shortname);

		$copyObj->setClassUsername($this->class_username);

		$copyObj->setEmailPasscode($this->email_passcode);

		$copyObj->setClassroomEmail($this->classroom_email);

		$copyObj->setLiveWebcam($this->live_webcam);

		$copyObj->setEmailUpdateblog($this->email_updateblog);

		$copyObj->setSchoolName($this->school_name);

		$copyObj->setLocation($this->location);

		$copyObj->setIdnumber($this->idnumber);

		$copyObj->setSummary($this->summary);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getAssignments() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addAssignment($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getClassroomBlogs() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addClassroomBlog($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getClassroomMemberss() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addClassroomMembers($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getGallerys() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addGallery($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getStudentVoices() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addStudentVoice($relObj->copy($deepCopy));
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
	 * @return     Classroom Clone of current object.
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
	 * @return     ClassroomPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new ClassroomPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a User object.
	 *
	 * @param      User $v
	 * @return     Classroom The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setUser(User $v = null)
	{
		if ($v === null) {
			$this->setUserId(NULL);
		} else {
			$this->setUserId($v->getId());
		}

		$this->aUser = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the User object, it will not be re-added.
		if ($v !== null) {
			$v->addClassroom($this);
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
	public function getUser(PropelPDO $con = null)
	{
		if ($this->aUser === null && ($this->user_id !== null)) {
			$c = new Criteria(UserPeer::DATABASE_NAME);
			$c->add(UserPeer::ID, $this->user_id);
			$this->aUser = UserPeer::doSelectOne($c, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aUser->addClassrooms($this);
			 */
		}
		return $this->aUser;
	}

	/**
	 * Clears out the collAssignments collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addAssignments()
	 */
	public function clearAssignments()
	{
		$this->collAssignments = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collAssignments collection (array).
	 *
	 * By default this just sets the collAssignments collection to an empty array (like clearcollAssignments());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initAssignments()
	{
		$this->collAssignments = array();
	}

	/**
	 * Gets an array of Assignment objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Classroom has previously been saved, it will retrieve
	 * related Assignments from storage. If this Classroom is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array Assignment[]
	 * @throws     PropelException
	 */
	public function getAssignments($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ClassroomPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAssignments === null) {
			if ($this->isNew()) {
			   $this->collAssignments = array();
			} else {

				$criteria->add(AssignmentPeer::CLASSROOM_ID, $this->id);

				AssignmentPeer::addSelectColumns($criteria);
				$this->collAssignments = AssignmentPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(AssignmentPeer::CLASSROOM_ID, $this->id);

				AssignmentPeer::addSelectColumns($criteria);
				if (!isset($this->lastAssignmentCriteria) || !$this->lastAssignmentCriteria->equals($criteria)) {
					$this->collAssignments = AssignmentPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastAssignmentCriteria = $criteria;
		return $this->collAssignments;
	}

	/**
	 * Returns the number of related Assignment objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related Assignment objects.
	 * @throws     PropelException
	 */
	public function countAssignments(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ClassroomPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collAssignments === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(AssignmentPeer::CLASSROOM_ID, $this->id);

				$count = AssignmentPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(AssignmentPeer::CLASSROOM_ID, $this->id);

				if (!isset($this->lastAssignmentCriteria) || !$this->lastAssignmentCriteria->equals($criteria)) {
					$count = AssignmentPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collAssignments);
				}
			} else {
				$count = count($this->collAssignments);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a Assignment object to this object
	 * through the Assignment foreign key attribute.
	 *
	 * @param      Assignment $l Assignment
	 * @return     void
	 * @throws     PropelException
	 */
	public function addAssignment(Assignment $l)
	{
		if ($this->collAssignments === null) {
			$this->initAssignments();
		}
		if (!in_array($l, $this->collAssignments, true)) { // only add it if the **same** object is not already associated
			array_push($this->collAssignments, $l);
			$l->setClassroom($this);
		}
	}

	/**
	 * Clears out the collClassroomBlogs collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addClassroomBlogs()
	 */
	public function clearClassroomBlogs()
	{
		$this->collClassroomBlogs = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collClassroomBlogs collection (array).
	 *
	 * By default this just sets the collClassroomBlogs collection to an empty array (like clearcollClassroomBlogs());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initClassroomBlogs()
	{
		$this->collClassroomBlogs = array();
	}

	/**
	 * Gets an array of ClassroomBlog objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Classroom has previously been saved, it will retrieve
	 * related ClassroomBlogs from storage. If this Classroom is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array ClassroomBlog[]
	 * @throws     PropelException
	 */
	public function getClassroomBlogs($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ClassroomPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collClassroomBlogs === null) {
			if ($this->isNew()) {
			   $this->collClassroomBlogs = array();
			} else {

				$criteria->add(ClassroomBlogPeer::CLASSROOM_ID, $this->id);

				ClassroomBlogPeer::addSelectColumns($criteria);
				$this->collClassroomBlogs = ClassroomBlogPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ClassroomBlogPeer::CLASSROOM_ID, $this->id);

				ClassroomBlogPeer::addSelectColumns($criteria);
				if (!isset($this->lastClassroomBlogCriteria) || !$this->lastClassroomBlogCriteria->equals($criteria)) {
					$this->collClassroomBlogs = ClassroomBlogPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastClassroomBlogCriteria = $criteria;
		return $this->collClassroomBlogs;
	}

	/**
	 * Returns the number of related ClassroomBlog objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related ClassroomBlog objects.
	 * @throws     PropelException
	 */
	public function countClassroomBlogs(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ClassroomPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collClassroomBlogs === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(ClassroomBlogPeer::CLASSROOM_ID, $this->id);

				$count = ClassroomBlogPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(ClassroomBlogPeer::CLASSROOM_ID, $this->id);

				if (!isset($this->lastClassroomBlogCriteria) || !$this->lastClassroomBlogCriteria->equals($criteria)) {
					$count = ClassroomBlogPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collClassroomBlogs);
				}
			} else {
				$count = count($this->collClassroomBlogs);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a ClassroomBlog object to this object
	 * through the ClassroomBlog foreign key attribute.
	 *
	 * @param      ClassroomBlog $l ClassroomBlog
	 * @return     void
	 * @throws     PropelException
	 */
	public function addClassroomBlog(ClassroomBlog $l)
	{
		if ($this->collClassroomBlogs === null) {
			$this->initClassroomBlogs();
		}
		if (!in_array($l, $this->collClassroomBlogs, true)) { // only add it if the **same** object is not already associated
			array_push($this->collClassroomBlogs, $l);
			$l->setClassroom($this);
		}
	}

	/**
	 * Clears out the collClassroomMemberss collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addClassroomMemberss()
	 */
	public function clearClassroomMemberss()
	{
		$this->collClassroomMemberss = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collClassroomMemberss collection (array).
	 *
	 * By default this just sets the collClassroomMemberss collection to an empty array (like clearcollClassroomMemberss());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initClassroomMemberss()
	{
		$this->collClassroomMemberss = array();
	}

	/**
	 * Gets an array of ClassroomMembers objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Classroom has previously been saved, it will retrieve
	 * related ClassroomMemberss from storage. If this Classroom is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array ClassroomMembers[]
	 * @throws     PropelException
	 */
	public function getClassroomMemberss($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ClassroomPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collClassroomMemberss === null) {
			if ($this->isNew()) {
			   $this->collClassroomMemberss = array();
			} else {

				$criteria->add(ClassroomMembersPeer::CLASSROOM_ID, $this->id);

				ClassroomMembersPeer::addSelectColumns($criteria);
				$this->collClassroomMemberss = ClassroomMembersPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ClassroomMembersPeer::CLASSROOM_ID, $this->id);

				ClassroomMembersPeer::addSelectColumns($criteria);
				if (!isset($this->lastClassroomMembersCriteria) || !$this->lastClassroomMembersCriteria->equals($criteria)) {
					$this->collClassroomMemberss = ClassroomMembersPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastClassroomMembersCriteria = $criteria;
		return $this->collClassroomMemberss;
	}

	/**
	 * Returns the number of related ClassroomMembers objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related ClassroomMembers objects.
	 * @throws     PropelException
	 */
	public function countClassroomMemberss(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ClassroomPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collClassroomMemberss === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(ClassroomMembersPeer::CLASSROOM_ID, $this->id);

				$count = ClassroomMembersPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(ClassroomMembersPeer::CLASSROOM_ID, $this->id);

				if (!isset($this->lastClassroomMembersCriteria) || !$this->lastClassroomMembersCriteria->equals($criteria)) {
					$count = ClassroomMembersPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collClassroomMemberss);
				}
			} else {
				$count = count($this->collClassroomMemberss);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a ClassroomMembers object to this object
	 * through the ClassroomMembers foreign key attribute.
	 *
	 * @param      ClassroomMembers $l ClassroomMembers
	 * @return     void
	 * @throws     PropelException
	 */
	public function addClassroomMembers(ClassroomMembers $l)
	{
		if ($this->collClassroomMemberss === null) {
			$this->initClassroomMemberss();
		}
		if (!in_array($l, $this->collClassroomMemberss, true)) { // only add it if the **same** object is not already associated
			array_push($this->collClassroomMemberss, $l);
			$l->setClassroom($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Classroom is new, it will return
	 * an empty collection; or if this Classroom has previously
	 * been saved, it will retrieve related ClassroomMemberss from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Classroom.
	 */
	public function getClassroomMemberssJoinUser($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ClassroomPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collClassroomMemberss === null) {
			if ($this->isNew()) {
				$this->collClassroomMemberss = array();
			} else {

				$criteria->add(ClassroomMembersPeer::CLASSROOM_ID, $this->id);

				$this->collClassroomMemberss = ClassroomMembersPeer::doSelectJoinUser($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ClassroomMembersPeer::CLASSROOM_ID, $this->id);

			if (!isset($this->lastClassroomMembersCriteria) || !$this->lastClassroomMembersCriteria->equals($criteria)) {
				$this->collClassroomMemberss = ClassroomMembersPeer::doSelectJoinUser($criteria, $con, $join_behavior);
			}
		}
		$this->lastClassroomMembersCriteria = $criteria;

		return $this->collClassroomMemberss;
	}

	/**
	 * Clears out the collGallerys collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addGallerys()
	 */
	public function clearGallerys()
	{
		$this->collGallerys = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collGallerys collection (array).
	 *
	 * By default this just sets the collGallerys collection to an empty array (like clearcollGallerys());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initGallerys()
	{
		$this->collGallerys = array();
	}

	/**
	 * Gets an array of Gallery objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Classroom has previously been saved, it will retrieve
	 * related Gallerys from storage. If this Classroom is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array Gallery[]
	 * @throws     PropelException
	 */
	public function getGallerys($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ClassroomPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collGallerys === null) {
			if ($this->isNew()) {
			   $this->collGallerys = array();
			} else {

				$criteria->add(GalleryPeer::CLASSROOM_ID, $this->id);

				GalleryPeer::addSelectColumns($criteria);
				$this->collGallerys = GalleryPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(GalleryPeer::CLASSROOM_ID, $this->id);

				GalleryPeer::addSelectColumns($criteria);
				if (!isset($this->lastGalleryCriteria) || !$this->lastGalleryCriteria->equals($criteria)) {
					$this->collGallerys = GalleryPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastGalleryCriteria = $criteria;
		return $this->collGallerys;
	}

	/**
	 * Returns the number of related Gallery objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related Gallery objects.
	 * @throws     PropelException
	 */
	public function countGallerys(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ClassroomPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collGallerys === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(GalleryPeer::CLASSROOM_ID, $this->id);

				$count = GalleryPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(GalleryPeer::CLASSROOM_ID, $this->id);

				if (!isset($this->lastGalleryCriteria) || !$this->lastGalleryCriteria->equals($criteria)) {
					$count = GalleryPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collGallerys);
				}
			} else {
				$count = count($this->collGallerys);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a Gallery object to this object
	 * through the Gallery foreign key attribute.
	 *
	 * @param      Gallery $l Gallery
	 * @return     void
	 * @throws     PropelException
	 */
	public function addGallery(Gallery $l)
	{
		if ($this->collGallerys === null) {
			$this->initGallerys();
		}
		if (!in_array($l, $this->collGallerys, true)) { // only add it if the **same** object is not already associated
			array_push($this->collGallerys, $l);
			$l->setClassroom($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Classroom is new, it will return
	 * an empty collection; or if this Classroom has previously
	 * been saved, it will retrieve related Gallerys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Classroom.
	 */
	public function getGallerysJoinUser($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ClassroomPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collGallerys === null) {
			if ($this->isNew()) {
				$this->collGallerys = array();
			} else {

				$criteria->add(GalleryPeer::CLASSROOM_ID, $this->id);

				$this->collGallerys = GalleryPeer::doSelectJoinUser($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(GalleryPeer::CLASSROOM_ID, $this->id);

			if (!isset($this->lastGalleryCriteria) || !$this->lastGalleryCriteria->equals($criteria)) {
				$this->collGallerys = GalleryPeer::doSelectJoinUser($criteria, $con, $join_behavior);
			}
		}
		$this->lastGalleryCriteria = $criteria;

		return $this->collGallerys;
	}

	/**
	 * Clears out the collStudentVoices collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addStudentVoices()
	 */
	public function clearStudentVoices()
	{
		$this->collStudentVoices = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collStudentVoices collection (array).
	 *
	 * By default this just sets the collStudentVoices collection to an empty array (like clearcollStudentVoices());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initStudentVoices()
	{
		$this->collStudentVoices = array();
	}

	/**
	 * Gets an array of StudentVoice objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Classroom has previously been saved, it will retrieve
	 * related StudentVoices from storage. If this Classroom is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array StudentVoice[]
	 * @throws     PropelException
	 */
	public function getStudentVoices($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ClassroomPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collStudentVoices === null) {
			if ($this->isNew()) {
			   $this->collStudentVoices = array();
			} else {

				$criteria->add(StudentVoicePeer::CLASSROOM_ID, $this->id);

				StudentVoicePeer::addSelectColumns($criteria);
				$this->collStudentVoices = StudentVoicePeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(StudentVoicePeer::CLASSROOM_ID, $this->id);

				StudentVoicePeer::addSelectColumns($criteria);
				if (!isset($this->lastStudentVoiceCriteria) || !$this->lastStudentVoiceCriteria->equals($criteria)) {
					$this->collStudentVoices = StudentVoicePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastStudentVoiceCriteria = $criteria;
		return $this->collStudentVoices;
	}

	/**
	 * Returns the number of related StudentVoice objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related StudentVoice objects.
	 * @throws     PropelException
	 */
	public function countStudentVoices(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ClassroomPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collStudentVoices === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(StudentVoicePeer::CLASSROOM_ID, $this->id);

				$count = StudentVoicePeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(StudentVoicePeer::CLASSROOM_ID, $this->id);

				if (!isset($this->lastStudentVoiceCriteria) || !$this->lastStudentVoiceCriteria->equals($criteria)) {
					$count = StudentVoicePeer::doCount($criteria, $con);
				} else {
					$count = count($this->collStudentVoices);
				}
			} else {
				$count = count($this->collStudentVoices);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a StudentVoice object to this object
	 * through the StudentVoice foreign key attribute.
	 *
	 * @param      StudentVoice $l StudentVoice
	 * @return     void
	 * @throws     PropelException
	 */
	public function addStudentVoice(StudentVoice $l)
	{
		if ($this->collStudentVoices === null) {
			$this->initStudentVoices();
		}
		if (!in_array($l, $this->collStudentVoices, true)) { // only add it if the **same** object is not already associated
			array_push($this->collStudentVoices, $l);
			$l->setClassroom($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Classroom is new, it will return
	 * an empty collection; or if this Classroom has previously
	 * been saved, it will retrieve related StudentVoices from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Classroom.
	 */
	public function getStudentVoicesJoinUser($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ClassroomPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collStudentVoices === null) {
			if ($this->isNew()) {
				$this->collStudentVoices = array();
			} else {

				$criteria->add(StudentVoicePeer::CLASSROOM_ID, $this->id);

				$this->collStudentVoices = StudentVoicePeer::doSelectJoinUser($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(StudentVoicePeer::CLASSROOM_ID, $this->id);

			if (!isset($this->lastStudentVoiceCriteria) || !$this->lastStudentVoiceCriteria->equals($criteria)) {
				$this->collStudentVoices = StudentVoicePeer::doSelectJoinUser($criteria, $con, $join_behavior);
			}
		}
		$this->lastStudentVoiceCriteria = $criteria;

		return $this->collStudentVoices;
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
			if ($this->collAssignments) {
				foreach ((array) $this->collAssignments as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collClassroomBlogs) {
				foreach ((array) $this->collClassroomBlogs as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collClassroomMemberss) {
				foreach ((array) $this->collClassroomMemberss as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collGallerys) {
				foreach ((array) $this->collGallerys as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collStudentVoices) {
				foreach ((array) $this->collStudentVoices as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		$this->collAssignments = null;
		$this->collClassroomBlogs = null;
		$this->collClassroomMemberss = null;
		$this->collGallerys = null;
		$this->collStudentVoices = null;
			$this->aUser = null;
	}

} // BaseClassroom
