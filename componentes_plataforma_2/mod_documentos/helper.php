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

	// Getting input data and making it safe for SQL
	$variable_doctype = (isset($_POST['variable_doctype'])) ? $_POST['variable_doctype'] : '';
		$variable_doctype = mysql_real_escape_string($variable_doctype);
	$prevarible_doc_description = (isset($_POST['variable_doc_description'])) ? $_POST['variable_doc_description'] : '';
		$variable_doc_description = urldecode($prevarible_doc_description);  // the urldecode is necessary to get the correct string as it can contain spaces and non ASCII
		$variable_doc_description = htmlspecialchars($variable_doc_description); 
		$variable_doc_description = mysql_real_escape_string($variable_doc_description);
	$parcel_case_id = (isset($_POST['parcel_case_id'])) ? $_POST['parcel_case_id'] : '';
		$parcel_case_id = mysql_real_escape_string($parcel_case_id);
	$case_document_id = (isset($_POST['case_document_id'])) ? $_POST['case_document_id'] : '';
		$case_document_id = mysql_real_escape_string($case_document_id);
	$mode = (isset($_POST['ajax_mode'])) ? $_POST['ajax_mode'] : '';
	$variable_user = (isset($_SESSION["usuario"])) ? $_SESSION["usuario"] : '';

	if ('file_submit' == $mode) {
	        try {
			// Verification if the upload session user is the same as case promoter
			$view_name = "tramite_usuario_view";
			$statement_user = 'tramite_id = "'.$parcel_case_id.'"';
			$selection_user = $querys->select_elements_return_all_elements($db_mysql_connection->getConnection(),$db_mysql_connection->getDBname(),
				$view_name,$statement_user);
			if( $selection_user ) {
				$line = mysql_fetch_assoc($selection_user);
				($line['usuario']) ? $case_user = $line['usuario'] : $case_user = '';  // we are interested only in one line, so no problem without loop
				// $result .= 'USER ' . $case_user; // debugging
				mysql_free_result($selection_user);
				if ($case_user != $variable_user && $variable_doctype != 'docRequiredD16' && $variable_doctype != 'docRequiredD17' && $variable_doctype != 'docRequiredD18') {
					$errorlog .= "\nProblemas al subir el archivo - usuario no coincide";	
				}
			} else {
				$errorlog .= "\nProblemas al subir el archivo - tramite no encontrado";
			}
		} catch (DatabaseException $ex) {
			$errorlog .= "\nProblemas al comunicar con DB";
		}

		if (!$errorlog) {
			// file processing
			if ($_FILES && $_FILES['variable_file']['error']!="0") {
				$errorlog .= "\nError al subir el archivo (". $_FILES['variable_file']['error'] .")";
	           	} else {
        	                $tempName = $_FILES['variable_file']['tmp_name'];
				$type = $_FILES['variable_file']['type'];
				$size = $_FILES['variable_file']['size'];
				$name = basename($_FILES['variable_file']['name']);
//				$name = JFile::makeSafe($files['name']);  // 'safe' filename
				// Filename could be not 'safe', so removing things to make it suitable for SQL XML storage
				$name = strip_tags($name); 
				$name = preg_replace("([^\w\s\d\.\-_~\[\]\(\)\]]|[\.]{2,})", '', $name);
				$name = mysql_real_escape_string($name);
				$extension = pathinfo($_FILES['variable_file']['name'],PATHINFO_EXTENSION);  // file extension
//				$tempFullPath = ini_get('upload_tmp_dir').$tempName;
				$site_path = $_SERVER['DOCUMENT_ROOT'];
				$destination_folder = $site_path. "/uploaded_documents";
				$file_properties_xml = "<xml><fileName>".$name."</fileName><fileType>".
					$type."</fileType><fileSize>".$size."</fileSize><fileDescription>".
					$variable_doc_description."</fileDescription></xml>";

//				// generating file name string (3 components: 1) joomla username, 2) timestamp, 3) random 3 symbol alphanumeric string)
				$my_date = new DateTime();
				$timestamp = $my_date->getTimestamp();
		                $random = substr( md5(rand()), 0, 3);
  				$safe_username = preg_replace("/[^a-zA-Z0-9]+/", "", $variable_user);
				$destination_filename = $safe_username . $timestamp . $random .'.'. $extension;
				$destination_full_path = $destination_folder . "/" . $destination_filename;

				if ( file_exists($tempName) ) {
					// Create the folder if not exists in images folder
					if ( !file_exists($destination_folder) ) {
						mkdir($destination_folder, 0755);
					}
					// The second check to ensure that the festination folder is OK
					if ( !file_exists($destination_folder) ) {
						$errorlog .= "\nError al crear la carpeta de destino";
					} else {
						try {
							move_uploaded_file($tempName, $destination_full_path);
						} catch ( Exception $e ) {
							$errorlog .= "\nError al mover el archivo a la carpeta de destino";
						}
					}
					// Check if the file move was successfull
					if ( !file_exists($destination_full_path) ) {
						$errorlog .= "\nError al mover el archivo a la carpeta de destino";
					} else {
						$result .= "\nÉxito al subir el archivo";
					}
		
				} else {
					$errorlog .= "\nError: no fue encontrado el archivo temporal";
				}
			}
		}

		if (!$errorlog) {
			// no error detected in file processing, so generating a database record (INSERT)
		        try {
        			$table_name = "case_documents";
				$args = 'parcel_case_id, document_type, document_url, document_properties_xml, document_date_time';
				$values = '"'.$parcel_case_id.'","'.$variable_doctype.'","'.$destination_full_path.'","'.$file_properties_xml.'",NOW()';
				$statement = 'parcel_case_id = "'.$parcel_case_id.'" AND document_url = "'.$destination_full_path.'"';
				
				$querys->insert($args,$values,
					$db_mysql_connection->getConnection(),$db_mysql_connection->getDBname(),$table_name);

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
				// case creation user should match with current session user
				$view_name = "tramite_usuario_view";
				$statement_user = 'tramite_id = "'.$parcel_case_id.'"';
				$selection_user = $querys->select_elements_return_all_elements($db_mysql_connection->getConnection(),$db_mysql_connection->getDBname(),
					$view_name,$statement_user);
				if( $selection_user ) {
					$line = mysql_fetch_assoc($selection_user);
					($line['usuario']) ? $case_user = $line['usuario'] : $case_user = '';  // we are intereste only in one line, so no problem without loop
					// $result .= 'USER ' . $case_user; // debugging
					mysql_free_result($selection_user);
					if ($case_user != $variable_user && $variable_doctype != 'docRequiredD16' && $variable_doctype != 'docRequiredD17' && $variable_doctype != 'docRequiredD18') {
						$errorlog .= "\nProblemas al eliminar registro en DB - usuario no coincide";	
					}
				} else {
					$errorlog .= "\nProblemas al eliminar registro en DB - tramite no encontrado";
				}

				if (!$errorlog) {
					// we have no problem with user verification, so proceeding
        				$table_name = "case_documents";
					$statement = 'case_document_id = "'.$case_document_id.'" AND parcel_case_id = "'.$parcel_case_id.'"';
					$selection = $querys->select_elements_return_all_elements($db_mysql_connection->getConnection(),$db_mysql_connection->getDBname(),
						$table_name,$statement);
					if( $selection ) {
						$line_counter = 0;				
						while ($line = mysql_fetch_assoc($selection)) {
    							$insert_id = $line['case_document_id'];
							$line_counter = $line_counter + 1;
							$delete_filename = $line['document_url'];
						}
						mysql_free_result($selection);
						if ($line_counter != 1) {
							$errorlog .= "\nProblemas al eliminar registro en DB - registro correspondiente no encontrado";
						} else {
							// we have only one document in the list and it matches, so do stuff to delete the document form database
							$delete_statement = 'DELETE FROM '.$db_mysql_connection->getDBname().'.'.$table_name.' WHERE '.$statement;
							$delete_status = mysql_query($delete_statement);
							if ($delete_status) {
								$result .= "\nRegistro fue eliminado";
								// stuff to delete file
								if ( file_exists($delete_filename) ) {
									if (!unlink($delete_filename)) {
										$result .= "\nError al eliminar el archivo";   // user should not see error on file removing
									} else {
										$result .= "\n Archivo fue eliminado";
									}
								} else {
									$result .= "\nError al eliminar el archivo - no encontrado";  // user should not see error on file removing
								}
							} else {
								$errorlog .= "\nProblemas al eliminar registro de DB";
							}
						}
					} else {
						$errorlog .= "\nProblemas al eliminar registro en DB - regitro no encontrado";
					}
				}
			} catch (DatabaseException $ex) {
				$errorlog .= "\nProblemas al comunicar con DB";
			}

		
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