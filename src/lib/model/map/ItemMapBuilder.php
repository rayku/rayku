<?php


/**
 * This class adds structure of 'item' table to 'propel' DatabaseMap object.
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
class ItemMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.ItemMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(ItemPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(ItemPeer::TABLE_NAME);
		$tMap->setPhpName('Item');
		$tMap->setClassname('Item');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, 11);

		$tMap->addForeignKey('SIZE_ID', 'SizeId', 'INTEGER', 'size', 'ID', false, 11);

		$tMap->addForeignKey('ITEM_TYPE_ID', 'ItemTypeId', 'INTEGER', 'item_type', 'ID', false, 11);

		$tMap->addColumn('TITLE', 'Title', 'VARCHAR', false, 255);

		$tMap->addColumn('DESCRIPTION', 'Description', 'LONGVARCHAR', false, null);

		$tMap->addColumn('PRICE_PER_UNIT', 'PricePerUnit', 'INTEGER', false, 11);

		$tMap->addColumn('SHIPPING_CHARGE_PER_UNIT', 'ShippingChargePerUnit', 'INTEGER', false, 11);

		$tMap->addColumn('ACTUAL_VALUE', 'ActualValue', 'INTEGER', false, 11);

		$tMap->addColumn('ACTUAL_VALUE_CURRENCY', 'ActualValueCurrency', 'VARCHAR', false, 5);

		$tMap->addColumn('QUANTITY', 'Quantity', 'INTEGER', false, 11);

		$tMap->addColumn('IMAGE', 'Image', 'VARCHAR', false, 255);

		$tMap->addColumn('FEATURES', 'Features', 'LONGVARCHAR', false, null);

		$tMap->addColumn('IS_ACTIVE', 'IsActive', 'INTEGER', false, 11);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'TIMESTAMP', false, null);

	} // doBuild()

} // ItemMapBuilder
