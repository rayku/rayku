<?php


/**
 * This class adds structure of 'tutor_profile' table to 'propel' DatabaseMap object.
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
class TutorProfileMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.TutorProfileMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(TutorProfilePeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(TutorProfilePeer::TABLE_NAME);
		$tMap->setPhpName('TutorProfile');
		$tMap->setClassname('TutorProfile');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('TUTOR_PROFILE_ID', 'TutorProfileId', 'INTEGER', true, 11);

		$tMap->addColumn('USER_ID', 'UserId', 'INTEGER', true, 11);

		$tMap->addColumn('CATEGORY', 'Category', 'INTEGER', true, 8);

		$tMap->addColumn('COURSE_ID', 'CourseId', 'VARCHAR', true, 200);

		$tMap->addColumn('SCHOOL', 'School', 'VARCHAR', true, 300);

		$tMap->addColumn('YEAR', 'Year', 'VARCHAR', true, 100);

		$tMap->addColumn('TUTOR_ROLE', 'TutorRole', 'VARCHAR', true, 300);

		$tMap->addColumn('STUDY', 'Study', 'VARCHAR', true, 300);

		$tMap->addColumn('COURSE_CODE', 'CourseCode', 'VARCHAR', true, 300);

		$tMap->addColumn('ONLINE_STATUS', 'OnlineStatus', 'TINYINT', false, 1);

	} // doBuild()

} // TutorProfileMapBuilder
