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
		  		"dependencies" : [ 
						"lmdfInputS","lmdfInputP1", "lmdfInputP2", "lmdfInputP3", 
						"lmdfInputP4", "lmdfInputP5", "lmdfInputP6", "lmdfInputPR0", "docRequired1" ]
			},                                                                  
			{ 
				"option" : "Grupo 2 Trazo",
		  		"dependencies" : [ "lmdfInputS0", "lmdfInputS2", "lmdfInputS3", "lmdfInputS4", "lmdfInputS5",  "lmdfInputS6", "lmdfInputS7",
						"lmdfInputS","lmdfInputP1", "lmdfInputP2", "lmdfInputP3", 
						"lmdfInputP4", "lmdfInputP5", "lmdfInputP6", "lmdfInputPR0", "docRequired1" ]
			},
			{ 
				"option" : "Grupo 3 Licencia",
		  		"dependencies" : [ "lmdfInputL0","lmdfInputL1","lmdfInputL2","lmdfInputL3","lmdfInputL4","lmdfInputL5",
						"lmdfInputL6","lmdfInputL7","lmdfInputL8","lmdfInputL9","lmdfInputL10","lmdfInputL11",
						"lmdfInputL12","lmdfInputL13","lmdfInputL14","lmdfInputL15",
						"lmdfInputS0", "lmdfInputS2", "lmdfInputS3", "lmdfInputS4", "lmdfInputS5",  "lmdfInputS6", "lmdfInputS7",
						"lmdfInputS","lmdfInputP1", "lmdfInputP2", "lmdfInputP3", 
						"lmdfInputP4", "lmdfInputP5", "lmdfInputP6", "lmdfInputPR0", 
						"lmdfInputD0", "docRequired1" ]
			},                                                                    
			{ 
				"option" : "Grupo 4 Alineamiento",
		  		"dependencies" : [ "lmdfSelector2",
						"lmdfInputS","lmdfInputP1", "lmdfInputP2", "lmdfInputP3", 
						"lmdfInputP4", "lmdfInputP5", "lmdfInputP6", "lmdfInputPR0", "docRequired1" ]
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
				"option" : "Alineamiento",
				 "dependencies" : [ "lmdfSelector2A" ] 
			},
			{ 
				"option" : "Número oficial",
				 "dependencies" : [ "lmdfSelector2A" ] 
			},
			{ 
				"option" : "Inspección"
			},
			{ 
				"option" : "Otro",
				 "dependencies" : [ "lmdfInputC1" ] 
			}
		]
	} ,
	{ 
		"type" : "selector",
		"name" : "lmdfSelector2A",
		"description" : "Selector de tipo de inmueble para tramites de alineamiento",
		"options" : 
		[
			{ 
				"option" : "A",
			},
			{ 
				"option" : "B"
			},
		]
	} ,

// ====nuevo selector de licencias========
	{ 
		"type" : "input",
		"name" : "lmdfInputL0",
		"description" : "Licencias (grupo)"
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputL1",
		"description" : "Licencia para construcción de inmuebles",
		"dependencies" : [ "lmdfSelectorL1A", "docRequired2" ] 
	} ,
	{ 
		"type" : "selector",
		"name" : "lmdfSelectorL1A",
		"description" : "Selector de licencia del tipo I.",
		"options" : 
		[
			{ 
				"option" : "A",
			},
			{ 
				"option" : "B"
			},
		]
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputL2",
		"description" : "Licencia para construcción de albercas",
		"dependencies" : [ "docRequired2" ] 
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputL3",
		"description" : "Licencia para construcción de canchas y áreas deportivas",
		"dependencies" : [ "docRequired2" ] 
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputL4",
		"description" : "Licencia para construcción de estacionamientos para usos no habitacionales",
		"dependencies" : [ "docRequired2" ] 
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputL5",
		"description" : "Licencia para demolición",
		"dependencies" : [ "docRequired2" ] 
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputL6",
		"description" : "Licencia para acotamiento",
		"dependencies" : [ "docRequired2" ] 
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputL7",
		"description" : "Licencia para instalar tapiales provisionales en la vía pública"
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputL8",
		"description" : "Licencia para remodelación o restauración",
		"dependencies" : [ "docRequired2" ] 
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputL9",
		"description" : "Licencia para reconstrucción, reestructuración o adaptación",
		"dependencies" : [ "docRequired2" ] 
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputL10",
		"description" : "Licencia para ocupación de la vía pública con materiales de construcción"
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputL11",
		"description" : "Licencia para ocupación de la vía pública por puestos, carpas, módulos, etcétera provisionales"
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputL12",
		"description" : "Licencia para movimientos de tierra",
		"dependencies" : [ "docRequired2" ] 
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputL13",
		"description" : "Licencia provisional de construcción",
		"dependencies" : [ "docRequired2" ] 
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputL14",
		"description" : "Licencia para construcción de plataformas, patios de maniobra y rampas",
		"dependencies" : [ "docRequired2" ] 
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputL15",
		"description" : "Licencia similar de tipo no previsto"
	} ,
// ====campos a llenar en formulario========
	{       // this should be selected in any case after the selector lmdfSelector0 
		"type" : "input",
		"name" : "lmdfInputS",
		"description" : "Campos a llenar (grupo)"
	} ,
	{       
		"type" : "input",
		"name" : "lmdfInputD0",
		"description" : "Existe un dictamen de usos y destinos",
		"dependencies" : [ "lmdfInputD1", "lmdfInputD2", "docRequiredD" ]
	} ,
	{       
		"type" : "input",
		"name" : "lmdfInputD1",
		"description" : "Número oficial del dictamen de usos y destinos"
	} ,
	{       
		"type" : "input",
		"name" : "lmdfInputD2",
		"description" : "Fecha de emisión del dictamen de usos y destinos"
	} ,

// =========Campos de información sobre solicitante======================================
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
// =========Campos de información sobre propietario======================================
	{ 
		"type" : "input",
		"name" : "lmdfInputPR0",
		"description" : "Propietario es distinto del solicitante",
		"dependencies" : [ "lmdfInputPR1", "lmdfInputPR2", "lmdfInputPR3", "lmdfInputPR4", "lmdfInputPR5", "lmdfInputPR6", "lmdfInputPR7", "lmdfInputPR8" ]
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputPR1",
		"description" : "Nombre del propietario"
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputPR2",
		"description" : "Domicilio del propietario"
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputPR3",
		"description" : "Colónia"
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputPR4",
		"description" : "Código postal"
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputPR5",
		"description" : "Ciudad"
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputPR6",
		"description" : "Estado"
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputPR7",
		"description" : "Teléfono de contacto de propietario"
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputPR8",
		"description" : "Correo electrónico de propietario"
	} ,
// ==============Campos comunes para dictamenes de usos y destinos y otros tipos de tramites=================================
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
		"description" : "Superficie del predio",
	} ,                         
// ====documents========
	{ 
		"type" : "input",
		"name" : "docRequired1",
		"description" : "Documiento requerido: identificación oficial del solicitante"
	} ,
	{ 
		"type" : "input",
		"name" : "docRequired2",
		"description" : "Documiento requerido: escrituras o contrato de compra-venta"
	} ,
	{ 
		"type" : "input",
		"name" : "docRequiredD",
		"description" : "Documiento requerido: dictamen de usos y destinos"
	} ,


// ====pruebas viejas========
	{ 
		"type" : "input",
		"description" : "Comentario del usuario sobre el contenido del tramite",
		"name" : "lmdfInputC1"
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
