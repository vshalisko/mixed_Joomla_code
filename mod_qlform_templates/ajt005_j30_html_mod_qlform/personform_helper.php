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

// binding data from GET parameter (the same method can work for POST, as well as for specific value of GET[''])
$dataToBind=new stdClass;
if (isset($_GET)) foreach ($_GET as $k=>$v): 
	$dataToBind->$k=$v;
endforeach;
if (isset($_POST)) foreach ($_POST as $k=>$v): 
	$dataToBind->$k=$v;
endforeach;

// getting data frim Joomla to fill user related fields
$joomla_user = JFactory::getUser();
if (!$joomla_user->guest) {
	// user logged in
	$dataToBind->person_login = $joomla_user->username;
	$dataToBind->person_name = $joomla_user->name;
	$dataToBind->person_email = $joomla_user->email;

	// checking presence of already filled from in database and setting values from filled form in such a case
	if (1==$params->get('todoDatabaseExternal') AND 1==$checkDatabaseExternal)
	{
		$my_db1=JDatabaseDriver::getInstance($paramsDatabaseExternal);
	        $my_db1->setQuery('SELECT person_id, person_name, person_email, person_curp
			FROM persons WHERE person_login = '. $my_db1->quote($dataToBind->person_login));
		$my_db1->execute();
                if( $my_db1->getNumRows() > 0) {
			// the database already has record for this user login, so we should reuse this data in modification form
			$warning = '<H4>Usted ya cuenta con los datos personales previamente capturados.</H4>';
			require JModuleHelper::getLayoutPath('mod_qlform', 'dictamenform_alerts');

			$my_db1_result=$my_db1->loadObject();
			if (isset($my_db1_result->person_id)) $dataToBind->person_id = $my_db1_result->person_id;
			if (isset($my_db1_result->person_name)) $dataToBind->person_name = $my_db1_result->person_name;
			if (isset($my_db1_result->person_email)) $dataToBind->person_email = $my_db1_result->person_email;
			if (isset($my_db1_result->person_curp)) $dataToBind->person_curp = $my_db1_result->person_curp;
		}
	}


} else {
	$warning = '<H4>Forma no valida! Usted tiene que entrar al sistema para poder capturar los datos personales del promotor.</H4>';
	require JModuleHelper::getLayoutPath('mod_qlform', 'dictamenform_alerts');
}


/* Some ideas to implement here
// 1) Para el usuario quien ya anteriormente ha capturado datos debe existir la posibilidad de editarlos (CURP y Nombre),
//	pero no se puede capturar mas que una vez datos para el usuario con el mismo login
// 	Esto significa que la forma puede quedar prie-llenada con los datos en caso que ya existe un registro de este tipo, 
//	y al momento de apretar boton enviar los datos tiene que actualizarse la misma linea de tabla, pero no tiene que 
//	capturarse el nuevo registro. Sera necesario checar presencia de registro en tabla y definir comportamiento en funcion de esto.	
//
*/

$form->bind($dataToBind);

?>