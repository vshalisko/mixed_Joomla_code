<?php
/**
 * Template for Hello Slava! module
 * @package		mod_slava_1
 * @copyright		Copyright (C) 2015 Viacheslav Shalisko. All rights reserved.
 * @author 		Viacheslav Shalisko vshalisko@gmail.com
 * @license        GNU/GPL, see LICENSE.php
 * mod_helloworld is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

// No direct access
defined('_JEXEC') or die('Restricted access'); 

// Dynamic form generator related JavaScript code
$lmdfJS0 = <<<JS
// set data structure of decicion tree

var lmdfDecisionTree = 	{ input : [ 
	{ 
		"type" : "selector",
		"name" : "lmdfSelector0",
		"alwaysvisible" : true,
		"options" : 
		[
			{ 
				"option" : "Grupo 1",
		  		"dependencies" : [ "lmdfSelector1" ]
			},
			{ 
				"option" : "Grupo 2",
				 "dependencies" : [ "lmdfSelector2", "lmdfInput5" ]
			}
		]
	} ,
	{ 
		"type" : "selector",
		"name" : "lmdfSelector1",
		"options" : 
		[
			{ 
				"option" : "Tramite 1",
		  		"dependencies" : [ "lmdfInput2", "lmdfInput3" ]
			},
			{ 
				"option" : "Tramite 2",
				 "dependencies" : [ "lmdfInput5" ]
			},
			{ 
				"option" : "Tramite 3",
				 "dependencies" : [ "lmdfInput3", "lmdfInput4" ] 
			},
			{ 
				"option" : "Tramite 4",
				 "dependencies" : [ "lmdfInput3", "lmdfInput4", "lmdfInput5" ] 
			}
		]
	} ,
	{ 
		"type" : "selector",
		"name" : "lmdfSelector2",
		"options" : 
		[
			{ 
				"option" : "Tramite 5",
		  		"dependencies" : [ "lmdfInput2", "lmdfInput3" ]
			},
			{ 
				"option" : "Tramite 6",
				 "dependencies" : [ "lmdfInput5" ]
			},
			{ 
				"option" : "Tramite 7",
				 "dependencies" : [ "lmdfInput3", "lmdfInput4" ] 
			},
			{ 
				"option" : "Tramite 8"
			},
			{ 
				"option" : "Tramite 9",
				 "dependencies" : [ "lmdfInput3", "lmdfInput4", "lmdfInput5" ] 
			},
			{ 
				"option" : "Tramite 10",
				 "dependencies" : [ "lmdfInput3", "lmdfInput4", "lmdfInput5" ] 
			}
		]
	} ,

	{ 
		"type" : "input",
		"name" : "lmdfInput0",
		"alwaysvisible" : true,
		"dependencies" : [ "lmdfInput2" ]
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInput2",
		"dependencies" : [ "lmdfInput3" , "lmdfInput4" ]
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInput3"
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInput4"
	},
	{ 
		"type" : "input",
		"name" : "lmdfInput5"
	}

]};

JS;

$doc->addScriptDeclaration($lmdfJS0);
?>
