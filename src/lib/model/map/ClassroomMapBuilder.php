<?php


/**
 * This class adds structure of 'classroom' table to 'propel' DatabaseMap object.
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
class ClassroomMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.ClassroomMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(ClassroomPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(ClassroomPeer::TABLE_NAME);
		$tMap->setPhpName('Classroom');
		$tMap->setClassname('Classroom');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, 11);

		$tMap->addForeignKey('USER_ID', 'UserId', 'INTEGER', 'user', 'ID', true, 11);

		$tMap->addColumn('CATEGORY_ID', 'CategoryId', 'INTEGER', true, 11);

		$tMap->addColumn('CLASSROOM_BANNER', 'ClassroomBanner', 'VARCHAR', true, 50);

		$tMap->addColumn('FULLNAME', 'Fullname', 'VARCHAR', true, 50);

		$tMap->addColumn('SHORTNAME', 'Shortname', 'VARCHAR', true, 50);

		$tMap->addColumn('CLASS_USERNAME', 'ClassUsername', 'VARCHAR', true, 100);

		$tMap->addColumn('EMAIL_PASSCODE', 'EmailPasscode', 'VARCHAR', true, 100);

		$tMap->addColumn('CLASSROOM_EMAIL', 'ClassroomEmail', 'VARCHAR', true, 100);

		$tMap->addColumn('LIVE_WEBCAM', 'LiveWebcam', 'INTEGER', true, 11);

		$tMap->addColumn('EMAIL_UPDATEBLOG', 'EmailUpdateblog', 'INTEGER', true, 11);

		$tMap->addColumn('SCHOOL_NAME', 'SchoolName', 'VARCHAR', true, 100);

		$tMap->addColumn('LOCATION', 'Location', 'VARCHAR', true, 100);

		$tMap->addColumn('IDNUMBER', 'Idnumber', 'VARCHAR', true, 50);

		$tMap->addColumn('SUMMARY', 'Summary', 'LONGVARCHAR', true, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', true, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'TIMESTAMP', true, null);

	} // doBuild()

} // ClassroomMapBuilder
