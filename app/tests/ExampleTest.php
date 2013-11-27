<?php

class ExampleTest extends TestCase {

	/**
	 * A basic functional test example.
	 *
	 * @return void
	 */
	public function testBasicExample()
	{
		$crawler = $this->client->request('GET', '/');

		$this->assertTrue($this->client->getResponse()->isOk());
	}

	public function testRequestWithSubdomain()
	{
		$request = Request::create('http://demo.slap.local');
		
		$this->assertEquals('demo', $request->subdomain());
	}

	public function testRequestWithoutSubdomain()
	{
		$request = Request::create('http://www.slap.local');
		
		$this->assertEquals(null, $request->subdomain());
	}

}
