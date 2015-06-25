<?php
/**
 * Helper class for LMU module
 * @package		mod_lmu1
 * @copyright		Copyright (C) 2015 Viacheslav Shalisko. All rights reserved.
 * @author 		Viacheslav Shalisko vshalisko@gmail.com
 * @license        GNU/GPL, see LICENSE.php
 * mod_lmu1 is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */
class modLMUHelper
{
    /**
     * @param array $params An object containing the module parameters
     * @access public
     */    

    public static function getDBinstance ( )
    {
	// get and parse module parameters (for database connection)
	jimport( 'joomla.application.module.helper' );
	$my_params = JModuleHelper::getModule( 'mod_lmu1' );
	$my_params_data = explode(",",str_replace("\"","",substr($my_params->params,1,-1)));
	$my_params_array = array();
	foreach ($my_params_data as $pair) {
	    list($key,$value) = explode(':',$pair);
	    $my_params_array[$key]=$value;
	};

	$option = array();
        $option['driver']   = $my_params_array['databaseexternaldriver'];            	// Database driver name
	$option['host']     = $my_params_array['databaseexternalhost'];    		// Database host name
	$option['user']     = $my_params_array['databaseexternaluser'];  		// User for database authentication
	$option['password'] = $my_params_array['databaseexternalpassword'];   		// Password for database authentication
	$option['database'] = $my_params_array['databaseexternaldatabase'];      	// Database name
	$option['prefix']   = $my_params_array['databaseexternalprefix'];             	// Database prefix (may be empty)
 
	// Obtain a database connection
	$my_db = JDatabaseDriver::getInstance( $option );
	return $my_db;
    }

    public static function getSQLQuery01( $data, $base_sql )
    {
	$my_db = modLMUHelper::getDBinstance();
	if ($data) {
		$quoted_data = $my_db->quote( $data );
		$query = $base_sql . $quoted_data ;
	} else {
		$query = $base_sql;
	}
	// Prepare the query
	$my_db->setQuery($query);
	$my_db->execute();
	// Load the results as a list of stdClass objects
        $rows = $my_db->loadObjectList();
	return $rows;
    }

    public static function getSQLInsert ( $sql )
    {
	$my_db = modLMUHelper::getDBinstance();
	// Prepare the query
	$my_db->setQuery($sql);
	// Load the results as a list of stdClass objects
	$my_db->execute();
	return $my_db->insertid();
    }

    public static function getSQLDelete ( $sql )
    {
	$my_db = modLMUHelper::getDBinstance();
	// Prepare the query
	$my_db->setQuery($sql);
	// Load the results as a list of stdClass objects
	$res = $my_db->execute();
	if($res)
	{
		$affectedRows = $my_db->getAffectedRows($res);
		return $affectedRows;
	} else {
		return 0;
	}
    }


    public static function requestUserInfo( $condition )
    {
        $base_sql = "SELECT * FROM persons WHERE person_login = ";
	$obj = new stdClass;
	$obj->rows = modLMUHelper::getSQLQuery01( $condition, $base_sql );
	$result = "";
	// Retrieve each value in the ObjectList 
 	foreach( $obj->rows as $row ) { 
		$result .= "Person_id: " . $row->person_id . ", ";
		$result .= "Person_login: " . $row->person_login . ", ";
		$result .= "Person_name: " . $row->person_name . ", ";
		$result .= "Person_CURP: " . $row->person_curp . ", ";
		$result .= "</br>";
	 } 
	$obj->string = $result;
	return $obj;
    }


    public static function requestCasesTable( $condition )
    {
//        $base_sql = "SELECT * FROM persons LEFT JOIN parcel_cases ON parcel_cases.person_id = persons.person_id
//			WHERE parcel_cases.parcel_case_id IS NOT NULL AND persons.person_id = ";

	$base_sql = "SELECT *, parcel_cases.parcel_case_id AS case_id, COUNT(case_decisions.case_decision_id) AS decisions_count,
			DATE_FORMAT(parcel_cases.open_date_time, '%d-%m-%Y') AS open_date_time_format
			FROM persons LEFT JOIN parcel_cases ON parcel_cases.person_id = persons.person_id
			LEFT JOIN case_decisions ON case_decisions.parcel_case_id <=> parcel_cases.parcel_case_id
			WHERE persons.person_id = ". $condition ." GROUP BY case_id
			ORDER BY parcel_cases.open_date_time DESC"; 
	$obj = new stdClass;
	$obj->rows = modLMUHelper::getSQLQuery01( '', $base_sql );
	$result = "";
	// Retrieve each value in the ObjectList 
 	foreach( $obj->rows as $row ) { 
		$result .= "Tramite (Case ID): " . $row->parcel_case_id . ", ";
		$result .= "Fecha de inicio: " . $row->open_date_time . ", ";
		$result .= "Promotor: " . $row->person_name . ", ";
		$result .= "</br>";
	 } 
	$obj->string = $result;
	return $obj;
    }

    public static function requestResolutionsTable( $condition )
    {
//        $base_sql = "SELECT * FROM persons LEFT JOIN parcel_cases ON parcel_cases.person_id = persons.person_id
//			WHERE parcel_cases.parcel_case_id IS NOT NULL AND persons.person_id = ";

	$base_sql = "SELECT *, 
			DATE_FORMAT(case_decisions.decision_modification_date_time, '%d-%m-%Y') 
			AS decision_modification_date_time_format
			FROM case_decisions WHERE case_decisions.parcel_case_id = ". $condition ."
			ORDER BY case_decisions.decision_modification_date_time DESC"; 
	$obj = new stdClass;
	$obj->rows = modLMUHelper::getSQLQuery01( '', $base_sql );
	$result = "";
	// Retrieve each value in the ObjectList 
 	foreach( $obj->rows as $row ) { 
		$result .= "Tramite (Case ID): " . $row->parcel_case_id . ", ";
		$result .= "Fecha de resolución: " . $row->decision_modification_date_time . ", ";
		$result .= "Contenido: " . $row->decision_contents . ", ";
		$result .= "Estatus: " . $row->decision_status . ", ";
		$result .= "</br>";
	 } 
	$obj->string = $result;
	return $obj;
    }


    public static function requestCaseDetails( $condition1, $condition2 )
    {
        $base_sql = "SELECT *, parcel_cases.parcel_case_id AS case_id, COUNT(case_decisions.case_decision_id) AS decisions_count 
			FROM persons LEFT JOIN parcel_cases ON parcel_cases.person_id = persons.person_id
			LEFT JOIN case_decisions ON case_decisions.parcel_case_id <=> parcel_cases.parcel_case_id
			WHERE persons.person_id = ". $condition1 ." 
			AND case_decisions.decision_status = 'vigente'
			AND case_decisions.officer_id != 1
			AND parcel_cases.parcel_case_id = ";
	$obj1 = new stdClass;
	$obj1->rows = modLMUHelper::getSQLQuery01( $condition2, $base_sql );
	$result = "";
	// Retrieve each value in the ObjectList 
 	foreach( $obj1->rows as $row ) { 
		$result .= "ID de tramite: " . $row->parcel_case_id . ", ";
		$result .= "Fecha de inicio: " . $row->open_date_time . ", ";
		$result .= "Promotor: " . $row->person_name . ", ";
		$result .= "Resoluciones: " . $row->decisions_count . ", ";
		$result .= "</br>";
	 } 
	$obj1->string = $result;
	return $obj1;
    }

    public static function requestCaseLastStatus( $condition1 )
    {
        $base_sql = "SELECT * FROM case_decisions 
			WHERE case_decisions.decision_status = 'vigente'
			AND case_decisions.officer_id != 1
			AND ( decision_type = 'dictamen' OR decision_type = 'aviso' OR decision_type = 'resolución')
			AND parcel_case_id = " . $condition1 . " ORDER BY decision_modification_date_time DESC LIMIT 1";
	$obj1 = new stdClass;
	$obj1->rows = modLMUHelper::getSQLQuery01( '', $base_sql );
	$result = "";
	// Retrieve each value in the ObjectList 
 	foreach( $obj1->rows as $row ) { 
		$result .= "Status: " . $row->decision_status;
		$result .= "</br>";
	 } 
	$obj1->string = $result;
	return $obj1;
    }


    public static function requestCaseLastID( $person_id )
    {
        $base_sql = 'SELECT parcel_case_id, system_case_identifier, official_case_identifier, case_properties_json FROM parcel_cases
			WHERE person_id = ' .	$person_id . ' ORDER BY open_date_time DESC LIMIT 1';
	$obj1 = new stdClass;
	$obj1->rows = modLMUHelper::getSQLQuery01( '', $base_sql );
	$result = "";
	// Retrieve each value in the ObjectList 
 	foreach( $obj1->rows as $row ) { 
		$result .= "ID de tramite: " . $row->parcel_case_id;
		$result .= "</br>";
	 } 
	$obj1->string = $result;
	return $obj1;
    }                                             


    public static function submitNewCaseForResolution( $parcel_case_id )
    {
        // step 1: check if case was already accepted for revision
	$search_sql = 'SELECT COUNT(*) AS count FROM case_decisions WHERE decision_status = "vigente" 
			AND decision_content = "aceptado para revisión" AND parcel_case_id = ';
	$obj = new stdClass;
	$obj->rows = modLMUHelper::getSQLQuery01( $parcel_case_id, $search_sql );
	if(isset($obj->rows[0]->count) && $obj->rows[0]->count) {
		// the case was already acepted, no need to insert another resolution
		return 1;
	} else {	
	        $base_sql = 'INSERT INTO case_decisions VALUES (NULL,'. $parcel_case_id .',1,"aceptado para revisión","vigente",NULL,NOW(),"mensaje de sistema")';
		$obj1 = new stdClass;
		$obj1->rows = modLMUHelper::getSQLQuery01( '', $base_sql );
		return $obj1;
	}
    }


}

// The class name should be strictly the same as module helper name without spaces
class modLmu1Helper
{
     // method getAjax() is the main method, can not be ommited
    public static function getAjax()
    {
	// Function to precess Ajax submitted data and return Ajax output
	// Getting input data
	$input = JFactory::getApplication()->input;
	$data  = $input->get('data');    // the data variable is useful in case of the simple request of the list of decicions for case
	$variable_doctype = $input->get('variable_doctype');  // getting the document type as it defined in LMDF
	$variable_doc_description = urldecode($input->get('variable_doc_description','','string'));  // the urldecode is necessary to get the correct string as it can contain spaces and non ASCII
	$parcel_case_id = $input->get('parcel_case_id');
	$mode  = $input->get('ajax_mode');


	if ('file_submit' == $mode) {
		$result = "";
		$errorlog = "";

		// file processing
		jimport('joomla.filesystem.file');
		jimport( 'joomla.filesystem.folder' );
		$files = $input->files->get('variable_file');
		if ($files['error']!="0") {
			$errorlog .= "\nError al subir el archivo";
             	} else {
		        $tempName = $files['tmp_name'];
	             	$type = $files['type'];
			$size = $files['size'];
			$name = JFile::makeSafe($files['name']);  // 'safe' filename
			$extension = JFile::getExt($files['name']);  // file extension
			$tempFullPath = ini_get('upload_tmp_dir').$tempName;
			$destination_folder = JPATH_SITE . "/" . "uploaded_documents";
			$file_properties_xml = "<xml><fileName>".$name."</fileName><fileType>".
					$type."</fileType><fileSize>".$size."</fileSize><fileDescription>".
					$variable_doc_description."</fileDescription></xml>";

			// generating file name string (3 components: 1) joomla username, 2) timestamp, 3) random 3 symbol alphanumeric string)
			$my_date = new DateTime();
			$timestamp = $my_date->getTimestamp();
                        $random = substr( md5(rand()), 0, 3);
			$joomla_user = JFactory::getUser();
    			$safe_username = preg_replace("/[^a-zA-Z0-9]+/", "", $joomla_user->username);
			$destination_filename = $safe_username . $timestamp . $random .'.'. $extension;
			$destinationFullPath = $destination_folder . "/" . $destination_filename;

			if (JFile::exists($tempFullPath)) {
				// Create the folder if not exists in images folder
				if ( !JFolder::exists( $destination_folder ) ) {
					JFolder::create( $destination_folder, 0755 );
				} 
				// The second check to ensure that the festination folder is OK
				if ( !JFolder::exists( $destination_folder ) ) { 
					$errorlog .= "\nError al crear la carpeta de destino";
				} else {
					// Move the temporal file to the destination folder
					JFile::upload( $tempFullPath,  $destinationFullPath );
				}
				// Check if the file move was successfull
				if ( !JFile::exists( $destinationFullPath ) ) { 
					$errorlog .= "\nError al mover el archivo enviado a la carpeta";
				} else {
					$result .= "\nExito al subir el archivo";
				}
			} else {
				$errorlog .= "\nError: no fue encontrado el archivo temporal";
			}
	                // $result_dump = print_r($files, true);
			// $result .= "\n<br /> Dump: " . $result_dump;
		}

		if (!$errorlog) {
			// no error detected in file processing, so generating a database record (INSERT)
			$my_db1 = modLMUHelper::getDBinstance();
		        $base_sql = 'INSERT INTO case_documents VALUES (NULL,'.$my_db1->quote($parcel_case_id).','.$my_db1->quote($variable_doctype);
			$base_sql .= ','.$my_db1->quote($destinationFullPath).','.$my_db1->quote($file_properties_xml).',NOW());'; 
			$insert_id = modLMUHelper::getSQLInsert($base_sql);
			if( !$insert_id ) {
				$errorlog .= "\nRegistro en DB no fue exitoso";
			} else {
				$result .= "\nExito al generar registro en DB";
			}
		}
		$obj = new stdClass;
		$obj->insertId = $insert_id;	// the ID of new database record
		$obj->string = $result;		// the result messages
		$obj->errorlog = $errorlog;	// the error message (if any)
                return json_encode($obj);
	}

	if ('file_delete' == $mode) {
		$result = "";
		$errorlog = "";
		$parcel_case_id = $input->get('parcel_case_id');
		$case_document_id = $input->get('case_document_id');
		$my_db1 = modLMUHelper::getDBinstance();
			$user_test_sql = 'SELECT person_login FROM persons WHERE person_id = (SELECT person_id FROM parcel_cases WHERE parcel_case_id = '.$my_db1->quote($parcel_case_id).' LIMIT 1)';
			$rowsuser = modLMUHelper::getSQLQuery01( '', $user_test_sql ); // checking if the user who created the parcel_case is the same as who is trying to delete the document
			$joomla_user = JFactory::getUser();
			if (isset($rowsuser[0]->person_login) && ($rowsuser[0]->person_login == $joomla_user->username)) {
				$result .= "\nUsuario autorizado";
				$test_sql = 'SELECT COUNT(*) AS count FROM case_documents WHERE parcel_case_id = '.$my_db1->quote($parcel_case_id).' AND case_document_id = '.$my_db1->quote($case_document_id);
				$rows = modLMUHelper::getSQLQuery01( '', $test_sql ); // checking if there are only one record to be deleted
				if (isset($rows[0]->count) && ($rows[0]->count == 1)) {
			        	$base_sql = 'DELETE FROM case_documents WHERE parcel_case_id = '.$my_db1->quote($parcel_case_id).' AND case_document_id = '.$my_db1->quote($case_document_id);
					$affected_rows = modLMUHelper::getSQLDelete($base_sql);
					if( $affected_rows ) {
						$result .= "\nRegistro de ".$affected_rows." documento en DB fue eliminado";
					} else {
						$errorlog .= "\nProblema al eliminar 1 registro de documento en DB, registro no fue eliminado";
					}
				} else {
					$errorlog .= "\nProblema al eliminar registro de documento en DB (número incorrecto de registros marcado)";
				}
			} else {
				$errorlog .= "\nUsuario no autorizado eliminar documento";
			}
		$obj = new stdClass;
		$obj->string = $result;		// the result messages
		$obj->errorlog = $errorlog;	// the error message (if any)
                return json_encode($obj);
	}
//	} else {
//		// Preparing and executing database request
//        	$base_sql = "SELECT * FROM list_of_decisions_for_case WHERE decision_content IS NOT NULL AND parcel_case_id = ";
//		$rows = modLMUHelper::getSQLQuery01( $data, $base_sql );
//
//		$result = "";
//		if( !$rows ) {
//			$result = "<br />Tramite aun sin deciciones</br>";;
//		}
//		// Retrieve each value in the ObjectList 
//		foreach( $rows as $row ) { 
//		$result .= "<br />";
//		$result .= "Case ID: " . $row->parcel_case_id . ", ";
//		$result .= "Fecha de inicio: " . $row->open_date_time . ", ";
//		$result .= "Decisión/Resolución: " . $row->decision_content . ", ";
//		$result .= "Estatus de decición: " . $row->decision_status . ", ";
//		$result .= "Fecha de decición: " . $row->decision_modification_date_time . ", ";
//		$result .= "Ejecutivo: " . $row->officer_name . ", ";
//		$result .= "Organismo: " . $row->officer_affiliation . ", ";
//		$result .= "<br />";
//	 	} 
//		return 'Resultados de consulta por medio de Ajax: ' . $result;
//	}
	JFactory::getApplication()->close(); // Ensure getApplication termination
    }
}
?>