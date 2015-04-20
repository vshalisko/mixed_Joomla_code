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
		"description" : "Selector del tipo de tramite de primer nivel",
		"alwaysvisible" : true,
		"options" : 
		[
			{ 
				"option" : "Grupo 1 Usos",
		  		"dependencies" : [ "lmdfInput5" ]
			},
			{ 
				"option" : "Grupo 2 Trazo",
				 "dependencies" : [ "lmdfInput5" ]
			},
			{ 
				"option" : "Grupo 3 Licencia",
		  		"dependencies" : [ "lmdfSelector1" ]
			},
			{ 
				"option" : "Grupo 4 Alineamiento",
		  		"dependencies" : [ "lmdfSelector2" ]
			}
		]
	} ,
	{ 
		"type" : "selector",
		"name" : "lmdfSelector1",
		"description" : "Selector del tipo de tramite de segundo nivel (licencias)",
		"options" : 
		[
			{ 
				"option" : "Tramite 1 LConstruccionInmueble",
		  		"dependencies" : [ "lmdfInput2", "lmdfInput3" ]
			},
			{ 
				"option" : "Tramite 2 LConstruccionAlberca",
				 "dependencies" : [ "lmdfInput5" ]
			},
			{ 
				"option" : "Tramite 3 LConstruccionCancha",
				 "dependencies" : [ "lmdfInput3", "lmdfInput4" ] 
			},
			{ 
				"option" : "Tramite 4 LConstruccionEstacionamientos"
			},
			{ 
				"option" : "Tramite 5 LDemolicion"
			},
			{ 
				"option" : "Tramite 6 LAcotamiento"
			},
			{ 
				"option" : "Tramite 7 LTapiales"
			},
			{ 
				"option" : "Tramite 8 LRemodelacion"
			},
			{ 
				"option" : "Tramite 9 LReconstruccion"
			},
			{ 
				"option" : "Tramite 10 LOcupacionViasMateriales"
			},
			{ 
				"option" : "Tramite 11 LOcupacionViasPuestos"
			},
			{ 
				"option" : "Tramite 12 LMovimientoTierra"
			},
			{ 
				"option" : "Tramite 13 LConstruccionProvisional",
				 "dependencies" : [ "lmdfInput3", "lmdfInput4", "lmdfInput5" ] 
			},
			{ 
				"option" : "Tramite 14 LConstruccionPlataformas"
			},
			{ 
				"option" : "Tramite 15 LNoPrevista"
			}
		]
	} ,
	{ 
		"type" : "selector",
		"name" : "lmdfSelector2",
		"description" : "Selector del tipo de tramite de segundo nivel (tramites de alineamiento)",
		"options" : 
		[
			{ 
				"option" : "Tramite A",
		  		"dependencies" : [ "lmdfInput2", "lmdfInput3" ]
			},
			{ 
				"option" : "Tramite B",
				 "dependencies" : [ "lmdfInput5" ]
			},
			{ 
				"option" : "Tramite C",
				 "dependencies" : [ "lmdfInput3", "lmdfInput4" ] 
			},
			{ 
				"option" : "Tramite D"
			},
			{ 
				"option" : "Tramite E",
				 "dependencies" : [ "lmdfInput3", "lmdfInput4", "lmdfInput5" ] 
			},
			{ 
				"option" : "Tramite F",
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
