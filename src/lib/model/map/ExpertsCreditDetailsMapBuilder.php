<?php


/**
 * This class adds structure of 'experts_credit_details' table to 'propel' DatabaseMap object.
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
class ExpertsCreditDetailsMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.ExpertsCreditDetailsMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(ExpertsCreditDetailsPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(ExpertsCreditDetailsPeer::TABLE_NAME);
		$tMap->setPhpName('ExpertsCreditDetails');
		$tMap->setClassname('ExpertsCreditDetails');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, 100);

		$tMap->addColumn('STUDENT_ID', 'StudentId', 'INTEGER', true, 10);

		$tMap->addColumn('EXPERT_ID', 'ExpertId', 'INTEGER', true, 10);

		$tMap->addColumn('CREDIT_AMOUNT', 'CreditAmount', 'FLOAT', true, 5);

		$tMap->addColumn('LESSON_ID', 'LessonId', 'INTEGER', true, 20);

		$tMap->addColumn('IMMEDIATE_LESSON_ID', 'ImmediateLessonId', 'INTEGER', true, 20);

	} // doBuild()

} // ExpertsCreditDetailsMapBuilder
