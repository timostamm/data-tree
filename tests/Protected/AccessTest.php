<?php

namespace TS\Data\Tree\Test\ProtectedAccess;


use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionMethod;
use TS\Data\Tree\ProtectedAccess\NodeTrait;
use TS\Data\Tree\ProtectedAccess\Node;


class N
{
	use NodeTrait;
}


class M extends Node
{
}

/**
 *
 * @author Timo Stamm <ts@timostamm.de>
 * @license AGPLv3.0 https://www.gnu.org/licenses/agpl-3.0.txt
 */
class AccessTest extends TestCase
{
	
	public function testClassUsingNodeTrait()
	{
		$ref = new ReflectionClass(N::class);
		$methods = $ref->getMethods(ReflectionMethod::IS_PUBLIC);
		$this->assertCount(0, $methods);
	}
	
	public function testClassExtendingNode()
	{
		$ref = new ReflectionClass(M::class);
		$methods = $ref->getMethods(ReflectionMethod::IS_PUBLIC);
		$this->assertCount(0, $methods);
	}
	
}