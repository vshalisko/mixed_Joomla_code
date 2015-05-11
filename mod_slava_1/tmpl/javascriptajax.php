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
$js = <<<JS
(function ($) {
	$(document).on('click', 'input[name=ajax1button]', function () {
		var value   = $('input[name=ajax1data]').val(),
			request = {
					'option' : 	'com_ajax',
					'module' : 	'slava_1',
					'variable1' : 	value,  		
					'variable2' : 	'2',                     // can be numeric only
					'ajax_mode' : 	'parcel_info',					
					'format' : 	'json'
				};
		$.ajax({
			type   : 'POST',
			data   : request,
			success: function (response) {
				// var s = JSON.stringify(response.data); // debugging
				var r = JSON.parse(response.data);           
				// $('.ajax1result').html(r.string);   			// string output
				// $('.ajax1result').html(r.rows[0].parcel_map_id);   	// specific field output
				var s = '';
				if (r.rows[0].parcel_map_id) {
					s = '</ br><form action="paso2" method="post">';
					s = s + '<input type="hidden" id="parcel_map_version_id" name="parcel_map_version_id" value="2" />';
					s = s + '<input type="hidden" id="parcel_map_id" name="parcel_map_id" value="' + r.rows[0].parcel_map_id;
					s = s + '" /><input type="submit" class="btn btn-large btn-primary" value="Iniciar tramite" /></form>';
					
				}
				$('.ajax1result').html(r.rows[0].parcel_map_properties_xml + s);   

			}
		});
		return false;
	});
})(jQuery);
JS;

$doc->addScriptDeclaration($js);

?>
