<?php 
/**
 * @package		layout helper for mod_qlform Mareike Riegel
 * @copyright		Copyright (C) 2015 Viacheslav Shalisko. All rights reserved.
 * @author 		Viacheslav Shalisko vshalisko@gmail.com
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */


// no direct access
defined('_JEXEC') or die;
// echo "This is my hepler";
/* binding data from GET parameter (the same method can work for POST, as well as for specific value of GET['']) */

$dataToBind=new stdClass;
if (isset($_GET)) foreach ($_GET as $k=>$v): 
	$dataToBind->$k=$v;
endforeach;
if (isset($_POST)) foreach ($_POST as $k=>$v): 
	$dataToBind->$k=$v;
endforeach;

// taking values from parcel database to fill some fields in table with data
if (1==$params->get('todoDatabaseExternal') AND 1==$checkDatabaseExternal
	AND isset($dataToBind->parcel_map_id) AND isset($dataToBind->parcel_map_version_id))
{
	$my_db1=JDatabaseDriver::getInstance($paramsDatabaseExternal);
        $my_db1->setQuery('SELECT parcel_id, parcel_map_id, parcel_map_properties_xml 
		FROM parcels WHERE parcel_map_id = '. $my_db1->quote($dataToBind->parcel_map_id) .
		' AND parcel_map_version_id = ' . $my_db1->quote($dataToBind->parcel_map_version_id));
	$my_db1->execute();
        if( $my_db1->getNumRows() > 0) {
		$my_db1_result=$my_db1->loadObject();
		if (isset($my_db1_result->parcel_id)) $dataToBind->parcel_id = $my_db1_result->parcel_id;
		// in the next line we assign value of parcel_map_properties_xml to corresponding copy field in parcel_case table	
		if (isset($my_db1_result->parcel_map_properties_xml)) $dataToBind->case_parcel_properties_xml = $my_db1_result->parcel_map_properties_xml;
		}
}
// $temporal_identifier - the temporal solution 
$my_date = new DateTime();
$temporal_identifier = date('Ym') . '-' . $dataToBind->parcel_map_id . '-' . $dataToBind->parcel_id . '-' . $my_date->getTimestamp();
$dataToBind->system_case_identifier=$temporal_identifier;

echo '<div class="row-fluid">';

if (isset($dataToBind->case_parcel_properties_xml)) {
	echo '<div class="span6 source_parcel_properties" style="display: none;">';
	echo 'Datos del predio:<br />';
	// echo $dataToBind->case_parcel_properties_xml;  // raw output
	if($dataToBind->case_parcel_properties_xml) {    
		libxml_use_internal_errors(true);
		$xml_test = simplexml_load_string($dataToBind->case_parcel_properties_xml);
		if (!$xml_test) {
			$parcel_map_properties = new SimpleXMLElement('<xml />');
		} else {
			$parcel_map_properties = new SimpleXMLElement($dataToBind->case_parcel_properties_xml);
			echo (!empty($parcel_map_properties->nombre_2)) ? '<br />Nombre de polígono / zona: <b>' . $parcel_map_properties->nombre_2 . '</b>' : '';
			echo (!empty($parcel_map_properties->etique_e1)) ? '<br />Etiqueta plano desarrollo E1: <b>' . $parcel_map_properties->etique_e1 . '</b>' : '';
			echo (!empty($parcel_map_properties->etique_e2)) ? '<br />Etiqueta plano desarrollo E2: <b>' . $parcel_map_properties->etique_e2 . '</b>' : '';
			echo (!empty($parcel_map_properties->c_historic)) ? '<br />Pertenece al centro histórico: <b>' . $parcel_map_properties->c_historic . '</b>' : '<br />Pertenece al centro histórico: <b>NO</b>';
			echo (!empty($parcel_map_properties->etkt_ri)) ? '<br />Restricciones asociadas: <b>' . $parcel_map_properties->etkt_ri . '</b>' : '';
			echo (!empty($parcel_map_properties->riesgo)) ? '<br />Riesgo: <b>' . $parcel_map_properties->riesgo . '</b>' : '';
			echo (!empty($parcel_map_properties->area_ha)) ? '<br />Área polígono de gestión (ha): <b>' . $parcel_map_properties->area_ha . '</b>' : '';
			echo (!empty($parcel_map_properties->perim_m)) ? '<br />Perímetro polígono de gestión (m): <b>' . $parcel_map_properties->perim_m . '</b>' : '';
		}
	}


	echo '</div>';
} else {
	$warning = '<H4>Forma no valida! El predio con las caracteristicas especificados no fue encontrado en sistema.</H4>';
	require JModuleHelper::getLayoutPath('mod_qlform', 'dictamenform_alerts');
}

// getting data from Joomla to fill user related fields
$joomla_user = JFactory::getUser();
if (!$joomla_user->guest) {
	// user logged in
	$dataToBind->person_login = $joomla_user->username;

	// checking presence of user personal data in database and setting values from filled form in such a case
	if (1==$params->get('todoDatabaseExternal') AND 1==$checkDatabaseExternal)
	{
		$my_db1=JDatabaseDriver::getInstance($paramsDatabaseExternal);
	        $my_db1->setQuery('SELECT person_id, person_name, person_email, person_curp
			FROM persons WHERE person_login = '. $my_db1->quote($dataToBind->person_login));
		$my_db1->execute();
                if( $my_db1->getNumRows() > 0) {
			// the database do has record for this user login
			$my_db1_result=$my_db1->loadObject();
			if (isset($my_db1_result->person_id)) $dataToBind->person_id = $my_db1_result->person_id;
			if (isset($my_db1_result->person_name)) $dataToBind->person_name = $my_db1_result->person_name;
			if (isset($my_db1_result->person_email)) $dataToBind->person_email = $my_db1_result->person_email;
			if (isset($my_db1_result->person_curp)) $dataToBind->person_curp = $my_db1_result->person_curp;
		}
	}
} else {
	$warning = '<H4>Forma no valida! Usted tiene que entrar al sistema para iniciar el tramite.</H4>';
	require JModuleHelper::getLayoutPath('mod_qlform', 'dictamenform_alerts');
}

if (isset($dataToBind->person_name)) {
	echo '<div class="span6 source_user_properties" style="display: none;">';
	echo 'Nombre del solicitante: ';
	echo '<b>'.$dataToBind->person_name.'</b>';
	echo '<br />CURP del solicitante: ';
	echo '<b>'.$dataToBind->person_curp.'</b>';
	echo '<br />Correo electrónico del solicitante: ';
	echo '<b>'.$dataToBind->person_email.'</b>';
	echo '';
	echo '</div>';
} else {
	$warning = '<H4>Forma no valida! Usted debe tener registrados sus datos personales.</H4>';
	require JModuleHelper::getLayoutPath('mod_qlform', 'dictamenform_alerts');
}

echo '</div><p><span class="badge">1</span> Especifica rol del solicitante:</p>';

$form->bind($dataToBind);

?>



