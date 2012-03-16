<?php


/**
 * This class adds structure of 'whiteboard_connections' table to 'propel' DatabaseMap object.
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
class WhiteboardConnectionMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.WhiteboardConnectionMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(WhiteboardConnectionPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(WhiteboardConnectionPeer::TABLE_NAME);
		$tMap->setPhpName('WhiteboardConnection');
		$tMap->setClassname('WhiteboardConnection');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, 11);

		$tMap->addForeignKey('QUESTION_ID', 'QuestionId', 'INTEGER', 'student_questions', 'ID', true, 11);

		$tMap->addColumn('TYPE', 'Type', 'INTEGER', true, 10);

		$tMap->addColumn('TOKEN', 'Token', 'VARCHAR', true, 40);

		$tMap->addColumn('CHAT_ID', 'ChatId', 'VARCHAR', false, 40);

		$tMap->addForeignKey('USER_ID', 'UserId', 'INTEGER', 'user', 'ID', true, 11);

	} // doBuild()

} // WhiteboardConnectionMapBuilder
