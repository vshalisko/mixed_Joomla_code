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


include '../connection/db_mysql_connection.php';
include '../functions/query_functions.php';
include '../functions/generic_functions.php';

date_default_timezone_set("Mexico/General");

// The class name should be strictly the same as module helper name without spaces

class modLmu1Helper
{
     // method getAjax() is the main method, can not be ommited
    public static function getAjax()
	// Function to precess Ajax submitted data and return Ajax output
    {
	$result = "";
	$errorlog = "";
	$insert_id = '';
	session_start();
//	echo $_SESSION["id_usuario"];
//	echo $_SESSION["nombre"];
//	echo $_SESSION["usuario"];


	/******MYSQL DATABASE CONECTION*****/
	try {
		$db_mysql_connection = new db_mysql_connection();
		$querys = new query_functions();
		// $functions= new generic_functions();
	} catch (DatabaseException $ex) {
		$errorlog .= "Problema de conección con la base de datos";
	}

	// Getting input data
	$variable_doctype = (isset($_POST['variable_doctype'])) ? $_POST['variable_doctype'] : '';
	$prevarible_doc_description = (isset($_POST['variable_doc_description'])) ? $_POST['variable_doc_description'] : '';
	$variable_doc_description = urldecode($prevarible_doc_description);  // the urldecode is necessary to get the correct string as it can contain spaces and non ASCII
	$parcel_case_id = (isset($_POST['parcel_case_id'])) ? $_POST['parcel_case_id'] : '';
	$case_document_id = (isset($_POST['case_document_id'])) ? $_POST['case_document_id'] : '';
	$mode = (isset($_POST['ajax_mode'])) ? $_POST['ajax_mode'] : '';
	$variable_user = (isset($_SESSION["usuario"])) ? $_SESSION["usuario"] : 'anonimo';

	if ('file_submit' == $mode) {

		// file processing
//		jimport('joomla.filesystem.file');
//		jimport( 'joomla.filesystem.folder' );
//		$files = $input->files->get('variable_file');
//		if ($files['error']!="0") {
//			$errorlog .= "\nError al subir el archivo";
//           	} else {
//		        $tempName = $files['tmp_name'];
//	             	$type = $files['type'];
//			$size = $files['size'];
//			$name = JFile::makeSafe($files['name']);  // 'safe' filename
//			$extension = JFile::getExt($files['name']);  // file extension
//			$tempFullPath = ini_get('upload_tmp_dir').$tempName;
//			$destination_folder = JPATH_SITE . "/" . "uploaded_documents";
			$destination_folder = "/" . "uploaded_documents";
//			$file_properties_xml = "<xml><fileName>".$name."</fileName><fileType>".
//					$type."</fileType><fileSize>".$size."</fileSize><fileDescription>".
//					$variable_doc_description."</fileDescription></xml>";
//
//			// generating file name string (3 components: 1) joomla username, 2) timestamp, 3) random 3 symbol alphanumeric string)
			$my_date = new DateTime();
			$timestamp = $my_date->getTimestamp();
	                $random = substr( md5(rand()), 0, 3);
  			$safe_username = preg_replace("/[^a-zA-Z0-9]+/", "", $variable_user);
//			$destination_filename = $safe_username . $timestamp . $random .'.'. $extension;
			$destination_filename = $safe_username . $timestamp . $random; 				// temporal
			$destination_full_path = $destination_folder . "/" . $destination_filename;

//			if (JFile::exists($tempFullPath)) {
				// Create the folder if not exists in images folder
//				if ( !JFolder::exists( $destination_folder ) ) {
//					JFolder::create( $destination_folder, 0755 );
//				} 
				// The second check to ensure that the festination folder is OK
//				if ( !JFolder::exists( $destination_folder ) ) { 
//					$errorlog .= "\nError al crear la carpeta de destino";
//				} else {
					// Move the temporal file to the destination folder
//					JFile::upload( $tempFullPath,  $destinationFullPath );
//				}
				// Check if the file move was successfull
//				if ( !JFile::exists( $destinationFullPath ) ) { 
//					$errorlog .= "\nError al mover el archivo enviado a la carpeta";
//				} else {
//					$result .= "\nExito al subir el archivo";
//				}
//			} else {
//				$errorlog .= "\nError: no fue encontrado el archivo temporal";
//			}
	                // $result_dump = print_r($files, true);
			// $result .= "\n<br /> Dump: " . $result_dump;
//		}

		if (!$errorlog) {
			// no error detected in file processing, so generating a database record (INSERT)
		        try {
        			$table_name = "case_documents";
				$args = 'parcel_case_id, document_type, document_url, document_properties_xml, document_date_time';
				$values = '"'.$parcel_case_id.'","'.$variable_doctype.'","'.$destination_full_path.'","<xml />",NOW()';
				$statement = 'parcel_case_id = "'.$parcel_case_id.'" AND document_url = "'.$destination_full_path.'"';
				// TODO Verification if the upload session user is the same as case promotor (making select from parcel_cases with parcel_case_id)

				$querys->insert($args,$values,
					$db_mysql_connection->getConnection(),$db_mysql_connection->getDBname(),$table_name);
				// $insert_id = mysql_insert_id(); // without insert success status the mysql_insert_id can be not reliable, 
				// so better do select with the same unique combinations of parameters (parcel_case_id and destination_full_path)

				$selection = $querys->select_elements_return_all_elements($db_mysql_connection->getConnection(),$db_mysql_connection->getDBname(),
					$table_name,$statement);
				
				if( $selection ) {
					$line_counter = 0;				
					while ($line = mysql_fetch_assoc($selection)) {
    						$insert_id = $line['case_document_id'];
						$line_counter = $line_counter + 1;
					}
					mysql_free_result($selection);
					if ($line_counter != 1) {
						$errorlog .= "\nProblemas al generar registro en DB";
					}
				}
			} catch (DatabaseException $ex) {
				$errorlog .= "\nProblemas al comunicar con DB";
			}

			if( !$insert_id || $errorlog  ) {
				$errorlog .= "\nRegistro en DB no fue exitoso";
			} else {
				$result .= "\nExito al generar registro en DB";

			}
		}
 
		$obj = new stdClass;
		$obj->insertId = $insert_id;	// the ID of new database record
		$obj->string = $result;		// the result messages
		$obj->errorlog = $errorlog;	// the error message (if any)
                return $obj;
	}

	if ('file_delete' == $mode) {

		        try {
        			$table_name = "case_documents";
				$statement = 'case_document_id = "'.$case_document_id.'" AND parcel_case_id = "'.$parcel_case_id.'"';
				// TODO make here user check that should match with current session user

				$selection = $querys->select_elements_return_all_elements($db_mysql_connection->getConnection(),$db_mysql_connection->getDBname(),
					$table_name,$statement);
				if( $selection ) {
					$line_counter = 0;				
					while ($line = mysql_fetch_assoc($selection)) {
    						$insert_id = $line['case_document_id'];
						$line_counter = $line_counter + 1;
					}
					mysql_free_result($selection);
					if ($line_counter != 1) {
						$errorlog .= "\nProblemas al eliminar registro en DB";
					} else {
						// we have only one document in the list and it matches, so do stuff to delete the document form database
						$delete_statement = 'DELETE FROM '.$db_mysql_connection->getDBname().'.'.$table_name.' WHERE '.$statement;
						$delete_status = mysql_query($delete_statement);
						if ($delete_status) {
							$result .= "\nRegistro fue eliminado";
						} else {
							$errorlog .= "\nProblemas al eliminar registro de DB";
						}
						// TODO add stuff to delete file
					}
				}
			} catch (DatabaseException $ex) {
				$errorlog .= "\nProblemas al comunicar con DB";
			}

		
//		$my_db1 = modLMUHelper::getDBinstance();
//			$user_test_sql = 'SELECT person_login FROM persons WHERE person_id = (SELECT person_id FROM parcel_cases WHERE parcel_case_id = '.$my_db1->quote($parcel_case_id).' LIMIT 1)';
//			$rowsuser = modLMUHelper::getSQLQuery01( '', $user_test_sql ); // checking if the user who created the parcel_case is the same as who is trying to delete the document
//			$joomla_user = JFactory::getUser();
//			if (isset($rowsuser[0]->person_login) && ($rowsuser[0]->person_login == $joomla_user->username)) {
//				$result .= "\nUsuario autorizado";
//				$test_sql = 'SELECT COUNT(*) AS count FROM case_documents WHERE parcel_case_id = '.$my_db1->quote($parcel_case_id).' AND case_document_id = '.$my_db1->quote($case_document_id);
//				$rows = modLMUHelper::getSQLQuery01( '', $test_sql ); // checking if there are only one record to be deleted
//				if (isset($rows[0]->count) && ($rows[0]->count == 1)) {
//			        	$base_sql = 'DELETE FROM case_documents WHERE parcel_case_id = '.$my_db1->quote($parcel_case_id).' AND case_document_id = '.$my_db1->quote($case_document_id);
//					$affected_rows = modLMUHelper::getSQLDelete($base_sql);
//					if( $affected_rows ) {
//						$result .= "\nRegistro de ".$affected_rows." documento en DB fue eliminado";
//					} else {
//						$errorlog .= "\nProblema al eliminar 1 registro de documento en DB, registro no fue eliminado";
//					}
//				} else {
//					$errorlog .= "\nProblema al eliminar registro de documento en DB (número incorrecto de registros marcado)";
//				}
//			} else {
//				$errorlog .= "\nUsuario no autorizado eliminar documento";
//			}

		$obj = new stdClass;
		$obj->insertId = $insert_id;
		$obj->string = $result;		// the result messages
		$obj->errorlog = $errorlog;	// the error message (if any)
                return $obj;
	}
    }
}

header('Content-type: application/json; charset=utf-8');
$json_data = modLmu1Helper::getAjax();
die(json_encode($json_data));

?>