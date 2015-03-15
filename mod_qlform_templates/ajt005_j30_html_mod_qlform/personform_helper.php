<?php 
/**
 * @package		layout helper for mod_qlform Mareike Riegel
 * @copyright		Copyright (C) 2015 Viacheslav Shalisko. All rights reserved.
 * @author 		Viacheslav Shalisko vshalisko@gmail.com
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */
// no direct access
defined('_JEXEC') or die;
echo "This is my hepler";
/* binding data from GET parameter (the same method can work for POST, as well as for specific value of GET['']) */
$dataToBind=new stdClass;
if (isset($_GET)) foreach ($_GET as $k=>$v): 
	$dataToBind->$k=$v;
endforeach;
if (isset($_POST)) foreach ($_POST as $k=>$v): 
	$dataToBind->$k=$v;
endforeach;

/* taking values from database to fill some fields in table with data from database (external) */
if (1==$params->get('todoDatabaseExternal') AND 1==$checkDatabaseExternal)
{
	$my_db1=JDatabaseDriver::getInstance($paramsDatabaseExternal);
        $my_db1->setQuery('SELECT parcel_id, parcel_map_id, parcel_map_properties_xml, 
		COUNT(*) AS `counting` FROM parcels WHERE parcel_id = \''.$dataToBind->parcel_id.'\'');
	$my_db1_result=$my_db1->loadObject();
/*
	if (!(bool)$my_db1) {
	    print "The DB object is empty";
	} else {
	    print "COUNTING:";
	    echo $my_db1_result->counting;
	}
*/
}
/* $temporal_identifier - folio de tremite temporal */
$temporal_identifier = 'MID' . $my_db1_result->parcel_map_id . 'C' . $my_db1_result->parcel_id . 'XXXXXXXX';
$dataToBind->official_case_identifier=$temporal_identifier;
$dataToBind->case_parcel_properties_xml=$my_db1_result->parcel_map_properties_xml;

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




