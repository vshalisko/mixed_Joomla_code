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
defined('_JEXEC') or die('Restricted access'); ?>

<tr>
<td><a href="index.php/tramite?parcel_case_id=<?php echo $row->case_id ?>">
<small><?php echo $row->system_case_identifier ?></small>
<?php echo $row->official_case_identifier ?>
</a></td>
<td><?php 

// XML parsing to get case information
$case_properties = new SimpleXMLElement($row->case_properties_xml);
$case_group = $case_properties->lmdfSelector0;
if ('Grupo 1 Usos' == $case_group) { echo 'Dictamen de usos y destinos <br />'; };
if ('Grupo 2 Trazo' == $case_group) { echo 'Dictamen de trazo, usos y destinos específicos <br />'; };
if ('Grupo 3 Licencia' == $case_group) { 
	echo '<em>Licencia:</em> <br />';
	foreach ( $case_properties->lmdfSelector1 as $option ) {
		echo $option .' <br />';
	};
};
if ('Grupo 4 Alineamiento' == $case_group) { 
	echo '<em>Otro tramite:</em> <br />';
	foreach ( $case_properties->lmdfSelector2 as $option ) {
		echo $option .' <br />';
	};
};

?></td>
<!--<td><?php echo $row->parcel_id ?></td>-->
<td><?php echo $row->person_role ?></td>
<td><?php echo $row->open_date_time_format ?></td>
<td>
<?php 
if ( isset($row->decisions_count) && ($row->decisions_count > 0) ) {
	if ( $row->decisions_count == 1 ) {
		echo '<small>' . $row->decisions_count . ' revision por ejecutivo </small>';
	} else {
		echo '<small>' . $row->decisions_count . ' revisiones por ejecutivo </small>';
	}

}
?>
<?php
$case_status = modLMUHelper::requestCaseLastStatus( $row->case_id );
if (isset($case_status->rows[0]->decision_type)) {
	echo ', estatus: <em><b>' . $case_status->rows[0]->decision_type . '</b></em>';
}
?></td>
<td><!-- Anexos --></td>
<td><!-- Descargables -->
<?php
if (isset($case_status->rows[0]->decision_type)) {
	echo '[d]';
}
?>
</td>
</tr>