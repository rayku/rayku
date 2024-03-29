<?php


/**
 * This class adds structure of 'private_message' table to 'propel' DatabaseMap object.
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
class PrivateMessageMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.PrivateMessageMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(PrivateMessagePeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(PrivateMessagePeer::TABLE_NAME);
		$tMap->setPhpName('PrivateMessage');
		$tMap->setClassname('PrivateMessage');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, 11);

		$tMap->addColumn('SUBJECT', 'Subject', 'VARCHAR', false, 150);

		$tMap->addColumn('BODY', 'Body', 'LONGVARCHAR', false, null);

		$tMap->addColumn('SENDER_ID', 'SenderId', 'INTEGER', false, 11);

		$tMap->addColumn('RECIPIENT_ID', 'RecipientId', 'INTEGER', false, 11);

		$tMap->addColumn('STATUS', 'Status', 'INTEGER', false, 11);

		$tMap->addColumn('READ_STATUS', 'ReadStatus', 'INTEGER', false, 11);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null);

		$tMap->addColumn('TYPE', 'Type', 'INTEGER', false, 11);

	} // doBuild()

} // PrivateMessageMapBuilder
