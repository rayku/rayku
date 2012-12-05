<?php
/**
 * DateHelper test
 *
 * @group  helper
 *
 * @package   Rayku
 * @category  Tests
 */
class DateHelperTest extends PHPUnit_Framework_TestCase
{
	public static function setUpBeforeClass()
	{
		$configuration = ProjectConfiguration::getApplicationConfiguration('frontend', 'test', true);

		$context = sfContext::createInstance($configuration);

		$configuration->loadHelpers(array('Helper', 'MyDate'));
	}

	/**
	 * Provider for [date_min_to_human]
	 *
	 * @return  array
	 */
	public function provider_date_min_to_human()
	{
		return array(
			array(0,  '0 minutes'),
			array(1,  '1 minute'),
			array(5,  '5 minutes'),
			array(59, '59 minutes'),
			array(60, '1 hour'),
			array(63, '1 hour, 3 minutes'),
		);
	}

	/**
	 * @test
	 * @covers        date_min_to_human
	 * @dataProvider  provider_date_min_to_human
	 */
	public function date_min_to_human($minutes, $output)
	{
		$this->assertSame($output, date_min_to_human($minutes));
	}
}
