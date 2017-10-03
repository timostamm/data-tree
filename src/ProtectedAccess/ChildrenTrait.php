<?php

/**
 * @author Timo Stamm <ts@timostamm.de>
 * @license AGPLv3.0 https://www.gnu.org/licenses/agpl-3.0.txt
 */

namespace TS\Data\Tree\ProtectedAccess;


use TS\Data\Tree\ChildrenTrait as Source;


trait ChildrenTrait {
	
	use Source {
		getParent as protected;
		addChild as protected;
		insertChildAt as protected;
		remove as protected;
		removeChild as protected;
		removeChildAt as protected;
		getChildIndex as protected;
		getChildAt as protected;
		getChildren as protected;
	}

}
