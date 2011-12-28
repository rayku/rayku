<?php


/**
 * This class adds structure of 'forum_answer' table to 'propel' DatabaseMap object.
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
class ForumAnswerMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.ForumAnswerMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(ForumAnswerPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(ForumAnswerPeer::TABLE_NAME);
		$tMap->setPhpName('ForumAnswer');
		$tMap->setClassname('ForumAnswer');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, 11);

		$tMap->addColumn('ANSWER', 'Answer', 'LONGVARCHAR', true, null);

		$tMap->addColumn('FORUM_QUESTION_ID', 'ForumQuestionId', 'INTEGER', true, 11);

		$tMap->addColumn('USER_ID', 'UserId', 'INTEGER', true, 11);

		$tMap->addColumn('BEST_RESPONSE', 'BestResponse', 'INTEGER', true, 11);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', true, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'TIMESTAMP', true, null);

	} // doBuild()

} // ForumAnswerMapBuilder
