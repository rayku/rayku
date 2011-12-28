<?php


/**
 * This class adds structure of 'offer_voucher1' table to 'propel' DatabaseMap object.
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
class OfferVoucher1MapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.OfferVoucher1MapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(OfferVoucher1Peer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(OfferVoucher1Peer::TABLE_NAME);
		$tMap->setPhpName('OfferVoucher1');
		$tMap->setClassname('OfferVoucher1');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, 11);

		$tMap->addForeignKey('USER_ID', 'UserId', 'INTEGER', 'user', 'ID', false, 11);

		$tMap->addColumn('CODE', 'Code', 'VARCHAR', false, 255);

		$tMap->addColumn('VALID_TILL_DATE', 'ValidTillDate', 'DATE', false, null);

		$tMap->addColumn('IS_USED', 'IsUsed', 'INTEGER', false, 11);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null);

		$tMap->addColumn('IS_ACTIVE', 'IsActive', 'INTEGER', false, 11);

		$tMap->addColumn('PRICE', 'Price', 'INTEGER', false, 11);

	} // doBuild()

} // OfferVoucher1MapBuilder
