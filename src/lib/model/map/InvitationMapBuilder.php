<?php


/**
 * This class adds structure of 'invitation' table to 'propel' DatabaseMap object.
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
class InvitationMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.InvitationMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(InvitationPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(InvitationPeer::TABLE_NAME);
		$tMap->setPhpName('Invitation');
		$tMap->setClassname('Invitation');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, 11);

		$tMap->addForeignKey('USER_ID', 'UserId', 'INTEGER', 'user', 'ID', true, 11);

		$tMap->addColumn('RECEIVER_EMAIL', 'ReceiverEmail', 'VARCHAR', true, 100);

		$tMap->addColumn('RECEIVER_CODE', 'ReceiverCode', 'VARCHAR', true, 100);

		$tMap->addColumn('SENT', 'Sent', 'INTEGER', true, 11);

	} // doBuild()

} // InvitationMapBuilder
