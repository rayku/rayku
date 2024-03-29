<?php


/**
 * This class adds structure of 'chat_detail' table to 'propel' DatabaseMap object.
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
class ChatDetailMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.ChatDetailMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(ChatDetailPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(ChatDetailPeer::TABLE_NAME);
		$tMap->setPhpName('ChatDetail');
		$tMap->setClassname('ChatDetail');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, 11);

		$tMap->addColumn('USER', 'User', 'VARCHAR', true, 100);

		$tMap->addColumn('EXPERT', 'Expert', 'VARCHAR', true, 100);

		$tMap->addColumn('MINUTES', 'Minutes', 'INTEGER', true, 10);

		$tMap->addColumn('EXPERT_AGREED', 'ExpertAgreed', 'INTEGER', true, 10);

		$tMap->addColumn('USER_ASK', 'UserAsk', 'INTEGER', true, 10);

	} // doBuild()

} // ChatDetailMapBuilder
