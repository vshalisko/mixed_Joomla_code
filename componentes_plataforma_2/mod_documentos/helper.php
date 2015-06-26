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

//echo "Content-type: text/html; charset=utf-8\nCache-control: no-cache, must-revalidate\nPragma: no-cache\nExpires: Mon, 01 Jan 2007 01:00:00 GMT\n\n";


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

	JFactory::getApplication()->close(); // Ensure getApplication termination
    }
}
?>