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
		$this->assertEquals(4, 4+2);
	}
}

?>