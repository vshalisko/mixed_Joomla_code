<?php
/**
 * Definition of decicion tree for form generator
 * @package		mod_slava_1 & mod_lmu1
 * @copyright		Copyright (C) 2015 Viacheslav Shalisko. All rights reserved.
 * @author 		Viacheslav Shalisko vshalisko@gmail.com
 * @license        	GNU/GPL, see LICENSE.php
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
		  		"dependencies" : [ "lmdfInputP1", "lmdfInputP2", "lmdfInputP3", "lmdfInputP4", "lmdfInputP5", "lmdfInputP6", "docRequired1" ]
			},
			{ 
				"option" : "Grupo 2 Trazo",
		  		"dependencies" : [ "lmdfInputP1", "lmdfInputP2", "lmdfInputP3", "lmdfInputP4", "lmdfInputP5", "lmdfInputP6", "lmdfInputS0", "lmdfInputS2", "lmdfInputS3", "lmdfInputS4", "lmdfInputS5",  "lmdfInputS6", "lmdfInputS7" ]
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
				 "dependencies" : [ "lmdfInput2" ]
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
				"option" : "Tramite 13 LConstruccionProvisional"
			},
			{ 
				"option" : "Tramite 14 LConstruccionPlataformas"
			},
			{ 
				"option" : "Tramite 15 LNoPrevista",
				 "dependencies" : [ "lmdfInputC1" ] 
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
				"option" : "Tramite 16 Alineamiento",
		  		"dependencies" : [ "lmdfInput2" ]
			},
			{ 
				"option" : "Tramite 17 DesignacionNumero"
			},
			{ 
				"option" : "Tramite 18 Inspeccion"
			},
			{ 
				"option" : "Tramite 19 TNoPrevisto",
				 "dependencies" : [ "lmdfInputC1" ] 
			}
		]
	} ,

// ===============================================
	{ 
		"type" : "input",
		"name" : "lmdfInputS0",
		"description" : "Giro comercial",
		"dependencies" : [ "lmdfInputS1", "lmdfInputS8" ]
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputS1",
		"description" : "Razón social"
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputS2",
		"description" : "Domicilio de residencia"
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputS3",
		"description" : "Colónia"
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputS4",
		"description" : "Código postal"
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputS5",
		"description" : "Ciudad"
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputS6",
		"description" : "Estado"
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputS7",
		"description" : "Teléfono de contacto"
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputS8",
		"description" : "Tipo de giro comercial"
	} ,


// ===============================================

	{ 
		"type" : "input",
		"name" : "lmdfInputP1",
		"description" : "Ubicación: calle",
		"dependencies" : [ "lmdfInputP2" ]
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputP2",
		"description" : "Ubicación: número oficial"
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputP3",
		"description" : "Ubicación: colonia"
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputP4",
		"description" : "Ubicación: entre la calle 1",
		"dependencies" : [ "lmdfInputP5" ]
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputP5",
		"description" : "Ubicación: entre la calle 2"
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputP6",
		"description" : "Superficie del predio menor que 50 m",
		"dependencies" : [ "lmdfInputP7" ]
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputP7",
		"description" : "Superficie del predio"
	} ,

	{ 
		"type" : "input",
		"name" : "lmdfInput0",
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
		"description" : "Comentario del usuario sobre el contenido del tramite",
		"name" : "lmdfInputC1"
	},
	{ 
		"type" : "docRequired",
		"name" : "docRequired1",
		"alwaysvisible" : true,
		"description" : "Documiento requerido de tipo 1"
	}
]};

jQuery.noConflict();
(function ($) {
// Function for custom XML parsing and simple text output
xmlParser = function xmlParser( xmlData ) {
	var outString = "";
	var xmlDoc = $.parseXML( xmlData );
	$(xmlDoc).find('xml').each(function(){
		$(this).children().each(function(){
	       		var tagName = this.tagName;
        		var valText = $(this).text();
			for (var i = 0; i < lmdfDecisionTree.input.length; i++)	{
				if ( lmdfDecisionTree.input[i].name == tagName ) {
					if ( lmdfDecisionTree.input[i].description ) {
						outString += lmdfDecisionTree.input[i].description;
					} else {
						outString += lmdfDecisionTree.input[i].name;
					}
					outString += ": <em>" + valText + "</em><br />";
				}
			}
		});
	});
	return "<pre>" + outString + "</pre>";
}
})(jQuery);

JS;

$doc->addScriptDeclaration($lmdfJS0);
?>
