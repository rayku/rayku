<?php

/**
 * Base static class for performing query and update operations on the 'user' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseUserPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'propel';

	/** the table name for this class */
	const TABLE_NAME = 'user';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'lib.model.User';

	/** The total number of columns. */
	const NUM_COLUMNS = 36;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;

	/** the column name for the ID field */
	const ID = 'user.ID';

	/** the column name for the USERNAME field */
	const USERNAME = 'user.USERNAME';

	/** the column name for the EMAIL field */
	const EMAIL = 'user.EMAIL';

	/** the column name for the PASSWORD field */
	const PASSWORD = 'user.PASSWORD';

	/** the column name for the POINTS field */
	const POINTS = 'user.POINTS';

	/** the column name for the CREATED_AT field */
	const CREATED_AT = 'user.CREATED_AT';

	/** the column name for the LAST_ACTIVITY_AT field */
	const LAST_ACTIVITY_AT = 'user.LAST_ACTIVITY_AT';

	/** the column name for the TYPE field */
	const TYPE = 'user.TYPE';

	/** the column name for the HIDDEN field */
	const HIDDEN = 'user.HIDDEN';

	/** the column name for the NAME field */
	const NAME = 'user.NAME';

	/** the column name for the GENDER field */
	const GENDER = 'user.GENDER';

	/** the column name for the HOMETOWN field */
	const HOMETOWN = 'user.HOMETOWN';

	/** the column name for the HOME_PHONE field */
	const HOME_PHONE = 'user.HOME_PHONE';

	/** the column name for the MOBILE_PHONE field */
	const MOBILE_PHONE = 'user.MOBILE_PHONE';

	/** the column name for the BIRTHDATE field */
	const BIRTHDATE = 'user.BIRTHDATE';

	/** the column name for the ADDRESS field */
	const ADDRESS = 'user.ADDRESS';

	/** the column name for the RELATIONSHIP_STATUS field */
	const RELATIONSHIP_STATUS = 'user.RELATIONSHIP_STATUS';

	/** the column name for the SHOW_EMAIL field */
	const SHOW_EMAIL = 'user.SHOW_EMAIL';

	/** the column name for the SHOW_GENDER field */
	const SHOW_GENDER = 'user.SHOW_GENDER';

	/** the column name for the SHOW_HOMETOWN field */
	const SHOW_HOMETOWN = 'user.SHOW_HOMETOWN';

	/** the column name for the SHOW_HOME_PHONE field */
	const SHOW_HOME_PHONE = 'user.SHOW_HOME_PHONE';

	/** the column name for the SHOW_MOBILE_PHONE field */
	const SHOW_MOBILE_PHONE = 'user.SHOW_MOBILE_PHONE';

	/** the column name for the SHOW_BIRTHDATE field */
	const SHOW_BIRTHDATE = 'user.SHOW_BIRTHDATE';

	/** the column name for the SHOW_ADDRESS field */
	const SHOW_ADDRESS = 'user.SHOW_ADDRESS';

	/** the column name for the SHOW_RELATIONSHIP_STATUS field */
	const SHOW_RELATIONSHIP_STATUS = 'user.SHOW_RELATIONSHIP_STATUS';

	/** the column name for the PASSWORD_RECOVER_KEY field */
	const PASSWORD_RECOVER_KEY = 'user.PASSWORD_RECOVER_KEY';

	/** the column name for the COOKIE_KEY field */
	const COOKIE_KEY = 'user.COOKIE_KEY';

	/** the column name for the CREDIT field */
	const CREDIT = 'user.CREDIT';

	/** the column name for the INVISIBLE field */
	const INVISIBLE = 'user.INVISIBLE';

	/** the column name for the NOTIFICATION field */
	const NOTIFICATION = 'user.NOTIFICATION';

	/** the column name for the PHONE_NUMBER field */
	const PHONE_NUMBER = 'user.PHONE_NUMBER';

	/** the column name for the LOGIN field */
	const LOGIN = 'user.LOGIN';

	/** the column name for the CREDIT_CARD field */
	const CREDIT_CARD = 'user.CREDIT_CARD';

	/** the column name for the CREDIT_CARD_TOKEN field */
	const CREDIT_CARD_TOKEN = 'user.CREDIT_CARD_TOKEN';

	/** the column name for the FIRST_CHARGE field */
	const FIRST_CHARGE = 'user.FIRST_CHARGE';

	/** the column name for the WHERE_FIND_US field */
	const WHERE_FIND_US = 'user.WHERE_FIND_US';

	/**
	 * An identiy map to hold any loaded instances of User objects.
	 * This must be public so that other peer classes can access this when hydrating from JOIN
	 * queries.
	 * @var        array User[]
	 */
	public static $instances = array();

	/**
	 * The MapBuilder instance for this peer.
	 * @var        MapBuilder
	 */
	private static $mapBuilder = null;

	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'Username', 'Email', 'Password', 'Points', 'CreatedAt', 'LastActivityAt', 'Type', 'Hidden', 'Name', 'Gender', 'Hometown', 'HomePhone', 'MobilePhone', 'Birthdate', 'Address', 'RelationshipStatus', 'ShowEmail', 'ShowGender', 'ShowHometown', 'ShowHomePhone', 'ShowMobilePhone', 'ShowBirthdate', 'ShowAddress', 'ShowRelationshipStatus', 'PasswordRecoverKey', 'CookieKey', 'Credit', 'Invisible', 'Notification', 'PhoneNumber', 'Login', 'CreditCard', 'CreditCardToken', 'FirstCharge', 'WhereFindUs', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('id', 'username', 'email', 'password', 'points', 'createdAt', 'lastActivityAt', 'type', 'hidden', 'name', 'gender', 'hometown', 'homePhone', 'mobilePhone', 'birthdate', 'address', 'relationshipStatus', 'showEmail', 'showGender', 'showHometown', 'showHomePhone', 'showMobilePhone', 'showBirthdate', 'showAddress', 'showRelationshipStatus', 'passwordRecoverKey', 'cookieKey', 'credit', 'invisible', 'notification', 'phoneNumber', 'login', 'creditCard', 'creditCardToken', 'firstCharge', 'whereFindUs', ),
		BasePeer::TYPE_COLNAME => array (self::ID, self::USERNAME, self::EMAIL, self::PASSWORD, self::POINTS, self::CREATED_AT, self::LAST_ACTIVITY_AT, self::TYPE, self::HIDDEN, self::NAME, self::GENDER, self::HOMETOWN, self::HOME_PHONE, self::MOBILE_PHONE, self::BIRTHDATE, self::ADDRESS, self::RELATIONSHIP_STATUS, self::SHOW_EMAIL, self::SHOW_GENDER, self::SHOW_HOMETOWN, self::SHOW_HOME_PHONE, self::SHOW_MOBILE_PHONE, self::SHOW_BIRTHDATE, self::SHOW_ADDRESS, self::SHOW_RELATIONSHIP_STATUS, self::PASSWORD_RECOVER_KEY, self::COOKIE_KEY, self::CREDIT, self::INVISIBLE, self::NOTIFICATION, self::PHONE_NUMBER, self::LOGIN, self::CREDIT_CARD, self::CREDIT_CARD_TOKEN, self::FIRST_CHARGE, self::WHERE_FIND_US, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'username', 'email', 'password', 'points', 'created_at', 'last_activity_at', 'type', 'hidden', 'name', 'gender', 'hometown', 'home_phone', 'mobile_phone', 'birthdate', 'address', 'relationship_status', 'show_email', 'show_gender', 'show_hometown', 'show_home_phone', 'show_mobile_phone', 'show_birthdate', 'show_address', 'show_relationship_status', 'password_recover_key', 'cookie_key', 'credit', 'invisible', 'notification', 'phone_number', 'login', 'credit_card', 'credit_card_token', 'first_charge', 'where_find_us', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'Username' => 1, 'Email' => 2, 'Password' => 3, 'Points' => 4, 'CreatedAt' => 5, 'LastActivityAt' => 6, 'Type' => 7, 'Hidden' => 8, 'Name' => 9, 'Gender' => 10, 'Hometown' => 11, 'HomePhone' => 12, 'MobilePhone' => 13, 'Birthdate' => 14, 'Address' => 15, 'RelationshipStatus' => 16, 'ShowEmail' => 17, 'ShowGender' => 18, 'ShowHometown' => 19, 'ShowHomePhone' => 20, 'ShowMobilePhone' => 21, 'ShowBirthdate' => 22, 'ShowAddress' => 23, 'ShowRelationshipStatus' => 24, 'PasswordRecoverKey' => 25, 'CookieKey' => 26, 'Credit' => 27, 'Invisible' => 28, 'Notification' => 29, 'PhoneNumber' => 30, 'Login' => 31, 'CreditCard' => 32, 'CreditCardToken' => 33, 'FirstCharge' => 34, 'WhereFindUs' => 35, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('id' => 0, 'username' => 1, 'email' => 2, 'password' => 3, 'points' => 4, 'createdAt' => 5, 'lastActivityAt' => 6, 'type' => 7, 'hidden' => 8, 'name' => 9, 'gender' => 10, 'hometown' => 11, 'homePhone' => 12, 'mobilePhone' => 13, 'birthdate' => 14, 'address' => 15, 'relationshipStatus' => 16, 'showEmail' => 17, 'showGender' => 18, 'showHometown' => 19, 'showHomePhone' => 20, 'showMobilePhone' => 21, 'showBirthdate' => 22, 'showAddress' => 23, 'showRelationshipStatus' => 24, 'passwordRecoverKey' => 25, 'cookieKey' => 26, 'credit' => 27, 'invisible' => 28, 'notification' => 29, 'phoneNumber' => 30, 'login' => 31, 'creditCard' => 32, 'creditCardToken' => 33, 'firstCharge' => 34, 'whereFindUs' => 35, ),
		BasePeer::TYPE_COLNAME => array (self::ID => 0, self::USERNAME => 1, self::EMAIL => 2, self::PASSWORD => 3, self::POINTS => 4, self::CREATED_AT => 5, self::LAST_ACTIVITY_AT => 6, self::TYPE => 7, self::HIDDEN => 8, self::NAME => 9, self::GENDER => 10, self::HOMETOWN => 11, self::HOME_PHONE => 12, self::MOBILE_PHONE => 13, self::BIRTHDATE => 14, self::ADDRESS => 15, self::RELATIONSHIP_STATUS => 16, self::SHOW_EMAIL => 17, self::SHOW_GENDER => 18, self::SHOW_HOMETOWN => 19, self::SHOW_HOME_PHONE => 20, self::SHOW_MOBILE_PHONE => 21, self::SHOW_BIRTHDATE => 22, self::SHOW_ADDRESS => 23, self::SHOW_RELATIONSHIP_STATUS => 24, self::PASSWORD_RECOVER_KEY => 25, self::COOKIE_KEY => 26, self::CREDIT => 27, self::INVISIBLE => 28, self::NOTIFICATION => 29, self::PHONE_NUMBER => 30, self::LOGIN => 31, self::CREDIT_CARD => 32, self::CREDIT_CARD_TOKEN => 33, self::FIRST_CHARGE => 34, self::WHERE_FIND_US => 35, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'username' => 1, 'email' => 2, 'password' => 3, 'points' => 4, 'created_at' => 5, 'last_activity_at' => 6, 'type' => 7, 'hidden' => 8, 'name' => 9, 'gender' => 10, 'hometown' => 11, 'home_phone' => 12, 'mobile_phone' => 13, 'birthdate' => 14, 'address' => 15, 'relationship_status' => 16, 'show_email' => 17, 'show_gender' => 18, 'show_hometown' => 19, 'show_home_phone' => 20, 'show_mobile_phone' => 21, 'show_birthdate' => 22, 'show_address' => 23, 'show_relationship_status' => 24, 'password_recover_key' => 25, 'cookie_key' => 26, 'credit' => 27, 'invisible' => 28, 'notification' => 29, 'phone_number' => 30, 'login' => 31, 'credit_card' => 32, 'credit_card_token' => 33, 'first_charge' => 34, 'where_find_us' => 35, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, )
	);

	/**
	 * Get a (singleton) instance of the MapBuilder for this peer class.
	 * @return     MapBuilder The map builder for this peer
	 */
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new UserMapBuilder();
		}
		return self::$mapBuilder;
	}
	/**
	 * Translates a fieldname to another type
	 *
	 * @param      string $name field name
	 * @param      string $fromType One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                         BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @param      string $toType   One of the class type constants
	 * @return     string translated name of the field.
	 * @throws     PropelException - if the specified name could not be found in the fieldname mappings.
	 */
	static public function translateFieldName($name, $fromType, $toType)
	{
		$toNames = self::getFieldNames($toType);
		$key = isset(self::$fieldKeys[$fromType][$name]) ? self::$fieldKeys[$fromType][$name] : null;
		if ($key === null) {
			throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(self::$fieldKeys[$fromType], true));
		}
		return $toNames[$key];
	}

	/**
	 * Returns an array of field names.
	 *
	 * @param      string $type The type of fieldnames to return:
	 *                      One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                      BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     array A list of field names
	 */

	static public function getFieldNames($type = BasePeer::TYPE_PHPNAME)
	{
		if (!array_key_exists($type, self::$fieldNames)) {
			throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
		}
		return self::$fieldNames[$type];
	}

	/**
	 * Convenience method which changes table.column to alias.column.
	 *
	 * Using this method you can maintain SQL abstraction while using column aliases.
	 * <code>
	 *		$c->addAlias("alias1", TablePeer::TABLE_NAME);
	 *		$c->addJoin(TablePeer::alias("alias1", TablePeer::PRIMARY_KEY_COLUMN), TablePeer::PRIMARY_KEY_COLUMN);
	 * </code>
	 * @param      string $alias The alias for the current table.
	 * @param      string $column The column name for current table. (i.e. UserPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(UserPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	/**
	 * Add all the columns needed to create a new object.
	 *
	 * Note: any columns that were marked with lazyLoad="true" in the
	 * XML schema will not be added to the select list and only loaded
	 * on demand.
	 *
	 * @param      criteria object containing the columns to add.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(UserPeer::ID);

		$criteria->addSelectColumn(UserPeer::USERNAME);

		$criteria->addSelectColumn(UserPeer::EMAIL);

		$criteria->addSelectColumn(UserPeer::PASSWORD);

		$criteria->addSelectColumn(UserPeer::POINTS);

		$criteria->addSelectColumn(UserPeer::CREATED_AT);

		$criteria->addSelectColumn(UserPeer::LAST_ACTIVITY_AT);

		$criteria->addSelectColumn(UserPeer::TYPE);

		$criteria->addSelectColumn(UserPeer::HIDDEN);

		$criteria->addSelectColumn(UserPeer::NAME);

		$criteria->addSelectColumn(UserPeer::GENDER);

		$criteria->addSelectColumn(UserPeer::HOMETOWN);

		$criteria->addSelectColumn(UserPeer::HOME_PHONE);

		$criteria->addSelectColumn(UserPeer::MOBILE_PHONE);

		$criteria->addSelectColumn(UserPeer::BIRTHDATE);

		$criteria->addSelectColumn(UserPeer::ADDRESS);

		$criteria->addSelectColumn(UserPeer::RELATIONSHIP_STATUS);

		$criteria->addSelectColumn(UserPeer::SHOW_EMAIL);

		$criteria->addSelectColumn(UserPeer::SHOW_GENDER);

		$criteria->addSelectColumn(UserPeer::SHOW_HOMETOWN);

		$criteria->addSelectColumn(UserPeer::SHOW_HOME_PHONE);

		$criteria->addSelectColumn(UserPeer::SHOW_MOBILE_PHONE);

		$criteria->addSelectColumn(UserPeer::SHOW_BIRTHDATE);

		$criteria->addSelectColumn(UserPeer::SHOW_ADDRESS);

		$criteria->addSelectColumn(UserPeer::SHOW_RELATIONSHIP_STATUS);

		$criteria->addSelectColumn(UserPeer::PASSWORD_RECOVER_KEY);

		$criteria->addSelectColumn(UserPeer::COOKIE_KEY);

		$criteria->addSelectColumn(UserPeer::CREDIT);

		$criteria->addSelectColumn(UserPeer::INVISIBLE);

		$criteria->addSelectColumn(UserPeer::NOTIFICATION);

		$criteria->addSelectColumn(UserPeer::PHONE_NUMBER);

		$criteria->addSelectColumn(UserPeer::LOGIN);

		$criteria->addSelectColumn(UserPeer::CREDIT_CARD);

		$criteria->addSelectColumn(UserPeer::CREDIT_CARD_TOKEN);

		$criteria->addSelectColumn(UserPeer::FIRST_CHARGE);

		$criteria->addSelectColumn(UserPeer::WHERE_FIND_US);

	}

	/**
	 * Returns the number of rows matching criteria.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @return     int Number of matching rows.
	 */
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
		// we may modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(UserPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			UserPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		$criteria->setDbName(self::DATABASE_NAME); // Set the correct dbName

		if ($con === null) {
			$con = Propel::getConnection(UserPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// BasePeer returns a PDOStatement
		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}
	/**
	 * Method to select one object from the DB.
	 *
	 * @param      Criteria $criteria object used to create the SELECT statement.
	 * @param      PropelPDO $con
	 * @return     User
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = UserPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	/**
	 * Method to do selects.
	 *
	 * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
	 * @param      PropelPDO $con
	 * @return     array Array of selected Objects
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return UserPeer::populateObjects(UserPeer::doSelectStmt($criteria, $con));
	}
	/**
	 * Prepares the Criteria object and uses the parent doSelect() method to execute a PDOStatement.
	 *
	 * Use this method directly if you want to work with an executed statement durirectly (for example
	 * to perform your own object hydration).
	 *
	 * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
	 * @param      PropelPDO $con The connection to use
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 * @return     PDOStatement The executed PDOStatement object.
	 * @see        BasePeer::doSelect()
	 */
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(UserPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			UserPeer::addSelectColumns($criteria);
		}

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		// BasePeer returns a PDOStatement
		return BasePeer::doSelect($criteria, $con);
	}
	/**
	 * Adds an object to the instance pool.
	 *
	 * Propel keeps cached copies of objects in an instance pool when they are retrieved
	 * from the database.  In some cases -- especially when you override doSelect*()
	 * methods in your stub classes -- you may need to explicitly add objects
	 * to the cache in order to ensure that the same objects are always returned by doSelect*()
	 * and retrieveByPK*() calls.
	 *
	 * @param      User $value A User object.
	 * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
	 */
	public static function addInstanceToPool(User $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getId();
			} // if key === null
			self::$instances[$key] = $obj;
		}
	}

	/**
	 * Removes an object from the instance pool.
	 *
	 * Propel keeps cached copies of objects in an instance pool when they are retrieved
	 * from the database.  In some cases -- especially when you override doDelete
	 * methods in your stub classes -- you may need to explicitly remove objects
	 * from the cache in order to prevent returning objects that no longer exist.
	 *
	 * @param      mixed $value A User object or a primary key value.
	 */
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof User) {
				$key = (string) $value->getId();
			} elseif (is_scalar($value)) {
				// assume we've been passed a primary key
				$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or User object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
				throw $e;
			}

			unset(self::$instances[$key]);
		}
	} // removeInstanceFromPool()

	/**
	 * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
	 *
	 * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
	 * a multi-column primary key, a serialize()d version of the primary key will be returned.
	 *
	 * @param      string $key The key (@see getPrimaryKeyHash()) for this instance.
	 * @return     User Found object or NULL if 1) no instance exists for specified key or 2) instance pooling has been disabled.
	 * @see        getPrimaryKeyHash()
	 */
	public static function getInstanceFromPool($key)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if (isset(self::$instances[$key])) {
				return self::$instances[$key];
			}
		}
		return null; // just to be explicit
	}
	
	/**
	 * Clear the instance pool.
	 *
	 * @return     void
	 */
	public static function clearInstancePool()
	{
		self::$instances = array();
	}
	
	/**
	 * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
	 *
	 * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
	 * a multi-column primary key, a serialize()d version of the primary key will be returned.
	 *
	 * @param      array $row PropelPDO resultset row.
	 * @param      int $startcol The 0-based offset for reading from the resultset row.
	 * @return     string A string version of PK or NULL if the components of primary key in result array are all null.
	 */
	public static function getPrimaryKeyHashFromRow($row, $startcol = 0)
	{
		// If the PK cannot be derived from the row, return NULL.
		if ($row[$startcol + 0] === null) {
			return null;
		}
		return (string) $row[$startcol + 0];
	}

	/**
	 * The returned array will contain objects of the default type or
	 * objects that inherit from the default.
	 *
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function populateObjects(PDOStatement $stmt)
	{
		$results = array();
	
		// set the class once to avoid overhead in the loop
		$cls = UserPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
		// populate the object(s)
		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = UserPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = UserPeer::getInstanceFromPool($key))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj->hydrate($row, 0, true); // rehydrate
				$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				UserPeer::addInstanceToPool($obj, $key);
			} // if key exists
		}
		$stmt->closeCursor();
		return $results;
	}

  static public function getUniqueColumnNames()
  {
    return array(array('username'), array('email'), array('password_recover_key'));
  }
	/**
	 * Returns the TableMap related to this peer.
	 * This method is not needed for general use but a specific application could have a need.
	 * @return     TableMap
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	/**
	 * The class that the Peer will make instances of.
	 *
	 * This uses a dot-path notation which is tranalted into a path
	 * relative to a location on the PHP include_path.
	 * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
	 *
	 * @return     string path.to.ClassName
	 */
	public static function getOMClass()
	{
		return UserPeer::CLASS_DEFAULT;
	}

	/**
	 * Method perform an INSERT on the database, given a User or Criteria object.
	 *
	 * @param      mixed $values Criteria or User object containing data that is used to create the INSERT statement.
	 * @param      PropelPDO $con the PropelPDO connection to use
	 * @return     mixed The new primary key.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doInsert($values, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(UserPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} else {
			$criteria = $values->buildCriteria(); // build Criteria from User object
		}

		if ($criteria->containsKey(UserPeer::ID) && $criteria->keyContainsValue(UserPeer::ID) ) {
			throw new PropelException('Cannot insert a value for auto-increment primary key ('.UserPeer::ID.')');
		}


		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		try {
			// use transaction because $criteria could contain info
			// for more than one table (I guess, conceivably)
			$con->beginTransaction();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollBack();
			throw $e;
		}

		return $pk;
	}

	/**
	 * Method perform an UPDATE on the database, given a User or Criteria object.
	 *
	 * @param      mixed $values Criteria or User object containing data that is used to create the UPDATE statement.
	 * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doUpdate($values, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(UserPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity

			$comparison = $criteria->getComparison(UserPeer::ID);
			$selectCriteria->add(UserPeer::ID, $criteria->remove(UserPeer::ID), $comparison);

		} else { // $values is User object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	/**
	 * Method to DELETE all rows from the user table.
	 *
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 */
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(UserPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; // initialize var to track total num of affected rows
		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(UserPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a User or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or User object or primary key or array of primary keys
	 *              which is used to create the DELETE statement
	 * @param      PropelPDO $con the connection to use
	 * @return     int 	The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
	 *				if supported by native driver or if emulated using Propel.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	 public static function doDelete($values, PropelPDO $con = null)
	 {
		if ($con === null) {
			$con = Propel::getConnection(UserPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			// invalidate the cache for all objects of this type, since we have no
			// way of knowing (without running a query) what objects should be invalidated
			// from the cache based on this Criteria.
			UserPeer::clearInstancePool();

			// rename for clarity
			$criteria = clone $values;
		} elseif ($values instanceof User) {
			// invalidate the cache for this single object
			UserPeer::removeInstanceFromPool($values);
			// create criteria based on pk values
			$criteria = $values->buildPkeyCriteria();
		} else {
			// it must be the primary key



			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(UserPeer::ID, (array) $values, Criteria::IN);

			foreach ((array) $values as $singleval) {
				// we can invalidate the cache for this single object
				UserPeer::removeInstanceFromPool($singleval);
			}
		}

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; // initialize var to track total num of affected rows

		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->beginTransaction();
			
			$affectedRows += BasePeer::doDelete($criteria, $con);

			// invalidate objects in ExpertPeer instance pool, since one or more of them may be deleted by ON DELETE CASCADE rule.
			ExpertPeer::clearInstancePool();

			// invalidate objects in HistoryPeer instance pool, since one or more of them may be deleted by ON DELETE CASCADE rule.
			HistoryPeer::clearInstancePool();

			// invalidate objects in ItemRatingPeer instance pool, since one or more of them may be deleted by ON DELETE CASCADE rule.
			ItemRatingPeer::clearInstancePool();

			// invalidate objects in OfferVoucher1Peer instance pool, since one or more of them may be deleted by ON DELETE CASCADE rule.
			OfferVoucher1Peer::clearInstancePool();

			// invalidate objects in PurchaseDetailPeer instance pool, since one or more of them may be deleted by ON DELETE CASCADE rule.
			PurchaseDetailPeer::clearInstancePool();

			// invalidate objects in ShoppingCartPeer instance pool, since one or more of them may be deleted by ON DELETE CASCADE rule.
			ShoppingCartPeer::clearInstancePool();

			// invalidate objects in UserAwardsPeer instance pool, since one or more of them may be deleted by ON DELETE CASCADE rule.
			UserAwardsPeer::clearInstancePool();

			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Validates all modified columns of given User object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      User $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(User $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(UserPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(UserPeer::TABLE_NAME);

			if (! is_array($cols)) {
				$cols = array($cols);
			}

			foreach ($cols as $colName) {
				if ($tableMap->containsColumn($colName)) {
					$get = 'get' . $tableMap->getColumn($colName)->getPhpName();
					$columns[$colName] = $obj->$get();
				}
			}
		} else {

		}

		$res =  BasePeer::doValidate(UserPeer::DATABASE_NAME, UserPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = UserPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	/**
	 * Retrieve a single object by pkey.
	 *
	 * @param      int $pk the primary key.
	 * @param      PropelPDO $con the connection to use
	 * @return     User
	 */
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = UserPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(UserPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(UserPeer::DATABASE_NAME);
		$criteria->add(UserPeer::ID, $pk);

		$v = UserPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	/**
	 * Retrieve multiple objects by pkey.
	 *
	 * @param      array $pks List of primary keys
	 * @param      PropelPDO $con the connection to use
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function retrieveByPKs($pks, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(UserPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(UserPeer::DATABASE_NAME);
			$criteria->add(UserPeer::ID, $pks, Criteria::IN);
			$objs = UserPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} // BaseUserPeer

// This is the static code needed to register the MapBuilder for this table with the main Propel class.
//
// NOTE: This static code cannot call methods on the UserPeer class, because it is not defined yet.
// If you need to use overridden methods, you can add this code to the bottom of the UserPeer class:
//
// Propel::getDatabaseMap(UserPeer::DATABASE_NAME)->addTableBuilder(UserPeer::TABLE_NAME, UserPeer::getMapBuilder());
//
// Doing so will effectively overwrite the registration below.

Propel::getDatabaseMap(BaseUserPeer::DATABASE_NAME)->addTableBuilder(BaseUserPeer::TABLE_NAME, BaseUserPeer::getMapBuilder());

