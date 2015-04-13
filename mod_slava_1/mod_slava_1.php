<?php
/**
 * Entry point for Hello Slava! module
 * @package		mod_slava_1
 * @copyright		Copyright (C) 2015 Viacheslav Shalisko. All rights reserved.
 * @author 		Viacheslav Shalisko vshalisko@gmail.com
 * @license        GNU/GPL, see LICENSE.php
 * mod_helloworld is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */
 
// no direct access
defined('_JEXEC' ) or die('Restricted access');
JHtml::_('jquery.framework');
 
$databaseuser = $params->get('databaseexternaluser');

// Include the syndicate functions only once
require_once(dirname(__FILE__) . '/helper.php');

// Instantiate global document object
$doc = JFactory::getDocument();

// Ajax related JavaScript code, note the module name in request options
$js = <<<JS
(function ($) {
	$(document).on('click', 'input[name=slavabutton]', function () {
		var value   = $('input[name=slavadata]').val(),
			request = {
					'option' : 'com_ajax',
					'module' : 'slava_1',
					'data'   :  value,
					'format' : 'debug'
				};
		$.ajax({
			type   : 'POST',
			data   : request,
			success: function (response) {
				$('.slavastatus').html(response);
			}
		});
		return false;
	});
})(jQuery);
JS;

// Dynamic form generator related JavaScript code
$lmdfJS1 = <<<JS
// set data structure of decicion tree

var lmdfDecisionTree = 	{ input : [ 
	{ 
		"type" : "input",
		"name" : "lmdfInput0",
		"dependencies" : [ "lmdfInput2" , "lmdfInput4" ]
	} ,
	{ 
		"type" : "selector",
		"name" : "lmdfInput1",
		"options" : 
		[
			{ 
				"option" : "Tramite 1",
		  		"dependencies" : [ "lmdfInput3" ]
			},
			{ 
				"option" : "Tramite 2" 
			},
			{ 
				"option" : "Tramite 3" 
			},
			{ 
				"option" : "Tramite 4" 
			}
		]
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInput2",
		"dependencies" : [ "lmdfInput3" , "lmdfInput4" ]
	} ,
	{ 
		"type" : "input",
		"name" : "lmdfInput3"
	}
]};

function xmlToString(xmlData) { 

    var xmlString;
    //IE
    if (window.ActiveXObject){
        xmlString = xmlData.xml;
    }
    // code for Mozilla, Firefox, Opera, etc.
    else{
        xmlString = (new XMLSerializer()).serializeToString(xmlData);
    }
    return xmlString;
};  


// initialization of the form parser
function lmdfInit() {
	var lmdfDecisionTree1 = "";
	if ( !document.getElementById("lmdfJSONoutside").value ) {
		document.getElementById("lmdfJSONoutside").value = JSON.stringify(lmdfDecisionTree);
		lmdfDecisionTree1 = lmdfDecisionTree;
	} else {
		lmdfDecisionTree1 = JSON.parse(document.getElementById("lmdfJSONoutside").value);
	}

	var lmdfDataTest = "Inputs list: ";	
	var lmdfXML = $.parseXML("<xml></xml>")
 	var lmdfInputsArray = $("*[name^='lmdf']");
	for (var a = 0; a < lmdfInputsArray.length; a++)
	{
		inputName = lmdfInputsArray[a].name; 
		lmdfDataTest = lmdfDataTest.concat(inputName," ");
		for (var j = 0; j < lmdfDecisionTree1.input.length; j++)
		{
			if ( lmdfDecisionTree1.input[j].name == inputName ) {
				if ( lmdfDecisionTree1.input[j].type == "input" ) {
					lmdfDataTest = lmdfDataTest.concat(" (input) ");
					if (    lmdfDecisionTree1.input[j].dependencies &&
						lmdfDecisionTree1.input[j].dependencies.length > 0 ) {
						lmdfDataTest = lmdfDataTest.concat(" /with dependencies/ ");
					}
				}
				if ( lmdfDecisionTree1.input[j].value ) {
					    	var elem = lmdfXML.createElement(inputName);
    						$(elem).text(lmdfDecisionTree1.input[j].value);
						var lmdfXMLelement = lmdfXML.getElementsByTagName("xml")[0]
    						lmdfXMLelement.appendChild(elem);
				}
				if ( lmdfDecisionTree1.input[j].type == "selector" ) {
					lmdfDataTest = lmdfDataTest.concat(" (selector) ");
				}
			}
		}
	}
	$("#lmdfDataTest").text(lmdfDataTest);	
	$("#lmdfXMLout1").text(xmlToString(lmdfXML));
};

(function ($) {
	$(document).on('keypress change', 'input[name^="lmdf"]', function() {     		// Getting input from one of the form elements
		var lmdfDecisionTree1 = JSON.parse(document.getElementById("lmdfJSONoutside").value);
		var lmdfElementXML = "";
		var lmdfElementData = $(this).val();
		var lmdfElementName = $(this).attr('name');

		for (var i = 0; i < lmdfDecisionTree1.input.length; i++)	{
			if ( lmdfDecisionTree1.input[i].name == lmdfElementName ) {
				if ( lmdfElementData ) {
					lmdfDecisionTree1.input[i].value = lmdfElementData;
				}
				if (    lmdfDecisionTree1.input[i].dependencies &&
					lmdfDecisionTree1.input[i].dependencies.length > 0 ) {
					for (var d = 0; d < lmdfDecisionTree1.input[i].dependencies.length; d++) {
						var lmdfDependentInputID = "#" + lmdfDecisionTree1.input[i].dependencies[d];
						var lmdfDependentInputClass = "." + lmdfDecisionTree1.input[i].dependencies[d];
						$(lmdfDependentInputID).css("display", "block");
						$(lmdfDependentInputClass).css("display", "block");
					}
				}
			}			
		}
                                             
		// $("#lmdfFormElements1").text("Este texto aparece cuando hay algo introducido a uno de los elementos del formulario");
		document.getElementById("lmdfJSONoutside").value = JSON.stringify(lmdfDecisionTree1);
		lmdfInit();
	});


////// Test button
//	$(document).on('click', 'input[name=lmdfButton1]', function() {
//	       var lmdfData = $('input[name=lmdfInput1]').val();
//	       $("#lmdfXMLout1").text(lmdfData);
//	});


})(jQuery);

JS;

$doc->addScriptDeclaration($js);
$doc->addScriptDeclaration($lmdfJS1);

// Main module body generates initial module output (without Ajax requests)
$hello = modHelloSlavaHelper::getHello();

$sql_query_result = modHelloSlavaHelper::requestCasesTable( '%', $params );

require(JModuleHelper::getLayoutPath('mod_slava_1'));
?>