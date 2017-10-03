<?php

namespace TS\Data\Tree\Test;


use PHPUnit\Framework\TestCase;
use TS\Data\Tree\Node;


/**
 *
 * @author Timo Stamm <ts@timostamm.de>
 * @license AGPLv3.0 https://www.gnu.org/licenses/agpl-3.0.txt
 */
class LookupTest extends TestCase
{
	
	public function testAncestors()
	{
		$r = iterator_to_array($this->aaa->ancestors());
		$this->assertSame($this->root, $r[2]);
		$this->assertSame($this->a, $r[1]);
		$this->assertSame($this->aa, $r[0]);
	}
	
	public function testAncestorsWhere()
	{
		$r = iterator_to_array($this->aaa->ancestors(function($node){
			return $node === $this->a;
		}));
		$this->assertCount(1, $r);
		$this->assertSame($this->a, $r[0]);
	}
	
	public function testAncestor()
	{
		$r = $this->aaa->ancestor(function($node){
			return $this->a === $node;
		});
		$this->assertSame($this->a, $r);
		$this->assertNull($this->root->ancestor(function($node){
			return false;
		}));
	}
	
	
	public function testDescendants()
	{
		$r = iterator_to_array($this->root->descendants());
		$this->assertCount(4, $r);
	}
	
	public function testDescendantsWhere()
	{
		$r = iterator_to_array($this->root->descendants(function($node){
			return $node === $this->ab;
		}));
		$this->assertCount(1, $r);
		$this->assertSame($this->ab, $r[0]);
	}
	
	public function testDescendant()
	{
		$r = $this->root->descendant(function($node){
			return $this->a === $node;
		});
		$this->assertSame($this->a, $r);
		$this->assertNull($this->root->descendant(function($node){
			return false;
		}));
	}
	
	
	public function testSiblings()
	{
		$r = iterator_to_array($this->root->siblings());
		$this->assertCount(0, $r);
		
		$r = iterator_to_array($this->aa->siblings());
		$this->assertCount(1, $r);
		
	}
	
	public function testSiblingsWhere()
	{
		$r = iterator_to_array($this->aa->siblings(function($node){
			return $this->ab === $node;
		}));
		$this->assertCount(1, $r);
		$this->assertSame($this->ab, $r[0]);
	}
	
	public function testSibling()
	{
		$r = $this->a->sibling(function($node){
			return $this->ab === $node;
		});
		$this->assertSame($this->ab, $r);
		$this->assertNull($this->root->sibling(function($node){
			return false;
		}));
	}
	
	
	public function testChildren()
	{
		$r = iterator_to_array($this->a->children(function($node){
			return true;
		}));
		$this->assertCount(2, $r);
	}
	
	public function testChild()
	{
		$r = $this->a->child(function($node){
			return $this->aa === $node;
		});
		$this->assertSame($this->aa, $r);
		$this->assertNull($this->root->child(function($node){
			return false;
		}));
	}
	
	
	public function testFindRootNode()
	{
		$r = $this->ab->findRootNode();
		$this->assertSame($this->root, $r);
	}
	
	
	private $root;
	private $a;
	private $aa;
	private $ab;
	private $aaa;

	protected function setUp()
	{
		$this->root = new Node();
		$this->root->setAttribute('name', 'root');
		
		$this->a = new Node();
		$this->a->setAttribute('name', 'a');
		$this->root->addChild($this->a);
		
		$this->aa = new Node();
		$this->aa->setAttribute('name', 'aa');
		$this->a->addChild($this->aa);
		
		$this->ab = new Node();
		$this->ab->setAttribute('name', 'ab');
		$this->a->addChild($this->ab);
		
		$this->aaa = new Node();
		$this->aaa->setAttribute('name', 'aaa');
		$this->aa->addChild($this->aaa);
		
	}

	protected function tearDown()
	{
		$this->root = null;
		$this->a = null;
		$this->aa = null;
		$this->aaa = null;
	}

}