<?php

/**
 * @author Timo Stamm <ts@timostamm.de>
 * @license AGPLv3.0 https://www.gnu.org/licenses/agpl-3.0.txt
 */

namespace TS\Data\Tree;


trait LookupTrait {

	/*
	public function walk(Callable $callback)
	{
		$r = $callback($this);
		if ($r === false) {
			return;
		}
		foreach ($this->getChildren() as $child) {
			$child->walk($callback);
		}
	}
	public function findNode($attributeName, $attributeValue)
	{
		if ($this->getAttribute($attributeName) === $attributeValue) {
			return $this;
		}
		foreach ($this->getChildren() as $child) {
			$found = $child->findNode($attributeName, $attributeValue);
			if ($found) {
				return $found;
			}
		}
		return null;
	}
	*/
	
	/*
	public function find(callable $where)
	{
		if ($where($this)) {
			return $this;
		}
		return $this->descendant($where);
	}
	
	public function closest(callable $where)
	{
		if ($where($this)) {
			return $this;
		}
		return $this->ancestor($where);
	}
	*/
	
	abstract public function getChildren(); 
	
	
	/**
	 * Find a specific descendant.
	 * @param callable $where Called with a node as single argument, must return true or false.
	 * @return self|NULL
	 */
	public function descendant(callable $where) {
		foreach ($this->descendants($where) as $node) {
			return $node;
		}
		return null;
	}
	
	/**
	 * Find a specific ancestor.
	 * @param callable $where Called with a node as single argument, must return true or false.
	 * @return self|NULL
	 */
	public function ancestor(callable $where) {
		foreach ($this->ancestors($where) as $node) {
			return $node;
		}
		return null;
	}
	
	/**
	 * Find as specific child.
	 * @param callable $where Called with a node as single argument, must return true or false.
	 * @return self|NULL
	 */
	public function child(callable $where) {
		foreach ($this->children($where) as $node) {
			return $node;
		}
		return null;
	}
	
	/**
	 * Find as specific sibling.
	 * @param callable $where Called with a node as single argument, must return true or false.
	 * @return self|NULL
	 */
	public function sibling(callable $where) {
		foreach ($this->children($where) as $node) {
			return $node;
		}
		return null;
	}
	
	
	/**
	 * Create a Generator (usable with foreach) that lists all children for which the given callable returns true.
	 * @param callable $where Called with a node as single argument, must return true or false.
	 * @return self|NULL
	 */
	public function children(callable $where) {
		foreach ($this->getChildren() as $node) {
			if ($where($node)) {
				yield $node;
			}
		}
	}
	
	/**
	 * Create a Generator (usable with foreach) that lists all ancestors for which the given callable returns true.
	 * @param callable $where Called with a node as single argument, must return true or false.
	 * @return self|NULL
	 */
	public function ancestors(callable $where=null) {
		$p = $this;
		while ($p->getParent()) {
			$p = $p->getParent();
			if ($where === null || $where($p)) {
				yield $p;
			}
		}
	}
	
	/**
	 * Create a Generator (usable with foreach) that lists all descendants for which the given callable returns true.
	 * @param callable $where Called with a node as single argument, must return true or false.
	 * @return self|NULL
	 */
	public function descendants(callable $where=null) {
		foreach ($this->getChildren() as $child) {
			if ($where === null || $where($child)) {
				yield $child;
			}
			foreach ($child->descendants($where) as $c) {
				yield $c;
			}
		}
	}
	
	/**
	 * Create a Generator (usable with foreach) that lists all siblings for which the given callable returns true.
	 * @param callable $where Called with a node as single argument, must return true or false.
	 * @return self|NULL
	 */
	public function siblings(callable $where=null) {
		$p = $this->getParent();
		if ($p !== null) {
			foreach ($p->getChildren() as $child) {
				if ($child === $this) {
					continue;
				}
				if ($where === null || $where($child)) {
					yield $child;
				}
			}
		}
	}
	
	
	/**
	 * Find the root node.
	 * @return self
	 */
	public function findRootNode()
	{
		$p = $this;
		while ($p->getParent()) {
			$p = $p->getParent();
		}
		return $p;
	}

}

