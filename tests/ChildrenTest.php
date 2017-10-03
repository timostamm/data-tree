<?php

namespace TS\Data\Tree\Test;


use PHPUnit\Framework\TestCase;
use TS\Data\Tree\Node;


/**
 *
 * @author Timo Stamm <ts@timostamm.de>
 * @license AGPLv3.0 https://www.gnu.org/licenses/agpl-3.0.txt
 */
class ChildrenTest extends TestCase
{

	public function testGetChildren()
	{
		$children = $this->root->getChildren();
		$this->assertCount(3, $children);
		$this->assertSame($this->a, $children[0]);
		$this->assertSame($this->b, $children[1]);
		$this->assertSame($this->c, $children[2]);
		$this->assertSame($this->a, $this->root->getChildAt(0));
		$this->assertSame($this->b, $this->root->getChildAt(1));
		$this->assertSame($this->c, $this->root->getChildAt(2));
		$this->assertEquals(0, $this->a->getChildIndex());
		$this->assertEquals(1, $this->b->getChildIndex());
		$this->assertEquals(2, $this->c->getChildIndex());
	}
	
	public function testRemove()
	{
		$this->b->remove();
		$children = $this->root->getChildren();
		$this->assertCount(2, $children);
		$this->assertSame($this->c, $children[1]);
		$this->assertEquals(0, $this->a->getChildIndex());
		$this->assertEquals(1, $this->c->getChildIndex());
		$this->assertNull($this->b->getParent());
	}
	
	public function testRemoveChild()
	{
		$this->root->removeChild($this->b);
		$children = $this->root->getChildren();
		$this->assertCount(2, $children);
		$this->assertSame($this->c, $children[1]);
		$this->assertEquals(0, $this->a->getChildIndex());
		$this->assertEquals(1, $this->c->getChildIndex());
		$this->assertNull($this->b->getParent());
	}

	public function testRemoveChildInvalid()
	{
		$this->expectException(\InvalidArgumentException::class);
		$this->root->removeChild(new Node());
	}

	public function testRemoveChildAtOutOfRange()
	{
		$this->expectException(\OutOfRangeException::class);
		$this->root->removeChildAt(3);
	}

	public function testRemoveChildAt()
	{
		$this->root->removeChildAt(1);
		$children = $this->root->getChildren();
		$this->assertCount(2, $children);
		$this->assertSame($this->c, $children[1]);
		$this->assertEquals(0, $this->a->getChildIndex());
		$this->assertEquals(1, $this->c->getChildIndex());
		$this->assertNull($this->b->getParent());
	}
	
	public function testAddChild()
	{
		$d = new Node();
		$this->assertNull($d->getParent());
		$this->root->addChild($d);
		$children = $this->root->getChildren();
		$this->assertCount(4, $children);
		$this->assertSame($d, $children[3]);
		$this->assertSame($this->root, $d->getParent());
	}
	
	public function testAddChildAlreadyAdded()
	{
		$this->expectException(\LogicException::class);
		$this->root->addChild($this->a);
	}
	
	public function testInsertChildAt()
	{
		$d = new Node();
		$this->root->insertChildAt(1, $d);
		$children = $this->root->getChildren();
		$this->assertCount(4, $children);
		$this->assertSame($d, $children[1]);
	}
	
	public function testInsertChildOutOfRange()
	{
		$this->expectException(\OutOfRangeException::class);
		$this->root->insertChildAt(4, new Node());
	}
	public function testInsertChildNegativeRange()
	{
		$this->expectException(\OutOfRangeException::class);
		$this->root->insertChildAt(-1, new Node());
	}

	public function testGetChildAt()
	{
		$this->assertSame($this->a, $this->root->getChildAt(0));
		$this->assertSame($this->b, $this->root->getChildAt(1));
		$this->assertSame($this->c, $this->root->getChildAt(2));
	}
	
	public function testGetChildAtOutOfRange()
	{
		$this->expectException(\OutOfRangeException::class);
		$this->root->getChildAt(3);
	}
	public function testGetChildAtNegativeRange()
	{
		$this->expectException(\OutOfRangeException::class);
		$this->root->getChildAt(-1);
	}

	private $root;

	private $a;

	private $b;

	private $c;

	protected function setUp()
	{
		$this->root = new Node();
		
		$this->a = new Node();
		$this->root->addChild($this->a);
		
		$this->b = new Node();
		$this->root->addChild($this->b);
		
		$this->c = new Node();
		$this->root->addChild($this->c);
	}

	protected function tearDown()
	{
		$this->root = null;
		$this->a = null;
		$this->b = null;
		$this->c = null;
	}

}