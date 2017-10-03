<?php

namespace TS\Data\Tree\Test;


use PHPUnit\Framework\TestCase;
use TS\Data\Tree\Tests\Fixtures\BarNode;
use TS\Data\Tree\Tests\Fixtures\FooNode;


/**
 *
 * @author Timo Stamm <ts@timostamm.de>
 * @license AGPLv3.0 https://www.gnu.org/licenses/agpl-3.0.txt
 */
class ToStringTest extends TestCase
{

	public function testFoo()
	{
		$foo = new FooNode();
		$this->assertEquals('[FooNode]', $foo->__toString());
	}

	public function testBar()
	{
		$foo = new BarNode();
		$this->assertEquals('[BarNode]', $foo->__toString());
	}

	public function testFooWithAttribute()
	{
		$foo = new FooNode();
		$foo->setAttribute('a', 'A');
		$foo->setAttribute('num', 123);
		$foo->setAttribute('arr', ['a', 'b']);
		$foo->setAttribute('obj', $foo);
		$foo->setAttribute('null', null);
		$foo->setAttribute('bool', true);
		$this->assertEquals('[FooNode a="A", num=123, arr=array(2), obj=TS\Data\Tree\Tests\Fixtures\FooNode, null=null, bool=true]', $foo->__toString());
	}

}