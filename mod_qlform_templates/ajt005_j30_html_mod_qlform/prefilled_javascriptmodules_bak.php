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
defined('_JEXEC') or die('Restricted access'); ?>


<?php
$doc1 = JFactory::getDocument();

// Dynamic form generator related JavaScript code
$lmdfJS1 = <<<JS
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
		document.getElementById("lmdfJSONoutside").value = JSON.stringify(lmdfDecisionTree);              // Store JSON string on hidden field
		lmdfDecisionTree1 = lmdfDecisionTree;
	} else {
		lmdfDecisionTree1 = JSON.parse(document.getElementById("lmdfJSONoutside").value);                 // Recover value of stored JSON field
	}

	for (var i = 0; i < lmdfDecisionTree1.input.length; i++)
	{
		if ( !lmdfDecisionTree1.input[i].alwaysvisible ) {
			lmdfDecisionTree1.input[i].on = false;							// Reset visibility of all elements in JSON
		} else {
			lmdfDecisionTree1.input[i].on = true;
		}
	}

	for (var i = 0; i < lmdfDecisionTree1.input.length; i++)
	{
		if (    lmdfDecisionTree1.input[i].value &&
			lmdfDecisionTree1.input[i].dependencies &&
			lmdfDecisionTree1.input[i].dependencies.length > 0 ) {
			for (var d = 0; d < lmdfDecisionTree1.input[i].dependencies.length; d++) {      // Get list of dependent elements
				for (var k = 0; k < lmdfDecisionTree1.input.length; k++)
				// Looking for dependent elements in JSON structure to switch them on
				{
					if (lmdfDecisionTree1.input[k].name == lmdfDecisionTree1.input[i].dependencies[d] ) {
                                       		lmdfDecisionTree1.input[k].on = true;			// Setting visibility of appropiate dependent elements
					}
				}
			}
		}
		if (    lmdfDecisionTree1.input[i].value &&
			lmdfDecisionTree1.input[i].options &&
			lmdfDecisionTree1.input[i].options.length > 0 ) {
			for (var o = 0; o < lmdfDecisionTree1.input[i].options.length; o++)
			{
				if ( lmdfDecisionTree1.input[i].options[o].option == lmdfDecisionTree1.input[i].value && 
					lmdfDecisionTree1.input[i].options[o].dependencies &&
					lmdfDecisionTree1.input[i].options[o].dependencies.length > 0 ) {
                                        
					for (var d = 0; d < lmdfDecisionTree1.input[i].options[o].dependencies.length; d++) {
						for (var k = 0; k < lmdfDecisionTree1.input.length; k++)
						{
							if (lmdfDecisionTree1.input[k].name == lmdfDecisionTree1.input[i].options[o].dependencies[d] ) {
		                                       		lmdfDecisionTree1.input[k].on = true;			// Setting visibility of appropiate dependent elements
							}
						}
					}
				}
			}
		}
	}

	var lmdfXML = $.parseXML("<xml></xml>");					// Making empty XML document

	for (var i = 0; i < lmdfDecisionTree1.input.length; i++)      			// Taking one by one all the elements from JSON structure (input)
	{
	// Loop that change the visibility of elements
		var lmdfDependentInputID = "#" + lmdfDecisionTree1.input[i].name;
                var lmdfDependentInputClass = "." + lmdfDecisionTree1.input[i].name;
		if ( lmdfDecisionTree1.input[i].on ) {
                        $(lmdfDependentInputID).css("display", "block");           // Make element visible by ID
                        $(lmdfDependentInputClass).css("display", "block");        // Make element visible by class (same as ID)
		} else {
                        $(lmdfDependentInputID).css("display", "none");           // Make element invisible by ID
                        $(lmdfDependentInputClass).css("display", "none");        // Make element invisible by class (same as ID)
		}
		if ( lmdfDecisionTree1.input[i].value &&                	// Checking if there are some value stored in JSON structure
			lmdfDecisionTree1.input[i].on ) {                       // Checking if element is visible
			var elem = lmdfXML.createElement(lmdfDecisionTree1.input[i].name);            // Including this element to XML
    			$(elem).text(lmdfDecisionTree1.input[i].value);
			var lmdfXMLelement = lmdfXML.getElementsByTagName("xml")[0];
    			lmdfXMLelement.appendChild(elem);
		}                      			
	}                                       	

	$("#lmdfXMLout1").text(xmlToString(lmdfXML));

};

(function ($) {
	$(document).on('keypress change input keyup', 'input[name^="lmdf"]', function() {     		// Detecting input from one of the form elements
		var lmdfDecisionTree1 = JSON.parse(document.getElementById("lmdfJSONoutside").value);
		var lmdfElementData = $(this).val();
		var lmdfElementName = $(this).attr('name');

		for (var i = 0; i < lmdfDecisionTree1.input.length; i++)	{
			if ( lmdfDecisionTree1.input[i].name == lmdfElementName ) {
				if ( lmdfElementData ) {
					lmdfDecisionTree1.input[i].value = lmdfElementData;         // Set element value in JSON structure
				} else {
					lmdfDecisionTree1.input[i].value = "";			    // Clear element value in JSON structure
				}
			}			
		}
		document.getElementById("lmdfJSONoutside").value = JSON.stringify(lmdfDecisionTree1);     // Updating stored JSON string
		lmdfInit();
	});

	$(document).on('change', 'select[name^="lmdf"]', function() {     		// Detecting input from one of the form elements
		var lmdfDecisionTree1 = JSON.parse(document.getElementById("lmdfJSONoutside").value);
		var lmdfElementData = $(this).val();
		var lmdfElementName = $(this).attr('name');

		for (var i = 0; i < lmdfDecisionTree1.input.length; i++)	{
			if ( lmdfDecisionTree1.input[i].name == lmdfElementName ) {
				if ( lmdfElementData ) {
					lmdfDecisionTree1.input[i].value = lmdfElementData;         // Set element value in JSON structure
				}
			}			
		}
		document.getElementById("lmdfJSONoutside").value = JSON.stringify(lmdfDecisionTree1);     // Updating stored JSON string
		lmdfInit();
	});

	$(document).on('change', 'radio[name^="lmdf"]', function() {     		// Detecting input from one of the form elements
		var lmdfDecisionTree1 = JSON.parse(document.getElementById("lmdfJSONoutside").value);
		var lmdfElementData = $(this).val();
		var lmdfElementName = $(this).attr('name');

		for (var i = 0; i < lmdfDecisionTree1.input.length; i++)	{
			if ( lmdfDecisionTree1.input[i].name == lmdfElementName ) {
				if ( lmdfElementData ) {
					lmdfDecisionTree1.input[i].value = lmdfElementData;         // Set element value in JSON structure
				}
			}			
		}
		document.getElementById("lmdfJSONoutside").value = JSON.stringify(lmdfDecisionTree1);     // Updating stored JSON string
		lmdfInit();
	});


	$(document).on('keypress change input paste cut keyup', 'textarea[name^="lmdf"]', function() {     		// Detecting input from one of the form elements
		var lmdfDecisionTree1 = JSON.parse(document.getElementById("lmdfJSONoutside").value);
		var lmdfElementData = $(this).val();
		var lmdfElementName = $(this).attr('name');

		for (var i = 0; i < lmdfDecisionTree1.input.length; i++)	{
			if ( lmdfDecisionTree1.input[i].name == lmdfElementName ) {
				if ( lmdfElementData ) {
					lmdfDecisionTree1.input[i].value = lmdfElementData;         // Set element value in JSON structure
				} else {
					lmdfDecisionTree1.input[i].value = "";			    // Clear element value in JSON structure
				}
			}			
		}
		document.getElementById("lmdfJSONoutside").value = JSON.stringify(lmdfDecisionTree1);     // Updating stored JSON string
		lmdfInit();
	});


})(jQuery);
JS;

$doc1->addScriptDeclaration($lmdfJS1);
?>