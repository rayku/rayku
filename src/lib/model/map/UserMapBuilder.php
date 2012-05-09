<?php


/**
 * This class adds structure of 'user' table to 'propel' DatabaseMap object.
 *
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class UserMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.UserMapBuilder';

	/**
	 * The database map.
	 */
	private $dbMap;

	/**
	 * Tells us if this DatabaseMapBuilder is built so that we
	 * don't have to re-build it every time.
	 *
	 * @return     boolean true if this DatabaseMapBuilder is built, false otherwise.
	 */
	public function isBuilt()
	{
		return ($this->dbMap !== null);
	}

	/**
	 * Gets the databasemap this map builder built.
	 *
	 * @return     the databasemap
	 */
	public function getDatabaseMap()
	{
		return $this->dbMap;
	}

	/**
	 * The doBuild() method builds the DatabaseMap
	 *
	 * @return     void
	 * @throws     PropelException
	 */
	public function doBuild()
	{
		$this->dbMap = Propel::getDatabaseMap(UserPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(UserPeer::TABLE_NAME);
		$tMap->setPhpName('User');
		$tMap->setClassname('User');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, 11);

		$tMap->addForeignKey('PICTURE_ID', 'PictureId', 'INTEGER', 'picture', 'ID', false, 11);

		$tMap->addColumn('USERNAME', 'Username', 'VARCHAR', false, 100);

		$tMap->addColumn('EMAIL', 'Email', 'VARCHAR', false, 100);

		$tMap->addColumn('PASSWORD', 'Password', 'VARCHAR', false, 40);

		$tMap->addColumn('POINTS', 'Points', 'INTEGER', false, 11);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null);

		$tMap->addColumn('LAST_ACTIVITY_AT', 'LastActivityAt', 'TIMESTAMP', false, null);

		$tMap->addColumn('TYPE', 'Type', 'INTEGER', false, 11);

		$tMap->addColumn('HIDDEN', 'Hidden', 'INTEGER', false, 11);

		$tMap->addColumn('NAME', 'Name', 'VARCHAR', false, 100);

		$tMap->addColumn('GENDER', 'Gender', 'INTEGER', false, 11);

		$tMap->addColumn('HOMETOWN', 'Hometown', 'VARCHAR', false, 100);

		$tMap->addColumn('HOME_PHONE', 'HomePhone', 'VARCHAR', false, 20);

		$tMap->addColumn('MOBILE_PHONE', 'MobilePhone', 'VARCHAR', false, 20);

		$tMap->addColumn('BIRTHDATE', 'Birthdate', 'DATE', false, null);

		$tMap->addColumn('ADDRESS', 'Address', 'LONGVARCHAR', false, null);

		$tMap->addColumn('RELATIONSHIP_STATUS', 'RelationshipStatus', 'INTEGER', false, 11);

		$tMap->addColumn('SHOW_EMAIL', 'ShowEmail', 'INTEGER', false, 11);

		$tMap->addColumn('SHOW_GENDER', 'ShowGender', 'INTEGER', false, 11);

		$tMap->addColumn('SHOW_HOMETOWN', 'ShowHometown', 'INTEGER', false, 11);

		$tMap->addColumn('SHOW_HOME_PHONE', 'ShowHomePhone', 'INTEGER', false, 11);

		$tMap->addColumn('SHOW_MOBILE_PHONE', 'ShowMobilePhone', 'INTEGER', false, 11);

		$tMap->addColumn('SHOW_BIRTHDATE', 'ShowBirthdate', 'INTEGER', false, 11);

		$tMap->addColumn('SHOW_ADDRESS', 'ShowAddress', 'INTEGER', false, 11);

		$tMap->addColumn('SHOW_RELATIONSHIP_STATUS', 'ShowRelationshipStatus', 'INTEGER', false, 11);

		$tMap->addColumn('PASSWORD_RECOVER_KEY', 'PasswordRecoverKey', 'VARCHAR', false, 40);

		$tMap->addColumn('COOKIE_KEY', 'CookieKey', 'VARCHAR', false, 40);

		$tMap->addColumn('CREDIT', 'Credit', 'INTEGER', true, 11);

		$tMap->addColumn('INVISIBLE', 'Invisible', 'INTEGER', true, 11);

		$tMap->addColumn('NOTIFICATION', 'Notification', 'VARCHAR', true, 10);

		$tMap->addColumn('PHONE_NUMBER', 'PhoneNumber', 'VARCHAR', true, 20);

		$tMap->addColumn('LOGIN', 'Login', 'INTEGER', true, 10);

		$tMap->addColumn('CREDIT_CARD', 'CreditCard', 'VARCHAR', false, 4);

		$tMap->addColumn('CREDIT_CARD_TOKEN', 'CreditCardToken', 'VARCHAR', false, 10);

		$tMap->addColumn('FIRST_CHARGE', 'FirstCharge', 'TIMESTAMP', false, null);

	} // doBuild()

} // UserMapBuilder
