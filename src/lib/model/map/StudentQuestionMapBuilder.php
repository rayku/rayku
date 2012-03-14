<?php


/**
 * This class adds structure of 'student_questions' table to 'propel' DatabaseMap object.
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
class StudentQuestionMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.StudentQuestionMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(StudentQuestionPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(StudentQuestionPeer::TABLE_NAME);
		$tMap->setPhpName('StudentQuestion');
		$tMap->setClassname('StudentQuestion');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, 11);

		$tMap->addColumn('USER_ID', 'UserId', 'INTEGER', true, 11);

		$tMap->addColumn('CHECKED_ID', 'CheckedId', 'INTEGER', true, 11);

		$tMap->addColumn('CATEGORY_ID', 'CategoryId', 'INTEGER', true, 11);

		$tMap->addColumn('COURSE_ID', 'CourseId', 'INTEGER', true, 11);

		$tMap->addColumn('QUESTION', 'Question', 'VARCHAR', true, 500);

		$tMap->addColumn('EXE_ORDER', 'ExeOrder', 'INTEGER', true, 11);

		$tMap->addColumn('TIME', 'Time', 'INTEGER', true, 11);

		$tMap->addColumn('COURSE_CODE', 'CourseCode', 'VARCHAR', true, 100);

		$tMap->addColumn('YEAR', 'Year', 'VARCHAR', true, 100);

		$tMap->addColumn('SCHOOL', 'School', 'VARCHAR', true, 100);

		$tMap->addColumn('STATUS', 'Status', 'INTEGER', true, 10);

		$tMap->addColumn('CLOSE', 'Close', 'INTEGER', true, 10);

		$tMap->addColumn('CRON', 'Cron', 'INTEGER', true, 10);

		$tMap->addColumn('SOURCE', 'Source', 'VARCHAR', true, 100);

	} // doBuild()

} // StudentQuestionMapBuilder
