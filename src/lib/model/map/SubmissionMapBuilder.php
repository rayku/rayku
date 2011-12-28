<?php


/**
 * This class adds structure of 'submission' table to 'propel' DatabaseMap object.
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
class SubmissionMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.SubmissionMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(SubmissionPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(SubmissionPeer::TABLE_NAME);
		$tMap->setPhpName('Submission');
		$tMap->setClassname('Submission');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, 11);

		$tMap->addForeignKey('ASSIGNMENT_ID', 'AssignmentId', 'INTEGER', 'assignment', 'ID', true, 11);

		$tMap->addForeignKey('USER_ID', 'UserId', 'INTEGER', 'user', 'ID', true, 11);

		$tMap->addColumn('DATA', 'Data', 'LONGVARCHAR', true, null);

		$tMap->addColumn('GRADE', 'Grade', 'VARCHAR', true, 10);

		$tMap->addColumn('COMMENT', 'Comment', 'LONGVARCHAR', true, null);

		$tMap->addColumn('APPROVED', 'Approved', 'INTEGER', true, 11);

		$tMap->addColumn('PATH', 'Path', 'VARCHAR', false, 100);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', true, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'TIMESTAMP', true, null);

	} // doBuild()

} // SubmissionMapBuilder
