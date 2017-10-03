<?php

/**
 * @author Timo Stamm <ts@timostamm.de>
 * @license AGPLv3.0 https://www.gnu.org/licenses/agpl-3.0.txt
 */

namespace TS\Data\Tree;


use InvalidArgumentException;
use LogicException;
use OutOfRangeException;


trait ChildrenTrait {

	private $node_children = [];

	private $node_childIndex;

	private $node_parent;

	/**
	 * Get the parent node.
	 * @return self|NULL
	 */
	public function getParent()
	{
		return $this->node_parent;
	}

	/**
	 * Add the given node at the end.
	 * @param self $node
	 * @return self
	 */
	public function addChild(self $node)
	{
		$index = count($this->node_children);
		$this->insertChildAt($index, $node);
	}

	/**
	 * Add the given node at the specified index, moving all children after this index back.
	 * @param int $index
	 * @param self $node
	 * @throws \LogicException
	 * @throws \OutOfRangeException
	 * @return self
	 */
	public function insertChildAt($index, self $node)
	{
		if ($node->getParent() != null) {
			$msg = sprintf('Cannot add %s to %s because it already is a child of %s', $node, $this, $node->getParent());
			throw new LogicException($msg);
		}
		if ($index < 0) {
			throw new OutOfRangeException();
		}
		if ($index > count($this->node_children)) {
			throw new OutOfRangeException();
		}
		
		// re-wire new node and insert
		$node->node_parent = $this;
		$node->node_childIndex = $index;
		array_splice($this->node_children, $index, 0, [
			$node
		]);
		
		// update following child indices
		for ($i = $index; $i < count($this->node_children); $i ++) {
			$this->node_children[$i]->childIndex = $i;
		}
		return $this;
	}

	/**
	 * Remove the given child node.
	 * @param self $node
	 * @throws \InvalidArgumentException
	 * @return self
	 */
	public function removeChild(self $node)
	{
		if ($node->getParent() !== $this) {
			$msg = sprintf('Cannot remove %s from %s because it is not a child.', $node, $this);
			throw new InvalidArgumentException($msg);
		}
		$this->removeChildAt($node->getChildIndex());
		return $this;
	}
	
	/**
	 * Remove this node from its parent.
	 * @throws LogicException
	 * @return self
	 */
	public function remove() {
		$p = $this->getParent();
		if (null == $p) {
			throw new LogicException();
		}
		$p->removeChildAt( $this->getChildIndex() );
		return $this;
	}

	/**
	 * Remove the child node at the specified index.
	 * @param int $index
	 * @throws \OutOfRangeException
	 * @return self
	 */
	public function removeChildAt($index)
	{
		$node = $this->getChildAt($index);
		
		// re-wire new node and remove
		$node->node_parent = null;
		$node->node_childIndex = null;
		array_splice($this->node_children, $index, 1);
		
		// update following child indices
		for ($i = $index; $i < count($this->node_children); $i ++) {
			$this->node_children[$i]->node_childIndex = $i;
		}
		
		return $node;
	}

	/**
	 * Get the index of this node in the list of children of its parent.
	 * @return int
	 */
	public function getChildIndex()
	{
		return $this->node_childIndex;
	}

	/**
	 * Get the child at the specified index.
	 * @param int $index
	 * @throws \OutOfRangeException
	 * @return self
	 */
	public function getChildAt($index)
	{
		if ($index < 0) {
			throw new OutOfRangeException();
		}
		if ($index >= count($this->node_children)) {
			throw new OutOfRangeException();
		}
		return $this->node_children[$index];
	}

	/**
	 * Get all children.
	 * @return array<self>
	 */
	public function getChildren()
	{
		return $this->node_children;
	}

}
