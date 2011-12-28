<?php


/**
 * This class adds structure of 'expert_lesson' table to 'propel' DatabaseMap object.
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
class ExpertLessonMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.ExpertLessonMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(ExpertLessonPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(ExpertLessonPeer::TABLE_NAME);
		$tMap->setPhpName('ExpertLesson');
		$tMap->setClassname('ExpertLesson');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, 11);

		$tMap->addColumn('TITLE', 'Title', 'VARCHAR', true, 100);

		$tMap->addColumn('CONTENT', 'Content', 'LONGVARCHAR', true, null);

		$tMap->addColumn('PRICE', 'Price', 'FLOAT', true, null);

		$tMap->addColumn('USER_ID', 'UserId', 'INTEGER', true, 11);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', true, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'TIMESTAMP', true, null);

		$tMap->addColumn('DAY', 'Day', 'VARCHAR', true, 50);

	} // doBuild()

} // ExpertLessonMapBuilder
