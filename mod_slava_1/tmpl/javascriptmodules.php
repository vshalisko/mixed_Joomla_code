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
$lmdfJS1 = <<<JS
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
jQuery.noConflict();
(function ($) {
lmdfInit = function () {
//	jQuery.validator.defaults.ignore = ":hidden";
	var lmdfDecisionTree1 = "";
	if ( !document.getElementById("lmdfJSONoutside").value ) {
		document.getElementById("lmdfJSONoutside").value = JSON.stringify(lmdfDecisionTree);              // Store JSON string on hidden field
		lmdfDecisionTree1 = lmdfDecisionTree;
	} else {
		lmdfDecisionTree1 = JSON.parse(document.getElementById("lmdfJSONoutside").value);                 // Recover value of stored JSON field
	}

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
			lmdfDecisionTree1.input[i].on &&   // addition 06.2015
			lmdfDecisionTree1.input[i].dependencies &&
			lmdfDecisionTree1.input[i].dependencies.length > 0 ) {
			for (var d = 0; d < lmdfDecisionTree1.input[i].dependencies.length; d++) {      // Get list of dependent elements
				for (var k = 0; k < lmdfDecisionTree1.input.length; k++)
				// Looking for dependent elements in JSON structure to switch them on
				{
					if ( lmdfDecisionTree1.input[k].name == lmdfDecisionTree1.input[i].dependencies[d] ) {
                                       		lmdfDecisionTree1.input[k].on = true;			// Setting visibility of appropiate dependent elements
						// alert("Swithching on :" + lmdfDecisionTree1.input[k].name);   // debugging
					}
				}
			}
		}
		if (    lmdfDecisionTree1.input[i].value &&
			lmdfDecisionTree1.input[i].on &&   // addition 06.2015
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

	var lmdfXML = $.parseXML("<xml></xml>");					// Making an empty XML document

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
			$('[name="'+lmdfDependentInputName+'"]').css("display", "block"); // Make element visible by name (important for radio buttons and selectors
			if ( lmdfDecisionTree1.input[i].required ) {
				$(lmdfDependentInputID).addClass("required");	   		// Setting the required property for validation only in required
				$('[name="'+lmdfDependentInputName+'"]').addClass("required");
			}
			// $(lmdfDependentInputID).rules("add",{required : true});
		} else {
                        $(lmdfDependentInputID).css("display", "none");           // Make element invisible by ID
                        $(lmdfDependentInputClass).css("display", "none");        // Make element invisible by class (same as ID)
			$(lmdfDependentInputID).removeClass("required");          // Removing the required property in all invisible
			$('[name="'+lmdfDependentInputName+'"]').removeClass("required");
		}

////	Borradorr de código para repoblar los campos de formulario con valores (por el momento no funciona correctamente)
//               if ( lmdfDecisionTree1.input[i].value ) {                          
//			$('name='+lmdfDependentInputName+']').val(lmdfDecisionTree1.input[i].value);
//			if($('name='+lmdfDependentInputName+']').is('select') && lmdfDecisionTree1.input[i].selected) {
//				$("option",$('name='+lmdfDependentInputName+']')).each(function() {
//				        if (this.value==lmdfDecisionTree1.input[i].selected) { 
//						this.selected=true; 
//					}
//				}
//		        });
//		}

		if ( lmdfDecisionTree1.input[i].value &&                	// Checking if there are some value stored in JSON structure
			lmdfDecisionTree1.input[i].on ) {                       // Checking if element is visible
			var elem = lmdfXML.createElement(lmdfDecisionTree1.input[i].name);            // Including this element to XML
    			$(elem).text(lmdfDecisionTree1.input[i].value);
			var lmdfXMLelement = lmdfXML.getElementsByTagName("xml")[0];
    			lmdfXMLelement.appendChild(elem);
		}                      			
	}                                       	

	lmdf_xml_formed = xmlToString(lmdfXML);
	document.getElementById("jform_case_properties_xml").value = lmdf_xml_formed;
	document.getElementById("jform_case_properties_json").value = JSON.stringify(lmdfDecisionTree1);

//	alert(lmdf_xml_formed);
//	alert('#'+$(jform_case_properties_json).closest("form").attr('id'));
//	$('#'+$(jform_case_properties_json).closest("form").attr('id')).validate({})

	
}
})(jQuery);

(function ($) {
	$(document).on('keypress change input keyup click', 'input[name^="lmdf"]', function() {     		// Detecting input from one of the form elements
		var lmdfDecisionTree1 = JSON.parse(document.getElementById("lmdfJSONoutside").value);
		var lmdfElementData = $(this).val();
		var lmdfElementName = $(this).attr('name');

		if ( $(this).attr('type') == 'checkbox' ) { 	// Checkbox requires speciel treatment
			if ( !$(this).is(':checked') ) {    
				lmdfElementData = "";
			} else {
				lmdfElementData = "on";
			}
		}


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
		var lmdfElementText = $("option:selected", this).text();
		var lmdfElementName = $(this).attr('name');
		
		// alert(lmdfElementData + ' : ' + lmdfElementText + ' : ' + lmdfElementName);

		for (var i = 0; i < lmdfDecisionTree1.input.length; i++)	{
			if ( lmdfDecisionTree1.input[i].name == lmdfElementName ) {
				if ( lmdfElementData ) {
					// Rendering data string for use in selector
					// lmdfDecisionTree1.input[i].value = lmdfElementText + " (" + lmdfElementData + ")";         // Set element value in JSON structure
					lmdfDecisionTree1.input[i].value = lmdfElementData;
					lmdfDecisionTree1.input[i].selected = lmdfElementData;
				}
			}			
		}
		document.getElementById("lmdfJSONoutside").value = JSON.stringify(lmdfDecisionTree1);     // Updating stored JSON string
		lmdfInit();
	});

	$(document).on('change', 'select[name ="lmdfSelectorRol"]', function() {     		// Detecting input from the Rol selector
		var lmdfElementData = $(this).val();
		var lmdfElementText = $("option:selected", this).text();
		var lmdfElementName = $(this).attr('name');
		
		// alert(lmdfElementData + ' : ' + lmdfElementText + ' : ' + lmdfElementName);
		document.getElementById("jform_person_role").value = lmdfElementData;          // Updating the form value of person role field
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

$doc->addScriptDeclaration($lmdfJS1);
?>
