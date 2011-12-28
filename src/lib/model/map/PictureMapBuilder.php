<?php


/**
 * This class adds structure of 'picture' table to 'propel' DatabaseMap object.
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
class PictureMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.PictureMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(PicturePeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(PicturePeer::TABLE_NAME);
		$tMap->setPhpName('Picture');
		$tMap->setClassname('Picture');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, 11);

		$tMap->addColumn('NAME', 'Name', 'VARCHAR', false, 150);

		$tMap->addColumn('DESCRIPTION', 'Description', 'LONGVARCHAR', false, null);

		$tMap->addForeignKey('ALBUM_ID', 'AlbumId', 'INTEGER', 'album', 'ID', false, 11);

		$tMap->addForeignKey('OWNER_ID', 'OwnerId', 'INTEGER', 'user', 'ID', false, 11);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null);

	} // doBuild()

} // PictureMapBuilder
