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

// Ajax related JavaScript code, note the module name in request options
// NOTA! ESTE CODIGO ES SOLO DE PRUEBA; ACTUALMENTE javascriptajax1 no se utuliza
$js = <<<JS
(function ($) {
	$(document).on('click', 'input[name=ajax2button]', function () {
		var variable1   = $('input[name=ajax2data]').val();
			request = {
					'option' : 	'com_ajax',
					'module' : 	'slava_1',
					'variable1' : 	variable1,  		
					'ajax_mode' : 	'file_submit',					
					'format' : 	'json'
				};
		$.ajax({
			type   : 'POST',
			data   : request,
			success: function (response) {
				// var s = JSON.stringify(response.data); // debugging
				var r = JSON.parse(response.data);           
				$('.ajax2result').html(r.rows[0].parcel_map_properties_xml);   

			}
		});
		return false;
	});
})(jQuery);
JS;

$doc->addScriptDeclaration($js);

?>
