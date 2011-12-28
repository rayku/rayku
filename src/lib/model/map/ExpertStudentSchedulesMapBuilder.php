<?php


/**
 * This class adds structure of 'expert_student_schedules' table to 'propel' DatabaseMap object.
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
class ExpertStudentSchedulesMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.ExpertStudentSchedulesMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(ExpertStudentSchedulesPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(ExpertStudentSchedulesPeer::TABLE_NAME);
		$tMap->setPhpName('ExpertStudentSchedules');
		$tMap->setClassname('ExpertStudentSchedules');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, 10);

		$tMap->addColumn('EXP_ID', 'ExpId', 'INTEGER', true, 11);

		$tMap->addColumn('STUDENT_ID', 'StudentId', 'INTEGER', true, 11);

		$tMap->addColumn('DATE', 'Date', 'INTEGER', true, 11);

		$tMap->addColumn('TIME', 'Time', 'INTEGER', true, 11);

		$tMap->addColumn('MESSAGE', 'Message', 'LONGVARCHAR', true, null);

		$tMap->addColumn('EXPERT_LESSON_ID', 'ExpertLessonId', 'INTEGER', true, 11);

		$tMap->addColumn('ACCEPT_REJECT', 'AcceptReject', 'INTEGER', true, 11);

	} // doBuild()

} // ExpertStudentSchedulesMapBuilder
