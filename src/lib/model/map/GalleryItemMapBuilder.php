<?php


/**
 * This class adds structure of 'gallery_item' table to 'propel' DatabaseMap object.
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
class GalleryItemMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.GalleryItemMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(GalleryItemPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(GalleryItemPeer::TABLE_NAME);
		$tMap->setPhpName('GalleryItem');
		$tMap->setClassname('GalleryItem');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, 11);

		$tMap->addColumn('TITLE', 'Title', 'VARCHAR', false, 255);

		$tMap->addForeignKey('GALLERY_ID', 'GalleryId', 'INTEGER', 'gallery', 'ID', false, 11);

		$tMap->addForeignKey('USER_ID', 'UserId', 'INTEGER', 'user', 'ID', false, 11);

		$tMap->addColumn('FILE_NAME', 'FileName', 'VARCHAR', false, 255);

		$tMap->addColumn('FILE_SYSTEM_PATH', 'FileSystemPath', 'VARCHAR', false, 255);

		$tMap->addColumn('MIME_TYPE', 'MimeType', 'VARCHAR', false, 255);

		$tMap->addColumn('IS_IMAGE', 'IsImage', 'INTEGER', false, 11);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'TIMESTAMP', false, null);

	} // doBuild()

} // GalleryItemMapBuilder
