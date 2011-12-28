<?php


/**
 * This class adds structure of 'whiteboard_chat' table to 'propel' DatabaseMap object.
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
class WhiteboardChatMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.WhiteboardChatMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(WhiteboardChatPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(WhiteboardChatPeer::TABLE_NAME);
		$tMap->setPhpName('WhiteboardChat');
		$tMap->setClassname('WhiteboardChat');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, 11);

		$tMap->addColumn('IS_PUBLIC', 'IsPublic', 'INTEGER', true, 11);

		$tMap->addColumn('EXPERT_ID', 'ExpertId', 'INTEGER', false, 11);

		$tMap->addColumn('ASKER_ID', 'AskerId', 'INTEGER', false, 11);

		$tMap->addColumn('EXPERT_NICKNAME', 'ExpertNickname', 'VARCHAR', false, 100);

		$tMap->addColumn('ASKER_NICKNAME', 'AskerNickname', 'VARCHAR', false, 100);

		$tMap->addColumn('QUESTION', 'Question', 'LONGVARCHAR', false, null);

		$tMap->addColumn('STARTED_AT', 'StartedAt', 'TIMESTAMP', false, null);

		$tMap->addColumn('ENDED_AT', 'EndedAt', 'TIMESTAMP', false, null);

		$tMap->addColumn('DIRECTORY', 'Directory', 'VARCHAR', false, 255);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null);

	} // doBuild()

} // WhiteboardChatMapBuilder
