<?php

/**
 * Base class that represents a row from the 'user' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseUser extends BaseObject  implements Persistent {


  const PEER = 'UserPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        UserPeer
	 */
	protected static $peer;

	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;

	/**
	 * The value for the username field.
	 * @var        string
	 */
	protected $username;

	/**
	 * The value for the email field.
	 * @var        string
	 */
	protected $email;

	/**
	 * The value for the password field.
	 * @var        string
	 */
	protected $password;

	/**
	 * The value for the points field.
	 * Note: this column has a database default value of: '0'
	 * @var        string
	 */
	protected $points;

	/**
	 * The value for the created_at field.
	 * @var        string
	 */
	protected $created_at;

	/**
	 * The value for the last_activity_at field.
	 * @var        string
	 */
	protected $last_activity_at;

	/**
	 * The value for the type field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $type;

	/**
	 * The value for the hidden field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $hidden;

	/**
	 * The value for the name field.
	 * @var        string
	 */
	protected $name;

	/**
	 * The value for the gender field.
	 * @var        int
	 */
	protected $gender;

	/**
	 * The value for the hometown field.
	 * @var        string
	 */
	protected $hometown;

	/**
	 * The value for the home_phone field.
	 * @var        string
	 */
	protected $home_phone;

	/**
	 * The value for the mobile_phone field.
	 * @var        string
	 */
	protected $mobile_phone;

	/**
	 * The value for the birthdate field.
	 * @var        string
	 */
	protected $birthdate;

	/**
	 * The value for the address field.
	 * @var        string
	 */
	protected $address;

	/**
	 * The value for the relationship_status field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $relationship_status;

	/**
	 * The value for the show_email field.
	 * Note: this column has a database default value of: 1
	 * @var        int
	 */
	protected $show_email;

	/**
	 * The value for the show_gender field.
	 * Note: this column has a database default value of: 1
	 * @var        int
	 */
	protected $show_gender;

	/**
	 * The value for the show_hometown field.
	 * Note: this column has a database default value of: 1
	 * @var        int
	 */
	protected $show_hometown;

	/**
	 * The value for the show_home_phone field.
	 * Note: this column has a database default value of: 1
	 * @var        int
	 */
	protected $show_home_phone;

	/**
	 * The value for the show_mobile_phone field.
	 * Note: this column has a database default value of: 1
	 * @var        int
	 */
	protected $show_mobile_phone;

	/**
	 * The value for the show_birthdate field.
	 * Note: this column has a database default value of: 1
	 * @var        int
	 */
	protected $show_birthdate;

	/**
	 * The value for the show_address field.
	 * Note: this column has a database default value of: 1
	 * @var        int
	 */
	protected $show_address;

	/**
	 * The value for the show_relationship_status field.
	 * Note: this column has a database default value of: 1
	 * @var        int
	 */
	protected $show_relationship_status;

	/**
	 * The value for the password_recover_key field.
	 * @var        string
	 */
	protected $password_recover_key;

	/**
	 * The value for the cookie_key field.
	 * @var        string
	 */
	protected $cookie_key;

	/**
	 * The value for the credit field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $credit;

	/**
	 * The value for the invisible field.
	 * @var        int
	 */
	protected $invisible;

	/**
	 * The value for the notification field.
	 * @var        string
	 */
	protected $notification;

	/**
	 * The value for the phone_number field.
	 * @var        string
	 */
	protected $phone_number;

	/**
	 * The value for the login field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $login;

	/**
	 * The value for the credit_card field.
	 * @var        string
	 */
	protected $credit_card;

	/**
	 * The value for the credit_card_token field.
	 * @var        string
	 */
	protected $credit_card_token;

	/**
	 * The value for the first_charge field.
	 * @var        string
	 */
	protected $first_charge;

	/**
	 * The value for the where_find_us field.
	 * @var        string
	 */
	protected $where_find_us;

	/**
	 * @var        array Expert[] Collection to store aggregation of Expert objects.
	 */
	protected $collExperts;

	/**
	 * @var        Criteria The criteria used to select the current contents of collExperts.
	 */
	private $lastExpertCriteria = null;

	/**
	 * @var        array ExpertCategory[] Collection to store aggregation of ExpertCategory objects.
	 */
	protected $collExpertCategorys;

	/**
	 * @var        Criteria The criteria used to select the current contents of collExpertCategorys.
	 */
	private $lastExpertCategoryCriteria = null;

	/**
	 * @var        array History[] Collection to store aggregation of History objects.
	 */
	protected $collHistorys;

	/**
	 * @var        Criteria The criteria used to select the current contents of collHistorys.
	 */
	private $lastHistoryCriteria = null;

	/**
	 * @var        array ItemRating[] Collection to store aggregation of ItemRating objects.
	 */
	protected $collItemRatings;

	/**
	 * @var        Criteria The criteria used to select the current contents of collItemRatings.
	 */
	private $lastItemRatingCriteria = null;

	/**
	 * @var        array OfferVoucher1[] Collection to store aggregation of OfferVoucher1 objects.
	 */
	protected $collOfferVoucher1s;

	/**
	 * @var        Criteria The criteria used to select the current contents of collOfferVoucher1s.
	 */
	private $lastOfferVoucher1Criteria = null;

	/**
	 * @var        array PurchaseDetail[] Collection to store aggregation of PurchaseDetail objects.
	 */
	protected $collPurchaseDetails;

	/**
	 * @var        Criteria The criteria used to select the current contents of collPurchaseDetails.
	 */
	private $lastPurchaseDetailCriteria = null;

	/**
	 * @var        array ShoppingCart[] Collection to store aggregation of ShoppingCart objects.
	 */
	protected $collShoppingCarts;

	/**
	 * @var        Criteria The criteria used to select the current contents of collShoppingCarts.
	 */
	private $lastShoppingCartCriteria = null;

	/**
	 * @var        array Shout[] Collection to store aggregation of Shout objects.
	 */
	protected $collShoutsRelatedByPosterId;

	/**
	 * @var        Criteria The criteria used to select the current contents of collShoutsRelatedByPosterId.
	 */
	private $lastShoutRelatedByPosterIdCriteria = null;

	/**
	 * @var        array Shout[] Collection to store aggregation of Shout objects.
	 */
	protected $collShoutsRelatedByRecipientId;

	/**
	 * @var        Criteria The criteria used to select the current contents of collShoutsRelatedByRecipientId.
	 */
	private $lastShoutRelatedByRecipientIdCriteria = null;

	/**
	 * @var        array UserAwards[] Collection to store aggregation of UserAwards objects.
	 */
	protected $collUserAwardss;

	/**
	 * @var        Criteria The criteria used to select the current contents of collUserAwardss.
	 */
	private $lastUserAwardsCriteria = null;

	/**
	 * @var        UserGtalk one-to-one related UserGtalk object
	 */
	protected $singleUserGtalk;

	/**
	 * @var        UserFb one-to-one related UserFb object
	 */
	protected $singleUserFb;

	/**
	 * @var        array UserRate[] Collection to store aggregation of UserRate objects.
	 */
	protected $collUserRates;

	/**
	 * @var        Criteria The criteria used to select the current contents of collUserRates.
	 */
	private $lastUserRateCriteria = null;

	/**
	 * @var        UserTutor one-to-one related UserTutor object
	 */
	protected $singleUserTutor;

	/**
	 * @var        array UserQuestionTag[] Collection to store aggregation of UserQuestionTag objects.
	 */
	protected $collUserQuestionTags;

	/**
	 * @var        Criteria The criteria used to select the current contents of collUserQuestionTags.
	 */
	private $lastUserQuestionTagCriteria = null;

	/**
	 * @var        array StudentQuestion[] Collection to store aggregation of StudentQuestion objects.
	 */
	protected $collStudentQuestionsRelatedByStudentId;

	/**
	 * @var        Criteria The criteria used to select the current contents of collStudentQuestionsRelatedByStudentId.
	 */
	private $lastStudentQuestionRelatedByStudentIdCriteria = null;

	/**
	 * @var        array StudentQuestion[] Collection to store aggregation of StudentQuestion objects.
	 */
	protected $collStudentQuestionsRelatedByTutorId;

	/**
	 * @var        Criteria The criteria used to select the current contents of collStudentQuestionsRelatedByTutorId.
	 */
	private $lastStudentQuestionRelatedByTutorIdCriteria = null;

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
	 * Initializes internal state of BaseUser object.
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
		$this->points = '0';
		$this->type = 0;
		$this->hidden = 0;
		$this->relationship_status = 0;
		$this->show_email = 1;
		$this->show_gender = 1;
		$this->show_hometown = 1;
		$this->show_home_phone = 1;
		$this->show_mobile_phone = 1;
		$this->show_birthdate = 1;
		$this->show_address = 1;
		$this->show_relationship_status = 1;
		$this->credit = 0;
		$this->login = 0;
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
	 * Get the [username] column value.
	 * 
	 * @return     string
	 */
	public function getUsername()
	{
		return $this->username;
	}

	/**
	 * Get the [email] column value.
	 * 
	 * @return     string
	 */
	public function getEmail()
	{
		return $this->email;
	}

	/**
	 * Get the [password] column value.
	 * 
	 * @return     string
	 */
	public function getPassword()
	{
		return $this->password;
	}

	/**
	 * Get the [points] column value.
	 * 
	 * @return     string
	 */
	public function getPoints()
	{
		return $this->points;
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
	 * Get the [optionally formatted] temporal [last_activity_at] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getLastActivityAt($format = 'Y-m-d H:i:s')
	{
		if ($this->last_activity_at === null) {
			return null;
		}


		if ($this->last_activity_at === '0000-00-00 00:00:00') {
			// while technically this is not a default value of NULL,
			// this seems to be closest in meaning.
			return null;
		} else {
			try {
				$dt = new DateTime($this->last_activity_at);
			} catch (Exception $x) {
				throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->last_activity_at, true), $x);
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
	 * Get the [type] column value.
	 * 
	 * @return     int
	 */
	public function getType()
	{
		return $this->type;
	}

	/**
	 * Get the [hidden] column value.
	 * 
	 * @return     int
	 */
	public function getHidden()
	{
		return $this->hidden;
	}

	/**
	 * Get the [name] column value.
	 * 
	 * @return     string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * Get the [gender] column value.
	 * 
	 * @return     int
	 */
	public function getGender()
	{
		return $this->gender;
	}

	/**
	 * Get the [hometown] column value.
	 * 
	 * @return     string
	 */
	public function getHometown()
	{
		return $this->hometown;
	}

	/**
	 * Get the [home_phone] column value.
	 * 
	 * @return     string
	 */
	public function getHomePhone()
	{
		return $this->home_phone;
	}

	/**
	 * Get the [mobile_phone] column value.
	 * 
	 * @return     string
	 */
	public function getMobilePhone()
	{
		return $this->mobile_phone;
	}

	/**
	 * Get the [optionally formatted] temporal [birthdate] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getBirthdate($format = 'Y-m-d')
	{
		if ($this->birthdate === null) {
			return null;
		}


		if ($this->birthdate === '0000-00-00') {
			// while technically this is not a default value of NULL,
			// this seems to be closest in meaning.
			return null;
		} else {
			try {
				$dt = new DateTime($this->birthdate);
			} catch (Exception $x) {
				throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->birthdate, true), $x);
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
	 * Get the [address] column value.
	 * 
	 * @return     string
	 */
	public function getAddress()
	{
		return $this->address;
	}

	/**
	 * Get the [relationship_status] column value.
	 * 
	 * @return     int
	 */
	public function getRelationshipStatus()
	{
		return $this->relationship_status;
	}

	/**
	 * Get the [show_email] column value.
	 * 
	 * @return     int
	 */
	public function getShowEmail()
	{
		return $this->show_email;
	}

	/**
	 * Get the [show_gender] column value.
	 * 
	 * @return     int
	 */
	public function getShowGender()
	{
		return $this->show_gender;
	}

	/**
	 * Get the [show_hometown] column value.
	 * 
	 * @return     int
	 */
	public function getShowHometown()
	{
		return $this->show_hometown;
	}

	/**
	 * Get the [show_home_phone] column value.
	 * 
	 * @return     int
	 */
	public function getShowHomePhone()
	{
		return $this->show_home_phone;
	}

	/**
	 * Get the [show_mobile_phone] column value.
	 * 
	 * @return     int
	 */
	public function getShowMobilePhone()
	{
		return $this->show_mobile_phone;
	}

	/**
	 * Get the [show_birthdate] column value.
	 * 
	 * @return     int
	 */
	public function getShowBirthdate()
	{
		return $this->show_birthdate;
	}

	/**
	 * Get the [show_address] column value.
	 * 
	 * @return     int
	 */
	public function getShowAddress()
	{
		return $this->show_address;
	}

	/**
	 * Get the [show_relationship_status] column value.
	 * 
	 * @return     int
	 */
	public function getShowRelationshipStatus()
	{
		return $this->show_relationship_status;
	}

	/**
	 * Get the [password_recover_key] column value.
	 * 
	 * @return     string
	 */
	public function getPasswordRecoverKey()
	{
		return $this->password_recover_key;
	}

	/**
	 * Get the [cookie_key] column value.
	 * 
	 * @return     string
	 */
	public function getCookieKey()
	{
		return $this->cookie_key;
	}

	/**
	 * Get the [credit] column value.
	 * 
	 * @return     int
	 */
	public function getCredit()
	{
		return $this->credit;
	}

	/**
	 * Get the [invisible] column value.
	 * 
	 * @return     int
	 */
	public function getInvisible()
	{
		return $this->invisible;
	}

	/**
	 * Get the [notification] column value.
	 * 
	 * @return     string
	 */
	public function getNotification()
	{
		return $this->notification;
	}

	/**
	 * Get the [phone_number] column value.
	 * 
	 * @return     string
	 */
	public function getPhoneNumber()
	{
		return $this->phone_number;
	}

	/**
	 * Get the [login] column value.
	 * 
	 * @return     int
	 */
	public function getLogin()
	{
		return $this->login;
	}

	/**
	 * Get the [credit_card] column value.
	 * 
	 * @return     string
	 */
	public function getCreditCard()
	{
		return $this->credit_card;
	}

	/**
	 * Get the [credit_card_token] column value.
	 * 
	 * @return     string
	 */
	public function getCreditCardToken()
	{
		return $this->credit_card_token;
	}

	/**
	 * Get the [optionally formatted] temporal [first_charge] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getFirstCharge($format = 'Y-m-d H:i:s')
	{
		if ($this->first_charge === null) {
			return null;
		}


		if ($this->first_charge === '0000-00-00 00:00:00') {
			// while technically this is not a default value of NULL,
			// this seems to be closest in meaning.
			return null;
		} else {
			try {
				$dt = new DateTime($this->first_charge);
			} catch (Exception $x) {
				throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->first_charge, true), $x);
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
	 * Get the [where_find_us] column value.
	 * 
	 * @return     string
	 */
	public function getWhereFindUs()
	{
		return $this->where_find_us;
	}

	/**
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = UserPeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [username] column.
	 * 
	 * @param      string $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setUsername($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->username !== $v) {
			$this->username = $v;
			$this->modifiedColumns[] = UserPeer::USERNAME;
		}

		return $this;
	} // setUsername()

	/**
	 * Set the value of [email] column.
	 * 
	 * @param      string $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setEmail($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->email !== $v) {
			$this->email = $v;
			$this->modifiedColumns[] = UserPeer::EMAIL;
		}

		return $this;
	} // setEmail()

	/**
	 * Set the value of [password] column.
	 * 
	 * @param      string $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setPassword($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->password !== $v) {
			$this->password = $v;
			$this->modifiedColumns[] = UserPeer::PASSWORD;
		}

		return $this;
	} // setPassword()

	/**
	 * Set the value of [points] column.
	 * 
	 * @param      string $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setPoints($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->points !== $v || $v === '0') {
			$this->points = $v;
			$this->modifiedColumns[] = UserPeer::POINTS;
		}

		return $this;
	} // setPoints()

	/**
	 * Sets the value of [created_at] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     User The current object (for fluent API support)
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
				$this->modifiedColumns[] = UserPeer::CREATED_AT;
			}
		} // if either are not null

		return $this;
	} // setCreatedAt()

	/**
	 * Sets the value of [last_activity_at] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     User The current object (for fluent API support)
	 */
	public function setLastActivityAt($v)
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

		if ( $this->last_activity_at !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->last_activity_at !== null && $tmpDt = new DateTime($this->last_activity_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d H:i:s') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->last_activity_at = ($dt ? $dt->format('Y-m-d H:i:s') : null);
				$this->modifiedColumns[] = UserPeer::LAST_ACTIVITY_AT;
			}
		} // if either are not null

		return $this;
	} // setLastActivityAt()

	/**
	 * Set the value of [type] column.
	 * 
	 * @param      int $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setType($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->type !== $v || $v === 0) {
			$this->type = $v;
			$this->modifiedColumns[] = UserPeer::TYPE;
		}

		return $this;
	} // setType()

	/**
	 * Set the value of [hidden] column.
	 * 
	 * @param      int $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setHidden($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->hidden !== $v || $v === 0) {
			$this->hidden = $v;
			$this->modifiedColumns[] = UserPeer::HIDDEN;
		}

		return $this;
	} // setHidden()

	/**
	 * Set the value of [name] column.
	 * 
	 * @param      string $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setName($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = UserPeer::NAME;
		}

		return $this;
	} // setName()

	/**
	 * Set the value of [gender] column.
	 * 
	 * @param      int $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setGender($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->gender !== $v) {
			$this->gender = $v;
			$this->modifiedColumns[] = UserPeer::GENDER;
		}

		return $this;
	} // setGender()

	/**
	 * Set the value of [hometown] column.
	 * 
	 * @param      string $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setHometown($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->hometown !== $v) {
			$this->hometown = $v;
			$this->modifiedColumns[] = UserPeer::HOMETOWN;
		}

		return $this;
	} // setHometown()

	/**
	 * Set the value of [home_phone] column.
	 * 
	 * @param      string $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setHomePhone($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->home_phone !== $v) {
			$this->home_phone = $v;
			$this->modifiedColumns[] = UserPeer::HOME_PHONE;
		}

		return $this;
	} // setHomePhone()

	/**
	 * Set the value of [mobile_phone] column.
	 * 
	 * @param      string $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setMobilePhone($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->mobile_phone !== $v) {
			$this->mobile_phone = $v;
			$this->modifiedColumns[] = UserPeer::MOBILE_PHONE;
		}

		return $this;
	} // setMobilePhone()

	/**
	 * Sets the value of [birthdate] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     User The current object (for fluent API support)
	 */
	public function setBirthdate($v)
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

		if ( $this->birthdate !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->birthdate !== null && $tmpDt = new DateTime($this->birthdate)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->birthdate = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = UserPeer::BIRTHDATE;
			}
		} // if either are not null

		return $this;
	} // setBirthdate()

	/**
	 * Set the value of [address] column.
	 * 
	 * @param      string $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setAddress($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->address !== $v) {
			$this->address = $v;
			$this->modifiedColumns[] = UserPeer::ADDRESS;
		}

		return $this;
	} // setAddress()

	/**
	 * Set the value of [relationship_status] column.
	 * 
	 * @param      int $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setRelationshipStatus($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->relationship_status !== $v || $v === 0) {
			$this->relationship_status = $v;
			$this->modifiedColumns[] = UserPeer::RELATIONSHIP_STATUS;
		}

		return $this;
	} // setRelationshipStatus()

	/**
	 * Set the value of [show_email] column.
	 * 
	 * @param      int $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setShowEmail($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->show_email !== $v || $v === 1) {
			$this->show_email = $v;
			$this->modifiedColumns[] = UserPeer::SHOW_EMAIL;
		}

		return $this;
	} // setShowEmail()

	/**
	 * Set the value of [show_gender] column.
	 * 
	 * @param      int $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setShowGender($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->show_gender !== $v || $v === 1) {
			$this->show_gender = $v;
			$this->modifiedColumns[] = UserPeer::SHOW_GENDER;
		}

		return $this;
	} // setShowGender()

	/**
	 * Set the value of [show_hometown] column.
	 * 
	 * @param      int $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setShowHometown($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->show_hometown !== $v || $v === 1) {
			$this->show_hometown = $v;
			$this->modifiedColumns[] = UserPeer::SHOW_HOMETOWN;
		}

		return $this;
	} // setShowHometown()

	/**
	 * Set the value of [show_home_phone] column.
	 * 
	 * @param      int $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setShowHomePhone($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->show_home_phone !== $v || $v === 1) {
			$this->show_home_phone = $v;
			$this->modifiedColumns[] = UserPeer::SHOW_HOME_PHONE;
		}

		return $this;
	} // setShowHomePhone()

	/**
	 * Set the value of [show_mobile_phone] column.
	 * 
	 * @param      int $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setShowMobilePhone($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->show_mobile_phone !== $v || $v === 1) {
			$this->show_mobile_phone = $v;
			$this->modifiedColumns[] = UserPeer::SHOW_MOBILE_PHONE;
		}

		return $this;
	} // setShowMobilePhone()

	/**
	 * Set the value of [show_birthdate] column.
	 * 
	 * @param      int $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setShowBirthdate($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->show_birthdate !== $v || $v === 1) {
			$this->show_birthdate = $v;
			$this->modifiedColumns[] = UserPeer::SHOW_BIRTHDATE;
		}

		return $this;
	} // setShowBirthdate()

	/**
	 * Set the value of [show_address] column.
	 * 
	 * @param      int $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setShowAddress($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->show_address !== $v || $v === 1) {
			$this->show_address = $v;
			$this->modifiedColumns[] = UserPeer::SHOW_ADDRESS;
		}

		return $this;
	} // setShowAddress()

	/**
	 * Set the value of [show_relationship_status] column.
	 * 
	 * @param      int $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setShowRelationshipStatus($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->show_relationship_status !== $v || $v === 1) {
			$this->show_relationship_status = $v;
			$this->modifiedColumns[] = UserPeer::SHOW_RELATIONSHIP_STATUS;
		}

		return $this;
	} // setShowRelationshipStatus()

	/**
	 * Set the value of [password_recover_key] column.
	 * 
	 * @param      string $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setPasswordRecoverKey($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->password_recover_key !== $v) {
			$this->password_recover_key = $v;
			$this->modifiedColumns[] = UserPeer::PASSWORD_RECOVER_KEY;
		}

		return $this;
	} // setPasswordRecoverKey()

	/**
	 * Set the value of [cookie_key] column.
	 * 
	 * @param      string $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setCookieKey($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->cookie_key !== $v) {
			$this->cookie_key = $v;
			$this->modifiedColumns[] = UserPeer::COOKIE_KEY;
		}

		return $this;
	} // setCookieKey()

	/**
	 * Set the value of [credit] column.
	 * 
	 * @param      int $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setCredit($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->credit !== $v || $v === 0) {
			$this->credit = $v;
			$this->modifiedColumns[] = UserPeer::CREDIT;
		}

		return $this;
	} // setCredit()

	/**
	 * Set the value of [invisible] column.
	 * 
	 * @param      int $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setInvisible($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->invisible !== $v) {
			$this->invisible = $v;
			$this->modifiedColumns[] = UserPeer::INVISIBLE;
		}

		return $this;
	} // setInvisible()

	/**
	 * Set the value of [notification] column.
	 * 
	 * @param      string $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setNotification($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->notification !== $v) {
			$this->notification = $v;
			$this->modifiedColumns[] = UserPeer::NOTIFICATION;
		}

		return $this;
	} // setNotification()

	/**
	 * Set the value of [phone_number] column.
	 * 
	 * @param      string $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setPhoneNumber($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->phone_number !== $v) {
			$this->phone_number = $v;
			$this->modifiedColumns[] = UserPeer::PHONE_NUMBER;
		}

		return $this;
	} // setPhoneNumber()

	/**
	 * Set the value of [login] column.
	 * 
	 * @param      int $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setLogin($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->login !== $v || $v === 0) {
			$this->login = $v;
			$this->modifiedColumns[] = UserPeer::LOGIN;
		}

		return $this;
	} // setLogin()

	/**
	 * Set the value of [credit_card] column.
	 * 
	 * @param      string $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setCreditCard($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->credit_card !== $v) {
			$this->credit_card = $v;
			$this->modifiedColumns[] = UserPeer::CREDIT_CARD;
		}

		return $this;
	} // setCreditCard()

	/**
	 * Set the value of [credit_card_token] column.
	 * 
	 * @param      string $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setCreditCardToken($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->credit_card_token !== $v) {
			$this->credit_card_token = $v;
			$this->modifiedColumns[] = UserPeer::CREDIT_CARD_TOKEN;
		}

		return $this;
	} // setCreditCardToken()

	/**
	 * Sets the value of [first_charge] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     User The current object (for fluent API support)
	 */
	public function setFirstCharge($v)
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

		if ( $this->first_charge !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->first_charge !== null && $tmpDt = new DateTime($this->first_charge)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d H:i:s') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->first_charge = ($dt ? $dt->format('Y-m-d H:i:s') : null);
				$this->modifiedColumns[] = UserPeer::FIRST_CHARGE;
			}
		} // if either are not null

		return $this;
	} // setFirstCharge()

	/**
	 * Set the value of [where_find_us] column.
	 * 
	 * @param      string $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setWhereFindUs($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->where_find_us !== $v) {
			$this->where_find_us = $v;
			$this->modifiedColumns[] = UserPeer::WHERE_FIND_US;
		}

		return $this;
	} // setWhereFindUs()

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
			if (array_diff($this->modifiedColumns, array(UserPeer::POINTS,UserPeer::TYPE,UserPeer::HIDDEN,UserPeer::RELATIONSHIP_STATUS,UserPeer::SHOW_EMAIL,UserPeer::SHOW_GENDER,UserPeer::SHOW_HOMETOWN,UserPeer::SHOW_HOME_PHONE,UserPeer::SHOW_MOBILE_PHONE,UserPeer::SHOW_BIRTHDATE,UserPeer::SHOW_ADDRESS,UserPeer::SHOW_RELATIONSHIP_STATUS,UserPeer::CREDIT,UserPeer::LOGIN))) {
				return false;
			}

			if ($this->points !== '0') {
				return false;
			}

			if ($this->type !== 0) {
				return false;
			}

			if ($this->hidden !== 0) {
				return false;
			}

			if ($this->relationship_status !== 0) {
				return false;
			}

			if ($this->show_email !== 1) {
				return false;
			}

			if ($this->show_gender !== 1) {
				return false;
			}

			if ($this->show_hometown !== 1) {
				return false;
			}

			if ($this->show_home_phone !== 1) {
				return false;
			}

			if ($this->show_mobile_phone !== 1) {
				return false;
			}

			if ($this->show_birthdate !== 1) {
				return false;
			}

			if ($this->show_address !== 1) {
				return false;
			}

			if ($this->show_relationship_status !== 1) {
				return false;
			}

			if ($this->credit !== 0) {
				return false;
			}

			if ($this->login !== 0) {
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
			$this->username = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->email = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->password = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->points = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->created_at = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->last_activity_at = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->type = ($row[$startcol + 7] !== null) ? (int) $row[$startcol + 7] : null;
			$this->hidden = ($row[$startcol + 8] !== null) ? (int) $row[$startcol + 8] : null;
			$this->name = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->gender = ($row[$startcol + 10] !== null) ? (int) $row[$startcol + 10] : null;
			$this->hometown = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
			$this->home_phone = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
			$this->mobile_phone = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
			$this->birthdate = ($row[$startcol + 14] !== null) ? (string) $row[$startcol + 14] : null;
			$this->address = ($row[$startcol + 15] !== null) ? (string) $row[$startcol + 15] : null;
			$this->relationship_status = ($row[$startcol + 16] !== null) ? (int) $row[$startcol + 16] : null;
			$this->show_email = ($row[$startcol + 17] !== null) ? (int) $row[$startcol + 17] : null;
			$this->show_gender = ($row[$startcol + 18] !== null) ? (int) $row[$startcol + 18] : null;
			$this->show_hometown = ($row[$startcol + 19] !== null) ? (int) $row[$startcol + 19] : null;
			$this->show_home_phone = ($row[$startcol + 20] !== null) ? (int) $row[$startcol + 20] : null;
			$this->show_mobile_phone = ($row[$startcol + 21] !== null) ? (int) $row[$startcol + 21] : null;
			$this->show_birthdate = ($row[$startcol + 22] !== null) ? (int) $row[$startcol + 22] : null;
			$this->show_address = ($row[$startcol + 23] !== null) ? (int) $row[$startcol + 23] : null;
			$this->show_relationship_status = ($row[$startcol + 24] !== null) ? (int) $row[$startcol + 24] : null;
			$this->password_recover_key = ($row[$startcol + 25] !== null) ? (string) $row[$startcol + 25] : null;
			$this->cookie_key = ($row[$startcol + 26] !== null) ? (string) $row[$startcol + 26] : null;
			$this->credit = ($row[$startcol + 27] !== null) ? (int) $row[$startcol + 27] : null;
			$this->invisible = ($row[$startcol + 28] !== null) ? (int) $row[$startcol + 28] : null;
			$this->notification = ($row[$startcol + 29] !== null) ? (string) $row[$startcol + 29] : null;
			$this->phone_number = ($row[$startcol + 30] !== null) ? (string) $row[$startcol + 30] : null;
			$this->login = ($row[$startcol + 31] !== null) ? (int) $row[$startcol + 31] : null;
			$this->credit_card = ($row[$startcol + 32] !== null) ? (string) $row[$startcol + 32] : null;
			$this->credit_card_token = ($row[$startcol + 33] !== null) ? (string) $row[$startcol + 33] : null;
			$this->first_charge = ($row[$startcol + 34] !== null) ? (string) $row[$startcol + 34] : null;
			$this->where_find_us = ($row[$startcol + 35] !== null) ? (string) $row[$startcol + 35] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 36; // 36 = UserPeer::NUM_COLUMNS - UserPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating User object", $e);
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
			$con = Propel::getConnection(UserPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = UserPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->collExperts = null;
			$this->lastExpertCriteria = null;

			$this->collExpertCategorys = null;
			$this->lastExpertCategoryCriteria = null;

			$this->collHistorys = null;
			$this->lastHistoryCriteria = null;

			$this->collItemRatings = null;
			$this->lastItemRatingCriteria = null;

			$this->collOfferVoucher1s = null;
			$this->lastOfferVoucher1Criteria = null;

			$this->collPurchaseDetails = null;
			$this->lastPurchaseDetailCriteria = null;

			$this->collShoppingCarts = null;
			$this->lastShoppingCartCriteria = null;

			$this->collShoutsRelatedByPosterId = null;
			$this->lastShoutRelatedByPosterIdCriteria = null;

			$this->collShoutsRelatedByRecipientId = null;
			$this->lastShoutRelatedByRecipientIdCriteria = null;

			$this->collUserAwardss = null;
			$this->lastUserAwardsCriteria = null;

			$this->singleUserGtalk = null;

			$this->singleUserFb = null;

			$this->collUserRates = null;
			$this->lastUserRateCriteria = null;

			$this->singleUserTutor = null;

			$this->collUserQuestionTags = null;
			$this->lastUserQuestionTagCriteria = null;

			$this->collStudentQuestionsRelatedByStudentId = null;
			$this->lastStudentQuestionRelatedByStudentIdCriteria = null;

			$this->collStudentQuestionsRelatedByTutorId = null;
			$this->lastStudentQuestionRelatedByTutorIdCriteria = null;

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
			$con = Propel::getConnection(UserPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			UserPeer::doDelete($this, $con);
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
    if ($this->isNew() && !$this->isColumnModified(UserPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(UserPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			UserPeer::addInstanceToPool($this);
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
				$this->modifiedColumns[] = UserPeer::ID;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = UserPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += UserPeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collExperts !== null) {
				foreach ($this->collExperts as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collExpertCategorys !== null) {
				foreach ($this->collExpertCategorys as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collHistorys !== null) {
				foreach ($this->collHistorys as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collItemRatings !== null) {
				foreach ($this->collItemRatings as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collOfferVoucher1s !== null) {
				foreach ($this->collOfferVoucher1s as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collPurchaseDetails !== null) {
				foreach ($this->collPurchaseDetails as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collShoppingCarts !== null) {
				foreach ($this->collShoppingCarts as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collShoutsRelatedByPosterId !== null) {
				foreach ($this->collShoutsRelatedByPosterId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collShoutsRelatedByRecipientId !== null) {
				foreach ($this->collShoutsRelatedByRecipientId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collUserAwardss !== null) {
				foreach ($this->collUserAwardss as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->singleUserGtalk !== null) {
				if (!$this->singleUserGtalk->isDeleted()) {
						$affectedRows += $this->singleUserGtalk->save($con);
				}
			}

			if ($this->singleUserFb !== null) {
				if (!$this->singleUserFb->isDeleted()) {
						$affectedRows += $this->singleUserFb->save($con);
				}
			}

			if ($this->collUserRates !== null) {
				foreach ($this->collUserRates as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->singleUserTutor !== null) {
				if (!$this->singleUserTutor->isDeleted()) {
						$affectedRows += $this->singleUserTutor->save($con);
				}
			}

			if ($this->collUserQuestionTags !== null) {
				foreach ($this->collUserQuestionTags as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collStudentQuestionsRelatedByStudentId !== null) {
				foreach ($this->collStudentQuestionsRelatedByStudentId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collStudentQuestionsRelatedByTutorId !== null) {
				foreach ($this->collStudentQuestionsRelatedByTutorId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
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


			if (($retval = UserPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collExperts !== null) {
					foreach ($this->collExperts as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collExpertCategorys !== null) {
					foreach ($this->collExpertCategorys as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collHistorys !== null) {
					foreach ($this->collHistorys as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collItemRatings !== null) {
					foreach ($this->collItemRatings as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collOfferVoucher1s !== null) {
					foreach ($this->collOfferVoucher1s as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collPurchaseDetails !== null) {
					foreach ($this->collPurchaseDetails as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collShoppingCarts !== null) {
					foreach ($this->collShoppingCarts as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collShoutsRelatedByPosterId !== null) {
					foreach ($this->collShoutsRelatedByPosterId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collShoutsRelatedByRecipientId !== null) {
					foreach ($this->collShoutsRelatedByRecipientId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collUserAwardss !== null) {
					foreach ($this->collUserAwardss as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->singleUserGtalk !== null) {
					if (!$this->singleUserGtalk->validate($columns)) {
						$failureMap = array_merge($failureMap, $this->singleUserGtalk->getValidationFailures());
					}
				}

				if ($this->singleUserFb !== null) {
					if (!$this->singleUserFb->validate($columns)) {
						$failureMap = array_merge($failureMap, $this->singleUserFb->getValidationFailures());
					}
				}

				if ($this->collUserRates !== null) {
					foreach ($this->collUserRates as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->singleUserTutor !== null) {
					if (!$this->singleUserTutor->validate($columns)) {
						$failureMap = array_merge($failureMap, $this->singleUserTutor->getValidationFailures());
					}
				}

				if ($this->collUserQuestionTags !== null) {
					foreach ($this->collUserQuestionTags as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collStudentQuestionsRelatedByStudentId !== null) {
					foreach ($this->collStudentQuestionsRelatedByStudentId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collStudentQuestionsRelatedByTutorId !== null) {
					foreach ($this->collStudentQuestionsRelatedByTutorId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
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
		$pos = UserPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getUsername();
				break;
			case 2:
				return $this->getEmail();
				break;
			case 3:
				return $this->getPassword();
				break;
			case 4:
				return $this->getPoints();
				break;
			case 5:
				return $this->getCreatedAt();
				break;
			case 6:
				return $this->getLastActivityAt();
				break;
			case 7:
				return $this->getType();
				break;
			case 8:
				return $this->getHidden();
				break;
			case 9:
				return $this->getName();
				break;
			case 10:
				return $this->getGender();
				break;
			case 11:
				return $this->getHometown();
				break;
			case 12:
				return $this->getHomePhone();
				break;
			case 13:
				return $this->getMobilePhone();
				break;
			case 14:
				return $this->getBirthdate();
				break;
			case 15:
				return $this->getAddress();
				break;
			case 16:
				return $this->getRelationshipStatus();
				break;
			case 17:
				return $this->getShowEmail();
				break;
			case 18:
				return $this->getShowGender();
				break;
			case 19:
				return $this->getShowHometown();
				break;
			case 20:
				return $this->getShowHomePhone();
				break;
			case 21:
				return $this->getShowMobilePhone();
				break;
			case 22:
				return $this->getShowBirthdate();
				break;
			case 23:
				return $this->getShowAddress();
				break;
			case 24:
				return $this->getShowRelationshipStatus();
				break;
			case 25:
				return $this->getPasswordRecoverKey();
				break;
			case 26:
				return $this->getCookieKey();
				break;
			case 27:
				return $this->getCredit();
				break;
			case 28:
				return $this->getInvisible();
				break;
			case 29:
				return $this->getNotification();
				break;
			case 30:
				return $this->getPhoneNumber();
				break;
			case 31:
				return $this->getLogin();
				break;
			case 32:
				return $this->getCreditCard();
				break;
			case 33:
				return $this->getCreditCardToken();
				break;
			case 34:
				return $this->getFirstCharge();
				break;
			case 35:
				return $this->getWhereFindUs();
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
		$keys = UserPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getUsername(),
			$keys[2] => $this->getEmail(),
			$keys[3] => $this->getPassword(),
			$keys[4] => $this->getPoints(),
			$keys[5] => $this->getCreatedAt(),
			$keys[6] => $this->getLastActivityAt(),
			$keys[7] => $this->getType(),
			$keys[8] => $this->getHidden(),
			$keys[9] => $this->getName(),
			$keys[10] => $this->getGender(),
			$keys[11] => $this->getHometown(),
			$keys[12] => $this->getHomePhone(),
			$keys[13] => $this->getMobilePhone(),
			$keys[14] => $this->getBirthdate(),
			$keys[15] => $this->getAddress(),
			$keys[16] => $this->getRelationshipStatus(),
			$keys[17] => $this->getShowEmail(),
			$keys[18] => $this->getShowGender(),
			$keys[19] => $this->getShowHometown(),
			$keys[20] => $this->getShowHomePhone(),
			$keys[21] => $this->getShowMobilePhone(),
			$keys[22] => $this->getShowBirthdate(),
			$keys[23] => $this->getShowAddress(),
			$keys[24] => $this->getShowRelationshipStatus(),
			$keys[25] => $this->getPasswordRecoverKey(),
			$keys[26] => $this->getCookieKey(),
			$keys[27] => $this->getCredit(),
			$keys[28] => $this->getInvisible(),
			$keys[29] => $this->getNotification(),
			$keys[30] => $this->getPhoneNumber(),
			$keys[31] => $this->getLogin(),
			$keys[32] => $this->getCreditCard(),
			$keys[33] => $this->getCreditCardToken(),
			$keys[34] => $this->getFirstCharge(),
			$keys[35] => $this->getWhereFindUs(),
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
		$pos = UserPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setUsername($value);
				break;
			case 2:
				$this->setEmail($value);
				break;
			case 3:
				$this->setPassword($value);
				break;
			case 4:
				$this->setPoints($value);
				break;
			case 5:
				$this->setCreatedAt($value);
				break;
			case 6:
				$this->setLastActivityAt($value);
				break;
			case 7:
				$this->setType($value);
				break;
			case 8:
				$this->setHidden($value);
				break;
			case 9:
				$this->setName($value);
				break;
			case 10:
				$this->setGender($value);
				break;
			case 11:
				$this->setHometown($value);
				break;
			case 12:
				$this->setHomePhone($value);
				break;
			case 13:
				$this->setMobilePhone($value);
				break;
			case 14:
				$this->setBirthdate($value);
				break;
			case 15:
				$this->setAddress($value);
				break;
			case 16:
				$this->setRelationshipStatus($value);
				break;
			case 17:
				$this->setShowEmail($value);
				break;
			case 18:
				$this->setShowGender($value);
				break;
			case 19:
				$this->setShowHometown($value);
				break;
			case 20:
				$this->setShowHomePhone($value);
				break;
			case 21:
				$this->setShowMobilePhone($value);
				break;
			case 22:
				$this->setShowBirthdate($value);
				break;
			case 23:
				$this->setShowAddress($value);
				break;
			case 24:
				$this->setShowRelationshipStatus($value);
				break;
			case 25:
				$this->setPasswordRecoverKey($value);
				break;
			case 26:
				$this->setCookieKey($value);
				break;
			case 27:
				$this->setCredit($value);
				break;
			case 28:
				$this->setInvisible($value);
				break;
			case 29:
				$this->setNotification($value);
				break;
			case 30:
				$this->setPhoneNumber($value);
				break;
			case 31:
				$this->setLogin($value);
				break;
			case 32:
				$this->setCreditCard($value);
				break;
			case 33:
				$this->setCreditCardToken($value);
				break;
			case 34:
				$this->setFirstCharge($value);
				break;
			case 35:
				$this->setWhereFindUs($value);
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
		$keys = UserPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setUsername($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setEmail($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setPassword($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setPoints($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCreatedAt($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setLastActivityAt($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setType($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setHidden($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setName($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setGender($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setHometown($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setHomePhone($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setMobilePhone($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setBirthdate($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setAddress($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setRelationshipStatus($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setShowEmail($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setShowGender($arr[$keys[18]]);
		if (array_key_exists($keys[19], $arr)) $this->setShowHometown($arr[$keys[19]]);
		if (array_key_exists($keys[20], $arr)) $this->setShowHomePhone($arr[$keys[20]]);
		if (array_key_exists($keys[21], $arr)) $this->setShowMobilePhone($arr[$keys[21]]);
		if (array_key_exists($keys[22], $arr)) $this->setShowBirthdate($arr[$keys[22]]);
		if (array_key_exists($keys[23], $arr)) $this->setShowAddress($arr[$keys[23]]);
		if (array_key_exists($keys[24], $arr)) $this->setShowRelationshipStatus($arr[$keys[24]]);
		if (array_key_exists($keys[25], $arr)) $this->setPasswordRecoverKey($arr[$keys[25]]);
		if (array_key_exists($keys[26], $arr)) $this->setCookieKey($arr[$keys[26]]);
		if (array_key_exists($keys[27], $arr)) $this->setCredit($arr[$keys[27]]);
		if (array_key_exists($keys[28], $arr)) $this->setInvisible($arr[$keys[28]]);
		if (array_key_exists($keys[29], $arr)) $this->setNotification($arr[$keys[29]]);
		if (array_key_exists($keys[30], $arr)) $this->setPhoneNumber($arr[$keys[30]]);
		if (array_key_exists($keys[31], $arr)) $this->setLogin($arr[$keys[31]]);
		if (array_key_exists($keys[32], $arr)) $this->setCreditCard($arr[$keys[32]]);
		if (array_key_exists($keys[33], $arr)) $this->setCreditCardToken($arr[$keys[33]]);
		if (array_key_exists($keys[34], $arr)) $this->setFirstCharge($arr[$keys[34]]);
		if (array_key_exists($keys[35], $arr)) $this->setWhereFindUs($arr[$keys[35]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(UserPeer::DATABASE_NAME);

		if ($this->isColumnModified(UserPeer::ID)) $criteria->add(UserPeer::ID, $this->id);
		if ($this->isColumnModified(UserPeer::USERNAME)) $criteria->add(UserPeer::USERNAME, $this->username);
		if ($this->isColumnModified(UserPeer::EMAIL)) $criteria->add(UserPeer::EMAIL, $this->email);
		if ($this->isColumnModified(UserPeer::PASSWORD)) $criteria->add(UserPeer::PASSWORD, $this->password);
		if ($this->isColumnModified(UserPeer::POINTS)) $criteria->add(UserPeer::POINTS, $this->points);
		if ($this->isColumnModified(UserPeer::CREATED_AT)) $criteria->add(UserPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(UserPeer::LAST_ACTIVITY_AT)) $criteria->add(UserPeer::LAST_ACTIVITY_AT, $this->last_activity_at);
		if ($this->isColumnModified(UserPeer::TYPE)) $criteria->add(UserPeer::TYPE, $this->type);
		if ($this->isColumnModified(UserPeer::HIDDEN)) $criteria->add(UserPeer::HIDDEN, $this->hidden);
		if ($this->isColumnModified(UserPeer::NAME)) $criteria->add(UserPeer::NAME, $this->name);
		if ($this->isColumnModified(UserPeer::GENDER)) $criteria->add(UserPeer::GENDER, $this->gender);
		if ($this->isColumnModified(UserPeer::HOMETOWN)) $criteria->add(UserPeer::HOMETOWN, $this->hometown);
		if ($this->isColumnModified(UserPeer::HOME_PHONE)) $criteria->add(UserPeer::HOME_PHONE, $this->home_phone);
		if ($this->isColumnModified(UserPeer::MOBILE_PHONE)) $criteria->add(UserPeer::MOBILE_PHONE, $this->mobile_phone);
		if ($this->isColumnModified(UserPeer::BIRTHDATE)) $criteria->add(UserPeer::BIRTHDATE, $this->birthdate);
		if ($this->isColumnModified(UserPeer::ADDRESS)) $criteria->add(UserPeer::ADDRESS, $this->address);
		if ($this->isColumnModified(UserPeer::RELATIONSHIP_STATUS)) $criteria->add(UserPeer::RELATIONSHIP_STATUS, $this->relationship_status);
		if ($this->isColumnModified(UserPeer::SHOW_EMAIL)) $criteria->add(UserPeer::SHOW_EMAIL, $this->show_email);
		if ($this->isColumnModified(UserPeer::SHOW_GENDER)) $criteria->add(UserPeer::SHOW_GENDER, $this->show_gender);
		if ($this->isColumnModified(UserPeer::SHOW_HOMETOWN)) $criteria->add(UserPeer::SHOW_HOMETOWN, $this->show_hometown);
		if ($this->isColumnModified(UserPeer::SHOW_HOME_PHONE)) $criteria->add(UserPeer::SHOW_HOME_PHONE, $this->show_home_phone);
		if ($this->isColumnModified(UserPeer::SHOW_MOBILE_PHONE)) $criteria->add(UserPeer::SHOW_MOBILE_PHONE, $this->show_mobile_phone);
		if ($this->isColumnModified(UserPeer::SHOW_BIRTHDATE)) $criteria->add(UserPeer::SHOW_BIRTHDATE, $this->show_birthdate);
		if ($this->isColumnModified(UserPeer::SHOW_ADDRESS)) $criteria->add(UserPeer::SHOW_ADDRESS, $this->show_address);
		if ($this->isColumnModified(UserPeer::SHOW_RELATIONSHIP_STATUS)) $criteria->add(UserPeer::SHOW_RELATIONSHIP_STATUS, $this->show_relationship_status);
		if ($this->isColumnModified(UserPeer::PASSWORD_RECOVER_KEY)) $criteria->add(UserPeer::PASSWORD_RECOVER_KEY, $this->password_recover_key);
		if ($this->isColumnModified(UserPeer::COOKIE_KEY)) $criteria->add(UserPeer::COOKIE_KEY, $this->cookie_key);
		if ($this->isColumnModified(UserPeer::CREDIT)) $criteria->add(UserPeer::CREDIT, $this->credit);
		if ($this->isColumnModified(UserPeer::INVISIBLE)) $criteria->add(UserPeer::INVISIBLE, $this->invisible);
		if ($this->isColumnModified(UserPeer::NOTIFICATION)) $criteria->add(UserPeer::NOTIFICATION, $this->notification);
		if ($this->isColumnModified(UserPeer::PHONE_NUMBER)) $criteria->add(UserPeer::PHONE_NUMBER, $this->phone_number);
		if ($this->isColumnModified(UserPeer::LOGIN)) $criteria->add(UserPeer::LOGIN, $this->login);
		if ($this->isColumnModified(UserPeer::CREDIT_CARD)) $criteria->add(UserPeer::CREDIT_CARD, $this->credit_card);
		if ($this->isColumnModified(UserPeer::CREDIT_CARD_TOKEN)) $criteria->add(UserPeer::CREDIT_CARD_TOKEN, $this->credit_card_token);
		if ($this->isColumnModified(UserPeer::FIRST_CHARGE)) $criteria->add(UserPeer::FIRST_CHARGE, $this->first_charge);
		if ($this->isColumnModified(UserPeer::WHERE_FIND_US)) $criteria->add(UserPeer::WHERE_FIND_US, $this->where_find_us);

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
		$criteria = new Criteria(UserPeer::DATABASE_NAME);

		$criteria->add(UserPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of User (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setUsername($this->username);

		$copyObj->setEmail($this->email);

		$copyObj->setPassword($this->password);

		$copyObj->setPoints($this->points);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setLastActivityAt($this->last_activity_at);

		$copyObj->setType($this->type);

		$copyObj->setHidden($this->hidden);

		$copyObj->setName($this->name);

		$copyObj->setGender($this->gender);

		$copyObj->setHometown($this->hometown);

		$copyObj->setHomePhone($this->home_phone);

		$copyObj->setMobilePhone($this->mobile_phone);

		$copyObj->setBirthdate($this->birthdate);

		$copyObj->setAddress($this->address);

		$copyObj->setRelationshipStatus($this->relationship_status);

		$copyObj->setShowEmail($this->show_email);

		$copyObj->setShowGender($this->show_gender);

		$copyObj->setShowHometown($this->show_hometown);

		$copyObj->setShowHomePhone($this->show_home_phone);

		$copyObj->setShowMobilePhone($this->show_mobile_phone);

		$copyObj->setShowBirthdate($this->show_birthdate);

		$copyObj->setShowAddress($this->show_address);

		$copyObj->setShowRelationshipStatus($this->show_relationship_status);

		$copyObj->setPasswordRecoverKey($this->password_recover_key);

		$copyObj->setCookieKey($this->cookie_key);

		$copyObj->setCredit($this->credit);

		$copyObj->setInvisible($this->invisible);

		$copyObj->setNotification($this->notification);

		$copyObj->setPhoneNumber($this->phone_number);

		$copyObj->setLogin($this->login);

		$copyObj->setCreditCard($this->credit_card);

		$copyObj->setCreditCardToken($this->credit_card_token);

		$copyObj->setFirstCharge($this->first_charge);

		$copyObj->setWhereFindUs($this->where_find_us);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getExperts() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addExpert($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getExpertCategorys() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addExpertCategory($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getHistorys() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addHistory($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getItemRatings() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addItemRating($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getOfferVoucher1s() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addOfferVoucher1($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getPurchaseDetails() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addPurchaseDetail($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getShoppingCarts() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addShoppingCart($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getShoutsRelatedByPosterId() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addShoutRelatedByPosterId($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getShoutsRelatedByRecipientId() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addShoutRelatedByRecipientId($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getUserAwardss() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addUserAwards($relObj->copy($deepCopy));
				}
			}

			$relObj = $this->getUserGtalk();
			if ($relObj) {
				$copyObj->setUserGtalk($relObj->copy($deepCopy));
			}

			$relObj = $this->getUserFb();
			if ($relObj) {
				$copyObj->setUserFb($relObj->copy($deepCopy));
			}

			foreach ($this->getUserRates() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addUserRate($relObj->copy($deepCopy));
				}
			}

			$relObj = $this->getUserTutor();
			if ($relObj) {
				$copyObj->setUserTutor($relObj->copy($deepCopy));
			}

			foreach ($this->getUserQuestionTags() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addUserQuestionTag($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getStudentQuestionsRelatedByStudentId() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addStudentQuestionRelatedByStudentId($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getStudentQuestionsRelatedByTutorId() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addStudentQuestionRelatedByTutorId($relObj->copy($deepCopy));
				}
			}

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
	 * @return     User Clone of current object.
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
	 * @return     UserPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new UserPeer();
		}
		return self::$peer;
	}

	/**
	 * Clears out the collExperts collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addExperts()
	 */
	public function clearExperts()
	{
		$this->collExperts = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collExperts collection (array).
	 *
	 * By default this just sets the collExperts collection to an empty array (like clearcollExperts());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initExperts()
	{
		$this->collExperts = array();
	}

	/**
	 * Gets an array of Expert objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this User has previously been saved, it will retrieve
	 * related Experts from storage. If this User is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array Expert[]
	 * @throws     PropelException
	 */
	public function getExperts($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collExperts === null) {
			if ($this->isNew()) {
			   $this->collExperts = array();
			} else {

				$criteria->add(ExpertPeer::USER_ID, $this->id);

				ExpertPeer::addSelectColumns($criteria);
				$this->collExperts = ExpertPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ExpertPeer::USER_ID, $this->id);

				ExpertPeer::addSelectColumns($criteria);
				if (!isset($this->lastExpertCriteria) || !$this->lastExpertCriteria->equals($criteria)) {
					$this->collExperts = ExpertPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastExpertCriteria = $criteria;
		return $this->collExperts;
	}

	/**
	 * Returns the number of related Expert objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related Expert objects.
	 * @throws     PropelException
	 */
	public function countExperts(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UserPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collExperts === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(ExpertPeer::USER_ID, $this->id);

				$count = ExpertPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(ExpertPeer::USER_ID, $this->id);

				if (!isset($this->lastExpertCriteria) || !$this->lastExpertCriteria->equals($criteria)) {
					$count = ExpertPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collExperts);
				}
			} else {
				$count = count($this->collExperts);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a Expert object to this object
	 * through the Expert foreign key attribute.
	 *
	 * @param      Expert $l Expert
	 * @return     void
	 * @throws     PropelException
	 */
	public function addExpert(Expert $l)
	{
		if ($this->collExperts === null) {
			$this->initExperts();
		}
		if (!in_array($l, $this->collExperts, true)) { // only add it if the **same** object is not already associated
			array_push($this->collExperts, $l);
			$l->setUser($this);
		}
	}

	/**
	 * Clears out the collExpertCategorys collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addExpertCategorys()
	 */
	public function clearExpertCategorys()
	{
		$this->collExpertCategorys = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collExpertCategorys collection (array).
	 *
	 * By default this just sets the collExpertCategorys collection to an empty array (like clearcollExpertCategorys());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initExpertCategorys()
	{
		$this->collExpertCategorys = array();
	}

	/**
	 * Gets an array of ExpertCategory objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this User has previously been saved, it will retrieve
	 * related ExpertCategorys from storage. If this User is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array ExpertCategory[]
	 * @throws     PropelException
	 */
	public function getExpertCategorys($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collExpertCategorys === null) {
			if ($this->isNew()) {
			   $this->collExpertCategorys = array();
			} else {

				$criteria->add(ExpertCategoryPeer::USER_ID, $this->id);

				ExpertCategoryPeer::addSelectColumns($criteria);
				$this->collExpertCategorys = ExpertCategoryPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ExpertCategoryPeer::USER_ID, $this->id);

				ExpertCategoryPeer::addSelectColumns($criteria);
				if (!isset($this->lastExpertCategoryCriteria) || !$this->lastExpertCategoryCriteria->equals($criteria)) {
					$this->collExpertCategorys = ExpertCategoryPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastExpertCategoryCriteria = $criteria;
		return $this->collExpertCategorys;
	}

	/**
	 * Returns the number of related ExpertCategory objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related ExpertCategory objects.
	 * @throws     PropelException
	 */
	public function countExpertCategorys(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UserPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collExpertCategorys === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(ExpertCategoryPeer::USER_ID, $this->id);

				$count = ExpertCategoryPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(ExpertCategoryPeer::USER_ID, $this->id);

				if (!isset($this->lastExpertCategoryCriteria) || !$this->lastExpertCategoryCriteria->equals($criteria)) {
					$count = ExpertCategoryPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collExpertCategorys);
				}
			} else {
				$count = count($this->collExpertCategorys);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a ExpertCategory object to this object
	 * through the ExpertCategory foreign key attribute.
	 *
	 * @param      ExpertCategory $l ExpertCategory
	 * @return     void
	 * @throws     PropelException
	 */
	public function addExpertCategory(ExpertCategory $l)
	{
		if ($this->collExpertCategorys === null) {
			$this->initExpertCategorys();
		}
		if (!in_array($l, $this->collExpertCategorys, true)) { // only add it if the **same** object is not already associated
			array_push($this->collExpertCategorys, $l);
			$l->setUser($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related ExpertCategorys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getExpertCategorysJoinCategory($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collExpertCategorys === null) {
			if ($this->isNew()) {
				$this->collExpertCategorys = array();
			} else {

				$criteria->add(ExpertCategoryPeer::USER_ID, $this->id);

				$this->collExpertCategorys = ExpertCategoryPeer::doSelectJoinCategory($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ExpertCategoryPeer::USER_ID, $this->id);

			if (!isset($this->lastExpertCategoryCriteria) || !$this->lastExpertCategoryCriteria->equals($criteria)) {
				$this->collExpertCategorys = ExpertCategoryPeer::doSelectJoinCategory($criteria, $con, $join_behavior);
			}
		}
		$this->lastExpertCategoryCriteria = $criteria;

		return $this->collExpertCategorys;
	}

	/**
	 * Clears out the collHistorys collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addHistorys()
	 */
	public function clearHistorys()
	{
		$this->collHistorys = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collHistorys collection (array).
	 *
	 * By default this just sets the collHistorys collection to an empty array (like clearcollHistorys());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initHistorys()
	{
		$this->collHistorys = array();
	}

	/**
	 * Gets an array of History objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this User has previously been saved, it will retrieve
	 * related Historys from storage. If this User is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array History[]
	 * @throws     PropelException
	 */
	public function getHistorys($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collHistorys === null) {
			if ($this->isNew()) {
			   $this->collHistorys = array();
			} else {

				$criteria->add(HistoryPeer::USER_ID, $this->id);

				HistoryPeer::addSelectColumns($criteria);
				$this->collHistorys = HistoryPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(HistoryPeer::USER_ID, $this->id);

				HistoryPeer::addSelectColumns($criteria);
				if (!isset($this->lastHistoryCriteria) || !$this->lastHistoryCriteria->equals($criteria)) {
					$this->collHistorys = HistoryPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastHistoryCriteria = $criteria;
		return $this->collHistorys;
	}

	/**
	 * Returns the number of related History objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related History objects.
	 * @throws     PropelException
	 */
	public function countHistorys(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UserPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collHistorys === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(HistoryPeer::USER_ID, $this->id);

				$count = HistoryPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(HistoryPeer::USER_ID, $this->id);

				if (!isset($this->lastHistoryCriteria) || !$this->lastHistoryCriteria->equals($criteria)) {
					$count = HistoryPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collHistorys);
				}
			} else {
				$count = count($this->collHistorys);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a History object to this object
	 * through the History foreign key attribute.
	 *
	 * @param      History $l History
	 * @return     void
	 * @throws     PropelException
	 */
	public function addHistory(History $l)
	{
		if ($this->collHistorys === null) {
			$this->initHistorys();
		}
		if (!in_array($l, $this->collHistorys, true)) { // only add it if the **same** object is not already associated
			array_push($this->collHistorys, $l);
			$l->setUser($this);
		}
	}

	/**
	 * Clears out the collItemRatings collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addItemRatings()
	 */
	public function clearItemRatings()
	{
		$this->collItemRatings = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collItemRatings collection (array).
	 *
	 * By default this just sets the collItemRatings collection to an empty array (like clearcollItemRatings());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initItemRatings()
	{
		$this->collItemRatings = array();
	}

	/**
	 * Gets an array of ItemRating objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this User has previously been saved, it will retrieve
	 * related ItemRatings from storage. If this User is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array ItemRating[]
	 * @throws     PropelException
	 */
	public function getItemRatings($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collItemRatings === null) {
			if ($this->isNew()) {
			   $this->collItemRatings = array();
			} else {

				$criteria->add(ItemRatingPeer::USER_ID, $this->id);

				ItemRatingPeer::addSelectColumns($criteria);
				$this->collItemRatings = ItemRatingPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ItemRatingPeer::USER_ID, $this->id);

				ItemRatingPeer::addSelectColumns($criteria);
				if (!isset($this->lastItemRatingCriteria) || !$this->lastItemRatingCriteria->equals($criteria)) {
					$this->collItemRatings = ItemRatingPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastItemRatingCriteria = $criteria;
		return $this->collItemRatings;
	}

	/**
	 * Returns the number of related ItemRating objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related ItemRating objects.
	 * @throws     PropelException
	 */
	public function countItemRatings(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UserPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collItemRatings === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(ItemRatingPeer::USER_ID, $this->id);

				$count = ItemRatingPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(ItemRatingPeer::USER_ID, $this->id);

				if (!isset($this->lastItemRatingCriteria) || !$this->lastItemRatingCriteria->equals($criteria)) {
					$count = ItemRatingPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collItemRatings);
				}
			} else {
				$count = count($this->collItemRatings);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a ItemRating object to this object
	 * through the ItemRating foreign key attribute.
	 *
	 * @param      ItemRating $l ItemRating
	 * @return     void
	 * @throws     PropelException
	 */
	public function addItemRating(ItemRating $l)
	{
		if ($this->collItemRatings === null) {
			$this->initItemRatings();
		}
		if (!in_array($l, $this->collItemRatings, true)) { // only add it if the **same** object is not already associated
			array_push($this->collItemRatings, $l);
			$l->setUser($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related ItemRatings from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getItemRatingsJoinItem($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collItemRatings === null) {
			if ($this->isNew()) {
				$this->collItemRatings = array();
			} else {

				$criteria->add(ItemRatingPeer::USER_ID, $this->id);

				$this->collItemRatings = ItemRatingPeer::doSelectJoinItem($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ItemRatingPeer::USER_ID, $this->id);

			if (!isset($this->lastItemRatingCriteria) || !$this->lastItemRatingCriteria->equals($criteria)) {
				$this->collItemRatings = ItemRatingPeer::doSelectJoinItem($criteria, $con, $join_behavior);
			}
		}
		$this->lastItemRatingCriteria = $criteria;

		return $this->collItemRatings;
	}

	/**
	 * Clears out the collOfferVoucher1s collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addOfferVoucher1s()
	 */
	public function clearOfferVoucher1s()
	{
		$this->collOfferVoucher1s = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collOfferVoucher1s collection (array).
	 *
	 * By default this just sets the collOfferVoucher1s collection to an empty array (like clearcollOfferVoucher1s());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initOfferVoucher1s()
	{
		$this->collOfferVoucher1s = array();
	}

	/**
	 * Gets an array of OfferVoucher1 objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this User has previously been saved, it will retrieve
	 * related OfferVoucher1s from storage. If this User is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array OfferVoucher1[]
	 * @throws     PropelException
	 */
	public function getOfferVoucher1s($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOfferVoucher1s === null) {
			if ($this->isNew()) {
			   $this->collOfferVoucher1s = array();
			} else {

				$criteria->add(OfferVoucher1Peer::USER_ID, $this->id);

				OfferVoucher1Peer::addSelectColumns($criteria);
				$this->collOfferVoucher1s = OfferVoucher1Peer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(OfferVoucher1Peer::USER_ID, $this->id);

				OfferVoucher1Peer::addSelectColumns($criteria);
				if (!isset($this->lastOfferVoucher1Criteria) || !$this->lastOfferVoucher1Criteria->equals($criteria)) {
					$this->collOfferVoucher1s = OfferVoucher1Peer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOfferVoucher1Criteria = $criteria;
		return $this->collOfferVoucher1s;
	}

	/**
	 * Returns the number of related OfferVoucher1 objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related OfferVoucher1 objects.
	 * @throws     PropelException
	 */
	public function countOfferVoucher1s(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UserPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collOfferVoucher1s === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(OfferVoucher1Peer::USER_ID, $this->id);

				$count = OfferVoucher1Peer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(OfferVoucher1Peer::USER_ID, $this->id);

				if (!isset($this->lastOfferVoucher1Criteria) || !$this->lastOfferVoucher1Criteria->equals($criteria)) {
					$count = OfferVoucher1Peer::doCount($criteria, $con);
				} else {
					$count = count($this->collOfferVoucher1s);
				}
			} else {
				$count = count($this->collOfferVoucher1s);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a OfferVoucher1 object to this object
	 * through the OfferVoucher1 foreign key attribute.
	 *
	 * @param      OfferVoucher1 $l OfferVoucher1
	 * @return     void
	 * @throws     PropelException
	 */
	public function addOfferVoucher1(OfferVoucher1 $l)
	{
		if ($this->collOfferVoucher1s === null) {
			$this->initOfferVoucher1s();
		}
		if (!in_array($l, $this->collOfferVoucher1s, true)) { // only add it if the **same** object is not already associated
			array_push($this->collOfferVoucher1s, $l);
			$l->setUser($this);
		}
	}

	/**
	 * Clears out the collPurchaseDetails collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addPurchaseDetails()
	 */
	public function clearPurchaseDetails()
	{
		$this->collPurchaseDetails = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collPurchaseDetails collection (array).
	 *
	 * By default this just sets the collPurchaseDetails collection to an empty array (like clearcollPurchaseDetails());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initPurchaseDetails()
	{
		$this->collPurchaseDetails = array();
	}

	/**
	 * Gets an array of PurchaseDetail objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this User has previously been saved, it will retrieve
	 * related PurchaseDetails from storage. If this User is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array PurchaseDetail[]
	 * @throws     PropelException
	 */
	public function getPurchaseDetails($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPurchaseDetails === null) {
			if ($this->isNew()) {
			   $this->collPurchaseDetails = array();
			} else {

				$criteria->add(PurchaseDetailPeer::USER_ID, $this->id);

				PurchaseDetailPeer::addSelectColumns($criteria);
				$this->collPurchaseDetails = PurchaseDetailPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(PurchaseDetailPeer::USER_ID, $this->id);

				PurchaseDetailPeer::addSelectColumns($criteria);
				if (!isset($this->lastPurchaseDetailCriteria) || !$this->lastPurchaseDetailCriteria->equals($criteria)) {
					$this->collPurchaseDetails = PurchaseDetailPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPurchaseDetailCriteria = $criteria;
		return $this->collPurchaseDetails;
	}

	/**
	 * Returns the number of related PurchaseDetail objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related PurchaseDetail objects.
	 * @throws     PropelException
	 */
	public function countPurchaseDetails(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UserPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collPurchaseDetails === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(PurchaseDetailPeer::USER_ID, $this->id);

				$count = PurchaseDetailPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(PurchaseDetailPeer::USER_ID, $this->id);

				if (!isset($this->lastPurchaseDetailCriteria) || !$this->lastPurchaseDetailCriteria->equals($criteria)) {
					$count = PurchaseDetailPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collPurchaseDetails);
				}
			} else {
				$count = count($this->collPurchaseDetails);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a PurchaseDetail object to this object
	 * through the PurchaseDetail foreign key attribute.
	 *
	 * @param      PurchaseDetail $l PurchaseDetail
	 * @return     void
	 * @throws     PropelException
	 */
	public function addPurchaseDetail(PurchaseDetail $l)
	{
		if ($this->collPurchaseDetails === null) {
			$this->initPurchaseDetails();
		}
		if (!in_array($l, $this->collPurchaseDetails, true)) { // only add it if the **same** object is not already associated
			array_push($this->collPurchaseDetails, $l);
			$l->setUser($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related PurchaseDetails from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getPurchaseDetailsJoinSales($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPurchaseDetails === null) {
			if ($this->isNew()) {
				$this->collPurchaseDetails = array();
			} else {

				$criteria->add(PurchaseDetailPeer::USER_ID, $this->id);

				$this->collPurchaseDetails = PurchaseDetailPeer::doSelectJoinSales($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(PurchaseDetailPeer::USER_ID, $this->id);

			if (!isset($this->lastPurchaseDetailCriteria) || !$this->lastPurchaseDetailCriteria->equals($criteria)) {
				$this->collPurchaseDetails = PurchaseDetailPeer::doSelectJoinSales($criteria, $con, $join_behavior);
			}
		}
		$this->lastPurchaseDetailCriteria = $criteria;

		return $this->collPurchaseDetails;
	}

	/**
	 * Clears out the collShoppingCarts collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addShoppingCarts()
	 */
	public function clearShoppingCarts()
	{
		$this->collShoppingCarts = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collShoppingCarts collection (array).
	 *
	 * By default this just sets the collShoppingCarts collection to an empty array (like clearcollShoppingCarts());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initShoppingCarts()
	{
		$this->collShoppingCarts = array();
	}

	/**
	 * Gets an array of ShoppingCart objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this User has previously been saved, it will retrieve
	 * related ShoppingCarts from storage. If this User is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array ShoppingCart[]
	 * @throws     PropelException
	 */
	public function getShoppingCarts($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collShoppingCarts === null) {
			if ($this->isNew()) {
			   $this->collShoppingCarts = array();
			} else {

				$criteria->add(ShoppingCartPeer::USER_ID, $this->id);

				ShoppingCartPeer::addSelectColumns($criteria);
				$this->collShoppingCarts = ShoppingCartPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ShoppingCartPeer::USER_ID, $this->id);

				ShoppingCartPeer::addSelectColumns($criteria);
				if (!isset($this->lastShoppingCartCriteria) || !$this->lastShoppingCartCriteria->equals($criteria)) {
					$this->collShoppingCarts = ShoppingCartPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastShoppingCartCriteria = $criteria;
		return $this->collShoppingCarts;
	}

	/**
	 * Returns the number of related ShoppingCart objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related ShoppingCart objects.
	 * @throws     PropelException
	 */
	public function countShoppingCarts(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UserPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collShoppingCarts === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(ShoppingCartPeer::USER_ID, $this->id);

				$count = ShoppingCartPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(ShoppingCartPeer::USER_ID, $this->id);

				if (!isset($this->lastShoppingCartCriteria) || !$this->lastShoppingCartCriteria->equals($criteria)) {
					$count = ShoppingCartPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collShoppingCarts);
				}
			} else {
				$count = count($this->collShoppingCarts);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a ShoppingCart object to this object
	 * through the ShoppingCart foreign key attribute.
	 *
	 * @param      ShoppingCart $l ShoppingCart
	 * @return     void
	 * @throws     PropelException
	 */
	public function addShoppingCart(ShoppingCart $l)
	{
		if ($this->collShoppingCarts === null) {
			$this->initShoppingCarts();
		}
		if (!in_array($l, $this->collShoppingCarts, true)) { // only add it if the **same** object is not already associated
			array_push($this->collShoppingCarts, $l);
			$l->setUser($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related ShoppingCarts from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getShoppingCartsJoinItem($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collShoppingCarts === null) {
			if ($this->isNew()) {
				$this->collShoppingCarts = array();
			} else {

				$criteria->add(ShoppingCartPeer::USER_ID, $this->id);

				$this->collShoppingCarts = ShoppingCartPeer::doSelectJoinItem($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ShoppingCartPeer::USER_ID, $this->id);

			if (!isset($this->lastShoppingCartCriteria) || !$this->lastShoppingCartCriteria->equals($criteria)) {
				$this->collShoppingCarts = ShoppingCartPeer::doSelectJoinItem($criteria, $con, $join_behavior);
			}
		}
		$this->lastShoppingCartCriteria = $criteria;

		return $this->collShoppingCarts;
	}

	/**
	 * Clears out the collShoutsRelatedByPosterId collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addShoutsRelatedByPosterId()
	 */
	public function clearShoutsRelatedByPosterId()
	{
		$this->collShoutsRelatedByPosterId = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collShoutsRelatedByPosterId collection (array).
	 *
	 * By default this just sets the collShoutsRelatedByPosterId collection to an empty array (like clearcollShoutsRelatedByPosterId());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initShoutsRelatedByPosterId()
	{
		$this->collShoutsRelatedByPosterId = array();
	}

	/**
	 * Gets an array of Shout objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this User has previously been saved, it will retrieve
	 * related ShoutsRelatedByPosterId from storage. If this User is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array Shout[]
	 * @throws     PropelException
	 */
	public function getShoutsRelatedByPosterId($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collShoutsRelatedByPosterId === null) {
			if ($this->isNew()) {
			   $this->collShoutsRelatedByPosterId = array();
			} else {

				$criteria->add(ShoutPeer::POSTER_ID, $this->id);

				ShoutPeer::addSelectColumns($criteria);
				$this->collShoutsRelatedByPosterId = ShoutPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ShoutPeer::POSTER_ID, $this->id);

				ShoutPeer::addSelectColumns($criteria);
				if (!isset($this->lastShoutRelatedByPosterIdCriteria) || !$this->lastShoutRelatedByPosterIdCriteria->equals($criteria)) {
					$this->collShoutsRelatedByPosterId = ShoutPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastShoutRelatedByPosterIdCriteria = $criteria;
		return $this->collShoutsRelatedByPosterId;
	}

	/**
	 * Returns the number of related Shout objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related Shout objects.
	 * @throws     PropelException
	 */
	public function countShoutsRelatedByPosterId(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UserPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collShoutsRelatedByPosterId === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(ShoutPeer::POSTER_ID, $this->id);

				$count = ShoutPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(ShoutPeer::POSTER_ID, $this->id);

				if (!isset($this->lastShoutRelatedByPosterIdCriteria) || !$this->lastShoutRelatedByPosterIdCriteria->equals($criteria)) {
					$count = ShoutPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collShoutsRelatedByPosterId);
				}
			} else {
				$count = count($this->collShoutsRelatedByPosterId);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a Shout object to this object
	 * through the Shout foreign key attribute.
	 *
	 * @param      Shout $l Shout
	 * @return     void
	 * @throws     PropelException
	 */
	public function addShoutRelatedByPosterId(Shout $l)
	{
		if ($this->collShoutsRelatedByPosterId === null) {
			$this->initShoutsRelatedByPosterId();
		}
		if (!in_array($l, $this->collShoutsRelatedByPosterId, true)) { // only add it if the **same** object is not already associated
			array_push($this->collShoutsRelatedByPosterId, $l);
			$l->setUserRelatedByPosterId($this);
		}
	}

	/**
	 * Clears out the collShoutsRelatedByRecipientId collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addShoutsRelatedByRecipientId()
	 */
	public function clearShoutsRelatedByRecipientId()
	{
		$this->collShoutsRelatedByRecipientId = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collShoutsRelatedByRecipientId collection (array).
	 *
	 * By default this just sets the collShoutsRelatedByRecipientId collection to an empty array (like clearcollShoutsRelatedByRecipientId());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initShoutsRelatedByRecipientId()
	{
		$this->collShoutsRelatedByRecipientId = array();
	}

	/**
	 * Gets an array of Shout objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this User has previously been saved, it will retrieve
	 * related ShoutsRelatedByRecipientId from storage. If this User is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array Shout[]
	 * @throws     PropelException
	 */
	public function getShoutsRelatedByRecipientId($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collShoutsRelatedByRecipientId === null) {
			if ($this->isNew()) {
			   $this->collShoutsRelatedByRecipientId = array();
			} else {

				$criteria->add(ShoutPeer::RECIPIENT_ID, $this->id);

				ShoutPeer::addSelectColumns($criteria);
				$this->collShoutsRelatedByRecipientId = ShoutPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ShoutPeer::RECIPIENT_ID, $this->id);

				ShoutPeer::addSelectColumns($criteria);
				if (!isset($this->lastShoutRelatedByRecipientIdCriteria) || !$this->lastShoutRelatedByRecipientIdCriteria->equals($criteria)) {
					$this->collShoutsRelatedByRecipientId = ShoutPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastShoutRelatedByRecipientIdCriteria = $criteria;
		return $this->collShoutsRelatedByRecipientId;
	}

	/**
	 * Returns the number of related Shout objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related Shout objects.
	 * @throws     PropelException
	 */
	public function countShoutsRelatedByRecipientId(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UserPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collShoutsRelatedByRecipientId === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(ShoutPeer::RECIPIENT_ID, $this->id);

				$count = ShoutPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(ShoutPeer::RECIPIENT_ID, $this->id);

				if (!isset($this->lastShoutRelatedByRecipientIdCriteria) || !$this->lastShoutRelatedByRecipientIdCriteria->equals($criteria)) {
					$count = ShoutPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collShoutsRelatedByRecipientId);
				}
			} else {
				$count = count($this->collShoutsRelatedByRecipientId);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a Shout object to this object
	 * through the Shout foreign key attribute.
	 *
	 * @param      Shout $l Shout
	 * @return     void
	 * @throws     PropelException
	 */
	public function addShoutRelatedByRecipientId(Shout $l)
	{
		if ($this->collShoutsRelatedByRecipientId === null) {
			$this->initShoutsRelatedByRecipientId();
		}
		if (!in_array($l, $this->collShoutsRelatedByRecipientId, true)) { // only add it if the **same** object is not already associated
			array_push($this->collShoutsRelatedByRecipientId, $l);
			$l->setUserRelatedByRecipientId($this);
		}
	}

	/**
	 * Clears out the collUserAwardss collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addUserAwardss()
	 */
	public function clearUserAwardss()
	{
		$this->collUserAwardss = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collUserAwardss collection (array).
	 *
	 * By default this just sets the collUserAwardss collection to an empty array (like clearcollUserAwardss());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initUserAwardss()
	{
		$this->collUserAwardss = array();
	}

	/**
	 * Gets an array of UserAwards objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this User has previously been saved, it will retrieve
	 * related UserAwardss from storage. If this User is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array UserAwards[]
	 * @throws     PropelException
	 */
	public function getUserAwardss($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collUserAwardss === null) {
			if ($this->isNew()) {
			   $this->collUserAwardss = array();
			} else {

				$criteria->add(UserAwardsPeer::USER_ID, $this->id);

				UserAwardsPeer::addSelectColumns($criteria);
				$this->collUserAwardss = UserAwardsPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(UserAwardsPeer::USER_ID, $this->id);

				UserAwardsPeer::addSelectColumns($criteria);
				if (!isset($this->lastUserAwardsCriteria) || !$this->lastUserAwardsCriteria->equals($criteria)) {
					$this->collUserAwardss = UserAwardsPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastUserAwardsCriteria = $criteria;
		return $this->collUserAwardss;
	}

	/**
	 * Returns the number of related UserAwards objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related UserAwards objects.
	 * @throws     PropelException
	 */
	public function countUserAwardss(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UserPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collUserAwardss === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(UserAwardsPeer::USER_ID, $this->id);

				$count = UserAwardsPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(UserAwardsPeer::USER_ID, $this->id);

				if (!isset($this->lastUserAwardsCriteria) || !$this->lastUserAwardsCriteria->equals($criteria)) {
					$count = UserAwardsPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collUserAwardss);
				}
			} else {
				$count = count($this->collUserAwardss);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a UserAwards object to this object
	 * through the UserAwards foreign key attribute.
	 *
	 * @param      UserAwards $l UserAwards
	 * @return     void
	 * @throws     PropelException
	 */
	public function addUserAwards(UserAwards $l)
	{
		if ($this->collUserAwardss === null) {
			$this->initUserAwardss();
		}
		if (!in_array($l, $this->collUserAwardss, true)) { // only add it if the **same** object is not already associated
			array_push($this->collUserAwardss, $l);
			$l->setUser($this);
		}
	}

	/**
	 * Gets a single UserGtalk object, which is related to this object by a one-to-one relationship.
	 *
	 * @param      PropelPDO $con
	 * @return     UserGtalk
	 * @throws     PropelException
	 */
	public function getUserGtalk(PropelPDO $con = null)
	{

		if ($this->singleUserGtalk === null && !$this->isNew()) {
			$this->singleUserGtalk = UserGtalkPeer::retrieveByPK($this->id, $con);
		}

		return $this->singleUserGtalk;
	}

	/**
	 * Sets a single UserGtalk object as related to this object by a one-to-one relationship.
	 *
	 * @param      UserGtalk $l UserGtalk
	 * @return     User The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setUserGtalk(UserGtalk $v)
	{
		$this->singleUserGtalk = $v;

		// Make sure that that the passed-in UserGtalk isn't already associated with this object
		if ($v->getUser() === null) {
			$v->setUser($this);
		}

		return $this;
	}

	/**
	 * Gets a single UserFb object, which is related to this object by a one-to-one relationship.
	 *
	 * @param      PropelPDO $con
	 * @return     UserFb
	 * @throws     PropelException
	 */
	public function getUserFb(PropelPDO $con = null)
	{

		if ($this->singleUserFb === null && !$this->isNew()) {
			$this->singleUserFb = UserFbPeer::retrieveByPK($this->id, $con);
		}

		return $this->singleUserFb;
	}

	/**
	 * Sets a single UserFb object as related to this object by a one-to-one relationship.
	 *
	 * @param      UserFb $l UserFb
	 * @return     User The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setUserFb(UserFb $v)
	{
		$this->singleUserFb = $v;

		// Make sure that that the passed-in UserFb isn't already associated with this object
		if ($v->getUser() === null) {
			$v->setUser($this);
		}

		return $this;
	}

	/**
	 * Clears out the collUserRates collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addUserRates()
	 */
	public function clearUserRates()
	{
		$this->collUserRates = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collUserRates collection (array).
	 *
	 * By default this just sets the collUserRates collection to an empty array (like clearcollUserRates());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initUserRates()
	{
		$this->collUserRates = array();
	}

	/**
	 * Gets an array of UserRate objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this User has previously been saved, it will retrieve
	 * related UserRates from storage. If this User is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array UserRate[]
	 * @throws     PropelException
	 */
	public function getUserRates($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collUserRates === null) {
			if ($this->isNew()) {
			   $this->collUserRates = array();
			} else {

				$criteria->add(UserRatePeer::USERID, $this->id);

				UserRatePeer::addSelectColumns($criteria);
				$this->collUserRates = UserRatePeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(UserRatePeer::USERID, $this->id);

				UserRatePeer::addSelectColumns($criteria);
				if (!isset($this->lastUserRateCriteria) || !$this->lastUserRateCriteria->equals($criteria)) {
					$this->collUserRates = UserRatePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastUserRateCriteria = $criteria;
		return $this->collUserRates;
	}

	/**
	 * Returns the number of related UserRate objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related UserRate objects.
	 * @throws     PropelException
	 */
	public function countUserRates(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UserPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collUserRates === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(UserRatePeer::USERID, $this->id);

				$count = UserRatePeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(UserRatePeer::USERID, $this->id);

				if (!isset($this->lastUserRateCriteria) || !$this->lastUserRateCriteria->equals($criteria)) {
					$count = UserRatePeer::doCount($criteria, $con);
				} else {
					$count = count($this->collUserRates);
				}
			} else {
				$count = count($this->collUserRates);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a UserRate object to this object
	 * through the UserRate foreign key attribute.
	 *
	 * @param      UserRate $l UserRate
	 * @return     void
	 * @throws     PropelException
	 */
	public function addUserRate(UserRate $l)
	{
		if ($this->collUserRates === null) {
			$this->initUserRates();
		}
		if (!in_array($l, $this->collUserRates, true)) { // only add it if the **same** object is not already associated
			array_push($this->collUserRates, $l);
			$l->setUser($this);
		}
	}

	/**
	 * Gets a single UserTutor object, which is related to this object by a one-to-one relationship.
	 *
	 * @param      PropelPDO $con
	 * @return     UserTutor
	 * @throws     PropelException
	 */
	public function getUserTutor(PropelPDO $con = null)
	{

		if ($this->singleUserTutor === null && !$this->isNew()) {
			$this->singleUserTutor = UserTutorPeer::retrieveByPK($this->id, $con);
		}

		return $this->singleUserTutor;
	}

	/**
	 * Sets a single UserTutor object as related to this object by a one-to-one relationship.
	 *
	 * @param      UserTutor $l UserTutor
	 * @return     User The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setUserTutor(UserTutor $v)
	{
		$this->singleUserTutor = $v;

		// Make sure that that the passed-in UserTutor isn't already associated with this object
		if ($v->getUser() === null) {
			$v->setUser($this);
		}

		return $this;
	}

	/**
	 * Clears out the collUserQuestionTags collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addUserQuestionTags()
	 */
	public function clearUserQuestionTags()
	{
		$this->collUserQuestionTags = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collUserQuestionTags collection (array).
	 *
	 * By default this just sets the collUserQuestionTags collection to an empty array (like clearcollUserQuestionTags());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initUserQuestionTags()
	{
		$this->collUserQuestionTags = array();
	}

	/**
	 * Gets an array of UserQuestionTag objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this User has previously been saved, it will retrieve
	 * related UserQuestionTags from storage. If this User is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array UserQuestionTag[]
	 * @throws     PropelException
	 */
	public function getUserQuestionTags($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collUserQuestionTags === null) {
			if ($this->isNew()) {
			   $this->collUserQuestionTags = array();
			} else {

				$criteria->add(UserQuestionTagPeer::USER_ID, $this->id);

				UserQuestionTagPeer::addSelectColumns($criteria);
				$this->collUserQuestionTags = UserQuestionTagPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(UserQuestionTagPeer::USER_ID, $this->id);

				UserQuestionTagPeer::addSelectColumns($criteria);
				if (!isset($this->lastUserQuestionTagCriteria) || !$this->lastUserQuestionTagCriteria->equals($criteria)) {
					$this->collUserQuestionTags = UserQuestionTagPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastUserQuestionTagCriteria = $criteria;
		return $this->collUserQuestionTags;
	}

	/**
	 * Returns the number of related UserQuestionTag objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related UserQuestionTag objects.
	 * @throws     PropelException
	 */
	public function countUserQuestionTags(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UserPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collUserQuestionTags === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(UserQuestionTagPeer::USER_ID, $this->id);

				$count = UserQuestionTagPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(UserQuestionTagPeer::USER_ID, $this->id);

				if (!isset($this->lastUserQuestionTagCriteria) || !$this->lastUserQuestionTagCriteria->equals($criteria)) {
					$count = UserQuestionTagPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collUserQuestionTags);
				}
			} else {
				$count = count($this->collUserQuestionTags);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a UserQuestionTag object to this object
	 * through the UserQuestionTag foreign key attribute.
	 *
	 * @param      UserQuestionTag $l UserQuestionTag
	 * @return     void
	 * @throws     PropelException
	 */
	public function addUserQuestionTag(UserQuestionTag $l)
	{
		if ($this->collUserQuestionTags === null) {
			$this->initUserQuestionTags();
		}
		if (!in_array($l, $this->collUserQuestionTags, true)) { // only add it if the **same** object is not already associated
			array_push($this->collUserQuestionTags, $l);
			$l->setUser($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related UserQuestionTags from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getUserQuestionTagsJoinCategory($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collUserQuestionTags === null) {
			if ($this->isNew()) {
				$this->collUserQuestionTags = array();
			} else {

				$criteria->add(UserQuestionTagPeer::USER_ID, $this->id);

				$this->collUserQuestionTags = UserQuestionTagPeer::doSelectJoinCategory($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(UserQuestionTagPeer::USER_ID, $this->id);

			if (!isset($this->lastUserQuestionTagCriteria) || !$this->lastUserQuestionTagCriteria->equals($criteria)) {
				$this->collUserQuestionTags = UserQuestionTagPeer::doSelectJoinCategory($criteria, $con, $join_behavior);
			}
		}
		$this->lastUserQuestionTagCriteria = $criteria;

		return $this->collUserQuestionTags;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related UserQuestionTags from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getUserQuestionTagsJoinCourses($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collUserQuestionTags === null) {
			if ($this->isNew()) {
				$this->collUserQuestionTags = array();
			} else {

				$criteria->add(UserQuestionTagPeer::USER_ID, $this->id);

				$this->collUserQuestionTags = UserQuestionTagPeer::doSelectJoinCourses($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(UserQuestionTagPeer::USER_ID, $this->id);

			if (!isset($this->lastUserQuestionTagCriteria) || !$this->lastUserQuestionTagCriteria->equals($criteria)) {
				$this->collUserQuestionTags = UserQuestionTagPeer::doSelectJoinCourses($criteria, $con, $join_behavior);
			}
		}
		$this->lastUserQuestionTagCriteria = $criteria;

		return $this->collUserQuestionTags;
	}

	/**
	 * Clears out the collStudentQuestionsRelatedByStudentId collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addStudentQuestionsRelatedByStudentId()
	 */
	public function clearStudentQuestionsRelatedByStudentId()
	{
		$this->collStudentQuestionsRelatedByStudentId = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collStudentQuestionsRelatedByStudentId collection (array).
	 *
	 * By default this just sets the collStudentQuestionsRelatedByStudentId collection to an empty array (like clearcollStudentQuestionsRelatedByStudentId());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initStudentQuestionsRelatedByStudentId()
	{
		$this->collStudentQuestionsRelatedByStudentId = array();
	}

	/**
	 * Gets an array of StudentQuestion objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this User has previously been saved, it will retrieve
	 * related StudentQuestionsRelatedByStudentId from storage. If this User is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array StudentQuestion[]
	 * @throws     PropelException
	 */
	public function getStudentQuestionsRelatedByStudentId($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collStudentQuestionsRelatedByStudentId === null) {
			if ($this->isNew()) {
			   $this->collStudentQuestionsRelatedByStudentId = array();
			} else {

				$criteria->add(StudentQuestionPeer::USER_ID, $this->id);

				StudentQuestionPeer::addSelectColumns($criteria);
				$this->collStudentQuestionsRelatedByStudentId = StudentQuestionPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(StudentQuestionPeer::USER_ID, $this->id);

				StudentQuestionPeer::addSelectColumns($criteria);
				if (!isset($this->lastStudentQuestionRelatedByStudentIdCriteria) || !$this->lastStudentQuestionRelatedByStudentIdCriteria->equals($criteria)) {
					$this->collStudentQuestionsRelatedByStudentId = StudentQuestionPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastStudentQuestionRelatedByStudentIdCriteria = $criteria;
		return $this->collStudentQuestionsRelatedByStudentId;
	}

	/**
	 * Returns the number of related StudentQuestion objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related StudentQuestion objects.
	 * @throws     PropelException
	 */
	public function countStudentQuestionsRelatedByStudentId(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UserPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collStudentQuestionsRelatedByStudentId === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(StudentQuestionPeer::USER_ID, $this->id);

				$count = StudentQuestionPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(StudentQuestionPeer::USER_ID, $this->id);

				if (!isset($this->lastStudentQuestionRelatedByStudentIdCriteria) || !$this->lastStudentQuestionRelatedByStudentIdCriteria->equals($criteria)) {
					$count = StudentQuestionPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collStudentQuestionsRelatedByStudentId);
				}
			} else {
				$count = count($this->collStudentQuestionsRelatedByStudentId);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a StudentQuestion object to this object
	 * through the StudentQuestion foreign key attribute.
	 *
	 * @param      StudentQuestion $l StudentQuestion
	 * @return     void
	 * @throws     PropelException
	 */
	public function addStudentQuestionRelatedByStudentId(StudentQuestion $l)
	{
		if ($this->collStudentQuestionsRelatedByStudentId === null) {
			$this->initStudentQuestionsRelatedByStudentId();
		}
		if (!in_array($l, $this->collStudentQuestionsRelatedByStudentId, true)) { // only add it if the **same** object is not already associated
			array_push($this->collStudentQuestionsRelatedByStudentId, $l);
			$l->setUserRelatedByStudentId($this);
		}
	}

	/**
	 * Clears out the collStudentQuestionsRelatedByTutorId collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addStudentQuestionsRelatedByTutorId()
	 */
	public function clearStudentQuestionsRelatedByTutorId()
	{
		$this->collStudentQuestionsRelatedByTutorId = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collStudentQuestionsRelatedByTutorId collection (array).
	 *
	 * By default this just sets the collStudentQuestionsRelatedByTutorId collection to an empty array (like clearcollStudentQuestionsRelatedByTutorId());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initStudentQuestionsRelatedByTutorId()
	{
		$this->collStudentQuestionsRelatedByTutorId = array();
	}

	/**
	 * Gets an array of StudentQuestion objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this User has previously been saved, it will retrieve
	 * related StudentQuestionsRelatedByTutorId from storage. If this User is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array StudentQuestion[]
	 * @throws     PropelException
	 */
	public function getStudentQuestionsRelatedByTutorId($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collStudentQuestionsRelatedByTutorId === null) {
			if ($this->isNew()) {
			   $this->collStudentQuestionsRelatedByTutorId = array();
			} else {

				$criteria->add(StudentQuestionPeer::CHECKED_ID, $this->id);

				StudentQuestionPeer::addSelectColumns($criteria);
				$this->collStudentQuestionsRelatedByTutorId = StudentQuestionPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(StudentQuestionPeer::CHECKED_ID, $this->id);

				StudentQuestionPeer::addSelectColumns($criteria);
				if (!isset($this->lastStudentQuestionRelatedByTutorIdCriteria) || !$this->lastStudentQuestionRelatedByTutorIdCriteria->equals($criteria)) {
					$this->collStudentQuestionsRelatedByTutorId = StudentQuestionPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastStudentQuestionRelatedByTutorIdCriteria = $criteria;
		return $this->collStudentQuestionsRelatedByTutorId;
	}

	/**
	 * Returns the number of related StudentQuestion objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related StudentQuestion objects.
	 * @throws     PropelException
	 */
	public function countStudentQuestionsRelatedByTutorId(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UserPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collStudentQuestionsRelatedByTutorId === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(StudentQuestionPeer::CHECKED_ID, $this->id);

				$count = StudentQuestionPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(StudentQuestionPeer::CHECKED_ID, $this->id);

				if (!isset($this->lastStudentQuestionRelatedByTutorIdCriteria) || !$this->lastStudentQuestionRelatedByTutorIdCriteria->equals($criteria)) {
					$count = StudentQuestionPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collStudentQuestionsRelatedByTutorId);
				}
			} else {
				$count = count($this->collStudentQuestionsRelatedByTutorId);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a StudentQuestion object to this object
	 * through the StudentQuestion foreign key attribute.
	 *
	 * @param      StudentQuestion $l StudentQuestion
	 * @return     void
	 * @throws     PropelException
	 */
	public function addStudentQuestionRelatedByTutorId(StudentQuestion $l)
	{
		if ($this->collStudentQuestionsRelatedByTutorId === null) {
			$this->initStudentQuestionsRelatedByTutorId();
		}
		if (!in_array($l, $this->collStudentQuestionsRelatedByTutorId, true)) { // only add it if the **same** object is not already associated
			array_push($this->collStudentQuestionsRelatedByTutorId, $l);
			$l->setUserRelatedByTutorId($this);
		}
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
	 * Otherwise if this User has previously been saved, it will retrieve
	 * related WhiteboardSessions from storage. If this User is new, it will return
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
			$criteria = new Criteria(UserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collWhiteboardSessions === null) {
			if ($this->isNew()) {
			   $this->collWhiteboardSessions = array();
			} else {

				$criteria->add(WhiteboardSessionPeer::USER_ID, $this->id);

				WhiteboardSessionPeer::addSelectColumns($criteria);
				$this->collWhiteboardSessions = WhiteboardSessionPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(WhiteboardSessionPeer::USER_ID, $this->id);

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
			$criteria = new Criteria(UserPeer::DATABASE_NAME);
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

				$criteria->add(WhiteboardSessionPeer::USER_ID, $this->id);

				$count = WhiteboardSessionPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(WhiteboardSessionPeer::USER_ID, $this->id);

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
			$l->setUser($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related WhiteboardSessions from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getWhiteboardSessionsJoinStudentQuestion($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collWhiteboardSessions === null) {
			if ($this->isNew()) {
				$this->collWhiteboardSessions = array();
			} else {

				$criteria->add(WhiteboardSessionPeer::USER_ID, $this->id);

				$this->collWhiteboardSessions = WhiteboardSessionPeer::doSelectJoinStudentQuestion($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(WhiteboardSessionPeer::USER_ID, $this->id);

			if (!isset($this->lastWhiteboardSessionCriteria) || !$this->lastWhiteboardSessionCriteria->equals($criteria)) {
				$this->collWhiteboardSessions = WhiteboardSessionPeer::doSelectJoinStudentQuestion($criteria, $con, $join_behavior);
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
			if ($this->collExperts) {
				foreach ((array) $this->collExperts as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collExpertCategorys) {
				foreach ((array) $this->collExpertCategorys as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collHistorys) {
				foreach ((array) $this->collHistorys as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collItemRatings) {
				foreach ((array) $this->collItemRatings as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collOfferVoucher1s) {
				foreach ((array) $this->collOfferVoucher1s as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collPurchaseDetails) {
				foreach ((array) $this->collPurchaseDetails as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collShoppingCarts) {
				foreach ((array) $this->collShoppingCarts as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collShoutsRelatedByPosterId) {
				foreach ((array) $this->collShoutsRelatedByPosterId as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collShoutsRelatedByRecipientId) {
				foreach ((array) $this->collShoutsRelatedByRecipientId as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collUserAwardss) {
				foreach ((array) $this->collUserAwardss as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->singleUserGtalk) {
				$this->singleUserGtalk->clearAllReferences($deep);
			}
			if ($this->singleUserFb) {
				$this->singleUserFb->clearAllReferences($deep);
			}
			if ($this->collUserRates) {
				foreach ((array) $this->collUserRates as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->singleUserTutor) {
				$this->singleUserTutor->clearAllReferences($deep);
			}
			if ($this->collUserQuestionTags) {
				foreach ((array) $this->collUserQuestionTags as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collStudentQuestionsRelatedByStudentId) {
				foreach ((array) $this->collStudentQuestionsRelatedByStudentId as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collStudentQuestionsRelatedByTutorId) {
				foreach ((array) $this->collStudentQuestionsRelatedByTutorId as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collWhiteboardSessions) {
				foreach ((array) $this->collWhiteboardSessions as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		$this->collExperts = null;
		$this->collExpertCategorys = null;
		$this->collHistorys = null;
		$this->collItemRatings = null;
		$this->collOfferVoucher1s = null;
		$this->collPurchaseDetails = null;
		$this->collShoppingCarts = null;
		$this->collShoutsRelatedByPosterId = null;
		$this->collShoutsRelatedByRecipientId = null;
		$this->collUserAwardss = null;
		$this->singleUserGtalk = null;
		$this->singleUserFb = null;
		$this->collUserRates = null;
		$this->singleUserTutor = null;
		$this->collUserQuestionTags = null;
		$this->collStudentQuestionsRelatedByStudentId = null;
		$this->collStudentQuestionsRelatedByTutorId = null;
		$this->collWhiteboardSessions = null;
	}

} // BaseUser
