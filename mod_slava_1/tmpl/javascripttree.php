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
		  		"dependencies" : [ "lmdfInputS0", "lmdfInputS2", "lmdfInputS3", "lmdfInputS4", "lmdfInputS5",  "lmdfInputS6", "lmdfInputS7",
						"lmdfInputS","lmdfInputP1", "lmdfInputP2", "lmdfInputP3", "lmdfInputP4", "lmdfInputP5", "lmdfInputP6", 
						"lmdfInputP8", "lmdfInputP9", "lmdfInputP10", "lmdfInputP11", "lmdfInputP12", 
						"lmdfInputP13", "lmdfInputP14", "lmdfInputP15","lmdfInputP16","lmdfInputP19", 
						"lmdfInputPR0","lmdfSelectorD3","docRequired1","docRequired4","docRequired5","docRequired6" ]
			},                                                                  
			{ 
				"option" : "Grupo 2 Trazo",
		  		"dependencies" : [ "lmdfInputS0", "lmdfInputS2", "lmdfInputS3", "lmdfInputS4", "lmdfInputS5",  "lmdfInputS6", "lmdfInputS7",
						"lmdfInputS","lmdfInputP1", "lmdfInputP2", "lmdfInputP3", "lmdfInputP4", "lmdfInputP5", "lmdfInputP6", 
						"lmdfInputP8", "lmdfInputP9", "lmdfInputP10", "lmdfInputP11", "lmdfInputP12", 
						"lmdfInputP13", "lmdfInputP14", "lmdfInputP15", "lmdfInputP16", "lmdfInputP19",
						"lmdfInputPR0","lmdfSelectorD3","docRequired1","docRequired4","docRequired5","docRequired6" ]
			},
			{ 
				"option" : "Grupo 3 Licencia",
		  		"dependencies" : [ "lmdfInputL0","lmdfInputL1","lmdfInputL2","lmdfInputL3","lmdfInputL4","lmdfInputL5",
						"lmdfInputL6","lmdfInputL7","lmdfInputL8","lmdfInputL9","lmdfInputL10","lmdfInputL11",
						"lmdfInputL12","lmdfInputL13","lmdfInputL14","lmdfInputL15",
						"lmdfInputS0", "lmdfInputS2", "lmdfInputS3", "lmdfInputS4", "lmdfInputS5",  "lmdfInputS6", "lmdfInputS7",
						"lmdfInputS","lmdfInputP1", "lmdfInputP2", "lmdfInputP3", 
						"lmdfInputP4", "lmdfInputP5", "lmdfInputP6", "lmdfInputP8", "lmdfInputP9", "lmdfInputP10", "lmdfInputP11", "lmdfInputP12", 
						"lmdfInputP13", "lmdfInputP14", "lmdfInputP15", "lmdfInputP16", "lmdfInputP19", "lmdfInputPR0",
						"lmdfInputL20", 
						"lmdfInputD0","lmdfSelectorD3","docRequired1","docRequired4","docRequired5","docRequired6" ]
			},                                                                    
			{ 
				"option" : "Grupo 4 Alineamiento",
		  		"dependencies" : [ "lmdfSelector2",
						"lmdfInputS0", "lmdfInputS2", "lmdfInputS3", "lmdfInputS4", "lmdfInputS5",  "lmdfInputS6", "lmdfInputS7",
						"lmdfInputS","lmdfInputP1", "lmdfInputP2", "lmdfInputP3", 
						"lmdfInputP4", "lmdfInputP5", "lmdfInputP6", "lmdfInputP8", "lmdfInputP9", "lmdfInputP10", "lmdfInputP11", "lmdfInputP12", 
						"lmdfInputP13", "lmdfInputP14", "lmdfInputP15", "lmdfInputP16", "lmdfInputP19", 
						"lmdfInputPR0","lmdfSelectorD3","docRequired1","docRequired4","docRequired5","docRequired6" ]
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
				"dependencies" : [ "lmdfSelectorL30" ] 
			},
			{ 
				"option" : "B",
				"dependencies" : [ "lmdfSelectorL32" ] 
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
		"dependencies" : [ "lmdfSelectorL1A", "docRequired7" ] 
	} ,
	{ 
		"type" : "selector",
		"name" : "lmdfSelectorL1A",
		"description" : "Selector de licencia del tipo I.",
		"options" : 
		[
			{ 
				"option" : "A",
				"dependencies" : [ "lmdfSelectorL30", "lmdfSelectorL31" ] 
			},
			{ 
				"option" : "B",
				"dependencies" : [ "lmdfSelectorL32" ]
			},
		]
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputL2",
		"description" : "Licencia para construcción de albercas",
		"dependencies" : [ "docRequired7"  ] 
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputL3",
		"description" : "Licencia para construcción de canchas y áreas deportivas",
		"dependencies" : [ "docRequired7" ] 
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputL4",
		"description" : "Licencia para construcción de estacionamientos para usos no habitacionales",
		"dependencies" : [ "lmdfSelectorL25", "lmdfInputL23", "docRequired7"  ] 
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputL5",
		"description" : "Licencia para demolición",
		"dependencies" : [ "lmdfInputP16" ] 
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputL6",
		"description" : "Licencia para acotamiento",
		"dependencies" : [ "lmdfInputL23", "lmdfSelectorL30", "docRequired7", "docRequired8" ] 
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputL7",
		"description" : "Licencia para instalar tapiales provisionales en la vía pública",
		"dependencies" : [ "lmdfInputP16", "lmdfInputL27" ] 

	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputL8",
		"description" : "Licencia para remodelación o restauración",
		"dependencies" : [ "lmdfInputP17", "lmdfInputP18", "docRequired9", "docRequired7" ] 
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputL9",
		"description" : "Licencia para reconstrucción, reestructuración o adaptación",
		"dependencies" : [ "lmdfSelectorL21", "docRequired9", "docRequired7" ] 
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputL10",
		"description" : "Licencia para ocupación de la vía pública con materiales de construcción",
		"dependencies" : [ "lmdfInputL23", "lmdfInputL24" ] 
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputL11",
		"description" : "Licencia para ocupación de la vía pública por puestos, carpas, módulos, etcétera provisionales",
		"dependencies" : [ "lmdfInputL23", "lmdfInputL24" ] 

	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputL12",
		"description" : "Licencia para movimientos de tierra",
		"dependencies" : [ "lmdfInputL26" ] 
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputL13",
		"description" : "Licencia provisional de construcción",
		"dependencies" : [ "docRequired7" ]
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputL14",
		"description" : "Licencia para construcción de plataformas, patios de maniobra y rampas",
		"dependencies" : [ "lmdfInputL23", "docRequired7" ] 
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputL15",
		"description" : "Licencia similar de tipo no previsto",
		"dependencies" : [ "lmdfInputL23", "docRequired7", "lmdfInputC1" ] 
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
	{ 
		"type" : "selector",
		"name" : "lmdfSelectorD3",
		"description" : "Estacionamiento cubierto o descubierto",
		"options" : 
		[
			{ 
				"option" : "escritura",
				"dependencies" : [ "lmdfInputD3", "docRequired3" ]
			},
			{ 
				"option" : "contrato de compra-venta",
				"dependencies" : [ "lmdfInputD4", "lmdfInputD5", "docRequired3" ]
			},
		]
	} ,
	{       
		"type" : "input",
		"name" : "lmdfInputD3",
		"description" : "Número de escritura"
	} ,
	{       
		"type" : "input",
		"name" : "lmdfInputD4",
		"description" : "Número de contrato de compra-venta"
	} ,
	{       
		"type" : "input",
		"name" : "lmdfInputD5",
		"description" : "Fecha de contrato de compra-venta"
	} ,
	{       // this should be selected in any case after any License is selected
		"type" : "input",
		"name" : "lmdfInputL20",
		"description" : "Detalles de licencias"
	} ,
	{ 
		"type" : "selector",
		"name" : "lmdfSelectorL21",
		"description" : "Tipo de reparación",
		"options" : 
		[
			{ 
				"option" : "reparación menor"
			},
			{ 
				"option" : "reparación mayor o adaptación"
			},
		]
	} ,
	{       
		"type" : "input",
		"name" : "lmdfInputL23",
		"description" : "Superficeie en métros cuadrados amparado por la licencia"
	} ,
	{       
		"type" : "input",
		"name" : "lmdfInputL24",
		"description" : "Periodo en días amparado por la licencia"
	} ,
	{ 
		"type" : "selector",
		"name" : "lmdfSelectorL25",
		"description" : "Estacionamiento cubierto o descubierto",
		"options" : 
		[
			{ 
				"option" : "cubierto",
			},
			{ 
				"option" : "descubierto"
			},
		]
	} ,
	{       
		"type" : "input",
		"name" : "lmdfInputL26",
		"description" : "Volumen en metros cúbicos"
	} ,
	{       
		"type" : "input",
		"name" : "lmdfInputL27",
		"description" : "Distancia metros lineales"
	} ,
	{ 
		"type" : "selector",
		"name" : "lmdfSelectorL30",
		"description" : "Densidad",
		"options" : 
		[
			{ 
				"option" : "alta"
			},
			{ 
				"option" : "media"
			},
			{ 
				"option" : "baja"
			},
			{ 
				"option" : "minima"
			}
		]
	} ,
	{ 
		"type" : "selector",
		"name" : "lmdfSelectorL31",
		"description" : "Tipo de vivienda",
		"options" : 
		[
			{ 
				"option" : "unifamiliar"
			},
			{ 
				"option" : "plurifamiliar horizontal"
			},
			{ 
				"option" : "plurifamiliar vertical"
			}
		]
	} ,
	{ 
		"type" : "selector",
		"name" : "lmdfSelectorL32",
		"description" : "Tipo de uso no habitacional",
		"options" : 
		[
			{ 
				"option" : "comercio y servicios",
				"dependencies" : [ "lmdfSelectorL33" ]
			},
			{ 
				"option" : "uso turístico",
				"dependencies" : [ "lmdfSelectorL34" ]
			},
			{ 
				"option" : "industria",
				"dependencies" : [ "lmdfSelectorL35" ]
			},
			{ 
				"option" : "equipamiento y otros",
				"dependencies" : [ "lmdfSelectorL36" ]
			}
		]
	} ,
	{ 
		"type" : "selector",
		"name" : "lmdfSelectorL33",
		"description" : "Tipo de comercio y servicios",
		"options" : 
		[
			{ 
				"option" : "barrial"
			},
			{ 
				"option" : "central"
			},
			{ 
				"option" : "distrital"
			},
			{ 
				"option" : "regional"
			}

		]
	} ,
	{ 
		"type" : "selector",
		"name" : "lmdfSelectorL34",
		"description" : "Tipo de uso turistico",
		"options" : 
		[
			{ 
				"option" : "campestre"
			},
			{ 
				"option" : "hotelero densidad alta"
			},
			{ 
				"option" : "hotelero densidad media"
			},
			{ 
				"option" : "hotelero densidad baja"
			},
			{ 
				"option" : "hotelero densidad mínima"
			}
		]
	} ,
	{ 
		"type" : "selector",
		"name" : "lmdfSelectorL35",
		"description" : "Tipo de industria",
		"options" : 
		[
			{ 
				"option" : "ligera riesgo bajo"
			},
			{ 
				"option" : "media riesgo medio"
			},
			{ 
				"option" : "pesada riesgo alto"
			}
		]
	} ,
	{ 
		"type" : "selector",
		"name" : "lmdfSelectorL36",
		"description" : "Tipo de equipamientos y otros",
		"options" : 
		[
			{ 
				"option" : "institucional"
			},
			{ 
				"option" : "regional"
			},
			{ 
				"option" : "espacios verdes"
			},
			{ 
				"option" : "especial"
			},
			{ 
				"option" : "infraestructura"
			}
		]
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
		"dependencies" : [ "lmdfInputPR1", "lmdfInputPR2", "lmdfInputPR3", "lmdfInputPR4", "lmdfInputPR5", "lmdfInputPR6", "lmdfInputPR7", "lmdfInputPR8", "docRequired1A" ]
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
		"description" : "Ubicación: número oficial",
		"dependencies" : [ "lmdfInputP2A" ]
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputP2A",
		"description" : "Se cuenta con comprobante de asignación del número oficial"
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
		"description" : "Superficie de obra mayor que 50 m2",
		"dependencies" : [ "lmdfInputP7", "docRequired8" ]
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputP7",
		"description" : "Superficie de la obra",
	} , 
	{ 
		"type" : "input",
		"name" : "lmdfInputP8",
		"description" : "Manzana"
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputP9",
		"description" : "Lote"
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputP10",
		"description" : "Clave catastral"
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputP11",
		"description" : "Servicios: Agua"
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputP12",
		"description" : "Servicios: Drenaje"
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputP13",
		"description" : "Servicios: Alumbrado"
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputP14",
		"description" : "Servicios: Pavimiento"
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputP15",
		"description" : "Servicios: Banqueta"
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputP16",
		"description" : "Ubicación en el centro histórico"
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputP17",
		"description" : "Restauración en el centro histórico"
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputP18",
		"description" : "Remodelación en el centro histórico"
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputP19",
		"description" : "Predio cuenta con la construcción o se pretende construir",
		"dependencies" : [ "lmdfInputP20", "docRequired7" ]

	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputP20",
		"description" : "Descripción de la construcción"
	} ,

// ====documents========
	{ 
		"type" : "input",
		"name" : "docRequired1",
		"description" : "Documiento requerido: identificación oficial del solicitante"
	} ,
	{ 
		"type" : "input",
		"name" : "docRequired1A",
		"description" : "Documiento requerido: identificación oficial del propietario"
	} ,
	{ 
		"type" : "input",
		"name" : "docRequired2",
		"description" : "Documiento requerido: escrituras"
	} ,
	{ 
		"type" : "input",
		"name" : "docRequired3",
		"description" : "Documiento requerido: contrato de compra-venta"
	} ,
	{ 
		"type" : "input",
		"name" : "docRequired4",
		"description" : "Documiento requerido: comprobante de domicilio"
	} ,
	{ 
		"type" : "input",
		"name" : "docRequired5",
		"description" : "Documiento requerido: registro público de la propiedad"
	} ,
	{ 
		"type" : "input",
		"name" : "docRequired6",
		"description" : "Documiento requerido: pago de predial actualizado"
	} ,
	{ 
		"type" : "input",
		"name" : "docRequired7",
		"description" : "Documiento requerido: croquis de construcción"
	} ,
	{ 
		"type" : "input",
		"name" : "docRequired8",
		"description" : "Documiento requerido: Proyecto y planos ejecutivos firmados por director responsable de obra (DRO)"
	} ,
	{ 
		"type" : "input",
		"name" : "docRequired9",
		"description" : "Documiento requerido: Fotos de fachada e interior (en un solo archivo PDF)"
	} ,
	{ 
		"type" : "input",
		"name" : "docRequiredA",
		"description" : "Documiento requerido: Comprobante de alineamiento"
	} ,
	{ 
		"type" : "input",
		"name" : "docRequiredN",
		"description" : "Documiento requerido: Comprobante de asignación del número oficial"
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
