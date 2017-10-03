<?php

/**
 * @author Timo Stamm <ts@timostamm.de>
 * @license AGPLv3.0 https://www.gnu.org/licenses/agpl-3.0.txt
 */

namespace TS\Data\Tree;


trait AttributesTrait {

	private $node_attributes = [];

	/**
	 * Set an attribute.
	 * @param string $name
	 * @param mixed $value
	 */
	public function setAttribute($name, $value)
	{
		$this->node_attributes[$name] = $value;
		return $this;
	}

	/**
	 * Check if an attribute is set.
	 * @return bool
	 */
	public function hasAttribute($name)
	{
		return array_key_exists($name, $this->node_attributes);
	}

	/**
	 * Get an attribute value.
	 * @param string $name
	 * @return mixed
	 */
	public function getAttribute($name, $default = null)
	{
		return array_key_exists($name, $this->node_attributes) ? $this->node_attributes[$name] : $default;
	}

	/**
	 * Remove an attribute.
	 * @param string $name
	 */
	public function removeAttribute($name)
	{
		if ($this->hasAttribute($name)) {
			unset($this->node_attributes[$name]);
		}
		return $this;
	}

	/**
	 * Get all attributes as an associative array.
	 * @return array
	 */
	public function getAttributes()
	{
		return $this->node_attributes;
	}

}
