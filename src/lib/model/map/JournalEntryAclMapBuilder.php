<?php


/**
 * This class adds structure of 'journal_entry_acl' table to 'propel' DatabaseMap object.
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
class JournalEntryAclMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.JournalEntryAclMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(JournalEntryAclPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(JournalEntryAclPeer::TABLE_NAME);
		$tMap->setPhpName('JournalEntryAcl');
		$tMap->setClassname('JournalEntryAcl');

		$tMap->setUseIdGenerator(true);

		$tMap->addColumn('JOURNAL_ENTRY_ID', 'JournalEntryId', 'INTEGER', false, 11);

		$tMap->addColumn('USER_ID', 'UserId', 'INTEGER', false, 11);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, 11);

	} // doBuild()

} // JournalEntryAclMapBuilder
