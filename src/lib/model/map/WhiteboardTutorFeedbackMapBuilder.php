<?php


/**
 * This class adds structure of 'whiteboard_tutor_feedback' table to 'propel' DatabaseMap object.
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
class WhiteboardTutorFeedbackMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.WhiteboardTutorFeedbackMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(WhiteboardTutorFeedbackPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(WhiteboardTutorFeedbackPeer::TABLE_NAME);
		$tMap->setPhpName('WhiteboardTutorFeedback');
		$tMap->setClassname('WhiteboardTutorFeedback');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, 11);

		$tMap->addForeignKey('WHITEBOARD_CHAT_ID', 'WhiteboardChatId', 'INTEGER', 'whiteboard_chat', 'ID', true, 11);

		$tMap->addColumn('EXPERT_ID', 'ExpertId', 'INTEGER', false, 11);

		$tMap->addColumn('AUDIO', 'Audio', 'INTEGER', true, 5);

		$tMap->addColumn('USABILITY', 'Usability', 'INTEGER', true, 5);

		$tMap->addColumn('OVERALL', 'Overall', 'INTEGER', true, 5);

		$tMap->addColumn('FEEDBACK', 'Feedback', 'LONGVARCHAR', false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', true, null);

	} // doBuild()

} // WhiteboardTutorFeedbackMapBuilder
