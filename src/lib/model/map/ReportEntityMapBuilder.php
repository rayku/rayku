<?php


/**
 * This class adds structure of 'report_entity' table to 'propel' DatabaseMap object.
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
class ReportEntityMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.ReportEntityMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(ReportEntityPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(ReportEntityPeer::TABLE_NAME);
		$tMap->setPhpName('ReportEntity');
		$tMap->setClassname('ReportEntity');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, 11);

		$tMap->addColumn('REPORT_COUNT', 'ReportCount', 'INTEGER', false, 11);

		$tMap->addColumn('THREAD_ID', 'ThreadId', 'INTEGER', false, 11);

		$tMap->addColumn('POST_ID', 'PostId', 'INTEGER', false, 11);

		$tMap->addColumn('GROUP_ID', 'GroupId', 'INTEGER', false, 11);

		$tMap->addColumn('BULLETIN_ID', 'BulletinId', 'INTEGER', false, 11);

		$tMap->addColumn('GROUP_SITE_PAGE_ID', 'GroupSitePageId', 'INTEGER', false, 11);

		$tMap->addColumn('COMMENT_ID', 'CommentId', 'INTEGER', false, 11);

		$tMap->addColumn('PICTURE_ID', 'PictureId', 'INTEGER', false, 11);

		$tMap->addColumn('VIDEO_ID', 'VideoId', 'INTEGER', false, 11);

		$tMap->addColumn('SHOUT_ID', 'ShoutId', 'INTEGER', false, 11);

	} // doBuild()

} // ReportEntityMapBuilder
