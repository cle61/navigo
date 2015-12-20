<?php 

/**
* 
*/
class MyTest extends PHPUnit_Framework_TestCase
{

	public function testIsTrue()
	{
		$this->assertTrue(true);
	}

	public function testIsEquals()
	{
		$this->assertEquals(4, 2+2);
	}

}

/**
* 
*/
class MyTest2 extends WebTestCase
{
	
	public function createApplication()
	{
		var $app;
		return $app;
	}

	public function TestCache()
	{
		$app['myModels']->get('person', 1234);
		$fromCache = $app['cache']->get('person', 1234);
		$this->assertNotNull($fromCache);
	}
}


?>