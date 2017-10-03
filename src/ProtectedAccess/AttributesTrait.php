<?php

/**
 * @author Timo Stamm <ts@timostamm.de>
 * @license AGPLv3.0 https://www.gnu.org/licenses/agpl-3.0.txt
 */

namespace TS\Data\Tree\ProtectedAccess;


use TS\Data\Tree\AttributesTrait as Source;


trait AttributesTrait {
	
	use Source { 
		setAttribute as protected; 
		hasAttribute as protected;
		getAttribute as protected;
		removeAttribute as protected;
		getAttributes as protected;
	}

}


