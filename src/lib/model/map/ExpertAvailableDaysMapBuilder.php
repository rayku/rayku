<?php


/**
 * This class adds structure of 'expert_available_days' table to 'propel' DatabaseMap object.
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
class ExpertAvailableDaysMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.ExpertAvailableDaysMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(ExpertAvailableDaysPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(ExpertAvailableDaysPeer::TABLE_NAME);
		$tMap->setPhpName('ExpertAvailableDays');
		$tMap->setClassname('ExpertAvailableDays');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, 40);

		$tMap->addColumn('EXPERT_ID', 'ExpertId', 'INTEGER', true, 40);

		$tMap->addColumn('MONDAY', 'Monday', 'INTEGER', true, 10);

		$tMap->addColumn('TUESDAY', 'Tuesday', 'INTEGER', true, 10);

		$tMap->addColumn('WEDNESDAY', 'Wednesday', 'INTEGER', true, 10);

		$tMap->addColumn('THURSDAY', 'Thursday', 'INTEGER', true, 10);

		$tMap->addColumn('FRIDAY', 'Friday', 'INTEGER', true, 10);

		$tMap->addColumn('SATURDAY', 'Saturday', 'INTEGER', true, 10);

		$tMap->addColumn('SUNDAY', 'Sunday', 'INTEGER', true, 10);

		$tMap->addColumn('TIMINGS', 'Timings', 'VARCHAR', true, 100);

	} // doBuild()

} // ExpertAvailableDaysMapBuilder
