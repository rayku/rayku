<?php


/**
 * This class adds structure of 'offer_voucher' table to 'propel' DatabaseMap object.
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
class OfferVoucherMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.OfferVoucherMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(OfferVoucherPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(OfferVoucherPeer::TABLE_NAME);
		$tMap->setPhpName('OfferVoucher');
		$tMap->setClassname('OfferVoucher');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, 40);

		$tMap->addColumn('CODE', 'Code', 'VARCHAR', true, 100);

		$tMap->addColumn('VALID_TILL_DATE', 'ValidTillDate', 'DATE', true, null);

		$tMap->addColumn('IS_USED', 'IsUsed', 'INTEGER', true, 10);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', true, null);

		$tMap->addColumn('IS_ACTIVE', 'IsActive', 'INTEGER', true, 10);

		$tMap->addColumn('PRICE', 'Price', 'INTEGER', true, 100);

	} // doBuild()

} // OfferVoucherMapBuilder
