<?php

namespace TS\Data\Tree\Test;


use PHPUnit\Framework\TestCase;
use TS\Data\Tree\Node;


/**
 *
 * @author Timo Stamm <ts@timostamm.de>
 * @license AGPLv3.0 https://www.gnu.org/licenses/agpl-3.0.txt
 */
class DocTest extends TestCase
{

	public function test()
	{
		
		// Create a simple tree.
		$root = new Node();
		$root->setAttribute('name', 'root');
		
		$a = new Node();
		$a->setAttribute('name', 'a');
		$root->addChild($a);
		
		$b = new Node();
		$b->setAttribute('name', 'b');
		$root->addChild($b);
		
		$c = new Node();
		$c->setAttribute('name', 'c');
		$root->addChild($c);
		
		
		// Find a descendant with the name=b
		$bAgain = $root->descendant(function ($node) {
			return $node->getAttribute('name') === 'b';
		});
		
		// Get the root node of any node
		$rootAgain = $bAgain->findRootNode();
		
		// Remove a node
		$bAgain->remove();
		$root->removeChild($a);
		$root->removeChildAt(0);
		
		
		$this->assertTrue(true);
	
	}

}