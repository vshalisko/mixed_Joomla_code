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

$names_array = array(
	"lmdfInputL1" => "I. Construcción de inmuebles",
	"lmdfInputL2" => "II. Construcción albercas",
	"lmdfInputL3" => "III. Construcción canchas/áreas deportivas",
	"lmdfInputL4" => "IV. Construcción estacionamientos para usos no-habitacionales",
	"lmdfInputL5" => "V. Demolición",
	"lmdfInputL6" => "VI. Acotamiento",
	"lmdfInputL7" => "VII. Instalación de tapiales provisionales en la via pública",
	"lmdfInputL8" => "VIII. Remodelación o restauración",
	"lmdfInputL9" => "IX. Reconstrucción, reestructuración o adaptación",
	"lmdfInputL10" => "X. Ocupación de la vía pública con materiales de construcción",
	"lmdfInputL11" => "XI. Ocupación de la vía pública por puestos, carpas, módulos, etcétera provisionales",
	"lmdfInputL12" => "XII. Movimientos de tierra",
	"lmdfInputL13" => "XIII. Provisional de construcción",
	"lmdfInputL14" => "XIV. Construcción de plataformas, patios de maniobra y rampas",
	"lmdfInputL15" => "XV. Similar de tipo no previsto",
	"lmdfInputA1"  => "Tramite de alineamiento",
	"lmdfInputA2"  => "Tramite de designación del número oficial",
	"lmdfInputA3"  => "Solicitud de inspección",
	"lmdfInputA4"  => "Otro tramite no previsto"
 	);


// XML parsing to get case information
if($row->case_properties_xml) {    
	libxml_use_internal_errors(true);
	$xml_test = simplexml_load_string($row->case_properties_xml);
	if (!$xml_test) {
		// there is some problem with xml string so returning empty object
		$case_properties = new SimpleXMLElement('<xml />');
	} else {
		// the xml string is ok
		$case_properties = new SimpleXMLElement($row->case_properties_xml);
	}
} else {
	// no xml sting available, so returning an empty object
	$case_properties = new SimpleXMLElement('<xml />');
}

$case_group = $case_properties->lmdfSelector0;
$case_dictamen = $case_properties->lmdfSelectorTD;
if ('usos y destinos' == $case_dictamen) { echo 'Dictamen de usos y destinos<br />'; };
if ('trazos usos y destinos' == $case_dictamen) { echo 'Dictamen de trazo, usos y destinos<br />'; };
if ('Grupo 2 Trazo' == $case_group & !$case_dictamen) { echo 'Dictamen<br />'; };
if ('Grupo 3 Licencia' == $case_group) { 
	$A_string = '';
	for ( $i=1; $i<=4; $i++) {
		$option_name = "\$case_properties->lmdfInputA" . $i;
		$option_status = eval( "return ". $option_name . ";" );
		if ( 'on' == $option_status ) {
			// echo " tipo " . $i;
			$A_string .= $names_array["lmdfInputA".$i].'<br />';
		}
	};
	if ( $A_string ) {
		echo '' . $A_string;
	}
	$L_string = '';
	for ( $i=1; $i<=15; $i++) {
		$option_name = "\$case_properties->lmdfInputL" . $i;
		$option_status = eval( "return ". $option_name . ";" );
		if ( 'on' == $option_status ) {
			// echo " tipo " . $i;
			 $L_string .= $names_array["lmdfInputL".$i].'<br />';
		}
	};
	if ( $L_string ) {
		echo '<em>Licencias:</em><br />' . $L_string;
	}
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