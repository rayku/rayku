<?php


/**
 * This class adds structure of 'sales_detail' table to 'propel' DatabaseMap object.
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
class SalesDetailMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.SalesDetailMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(SalesDetailPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(SalesDetailPeer::TABLE_NAME);
		$tMap->setPhpName('SalesDetail');
		$tMap->setClassname('SalesDetail');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, 11);

		$tMap->addForeignKey('ITEM_ID', 'ItemId', 'INTEGER', 'item', 'ID', false, 11);

		$tMap->addColumn('TOTAL_PRICE', 'TotalPrice', 'INTEGER', false, 11);

		$tMap->addColumn('TOTAL_SHIPPING_CHARGE', 'TotalShippingCharge', 'INTEGER', false, 11);

		$tMap->addColumn('QUANTITY', 'Quantity', 'INTEGER', false, 11);

		$tMap->addColumn('TRANSACTION_ID', 'TransactionId', 'INTEGER', false, 11);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'TIMESTAMP', false, null);

	} // doBuild()

} // SalesDetailMapBuilder
