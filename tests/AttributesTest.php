<?php

namespace TS\Data\Tree\Test;


use PHPUnit\Framework\TestCase;
use TS\Data\Tree\Node;


/**
 *
 * @author Timo Stamm <ts@timostamm.de>
 * @license AGPLv3.0 https://www.gnu.org/licenses/agpl-3.0.txt
 */
class AttributesTest extends TestCase
{

	public function testSetAttribute()
	{
		$this->assertTrue($this->n->hasAttribute('str'));
		$this->assertTrue($this->n->hasAttribute('num'));
	}
	
	public function testRemoveAttribute()
	{
		$this->n->removeAttribute('str');
		$this->assertFalse($this->n->hasAttribute('str'));
		$this->assertCount(1, $this->n->getAttributes());
	}
	
	public function testHasAttributes()
	{
		$this->assertTrue($this->n->hasAttribute('str'));
		$this->assertFalse($this->n->hasAttribute('xxx'));
	}

	public function testGetAttribute()
	{
		$this->assertSame('STR', $this->n->getAttribute('str'));
		$this->assertSame(2, $this->n->getAttribute('num'));
	}
	
	public function testGetAttributeDefault()
	{
		$this->assertSame('STR', $this->n->getAttribute('str', 'xxx'));
		$this->assertSame('xxx', $this->n->getAttribute('yyy', 'xxx'));
		$this->assertNull($this->n->getAttribute('yyy'));
	}
	
	public function testGetAttributes()
	{
		$a = $this->n->getAttributes();
		$this->assertCount(2, $a);
		$this->assertSame('STR', $a['str']);
	}

	private $n;

	protected function setUp()
	{
		$this->n = new Node();
		$this->n->setAttribute('str', 'STR');
		$this->n->setAttribute('num', 2);
	
	}

	protected function tearDown()
	{
		$this->n = null;
	}

}