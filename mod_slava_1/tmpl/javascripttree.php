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
		"name" : "lmdfSelectorRol",
		"alwaysvisible" : true,
		"required" : true,
		"description" : "Selector de rol del solicitante",
		"options" : 
		[
			{ 
				"option" : "propietario",
				"dependencies" : [ "lmdfInputS0", "lmdfInputSP", "lmdfInputS2", "lmdfInputS3", "lmdfInputS4", "lmdfInputS5",  "lmdfInputS6", "lmdfInputS7" ]
			},
			{ 
				"option" : "gestor",
				"dependencies" : [ "lmdfInputS0", "lmdfInputSG", "lmdfInputS2", "lmdfInputS3", "lmdfInputS4", "lmdfInputS5",  "lmdfInputS6", "lmdfInputS7",
						"lmdfInputPR0", "lmdfInputPR1", "lmdfInputPR2", "lmdfInputPR3", "lmdfInputPR4", "lmdfInputPR5", "lmdfInputPR6", "lmdfInputPR7", "lmdfInputPR8", 
						"docRequired1A", "docRequired11" ]
			},
			{ 
				"option" : "apoderado",
				"dependencies" : [ "lmdfInputS0", "lmdfInputSG", "lmdfInputS2", "lmdfInputS3", "lmdfInputS4", "lmdfInputS5",  "lmdfInputS6", "lmdfInputS7",
						"lmdfInputPR0", "lmdfInputPR1", "lmdfInputPR2", "lmdfInputPR3", "lmdfInputPR4", "lmdfInputPR5", "lmdfInputPR6", "lmdfInputPR7", "lmdfInputPR8", 
						"docRequired1A", "docRequired11" ]
			},
		]
	} ,
 	{ 
		"type" : "selector",
		"name" : "lmdfSelector0",
		"description" : "Selector del tipo de tramite de primer nivel",
		"alwaysvisible" : true,
		"options" : 
		[
			{ 
				"option" : "Grupo 2 Trazo",
		  		"dependencies" : [ 
						"lmdfInputP1", "lmdfInputP2", "lmdfInputP3", "lmdfInputP4", "lmdfInputP5",
						"lmdfInputP8", "lmdfInputP9", "lmdfInputP10", "lmdfInputP11", "lmdfInputP12", 
						"lmdfInputP13", "lmdfInputP14", "lmdfInputP15",
						"lmdfInputS","lmdfInputC0",
						"lmdfSelectorD3","docRequired1","docRequired4","docRequired5","docRequired6" ]
			},
			{ 
				"option" : "Grupo 3 Licencia",
		  		"dependencies" : [ "lmdfInputL0","lmdfInputL1","lmdfInputL2","lmdfInputL3","lmdfInputL4","lmdfInputL5",
						"lmdfInputL6","lmdfInputL7","lmdfInputL8","lmdfInputL9","lmdfInputL10","lmdfInputL11",
						"lmdfInputL12","lmdfInputL13","lmdfInputL14","lmdfInputL15",
						"lmdfInputA0","lmdfInputAD","lmdfInputAN","lmdfInputA3","lmdfInputA4",
						"lmdfInputP1", "lmdfInputP2", "lmdfInputP3", 
						"lmdfInputP4", "lmdfInputP5", "lmdfInputP6", "lmdfInputP8", "lmdfInputP9", "lmdfInputP10", "lmdfInputP11", "lmdfInputP12", 
						"lmdfInputP13", "lmdfInputP14", "lmdfInputP15", "lmdfInputP19","lmdfInputL20", 
						"lmdfInputS","lmdfInputL",
						"lmdfInputD0","lmdfSelectorD3","docRequired1","docRequired4","docRequired5","docRequired6" ]
			}
		]
	} ,
// ====nuevo selector de alineamiento========
	{ 
		"type" : "input",
		"name" : "lmdfInputA0",
		"description" : "Alineamiento (grupo)"
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputAD",
		"description" : "Ausencia del comprobante de alineamiento",
		"dependencies" : [ "lmdfInputA1", "docRequiredA" ]
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputAN",
		"description" : "Ausencia del comprobande de designación del número oficial",
		"dependencies" : [ "lmdfInputA2", "docRequiredN" ]
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputA1",
		"description" : "Alineamiento",
		"dependencies" : [ "lmdfSelector2A", "lmdfInputL27H" ] 
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputA2",
		"description" : "Designación del número oficial",
		"dependencies" : [ "lmdfSelector2A" ] 
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputA3",
		"description" : "Inspección",
		"dependencies" : [ "lmdfSelector2A" ] 
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputA4",
		"description" : "Otro tramite no previsto",
		"dependencies" : [ "lmdfInputL23H", "lmdfInputC1" ] 
	} ,
	{ 
		"type" : "selector",
		"name" : "lmdfSelector2A",
		"required" : true,
		"description" : "Selector de tipo de inmueble para tramites de alineamiento",
		"options" : 
		[
			{ 
				"option" : "A",
				"dependencies" : [ "lmdfSelectorL30B" ] 
			},
			{ 
				"option" : "B",
				"dependencies" : [ "lmdfSelectorL32A" ] 
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
		"dependencies" : [ "lmdfSelectorL1A", "lmdfInputL23", "docRequired7" ] 
	} ,
	{ 
		"type" : "selector",
		"name" : "lmdfSelectorL1A",
		"required" : true,
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
		"dependencies" : [ "lmdfInputL26", "docRequired7"  ] 
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputL3",
		"description" : "Licencia para construcción de canchas y áreas deportivas",
		"dependencies" : [ "lmdfInputL23A", "docRequired7" ] 
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputL4",
		"description" : "Licencia para construcción de estacionamientos para usos no habitacionales",
		"dependencies" : [ "lmdfInputL23B", "lmdfSelectorL25", "docRequired7"  ] 
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputL5",
		"description" : "Licencia para demolición",
		"dependencies" : [ "lmdfSelectorP16", "docRequired9", "docRequired7" ] 
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputL6",
		"description" : "Licencia para acotamiento",
		"dependencies" : [ "lmdfInputL23C", "lmdfInputL27","lmdfSelectorL30A", "docRequired7", "docRequired8" ] 
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputL7",
		"description" : "Licencia para instalar tapiales provisionales en la vía pública",
		"dependencies" : [ "lmdfSelectorP16B", "lmdfInputL27A", "docRequired7" ] 

	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputL8",
		"description" : "Licencia para remodelación o restauración",
		"dependencies" : [ "lmdfSelectorP16A", "docRequired9", "docRequired7" ] 
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
		"dependencies" : [ "lmdfSelectorP16C", "lmdfInputL23D", "lmdfInputL24", "docRequired7" ] 
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputL11",
		"description" : "Licencia para ocupación de la vía pública por puestos, carpas, módulos, etcétera provisionales",
		"dependencies" : [ "lmdfSelectorP16D", "lmdfInputL23E", "lmdfInputL24A", "docRequired7" ] 

	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputL12",
		"description" : "Licencia para movimientos de tierra",
		"dependencies" : [ "lmdfInputL26A", "docRequired7", "docRequired10" ] 
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
		"dependencies" : [ "lmdfInputL23F", "docRequired7" ] 
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputL15",
		"description" : "Licencia similar de tipo no previsto",
		"dependencies" : [ "lmdfInputL23G", "docRequired7", "lmdfInputC1" ] 
	} ,

// ====campos a llenar en formulario========
	{       // this should be selected in case of license or "tramite de alineamiento"
		"type" : "input",
		"name" : "lmdfInputL",
		"description" : "Opciones de tramite (grupo)"
	} ,
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
		"required" : true,
		"description" : "Número oficial del dictamen de usos y destinos"
	} ,
	{       
		"type" : "input",
		"name" : "lmdfInputD2",
		"required" : true,
		"description" : "Fecha de emisión del dictamen de usos y destinos"
	} ,
	{ 
		"type" : "selector",
		"name" : "lmdfSelectorD3",
		"required" : true,
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
		"required" : true,
		"description" : "Número de escritura"
	} ,
	{       
		"type" : "input",
		"name" : "lmdfInputD4",
		"required" : true,
		"description" : "Número de contrato de compra-venta"
	} ,
	{       
		"type" : "input",
		"name" : "lmdfInputD5",
		"required" : true,
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
		"required" : true,
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
		"required" : true,
		"description" : "Superficie en métros cuadrados amparado por la licencia I."
	} ,
	{       
		"type" : "input",
		"name" : "lmdfInputL23A",
		"required" : true,
		"description" : "Superficie en métros cuadrados amparado por la licencia III."
	} ,
	{       
		"type" : "input",
		"name" : "lmdfInputL23B",
		"required" : true,
		"description" : "Superficie en métros cuadrados amparado por la licencia IV."
	} ,
	{       
		"type" : "input",
		"name" : "lmdfInputL23C",
		"required" : true,
		"description" : "Superficie en métros cuadrados amparado por la licencia VI."
	} ,
	{       
		"type" : "input",
		"name" : "lmdfInputL23D",
		"required" : true,
		"description" : "Superficie en métros cuadrados amparado por la licencia X."
	} ,
	{       
		"type" : "input",
		"name" : "lmdfInputL23E",
		"required" : true,
		"description" : "Superficie en métros cuadrados amparado por la licencia XI."
	} ,
	{       
		"type" : "input",
		"name" : "lmdfInputL23F",
		"required" : true,
		"description" : "Superficie en métros cuadrados amparado por la licencia XIV."
	} ,
	{       
		"type" : "input",
		"name" : "lmdfInputL23G",
		"required" : true,
		"description" : "Superficie en métros cuadrados amparado por la licencia XV."
	} ,
	{       
		"type" : "input",
		"name" : "lmdfInputL23H",
		"required" : true,
		"description" : "Superficie en métros cuadrados tramites similares no previstos"
	} ,
	{       
		"type" : "input",
		"name" : "lmdfInputL24",
		"required" : true,
		"description" : "Periodo en días amparado por la licencia X."
	} ,
	{       
		"type" : "input",
		"name" : "lmdfInputL24A",
		"required" : true,
		"description" : "Periodo en días amparado por la licencia XI."
	} ,
	{ 
		"type" : "selector",
		"name" : "lmdfSelectorL25",
		"required" : true,
		"description" : "Estacionamiento cubierto o descubierto",
		"options" : 
		[
			{ 
				"option" : "cubierto",
			},
			{ 
				"option" : "descubierto"
			}
		]
	} ,
	{       
		"type" : "input",
		"name" : "lmdfInputL26",
		"required" : true,
		"description" : "Volumen en métros cúbicos amparado por la licencia II."
	} ,
	{       
		"type" : "input",
		"name" : "lmdfInputL26A",
		"required" : true,
		"description" : "Volumen en métros cúbicos amparado por la licencia XII."
	} ,
	{       
		"type" : "input",
		"name" : "lmdfInputL27",
		"required" : true,
		"description" : "Métros lineales amparado por la licencia VI."
	} ,
	{       
		"type" : "input",
		"name" : "lmdfInputL27A",
		"required" : true,
		"description" : "Métros lineales amparado por la licencia VII."
	} ,
	{       
		"type" : "input",
		"name" : "lmdfInputL27H",
		"required" : true,
		"description" : "Métros lineales por alineamiento"
	} ,
	{ 
		"type" : "selector",
		"name" : "lmdfSelectorL30",
		"required" : true,
		"description" : "Densidad (Licencia I.)",
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
		"name" : "lmdfSelectorL30B",
		"required" : true,
		"description" : "Densidad (Alineación y designación de número)",
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
		"name" : "lmdfSelectorL30A",
		"required" : true,
		"description" : "Densidad (Licencia VI.)",
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
		"required" : true,
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
		"required" : true,
		"description" : "Tipo de uso no habitacional (Licencia I.)",
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
		"name" : "lmdfSelectorL32A",
		"required" : true,
		"description" : "Tipo de uso no habitacional (Alineación y designación de número)",
		"options" : 
		[
			{ 
				"option" : "comercio y servicios",
				"dependencies" : [ "lmdfSelectorL33A" ]
			},
			{ 
				"option" : "uso turístico",
				"dependencies" : [ "lmdfSelectorL34A" ]
			},
			{ 
				"option" : "industria",
				"dependencies" : [ "lmdfSelectorL35A" ]
			},
			{ 
				"option" : "equipamiento y otros",
				"dependencies" : [ "lmdfSelectorL36A" ]
			}
		]
	} ,
	{ 
		"type" : "selector",
		"name" : "lmdfSelectorL33",
		"required" : true,
		"description" : "Tipo de comercio y servicios (Licencias)",
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
		"name" : "lmdfSelectorL33A",
		"required" : true,
		"description" : "Tipo de comercio y servicios (Alineación y designación de número)",
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
		"required" : true,
		"description" : "Tipo de uso turistico (Licencias)",
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
		"name" : "lmdfSelectorL34A",
		"required" : true,
		"description" : "Tipo de uso turistico  (Alineación y designación de número)",
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
		"required" : true,
		"description" : "Tipo de industria (Licencias)",
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
		"name" : "lmdfSelectorL35A",
		"required" : true,
		"description" : "Tipo de industria (Alineación y designación de número)",
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
		"required" : true,
		"description" : "Tipo de equipamientos y otros (Licencias)",
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
	{ 
		"type" : "selector",
		"name" : "lmdfSelectorL36A",
		"required" : true,
		"description" : "Tipo de equipamientos y otros (Alineación y designación de número)",
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
		"name" : "lmdfInputSP",
		"description" : "Solicitante es propietario"
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputSG",
		"description" : "Solicitante es gestor o apoderado",
	} ,

	{ 
		"type" : "input",
		"name" : "lmdfInputS1",
		"required" : true,
		"description" : "Razón social"
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputS2",
		"required" : true,
		"description" : "Domicilio de residencia"
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputS3",
		"required" : true,
		"description" : "Colónia"
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputS4",
		"required" : true,
		"description" : "Código postal"
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputS5",
		"required" : true,
		"description" : "Ciudad"
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputS6",
		"required" : true,
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
		"required" : true,
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
		"required" : true,
		"description" : "Nombre del propietario"
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputPR2",
		"required" : true,
		"description" : "Domicilio del propietario"
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputPR3",
		"required" : true,
		"description" : "Colónia"
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputPR4",
		"required" : true,
		"description" : "Código postal"
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputPR5",
		"required" : true,
		"description" : "Ciudad"
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputPR6",
		"required" : true,
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
		"required" : true,
		"description" : "Correo electrónico de propietario"
	} ,
// ==============Campos comunes para dictamenes de usos y destinos y otros tipos de tramites=================================
	{ 
		"type" : "input",
		"name" : "lmdfInputP1",
		"required" : true,
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
		"required" : true,
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
		"type" : "selector",
		"name" : "lmdfSelectorP16",
		"required" : true,
		"description" : "Ubicación en el centro histórico (Licencia V.)",
		"options" : 
		[
			{ 
				"option" : "dentro del centro histórico"
			},
			{ 
				"option" : "fuera del centro histórico"
			},
		]
	} ,
	{ 
		"type" : "selector",
		"name" : "lmdfSelectorP16A",
		"required" : true,
		"description" : "Ubicación en el centro histórico (Licencia VIII.)",
		"options" : 
		[
			{ 
				"option" : "dentro del centro histórico",
				"dependencies" : [ "lmdfInputP17", "lmdfInputP18" ]
			},
			{ 
				"option" : "fuera del centro histórico"
			},
		]
	} ,
	{ 
		"type" : "selector",
		"name" : "lmdfSelectorP16B",
		"required" : true,
		"description" : "Ubicación en el centro histórico (Licencia VII.)",
		"options" : 
		[
			{ 
				"option" : "dentro del centro histórico"
			},
			{ 
				"option" : "fuera del centro histórico"
			},
		]
	} ,
	{ 
		"type" : "selector",
		"name" : "lmdfSelectorP16C",
		"required" : true,
		"description" : "Ubicación en el centro histórico (Licencia X.)",
		"options" : 
		[
			{ 
				"option" : "dentro del centro histórico"
			},
			{ 
				"option" : "fuera del centro histórico"
			},
		]
	} ,
	{ 
		"type" : "selector",
		"name" : "lmdfSelectorP16D",
		"required" : true,
		"description" : "Ubicación en el centro histórico (Licencia XI.)",
		"options" : 
		[
			{ 
				"option" : "dentro del centro histórico"
			},
			{ 
				"option" : "fuera del centro histórico"
			},
		]
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
		"required" : true,
		"description" : "Descripción de la construcción"
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputC0",
		"description" : "Construcción",
		"dependencies" : [ "lmdfInputC1" ]
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInputC1",
		"description" : "Superficie de construcción en m2"
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
		"description" : "Documiento requerido: croquis de construcción u otro"
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
		"name" : "docRequired10",
		"description" : "Documiento requerido: Dictamen de la dirección de obras públicas y desarrollo urbano sobre movimientos de la tierra"
	} ,
	{ 
		"type" : "input",
		"name" : "docRequired11",
		"description" : "Documiento requerido: Carta de poder"
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
