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

// getting data from Joomla to fill user related fields (user is officer)
$joomla_user = JFactory::getUser();
if (!$joomla_user->guest) {
	// user logged in
	$dataToBind->officer_login = $joomla_user->username;

	// checking presence of user personal data in database and setting values from filled form in such a case
	if (1==$params->get('todoDatabaseExternal') AND 1==$checkDatabaseExternal)
	{
		$my_db1=JDatabaseDriver::getInstance($paramsDatabaseExternal);
	        $my_db1->setQuery('SELECT officer_id, officer_name, officer_affiliation, officer_status
			FROM officers WHERE officer_status = \'autorized\' AND
			officer_login = '. $my_db1->quote($dataToBind->officer_login));
		$my_db1->execute();
                if( $my_db1->getNumRows() > 0) {
			// the officers table do has record for this user login ant it is autorized
			$my_db1_result=$my_db1->loadObject();
			if (isset($my_db1_result->officer_id)) $dataToBind->officer_id = $my_db1_result->officer_id;
			if (isset($my_db1_result->officer_name)) $dataToBind->officer_name = $my_db1_result->officer_name;
			if (isset($my_db1_result->officer_affiliation)) $dataToBind->officer_affiliation = $my_db1_result->officer_affiliation;
			if (isset($my_db1_result->officer_status)) $dataToBind->officer_status = $my_db1_result->officer_status;
		} else {
			// the officers table do not have autorized record for this user
			$warning = '<H4>Usted no esta autorizado para dictaminar el tramite!</H4>';
			require JModuleHelper::getLayoutPath('mod_qlform', 'dictamenform_alerts');
		}
	}
} else {
	$warning = '<H4>Usted tiene que entrar al sistema para dictaminar el tramite!</H4>';
	require JModuleHelper::getLayoutPath('mod_qlform', 'dictamenform_alerts');
}

if (isset($dataToBind->officer_name)) {
	echo '<pre>Nombre del ejecutivo: ';
	echo $dataToBind->officer_name;
	echo '<br />Afiliación del ejecutivo: ';
	echo $dataToBind->officer_affiliation;
	echo '<br />Estatus del ejecutivo: ';
	echo $dataToBind->officer_status;
	echo '</pre>';
}

$form->bind($dataToBind);
?>