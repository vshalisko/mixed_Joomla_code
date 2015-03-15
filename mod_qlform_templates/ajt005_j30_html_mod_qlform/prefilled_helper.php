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

/* taking values from database to fill some fields in table with data from database (external) */
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
		// in the next line we assign value of parcel_map_properties_xml to cerresponding copy field in parcel_case table	
		if (isset($my_db1_result->parcel_map_properties_xml)) $dataToBind->case_parcel_properties_xml = $my_db1_result->parcel_map_properties_xml;			
		}
}
/* $temporal_identifier - the temporal solution */
$temporal_identifier = 'M' . $dataToBind->parcel_map_id . 'C' . $dataToBind->parcel_id . 'XXXXXXXX';
$dataToBind->official_case_identifier=$temporal_identifier;

echo '<pre>Datos del predio:';
echo $dataToBind->case_parcel_properties_xml;
echo '</pre>';

$form->bind($dataToBind);

/* 

$joomla_user = JFactory::getUser();
echo $joomla_user->guest;
echo $joomla_user->name;

        $my_db1=JFactory::getDbo($paramsDatabaseExternal);
$my_db = modQlformHelper::connectToDatabase($paramsDatabaseExternal);
	echo $paramsDatabaseExternal['user'];
	echo $module->id;


  echo $my_db->getDatabaseName();
$my_count = $my_db->setQuery('SELECT COUNT(*) FROM case_decisions'); 
	print "The external DB object is not empty";
	echo $params->get('databaseexternaltable');

*/

?>




