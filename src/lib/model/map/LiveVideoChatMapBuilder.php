<?php


/**
 * This class adds structure of 'live_video_chat' table to 'propel' DatabaseMap object.
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
class LiveVideoChatMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.LiveVideoChatMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(LiveVideoChatPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(LiveVideoChatPeer::TABLE_NAME);
		$tMap->setPhpName('LiveVideoChat');
		$tMap->setClassname('LiveVideoChat');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, 11);

		$tMap->addColumn('RECEIVER_ID', 'ReceiverId', 'INTEGER', true, 11);

		$tMap->addColumn('SENDER_ID', 'SenderId', 'INTEGER', true, 11);

		$tMap->addColumn('CLASSROOM_ID', 'ClassroomId', 'INTEGER', true, 11);

		$tMap->addColumn('APPROVED', 'Approved', 'INTEGER', true, 11);

	} // doBuild()

} // LiveVideoChatMapBuilder
