<?php
/**
 * Template for LMU module
 * @package		mod_lmu1
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

require JModuleHelper::getLayoutPath('mod_slava_1', 'javascripttree');  // se carga arbol de decición de otro modulo

?>

<h4>Detalles del tramite <?php echo $dataGeneral->case_list->rows[0]->official_case_identifier ?></h4>

<table class="table table-condensed">
<thead>
	<tr><th>Variable</th><th>Contenido</th></tr>
</thead>
<tbody>
<tr><td>Folio de tramite</td><td><?php echo $dataGeneral->case_details->rows[0]->official_case_identifier ?></td></tr>
<tr><td>ID de tramite</td><td><?php echo $dataGeneral->case_details->rows[0]->case_id ?></td></tr>
<tr><td>ID de parcela en mapa</td><td><?php echo $dataGeneral->case_details->rows[0]->parcel_id ?></td></tr>
<tr><td>Tramites antecesores</td><td><?php echo $dataGeneral->case_details->rows[0]->nested_case_id ?></td></tr>
<tr><td>Fecha de inicio</td><td><?php echo $dataGeneral->case_details->rows[0]->open_date_time ?></td></tr>
<tr><td>Rol de solicitante</td><td><?php echo $dataGeneral->case_details->rows[0]->person_role ?></td></tr>
<tr><td>Nombre de solicitante</td><td><?php echo $dataGeneral->case_details->rows[0]->person_name ?></td></tr>
<tr><td>Detelles del predio (XML)</td><td><?php echo $dataGeneral->case_details->rows[0]->case_parcel_properties_xml ?></td></tr>
<tr><td>Detalles de tramite (XML)</td><td><span id="insert_XML1"></span></td></tr>
<tr><td>Número de deciciones</td><td><?php echo $dataGeneral->case_details->rows[0]->decisions_count ?></td></tr>
</tbody>
</table>

<script type="text/javascript">
// Parsing XML from the output & inserting in the desired place
// alert(xmlParser("<?php echo $dataGeneral->case_details->rows[0]->case_properties_xml ?>"));
$("#insert_XML1").append(xmlParser("<?php echo $dataGeneral->case_details->rows[0]->case_properties_xml ?>")).html();
</script>

<!--
<pre>
<?php echo $dataGeneral->case_details->string ?>
</pre>
-->