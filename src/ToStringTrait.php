<?php

/**
 * @author Timo Stamm <ts@timostamm.de>
 * @license AGPLv3.0 https://www.gnu.org/licenses/agpl-3.0.txt
 */

namespace TS\Data\Tree;


use ReflectionClass;


trait ToStringTrait {

	public function __toString()
	{
		$class = self::getShortClassName($this);
		$attrs = [];
		if (method_exists($this, 'getAttributes')) {
			$attrs = $this->getAttributes();
		}
		if (!empty($attrs)) {
			$attrs_str = self::arrayToLabel($attrs);
			return sprintf('[%s %s]', $class, $attrs_str);
		}
		return sprintf('[%s]', $class);
	}

	/**
	 *
	 * @param object $object
	 * @return string
	 */
	protected static function getShortClassName($object)
	{
		$r = new ReflectionClass($object);
		return $r->getShortName();
	}

	/**
	 *
	 * @param array $arr
	 * @return string
	 */
	protected static function arrayToLabel(array $arr)
	{
		
		$elements = [];
		
		if (count($arr) > 0) {
			
			foreach ($arr as $k => $v) {
				$elements[] = $k . '=' . self::varToLabel($v);
			}
		
		}
		
		$str = join(', ', $elements);
		
		return $str;
	}

	/**
	 *
	 * @param mixed $var
	 * @return string
	 */
	protected static function varToLabel($var)
	{
		if (is_bool($var)) {
			return $var ? 'true' : 'false';
		} else if (is_null($var)) {
			return 'null';
		} else if (is_string($var)) {
			return '"' . $var . '"';
		} else if (is_array($var)) {
			return 'array(' . count($var) . ')';
		} else if (is_object($var)) {
			return get_class($var);
		} else if (is_scalar($var)) {
			return strval($var);
		}
		return gettype($var);
	}

}
