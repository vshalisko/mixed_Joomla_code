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

// Javascript of doc list generator
$lmdfJS2 = <<<JS2

// initialization of the form parser
jQuery.noConflict();
(function ($) {
docInit = function () {
	var lmdfDecisionTree1 = new Object();
	if ( !document.getElementById("lmdfJSONoutside").value ) {
		document.getElementById("lmdfJSONoutside").value = JSON.stringify(lmdfDecisionTree);              // Store JSON string on hidden field
		lmdfDecisionTree1 = lmdfDecisionTree;
	} else {
		var s = document.getElementById("lmdfJSONoutside").value;
		// var s = '"' + document.getElementById("lmdfJSONoutside").value + '"';
		// lmdfDecisionTree1 = JSON.parse(s);
		lmdfDecisionTree1 = eval("(function(){return " + s + ";})()");
		
	}
	// alert("This is my value:" + document.getElementById("lmdfJSONoutside").value);
	// alert("This is my JSON:" + lmdfDecisionTree1.input.length);


	for (var i = 0; i < lmdfDecisionTree1.input.length; i++)          // Taking one by one all the elements from JSON structure (input)
	{
		if ( !lmdfDecisionTree1.input[i].alwaysvisible ) {
			lmdfDecisionTree1.input[i].on = false;							// Reset visibility of all elements in JSON
		} else {
			lmdfDecisionTree1.input[i].on = true;
		}
	}
	for (var i = 0; i < lmdfDecisionTree1.input.length; i++)           // Taking one by one all the elements from JSON structure (input)
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

	// Taking one by one all the elements from JSON structure and switchig on or off the corresponding predefined elements in HTML
	for (var i = 0; i < lmdfDecisionTree1.input.length; i++)      			
	{
	// Loop that change the visibility of elements
		var lmdfDependentInputID = "#" + lmdfDecisionTree1.input[i].name;
                var lmdfDependentInputClass = "." + lmdfDecisionTree1.input[i].name;
		var lmdfDependentInputName = lmdfDecisionTree1.input[i].name;
		if ( lmdfDecisionTree1.input[i].on ) {
                        $(lmdfDependentInputID).css("display", "block");           // Make element visible by ID
                        $(lmdfDependentInputClass).css("display", "block");        // Make element visible by class (same as ID)
		} else {
                        $(lmdfDependentInputID).css("display", "none");           // Make element invisible by ID
                        $(lmdfDependentInputClass).css("display", "none");        // Make element invisible by class (same as ID)
		}
	}                                       	


}
})(jQuery);

JS2;

$doc->addScriptDeclaration($lmdfJS2);
?>
