<?php


/**
 * This class adds structure of 'user_question_tag' table to 'propel' DatabaseMap object.
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
class UserQuestionTagMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.UserQuestionTagMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(UserQuestionTagPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(UserQuestionTagPeer::TABLE_NAME);
		$tMap->setPhpName('UserQuestionTag');
		$tMap->setClassname('UserQuestionTag');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, 11);

		$tMap->addForeignKey('USER_ID', 'UserId', 'INTEGER', 'user', 'ID', false, 11);

		$tMap->addForeignKey('CATEGORY_ID', 'CategoryId', 'INTEGER', 'category', 'ID', false, 11);

		$tMap->addForeignKey('COURSE_ID', 'CourseId', 'INTEGER', 'courses', 'ID', false, 11);

		$tMap->addColumn('COURSE_CODE', 'CourseCode', 'VARCHAR', false, 255);

		$tMap->addColumn('EDUCATION', 'Education', 'INTEGER', false, 10);

		$tMap->addColumn('SCHOOL', 'School', 'VARCHAR', false, 255);

		$tMap->addColumn('YEAR', 'Year', 'VARCHAR', false, 255);

		$tMap->addColumn('QUESTION', 'Question', 'VARCHAR', true, 255);

	} // doBuild()

} // UserQuestionTagMapBuilder
