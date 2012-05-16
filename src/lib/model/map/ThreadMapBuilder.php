<?php


/**
 * This class adds structure of 'thread' table to 'propel' DatabaseMap object.
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
class ThreadMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.ThreadMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(ThreadPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(ThreadPeer::TABLE_NAME);
		$tMap->setPhpName('Thread');
		$tMap->setClassname('Thread');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, 11);

		$tMap->addColumn('POSTER_ID', 'PosterId', 'INTEGER', true, 11);

		$tMap->addColumn('FORUM_ID', 'ForumId', 'INTEGER', true, 11);

		$tMap->addColumn('TITLE', 'Title', 'VARCHAR', true, 100);

		$tMap->addColumn('TAGS', 'Tags', 'VARCHAR', true, 100);

		$tMap->addColumn('VISIBLE', 'Visible', 'INTEGER', true, 11);

		$tMap->addColumn('CANCEL', 'Cancel', 'INTEGER', true, 11);

		$tMap->addColumn('CATEGORY_ID', 'CategoryId', 'INTEGER', true, 11);

		$tMap->addColumn('NOTIFY_EMAIL', 'NotifyEmail', 'INTEGER', true, 10);

		$tMap->addColumn('NOTIFY_PM', 'NotifyPm', 'INTEGER', true, 10);

		$tMap->addColumn('NOTIFY_SMS', 'NotifySms', 'INTEGER', true, 10);

		$tMap->addColumn('CELL_NUMBER', 'CellNumber', 'INTEGER', true, 30);

		$tMap->addColumn('SCHOOL_GRADE', 'SchoolGrade', 'VARCHAR', true, 100);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', true, null);

		$tMap->addColumn('LASTPOST_AT', 'LastpostAt', 'TIMESTAMP', true, null);

		$tMap->addColumn('USER_IP', 'UserIp', 'VARCHAR', false, 255);

		$tMap->addColumn('BANNED', 'Banned', 'INTEGER', true, 4);

		$tMap->addColumn('REPORTED', 'Reported', 'INTEGER', true, 4);

		$tMap->addColumn('REPORTED_DATE', 'ReportedDate', 'TIMESTAMP', false, null);

		$tMap->addColumn('STICKIE', 'Stickie', 'INTEGER', true, null);

	} // doBuild()

} // ThreadMapBuilder
