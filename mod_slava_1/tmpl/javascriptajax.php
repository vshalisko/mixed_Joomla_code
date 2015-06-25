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
		var value   = $('input[name=ajax1data]').val();
			request = {
					'option' : 	'com_ajax',
					'module' : 	'slava_1',
					'variable1' : 	value,  		
					'variable2' : 	'3',                     // can be numeric only, the cartpgraphy version
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
				var p = 'sin datos'; // dafault value
				if (r.rows[0].parcel_map_id) {   // we have parcel_map_id, so can form a button
					s = '</ br><form action="paso2" method="post">' +
						'<input type="hidden" id="parcel_map_version_id" name="parcel_map_version_id" value="3" />' +
						'<input type="hidden" id="parcel_map_id" name="parcel_map_id" value="' + r.rows[0].parcel_map_id +
						'" /><input type="submit" class="btn btn-large btn-primary" value="Iniciar tramite" /></form>';
					
				}
				if (r.rows[0].parcel_map_properties_xml) {
					var parcel_map_properties_xml = r.rows[0].parcel_map_properties_xml;
					xmlDoc = $.parseXML( parcel_map_properties_xml );
					var xmlObj = $( xmlDoc );
					
					var nombreText = '';
					if ( xmlObj.find("nombre_2").text() ) {
						nombreText = '<br />Nombre de polígono / zona: <br /><b>' + xmlObj.find("nombre_2").text() + '</b>';
					}
					var claveText = '';
					if ( xmlObj.find("clave").text() || xmlObj.find("t_area").text() ) {
						claveText = '<br />Tipo de área (E1): <br /><b>';
						if ( xmlObj.find("t_area").text() ) {
						 	claveText = claveText + xmlObj.find("t_area").text() + ' (' + xmlObj.find("clave").text() + ')</b>';
						} else {
							claveText = claveText + xmlObj.find("clave").text() + '</b>';
						}
					}
					var subclaveText = '';
					if ( xmlObj.find("sub_clave").text() || xmlObj.find("p_area").text() ) {
						subclaveText = '<br />Subtipo de area (E1): </br><b>';
						if ( xmlObj.find("p_area").text() ) {
						 	subclaveText = subclaveText + xmlObj.find("p_area").text() + ' (' + xmlObj.find("sub_clave").text() + ')</b>';
						} else {
							subclaveText = claveText + xmlObj.find("sub_clave").text() + '</b>';
						}
					}
					var etiquee1Text = '';
					if ( xmlObj.find("etique_e1").text() ) {
						etiquee1Text = '<br />Etiqueta plano desarrollo E1: <br /><b>' + xmlObj.find("etique_e1").text() + '</b>';
					}
					var clave2Text = '';
					if ( xmlObj.find("clave_2").text() || xmlObj.find("t_uso").text() ) {
						clave2Text = '<br />Tipo de uso (E2): <br /><b>';
						if ( xmlObj.find("t_uso").text() ) {
						 	clave2Text = clave2Text + xmlObj.find("t_uso").text() + ' (' + xmlObj.find("clave_2").text() + ')</b>';
						} else {
							clave2Text = clave2Text + xmlObj.find("clave_2").text() + '</b>';
						}
					}
					var densidadText = '';
					if ( (xmlObj.find("densidad").text() && !(xmlObj.find("densidad").text() == '.')) || xmlObj.find("d_uso").text() ) {
						densidadText = '<br />Densidad (E2): <br /><b>';
						if ( xmlObj.find("d_uso").text() ) {
						 	densidadText = densidadText + xmlObj.find("d_uso").text() + ' (' + xmlObj.find("densidad").text() + ')</b>';
						} else {
							densidadText = densidadText + xmlObj.find("densidad").text() + '</b>';
						}
					}
					var tipoText = '';
					if ( xmlObj.find("tipo_h").text() || xmlObj.find("h_tipo").text() ) {
						tipoText = '<br />Modalidad habitacional (E2): <br /><b>';
						if ( xmlObj.find("h_tipo").text() ) {
						 	tipoText = tipoText + xmlObj.find("h_tipo").text() + ' (' + xmlObj.find("tipo_h").text() + ')</b>';
						} else {
							tipoText = tipoText + xmlObj.find("tipo_h").text() + '</b>';
						}
					}
					var etiquee2Text = '';
					if ( xmlObj.find("etique_e2").text() ) {
						etiquee2Text = '<br />Etiqueta plano desarrollo E2: <br /><b>' + xmlObj.find("etique_e2").text() + '</b>';
					}
					var centroText = '';
					if ( xmlObj.find("c_historic").text() ) {
						centroText = '<br />Pertenece al centro histórico: <br /><b>' + xmlObj.find("c_historic").text() + '</b>';
					} else {
						centroText = '<br />Pertenece al centro histórico: <br /><b>NO</b>';
					}
					var restrictText = '';
					if ( xmlObj.find("etkt_ri").text() ) {
						restrictText = '<br />Restricciones asociadas: <br /><b>' + xmlObj.find("etkt_ri").text() + '</b>';
					} 
					var riesgoText = '';
					if ( xmlObj.find("riesgo").text() ) {
						restrictText = '<br />Riesgo: <br /><b>' + xmlObj.find("riesgo").text() + '</b>';
					}

					var areahaText = '<br />Área polígono de gestión (ha): <br /><b>' + xmlObj.find("area_ha").text() + '</b>';
					var perimhaText = '<br />Perímetro polígono de gestión (m): <br /><b>' + xmlObj.find("perim_m").text() + '</b>';

					p = nombreText + claveText + subclaveText + etiquee1Text + clave2Text + densidadText + tipoText + 
						etiquee2Text + centroText + restrictText + riesgoText + areahaText + perimhaText;
				}
				$('.ajax1result').html( '<div>' + p + '</div><div>&nbsp;</div><div>' + s + '</div>');  
                                // $('.ajax1result').html(parcel_map_properties_xml + s); // raw output
			}
		});
		return false;
	});
})(jQuery);
JS;

$doc->addScriptDeclaration($js);

?>
