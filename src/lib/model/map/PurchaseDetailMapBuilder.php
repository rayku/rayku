<?php


/**
 * This class adds structure of 'purchase_detail' table to 'propel' DatabaseMap object.
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
class PurchaseDetailMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.PurchaseDetailMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(PurchaseDetailPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(PurchaseDetailPeer::TABLE_NAME);
		$tMap->setPhpName('PurchaseDetail');
		$tMap->setClassname('PurchaseDetail');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, 11);

		$tMap->addForeignKey('USER_ID', 'UserId', 'INTEGER', 'user', 'ID', false, 11);

		$tMap->addForeignKey('SALES_ID', 'SalesId', 'INTEGER', 'sales', 'ID', false, 11);

		$tMap->addColumn('TRANSACTION_ID', 'TransactionId', 'INTEGER', false, 11);

		$tMap->addColumn('FULL_NAME', 'FullName', 'VARCHAR', false, 255);

		$tMap->addColumn('EMAIL', 'Email', 'VARCHAR', false, 255);

		$tMap->addColumn('ADDRESS1', 'Address1', 'VARCHAR', false, 255);

		$tMap->addColumn('ADDRESS2', 'Address2', 'VARCHAR', false, 255);

		$tMap->addColumn('CITY', 'City', 'VARCHAR', false, 255);

		$tMap->addColumn('STATE', 'State', 'VARCHAR', false, 255);

		$tMap->addColumn('COUNTRY', 'Country', 'VARCHAR', false, 255);

		$tMap->addColumn('TELEPHONE_NUMBER', 'TelephoneNumber', 'VARCHAR', false, 255);

		$tMap->addColumn('ZIP', 'Zip', 'VARCHAR', false, 20);

	} // doBuild()

} // PurchaseDetailMapBuilder
